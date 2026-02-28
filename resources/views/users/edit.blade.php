<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Editar usuario') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Actualiza datos y rol del usuario.
                </p>
            </div>

            <a href="{{ route('users.index') }}"
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label-sm">Nombre *</label>
                                <input name="name" value="{{ old('name', $user->name) }}" class="form-input-sm" required>
                            </div>

                            <div>
                                <label class="form-label-sm">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input-sm" required>
                            </div>

                            <div>
                                <label class="form-label-sm">Rol *</label>
                                <select name="role" class="form-select-sm" required>
                                    @foreach($roles as $r)
                                        <option value="{{ $r->value }}" @selected(old('role', $user->role)==$r->value)>
                                            {{ $r->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="form-label-sm">Activo</label>
                                <div class="mt-2 text-sm text-gray-700">
                                    {{ $user->is_active ? 'Sí' : 'No' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
