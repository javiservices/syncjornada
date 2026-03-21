<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-amber-50 text-amber-600"><i class="fas fa-lock"></i></span>
            <span class="card-title">Cambiar contraseña</span>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('put')

            <div class="field">
                <label for="current_password" class="field-label">Contraseña actual</label>
                <input id="current_password" name="current_password" type="password" class="input" autocomplete="current-password" placeholder="••••••••">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div class="field">
                <label for="password" class="field-label">Nueva contraseña</label>
                <input id="password" name="password" type="password" class="input" autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                <x-input-error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="field">
                <label for="password_confirmation" class="field-label">Confirmar nueva contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="input" autocomplete="new-password" placeholder="Repite la contraseña">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            <div class="flex items-center gap-4 pt-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-key mr-2"></i> Actualizar contraseña
                </button>
                @if (session('status') === 'password-updated')
                <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2500)"
                   class="text-sm text-emerald-600 font-medium flex items-center gap-1.5">
                    <i class="fas fa-circle-check"></i> Contraseña actualizada
                </p>
                @endif
            </div>
        </form>
    </div>
</div>
