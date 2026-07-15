<div class="dispatch-tanks-table-box">
    <div class="dispatch-tanks-table-scroll">
        <table class="dispatch-tanks-table">
            <thead>
                <tr>
                    <th style="width: 58px; text-align: center;">
                        Sel.
                    </th>

                    <th>
                        Lote
                    </th>

                    <th>
                        Serial
                    </th>

                    <th>
                        Gas
                    </th>

                    <th>
                        Capacidad
                    </th>

                    <th>
                        Área
                    </th>

                    <th>
                        Estado técnico
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($tanks as $t)
                    @php
                        $technicalStatusName = mb_strtolower(
                            trim($t->technicalStatus?->name ?? '')
                        );

                        $technicalStyle = match($technicalStatusName) {
                            'aprobado' => '
                                border: 1px solid #a7f3d0;
                                background: #ecfdf5;
                                color: #065f46;
                            ',

                            'rechazado' => '
                                border: 1px solid #fecaca;
                                background: #fef2f2;
                                color: #991b1b;
                            ',

                            default => '
                                border: 1px solid #fde68a;
                                background: #fffbeb;
                                color: #92400e;
                            ',
                        };
                    @endphp

                    <tr>
                        {{-- Selección --}}
                        <td style="text-align: center;">
                            <input
                                type="checkbox"
                                value="{{ $t->id }}"
                                class="tank-checkbox dispatch-tank-checkbox"
                                aria-label="Seleccionar tanque {{ $t->serial }}"
                            >
                        </td>

                        {{-- Lote --}}
                        <td>
                            <div class="dispatch-tank-batch">
                                {{ $t->batch?->batch_number ?? '—' }}
                            </div>

                            @if($t->batch?->document_number)
                                <div class="dispatch-tank-secondary">
                                    Orden:
                                    {{ $t->batch->document_number }}
                                </div>
                            @endif
                        </td>

                        {{-- Serial --}}
                        <td>
                            <span class="dispatch-tank-serial">
                                {{ $t->serial }}
                            </span>
                        </td>

                        {{-- Gas --}}
                        <td>
                            {{ $t->gasType?->name ?? '—' }}
                        </td>

                        {{-- Capacidad --}}
                        <td>
                            {{ $t->capacity?->name ?? '—' }}
                        </td>

                        {{-- Área --}}
                        <td>
                            <span class="dispatch-tank-area">
                                {{ $t->warehouseArea?->name ?? '—' }}
                            </span>
                        </td>

                        {{-- Estado técnico --}}
                        <td>
                            <span
                                class="dispatch-tank-tech-badge"
                                style="{{ $technicalStyle }}"
                            >
                                {{ $t->technicalStatus?->name ?? '—' }}
                            </span>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7">
                            <div class="dispatch-tanks-empty">
                                No hay tanques disponibles con esos filtros.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Información y paginación --}}
@if($tanks->total() > 0)
    <div class="dispatch-tanks-pagination-wrapper">

        {{-- Información --}}
        <div class="dispatch-tanks-pagination-info">
            Mostrando
            <strong>{{ $tanks->firstItem() ?? 0 }}</strong>
            a
            <strong>{{ $tanks->lastItem() ?? 0 }}</strong>
            de
            <strong>{{ $tanks->total() }}</strong>
            tanques
        </div>

        {{-- Paginador --}}
        @if($tanks->hasPages())
            <nav
                class="dispatch-tanks-pagination"
                aria-label="Paginación de tanques disponibles"
            >
                {{-- Anterior --}}
                @if($tanks->onFirstPage())
                    <span
                        class="dispatch-pagination-button is-disabled"
                        aria-disabled="true"
                        aria-label="Página anterior no disponible"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m15 18-6-6 6-6"
                            />
                        </svg>
                    </span>
                @else
                    <a
                        href="{{ $tanks->previousPageUrl() }}"
                        class="dispatch-pagination-button"
                        aria-label="Página anterior"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m15 18-6-6 6-6"
                            />
                        </svg>
                    </a>
                @endif

                {{-- Cálculo de páginas visibles --}}
                @php
                    $currentPage = $tanks->currentPage();
                    $lastPage = $tanks->lastPage();

                    $startPage = max(1, $currentPage - 1);
                    $endPage = min($lastPage, $currentPage + 1);

                    if ($currentPage === 1) {
                        $endPage = min($lastPage, 3);
                    }

                    if ($currentPage === $lastPage) {
                        $startPage = max(1, $lastPage - 2);
                    }
                @endphp

                {{-- Primera página --}}
                @if($startPage > 1)
                    <a
                        href="{{ $tanks->url(1) }}"
                        class="dispatch-pagination-button"
                    >
                        1
                    </a>

                    @if($startPage > 2)
                        <span class="dispatch-pagination-ellipsis">
                            …
                        </span>
                    @endif
                @endif

                {{-- Páginas visibles --}}
                @for($page = $startPage; $page <= $endPage; $page++)
                    @if($page === $currentPage)
                        <span
                            class="dispatch-pagination-button is-active"
                            aria-current="page"
                        >
                            {{ $page }}
                        </span>
                    @else
                        <a
                            href="{{ $tanks->url($page) }}"
                            class="dispatch-pagination-button"
                        >
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Última página --}}
                @if($endPage < $lastPage)
                    @if($endPage < ($lastPage - 1))
                        <span class="dispatch-pagination-ellipsis">
                            …
                        </span>
                    @endif

                    <a
                        href="{{ $tanks->url($lastPage) }}"
                        class="dispatch-pagination-button"
                    >
                        {{ $lastPage }}
                    </a>
                @endif

                {{-- Siguiente --}}
                @if($tanks->hasMorePages())
                    <a
                        href="{{ $tanks->nextPageUrl() }}"
                        class="dispatch-pagination-button"
                        aria-label="Página siguiente"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m9 18 6-6-6-6"
                            />
                        </svg>
                    </a>
                @else
                    <span
                        class="dispatch-pagination-button is-disabled"
                        aria-disabled="true"
                        aria-label="Página siguiente no disponible"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m9 18 6-6-6-6"
                            />
                        </svg>
                    </span>
                @endif
            </nav>
        @endif

    </div>
@endif
