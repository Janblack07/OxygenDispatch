<x-app-layout>
    <x-slot name="header">
        <div class="client-form-header">
            <div>
                <h2 class="client-form-page-title">
                    Editar cliente
                </h2>

                <p class="client-form-page-subtitle">
                    Actualiza los datos registrados del cliente.
                </p>
            </div>

            <a
                href="{{ route('clients.index') }}"
                class="client-form-back-button"
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
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>

                Volver
            </a>
        </div>
    </x-slot>

    <style>
        .client-form-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .client-form-container {
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
        }

        .client-form-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .client-form-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .client-form-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .client-form-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .client-form-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .client-form-card-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .client-form-card-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .client-form-card-body {
            padding: 20px;
        }

        .client-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .client-form-full {
            grid-column: 1 / -1;
        }

        .client-form-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .client-required {
            color: #dc2626;
        }

        .client-form-control {
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

        .client-form-control::placeholder {
            color: #94a3b8;
        }

        .client-form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .client-form-control.has-error {
            border-color: #fca5a5;
        }

        .client-form-error {
            margin: 5px 0 0;
            color: #dc2626;
            font-size: 11px;
        }

        .client-form-errors {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
        }

        .client-form-errors-title {
            margin: 0;
            font-weight: 700;
        }

        .client-form-errors ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .client-form-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .client-form-back-button,
        .client-form-cancel-button,
        .client-form-submit-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .client-form-back-button,
        .client-form-cancel-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .client-form-back-button:hover,
        .client-form-cancel-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .client-form-submit-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
        }

        .client-form-submit-button:hover {
            background: #4338ca;
        }

        .client-form-back-button svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 640px) {
            .client-form-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .client-form-header {
                flex-direction: column;
            }

            .client-form-back-button {
                width: 100%;
            }

            .client-form-grid {
                grid-template-columns: 1fr;
            }

            .client-form-full {
                grid-column: auto;
            }

            .client-form-footer {
                flex-direction: column-reverse;
            }

            .client-form-cancel-button,
            .client-form-submit-button {
                width: 100%;
            }
        }
    </style>

    <div class="client-form-page">
        <div class="client-form-container">

            @if($errors->any())
                <div class="client-form-errors">
                    <p class="client-form-errors-title">
                        Revisa los siguientes campos:
                    </p>

                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="client-form-card">
                <div class="client-form-card-header">
                    <h3 class="client-form-card-title">
                        Información del cliente
                    </h3>

                    <p class="client-form-card-subtitle">
                        Modifica únicamente los campos necesarios.
                    </p>
                </div>

                <div class="client-form-card-body">
                    <form
                        method="POST"
                        action="{{ route('clients.update', $client) }}"
                    >
                        @csrf
                        @method('PUT')

                        <div class="client-form-grid">

                            <div>
                                <label
                                    for="name"
                                    class="client-form-label"
                                >
                                    Nombre
                                    <span class="client-required">*</span>
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $client->name) }}"
                                    class="client-form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                                    required
                                >

                                @error('name')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="document"
                                    class="client-form-label"
                                >
                                    Documento
                                </label>

                                <input
                                    id="document"
                                    name="document"
                                    value="{{ old('document', $client->document) }}"
                                    class="client-form-control {{ $errors->has('document') ? 'has-error' : '' }}"
                                    placeholder="RUC / Cédula"
                                >

                                @error('document')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="entity_type"
                                    class="client-form-label"
                                >
                                    Tipo de cliente
                                    <span class="client-required">*</span>
                                </label>

                                <select
                                    id="entity_type"
                                    name="entity_type"
                                    class="client-form-control {{ $errors->has('entity_type') ? 'has-error' : '' }}"
                                    required
                                >
                                    <option value="">
                                        Seleccionar
                                    </option>

                                    <option
                                        value="1"
                                        @selected(
                                            old(
                                                'entity_type',
                                                $client->entity_type?->value
                                            ) == 1
                                        )
                                    >
                                        Entidad
                                    </option>

                                    <option
                                        value="2"
                                        @selected(
                                            old(
                                                'entity_type',
                                                $client->entity_type?->value
                                            ) == 2
                                        )
                                    >
                                        Intradomiciliario IESS
                                    </option>

                                    <option
                                        value="3"
                                        @selected(
                                            old(
                                                'entity_type',
                                                $client->entity_type?->value
                                            ) == 3
                                        )
                                    >
                                        No afiliado / Apoyo
                                    </option>
                                </select>

                                @error('entity_type')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="phone"
                                    class="client-form-label"
                                >
                                    Teléfono
                                </label>

                                <input
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $client->phone) }}"
                                    class="client-form-control {{ $errors->has('phone') ? 'has-error' : '' }}"
                                    placeholder="Ej. 0999999999"
                                >

                                @error('phone')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="email"
                                    class="client-form-label"
                                >
                                    Email
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $client->email) }}"
                                    class="client-form-control {{ $errors->has('email') ? 'has-error' : '' }}"
                                    placeholder="cliente@correo.com"
                                >

                                @error('email')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="client-form-full">
                                <label
                                    for="address"
                                    class="client-form-label"
                                >
                                    Dirección
                                </label>

                                <input
                                    id="address"
                                    name="address"
                                    value="{{ old('address', $client->address) }}"
                                    class="client-form-control {{ $errors->has('address') ? 'has-error' : '' }}"
                                    placeholder="Ej. Av. Principal y Calle 2"
                                >

                                @error('address')
                                    <p class="client-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="client-form-footer">
                            <a
                                href="{{ route('clients.index') }}"
                                class="client-form-cancel-button"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="client-form-submit-button"
                            >
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
