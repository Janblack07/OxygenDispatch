<x-app-layout>
    <x-slot name="header">
        <div class="batch-create-header">
            <div>
                <h2 class="batch-create-page-title">
                    Nuevo lote
                </h2>

                <p class="batch-create-page-subtitle">
                    Registra la recepción del lote. Luego podrás generar sus tanques desde el detalle.
                </p>
            </div>

            <a
                href="{{ route('batches.index') }}"
                class="batch-secondary-button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="batch-action-icon"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>

                Volver
            </a>
        </div>
    </x-slot>

    <style>
        .batch-create-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .batch-create-container {
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
        }

        .batch-create-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .batch-create-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .batch-create-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .batch-form-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .batch-form-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .batch-form-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .batch-form-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .batch-form-body {
            padding: 20px;
        }

        .batch-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .batch-form-field-full {
            grid-column: 1 / -1;
        }

        .batch-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .batch-required {
            color: #dc2626;
        }

        .batch-control {
            width: 100%;
            min-height: 42px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            padding: 9px 12px;
            color: #0f172a;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        textarea.batch-control {
            min-height: 92px;
            resize: vertical;
        }

        .batch-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .batch-control.has-error {
            border-color: #fca5a5;
        }

        .batch-help {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.45;
        }

        .batch-field-error {
            margin: 5px 0 0;
            color: #dc2626;
            font-size: 11px;
        }

        .batch-errors {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
        }

        .batch-errors-title {
            margin: 0;
            font-weight: 700;
        }

        .batch-errors ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .batch-form-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .batch-primary-button,
        .batch-secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .batch-primary-button {
            min-height: 40px;
            padding: 0 15px;
            border: 0;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
        }

        .batch-primary-button:hover {
            background: #4338ca;
        }

        .batch-secondary-button {
            min-height: 40px;
            padding: 0 13px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .batch-secondary-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .batch-action-icon {
            width: 16px;
            height: 16px;
        }

        .batch-footer-note {
            margin: 0;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        @media (max-width: 640px) {
            .batch-create-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .batch-create-header {
                flex-direction: column;
            }

            .batch-secondary-button {
                width: 100%;
            }

            .batch-form-grid {
                grid-template-columns: 1fr;
            }

            .batch-form-field-full {
                grid-column: auto;
            }

            .batch-form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .batch-primary-button {
                width: 100%;
            }
        }
    </style>

    <div class="batch-create-page">
        <div class="batch-create-container">

            <section class="batch-form-card">
                <div class="batch-form-card-header">
                    <h3 class="batch-form-title">
                        Información del lote
                    </h3>

                    <p class="batch-form-subtitle">
                        Registra los datos generales de recepción. El producto real de cada tanque se define posteriormente.
                    </p>
                </div>

                <div class="batch-form-body">

                    @if($errors->any())
                        <div class="batch-errors">
                            <p class="batch-errors-title">
                                Revisa los siguientes campos:
                            </p>

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('batches.store') }}"
                    >
                        @csrf

                        <div class="batch-form-grid">

                            {{-- Número de lote --}}
                            <div>
                                <label
                                    for="batch_number"
                                    class="batch-field-label"
                                >
                                    Número de lote
                                    <span class="batch-required">*</span>
                                </label>

                                <input
                                    id="batch_number"
                                    name="batch_number"
                                    value="{{ old('batch_number') }}"
                                    class="batch-control {{ $errors->has('batch_number') ? 'has-error' : '' }}"
                                    placeholder="Ej. LOT-2026-001"
                                    required
                                >

                                @error('batch_number')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Fecha --}}
                            <div>
                                <label
                                    for="received_at"
                                    class="batch-field-label"
                                >
                                    Fecha y hora de recepción
                                    <span class="batch-required">*</span>
                                </label>

                                <input
                                    id="received_at"
                                    type="datetime-local"
                                    name="received_at"
                                    value="{{ old('received_at') }}"
                                    class="batch-control {{ $errors->has('received_at') ? 'has-error' : '' }}"
                                    required
                                >

                                @error('received_at')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Gas --}}
                            <div>
                                <label
                                    for="gas_type_id"
                                    class="batch-field-label"
                                >
                                    Gas referencial
                                </label>

                                <select
                                    id="gas_type_id"
                                    name="gas_type_id"
                                    class="batch-control {{ $errors->has('gas_type_id') ? 'has-error' : '' }}"
                                >
                                    <option value="">
                                        No aplicar
                                    </option>

                                    @foreach($gasTypes as $g)
                                        <option
                                            value="{{ $g->id }}"
                                            @selected(old('gas_type_id') == $g->id)
                                        >
                                            {{ $g->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="batch-help">
                                    El gas real se define por el producto asignado a cada tanque.
                                </p>

                                @error('gas_type_id')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Capacidad --}}
                            <div>
                                <label
                                    for="capacity_id"
                                    class="batch-field-label"
                                >
                                    Capacidad referencial
                                </label>

                                <select
                                    id="capacity_id"
                                    name="capacity_id"
                                    class="batch-control {{ $errors->has('capacity_id') ? 'has-error' : '' }}"
                                >
                                    <option value="">
                                        No aplicar
                                    </option>

                                    @foreach($capacities as $c)
                                        <option
                                            value="{{ $c->id }}"
                                            @selected(old('capacity_id') == $c->id)
                                        >
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="batch-help">
                                    La capacidad real se define por el producto asignado al tanque.
                                </p>

                                @error('capacity_id')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Orden --}}
                            <div>
                                <label
                                    for="document_number"
                                    class="batch-field-label"
                                >
                                    Número de orden / nota de entrega
                                </label>

                                <input
                                    id="document_number"
                                    name="document_number"
                                    value="{{ old('document_number') }}"
                                    class="batch-control {{ $errors->has('document_number') ? 'has-error' : '' }}"
                                    placeholder="Ej. NE-2026-001"
                                >

                                @error('document_number')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Proveedor --}}
                            <div>
                                <label
                                    for="supplier_name"
                                    class="batch-field-label"
                                >
                                    Proveedor
                                </label>

                                <input
                                    id="supplier_name"
                                    name="supplier_name"
                                    value="{{ old('supplier_name') }}"
                                    class="batch-control {{ $errors->has('supplier_name') ? 'has-error' : '' }}"
                                    placeholder="Nombre del proveedor"
                                >

                                @error('supplier_name')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Notas --}}
                            <div class="batch-form-field-full">
                                <label
                                    for="notes"
                                    class="batch-field-label"
                                >
                                    Notas
                                </label>

                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="3"
                                    class="batch-control {{ $errors->has('notes') ? 'has-error' : '' }}"
                                    placeholder="Información adicional sobre el lote..."
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="batch-form-footer">
                            <button
                                type="submit"
                                class="batch-primary-button"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="batch-action-icon"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5h10.5A2.25 2.25 0 0 0 19.5 17.25V6.75A2.25 2.25 0 0 0 17.25 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5A2.25 2.25 0 0 0 6.75 19.5Z"
                                    />
                                </svg>

                                Guardar lote
                            </button>

                            <p class="batch-footer-note">
                                Luego podrás generar tanques de distintas capacidades desde el detalle del lote.
                            </p>
                        </div>
                    </form>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>
