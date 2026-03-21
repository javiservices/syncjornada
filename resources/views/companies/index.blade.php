<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-building mr-2 text-blue-500"></i>Empresas</h1>
        <p class="page-sub">Gestión de empresas registradas en la plataforma</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('companies.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva empresa
    </a>
    @endif
</div>

{{-- FILTROS (solo admin) --}}
@if(auth()->user()->role === 'admin')
<div class="filter-bar">
    <form method="GET" class="filter-bar-body">
        <div class="filter-field flex-1 min-w-[160px]">
            <label class="filter-label">Nombre</label>
            <input type="text" name="name" value="{{ request('name') }}" class="input input-sm" placeholder="Buscar empresa...">
        </div>
        <div class="filter-field flex-1 min-w-[160px]">
            <label class="filter-label">Email</label>
            <input type="text" name="email" value="{{ request('email') }}" class="input input-sm" placeholder="Email...">
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search mr-1"></i>Filtrar</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm">Limpiar</a>
        </div>
    </form>
</div>
@endif

{{-- TABLA --}}
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-list"></i></span>
            <span class="card-title">Listado de empresas</span>
        </div>
        <span class="badge badge-blue">{{ $companies->total() }} {{ $companies->total() === 1 ? 'empresa' : 'empresas' }}</span>
    </div>
    <div class="card-body p-0">
        @if($companies->count() > 0)
        <div class="tbl-wrap border-0 rounded-none shadow-none">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <td class="font-semibold text-slate-900">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-building text-blue-500 text-xs"></i>
                                </div>
                                {{ $company->name }}
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $company->email }}" class="text-blue-600 hover:underline">{{ $company->email }}</a>
                        </td>
                        <td>{{ $company->phone ?: '—' }}</td>
                        <td class="max-w-[200px] truncate">{{ $company->address ?: '—' }}</td>
                        <td>
                            <div class="tbl-actions justify-end">
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-ghost btn-sm" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-ghost btn-sm" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @if(auth()->user()->role === 'admin')
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta empresa?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-red-500 hover:text-red-700 hover:bg-red-50" title="Eliminar">
                                        <i class="fas fa-trash"></i>
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
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $companies->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-building"></i></div>
            <p class="empty-title">Sin empresas</p>
            <p class="empty-text">No se encontraron empresas con los filtros actuales.</p>
        </div>
        @endif
    </div>
</div>

</x-app-layout>
