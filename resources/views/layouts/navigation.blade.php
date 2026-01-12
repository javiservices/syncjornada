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
     x-show="navOpen"
     @click="navOpen = false"
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-gray-900/40 z-40"></div>

<div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur border-t border-gray-200 shadow-[0_-6px_24px_-12px_rgba(0,0,0,0.25)] z-50">
    <div class="max-w-5xl mx-auto px-3 py-2 space-y-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-sm">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                </span>
                <div class="leading-tight">
                    <p class="text-xs font-semibold text-gray-500">SyncJornada</p>
                    <p class="text-sm font-bold text-gray-900">Panel</p>
                </div>
            </div>
            <button @click="navOpen = !navOpen"
                    :aria-expanded="navOpen"
                    aria-label="Menu de usuario"
                    class="relative h-11 px-3 inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white shadow-sm text-gray-700 hover:bg-gray-50">
                <i class="fas fa-user-circle text-lg" aria-hidden="true"></i>
                <span class="hidden sm:inline text-sm font-semibold">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-up text-xs text-gray-400" x-show="navOpen"></i>
                <i class="fas fa-chevron-down text-xs text-gray-400" x-show="!navOpen"></i>
            </button>
        </div>

        <div class="flex overflow-x-auto space-x-2 pb-1">
            @foreach($navItems as $item)
                <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                   class="flex-1 min-w-[90px] flex flex-col items-center justify-center gap-1 py-2 rounded-2xl border {{ request()->routeIs($item['match']) ? 'border-blue-200 bg-blue-50 text-blue-700 shadow-sm' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                    <i class="fas {{ $item['icon'] }} text-lg" aria-hidden="true"></i>
                    <span class="text-xs font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach

            @if(Auth::user()->role === 'admin')
                @foreach($adminItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex-1 min-w-[90px] flex flex-col items-center justify-center gap-1 py-2 rounded-2xl border {{ request()->routeIs($item['match']) ? 'border-indigo-200 bg-indigo-50 text-indigo-700 shadow-sm' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                        <i class="fas {{ $item['icon'] }} text-lg" aria-hidden="true"></i>
                        <span class="text-xs font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            @elseif(Auth::user()->role === 'manager')
                @foreach($managerItems as $item)
                    <a href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}"
                       class="flex-1 min-w-[90px] flex flex-col items-center justify-center gap-1 py-2 rounded-2xl border {{ request()->routeIs($item['match']) ? 'border-indigo-200 bg-indigo-50 text-indigo-700 shadow-sm' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                        <i class="fas {{ $item['icon'] }} text-lg" aria-hidden="true"></i>
                        <span class="text-xs font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div x-cloak
         x-show="navOpen"
         x-transition:enter="transform transition ease-out duration-200"
         x-transition:enter-start="translate-y-2 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transform transition ease-in duration-150"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-2 opacity-0"
         class="absolute bottom-16 right-4 left-4 sm:left-auto sm:w-72 rounded-2xl border border-gray-200 bg-white/98 backdrop-blur shadow-2xl p-3 space-y-3 z-50">
        <div class="flex items-center space-x-3">
            <span class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center">
                <i class="fas fa-user" aria-hidden="true"></i>
            </span>
            <div class="leading-tight">
                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2 text-sm">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white py-2 font-semibold text-gray-700 hover:border-blue-200 hover:text-blue-700">
                <i class="fas fa-user-circle" aria-hidden="true"></i>
                <span>Perfil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-red-50 text-red-600 font-semibold py-2 hover:bg-red-100">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span>Salir</span>
                </button>
            </form>
        </div>
    </div>
</div>
