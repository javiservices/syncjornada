<x-app-layout>

<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-umbrella-beach mr-2 text-blue-600"></i>Vacaciones</h1>
        <p class="page-sub">Gestiona tus solicitudes de vacaciones y permisos</p>
    </div>
    <a href="{{ route('vacation-requests.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-2"></i> Nueva solicitud
    </a>
</div>

{{-- FILTERS --}}
<div class="filter-bar mb-6">
    <form method="GET" action="{{ route('vacation-requests.index') }}" class="filter-bar-body">
        <div class="filter-field">
            <label class="filter-label">Estado</label>
            <select name="status" class="select input-sm" onchange="this.form.submit()">
                <option value="">Todos</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pendiente</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Aprobada</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rechazada</option>
            </select>
        </div>
        @if(request('status'))
        <div class="flex items-end">
            <a href="{{ route('vacation-requests.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-xmark mr-1.5"></i> Limpiar
            </a>
        </div>
        @endif
    </form>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($vacationRequests->count() > 0)
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        @if(in_array(Auth::user()->role, ['admin','manager']))<th>Empleado</th>@endif
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Días</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Solicitado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vacationRequests as $req)
                    @php
                        $days = \Carbon\Carbon::parse($req->start_date)->diffInDays(\Carbon\Carbon::parse($req->end_date)) + 1;
                        $statusMap = [
                            'pending'  => ['class'=>'badge-yellow', 'label'=>'Pendiente', 'icon'=>'fa-clock'],
                            'approved' => ['class'=>'badge-green',  'label'=>'Aprobada',  'icon'=>'fa-circle-check'],
                            'rejected' => ['class'=>'badge-red',    'label'=>'Rechazada', 'icon'=>'fa-circle-xmark'],
                        ];
                        $st = $statusMap[$req->status] ?? ['class'=>'badge-gray','label'=>$req->status,'icon'=>'fa-circle'];
                    @endphp
                    <tr>
                        @if(in_array(Auth::user()->role, ['admin','manager']))
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar-sm text-[10px]">
                                    {{ collect(explode(' ',$req->user?->name??''))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('') }}
                                </div>
                                <span class="text-sm text-slate-700">{{ $req->user?->name }}</span>
                            </div>
                        </td>
                        @endif
                        <td class="font-medium">{{ \Carbon\Carbon::parse($req->start_date)->isoFormat('D MMM YYYY') }}</td>
                        <td class="font-medium">{{ \Carbon\Carbon::parse($req->end_date)->isoFormat('D MMM YYYY') }}</td>
                        <td><span class="badge badge-blue">{{ $days }}d</span></td>
                        <td class="max-w-[180px] truncate text-slate-600 text-sm">{{ $req->reason ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $st['class'] }}">
                                <i class="fas {{ $st['icon'] }} mr-1"></i>{{ $st['label'] }}
                            </span>
                        </td>
                        <td class="text-slate-500 text-sm">{{ $req->created_at->isoFormat('D MMM YYYY') }}</td>
                        <td>
                            <div class="tbl-actions">
                                <a href="{{ route('vacation-requests.show', $req) }}" class="btn btn-ghost btn-sm" title="Ver detalle">
                                    <i class="fas fa-eye text-slate-400"></i>
                                </a>
                                @if($req->status === 'pending' && ($req->user_id === Auth::id() || Auth::user()->role === 'admin'))
                                <form method="POST" action="{{ route('vacation-requests.destroy', $req) }}" onsubmit="return confirm('¿Cancelar esta solicitud?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" title="Cancelar">
                                        <i class="fas fa-trash text-red-400"></i>
                                    </button>
                                </form>
                                @endif
                                @if($req->status === 'pending' && in_array(Auth::user()->role, ['admin','manager']))
                                <form method="POST" action="{{ route('vacation-requests.approve', $req) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost btn-sm" title="Aprobar">
                                        <i class="fas fa-check text-emerald-500"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('vacation-requests.reject', $req) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost btn-sm" title="Rechazar">
                                        <i class="fas fa-xmark text-red-400"></i>
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

        @if($vacationRequests->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $vacationRequests->withQueryString()->links() }}
        </div>
        @endif

        @else
        <div class="empty-state py-16">
            <div class="empty-icon"><i class="fas fa-umbrella-beach"></i></div>
            <p class="empty-title">Sin solicitudes</p>
            <p class="empty-text">
                @if(request('status'))
                    No hay solicitudes con el estado seleccionado.
                @else
                    Crea tu primera solicitud de vacaciones.
                @endif
            </p>
            <a href="{{ route('vacation-requests.create') }}" class="btn btn-primary mt-4">
                <i class="fas fa-plus mr-2"></i> Nueva solicitud
            </a>
        </div>
        @endif
    </div>
</div>

</x-app-layout>
