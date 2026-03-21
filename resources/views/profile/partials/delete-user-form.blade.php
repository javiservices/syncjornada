<div class="card border-red-100">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-red-50 text-red-600"><i class="fas fa-triangle-exclamation"></i></span>
            <span class="card-title text-red-600">Zona de peligro</span>
        </div>
    </div>
    <div class="card-body">
        <p class="text-sm text-slate-600 mb-5 leading-relaxed">
            Al eliminar tu cuenta se borrarán permanentemente todos tus datos y registros de jornada.
            Esta acción es irreversible y no podrá deshacerse.
        </p>

        <button
            x-data
            @click="$dispatch('open-modal', 'confirm-user-deletion')"
            class="btn btn-danger">
            <i class="fas fa-trash mr-2"></i> Eliminar mi cuenta
        </button>
    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-2">¿Eliminar cuenta?</h2>
        <p class="text-sm text-slate-600 mb-5">
            Escribe tu contraseña para confirmar la eliminación permanente de tu cuenta y todos tus datos.
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
            @csrf @method('delete')
            <div class="field">
                <label for="password_delete" class="field-label">Contraseña</label>
                <input id="password_delete" name="password" type="password" class="input" placeholder="Tu contraseña actual">
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash mr-2"></i> Eliminar permanentemente
                </button>
                <button type="button" x-on:click="$dispatch('close')" class="btn btn-secondary">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</x-modal>
