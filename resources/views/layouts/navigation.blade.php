<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="w-full px-4 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- LADO IZQUIERDO --}}
            <div class="flex items-center min-w-0">

                {{-- Logo --}}
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="h-12 w-auto object-contain" />
                    </a>
                </div>

                {{-- Menú escritorio --}}
                <div class="hidden xl:flex xl:items-center xl:ms-6 xl:gap-4 whitespace-nowrap">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('batches.index')" :active="request()->routeIs('batches.*')">
                        {{ __('Lotes') }}
                    </x-nav-link>

                    <x-nav-link :href="route('tanks.index')" :active="request()->routeIs('tanks.*')">
                        {{ __('Tanques') }}
                    </x-nav-link>

                    <x-nav-link :href="route('dispatches.index')" :active="request()->routeIs('dispatches.*')">
                        {{ __('Despachos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                        {{ __('Clientes') }}
                    </x-nav-link>

                    <x-nav-link :href="route('inventory.movements')" :active="request()->routeIs('inventory.movements')">
                        {{ __('Movimientos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('technical-receptions.index')" :active="request()->routeIs('technical-receptions.*')">
                        {{ __('Recepción') }}
                    </x-nav-link>

                    <x-nav-link :href="route('reports.monthly.index')" :active="request()->routeIs('reports.monthly.*')">
                        {{ __('Reportes') }}
                    </x-nav-link>

                    {{-- Catálogos --}}
                    <div class="flex items-center">
                        <x-dropdown align="left" width="56">
                            <x-slot name="trigger">
                                @php
                                    $catalogsActive =
                                        request()->routeIs('gas-types.*') ||
                                        request()->routeIs('capacities.*') ||
                                        request()->routeIs('warehouse-areas.*') ||
                                        request()->routeIs('technical-statuses.*');
                                @endphp

                                <button type="button"
                                    class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                                    {{ $catalogsActive
                                        ? 'border-indigo-400 text-gray-900'
                                        : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                    <span>{{ __('Catálogos') }}</span>

                                    <svg class="ms-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('gas-types.index')">
                                    {{ __('Tipos de gas') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('capacities.index')">
                                    {{ __('Capacidades') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('warehouse-areas.index')">
                                    {{ __('Áreas') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('technical-statuses.index')">
                                    {{ __('Estados técnicos') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    @if(in_array(Auth::user()->role ?? 'ENCARGADO', ['PROGRAMADOR', 'ADMINISTRADOR']))
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- LADO DERECHO --}}
            <div class="hidden xl:flex xl:items-center xl:ms-4 shrink-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                            <div class="flex max-w-44 flex-col items-start leading-tight">
                                <span class="truncate text-sm font-medium text-gray-700">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="truncate text-xs text-gray-400">
                                    {{ Auth::user()->role ?? 'ENCARGADO' }}
                                </span>
                            </div>

                            <svg class="ms-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Botón móvil / tablet --}}
            <div class="flex items-center xl:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menú responsive --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden xl:hidden border-t border-gray-100">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('batches.index')" :active="request()->routeIs('batches.*')">
                {{ __('Lotes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tanks.index')" :active="request()->routeIs('tanks.*')">
                {{ __('Tanques') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('dispatches.index')" :active="request()->routeIs('dispatches.*')">
                {{ __('Despachos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                {{ __('Clientes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('inventory.movements')" :active="request()->routeIs('inventory.movements')">
                {{ __('Movimientos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('technical-receptions.index')" :active="request()->routeIs('technical-receptions.*')">
                {{ __('Recepción técnica') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('reports.monthly.index')" :active="request()->routeIs('reports.monthly.*')">
                {{ __('Reportes') }}
            </x-responsive-nav-link>

            <div class="px-4 pt-3 pb-1 text-xs font-semibold uppercase tracking-wide text-gray-400">
                {{ __('Catálogos') }}
            </div>

            <x-responsive-nav-link :href="route('gas-types.index')" :active="request()->routeIs('gas-types.*')">
                {{ __('Tipos de gas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('capacities.index')" :active="request()->routeIs('capacities.*')">
                {{ __('Capacidades') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('warehouse-areas.index')" :active="request()->routeIs('warehouse-areas.*')">
                {{ __('Áreas') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('technical-statuses.index')" :active="request()->routeIs('technical-statuses.*')">
                {{ __('Estados técnicos') }}
            </x-responsive-nav-link>

            @if(in_array(Auth::user()->role ?? 'ENCARGADO', ['PROGRAMADOR', 'ADMINISTRADOR']))
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-sm font-medium text-gray-500">
                    {{ Auth::user()->email }}
                </div>

                <div class="text-xs font-medium text-gray-400">
                    {{ Auth::user()->role ?? 'ENCARGADO' }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
