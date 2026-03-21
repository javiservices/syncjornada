<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-plus mr-2 text-blue-500"></i>Crear empresa</h1>
        <p class="page-sub">Añadir una nueva empresa a la plataforma</p>
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

        <form action="{{ route('companies.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="field">
                    <label for="name" class="field-label">Nombre *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="input" required placeholder="Nombre de la empresa">
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="cif" class="field-label">CIF</label>
                    <input type="text" name="cif" id="cif" value="{{ old('cif') }}" class="input" placeholder="A12345678">
                    @error('cif')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="email" class="field-label">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="input" required placeholder="empresa@email.com">
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="phone" class="field-label">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="input" placeholder="+34 600 000 000">
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field md:col-span-2">
                    <label for="address" class="field-label">Dirección</label>
                    <textarea name="address" id="address" rows="2" class="input resize-none" placeholder="Dirección completa">{{ old('address') }}</textarea>
                    @error('address')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="timezone" class="field-label">Zona horaria</label>
                    <select name="timezone" id="timezone" class="select">
                        <option value="Europe/Madrid" selected>Europa/Madrid (GMT+1)</option>
                        <option value="Europe/London" {{ old('timezone') == 'Europe/London' ? 'selected' : '' }}>Europa/Londres (GMT+0)</option>
                        <option value="America/New_York" {{ old('timezone') == 'America/New_York' ? 'selected' : '' }}>América/Nueva York (GMT-5)</option>
                        <option value="America/Los_Angeles" {{ old('timezone') == 'America/Los_Angeles' ? 'selected' : '' }}>América/Los Ángeles (GMT-8)</option>
                        <option value="America/Mexico_City" {{ old('timezone') == 'America/Mexico_City' ? 'selected' : '' }}>América/Ciudad de México (GMT-6)</option>
                        <option value="America/Argentina/Buenos_Aires" {{ old('timezone') == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }}>América/Buenos Aires (GMT-3)</option>
                        <option value="UTC" {{ old('timezone') == 'UTC' ? 'selected' : '' }}>UTC (GMT+0)</option>
                    </select>
                    @error('timezone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Crear empresa</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
