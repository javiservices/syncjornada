<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Crear Cuenta</h2>
        <p class="text-gray-600 mt-2">Regístrate para comenzar a gestionar tu tiempo</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre Completo')" class="text-gray-700 font-semibold" />
            <x-text-input 
                id="name" 
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Juan Pérez" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-semibold" />
            <x-text-input 
                id="email" 
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username"
                placeholder="tu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-semibold" />
            <x-text-input 
                id="password" 
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                type="password"
                name="password"
                required 
                autocomplete="new-password"
                placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-700 font-semibold" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Repite tu contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" name="terms" type="checkbox" required class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 transition">
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-700">
                    Acepto los <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Términos y Condiciones</a> y la <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Política de Privacidad</a>
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-[1.02]">
                <i class="fas fa-user-plus mr-2"></i>
                Crear Cuenta
            </button>
        </div>

        <!-- Social Register (Optional) -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">O regístrate con</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button type="button" class="flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fab fa-google text-red-500 mr-2"></i>
                Google
            </button>
            <button type="button" class="flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fab fa-github mr-2"></i>
                GitHub
            </button>
        </div>

        <div class="text-center text-sm text-gray-600 mt-6">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition">
                Inicia sesión
            </a>
        </div>
    </form>
</x-guest-layout>
