<x-guest-layout>
    <div class="mb-7 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Nueva contraseña</h2>
        <p class="text-sm text-slate-500 mt-1">Establece una nueva contraseña para tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field">
            <label for="email" class="field-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autocomplete="username"
                   class="input">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="field">
            <label for="password" class="field-label">Nueva contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="input" placeholder="Mínimo 8 caracteres">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="field">
            <label for="password_confirmation" class="field-label">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="input" placeholder="Repite la contraseña">
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn btn-primary w-full btn-lg mt-2">
            <i class="fas fa-key mr-2"></i> Restablecer contraseña
        </button>
    </form>
</x-guest-layout>
