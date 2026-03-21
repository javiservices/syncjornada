@php
    $nav = [
        ['label'=>'Dashboard',  'route'=>'dashboard',              'icon'=>'fa-house',          'match'=>'dashboard'],
        ['label'=>'Jornadas',   'route'=>'time-entries.index',     'icon'=>'fa-clock',          'match'=>'time-entries.*'],
        ['label'=>'Vacaciones', 'route'=>'vacation-requests.index','icon'=>'fa-umbrella-beach', 'match'=>'vacation-requests.*'],
    ];
    $admin = [
        ['label'=>'Empresas',         'route'=>'companies.index',           'icon'=>'fa-building',            'match'=>'companies.*'],
        ['label'=>'Usuarios',         'route'=>'users.index',               'icon'=>'fa-users',               'match'=>'users.*'],
        ['label'=>'Reportes',         'route'=>'reports.index',             'icon'=>'fa-chart-bar',           'match'=>'reports.*'],
        ['label'=>'Estadísticas',     'route'=>'statistics.index',          'icon'=>'fa-chart-line',          'match'=>'statistics.*'],
        ['label'=>'Solicitudes',      'route'=>'company-requests.index',    'icon'=>'fa-inbox',               'match'=>'company-requests.*'],
        ['label'=>'Alerta Incidente', 'route'=>'admin.incident-alert.edit', 'icon'=>'fa-triangle-exclamation','match'=>'admin.incident-alert.*'],
    ];
    $manager = [
        ['label'=>'Mi Empresa',   'route'=>['companies.show', Auth::user()->company_id], 'icon'=>'fa-building',   'match'=>'companies.show'],
        ['label'=>'Empleados',    'route'=>'users.index',      'icon'=>'fa-users',       'match'=>'users.*'],
        ['label'=>'Reportes',     'route'=>'reports.index',    'icon'=>'fa-chart-bar',   'match'=>'reports.*'],
        ['label'=>'Estadísticas', 'route'=>'statistics.index', 'icon'=>'fa-chart-line',  'match'=>'statistics.*'],
    ];
    $initials = collect(explode(' ', Auth::user()->name))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('');
@endphp

<div
    x-data="{
        sc: JSON.parse(localStorage.getItem('sidebarCollapsed')||'false'),
        open: false,
        toggle() {
            if (window.innerWidth >= 1024) {
                this.sc = !this.sc;
                localStorage.setItem('sidebarCollapsed', this.sc);
                window.dispatchEvent(new CustomEvent('sidebar-toggled',{detail:{collapsed:this.sc}}));
            } else { this.open = !this.open; }
        }
    }"
    @keydown.escape.window="open=false"
    @resize.window.debounce="if(window.innerWidth>=1024) open=false"
>

{{-- TOPBAR --}}
<header class="topbar">
    <div class="flex items-center gap-3">
        <button @click="toggle()" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors" aria-label="Menú">
            <i class="fas fa-bars text-sm"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo/logo-icon.svg') }}" alt="SyncJornada" class="w-8 h-8 flex-shrink-0">
            <span class="hidden sm:block font-bold text-slate-800 tracking-tight text-[15px]">Sync<span class="text-blue-600">Jornada</span></span>
        </a>
    </div>

    <x-dropdown align="right" width="56">
        <x-slot name="trigger">
            <button class="flex items-center gap-2.5 h-9 pl-2 pr-3 rounded-xl hover:bg-slate-100 transition-colors group">
                <div class="avatar text-xs">{{ $initials }}</div>
                <div class="hidden sm:flex flex-col items-start leading-none gap-0.5">
                    <span class="text-xs font-semibold text-slate-700">{{ Str::words(Auth::user()->name,1,'') }}</span>
                    <span class="text-[10px] text-slate-400 capitalize">{{ Auth::user()->role }}</span>
                </div>
                <i class="fas fa-chevron-down text-[9px] text-slate-400 ml-0.5"></i>
            </button>
        </x-slot>
        <x-slot name="content">
            <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/80">
                <div class="flex items-center gap-3">
                    <div class="avatar">{{ $initials }}</div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="py-1">
                <a href="{{ route('profile.edit') }}" class="dd-item">
                    <i class="fas fa-circle-user w-4 text-center text-slate-400 text-sm"></i> Mi perfil
                </a>
            </div>
            <div class="border-t border-slate-100 py-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dd-item w-full text-left text-red-600 hover:bg-red-50">
                        <i class="fas fa-arrow-right-from-bracket w-4 text-center text-red-400 text-sm"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </x-slot>
    </x-dropdown>
</header>

{{-- MOBILE OVERLAY --}}
<div x-cloak x-show="open"
     x-transition:enter="transition-opacity ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     @click="open=false" class="mob-overlay"></div>

{{-- SIDEBAR --}}
<aside x-cloak
       :class="{ 'sidebar-open': open, 'sidebar-col': sc && window.innerWidth>=1024 }"
       @mouseenter="if(sc && window.innerWidth>=1024) open=true"
       @mouseleave="if(sc && window.innerWidth>=1024) open=false"
       class="sidebar">

    <div class="sidebar-body">
        <p class="sidebar-sep">General</p>
        @foreach($nav as $item)
        @php $href = is_array($item['route']) ? route($item['route'][0],$item['route'][1]) : route($item['route']); @endphp
        <a href="{{ $href }}" class="nav-item {{ request()->routeIs($item['match']) ? 'is-active' : '' }}" title="{{ $item['label'] }}">
            <span class="nav-icon"><i class="fas {{ $item['icon'] }}"></i></span>
            <span class="nav-label">{{ $item['label'] }}</span>
            <span class="nav-tip">{{ $item['label'] }}</span>
        </a>
        @endforeach

        @if(Auth::user()->role === 'admin')
        <p class="sidebar-sep">Administración</p>
        @foreach($admin as $item)
        <a href="{{ route($item['route']) }}" class="nav-item {{ request()->routeIs($item['match']) ? 'is-active' : '' }}" title="{{ $item['label'] }}">
            <span class="nav-icon"><i class="fas {{ $item['icon'] }}"></i></span>
            <span class="nav-label">{{ $item['label'] }}</span>
            <span class="nav-tip">{{ $item['label'] }}</span>
        </a>
        @endforeach
        @elseif(Auth::user()->role === 'manager')
        <p class="sidebar-sep">Gestión</p>
        @foreach($manager as $item)
        @php $href = is_array($item['route']) ? route($item['route'][0],$item['route'][1]) : route($item['route']); @endphp
        <a href="{{ $href }}" class="nav-item {{ request()->routeIs($item['match']) ? 'is-active' : '' }}" title="{{ $item['label'] }}">
            <span class="nav-icon"><i class="fas {{ $item['icon'] }}"></i></span>
            <span class="nav-label">{{ $item['label'] }}</span>
            <span class="nav-tip">{{ $item['label'] }}</span>
        </a>
        @endforeach
        @endif

        <div class="mt-auto sidebar-foot">
            <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'is-active' : '' }} mx-0 rounded-none px-4" title="Mi perfil">
                <span class="nav-icon"><i class="fas fa-circle-user"></i></span>
                <span class="nav-label">Mi perfil</span>
                <span class="nav-tip">Mi perfil</span>
            </a>
        </div>
    </div>

    <button class="hidden lg:flex items-center justify-center h-10 sidebar-foot w-full hover:bg-slate-50 transition-colors text-slate-300 hover:text-slate-500"
            @click.stop="sc=!sc; localStorage.setItem('sidebarCollapsed',sc); open=false; window.dispatchEvent(new CustomEvent('sidebar-toggled',{detail:{collapsed:sc}}))"
            :title="sc?'Expandir':'Colapsar'">
        <i class="fas text-xs" :class="sc?'fa-chevron-right':'fa-chevron-left'"></i>
    </button>
</aside>

</div>
