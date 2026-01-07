<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncJornada - Gestión Inteligente del Tiempo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    <h1 class="text-2xl font-bold text-gray-900">SyncJornada</h1>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="#features" class="text-gray-600 hover:text-blue-600 transition">Características</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-blue-600 transition">Cómo Funciona</a>
                    <a href="#pricing" class="text-gray-600 hover:text-blue-600 transition">Tarifas</a>
                    <a href="#benefits" class="text-gray-600 hover:text-blue-600 transition">Beneficios</a>
                </nav>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-chart-line mr-2"></i>Mi Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h2 class="text-5xl md:text-6xl font-bold mb-6">
                    Gestión Inteligente del Tiempo Laboral
                </h2>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    Registra, analiza y optimiza tu jornada laboral con SyncJornada. 
                    La herramienta perfecta para profesionales y equipos.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-50 transition">
                            <i class="fas fa-chart-line mr-2"></i>Ir a mi Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-50 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                        </a>
                    @endauth
                    <a href="#features" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition">
                        <i class="fas fa-info-circle mr-2"></i>Saber Más
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Características Principales</h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Todo lo que necesitas para gestionar tu tiempo de forma eficiente
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Registro de Tiempo</h4>
                    <p class="text-gray-600">
                        Registra tus horas de trabajo de forma manual o automática. Inicia y detén el cronómetro con un solo clic.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Análisis y Reportes</h4>
                    <p class="text-gray-600">
                        Visualiza estadísticas detalladas, gráficos y reportes personalizados de tu productividad diaria, semanal y mensual.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-project-diagram text-purple-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Gestión por Proyectos</h4>
                    <p class="text-gray-600">
                        Organiza tu tiempo por proyectos o tareas. Asigna categorías y etiquetas para un mejor control.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-alt text-red-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Calendario Integrado</h4>
                    <p class="text-gray-600">
                        Vista de calendario completa para revisar tu historial y planificar tu jornada laboral.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-file-export text-yellow-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Exportación de Datos</h4>
                    <p class="text-gray-600">
                        Exporta tus registros en múltiples formatos (PDF, Excel, CSV) para facturación o reportes externos.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-alt text-indigo-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Multiplataforma</h4>
                    <p class="text-gray-600">
                        Accede desde cualquier dispositivo: computadora, tablet o móvil. Tus datos siempre sincronizados.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-gray-900 mb-4">¿Cómo Funciona?</h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Tres pasos simples para empezar a gestionar tu tiempo
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        1
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Registra tu Tiempo</h4>
                    <p class="text-gray-600 text-lg">
                        Inicia el cronómetro cuando comiences a trabajar. Añade una descripción y selecciona el proyecto.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        2
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Revisa y Analiza</h4>
                    <p class="text-gray-600 text-lg">
                        Consulta tus registros históricos, visualiza gráficos y analiza en qué inviertes tu tiempo.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        3
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Exporta y Optimiza</h4>
                    <p class="text-gray-600 text-lg">
                        Genera reportes para facturación u optimiza tu productividad con base en los datos recopilados.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-4xl font-bold text-gray-900 mb-6">¿Por qué elegir SyncJornada?</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Aumenta tu Productividad</h4>
                                <p class="text-gray-600">
                                    Identifica patrones de trabajo, elimina distracciones y enfócate en lo que realmente importa.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Facturación Precisa</h4>
                                <p class="text-gray-600">
                                    Si trabajas por horas, mantén un registro exacto para facturar correctamente a tus clientes.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Colaboración en Equipo</h4>
                                <p class="text-gray-600">
                                    Perfecto para equipos que necesitan coordinar horarios y compartir información de proyectos.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-red-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Seguridad y Privacidad</h4>
                                <p class="text-gray-600">
                                    Tus datos están protegidos con encriptación y respaldos automáticos. Total privacidad garantizada.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-2xl">
                    <div class="mb-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">Ideal para:</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-briefcase text-blue-600 mr-3"></i>
                                <span class="font-medium">Freelancers y Consultores</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-laptop-code text-blue-600 mr-3"></i>
                                <span class="font-medium">Desarrolladores y Diseñadores</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-user-tie text-blue-600 mr-3"></i>
                                <span class="font-medium">Profesionales Independientes</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-building text-blue-600 mr-3"></i>
                                <span class="font-medium">Pequeñas y Medianas Empresas</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-chart-pie text-blue-600 mr-3"></i>
                                <span class="font-medium">Equipos Remotos</span>
                            </li>
                        </ul>
                    </div>
                    <div class="border-t pt-6 mt-6">
                        <p class="text-gray-600 text-center italic">
                            "SyncJornada me ha permitido tener un control total sobre mi tiempo y mejorar mi facturación."
                        </p>
                        <p class="text-gray-900 font-semibold text-center mt-2">
                            - Usuario Satisfecho
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Tarifas Transparentes y Accesibles</h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Precios justos para empresas de todos los tamaños. Sin costes ocultos, sin permanencia.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Plan Micro -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-8 hover:shadow-2xl transition-all hover:-translate-y-2">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <i class="fas fa-user text-blue-600 text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Micro</h4>
                        <p class="text-gray-600 text-sm">Para pequeños equipos</p>
                    </div>
                    
                    <div class="text-center mb-6">
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-bold text-gray-900">€9</span>
                            <span class="text-gray-600 ml-2">/mes</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">1-5 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Hasta 5 usuarios</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Registro de tiempo ilimitado</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Reportes básicos</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Soporte por email</span>
                        </li>
                    </ul>

                    <a href="{{ route('company-request.create') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 rounded-lg transition">
                        Solicitar
                    </a>
                </div>

                <!-- Plan Pequeña - POPULAR -->
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-2xl border-2 border-blue-600 p-8 relative transform lg:-translate-y-4 hover:shadow-3xl transition-all">
                    <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 text-xs font-bold px-4 py-1 rounded-bl-lg rounded-tr-lg">
                        POPULAR
                    </div>
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-2">Pequeña</h4>
                        <p class="text-blue-100 text-sm">Equipos en crecimiento</p>
                    </div>
                    
                    <div class="text-center mb-6">
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-bold text-white">€19</span>
                            <span class="text-blue-100 ml-2">/mes</span>
                        </div>
                        <p class="text-sm text-blue-200 mt-2">6-15 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Hasta 15 usuarios</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Todo lo del plan Micro</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Reportes avanzados</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Exportación de datos</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Soporte prioritario</span>
                        </li>
                    </ul>

                    <a href="{{ route('company-request.create') }}" class="block w-full bg-white hover:bg-gray-100 text-blue-600 text-center font-semibold py-3 rounded-lg transition">
                        Solicitar
                    </a>
                </div>

                <!-- Plan Mediana -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-8 hover:shadow-2xl transition-all hover:-translate-y-2">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                            <i class="fas fa-building text-purple-600 text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Mediana</h4>
                        <p class="text-gray-600 text-sm">Empresas consolidadas</p>
                    </div>
                    
                    <div class="text-center mb-6">
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-bold text-gray-900">€39</span>
                            <span class="text-gray-600 ml-2">/mes</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">16-50 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Hasta 50 usuarios</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Todo lo del plan Pequeña</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">API de integración</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Roles personalizados</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Soporte telefónico</span>
                        </li>
                    </ul>

                    <a href="{{ route('company-request.create') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center font-semibold py-3 rounded-lg transition">
                        Solicitar
                    </a>
                </div>

                <!-- Plan Empresa -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200 p-8 hover:shadow-2xl transition-all hover:-translate-y-2">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                            <i class="fas fa-city text-indigo-600 text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Empresa</h4>
                        <p class="text-gray-600 text-sm">Grandes organizaciones</p>
                    </div>
                    
                    <div class="text-center mb-6">
                        <div class="flex items-baseline justify-center">
                            <span class="text-4xl font-bold text-gray-900">Contactar</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">+50 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Usuarios ilimitados</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Todo lo del plan Mediana</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Gestor de cuenta dedicado</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Personalización completa</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">SLA garantizado</span>
                        </li>
                    </ul>

                    <a href="{{ route('company-request.create') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center font-semibold py-3 rounded-lg transition">
                        Solicitar
                    </a>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-8 max-w-4xl mx-auto">
                <div class="text-center mb-6">
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                        Todos los planes incluyen
                    </h4>
                </div>
                <div class="grid md:grid-cols-3 gap-6 text-center">
                    <div>
                        <i class="fas fa-infinity text-blue-600 text-3xl mb-3"></i>
                        <p class="font-semibold text-gray-900">Registro ilimitado</p>
                        <p class="text-sm text-gray-600">Sin límites de horas o entradas</p>
                    </div>
                    <div>
                        <i class="fas fa-mobile-alt text-blue-600 text-3xl mb-3"></i>
                        <p class="font-semibold text-gray-900">Acceso multiplataforma</p>
                        <p class="text-sm text-gray-600">Web, móvil y tablet</p>
                    </div>
                    <div>
                        <i class="fas fa-lock text-blue-600 text-3xl mb-3"></i>
                        <p class="font-semibold text-gray-900">Seguridad garantizada</p>
                        <p class="text-sm text-gray-600">Encriptación y backups diarios</p>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-gray-700 mb-4">
                        <i class="fas fa-tag text-blue-600 mr-2"></i>
                        <strong>¿Necesitas más de un plan?</strong> Contacta con nosotros para descuentos por volumen
                    </p>
                    <p class="text-sm text-gray-600">
                        * Los precios no incluyen IVA. Facturación mensual o anual (20% descuento en planes anuales)
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-4xl font-bold mb-6">¿Listo para optimizar tu gestión del tiempo?</h3>
            <p class="text-xl mb-8 text-blue-100">
                Solicita acceso hoy y comienza a tomar el control de tu jornada laboral.
            </p>
            <a href="{{ route('company-request.create') }}" class="inline-block bg-white text-blue-600 px-10 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition transform hover:scale-105">
                <i class="fas fa-rocket mr-2"></i>Solicitar Acceso para mi Empresa
            </a>
            <p class="mt-6 text-blue-200 text-sm">
                Te contactaremos en 1-2 días hábiles
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-clock text-blue-500 text-2xl"></i>
                        <h4 class="text-2xl font-bold text-white">SyncJornada</h4>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        La solución definitiva para la gestión inteligente del tiempo laboral. 
                        Aumenta tu productividad y toma el control de tu jornada.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-4">Producto</h5>
                    <ul class="space-y-2">
                        <li><a href="#features" class="hover:text-white transition">Características</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">Cómo Funciona</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Tarifas</a></li>
                        <li><a href="#benefits" class="hover:text-white transition">Beneficios</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-4">Soporte</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Centro de Ayuda</a></li>
                        <li><a href="#" class="hover:text-white transition">Documentación</a></li>
                        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                        <li><a href="#" class="hover:text-white transition">Estado del Sistema</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p>&copy; 2025 SyncJornada. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>
</html>
