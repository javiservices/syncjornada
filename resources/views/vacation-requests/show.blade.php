<x-app-layout>

<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-calendar-check mr-2 text-blue-600"></i>Solicitud de vacaciones</h1>
        <p class="page-sub">Detalle de la solicitud #{{ $vacationRequest->id }}</p>
    </div>
    <a href="{{ route('vacation-requests.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i> Volver
    </a>
</div>

@php
    $statusMap = [
        'pending'  => ['class'=>'badge-yellow', 'label'=>'Pendiente', 'icon'=>'fa-clock'],
        'approved' => ['class'=>'badge-green',  'label'=>'Aprobada',  'icon'=>'fa-circle-check'],
        'rejected' => ['class'=>'badge-red',    'label'=>'Rechazada', 'icon'=>'fa-circle-xmark'],
    ];
    $st = $statusMap[$vacationRequest->status] ?? ['class'=>'badge-gray','label'=>$vacationRequest->status,'icon'=>'fa-circle'];
    $days = \Carbon\Carbon::parse($vacationRequest->start_date)->diffInDays(\Carbon\Carbon::parse($vacationRequest->end_date)) + 1;
@endphp

<div class="max-w-2xl space-y-6">
    <div class="card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-info-circle"></i></span>
                <span class="card-title">Información</span>
            </div>
            <span class="badge {{ $st['class'] }} px-3 py-1.5 text-sm">
                <i class="fas {{ $st['icon'] }} mr-1.5"></i>{{ $st['label'] }}
            </span>
        </div>
        <div class="card-body">
            <dl class="grid grid-cols-2 gap-x-8 gap-y-5">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Empleado</dt>
                    <dd class="flex items-center gap-2">
                        <div class="avatar avatar-sm text-[10px]">
                            {{ collect(explode(' ',$vacationRequest->user?->name??''))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('') }}
                        </div>
                        <span class="text-sm font-medium text-slate-800">{{ $vacationRequest->user?->name }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Tipo</dt>
                    <dd class="text-sm font-medium text-slate-800 capitalize">{{ $vacationRequest->type ?? 'Vacaciones' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Fecha inicio</dt>
                    <dd class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($vacationRequest->start_date)->isoFormat('D MMMM YYYY') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Fecha fin</dt>
                    <dd class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($vacationRequest->end_date)->isoFormat('D MMMM YYYY') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Días</dt>
                    <dd><span class="badge badge-blue px-3 py-1 text-sm font-semibold">{{ $days }} {{ $days===1?'día':'días' }}</span></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Solicitado el</dt>
                    <dd class="text-sm text-slate-600">{{ $vacationRequest->created_at->isoFormat('D MMM YYYY [a las] HH:mm') }}</dd>
                </div>
                @if($vacationRequest->reason)
                <div class="col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Motivo</dt>
                    <dd class="text-sm text-slate-700 leading-relaxed">{{ $vacationRequest->reason }}</dd>
                </div>
                @endif
                @if($vacationRequest->reviewer_notes)
                <div class="col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Notas del revisor</dt>
                    <dd class="text-sm text-slate-700 leading-relaxed">{{ $vacationRequest->reviewer_notes }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    @if($vacationRequest->status === 'pending' && in_array(Auth::user()->role, ['admin','manager']))
    <div class="card border-blue-100">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-gavel"></i></span>
                <span class="card-title">Resolver solicitud</span>
            </div>
        </div>
        <div class="card-body">
            <div class="flex gap-3">
                <form method="POST" action="{{ route('vacation-requests.approve', $vacationRequest) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check mr-2"></i> Aprobar solicitud
                    </button>
                </form>
                <form method="POST" action="{{ route('vacation-requests.reject', $vacationRequest) }}">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Rechazar esta solicitud?')">
                        <i class="fas fa-xmark mr-2"></i> Rechazar solicitud
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>

</x-app-layout>
