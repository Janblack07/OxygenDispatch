<nav
    x-data="{ open: false }"
    style="
        position: relative;
        z-index: 50;
        width: 100%;
        border-bottom: 1px solid #e2e8f0;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    "
>
    <div
        style="
            width: 100%;
            box-sizing: border-box;
            padding: 0 18px;
        "
    >
        <div
            style="
                min-height: 64px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            "
        >
            {{-- IZQUIERDA: Logo + navegación --}}
            <div
                style="
                    min-width: 0;
                    display: flex;
                    align-items: center;
                    flex: 1;
                "
            >
                {{-- Logo --}}
                <div
                    style="
                        flex-shrink: 0;
                        display: flex;
                        align-items: center;
                    "
                >
                    <a
                        href="{{ route('dashboard') }}"
                        aria-label="Ir al dashboard"
                        style="
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            text-decoration: none;
                        "
                    >
                        <x-application-logo
                            style="
                                display: block;
                                width: auto;
                                height: 50px;
                                object-fit: contain;
                            "
                        />
                    </a>
                </div>

                {{-- Menú escritorio --}}
                <div
                    class="hidden sm:flex"
                    style="
                        min-width: 0;
                        align-items: center;
                        margin-left: 22px;
                        gap: 16px;
                        white-space: nowrap;
                    "
                >
                    @php
                        $desktopLinkBase = '
                            position: relative;
                            display: inline-flex;
                            align-items: center;
                            min-height: 64px;
                            padding: 0 1px;
                            border: 0;
                            border-bottom: 2px solid transparent;
                            background: transparent;
                            font-size: 13px;
                            line-height: 1;
                            font-weight: 500;
                            text-decoration: none;
                            transition: color .15s ease, border-color .15s ease;
                        ';

                        $desktopLinkActive = '
                            color: #4f46e5;
                            border-bottom-color: #6366f1;
                        ';

                        $desktopLinkInactive = '
                            color: #475569;
                        ';
                    @endphp

                    <a
                        href="{{ route('dashboard') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('dashboard') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('batches.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('batches.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Lotes
                    </a>

                    <a
                        href="{{ route('tanks.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('tanks.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Tanques
                    </a>

                    <a
                        href="{{ route('dispatches.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('dispatches.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Despachos
                    </a>

                    <a
                        href="{{ route('clients.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('clients.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Clientes
                    </a>

                    <a
                        href="{{ route('inventory.movements') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('inventory.movements') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Movimientos
                    </a>

                    <a
                        href="{{ route('technical-receptions.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('technical-receptions.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Recepción
                    </a>

                    <a
                        href="{{ route('reports.monthly.index') }}"
                        style="{{ $desktopLinkBase }} {{ request()->routeIs('reports.monthly.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                    >
                        Reportes
                    </a>

                    {{-- Catálogos --}}
                    @php
                        $catalogsActive =
                            request()->routeIs('gas-types.*') ||
                            request()->routeIs('capacities.*') ||
                            request()->routeIs('warehouse-areas.*') ||
                            request()->routeIs('technical-statuses.*');
                    @endphp

                    <div
                        x-data="{ catalogOpen: false }"
                        style="
                            position: relative;
                            display: inline-flex;
                            align-items: center;
                        "
                    >
                        <button
                            type="button"
                            @click="catalogOpen = !catalogOpen"
                            @click.outside="catalogOpen = false"
                            style="
                                min-height: 64px;
                                display: inline-flex;
                                align-items: center;
                                gap: 5px;
                                padding: 0;
                                border: 0;
                                border-bottom: 2px solid {{ $catalogsActive ? '#6366f1' : 'transparent' }};
                                background: transparent;
                                color: {{ $catalogsActive ? '#4f46e5' : '#475569' }};
                                font-size: 13px;
                                line-height: 1;
                                font-weight: 500;
                                cursor: pointer;
                            "
                        >
                            <span>Catálogos</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                style="
                                    width: 14px;
                                    height: 14px;
                                    transition: transform .15s ease;
                                "
                                :style="catalogOpen ? 'transform: rotate(180deg)' : ''"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>

                        <div
                            x-show="catalogOpen"
                            x-cloak
                            x-transition
                            style="
                                position: absolute;
                                top: calc(100% - 6px);
                                left: 0;
                                min-width: 220px;
                                overflow: hidden;
                                border: 1px solid #e2e8f0;
                                border-radius: 12px;
                                background: #ffffff;
                                box-shadow:
                                    0 20px 25px -5px rgba(15, 23, 42, 0.10),
                                    0 8px 10px -6px rgba(15, 23, 42, 0.06);
                            "
                        >
                            <div style="padding: 6px;">
                                @foreach([
                                    [
                                        'route' => route('gas-types.index'),
                                        'label' => 'Tipos de gas',
                                        'active' => request()->routeIs('gas-types.*'),
                                    ],
                                    [
                                        'route' => route('capacities.index'),
                                        'label' => 'Capacidades',
                                        'active' => request()->routeIs('capacities.*'),
                                    ],
                                    [
                                        'route' => route('warehouse-areas.index'),
                                        'label' => 'Áreas',
                                        'active' => request()->routeIs('warehouse-areas.*'),
                                    ],
                                    [
                                        'route' => route('technical-statuses.index'),
                                        'label' => 'Estados técnicos',
                                        'active' => request()->routeIs('technical-statuses.*'),
                                    ],
                                ] as $catalogItem)
                                    <a
                                        href="{{ $catalogItem['route'] }}"
                                        style="
                                            display: flex;
                                            align-items: center;
                                            width: 100%;
                                            box-sizing: border-box;
                                            padding: 10px 12px;
                                            border-radius: 8px;
                                            background: {{ $catalogItem['active'] ? '#eef2ff' : 'transparent' }};
                                            color: {{ $catalogItem['active'] ? '#4338ca' : '#334155' }};
                                            font-size: 13px;
                                            font-weight: {{ $catalogItem['active'] ? '600' : '500' }};
                                            text-decoration: none;
                                        "
                                    >
                                        {{ $catalogItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if(in_array(Auth::user()->role ?? 'ENCARGADO', ['PROGRAMADOR', 'ADMINISTRADOR']))
                        <a
                            href="{{ route('users.index') }}"
                            style="{{ $desktopLinkBase }} {{ request()->routeIs('users.*') ? $desktopLinkActive : $desktopLinkInactive }}"
                        >
                            Usuarios
                        </a>
                    @endif
                </div>
            </div>

            {{-- DERECHA: usuario escritorio --}}
            <div
                class="hidden sm:flex"
                x-data="{ userOpen: false }"
                style="
                    position: relative;
                    flex-shrink: 0;
                    align-items: center;
                    margin-left: 14px;
                "
            >
                <button
                    type="button"
                    @click="userOpen = !userOpen"
                    @click.outside="userOpen = false"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 10px;
                        padding: 7px 10px;
                        border: 1px solid transparent;
                        border-radius: 10px;
                        background: transparent;
                        color: #475569;
                        cursor: pointer;
                    "
                >
                    <div
                        style="
                            display: flex;
                            flex-direction: column;
                            align-items: flex-end;
                            line-height: 1.15;
                        "
                    >
                        <span
                            style="
                                max-width: 155px;
                                overflow: hidden;
                                white-space: nowrap;
                                text-overflow: ellipsis;
                                font-size: 13px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            {{ Auth::user()->name }}
                        </span>

                        <span
                            style="
                                margin-top: 3px;
                                max-width: 155px;
                                overflow: hidden;
                                white-space: nowrap;
                                text-overflow: ellipsis;
                                font-size: 10px;
                                font-weight: 500;
                                color: #94a3b8;
                                letter-spacing: .04em;
                                text-transform: uppercase;
                            "
                        >
                            {{ Auth::user()->role ?? 'ENCARGADO' }}
                        </span>
                    </div>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        style="
                            width: 15px;
                            height: 15px;
                            color: #64748b;
                            transition: transform .15s ease;
                        "
                        :style="userOpen ? 'transform: rotate(180deg)' : ''"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>

                <div
                    x-show="userOpen"
                    x-cloak
                    x-transition
                    style="
                        position: absolute;
                        top: calc(100% + 8px);
                        right: 0;
                        min-width: 210px;
                        overflow: hidden;
                        border: 1px solid #e2e8f0;
                        border-radius: 12px;
                        background: #ffffff;
                        box-shadow:
                            0 20px 25px -5px rgba(15, 23, 42, 0.10),
                            0 8px 10px -6px rgba(15, 23, 42, 0.06);
                    "
                >
                    <div
                        style="
                            padding: 12px 14px;
                            border-bottom: 1px solid #f1f5f9;
                        "
                    >
                        <div
                            style="
                                font-size: 13px;
                                font-weight: 600;
                                color: #0f172a;
                            "
                        >
                            {{ Auth::user()->name }}
                        </div>

                        <div
                            style="
                                margin-top: 3px;
                                font-size: 11px;
                                color: #64748b;
                            "
                        >
                            {{ Auth::user()->email }}
                        </div>
                    </div>

                    <div style="padding: 6px;">
                        <a
                            href="{{ route('profile.edit') }}"
                            style="
                                display: flex;
                                width: 100%;
                                box-sizing: border-box;
                                align-items: center;
                                padding: 10px 12px;
                                border-radius: 8px;
                                color: #334155;
                                font-size: 13px;
                                font-weight: 500;
                                text-decoration: none;
                            "
                        >
                            Perfil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                style="
                                    width: 100%;
                                    display: flex;
                                    align-items: center;
                                    padding: 10px 12px;
                                    border: 0;
                                    border-radius: 8px;
                                    background: transparent;
                                    color: #dc2626;
                                    font-size: 13px;
                                    font-weight: 500;
                                    text-align: left;
                                    cursor: pointer;
                                "
                            >
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Botón móvil --}}
            <div
                class="sm:hidden"
                style="
                    display: flex;
                    align-items: center;
                "
            >
                <button
                    type="button"
                    @click="open = !open"
                    style="
                        width: 40px;
                        height: 40px;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid #e2e8f0;
                        border-radius: 10px;
                        background: #f8fafc;
                        color: #64748b;
                        cursor: pointer;
                    "
                >
                    <svg
                        x-show="!open"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        style="width: 22px; height: 22px;"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        x-show="open"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        style="width: 22px; height: 22px;"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menú móvil --}}
    <div
        x-show="open"
        x-cloak
        class="sm:hidden"
        style="
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
        "
    >
        <div style="padding: 10px 12px;">
            @php
                $mobileItems = [
                    ['route' => route('dashboard'), 'label' => 'Dashboard', 'active' => request()->routeIs('dashboard')],
                    ['route' => route('batches.index'), 'label' => 'Lotes', 'active' => request()->routeIs('batches.*')],
                    ['route' => route('tanks.index'), 'label' => 'Tanques', 'active' => request()->routeIs('tanks.*')],
                    ['route' => route('dispatches.index'), 'label' => 'Despachos', 'active' => request()->routeIs('dispatches.*')],
                    ['route' => route('clients.index'), 'label' => 'Clientes', 'active' => request()->routeIs('clients.*')],
                    ['route' => route('inventory.movements'), 'label' => 'Movimientos', 'active' => request()->routeIs('inventory.movements')],
                    ['route' => route('technical-receptions.index'), 'label' => 'Recepción técnica', 'active' => request()->routeIs('technical-receptions.*')],
                    ['route' => route('reports.monthly.index'), 'label' => 'Reportes', 'active' => request()->routeIs('reports.monthly.*')],
                ];

                if (in_array(Auth::user()->role ?? 'ENCARGADO', ['PROGRAMADOR', 'ADMINISTRADOR'])) {
                    $mobileItems[] = [
                        'route' => route('users.index'),
                        'label' => 'Usuarios',
                        'active' => request()->routeIs('users.*'),
                    ];
                }
            @endphp

            @foreach($mobileItems as $item)
                <a
                    href="{{ $item['route'] }}"
                    style="
                        display: flex;
                        align-items: center;
                        width: 100%;
                        box-sizing: border-box;
                        margin-bottom: 3px;
                        padding: 10px 12px;
                        border-radius: 9px;
                        background: {{ $item['active'] ? '#eef2ff' : 'transparent' }};
                        color: {{ $item['active'] ? '#4338ca' : '#334155' }};
                        font-size: 14px;
                        font-weight: {{ $item['active'] ? '600' : '500' }};
                        text-decoration: none;
                    "
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div
                style="
                    margin: 8px 0 4px;
                    padding: 8px 12px 4px;
                    font-size: 10px;
                    font-weight: 700;
                    color: #94a3b8;
                    letter-spacing: .08em;
                    text-transform: uppercase;
                "
            >
                Catálogos
            </div>

            @foreach([
                ['route' => route('gas-types.index'), 'label' => 'Tipos de gas'],
                ['route' => route('capacities.index'), 'label' => 'Capacidades'],
                ['route' => route('warehouse-areas.index'), 'label' => 'Áreas'],
                ['route' => route('technical-statuses.index'), 'label' => 'Estados técnicos'],
            ] as $catalogItem)
                <a
                    href="{{ $catalogItem['route'] }}"
                    style="
                        display: flex;
                        align-items: center;
                        width: 100%;
                        box-sizing: border-box;
                        padding: 9px 12px 9px 22px;
                        border-radius: 9px;
                        color: #475569;
                        font-size: 13px;
                        font-weight: 500;
                        text-decoration: none;
                    "
                >
                    {{ $catalogItem['label'] }}
                </a>
            @endforeach
        </div>

        <div
            style="
                border-top: 1px solid #e2e8f0;
                padding: 14px 16px;
            "
        >
            <div
                style="
                    font-size: 14px;
                    font-weight: 600;
                    color: #0f172a;
                "
            >
                {{ Auth::user()->name }}
            </div>

            <div
                style="
                    margin-top: 2px;
                    font-size: 12px;
                    color: #64748b;
                "
            >
                {{ Auth::user()->email }}
            </div>

            <div
                style="
                    margin-top: 2px;
                    font-size: 10px;
                    font-weight: 600;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: .05em;
                "
            >
                {{ Auth::user()->role ?? 'ENCARGADO' }}
            </div>

            <div
                style="
                    margin-top: 12px;
                    display: flex;
                    flex-direction: column;
                    gap: 5px;
                "
            >
                <a
                    href="{{ route('profile.edit') }}"
                    style="
                        display: flex;
                        align-items: center;
                        padding: 9px 12px;
                        border-radius: 9px;
                        background: #f8fafc;
                        color: #334155;
                        font-size: 13px;
                        font-weight: 500;
                        text-decoration: none;
                    "
                >
                    Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        style="
                            width: 100%;
                            display: flex;
                            align-items: center;
                            padding: 9px 12px;
                            border: 0;
                            border-radius: 9px;
                            background: #fef2f2;
                            color: #dc2626;
                            font-size: 13px;
                            font-weight: 500;
                            text-align: left;
                            cursor: pointer;
                        "
                    >
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
