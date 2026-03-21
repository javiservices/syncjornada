<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SyncJornada') }} — @yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
@include('layouts.navigation')

<div
    x-data="{ sc: JSON.parse(localStorage.getItem('sidebarCollapsed')||'false') }"
    @sidebar-toggled.window="sc = $event.detail.collapsed"
    :class="sc ? 'lg:ml-14' : 'lg:ml-60'"
    class="page-wrap transition-[margin] duration-200">
    <div class="page-body">

        @if(session('success'))
        <div class="alert-success" role="alert">
            <i class="fas fa-circle-check flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="alert-error" role="alert">
            <i class="fas fa-circle-xmark flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @php $incidentAlert = \App\Models\IncidentAlert::where('active', true)->first(); @endphp
        @include('partials.incident_alert')

        {{-- Breadcrumb --}}
        @php
            $segments = request()->segments();
            $breadcrumbs = [];
            $routeName = request()->route()?->getName() ?? '';
            $breadcrumbMap = [
                'dashboard'                  => [['Dashboard', 'dashboard']],
                'time-entries.index'         => [['Jornadas', null]],
                'time-entries.create'        => [['Jornadas', 'time-entries.index'], ['Nueva', null]],
                'time-entries.show'          => [['Jornadas', 'time-entries.index'], ['Detalle', null]],
                'time-entries.edit'          => [['Jornadas', 'time-entries.index'], ['Editar', null]],
                'vacation-requests.index'    => [['Vacaciones', null]],
                'vacation-requests.create'   => [['Vacaciones', 'vacation-requests.index'], ['Nueva solicitud', null]],
                'vacation-requests.show'     => [['Vacaciones', 'vacation-requests.index'], ['Detalle', null]],
                'vacation-requests.edit'     => [['Vacaciones', 'vacation-requests.index'], ['Editar', null]],
                'companies.index'            => [['Empresas', null]],
                'companies.create'           => [['Empresas', 'companies.index'], ['Crear', null]],
                'companies.show'             => [['Empresas', 'companies.index'], ['Detalle', null]],
                'companies.edit'             => [['Empresas', 'companies.index'], ['Editar', null]],
                'users.index'                => [['Usuarios', null]],
                'users.create'               => [['Usuarios', 'users.index'], ['Crear', null]],
                'users.show'                 => [['Usuarios', 'users.index'], ['Detalle', null]],
                'users.edit'                 => [['Usuarios', 'users.index'], ['Editar', null]],
                'reports.index'              => [['Reportes', null]],
                'reports.create'             => [['Reportes', 'reports.index'], ['Crear registro', null]],
                'statistics.index'           => [['Estadísticas', null]],
                'company-requests.index'     => [['Solicitudes', null]],
                'admin.incident-alert.edit'  => [['Alerta Incidente', null]],
                'profile.edit'               => [['Mi perfil', null]],
            ];
            $crumbs = $breadcrumbMap[$routeName] ?? [];
        @endphp
        @if($routeName !== 'dashboard' && count($crumbs))
        <nav class="flex items-center gap-1.5 text-xs text-slate-400 mb-1 -mt-1">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors"><i class="fas fa-house text-[10px]"></i></a>
            @foreach($crumbs as $i => $crumb)
                <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                @if($crumb[1] && $i < count($crumbs) - 1)
                    <a href="{{ route($crumb[1]) }}" class="hover:text-blue-600 transition-colors font-medium">{{ $crumb[0] }}</a>
                @else
                    <span class="text-slate-600 font-medium">{{ $crumb[0] }}</span>
                @endif
            @endforeach
        </nav>
        @endif

        {{ $slot }}

        <footer class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-slate-400">
            <span>&copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados.</span>
            <div class="flex items-center gap-4">
                <a href="mailto:syncjornada@gmail.com" class="hover:text-blue-600 transition-colors">Soporte</a>
                <a href="{{ url('/politica-de-privacidad') }}" class="hover:text-blue-600 transition-colors">Privacidad</a>
                <a href="{{ url('/terminos-y-condiciones') }}" class="hover:text-blue-600 transition-colors">Términos</a>
            </div>
        </footer>
    </div>
</div>

@include('components.paypal-widget')
@stack('scripts')
</body>
</html>
