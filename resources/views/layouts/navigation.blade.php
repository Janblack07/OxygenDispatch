<nav
    x-data="{
        mobileOpen: false,
        catalogsOpen: false,
        userOpen: false
    }"
    class="oxygen-navbar"
    style="
        position: relative;
        z-index: 60;
        width: 100%;
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    "
>
    @php
        $catalogsActive =
            request()->routeIs('gas-types.*') ||
            request()->routeIs('capacities.*') ||
            request()->routeIs('warehouse-areas.*') ||
            request()->routeIs('technical-statuses.*');

        $userName = Auth::user()->name ?? 'Usuario';
        $userRole = Auth::user()->role ?? 'ENCARGADO';
        $userInitial = mb_strtoupper(mb_substr(trim($userName), 0, 1));
    @endphp

    <style>
        .oxygen-navbar * {
            box-sizing: border-box;
        }

        .oxygen-navbar-shell {
            width: 100%;
            padding: 0 18px;
        }

        .oxygen-navbar-row {
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .oxygen-navbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            flex: 1;
        }

        .oxygen-logo-box {
            width: 58px;
            height: 54px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            text-decoration: none;
            transition:
                border-color .15s ease,
                box-shadow .15s ease,
                transform .15s ease;
        }

        .oxygen-logo-box:hover {
            border-color: #c7d2fe;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
            transform: translateY(-1px);
        }

        .oxygen-logo-box svg,
        .oxygen-logo-box img {
            width: auto;
            height: 46px;
            max-width: 52px;
            object-fit: contain;
        }

        .oxygen-desktop-nav {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: 14px;
            white-space: nowrap;
        }

        .oxygen-nav-link,
        .oxygen-nav-button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 0 10px;
            border: 1px solid transparent;
            border-radius: 9px;
            background: transparent;
            color: #475569;
            font-family: inherit;
            font-size: 13px;
            line-height: 1;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                color .15s ease,
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .oxygen-nav-link:hover,
        .oxygen-nav-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .oxygen-nav-link.is-active,
        .oxygen-nav-button.is-active {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
            font-weight: 600;
            box-shadow: 0 1px 2px rgba(79, 70, 229, 0.06);
        }

        .oxygen-dropdown {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .oxygen-dropdown-panel {
            position: absolute;
            top: calc(100% + 8px);
            min-width: 220px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #ffffff;
            box-shadow:
                0 20px 25px -5px rgba(15, 23, 42, 0.10),
                0 8px 10px -6px rgba(15, 23, 42, 0.05);
        }

        .oxygen-dropdown-panel-left {
            left: 0;
        }

        .oxygen-dropdown-panel-right {
            right: 0;
        }

        .oxygen-dropdown-inner {
            padding: 6px;
        }

        .oxygen-dropdown-link {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 11px;
            border-radius: 9px;
            color: #334155;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition:
                background-color .15s ease,
                color .15s ease;
        }

        .oxygen-dropdown-link:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .oxygen-dropdown-link.is-active {
            background: #eef2ff;
            color: #4338ca;
            font-weight: 600;
        }

        .oxygen-user-wrapper {
            position: relative;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            margin-left: 14px;
        }

        .oxygen-user-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 6px 9px 6px 6px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            color: #475569;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
            transition:
                background-color .15s ease,
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .oxygen-user-button:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        }

        .oxygen-user-avatar {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 3px 8px rgba(79, 70, 229, 0.18);
        }

        .oxygen-user-text {
            min-width: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1.15;
        }

        .oxygen-user-name {
            max-width: 145px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #0f172a;
            font-size: 12px;
            font-weight: 700;
        }

        .oxygen-user-role {
            margin-top: 3px;
            max-width: 145px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .oxygen-mobile-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            padding: 0;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #f8fafc;
            color: #64748b;
            cursor: pointer;
        }

        .oxygen-mobile-panel {
            display: none;
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .oxygen-mobile-inner {
            padding: 10px 12px 12px;
        }

        .oxygen-mobile-link {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 3px;
            padding: 10px 12px;
            border-radius: 9px;
            color: #334155;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .oxygen-mobile-link.is-active {
            background: #eef2ff;
            color: #4338ca;
            font-weight: 600;
        }

        .oxygen-mobile-section-title {
            margin: 8px 0 4px;
            padding: 8px 12px 4px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        @media (max-width: 1180px) {
            .oxygen-nav-link,
            .oxygen-nav-button {
                padding-left: 7px;
                padding-right: 7px;
                font-size: 12px;
            }

            .oxygen-desktop-nav {
                gap: 2px;
                margin-left: 10px;
            }

            .oxygen-user-name,
            .oxygen-user-role {
                max-width: 105px;
            }
        }

        @media (max-width: 980px) {
            .oxygen-desktop-nav,
            .oxygen-user-wrapper {
                display: none !important;
            }

            .oxygen-mobile-toggle {
                display: inline-flex !important;
            }

            .oxygen-mobile-panel {
                display: block;
            }
        }
    </style>

    <div class="oxygen-navbar-shell">
        <div class="oxygen-navbar-row">

            {{-- IZQUIERDA --}}
            <div class="oxygen-navbar-left">

                {{-- Logo --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="oxygen-logo-box"
                    aria-label="Ir al dashboard"
                >
                    <x-application-logo />
                </a>

                {{-- Navegación escritorio --}}
                <div class="oxygen-desktop-nav">

                    <a
                        href="{{ route('dashboard') }}"
                        class="oxygen-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('batches.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('batches.*') ? 'is-active' : '' }}"
                    >
                        Lotes
                    </a>

                    <a
                        href="{{ route('tanks.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('tanks.*') ? 'is-active' : '' }}"
                    >
                        Tanques
                    </a>

                    <a
                        href="{{ route('dispatches.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('dispatches.*') ? 'is-active' : '' }}"
                    >
                        Despachos
                    </a>

                    <a
                        href="{{ route('clients.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('clients.*') ? 'is-active' : '' }}"
                    >
                        Clientes
                    </a>

                    <a
                        href="{{ route('inventory.movements') }}"
                        class="oxygen-nav-link {{ request()->routeIs('inventory.movements') ? 'is-active' : '' }}"
                    >
                        Movimientos
                    </a>

                    <a
                        href="{{ route('technical-receptions.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('technical-receptions.*') ? 'is-active' : '' }}"
                    >
                        Recepción
                    </a>

                    <a
                        href="{{ route('reports.monthly.index') }}"
                        class="oxygen-nav-link {{ request()->routeIs('reports.monthly.*') ? 'is-active' : '' }}"
                    >
                        Reportes
                    </a>

                    {{-- Catálogos --}}
                    <div class="oxygen-dropdown">
                        <button
                            type="button"
                            @click="catalogsOpen = !catalogsOpen"
                            @click.outside="catalogsOpen = false"
                            class="oxygen-nav-button {{ $catalogsActive ? 'is-active' : '' }}"
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
                                :style="catalogsOpen ? 'transform: rotate(180deg)' : ''"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>

                        <div
                            x-show="catalogsOpen"
                            x-cloak
                            x-transition
                            class="oxygen-dropdown-panel oxygen-dropdown-panel-left"
                        >
                            <div class="oxygen-dropdown-inner">

                                <a
                                    href="{{ route('gas-types.index') }}"
                                    class="oxygen-dropdown-link {{ request()->routeIs('gas-types.*') ? 'is-active' : '' }}"
                                >
                                    Tipos de gas
                                </a>

                                <a
                                    href="{{ route('capacities.index') }}"
                                    class="oxygen-dropdown-link {{ request()->routeIs('capacities.*') ? 'is-active' : '' }}"
                                >
                                    Capacidades
                                </a>

                                <a
                                    href="{{ route('warehouse-areas.index') }}"
                                    class="oxygen-dropdown-link {{ request()->routeIs('warehouse-areas.*') ? 'is-active' : '' }}"
                                >
                                    Áreas
                                </a>

                                <a
                                    href="{{ route('technical-statuses.index') }}"
                                    class="oxygen-dropdown-link {{ request()->routeIs('technical-statuses.*') ? 'is-active' : '' }}"
                                >
                                    Estados técnicos
                                </a>

                            </div>
                        </div>
                    </div>

                    @if(in_array($userRole, ['PROGRAMADOR', 'ADMINISTRADOR']))
                        <a
                            href="{{ route('users.index') }}"
                            class="oxygen-nav-link {{ request()->routeIs('users.*') ? 'is-active' : '' }}"
                        >
                            Usuarios
                        </a>
                    @endif

                </div>
            </div>

            {{-- DERECHA: USUARIO --}}
            <div class="oxygen-user-wrapper">
                <button
                    type="button"
                    @click="userOpen = !userOpen"
                    @click.outside="userOpen = false"
                    class="oxygen-user-button"
                >
                    <span class="oxygen-user-avatar">
                        {{ $userInitial }}
                    </span>

                    <span class="oxygen-user-text">
                        <span class="oxygen-user-name">
                            {{ $userName }}
                        </span>

                        <span class="oxygen-user-role">
                            {{ $userRole }}
                        </span>
                    </span>

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
                    class="oxygen-dropdown-panel oxygen-dropdown-panel-right"
                    style="min-width: 230px;"
                >
                    <div
                        style="
                            padding: 14px;
                            border-bottom: 1px solid #f1f5f9;
                        "
                    >
                        <div
                            style="
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            "
                        >
                            <span class="oxygen-user-avatar">
                                {{ $userInitial }}
                            </span>

                            <div style="min-width: 0;">
                                <div
                                    style="
                                        overflow: hidden;
                                        white-space: nowrap;
                                        text-overflow: ellipsis;
                                        color: #0f172a;
                                        font-size: 13px;
                                        font-weight: 700;
                                    "
                                >
                                    {{ $userName }}
                                </div>

                                <div
                                    style="
                                        margin-top: 3px;
                                        overflow: hidden;
                                        white-space: nowrap;
                                        text-overflow: ellipsis;
                                        color: #64748b;
                                        font-size: 11px;
                                    "
                                >
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="oxygen-dropdown-inner">
                        <a
                            href="{{ route('profile.edit') }}"
                            class="oxygen-dropdown-link"
                        >
                            Perfil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="oxygen-dropdown-link"
                                style="
                                    border: 0;
                                    background: transparent;
                                    color: #dc2626;
                                    cursor: pointer;
                                    text-align: left;
                                "
                            >
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MÓVIL --}}
            <button
                type="button"
                @click="mobileOpen = !mobileOpen"
                class="oxygen-mobile-toggle"
                aria-label="Abrir menú"
            >
                <svg
                    x-show="!mobileOpen"
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
                    x-show="mobileOpen"
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

    {{-- PANEL MÓVIL --}}
    <div
        x-show="mobileOpen"
        x-cloak
        x-transition
        class="oxygen-mobile-panel"
    >
        <div class="oxygen-mobile-inner">
            @php
                $mobileItems = [
                    [
                        'href' => route('dashboard'),
                        'label' => 'Dashboard',
                        'active' => request()->routeIs('dashboard'),
                    ],
                    [
                        'href' => route('batches.index'),
                        'label' => 'Lotes',
                        'active' => request()->routeIs('batches.*'),
                    ],
                    [
                        'href' => route('tanks.index'),
                        'label' => 'Tanques',
                        'active' => request()->routeIs('tanks.*'),
                    ],
                    [
                        'href' => route('dispatches.index'),
                        'label' => 'Despachos',
                        'active' => request()->routeIs('dispatches.*'),
                    ],
                    [
                        'href' => route('clients.index'),
                        'label' => 'Clientes',
                        'active' => request()->routeIs('clients.*'),
                    ],
                    [
                        'href' => route('inventory.movements'),
                        'label' => 'Movimientos',
                        'active' => request()->routeIs('inventory.movements'),
                    ],
                    [
                        'href' => route('technical-receptions.index'),
                        'label' => 'Recepción técnica',
                        'active' => request()->routeIs('technical-receptions.*'),
                    ],
                    [
                        'href' => route('reports.monthly.index'),
                        'label' => 'Reportes',
                        'active' => request()->routeIs('reports.monthly.*'),
                    ],
                ];

                if(in_array($userRole, ['PROGRAMADOR', 'ADMINISTRADOR'])) {
                    $mobileItems[] = [
                        'href' => route('users.index'),
                        'label' => 'Usuarios',
                        'active' => request()->routeIs('users.*'),
                    ];
                }
            @endphp

            @foreach($mobileItems as $item)
                <a
                    href="{{ $item['href'] }}"
                    class="oxygen-mobile-link {{ $item['active'] ? 'is-active' : '' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="oxygen-mobile-section-title">
                Catálogos
            </div>

            <a
                href="{{ route('gas-types.index') }}"
                class="oxygen-mobile-link {{ request()->routeIs('gas-types.*') ? 'is-active' : '' }}"
            >
                Tipos de gas
            </a>

            <a
                href="{{ route('capacities.index') }}"
                class="oxygen-mobile-link {{ request()->routeIs('capacities.*') ? 'is-active' : '' }}"
            >
                Capacidades
            </a>

            <a
                href="{{ route('warehouse-areas.index') }}"
                class="oxygen-mobile-link {{ request()->routeIs('warehouse-areas.*') ? 'is-active' : '' }}"
            >
                Áreas
            </a>

            <a
                href="{{ route('technical-statuses.index') }}"
                class="oxygen-mobile-link {{ request()->routeIs('technical-statuses.*') ? 'is-active' : '' }}"
            >
                Estados técnicos
            </a>
        </div>

        <div
            style="
                border-top: 1px solid #e2e8f0;
                padding: 14px 16px;
            "
        >
            <div
                style="
                    display: flex;
                    align-items: center;
                    gap: 10px;
                "
            >
                <span class="oxygen-user-avatar">
                    {{ $userInitial }}
                </span>

                <div style="min-width: 0;">
                    <div
                        style="
                            color: #0f172a;
                            font-size: 14px;
                            font-weight: 700;
                        "
                    >
                        {{ $userName }}
                    </div>

                    <div
                        style="
                            margin-top: 2px;
                            color: #64748b;
                            font-size: 12px;
                        "
                    >
                        {{ Auth::user()->email }}
                    </div>
                </div>
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
                    class="oxygen-mobile-link"
                    style="background: #f8fafc;"
                >
                    Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="oxygen-mobile-link"
                        style="
                            border: 0;
                            background: #fef2f2;
                            color: #dc2626;
                            cursor: pointer;
                            text-align: left;
                        "
                    >
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
