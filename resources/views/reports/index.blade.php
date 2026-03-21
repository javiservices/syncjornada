<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-chart-bar mr-2 text-blue-500"></i>Reportes de jornada</h1>
        <p class="page-sub">Registros de fichaje de todos los empleados</p>
    </div>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('reports.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Crear registro
    </a>
    @endif
</div>

{{-- FILTROS --}}
<div class="filter-bar">
    <form method="GET" class="filter-bar-body">
        @if(Auth::user()->role === 'admin')
        <div class="filter-field min-w-[150px]">
            <label class="filter-label">Empresa</label>
            <select name="company_id" class="select input-sm">
                <option value="">Todas</option>
                @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="filter-field min-w-[150px]">
            <label class="filter-label">Usuario</label>
            <select name="user_id" class="select input-sm">
                <option value="">Todos</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-field min-w-[130px]">
            <label class="filter-label">Desde</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="input input-sm">
        </div>
        <div class="filter-field min-w-[130px]">
            <label class="filter-label">Hasta</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="input input-sm">
        </div>
        <div class="filter-field min-w-[110px]">
            <label class="filter-label">Remoto</label>
            <select name="remote_work" class="select input-sm">
                <option value="all" {{ request('remote_work') == 'all' ? 'selected' : '' }}>Todos</option>
                <option value="1" {{ request('remote_work') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('remote_work') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search mr-1"></i>Filtrar</button>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
        </div>
    </form>
</div>

{{-- EXPORTACIÓN OFICIAL --}}
<div class="alert alert-info">
    <i class="fas fa-file-export text-lg flex-shrink-0"></i>
    <div class="flex-1">
        <p class="font-semibold text-sm">Exportación oficial (Normativa RD-ley 8/2019)</p>
        <p class="text-xs mt-0.5 opacity-80">Exporta los registros con auditoría completa para inspección de trabajo</p>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        <form method="POST" action="{{ route('time-entries.export') }}">
            @csrf
            <input type="hidden" name="start_date" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
            <input type="hidden" name="end_date" value="{{ request('date_to', now()->format('Y-m-d')) }}">
            <input type="hidden" name="company_id" value="{{ request('company_id') }}">
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
            <input type="hidden" name="format" value="csv">
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-file-csv mr-1"></i>CSV</button>
        </form>
        <form method="POST" action="{{ route('time-entries.export') }}">
            @csrf
            <input type="hidden" name="start_date" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
            <input type="hidden" name="end_date" value="{{ request('date_to', now()->format('Y-m-d')) }}">
            <input type="hidden" name="company_id" value="{{ request('company_id') }}">
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
            <input type="hidden" name="format" value="pdf">
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf mr-1"></i>PDF</button>
        </form>
    </div>
</div>

{{-- TABLA --}}
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-slate-100 text-slate-500"><i class="fas fa-list"></i></span>
            <span class="card-title">Registros de jornada</span>
        </div>
        <span class="badge badge-blue">{{ $timeEntries->total() }}</span>
    </div>
    <div class="card-body p-0">
        @if($timeEntries->count() > 0)
        <div class="tbl-wrap border-0 rounded-none shadow-none">
            <table class="tbl">
                <thead>
                    <tr>
                        @if(Auth::user()->role === 'admin')<th>Empresa</th>@endif
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Horas</th>
                        <th>Tipo</th>
                        <th>Ubicación</th>
                        <th>Notas</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeEntries as $entry)
                    <tr>
                        @if(Auth::user()->role === 'admin')
                        <td class="text-slate-600">{{ $entry->user->company->name ?? '—' }}</td>
                        @endif
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($entry->user->name, 0, 1)) }}</div>
                                <span class="font-medium text-slate-900">{{ $entry->user->name }}</span>
                            </div>
                        </td>
                        <td class="font-medium">{{ $entry->date }}</td>
                        <td>
                            @if($entry->check_in)
                                <span class="inline-flex items-center gap-1"><i class="fas fa-arrow-right-to-bracket text-emerald-400 text-xs"></i>{{ \Carbon\Carbon::parse($entry->check_in)->format('H:i') }}</span>
                            @else —
                            @endif
                        </td>
                        <td>
                            @if($entry->check_out)
                                <span class="inline-flex items-center gap-1"><i class="fas fa-arrow-right-from-bracket text-red-400 text-xs"></i>{{ \Carbon\Carbon::parse($entry->check_out)->format('H:i') }}</span>
                            @else
                                <span class="badge badge-orange"><i class="fas fa-spinner fa-spin mr-1"></i>Abierto</span>
                            @endif
                        </td>
                        <td>
                            @if($entry->check_in && $entry->check_out)
                                @php $mins = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out)); @endphp
                                <span class="font-semibold">{{ floor($mins/60) }}h {{ $mins%60 }}m</span>
                            @else —
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
                            @if($entry->check_in_latitude && $entry->check_in_longitude)
                                <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}" target="_blank" class="text-blue-600 hover:underline text-xs"><i class="fas fa-location-dot mr-0.5"></i>Mapa</a>
                            @else —
                            @endif
                        </td>
                        <td class="max-w-[120px] truncate text-slate-500" title="{{ $entry->notes }}">{{ $entry->notes ?: '—' }}</td>
                        <td>
                            <div class="tbl-actions justify-end">
                                <a href="{{ route('time-entries.edit', ['time_entry' => $entry->id, 'from' => 'reports']) }}" class="btn btn-ghost btn-sm" title="Editar"><i class="fas fa-pen"></i></a>
                                @if(Auth::user()->role === 'admin')
                                <form method="POST" action="{{ route('reports.destroy', $entry) }}" onsubmit="return confirm('¿Eliminar este registro de {{ $entry->user->name }}?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-red-500 hover:text-red-700 hover:bg-red-50" title="Eliminar"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $timeEntries->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-chart-bar"></i></div>
            <p class="empty-title">Sin registros</p>
            <p class="empty-text">No se encontraron registros de jornada con los filtros actuales.</p>
        </div>
        @endif
    </div>
</div>

</x-app-layout>
