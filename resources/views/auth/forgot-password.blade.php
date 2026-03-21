<x-guest-layout>
    <div class="mb-7 text-center">
        <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-lock-open text-blue-600 text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-slate-900">Recuperar contraseña</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Escribe tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-5">
            <i class="fas fa-circle-check mr-2"></i> {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div class="field">
            <label for="email" class="field-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="input" placeholder="tu@empresa.com">
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <button type="submit" class="btn btn-primary w-full btn-lg mt-2">
            <i class="fas fa-paper-plane mr-2"></i> Enviar enlace de recuperación
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1 text-xs"></i> Volver al inicio de sesión
        </a>
    </p>
</x-guest-layout>
