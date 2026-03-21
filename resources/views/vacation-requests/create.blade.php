<x-app-layout>

<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-calendar-plus mr-2 text-blue-600"></i>Nueva solicitud</h1>
        <p class="page-sub">Solicita días de vacaciones o permiso</p>
    </div>
    <a href="{{ route('vacation-requests.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i> Volver
    </a>
</div>

<div class="max-w-xl">
    <div class="card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-umbrella-beach"></i></span>
                <span class="card-title">Datos de la solicitud</span>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('vacation-requests.store') }}" class="space-y-5">
                @csrf

                @if(in_array(Auth::user()->role, ['admin','manager']))
                <div class="field">
                    <label for="user_id" class="field-label">Empleado</label>
                    <select id="user_id" name="user_id" class="select">
                        <option value="{{ Auth::id() }}">{{ Auth::user()->name }} (yo)</option>
                        @if(isset($employees))
                            @foreach($employees as $emp)
                                @if($emp->id !== Auth::id())
                                <option value="{{ $emp->id }}" {{ old('user_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" />
                </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div class="field">
                        <label for="start_date" class="field-label">Fecha inicio</label>
                        <input id="start_date" type="date" name="start_date" value="{{ old('start_date') }}" required
                               class="input" min="{{ now()->format('Y-m-d') }}">
                        <x-input-error :messages="$errors->get('start_date')" />
                    </div>
                    <div class="field">
                        <label for="end_date" class="field-label">Fecha fin</label>
                        <input id="end_date" type="date" name="end_date" value="{{ old('end_date') }}" required
                               class="input" min="{{ now()->format('Y-m-d') }}">
                        <x-input-error :messages="$errors->get('end_date')" />
                    </div>
                </div>

                <div class="field">
                    <label for="type" class="field-label">Tipo</label>
                    <select id="type" name="type" class="select">
                        <option value="vacation" {{ old('type','vacation') === 'vacation' ? 'selected' : '' }}>Vacaciones</option>
                        <option value="personal" {{ old('type') === 'personal' ? 'selected' : '' }}>Permiso personal</option>
                        <option value="sick"     {{ old('type') === 'sick'     ? 'selected' : '' }}>Baja médica</option>
                        <option value="other"    {{ old('type') === 'other'    ? 'selected' : '' }}>Otro</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" />
                </div>

                <div class="field">
                    <label for="reason" class="field-label">Motivo <span class="text-slate-400 font-normal">(opcional)</span></label>
                    <textarea id="reason" name="reason" rows="3" class="input resize-none"
                              placeholder="Describe brevemente el motivo...">{{ old('reason') }}</textarea>
                    <x-input-error :messages="$errors->get('reason')" />
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i> Enviar solicitud
                    </button>
                    <a href="{{ route('vacation-requests.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>
