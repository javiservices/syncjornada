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

<div x-cloak
     x-show="navOpen && window.innerWidth < 1024"
     @click="navOpen = false"
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-gray-900/50 z-30 lg:hidden"></div>

<div class="fixed left-4 bottom-6 z-40 flex flex-col items-start space-y-3" aria-label="Menu flotante">
    <button @click="navOpen = !navOpen"
            :aria-expanded="navOpen"
            class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-2xl shadow-blue-500/30 flex items-center justify-center hover:scale-105 transition" aria-label="Abrir menu">
        <span x-show="!navOpen" x-transition.opacity>
            <i class="fas fa-bars text-lg" aria-hidden="true"></i>
        </span>
        <span x-show="navOpen" x-transition.opacity>
            <i class="fas fa-times text-lg" aria-hidden="true"></i>
        </span>
    </button>

    <div x-cloak
         x-show="navOpen"
         x-transition:enter="transform transition ease-out duration-200"
         x-transition:enter-start="translate-y-2 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transform transition ease-in duration-150"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-2 opacity-0"
         class="w-72 max-w-[82vw] rounded-2xl border border-gray-200 bg-white/95 backdrop-blur shadow-2xl p-3 space-y-4">
        <div class="flex items-center justify-between px-2">
            <div class="flex items-center space-x-2">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-sm">
                    <i class="fas fa-clock text-sm" aria-hidden="true"></i>
                </span>
                <div>
                    <p class="text-xs font-semibold text-gray-500 leading-none">SyncJornada</p>
                    <p class="text-sm font-bold text-gray-900 leading-none">Panel</p>
                </div>
            </div>
            <button @click="navOpen = false" aria-label="Cerrar menu" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>

        <div class="space-y-3">
            <div>
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">General</p>
                <div class="mt-1 space-y-1">
                    @foreach($navItems as $item)
                        <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-blue-50 text-blue-700 border-blue-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-blue-100 group-hover:text-blue-700">
                                <i class="fas {{ $item['icon'] }}" aria-hidden="true"></i>
                            </span>
                            <span class="text-sm font-medium">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
                <div>
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Administracion</p>
                    <div class="mt-1 space-y-1">
                        @foreach($adminItems as $item)
                            <a href="{{ route($item['route']) }}"
                               class="group flex items-center gap-3 px-3 py-2.5 rounded-xl border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                                    <i class="fas {{ $item['icon'] }}" aria-hidden="true"></i>
                                </span>
                                <span class="text-sm font-medium">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @elseif(Auth::user()->role === 'manager')
                <div>
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Gestion</p>
                    <div class="mt-1 space-y-1">
                        @foreach($managerItems as $item)
                            <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                               class="group flex items-center gap-3 px-3 py-2.5 rounded-xl border border-transparent transition {{ request()->routeIs($item['match']) ? 'bg-indigo-50 text-indigo-700 border-indigo-100 shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-700">
                                    <i class="fas {{ $item['icon'] }}" aria-hidden="true"></i>
                                </span>
                                <span class="text-sm font-medium">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between rounded-xl border border-dashed border-gray-200 bg-gray-50 px-3 py-2.5 text-xs text-gray-600">
            <div class="flex items-center space-x-2">
                <span class="h-8 w-8 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-gray-500">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </span>
                <div class="leading-tight">
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Salir</button>
            </form>
        </div>
    </div>
</div>
