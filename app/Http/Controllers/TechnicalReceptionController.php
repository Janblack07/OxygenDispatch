<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\TechnicalReception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TechnicalReceptionController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('batches')
            ->leftJoin('tank_units', 'batches.id', '=', 'tank_units.batch_id')
            ->leftJoin('technical_receptions', 'batches.document_number', '=', 'technical_receptions.document_number')
            ->whereNotNull('batches.document_number')
            ->where('batches.document_number', '<>', '')
            ->selectRaw('
                batches.document_number,
                MIN(batches.received_at) as received_at,
                MIN(batches.supplier_name) as supplier_name,
                MIN(batches.voucher_number) as voucher_number,
                COUNT(DISTINCT batches.id) as batches_count,
                COUNT(tank_units.id) as quantity_received,
                MAX(technical_receptions.id) as technical_reception_id,
                MAX(technical_receptions.final_result) as final_result,
                MAX(technical_receptions.updated_at) as technical_reception_updated_at
            ')
            ->groupBy('batches.document_number')
            ->orderByDesc(DB::raw('MIN(batches.received_at)'));

        if ($request->filled('q')) {
            $term = trim((string) $request->input('q'));

            $query->where(function ($q) use ($term) {
                $q->where('batches.document_number', 'like', "%{$term}%")
                    ->orWhere('batches.supplier_name', 'like', "%{$term}%")
                    ->orWhere('batches.voucher_number', 'like', "%{$term}%")
                    ->orWhere('batches.batch_number', 'like', "%{$term}%");
            });
        }

        if ($request->filled('final_result')) {
            if ($request->input('final_result') === 'sin_ficha') {
                $query->havingRaw('MAX(technical_receptions.id) IS NULL');
            } else {
                $query->havingRaw('MAX(technical_receptions.final_result) = ?', [$request->input('final_result')]);
            }
        }

        $documents = $query->paginate(15)->withQueryString();

        return view('technical_receptions.index', compact('documents'));
    }

    public function create(Request $request)
    {
        $documentNumber = trim((string) $request->query('document_number', ''));

        if ($documentNumber === '') {
            return redirect()
                ->route('technical-receptions.index')
                ->with('error', 'Selecciona una nota de entrega / número de orden para crear la ficha técnica.');
        }

        $existing = TechnicalReception::where('document_number', $documentNumber)->first();

        if ($existing) {
            return redirect()
                ->route('technical-receptions.edit', $existing)
                ->with('success', 'Esta orden ya tiene ficha técnica. Puedes continuar editando el checklist.');
        }

        $batches = $this->batchesByDocument($documentNumber);

        if ($batches->isEmpty()) {
            return redirect()
                ->route('technical-receptions.index')
                ->with('error', 'No se encontraron lotes registrados para ese número de orden.');
        }

        $summary = $this->buildDocumentSummary($documentNumber);

        return view('technical_receptions.create', [
            'documentNumber' => $documentNumber,
            'batches' => $batches,
            'summary' => $summary,
            'items' => collect(self::defaultChecklist())->map(fn($item) => (object) $item),
            'technicalReception' => new TechnicalReception($this->defaultHeaderData($documentNumber)),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateReception($request);
        $documentNumber = $data['document_number'];

        if (TechnicalReception::where('document_number', $documentNumber)->exists()) {
            return redirect()
                ->route('technical-receptions.index', ['q' => $documentNumber])
                ->with('error', 'Ya existe una ficha técnica para ese número de orden.');
        }

        DB::transaction(function () use ($request, $data) {
            $technicalReception = TechnicalReception::create($data);
            $this->syncItems($technicalReception, $request->input('items', []));
        });

        return redirect()
            ->route('technical-receptions.index', ['q' => $documentNumber])
            ->with('success', 'Ficha técnica creada correctamente.');
    }

    public function show(TechnicalReception $technicalReception)
    {
        $technicalReception->load('items');

        $batches = $this->batchesByDocument($technicalReception->document_number);
        $summary = $this->buildDocumentSummary($technicalReception->document_number);

        return view('technical_receptions.show', compact('technicalReception', 'batches', 'summary'));
    }

    public function edit(TechnicalReception $technicalReception)
    {
        $technicalReception->load('items');

        $batches = $this->batchesByDocument($technicalReception->document_number);
        $summary = $this->buildDocumentSummary($technicalReception->document_number);

        return view('technical_receptions.edit', compact('technicalReception', 'batches', 'summary'));
    }

    public function update(Request $request, TechnicalReception $technicalReception)
    {
        $data = $this->validateReception($request, $technicalReception->id);

        DB::transaction(function () use ($request, $technicalReception, $data) {
            $technicalReception->update($data);
            $this->syncItems($technicalReception, $request->input('items', []));
        });

        return redirect()
            ->route('technical-receptions.show', $technicalReception)
            ->with('success', 'Ficha técnica actualizada correctamente.');
    }

    public function pdf(TechnicalReception $technicalReception)
    {
        $technicalReception->load('items');

        $batches = $this->batchesByDocument($technicalReception->document_number);
        $summary = $this->buildDocumentSummary($technicalReception->document_number);

        $pdf = Pdf::loadView('technical_receptions.pdf', compact('technicalReception', 'batches', 'summary'))
            ->setPaper('a4', 'portrait');

        $safeDocumentNumber = str_replace(['/', '\\', ' '], '-', $technicalReception->document_number);

        return $pdf->stream("ficha-tecnica-{$safeDocumentNumber}.pdf");
    }

    private function validateReception(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'document_number' => [
                'required',
                'string',
                'max:100',
                Rule::exists('batches', 'document_number'),
                Rule::unique('technical_receptions', 'document_number')->ignore($ignoreId),
            ],
            'reception_date' => ['nullable', 'date'],
            'invoice_number' => ['nullable', 'string', 'max:100'],
            'remission_guide_number' => ['nullable', 'string', 'max:100'],
            'supplier_name' => ['nullable', 'string', 'max:200'],
            'manufacturer_name' => ['nullable', 'string', 'max:200'],
            'delivered_by' => ['nullable', 'string', 'max:200'],
            'received_by' => ['nullable', 'string', 'max:200'],
            'storage_conditions' => ['nullable', 'string'],
            'quantity_received' => ['nullable', 'integer', 'min:0'],
            'documentation_complies' => ['nullable', 'boolean'],
            'final_result' => ['required', Rule::in(['pendiente', 'aprobado', 'rechazado'])],
            'responsible_name' => ['nullable', 'string', 'max:200'],
            'responsible_position' => ['nullable', 'string', 'max:200'],
            'responsible_observation' => ['nullable', 'string'],

            'items' => ['nullable', 'array'],
            'items.*.section' => ['required_with:items', 'string', 'max:120'],
            'items.*.label' => ['required_with:items', 'string'],
            'items.*.complies' => ['nullable', 'boolean'],
            'items.*.observation' => ['nullable', 'string'],
            'items.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $items = collect($request->input('items', []));

        $documentalItems = $items->filter(function ($item) {
            return ($item['section'] ?? '') === 'Revisión documental';
        });

        if ($documentalItems->isNotEmpty()) {
            $allDocumentalMarked = $documentalItems->every(function ($item) {
                return array_key_exists('complies', $item) && $item['complies'] !== '';
            });

            $allDocumentalComplies = $documentalItems->every(function ($item) {
                return (string) ($item['complies'] ?? '') === '1';
            });

            $data['documentation_complies'] = $allDocumentalMarked
                ? $allDocumentalComplies
                : null;
        } else {
            $data['documentation_complies'] = null;
        }

        $data['created_by_user_email'] = $request->user()?->email;

        return collect($data)->except('items')->all();
    }

    private function syncItems(TechnicalReception $technicalReception, array $items): void
    {
        if (empty($items)) {
            $items = self::defaultChecklist();
        }

        $technicalReception->items()->delete();

        foreach (array_values($items) as $index => $item) {
            $technicalReception->items()->create([
                'section' => (string) ($item['section'] ?? 'General'),
                'label' => (string) ($item['label'] ?? ''),
                'complies' => array_key_exists('complies', $item) && $item['complies'] !== ''
                    ? (bool) $item['complies']
                    : null,
                'observation' => $item['observation'] ?? null,
                'sort_order' => (int) ($item['sort_order'] ?? ($index + 1)),
            ]);
        }
    }

    private function batchesByDocument(?string $documentNumber)
    {
        if (!$documentNumber) {
            return collect();
        }

        return Batch::with([
            'gasType',
            'capacity',
            'tankUnits.product.gasType',
            'tankUnits.product.capacity',
            'tankUnits.capacity',
            'tankUnits.technicalStatus',
            'tankUnits.warehouseArea',
        ])
            ->where('document_number', $documentNumber)
            ->orderBy('batch_number')
            ->get();
    }

    private function defaultHeaderData(?string $documentNumber): array
    {
        $summary = $this->buildDocumentSummary($documentNumber);
        $user = Auth::user();

        return [
            'document_number' => $documentNumber,
            'reception_date' => $summary['reception_date'],
            'invoice_number' => $summary['invoice_number'],
            'supplier_name' => $summary['supplier_name'],
            'quantity_received' => $summary['quantity_received'],
            'received_by' => $user?->name,
            'final_result' => 'pendiente',
            'responsible_name' => 'Q.F. Ángel Arévalo Onofre',
            'responsible_position' => 'Responsable Técnico',
        ];
    }

    private function buildDocumentSummary(?string $documentNumber): array
    {
        $batches = $this->batchesByDocument($documentNumber);
        $first = $batches->first();

        return [
            'reception_date' => $first?->received_at,
            'invoice_number' => $first?->voucher_number ?: $first?->document_number,
            'supplier_name' => $first?->supplier_name,
            'quantity_received' => $batches->sum(fn($batch) => $batch->tankUnits->count()),
            'batch_numbers' => $batches->pluck('batch_number')->filter()->unique()->implode(', '),
            'manufactured_dates' => $batches
                ->pluck('manufactured_at')
                ->filter()
                ->map(fn($date) => $date->format('Y-m-d'))
                ->unique()
                ->implode(', '),
            'expires_dates' => $batches
                ->pluck('expires_at')
                ->filter()
                ->map(fn($date) => $date->format('Y-m-d'))
                ->unique()
                ->implode(', '),
            'sanitary_registries' => $batches->pluck('sanitary_registry')->merge(
                $batches->flatMap(fn($batch) => $batch->tankUnits->pluck('product.sanitary_registry'))
            )->filter()->unique()->implode(', '),
            'products' => $batches->flatMap(fn($batch) => $batch->tankUnits)
                ->groupBy('product_id')
                ->map(function ($tanks) {
                    $tank = $tanks->first();

                    return [
                        'code' => $tank?->product?->code,
                        'detail' => $tank?->product?->detail,
                        'gas' => $tank?->product?->gasType?->name ?? $tank?->gasType?->name,
                        'capacity' => $tank?->product?->capacity?->name ?? $tank?->capacity?->name,
                        'sanitary_registry' => $tank?->product?->sanitary_registry,
                        'quantity' => $tanks->count(),
                    ];
                })
                ->values(),
        ];
    }

    public static function defaultChecklist(): array
    {
        $order = 1;

        $make = function (string $section, string $label) use (&$order) {
            return [
                'section' => $section,
                'label' => $label,
                'complies' => null,
                'observation' => null,
                'sort_order' => $order++,
            ];
        };

        return [
            $make('Revisión documental', 'Nombre del producto'),
            $make('Revisión documental', 'Nombre del gas y fórmula química'),
            $make('Revisión documental', 'Concentración del principio activo, cuando aplique'),
            $make('Revisión documental', 'Presentación del producto y advertencias del uso'),
            $make('Revisión documental', 'Nombre del fabricante y/o proveedor'),
            $make('Revisión documental', 'Condiciones de almacenamiento'),
            $make('Revisión documental', 'Cantidad de productos recibidos'),
            $make('Revisión documental', 'Vía de administración, cuando aplique'),
            $make('Revisión documental', 'Lote / serie'),
            $make('Revisión documental', 'Fecha de elaboración'),
            $make('Revisión documental', 'Fecha de expiración'),
            $make('Revisión documental', 'Nombre y firma de la persona que entrega y de la que recibe'),

            $make('Certificado de análisis según el tipo de producto', 'Certificado de análisis de control de calidad (COA)'),
            $make('Certificado de análisis según el tipo de producto', 'Certificado de esterilidad, cuando aplique, emitido por el fabricante'),

            $make('Especificaciones técnicas según muestreo', 'La etiqueta de identificación corresponde con la del producto que contiene: nombre del gas y fórmula química'),
            $make('Especificaciones técnicas según muestreo', 'Nombre del producto / nombre genérico'),
            $make('Especificaciones técnicas según muestreo', 'Lote'),
            $make('Especificaciones técnicas según muestreo', 'Fecha de elaboración'),
            $make('Especificaciones técnicas según muestreo', 'Fecha de expiración'),
            $make('Especificaciones técnicas según muestreo', 'Presentación del producto, forma farmacéutica y advertencias de uso'),
            $make('Especificaciones técnicas según muestreo', 'Intacto, sin rasgaduras o algún signo que evidencie deterioro del producto'),
            $make('Especificaciones técnicas según muestreo', 'Nombre del fabricante y/o importador cuando corresponda'),
            $make('Especificaciones técnicas según muestreo', 'Condiciones de almacenamiento'),
            $make('Especificaciones técnicas según muestreo', 'Que no exista presencia de quemaduras de arco, golpes'),
            $make('Especificaciones técnicas según muestreo', 'Que no presente grietas, roturas ni perforaciones'),
            $make('Especificaciones técnicas según muestreo', 'Que se encuentre bien sellado'),
            $make('Especificaciones técnicas según muestreo', 'Que no se encuentren deformados'),
            $make('Especificaciones técnicas según muestreo', 'Que no se encuentren sucios con grasas o aceites'),
            $make('Especificaciones técnicas según muestreo', 'Que indique la concentración del principio activo'),
            $make('Especificaciones técnicas según muestreo', 'Las etiquetas de identificación de los envases están bien adheridas y cumplen con las disposiciones de los reglamentos de registro sanitario según corresponda a cada producto'),
        ];
    }
    public function uploadSignedPdf(Request $request, TechnicalReception $technicalReception)
    {
        $request->validate([
            'signed_pdf' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ], [
            'signed_pdf.required' => 'Debes seleccionar el PDF firmado.',
            'signed_pdf.mimes' => 'El archivo debe ser un PDF.',
            'signed_pdf.max' => 'El PDF no debe superar los 10 MB.',
        ]);

        if ($technicalReception->signed_pdf_path) {
            Storage::disk('public')->delete($technicalReception->signed_pdf_path);
        }

        $safeDocumentNumber = str_replace(['/', '\\', ' '], '-', $technicalReception->document_number);

        $path = $request->file('signed_pdf')->storeAs(
            'technical-receptions/signed',
            'ficha-tecnica-firmada-' . $safeDocumentNumber . '-' . now()->format('YmdHis') . '.pdf',
            'public'
        );

        $technicalReception->update([
            'signed_pdf_path' => $path,
            'signed_pdf_uploaded_at' => now(),
            'signed_pdf_uploaded_by' => $request->user()?->email,
        ]);

        return redirect()
            ->route('technical-receptions.show', $technicalReception)
            ->with('success', 'PDF firmado subido correctamente.');
    }
}
