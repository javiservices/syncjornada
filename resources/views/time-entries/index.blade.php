<x-app-layout>

<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-clock mr-2 text-blue-600"></i>Mis Jornadas</h1>
        <p class="page-sub">Historial completo de tus registros de entrada y salida</p>
    </div>
    @if(isset($timeEntries) && $timeEntries->total() > 0)
    <span class="badge badge-blue px-3 py-1.5 text-sm font-semibold">
        {{ $timeEntries->total() }} registros
    </span>
    @endif
</div>

{{-- FILTERS --}}
<div class="filter-bar mb-6">
    <form method="GET" action="{{ route('time-entries.index') }}" class="filter-bar-body">
        <div class="filter-field">
            <label class="filter-label">Desde</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="input input-sm">
        </div>
        <div class="filter-field">
            <label class="filter-label">Hasta</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="input input-sm">
        </div>
        <div class="filter-field">
            <label class="filter-label">Modalidad</label>
            <select name="remote_work" class="select input-sm">
                <option value="">Todas</option>
                <option value="1" {{ request('remote_work') === '1' ? 'selected' : '' }}>Remoto</option>
                <option value="0" {{ request('remote_work') === '0' ? 'selected' : '' }}>Presencial</option>
            </select>
        </div>
        <div class="flex gap-2 items-end">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-magnifying-glass mr-1.5"></i> Filtrar
            </button>
            @if(request()->hasAny(['date_from','date_to','remote_work']))
            <a href="{{ route('time-entries.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-xmark mr-1.5"></i> Limpiar
            </a>
            @endif
        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="card">
    <div class="card-body p-0">
        @if($timeEntries->count() > 0)
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Duración</th>
                        <th>Modalidad</th>
                        <th>Estado</th>
                        @if(in_array(Auth::user()->role, ['admin','manager']))<th>Empleado</th>@endif
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeEntries as $entry)
                    <tr>
                        <td class="font-medium text-slate-800">
                            {{ $entry->check_in?->isoFormat('ddd D MMM YYYY') }}
                        </td>
                        <td>
                            <span class="font-mono text-sm">{{ $entry->check_in?->format('H:i') }}</span>
                        </td>
                        <td>
                            @if($entry->check_out)
                                <span class="font-mono text-sm">{{ $entry->check_out->format('H:i') }}</span>
                            @else
                                <span class="badge badge-orange">
                                    <span class="pulse-dot mr-1" style="width:6px;height:6px;"></span>En curso
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($entry->check_out)
                                @php
                                    $mins = $entry->check_in->diffInMinutes($entry->check_out);
                                    $breakMins = $entry->breaks ? $entry->breaks->sum(function($b){
                                        return $b->end_time ? \Carbon\Carbon::parse($b->start_time)->diffInMinutes(\Carbon\Carbon::parse($b->end_time)) : 0;
                                    }) : 0;
                                    $worked = max(0, $mins - $breakMins);
                                @endphp
                                <span class="font-semibold text-slate-800">{{ floor($worked/60) }}h {{ $worked%60 }}m</span>
                                @if($breakMins > 0)
                                    <span class="text-xs text-slate-400 ml-1">({{ $breakMins }}m pausa)</span>
                                @endif
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td>
                            @if($entry->remote_work)
                                <span class="badge badge-indigo"><i class="fas fa-house-laptop mr-1"></i>Remoto</span>
                            @else
                                <span class="badge badge-gray"><i class="fas fa-building mr-1"></i>Oficina</span>
                            @endif
                        </td>
                        <td>
                            @if(!$entry->check_out)
                                <span class="badge badge-orange">Abierta</span>
                            @elseif($entry->check_out->diffInHours($entry->check_in) > 12)
                                <span class="badge badge-red">Revisión</span>
                            @else
                                <span class="badge badge-green">Completada</span>
                            @endif
                        </td>
                        @if(in_array(Auth::user()->role, ['admin','manager']))
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar-sm text-[10px]">
                                    {{ collect(explode(' ',$entry->user?->name??''))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('') }}
                                </div>
                                <span class="text-sm text-slate-700">{{ $entry->user?->name }}</span>
                            </div>
                        </td>
                        @endif
                        <td>
                            <div class="tbl-actions">
                                <a href="{{ route('time-entries.show', $entry) }}" class="btn btn-ghost btn-sm" title="Ver detalle">
                                    <i class="fas fa-eye text-slate-400"></i>
                                </a>
                                @if(Auth::user()->role === 'admin' || $entry->user_id === Auth::id())
                                <a href="{{ route('time-entries.edit', $entry) }}" class="btn btn-ghost btn-sm" title="Editar">
                                    <i class="fas fa-pen text-slate-400"></i>
                                </a>
                                @endif
                                @if(Auth::user()->role === 'admin')
                                <form method="POST" action="{{ route('time-entries.destroy', $entry) }}" onsubmit="return confirm('¿Eliminar este registro?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" title="Eliminar">
                                        <i class="fas fa-trash text-red-400"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($timeEntries->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $timeEntries->withQueryString()->links() }}
        </div>
        @endif

        @else
        <div class="empty-state py-16">
            <div class="empty-icon"><i class="fas fa-clock-rotate-left"></i></div>
            <p class="empty-title">Sin registros</p>
            <p class="empty-text">
                @if(request()->hasAny(['date_from','date_to','remote_work']))
                    No hay registros con los filtros aplicados.
                    <a href="{{ route('time-entries.index') }}" class="text-blue-600 hover:underline font-medium">Limpiar filtros</a>
                @else
                    Tus fichajes aparecerán aquí cuando registres entradas.
                @endif
            </p>
        </div>
        @endif
    </div>
</div>

</x-app-layout>
