<?php

namespace App\Http\Controllers;

use App\Models\TankUnit;
use App\Models\TechnicalReception;
use App\Services\TankTechnicalReviewService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TankTechnicalReviewController extends Controller
{
    public function __construct(
        private readonly TankTechnicalReviewService $reviewService
    ) {}

    /**
     * Muestra todos los tanques asociados al document_number
     * de la ficha técnica de recepción.
     */
    public function index(
        Request $request,
        TechnicalReception $technicalReception
    ) {
        $query = TankUnit::query()
            ->with([
                'batch:id,batch_number,document_number',
                'product',
                'gasType',
                'capacity',
                'warehouseArea',
                'technicalStatus',
                'latestTechnicalReview',
            ])
            ->whereHas('batch', function ($query) use ($technicalReception) {
                $query->where(
                    'document_number',
                    $technicalReception->document_number
                );
            });

        /*
         * Filtro por serial.
         */
        if ($request->filled('serial')) {
            $serial = trim(
                (string) $request->input('serial')
            );

            $query->where(
                'serial',
                'like',
                "%{$serial}%"
            );
        }

        /*
         * Filtro por estado técnico.
         */
        if ($request->filled('status')) {
            $status = trim(
                (string) $request->input('status')
            );

            if (in_array(
                $status,
                [
                    'Pendiente',
                    'Aprobado',
                    'Rechazado',
                ],
                true
            )) {
                $query->whereHas(
                    'technicalStatus',
                    function ($query) use ($status) {
                        $query->where('name', $status);
                    }
                );
            }
        }

        $tanks = $query
            ->orderBy('serial')
            ->paginate(50)
            ->withQueryString();

        /*
         * Consulta base para las estadísticas.
         */
        $baseQuery = TankUnit::query()
            ->whereHas('batch', function ($query) use ($technicalReception) {
                $query->where(
                    'document_number',
                    $technicalReception->document_number
                );
            });

        $summary = [
            'total' => (clone $baseQuery)->count(),

            'pending' => (clone $baseQuery)
                ->whereHas(
                    'technicalStatus',
                    function ($query) {
                        $query->where('name', 'Pendiente');
                    }
                )
                ->count(),

            'approved' => (clone $baseQuery)
                ->whereHas(
                    'technicalStatus',
                    function ($query) {
                        $query->where('name', 'Aprobado');
                    }
                )
                ->count(),

            'rejected' => (clone $baseQuery)
                ->whereHas(
                    'technicalStatus',
                    function ($query) {
                        $query->where('name', 'Rechazado');
                    }
                )
                ->count(),
        ];

        $summary['reviewed'] =
            $summary['approved']
            + $summary['rejected'];

        $summary['progress'] = $summary['total'] > 0
            ? round(
                ($summary['reviewed'] / $summary['total']) * 100
            )
            : 0;

        return view(
            'technical_receptions.tank_reviews.index',
            compact(
                'technicalReception',
                'tanks',
                'summary'
            )
        );
    }

    /**
     * Procesa aprobación, rechazo o aprobación masiva.
     */
    public function process(
        Request $request,
        TechnicalReception $technicalReception
    ) {
        $action = $request->input('action');

        $rules = [
            'action' => [
                'required',
                Rule::in([
                    'approve',
                    'reject',
                    'approve_all_pending',
                ]),
            ],
        ];

        /*
         * Para aprobar todos los pendientes no necesitamos tank_ids.
         */
        if ($action !== 'approve_all_pending') {
            $rules['tank_ids'] = [
                'required',
                'array',
                'min:1',
            ];

            $rules['tank_ids.*'] = [
                'required',
                'string',
                'exists:tank_units,id',
            ];
        }

        /*
         * Para rechazo es obligatorio indicar anomalía.
         */
        if ($action === 'reject') {
            $rules['anomaly_type'] = [
                'required',
                'string',
                'max:120',
            ];

            $rules['observation'] = [
                'nullable',
                'string',
                'max:2000',
            ];
        }

        $data = $request->validate(
            $rules,
            [
                'tank_ids.required' =>
                    'Selecciona al menos un tanque.',

                'tank_ids.min' =>
                    'Selecciona al menos un tanque.',

                'anomaly_type.required' =>
                    'Debes seleccionar el tipo de anomalía.',
            ]
        );

        try {
            /*
             * Aprobar todos los pendientes.
             */
            if ($action === 'approve_all_pending') {
                $count = $this->reviewService
                    ->approveAllPending(
                        technicalReception: $technicalReception,
                        reviewedBy: $request->user()->email,
                    );

                return redirect()
                    ->route(
                        'technical-receptions.tank-reviews.index',
                        $technicalReception
                    )
                    ->with(
                        'success',
                        "{$count} tanque(s) pendiente(s) fueron aprobados correctamente."
                    );
            }

            /*
             * Aprobar seleccionados.
             */
            if ($action === 'approve') {
                $count = $this->reviewService
                    ->approve(
                        technicalReception: $technicalReception,
                        tankIds: $data['tank_ids'],
                        reviewedBy: $request->user()->email,
                    );

                return redirect()
                    ->route(
                        'technical-receptions.tank-reviews.index',
                        $technicalReception
                    )
                    ->with(
                        'success',
                        "{$count} tanque(s) aprobado(s) y trasladado(s) al área de Productos aprobados."
                    );
            }

            /*
             * Rechazar por anomalía.
             */
            $count = $this->reviewService
                ->reject(
                    technicalReception: $technicalReception,
                    tankIds: $data['tank_ids'],
                    anomalyType: $data['anomaly_type'],
                    observation: $data['observation'] ?? null,
                    reviewedBy: $request->user()->email,
                );

            return redirect()
                ->route(
                    'technical-receptions.tank-reviews.index',
                    $technicalReception
                )
                ->with(
                    'success',
                    "{$count} tanque(s) rechazado(s) y trasladado(s) al área de rechazos/devoluciones."
                );
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'review' => $exception->getMessage(),
                ]);
        }
    }
}
