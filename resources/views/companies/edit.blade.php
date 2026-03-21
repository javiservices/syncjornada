<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-pen mr-2 text-blue-500"></i>Editar empresa</h1>
        <p class="page-sub">{{ $company->name }}</p>
    </div>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

{{-- FORMULARIO --}}
<div class="card max-w-3xl">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-building"></i></span>
            <span class="card-title">Datos de la empresa</span>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-error mb-5">
            <i class="fas fa-circle-exclamation flex-shrink-0"></i>
            <div>
                <p class="font-semibold">Errores de validación:</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ route('companies.update', $company->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="field">
                    <label for="name" class="field-label">Nombre *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" class="input" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="cif" class="field-label">CIF</label>
                    <input type="text" name="cif" id="cif" value="{{ old('cif', $company->cif) }}" class="input" placeholder="A12345678">
                    @error('cif')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="email" class="field-label">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}" class="input" required>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="phone" class="field-label">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $company->phone) }}" class="input">
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field md:col-span-2">
                    <label for="address" class="field-label">Dirección</label>
                    <textarea name="address" id="address" rows="2" class="input resize-none">{{ old('address', $company->address) }}</textarea>
                    @error('address')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="timezone" class="field-label">Zona horaria</label>
                    <select name="timezone" id="timezone" class="select">
                        <option value="Europe/Madrid" {{ old('timezone', $company->timezone) == 'Europe/Madrid' ? 'selected' : '' }}>Europa/Madrid (GMT+1)</option>
                        <option value="Europe/London" {{ old('timezone', $company->timezone) == 'Europe/London' ? 'selected' : '' }}>Europa/Londres (GMT+0)</option>
                        <option value="America/New_York" {{ old('timezone', $company->timezone) == 'America/New_York' ? 'selected' : '' }}>América/Nueva York (GMT-5)</option>
                        <option value="America/Los_Angeles" {{ old('timezone', $company->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>América/Los Ángeles (GMT-8)</option>
                        <option value="America/Mexico_City" {{ old('timezone', $company->timezone) == 'America/Mexico_City' ? 'selected' : '' }}>América/Ciudad de México (GMT-6)</option>
                        <option value="America/Argentina/Buenos_Aires" {{ old('timezone', $company->timezone) == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }}>América/Buenos Aires (GMT-3)</option>
                        <option value="UTC" {{ old('timezone', $company->timezone) == 'UTC' ? 'selected' : '' }}>UTC (GMT+0)</option>
                    </select>
                    @error('timezone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Notificaciones --}}
            <div class="border-t border-slate-100 pt-5">
                <h3 class="text-sm font-semibold text-slate-800 mb-4"><i class="fas fa-bell mr-1.5 text-blue-500"></i>Configuración de notificaciones</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="enable_checkin_notifications" value="1" {{ old('enable_checkin_notifications', $company->enable_checkin_notifications ?? true) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm font-medium text-slate-700">Recordatorio de entrada</span>
                        </label>
                        <div class="field">
                            <label for="checkin_notification_time" class="field-label text-xs">Hora</label>
                            <input type="time" name="checkin_notification_time" id="checkin_notification_time" value="{{ old('checkin_notification_time', $company->checkin_notification_time ?? '08:00') }}" class="input input-sm">
                            <p class="field-hint">Email a empleados que no hayan fichado</p>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="enable_checkout_notifications" value="1" {{ old('enable_checkout_notifications', $company->enable_checkout_notifications ?? true) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm font-medium text-slate-700">Recordatorio de salida</span>
                        </label>
                        <div class="field">
                            <label for="checkout_notification_time" class="field-label text-xs">Hora</label>
                            <input type="time" name="checkout_notification_time" id="checkout_notification_time" value="{{ old('checkout_notification_time', $company->checkout_notification_time ?? '19:00') }}" class="input input-sm">
                            <p class="field-hint">Email a empleados con fichaje sin cerrar</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Actualizar</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
