<x-app-layout>
    <x-slot name="header">
        <div class="catalog-form-header">
            <div>
                <h2 class="catalog-form-page-title">
                    Editar área
                </h2>

                <p class="catalog-form-page-subtitle">
                    Actualiza la información del área seleccionada.
                </p>
            </div>

            <a
                href="{{ route('warehouse-areas.index') }}"
                class="catalog-form-back-button"
            >
                ← Volver
            </a>
        </div>
    </x-slot>

    <style>
        .catalog-form-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .catalog-form-container {
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
        }

        .catalog-form-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .catalog-form-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .catalog-form-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .catalog-form-back-button,
        .catalog-form-cancel-button,
        .catalog-form-submit-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 13px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .catalog-form-back-button,
        .catalog-form-cancel-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .catalog-form-submit-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
        }

        .catalog-form-errors {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
        }

        .catalog-form-errors ul {
            margin: 0;
            padding-left: 18px;
        }

        .catalog-form-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
        }

        .catalog-form-card-header {
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .catalog-form-card-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .catalog-form-card-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .catalog-form-card-body {
            padding: 20px;
        }

        .catalog-form-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .catalog-form-control {
            width: 100%;
            min-height: 42px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 9px 12px;
            color: #0f172a;
            font-family: inherit;
            font-size: 13px;
            outline: none;
        }

        .catalog-form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
        }

        .catalog-form-footer {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        @media (max-width: 640px) {
            .catalog-form-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .catalog-form-header {
                flex-direction: column;
            }

            .catalog-form-back-button {
                width: 100%;
            }

            .catalog-form-footer {
                flex-direction: column-reverse;
            }

            .catalog-form-cancel-button,
            .catalog-form-submit-button {
                width: 100%;
            }
        }
    </style>

    <div class="catalog-form-page">
        <div class="catalog-form-container">

            @if($errors->any())
                <div class="catalog-form-errors">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="catalog-form-card">
                <div class="catalog-form-card-header">
                    <h3 class="catalog-form-card-title">
                        Información del área
                    </h3>

                    <p class="catalog-form-card-subtitle">
                        Modifica únicamente el nombre cuando sea necesario.
                    </p>
                </div>

                <div class="catalog-form-card-body">
                    <form
                        method="POST"
                        action="{{ route('warehouse-areas.update', $item) }}"
                    >
                        @csrf
                        @method('PUT')

                        <div>
                            <label
                                for="name"
                                class="catalog-form-label"
                            >
                                Nombre *
                            </label>

                            <input
                                id="name"
                                name="name"
                                value="{{ old('name', $item->name) }}"
                                class="catalog-form-control"
                                required
                            >
                        </div>

                        <div class="catalog-form-footer">
                            <a
                                href="{{ route('warehouse-areas.index') }}"
                                class="catalog-form-cancel-button"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="catalog-form-submit-button"
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
