<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Usuarios') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Gestión de usuarios del sistema (roles y activación).
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                + Nuevo
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">Nombre</th>
                                    <th class="px-3 py-2 text-left">Email</th>
                                    <th class="px-3 py-2 text-left">Rol</th>
                                    <th class="px-3 py-2 text-left">Activo</th>
                                    <th class="px-3 py-2 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($users as $u)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 font-medium text-gray-800">{{ $u->name }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $u->email }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $u->role }}</td>
                                        <td class="px-3 py-2">
                                            @if($u->is_active)
                                                <span class="inline-flex px-2 py-1 rounded-md bg-green-50 text-green-700 text-xs font-semibold">
                                                    Sí
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 rounded-md bg-red-50 text-red-700 text-xs font-semibold">
                                                    No
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="flex justify-end gap-2 flex-wrap">
                                                <a href="{{ route('users.edit', $u) }}"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 hover:bg-gray-200">
                                                    Editar
                                                </a>

                                                <form method="POST" action="{{ route('users.toggle-active', $u) }}">
                                                    @csrf
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-yellow-50 text-yellow-800 hover:bg-yellow-100">
                                                        {{ $u->is_active ? 'Desactivar' : 'Activar' }}
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('users.reset-password', $u) }}"
                                                      onsubmit="return confirm('¿Resetear contraseña y mostrarla en mensaje?')">
                                                    @csrf
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 hover:bg-indigo-100">
                                                        Reset Pass
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('users.destroy', $u) }}"
                                                      onsubmit="return confirm('¿Eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 hover:bg-red-100">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                            No hay usuarios registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
