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
@endphp

<nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur border-b border-gray-200 shadow-sm z-30 h-16" role="navigation" aria-label="Barra superior">
    <div class="h-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-full">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" :aria-expanded="sidebarOpen" aria-label="Alternar menu" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition" aria-label="Ir al dashboard">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/30">
                        <i class="fas fa-clock text-lg" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-semibold text-gray-500 leading-none">SyncJornada</div>
                        <div class="text-lg font-bold text-gray-900 leading-none">Panel</div>
                    </div>
                </a>
            </div>

            <div class="flex items-center space-x-3">
                <div class="hidden md:flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-500">
                    <i class="fas fa-bolt text-blue-500 mr-2" aria-hidden="true"></i>
                    <span>Productividad activa</span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition" aria-label="Menu de usuario">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold">
                                <i class="fas fa-user text-sm" aria-hidden="true"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-semibold text-gray-900 leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                            <i class="fas fa-user-circle text-gray-500" aria-hidden="true"></i>
                            <span>{{ __('Perfil') }}</span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();"
                                             class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span>{{ __('Cerrar Sesion') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<aside x-cloak
       x-show="sidebarOpen"
       x-transition:enter="transform transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200 shadow-xl z-20 overflow-y-auto">
    <div class="px-4 pt-6 pb-4 space-y-6">
        <div class="space-y-1" aria-label="Navegacion general">
            <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">General</p>
            @foreach($navItems as $item)
                <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                   class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-blue-50 text-blue-700 border-blue-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="flex h-8 w-8 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-blue-100 group-hover:text-blue-700">
                        <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                    </span>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>

        @if(Auth::user()->role === 'admin')
            <div class="space-y-1" aria-label="Navegacion de administracion">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Administracion</p>
                @foreach($adminItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                            <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                        </span>
                        <span class="text-sm font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        @elseif(Auth::user()->role === 'manager')
            <div class="space-y-1" aria-label="Navegacion de gestion">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Gestion</p>
                @foreach($managerItems as $item)
                    <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                       class="group flex items-center space-x-3 px-3 py-2.5 rounded-lg border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                        <span class="flex h-8 w-8 items-center justify-center rounded-md bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                            <i class="fas {{ $item['icon'] }} text-sm" aria-hidden="true"></i>
                        </span>
                        <span class="text-sm font-medium">{{ $item['label'] }}</span>
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
     class="fixed inset-0 bg-gray-900/50 z-10 lg:hidden"></div>
