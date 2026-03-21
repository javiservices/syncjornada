<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-blue-50 text-blue-600"><i class="fas fa-id-card"></i></span>
            <span class="card-title">Información personal</span>
        </div>
    </div>
    <div class="card-body">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('patch')

            <div class="field">
                <label for="name" class="field-label">Nombre completo</label>
                <input id="name" name="name" type="text" class="input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Tu nombre completo">
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="field">
                <label for="email" class="field-label">Correo electrónico</label>
                <input id="email" name="email" type="email" class="input" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="tu@email.com">
                <x-input-error :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <p class="text-sm">
                        Tu correo no está verificado.
                        <button form="send-verification" class="underline font-semibold ml-1">Reenviar verificación</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                    <p class="text-sm font-medium text-green-700 mt-1">Enlace de verificación enviado.</p>
                    @endif
                </div>
                @endif
            </div>

            <div class="field">
                <label for="nif" class="field-label">DNI / NIE <span class="text-slate-400 font-normal">(opcional)</span></label>
                <input id="nif" name="nif" type="text" class="input" value="{{ old('nif', $user->nif) }}" placeholder="12345678Z" autocomplete="off">
                <p class="field-hint">Se almacena cifrado conforme al RGPD Art. 32.</p>
                <x-input-error :messages="$errors->get('nif')" />
            </div>

            <div class="flex items-center gap-4 pt-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-floppy-disk mr-2"></i> Guardar cambios
                </button>
                @if (session('status') === 'profile-updated')
                <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2500)"
                   class="text-sm text-emerald-600 font-medium flex items-center gap-1.5">
                    <i class="fas fa-circle-check"></i> Guardado correctamente
                </p>
                @endif
            </div>
        </form>
    </div>
</div>
