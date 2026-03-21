<x-guest-layout>
    <div class="mb-7 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Crear cuenta</h2>
        <p class="text-sm text-slate-500 mt-1">Regístrate para empezar a usar SyncJornada</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="field">
            <label for="name" class="field-label">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="input" placeholder="Juan García">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="field">
            <label for="email" class="field-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="input" placeholder="tu@empresa.com">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="field">
            <label for="password" class="field-label">Contraseña</label>
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

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <label class="flex items-start gap-2.5 cursor-pointer">
            <input type="checkbox" name="terms" id="terms" required class="mt-0.5 w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-slate-600">
                Acepto los <a href="{{ route('terms.show') }}" target="_blank" class="text-blue-600 hover:underline">Términos de servicio</a>
                y la <a href="{{ route('policy.show') }}" target="_blank" class="text-blue-600 hover:underline">Política de privacidad</a>
            </span>
        </label>
        <x-input-error :messages="$errors->get('terms')" />
        @endif

        <button type="submit" class="btn btn-primary w-full btn-lg mt-2">
            <i class="fas fa-user-plus mr-2"></i> Crear cuenta
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">Inicia sesión</a>
    </p>
</x-guest-layout>
