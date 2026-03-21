<x-guest-layout>
    <div class="mb-7 text-center">
        <h2 class="text-2xl font-bold text-slate-900">Bienvenido de nuevo</h2>
        <p class="text-sm text-slate-500 mt-1">Inicia sesión en tu cuenta</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-5">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="field">
            <label for="email" class="field-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="input {{ $errors->has('email') ? 'border-red-400 bg-red-50' : '' }}"
                   placeholder="tu@empresa.com">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="field">
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="field-label !mb-0">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">¿La olvidaste?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="input {{ $errors->has('password') ? 'border-red-400 bg-red-50' : '' }}"
                   placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <label class="flex items-center gap-2.5 cursor-pointer">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-slate-600">Recordar mi sesión</span>
        </label>

        <button type="submit" class="btn btn-primary w-full btn-lg mt-2">
            <i class="fas fa-right-to-bracket mr-2"></i> Iniciar sesión
        </button>
    </form>

    @if (Route::has('register'))
    <p class="text-center text-sm text-slate-500 mt-6">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700">Regístrate</a>
    </p>
    @endif
</x-guest-layout>
