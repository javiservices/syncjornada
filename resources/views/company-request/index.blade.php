<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-inbox mr-2 text-violet-500"></i>Solicitudes de empresas</h1>
        <p class="page-sub">Gestiona las solicitudes de acceso de nuevas empresas</p>
    </div>
</div>

{{-- ESTADÍSTICAS --}}
@php
    $totalRequests = $requests->total();
    $pendingCount  = \App\Models\CompanyRequest::where('status', 'pending')->count();
    $approvedCount = \App\Models\CompanyRequest::where('status', 'approved')->count();
    $rejectedCount = \App\Models\CompanyRequest::where('status', 'rejected')->count();
@endphp
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="stat-card">
        <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-list"></i></div>
        <div>
            <p class="stat-val">{{ $totalRequests }}</p>
            <p class="stat-lbl">Total</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-amber-100 text-amber-600"><i class="fas fa-clock"></i></div>
        <div>
            <p class="stat-val">{{ $pendingCount }}</p>
            <p class="stat-lbl">Pendientes</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-emerald-100 text-emerald-600"><i class="fas fa-circle-check"></i></div>
        <div>
            <p class="stat-val">{{ $approvedCount }}</p>
            <p class="stat-lbl">Aprobadas</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-red-100 text-red-600"><i class="fas fa-circle-xmark"></i></div>
        <div>
            <p class="stat-val">{{ $rejectedCount }}</p>
            <p class="stat-lbl">Rechazadas</p>
        </div>
    </div>
</div>

{{-- TABLA --}}
<div class="card" x-data="{ viewOpen: false, rejectOpen: false, current: null, rejectAction: '' }">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-violet-50 text-violet-600"><i class="fas fa-inbox"></i></span>
            <span class="card-title">Listado de solicitudes</span>
        </div>
        <span class="badge badge-blue">{{ $totalRequests }}</span>
    </div>
    <div class="card-body p-0">
        @if($requests->isEmpty())
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
            <p class="empty-title">Sin solicitudes</p>
            <p class="empty-text">Las solicitudes de nuevas empresas aparecerán aquí cuando se envíen.</p>
        </div>
        @else
        <div class="tbl-wrap border-0 rounded-none shadow-none">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Contacto</th>
                        <th>Empleados</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-building text-violet-500 text-xs"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 truncate">{{ $req->company_name }}</p>
                                    @if($req->message)
                                    <p class="text-xs text-slate-400 truncate max-w-[180px]">{{ Str::limit($req->message, 40) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-medium text-slate-800">{{ $req->contact_name }}</p>
                            <p class="text-xs text-slate-400">{{ $req->email }}</p>
                            @if($req->phone)
                            <p class="text-xs text-slate-400">{{ $req->phone }}</p>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-gray">{{ $req->employees ?? '—' }}</span>
                        </td>
                        <td>
                            <p class="text-sm text-slate-700">{{ $req->created_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-slate-400">{{ $req->created_at->diffForHumans() }}</p>
                        </td>
                        <td>
                            @if($req->status === 'pending')
                                <span class="badge badge-yellow"><i class="fas fa-clock mr-1"></i>Pendiente</span>
                            @elseif($req->status === 'approved')
                                <span class="badge badge-green"><i class="fas fa-check mr-1"></i>Aprobada</span>
                            @else
                                <span class="badge badge-red"><i class="fas fa-xmark mr-1"></i>Rechazada</span>
                            @endif
                        </td>
                        <td>
                            <div class="tbl-actions justify-end">
                                {{-- Ver detalle --}}
                                <button type="button"
                                    @click="current = {{ Js::from($req) }}; viewOpen = true"
                                    class="btn btn-ghost btn-sm" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @if($req->status === 'pending')
                                {{-- Aprobar --}}
                                <form method="POST" action="{{ route('company-requests.update-status', $req) }}" class="inline" onsubmit="return confirm('¿Aprobar esta solicitud? Se creará la empresa y el usuario manager automáticamente.')">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-ghost btn-sm text-emerald-600 hover:bg-emerald-50" title="Aprobar">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                {{-- Rechazar --}}
                                <button type="button"
                                    @click="rejectAction = '{{ route('company-requests.update-status', $req) }}'; rejectOpen = true"
                                    class="btn btn-ghost btn-sm text-red-500 hover:bg-red-50" title="Rechazar">
                                    <i class="fas fa-xmark"></i>
                                </button>
                                @endif

                                {{-- Email --}}
                                <a href="mailto:{{ $req->email }}" class="btn btn-ghost btn-sm" title="Enviar email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $requests->links() }}
        </div>
        @endif
        @endif
    </div>

    {{-- MODAL: VER DETALLE --}}
    <template x-teleport="body">
        <div x-show="viewOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="viewOpen = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg z-10 overflow-hidden"
                 @click.away="viewOpen = false" @keydown.escape.window="viewOpen = false">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-slate-900"><i class="fas fa-inbox mr-2 text-violet-500"></i>Detalle de solicitud</h3>
                    <button @click="viewOpen = false" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-600">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
                <div class="px-6 py-5 space-y-4" x-show="current">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Empresa</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5" x-text="current?.company_name"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Contacto</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5" x-text="current?.contact_name"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email</p>
                            <p class="text-sm text-blue-600 mt-0.5" x-text="current?.email"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Teléfono</p>
                            <p class="text-sm text-slate-800 mt-0.5" x-text="current?.phone || '—'"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Empleados</p>
                            <p class="text-sm text-slate-800 mt-0.5" x-text="current?.employees || '—'"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Estado</p>
                            <p class="text-sm font-semibold mt-0.5 capitalize" x-text="current?.status"
                               :class="{'text-amber-600': current?.status==='pending', 'text-emerald-600': current?.status==='approved', 'text-red-600': current?.status==='rejected'}"></p>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Mensaje</p>
                        <div class="mt-1.5 p-3 bg-slate-50 rounded-xl text-sm text-slate-700 min-h-[50px]" x-text="current?.message || 'Sin mensaje'"></div>
                    </div>
                    <div x-show="current?.admin_notes">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Notas del admin</p>
                        <div class="mt-1.5 p-3 bg-amber-50 rounded-xl text-sm text-amber-800" x-text="current?.admin_notes"></div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 flex justify-end">
                    <button @click="viewOpen = false" class="btn btn-secondary btn-sm">Cerrar</button>
                </div>
            </div>
        </div>
    </template>

    {{-- MODAL: RECHAZAR --}}
    <template x-teleport="body">
        <div x-show="rejectOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="rejectOpen = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md z-10 overflow-hidden"
                 @click.away="rejectOpen = false" @keydown.escape.window="rejectOpen = false">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-base font-semibold text-slate-900"><i class="fas fa-xmark mr-2 text-red-500"></i>Rechazar solicitud</h3>
                </div>
                <form :action="rejectAction" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <div class="px-6 py-5">
                        <div class="field">
                            <label for="admin_notes" class="field-label">Motivo del rechazo</label>
                            <textarea name="admin_notes" id="admin_notes" rows="4" class="input resize-none" placeholder="Explica el motivo del rechazo (opcional, se enviará por email)"></textarea>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="button" @click="rejectOpen = false" class="btn btn-secondary btn-sm">Cancelar</button>
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-xmark mr-1"></i>Rechazar</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

</x-app-layout>
