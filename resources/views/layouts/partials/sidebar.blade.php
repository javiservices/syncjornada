@php
    $navItems = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home', 'match' => 'dashboard'],
        ['label' => 'Jornadas', 'route' => 'time-entries.index', 'icon' => 'clock', 'match' => 'time-entries.*'],
        ['label' => 'Vacaciones', 'route' => 'vacation-requests.index', 'icon' => 'calendar', 'match' => 'vacation-requests.*'],
    ];

    $adminItems = [
        ['label' => 'Empresas', 'route' => 'companies.index', 'icon' => 'building', 'match' => 'companies.*'],
        ['label' => 'Usuarios', 'route' => 'users.index', 'icon' => 'users', 'match' => 'users.*'],
        ['label' => 'Reportes', 'route' => 'reports.index', 'icon' => 'chart-bar', 'match' => 'reports.*'],
        ['label' => 'Estadísticas', 'route' => 'statistics.index', 'icon' => 'chart-line', 'match' => 'statistics.*'],
        ['label' => 'Solicitudes', 'route' => 'company-requests.index', 'icon' => 'inbox', 'match' => 'company-requests.*'],
    ];

    $managerItems = [
        ['label' => 'Mi Empresa', 'route' => ['companies.show', Auth::user()->company_id], 'icon' => 'building', 'match' => 'companies.show'],
        ['label' => 'Empleados', 'route' => 'users.index', 'icon' => 'users', 'match' => 'users.*'],
        ['label' => 'Reportes', 'route' => 'reports.index', 'icon' => 'chart-bar', 'match' => 'reports.*'],
        ['label' => 'Estadísticas', 'route' => 'statistics.index', 'icon' => 'chart-line', 'match' => 'statistics.*'],
    ];

    $getMenuIcon = function($iconName) {
        $icons = [
            'home' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z" fill=""/>',
            'clock' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 16.6944 7.30558 20.5 12 20.5C16.6944 20.5 20.5 16.6944 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V11.6893L15.5303 14.4697C15.8232 14.7626 15.8232 15.2374 15.5303 15.5303C15.2374 15.8232 14.7626 15.8232 14.4697 15.5303L11.4697 12.5303C11.329 12.3897 11.25 12.1989 11.25 12V7C11.25 6.58579 11.5858 6.25 12 6.25Z" fill=""/>',
            'calendar' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z" fill=""/>',
            'building' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 5.5C3.75 4.25736 4.75736 3.25 6 3.25H10C11.2426 3.25 12.25 4.25736 12.25 5.5V18.5C12.25 19.7426 11.2426 20.75 10 20.75H6C4.75736 20.75 3.75 19.7426 3.75 18.5V5.5ZM6 4.75C5.58579 4.75 5.25 5.08579 5.25 5.5V18.5C5.25 18.9142 5.58579 19.25 6 19.25H10C10.4142 19.25 10.75 18.9142 10.75 18.5V5.5C10.75 5.08579 10.4142 4.75 10 4.75H6ZM13.75 9.5C13.75 8.25736 14.7574 7.25 16 7.25H18C19.2426 7.25 20.25 8.25736 20.25 9.5V18.5C20.25 19.7426 19.2426 20.75 18 20.75H16C14.7574 20.75 13.75 19.7426 13.75 18.5V9.5ZM16 8.75C15.5858 8.75 15.25 9.08579 15.25 9.5V18.5C15.25 18.9142 15.5858 19.25 16 19.25H18C18.4142 19.25 18.75 18.9142 18.75 18.5V9.5C18.75 9.08579 18.4142 8.75 18 8.75H16Z" fill=""/>',
            'users' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 7.25C8.25736 7.25 7.25 8.25736 7.25 9.5C7.25 10.7426 8.25736 11.75 9.5 11.75C10.7426 11.75 11.75 10.7426 11.75 9.5C11.75 8.25736 10.7426 7.25 9.5 7.25ZM5.75 9.5C5.75 7.42893 7.42893 5.75 9.5 5.75C11.5711 5.75 13.25 7.42893 13.25 9.5C13.25 11.5711 11.5711 13.25 9.5 13.25C7.42893 13.25 5.75 11.5711 5.75 9.5ZM17 9.25C16.5858 9.25 16.25 9.58579 16.25 10C16.25 10.4142 16.5858 10.75 17 10.75C17.6904 10.75 18.25 11.3096 18.25 12C18.25 12.6904 17.6904 13.25 17 13.25C16.5858 13.25 16.25 13.5858 16.25 14C16.25 14.4142 16.5858 14.75 17 14.75C18.5188 14.75 19.75 13.5188 19.75 12C19.75 10.4812 18.5188 9.25 17 9.25ZM4.25 18C4.25 15.3766 6.37665 13.25 9 13.25H10C12.6234 13.25 14.75 15.3766 14.75 18V19C14.75 19.4142 14.4142 19.75 14 19.75C13.5858 19.75 13.25 19.4142 13.25 19V18C13.25 16.2051 11.7949 14.75 10 14.75H9C7.20507 14.75 5.75 16.2051 5.75 18V19C5.75 19.4142 5.41421 19.75 5 19.75C4.58579 19.75 4.25 19.4142 4.25 19V18ZM15.7907 14.8683C16.0777 14.5061 16.5997 14.4445 16.9619 14.7315C18.2672 15.7605 19.0833 17.3036 19.0833 19V19.5C19.0833 19.9142 18.7475 20.25 18.3333 20.25C17.9191 20.25 17.5833 19.9142 17.5833 19.5V19C17.5833 17.7381 16.9739 16.5952 16.0048 15.852C15.6426 15.565 15.5037 15.0305 15.7907 14.8683Z" fill=""/>',
            'chart-bar' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M3.25 5C3.25 4.58579 3.58579 4.25 4 4.25H8C8.41421 4.25 8.75 4.58579 8.75 5V19C8.75 19.4142 8.41421 19.75 8 19.75H4C3.58579 19.75 3.25 19.4142 3.25 19V5ZM4.75 5.75V18.25H7.25V5.75H4.75ZM9.75 10C9.75 9.58579 10.0858 9.25 10.5 9.25H13.5C13.9142 9.25 14.25 9.58579 14.25 10V19C14.25 19.4142 13.9142 19.75 13.5 19.75H10.5C10.0858 19.75 9.75 19.4142 9.75 19V10ZM11.25 10.75V18.25H12.75V10.75H11.25ZM16.25 14C16.25 13.5858 16.5858 13.25 17 13.25H20C20.4142 13.25 20.75 13.5858 20.75 14V19C20.75 19.4142 20.4142 19.75 20 19.75H17C16.5858 19.75 16.25 19.4142 16.25 19V14ZM17.75 14.75V18.25H19.25V14.75H17.75Z" fill=""/>',
            'chart-line' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M3.25 12C3.25 11.5858 3.58579 11.25 4 11.25H4.01C4.42421 11.25 4.76 11.5858 4.76 12C4.76 12.4142 4.42421 12.75 4.01 12.75H4C3.58579 12.75 3.25 12.4142 3.25 12ZM6.94976 10.0502C7.24265 9.75732 7.71753 9.75732 8.01042 10.0502L11 13.0398L15.9896 8.05024C16.2825 7.75735 16.7574 7.75735 17.0503 8.05024L20.5303 11.5302C20.8232 11.8231 20.8232 12.298 20.5303 12.5909C20.2374 12.8838 19.7626 12.8838 19.4697 12.5909L16.52 9.64116L11.5304 14.6308C11.2375 14.9236 10.7626 14.9236 10.4697 14.6308L7.48009 11.6411L5.53033 13.5909C5.23744 13.8838 4.76256 13.8838 4.46967 13.5909C4.17678 13.298 4.17678 12.8231 4.46967 12.5302L6.94976 10.0502ZM3.25 5C3.25 4.58579 3.58579 4.25 4 4.25H20C20.4142 4.25 20.75 4.58579 20.75 5C20.75 5.41421 20.4142 5.75 20 5.75H4C3.58579 5.75 3.25 5.41421 3.25 5ZM3.25 19C3.25 18.5858 3.58579 18.25 4 18.25H20C20.4142 18.25 20.75 18.5858 20.75 19C20.75 19.4142 20.4142 19.75 20 19.75H4C3.58579 19.75 3.25 19.4142 3.25 19Z" fill=""/>',
            'inbox' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5C19.7426 20.75 20.75 19.7426 20.75 18.5V5.5C20.75 4.25736 19.7426 3.25 18.5 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5C18.9142 4.75 19.25 5.08579 19.25 5.5V12.25H14.8107L14.3414 13.6586C14.1999 14.0816 13.8123 14.3698 13.3685 14.3698H10.6315C10.1877 14.3698 9.80008 14.0816 9.65858 13.6586L9.18934 12.25H4.75V5.5ZM4.75 13.75V18.5C4.75 18.9142 5.08579 19.25 5.5 19.25H18.5C18.9142 19.25 19.25 18.9142 19.25 18.5V13.75H15.3107L14.8414 15.1586C14.5584 16.0046 13.7623 16.5817 12.8685 16.5817H11.1315C10.2377 16.5817 9.44158 16.0046 9.15858 15.1586L8.68934 13.75H4.75Z" fill=""/>',
        ];
        return $icons[$iconName] ?? $icons['home'];
    };
@endphp

<aside
    :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
    <!-- SIDEBAR HEADER -->
    <div
        :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7"
    >
        <a href="{{ route('dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="h-10 dark:hidden" src="{{ asset('images/logo/logo.svg') }}" alt="SyncJornada" />
                <img class="h-10 hidden dark:block" src="{{ asset('images/logo/logo-dark.svg') }}" alt="SyncJornada" />
            </span>

            <img
                class="logo-icon h-10"
                :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('images/logo/logo-icon.svg') }}"
                alt="Logo"
            />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav x-data="{selected: $persist('{{ request()->routeIs('dashboard') ? 'Dashboard' : 'General' }}')}">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span
                        class="menu-group-title"
                        :class="sidebarToggle ? 'lg:hidden' : ''"
                    >
                        MENU
                    </span>

                    <svg
                        :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill=""
                        />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    @foreach($navItems as $item)
                        <!-- Menu Item -->
                        <li>
                            <a
                                href="{{ route($item['route']) }}"
                                class="menu-item group"
                                :class="'{{ request()->routeIs($item['match']) ? 'menu-item-active' : 'menu-item-inactive' }}'"
                            >
                                <svg
                                    :class="'{{ request()->routeIs($item['match']) ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}'"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    {!! $getMenuIcon($item['icon']) !!}
                                </svg>

                                <span
                                    class="menu-item-text"
                                    :class="sidebarToggle ? 'lg:hidden' : ''"
                                >
                                    {{ $item['label'] }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if(Auth::user()->role === 'admin')
                <!-- Admin Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                        <span
                            class="menu-group-title"
                            :class="sidebarToggle ? 'lg:hidden' : ''"
                        >
                            ADMINISTRACIÓN
                        </span>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        @foreach($adminItems as $item)
                            <li>
                                <a
                                    href="{{ route($item['route']) }}"
                                    class="menu-item group"
                                    :class="'{{ request()->routeIs($item['match']) ? 'menu-item-active' : 'menu-item-inactive' }}'"
                                >
                                    <svg
                                        :class="'{{ request()->routeIs($item['match']) ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}'"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        {!! $getMenuIcon($item['icon']) !!}
                                    </svg>

                                    <span
                                        class="menu-item-text"
                                        :class="sidebarToggle ? 'lg:hidden' : ''"
                                    >
                                        {{ $item['label'] }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @elseif(Auth::user()->role === 'manager')
                <!-- Manager Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                        <span
                            class="menu-group-title"
                            :class="sidebarToggle ? 'lg:hidden' : ''"
                        >
                            GESTIÓN
                        </span>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        @foreach($managerItems as $item)
                            <li>
                                <a
                                    href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                                    class="menu-item group"
                                    :class="'{{ request()->routeIs($item['match']) ? 'menu-item-active' : 'menu-item-inactive' }}'"
                                >
                                    <svg
                                        :class="'{{ request()->routeIs($item['match']) ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}'"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        {!! $getMenuIcon($item['icon']) !!}
                                    </svg>

                                    <span
                                        class="menu-item-text"
                                        :class="sidebarToggle ? 'lg:hidden' : ''"
                                    >
                                        {{ $item['label'] }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
