<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-chart-line mr-2 text-blue-500"></i>Estadísticas</h1>
        <p class="page-sub">Análisis detallado de la jornada laboral por empleado</p>
    </div>
</div>

{{-- FILTROS --}}
<div class="filter-bar">
    <form method="GET" class="filter-bar-body">
        <div class="filter-field flex-1 min-w-[200px]">
            <label class="filter-label">Trabajador</label>
            <select name="user_id" required class="select input-sm">
                <option value="">— Selecciona un trabajador —</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}@if($user->company) — {{ $user->company->name }}@endif
                </option>
                @endforeach
            </select>
        </div>
        <div class="filter-field min-w-[140px]">
            <label class="filter-label">Desde</label>
            <input type="date" name="date_from" value="{{ $dateFrom }}" class="input input-sm">
        </div>
        <div class="filter-field min-w-[140px]">
            <label class="filter-label">Hasta</label>
            <input type="date" name="date_to" value="{{ $dateTo }}" class="input input-sm">
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-chart-line mr-1"></i>Ver estadísticas</button>
            <a href="{{ route('statistics.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
        </div>
    </form>
</div>

@if($selectedUser && $statistics)
{{-- BANNER DEL TRABAJADOR --}}
<div class="card overflow-hidden">
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 px-6 py-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="text-white">
                <h3 class="text-xl font-bold">{{ $selectedUser->name }}</h3>
                <p class="text-blue-200 text-sm">{{ $selectedUser->company->name ?? 'Sin empresa' }} · {{ $selectedUser->email }}</p>
                <p class="text-blue-300 text-xs mt-1">
                    Periodo: {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}
                </p>
            </div>
            <div class="lg:text-right">
                <p class="text-3xl font-bold text-white">{{ $statistics['total_hours'] }}h {{ $statistics['total_minutes'] }}m</p>
                <p class="text-blue-200 text-sm">Horas totales</p>
            </div>
        </div>
    </div>
</div>

{{-- TARJETAS DE ESTADÍSTICAS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="stat-card">
        <div class="stat-icon bg-emerald-100 text-emerald-600"><i class="fas fa-calendar-check"></i></div>
        <div>
            <p class="stat-val">{{ $statistics['days_worked'] }}</p>
            <p class="stat-lbl">Días trabajados</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-clock"></i></div>
        <div>
            <p class="stat-val">{{ $statistics['avg_hours'] }}h {{ $statistics['avg_minutes'] }}m</p>
            <p class="stat-lbl">Promedio/día</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-violet-100 text-violet-600"><i class="fas fa-house-laptop"></i></div>
        <div>
            <p class="stat-val">{{ $statistics['remote_percentage'] }}%</p>
            <p class="stat-lbl">Trabajo remoto</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-orange-100 text-orange-600"><i class="fas fa-triangle-exclamation"></i></div>
        <div>
            <p class="stat-val">{{ $statistics['pending_checkouts'] }}</p>
            <p class="stat-lbl">Sin cerrar</p>
        </div>
    </div>
</div>

{{-- GRÁFICOS --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Horas por día de la semana --}}
    <div class="card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-chart-bar"></i></span>
                <span class="card-title">Horas por día de la semana</span>
            </div>
        </div>
        <div class="card-body space-y-3">
            @foreach($statistics['day_of_week_data'] as $dayData)
            <div>
                <div class="flex justify-between mb-1.5">
                    <span class="text-sm font-medium text-slate-700">{{ $dayData['day'] }}</span>
                    <span class="text-sm font-semibold text-slate-900">{{ $dayData['hours'] }}h <span class="text-slate-400 font-normal">({{ $dayData['entries'] }} días)</span></span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all" style="width: {{ min(100, ($dayData['hours'] / max(10, 1)) * 100) }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Información adicional --}}
    <div class="card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-slate-100 text-slate-500"><i class="fas fa-info-circle"></i></span>
                <span class="card-title">Información adicional</span>
            </div>
        </div>
        <div class="card-body space-y-1 pt-0">
            @foreach([
                ['icon'=>'fa-arrow-right-to-bracket','color'=>'text-emerald-500','label'=>'Entrada más temprana','value'=>$statistics['earliest_check_in'] ?? 'N/A'],
                ['icon'=>'fa-arrow-right-from-bracket','color'=>'text-red-500','label'=>'Salida más tardía','value'=>$statistics['latest_check_out'] ?? 'N/A'],
                ['icon'=>'fa-list-check','color'=>'text-blue-500','label'=>'Total fichajes','value'=>$statistics['total_entries']],
                ['icon'=>'fa-circle-check','color'=>'text-emerald-500','label'=>'Fichajes completos','value'=>$statistics['completed_entries']],
                ['icon'=>'fa-mug-saucer','color'=>'text-violet-500','label'=>'Descansos totales','value'=>$statistics['total_breaks']],
                ['icon'=>'fa-house-laptop','color'=>'text-indigo-500','label'=>'Fichajes remotos','value'=>$statistics['remote_entries'].' de '.$statistics['total_entries']],
            ] as $item)
            <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                <div class="flex items-center gap-3">
                    <i class="fas {{ $item['icon'] }} {{ $item['color'] }} w-5 text-center text-sm"></i>
                    <span class="text-sm text-slate-600">{{ $item['label'] }}</span>
                </div>
                <span class="text-sm font-semibold text-slate-900">{{ $item['value'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- HORAS POR SEMANA --}}
@if(count($statistics['weekly_data']) > 0)
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-indigo-50 text-indigo-600"><i class="fas fa-calendar-week"></i></span>
            <span class="card-title">Horas por semana</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="tbl-wrap border-0 rounded-none shadow-none">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Semana</th>
                        <th>Horas</th>
                        <th>Progreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statistics['weekly_data'] as $week)
                    <tr>
                        <td class="font-medium text-slate-900">{{ $week['label'] }}</td>
                        <td class="font-semibold">{{ $week['hours'] }}h</td>
                        <td class="w-1/2">
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ min(100, ($week['hours'] / 40) * 100) }}%"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@else
{{-- ESTADO VACÍO --}}
<div class="card">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-chart-line"></i></div>
            <p class="empty-title">Selecciona un trabajador</p>
            <p class="empty-text">Elige un trabajador y un rango de fechas para ver sus estadísticas detalladas.</p>
        </div>
    </div>
</div>
@endif

</x-app-layout>
