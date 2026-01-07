<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Acceso - SyncJornada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="/" class="flex items-center space-x-2">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    <h1 class="text-2xl font-bold text-gray-900">SyncJornada</h1>
                </a>
                <a href="/" class="text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al inicio
                </a>
            </div>
        </div>
    </header>

    <!-- Form Section -->
    <section class="py-12 sm:py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-building text-blue-600 text-2xl"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
                    Solicita Acceso para tu Empresa
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Completa el formulario y nos pondremos en contacto contigo para configurar SyncJornada para tu equipo.
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-3"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Por favor corrige los siguientes errores:</h4>
                                <ul class="list-disc list-inside text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('company-request.store') }}" class="space-y-6">
                    @csrf

                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building mr-2 text-blue-600"></i>Nombre de la Empresa *
                        </label>
                        <input 
                            type="text" 
                            id="company_name" 
                            name="company_name" 
                            value="{{ old('company_name') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Ej: Tecnologías ABC S.A."
                        >
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Name -->
                    <div>
                        <label for="contact_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Nombre de Contacto *
                        </label>
                        <input 
                            type="text" 
                            id="contact_name" 
                            name="contact_name" 
                            value="{{ old('contact_name') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Tu nombre completo"
                        >
                        @error('contact_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email and Phone -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-blue-600"></i>Correo Electrónico *
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="contacto@empresa.com"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2 text-blue-600"></i>Teléfono
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="+34 123 456 789"
                            >
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Plan Selection -->
                    <div>
                        <label for="plan" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-blue-600"></i>Plan Deseado *
                        </label>
                        <select 
                            id="plan" 
                            name="plan"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        >
                            <option value="">Selecciona un plan</option>
                            <option value="micro" {{ old('plan') == 'micro' ? 'selected' : '' }}>
                                Plan Micro - €9/mes (1-5 empleados)
                            </option>
                            <option value="pequeña" {{ old('plan') == 'pequeña' ? 'selected' : '' }}>
                                Plan Pequeña - €19/mes (6-15 empleados)
                            </option>
                            <option value="mediana" {{ old('plan') == 'mediana' ? 'selected' : '' }}>
                                Plan Mediana - €39/mes (16-50 empleados)
                            </option>
                            <option value="empresa" {{ old('plan') == 'empresa' ? 'selected' : '' }}>
                                Plan Empresa - Precio personalizado (+50 empleados)
                            </option>
                        </select>
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Puedes cambiar de plan en cualquier momento
                        </p>
                        @error('plan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-comment-dots mr-2 text-blue-600"></i>Mensaje Adicional
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                            placeholder="Cuéntanos sobre las necesidades de tu empresa..."
                        >{{ old('message') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">
                            Opcional: Cuéntanos más sobre tu empresa y cómo planeas usar SyncJornada
                        </p>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Information Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">¿Qué sucede después?</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Revisaremos tu solicitud en 1-2 días hábiles</li>
                                    <li>Te contactaremos para coordinar la configuración</li>
                                    <li>Crearemos tu empresa y usuario administrador</li>
                                    <li>Te proporcionaremos las credenciales de acceso</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Solicitud
                        </button>
                    </div>

                    <p class="text-center text-sm text-gray-500">
                        Al enviar este formulario, aceptas que nos pongamos en contacto contigo para configurar tu cuenta.
                    </p>
                </form>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    ¿Tienes preguntas? 
                    <a href="mailto:soporte@syncjornada.com" class="text-blue-600 hover:text-blue-700 font-semibold">
                        Contáctanos
                    </a>
                </p>
            </div>
        </div>
    </section>
</body>
</html>
