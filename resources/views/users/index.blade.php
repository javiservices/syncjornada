<x-app-layout>

<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-users mr-2 text-blue-600"></i>Usuarios</h1>
        <p class="page-sub">Gestión de empleados y accesos</p>
    </div>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus mr-2"></i> Nuevo usuario
    </a>
    @endif
</div>

{{-- FILTERS --}}
<div class="filter-bar mb-6">
    <form method="GET" action="{{ route('users.index') }}" class="filter-bar-body">
        <div class="filter-field">
            <label class="filter-label">Rol</label>
            <select name="role" class="select input-sm" onchange="this.form.submit()">
                <option value="">Todos los roles</option>
                <option value="employee" {{ request('role') === 'employee' ? 'selected' : '' }}>Empleado</option>
                <option value="manager"  {{ request('role') === 'manager'  ? 'selected' : '' }}>Manager</option>
                <option value="admin"    {{ request('role') === 'admin'    ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        @if(Auth::user()->role === 'admin' && isset($companies))
        <div class="filter-field">
            <label class="filter-label">Empresa</label>
            <select name="company_id" class="select input-sm" onchange="this.form.submit()">
                <option value="">Todas las empresas</option>
                @foreach($companies as $co)
                <option value="{{ $co->id }}" {{ request('company_id') == $co->id ? 'selected' : '' }}>{{ $co->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @if(request()->hasAny(['role','company_id']))
        <div class="flex items-end">
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-xmark mr-1.5"></i> Limpiar
            </a>
        </div>
        @endif
    </form>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($users->count() > 0)
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Empresa</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php
                        $initials = collect(explode(' ',$user->name))->take(2)->map(fn($w)=>strtoupper($w[0]))->implode('');
                        $roleMap = ['admin'=>'badge-indigo','manager'=>'badge-purple','employee'=>'badge-blue'];
                        $roleLabel = ['admin'=>'Admin','manager'=>'Manager','employee'=>'Empleado'];
                    @endphp
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">{{ $initials }}</div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-slate-600">{{ $user->company?->name ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $roleMap[$user->role] ?? 'badge-gray' }}">
                                {{ $roleLabel[$user->role] ?? $user->role }}
                            </span>
                        </td>
                        <td class="text-sm text-slate-500">{{ $user->created_at->isoFormat('D MMM YYYY') }}</td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="badge badge-green"><i class="fas fa-circle-check mr-1"></i>Verificado</span>
                            @else
                                <span class="badge badge-orange"><i class="fas fa-clock mr-1"></i>Pendiente</span>
                            @endif
                        </td>
                        <td>
                            <div class="tbl-actions">
                                <a href="{{ route('users.show', $user) }}" class="btn btn-ghost btn-sm" title="Ver perfil">
                                    <i class="fas fa-eye text-slate-400"></i>
                                </a>
                                @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'manager' && $user->role === 'employee'))
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-ghost btn-sm" title="Editar">
                                    <i class="fas fa-pen text-slate-400"></i>
                                </a>
                                @endif
                                @if(Auth::user()->role === 'admin' && $user->id !== Auth::id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('¿Eliminar a {{ addslashes($user->name) }}?')">
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

        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $users->withQueryString()->links() }}
        </div>
        @endif

        @else
        <div class="empty-state py-16">
            <div class="empty-icon"><i class="fas fa-users"></i></div>
            <p class="empty-title">Sin usuarios</p>
            <p class="empty-text">No se encontraron usuarios con los filtros aplicados.</p>
        </div>
        @endif
    </div>
</div>

</x-app-layout>
