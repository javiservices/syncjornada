<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-building mr-2 text-blue-500"></i>{{ $company->name }}</h1>
        <p class="page-sub">Información y configuración de la empresa</p>
    </div>
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">
        <i class="fas fa-pen"></i> Editar empresa
    </a>
    @endif
</div>

{{-- ESTADÍSTICAS --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="stat-card">
        <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-users"></i></div>
        <div>
            <p class="stat-val">{{ $company->users->count() }}</p>
            <p class="stat-lbl">Usuarios totales</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-emerald-100 text-emerald-600"><i class="fas fa-user-tie"></i></div>
        <div>
            <p class="stat-val">{{ $company->users->where('role', 'manager')->count() }}</p>
            <p class="stat-lbl">Managers</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-violet-100 text-violet-600"><i class="fas fa-user"></i></div>
        <div>
            <p class="stat-val">{{ $company->users->where('role', 'employee')->count() }}</p>
            <p class="stat-lbl">Empleados</p>
        </div>
    </div>
</div>

{{-- DATOS DE LA EMPRESA --}}
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-slate-100 text-slate-500"><i class="fas fa-info-circle"></i></span>
            <span class="card-title">Datos de la empresa</span>
        </div>
    </div>
    <div class="card-body">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Nombre</p>
                <p class="text-sm font-medium text-slate-800">{{ $company->name }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Email</p>
                <p class="text-sm"><a href="mailto:{{ $company->email }}" class="text-blue-600 hover:underline"><i class="fas fa-envelope mr-1 text-xs"></i>{{ $company->email }}</a></p>
            </div>
            @if($company->cif)
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">CIF</p>
                <p class="text-sm font-medium text-slate-800">{{ $company->cif }}</p>
            </div>
            @endif
            @if($company->phone)
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Teléfono</p>
                <p class="text-sm"><a href="tel:{{ $company->phone }}" class="text-blue-600 hover:underline"><i class="fas fa-phone mr-1 text-xs"></i>{{ $company->phone }}</a></p>
            </div>
            @endif
            @if($company->address)
            <div class="md:col-span-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Dirección</p>
                <p class="text-sm text-slate-800"><i class="fas fa-map-marker-alt mr-1 text-slate-400 text-xs"></i>{{ $company->address }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- CONFIGURACIÓN DE VACACIONES --}}
@if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-amber-50 text-amber-600"><i class="fas fa-umbrella-beach"></i></span>
            <span class="card-title">Configuración de vacaciones</span>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('companies.update-vacation-settings', $company->id) }}">
            @csrf @method('PATCH')

            {{-- Días laborables --}}
            <div class="mb-6">
                <label class="field-label mb-3">Días laborables</label>
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2">
                    @php
                        $days = [1=>'Lunes',2=>'Martes',3=>'Miércoles',4=>'Jueves',5=>'Viernes',6=>'Sábado',0=>'Domingo'];
                        $workingDays = $company->working_days ?? [1,2,3,4,5];
                    @endphp
                    @foreach($days as $value => $label)
                    <label class="flex items-center gap-2 p-3 rounded-xl border cursor-pointer hover:bg-slate-50 transition-colors {{ in_array($value, $workingDays) ? 'bg-blue-50 border-blue-200' : 'border-slate-200' }}">
                        <input type="checkbox" name="working_days[]" value="{{ $value }}" {{ in_array($value, $workingDays) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
                <p class="field-hint mt-2">Selecciona los días laborables de la empresa</p>
            </div>

            {{-- Festivos --}}
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <label class="field-label">Festivos de la empresa</label>
                    <button type="button" onclick="addHoliday()" class="btn btn-ghost btn-sm text-blue-600">
                        <i class="fas fa-plus mr-1"></i>Añadir festivo
                    </button>
                </div>
                <div id="holidays-container" class="space-y-2">
                    @foreach($company->holidays as $holiday)
                    <div class="flex gap-2 items-center holiday-row">
                        <input type="hidden" name="holidays[{{ $loop->index }}][id]" value="{{ $holiday->id }}">
                        <input type="text" name="holidays[{{ $loop->index }}][name]" value="{{ $holiday->name }}" placeholder="Nombre del festivo" class="input input-sm flex-1">
                        <input type="date" name="holidays[{{ $loop->index }}][date]" value="{{ $holiday->date->format('Y-m-d') }}" class="input input-sm flex-1">
                        <button type="button" onclick="removeHoliday(this)" class="btn btn-ghost btn-sm text-red-500 hover:bg-red-50">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <p class="field-hint mt-2">Los festivos no se contarán como días laborables en las vacaciones</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Guardar configuración</button>
            </div>
        </form>
    </div>
</div>
@endif

{{-- USUARIOS --}}
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-indigo-50 text-indigo-600"><i class="fas fa-users"></i></span>
            <span class="card-title">Usuarios de la empresa</span>
        </div>
        <span class="badge badge-blue">{{ $company->users->count() }}</span>
    </div>
    <div class="card-body p-0">
        @if($company->users->isEmpty())
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-users"></i></div>
            <p class="empty-title">Sin usuarios</p>
            <p class="empty-text">Esta empresa aún no tiene usuarios asignados.</p>
        </div>
        @else
        <div class="tbl-wrap border-0 rounded-none shadow-none">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-medium text-slate-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-slate-600">{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-indigo"><i class="fas fa-shield-halved mr-1"></i>Admin</span>
                            @elseif($user->role === 'manager')
                                <span class="badge badge-purple"><i class="fas fa-user-tie mr-1"></i>Manager</span>
                            @else
                                <span class="badge badge-blue"><i class="fas fa-user mr-1"></i>Empleado</span>
                            @endif
                        </td>
                        <td><span class="badge badge-green"><i class="fas fa-check-circle mr-1"></i>Activo</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    let holidayIndex = {{ $company->holidays->count() }};
    function addHoliday() {
        const c = document.getElementById('holidays-container');
        const row = document.createElement('div');
        row.className = 'flex gap-2 items-center holiday-row';
        row.innerHTML = `
            <input type="text" name="holidays[${holidayIndex}][name]" placeholder="Nombre del festivo" class="input input-sm flex-1" required>
            <input type="date" name="holidays[${holidayIndex}][date]" class="input input-sm flex-1" required>
            <button type="button" onclick="removeHoliday(this)" class="btn btn-ghost btn-sm text-red-500 hover:bg-red-50"><i class="fas fa-trash"></i></button>`;
        c.appendChild(row);
        holidayIndex++;
    }
    function removeHoliday(btn) { btn.closest('.holiday-row').remove(); }
</script>
@endpush

</x-app-layout>
