@php
    $navItems = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'fa-home', 'match' => 'dashboard'],
        ['label' => 'Jornadas', 'route' => 'time-entries.index', 'icon' => 'fa-clock', 'match' => 'time-entries.*'],
        ['label' => 'Vacaciones', 'route' => 'vacation-requests.index', 'icon' => 'fa-umbrella-beach', 'match' => 'vacation-requests.*'],
    ];

    $adminItems = [
        ['label' => 'Empresas', 'route' => 'companies.index', 'icon' => 'fa-building', 'match' => 'companies.*'],
        ['label' => 'Usuarios', 'route' => 'users.index', 'icon' => 'fa-users', 'match' => 'users.*'],
        ['label' => 'Reportes', 'route' => 'reports.index', 'icon' => 'fa-chart-bar', 'match' => 'reports.*'],
        ['label' => 'Estadisticas', 'route' => 'statistics.index', 'icon' => 'fa-chart-line', 'match' => 'statistics.*'],
        ['label' => 'Solicitudes', 'route' => 'company-requests.index', 'icon' => 'fa-inbox', 'match' => 'company-requests.*'],
    ];

    $managerItems = [
        ['label' => 'Mi Empresa', 'route' => ['companies.show', Auth::user()->company_id], 'icon' => 'fa-building', 'match' => 'companies.show'],
        ['label' => 'Empleados', 'route' => 'users.index', 'icon' => 'fa-users', 'match' => 'users.*'],
        ['label' => 'Reportes', 'route' => 'reports.index', 'icon' => 'fa-chart-bar', 'match' => 'reports.*'],
        ['label' => 'Estadisticas', 'route' => 'statistics.index', 'icon' => 'fa-chart-line', 'match' => 'statistics.*'],
    ];

    $routeName = request()->route() ? request()->route()->getName() : null;
    $pageTitle = match (true) {
        $routeName === 'dashboard' => 'Dashboard',
        request()->routeIs('time-entries.*') => 'Jornadas',
        request()->routeIs('vacation-requests.*') => 'Vacaciones',
        request()->routeIs('companies.*') => 'Empresas',
        request()->routeIs('users.*') => 'Usuarios',
        request()->routeIs('reports.*') => 'Reportes',
        request()->routeIs('statistics.*') => 'Estadisticas',
        request()->routeIs('company-requests.*') => 'Solicitudes',
        true => 'Dashboard',
    };
@endphp

<header class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-gray-200 shadow-sm z-40">
    <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <button @click="if (window.innerWidth >= 1024) { sidebarCollapsed = !sidebarCollapsed; sidebarOpen = true } else { sidebarOpen = !sidebarOpen }" class="p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition-colors" aria-label="Alternar menu">
                <i x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'fas fa-chevron-right' : 'fas fa-bars'" class="transition-all duration-200"></i>
            </button>
            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">SyncJornada</p>
                <p class="text-lg font-bold text-gray-900">{{ $pageTitle }}</p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 shadow-sm">
                        <span class="hidden sm:inline text-sm font-semibold">{{ Auth::user()->name }}</span>
                        <span class="h-9 w-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center">
                            <i class="fas fa-user text-sm" aria-hidden="true"></i>
                        </span>
                        <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-gray-500" aria-hidden="true"></i>
                        <span>Perfil</span>
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault(); this.closest('form').submit();"
                                         class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            <span>Salir</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>

<aside x-cloak
    :class="sidebarOpen ? (sidebarCollapsed ? 'lg:w-14' : 'lg:w-64') : '-translate-x-full lg:translate-x-0'"
       x-transition:enter="transform transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
    class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200 shadow-lg z-40 overflow-y-auto transform lg:translate-x-0 lg:transition-all lg:duration-200 group"
    @mouseenter="if (sidebarCollapsed && window.innerWidth >= 1024) sidebarOpen = true"
    @mouseleave="if (sidebarCollapsed && window.innerWidth >= 1024) sidebarOpen = false">
    <div x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'p-1' : 'p-4'" class="space-y-6 transition-all duration-200">
        <div class="space-y-1">
            <p x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide transition-all duration-200">General</p>
            @foreach($navItems as $item)
                <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs($item['match']) ? 'bg-blue-50 text-blue-700 border border-blue-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}"
                   x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'justify-center px-1 py-2' : ''">
                    <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-blue-100 group-hover:text-blue-700">
                        <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                    </span>
                    <span x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="text-sm font-medium transition-all duration-200">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>

        @if(Auth::user()->role === 'admin')
            <div class="space-y-1">
                <p x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide transition-all duration-200">Administracion</p>
                @foreach($adminItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}"
                       x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'justify-center px-1 py-2' : ''">
                        <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                            <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                        </span>
                        <span x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="text-sm font-medium transition-all duration-200">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        @elseif(Auth::user()->role === 'manager')
            <div class="space-y-1">
                <p x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide transition-all duration-200">Gestion</p>
                @foreach($managerItems as $item)
                    <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}"
                       x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'justify-center px-1 py-2' : ''">
                        <span class="flex h-9 w-9 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                            <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                        </span>
                        <span x-bind:class="sidebarCollapsed && window.innerWidth >= 1024 ? 'hidden' : ''" class="text-sm font-medium transition-all duration-200">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</aside>

<div x-cloak
     x-show="sidebarOpen && window.innerWidth < 1024"
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-gray-900/50 z-20 lg:hidden"></div>
