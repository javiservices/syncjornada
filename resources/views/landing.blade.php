<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>SyncJornada - Software de Registro de Jornada Laboral | Cumple RD 8/2019</title>
    <meta name="description" content="Software de registro de jornada laboral homologado según Real Decreto-ley 8/2019. Control horario digital con geolocalización, auditoría y exportación oficial para Inspección de Trabajo. Desde €5/mes.">
    <meta name="keywords" content="registro jornada laboral, control horario, fichaje digital, RD 8/2019, registro horario obligatorio, software RRHH, control de tiempo, fichaje empleados, cumplimiento laboral España, geolocalización fichaje">
    <meta name="author" content="SyncJornada">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Spanish">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://syncjornada.online/">
    <meta property="og:title" content="SyncJornada - Software de Registro de Jornada Laboral Homologado">
    <meta property="og:description" content="Control horario digital con geolocalización y auditoría. Cumple Real Decreto-ley 8/2019. Desde €5/mes para 1-5 empleados.">
    <meta property="og:image" content="https://syncjornada.online/og-image.jpg">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="SyncJornada">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://syncjornada.online/">
    <meta name="twitter:title" content="SyncJornada - Software de Registro de Jornada Laboral">
    <meta name="twitter:description" content="Control horario digital homologado. Cumple RD 8/2019. Desde €5/mes.">
    <meta name="twitter:image" content="https://syncjornada.online/twitter-image.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://syncjornada.online/">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "SyncJornada",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web, iOS, Android",
      "offers": {
        "@type": "Offer",
        "price": "5.00",
        "priceCurrency": "EUR",
        "priceValidUntil": "2026-12-31",
        "availability": "https://schema.org/InStock",
        "url": "https://syncjornada.online/"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "ratingCount": "127"
      },
      "description": "Software de registro de jornada laboral homologado según Real Decreto-ley 8/2019. Control horario digital con geolocalización, auditoría automática y exportación oficial para Inspección de Trabajo.",
      "url": "https://syncjornada.online",
      "screenshot": "https://syncjornada.online/screenshot.jpg",
      "featureList": [
        "Registro de entrada y salida",
        "Geolocalización GPS automática",
        "Auditoría de modificaciones",
        "Exportación CSV oficial",
        "Cumplimiento RD-ley 8/2019",
        "Retención datos 4 años",
        "Backups automáticos diarios"
      ],
      "provider": {
        "@type": "Organization",
        "name": "SyncJornada",
        "url": "https://syncjornada.online"
      }
    }
    </script>
    
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
                @if(auth()->check())
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-chart-line mr-2"></i>Mi Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Software de Registro de Jornada Laboral Homologado
                </h1>
                <h2 class="text-xl md:text-2xl mb-8 text-blue-100 font-semibold">
                    Control Horario Digital que Cumple Real Decreto-ley 8/2019
                </h2>
                <p class="text-lg md:text-xl mb-8 text-blue-100">
                    Sistema completo de fichaje con geolocalización GPS, auditoría automática y exportación oficial. 
                    Diseñado para PYMES españolas. Desde €5/mes para 1-5 empleados.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if(auth()->check())
                        <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-50 transition">
                            <i class="fas fa-chart-line mr-2"></i>Ir a mi Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-50 transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                        </a>
                    @endif
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
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Funcionalidades Homologadas para Control Horario</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Todas las características exigidas por la legislación española de registro de jornada laboral
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fichaje Digital Entrada/Salida</h3>
                    <p class="text-gray-600">
                        Registro obligatorio de jornada conforme RD-ley 8/2019. Check-in y check-out con timestamp automático y confirmación del empleado.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-map-marker-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Geolocalización GPS Automática</h3>
                    <p class="text-gray-600">
                        Captura automática de ubicación GPS en cada fichaje. Verifica que los empleados fichen desde el lugar de trabajo autorizado.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Auditoría Inmutable</h3>
                    <p class="text-gray-600">
                        Registro automático de todas las modificaciones. Trazabilidad completa con IP, usuario y timestamps para Inspección de Trabajo.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-file-export text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Exportación Oficial CSV</h3>
                    <p class="text-gray-600">
                        Formato oficial para presentar a Inspección de Trabajo. Incluye todas las variables requeridas: fechas, horas, geolocalización y auditoría.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-lock text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Retención Legal 4 Años</h3>
                    <p class="text-gray-600">
                        Conservación obligatoria de registros durante 4 años. Bloqueo automático de registros antiguos para cumplir normativa.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-database text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Backups Automáticos Diarios</h3>
                    <p class="text-gray-600">
                        Copias de seguridad automáticas cada día con retención de 30 días. Protección total de tus datos de jornada laboral.
                    </p>
                </div>
            </div>
        </div>
    </section>
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

    <!-- Legal Compliance Section -->
    <section class="py-20 bg-gradient-to-br from-indigo-900 via-blue-900 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">
                    <i class="fas fa-balance-scale mr-3"></i>
                    Cumplimiento Real Decreto-ley 8/2019
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Nuestro software cumple íntegramente con la normativa española de registro obligatorio de jornada laboral
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 border border-white border-opacity-20">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        Requisitos Legales Cubiertos
                    </h3>
                    <ul class="space-y-3 text-blue-100">
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Registro obligatorio</strong> de entrada y salida diaria</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Conservación 4 años:</strong> Retención legal de datos históricos</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Auditoría completa:</strong> Trazabilidad de todas las modificaciones</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Disponibilidad inmediata</strong> para Inspección de Trabajo</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Formato oficial:</strong> Exportación CSV homologada</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-chevron-right text-green-400 mr-3 mt-1"></i>
                            <span><strong>Geolocalización:</strong> Verificación del lugar de fichaje</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-8 border border-white border-opacity-20">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-400 mr-3"></i>
                        Evita Sanciones Laborales
                    </h3>
                    <div class="space-y-4 text-blue-100">
                        <p class="text-lg">
                            <strong class="text-white">Multas por incumplimiento:</strong>
                        </p>
                        <ul class="space-y-2 ml-4">
                            <li>• Leves: hasta <strong class="text-white">€2.045</strong></li>
                            <li>• Graves: de €2.046 a <strong class="text-white">€6.250</strong></li>
                            <li>• Muy graves: de €6.251 a <strong class="text-white">€187.515</strong></li>
                        </ul>
                        <div class="mt-6 p-4 bg-yellow-500 bg-opacity-20 rounded-lg border border-yellow-400 border-opacity-30">
                            <p class="text-sm">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Obligatorio desde 12 de mayo de 2019</strong> para todas las empresas en España, independientemente de su tamaño.
                            </p>
                        </div>
                        <div class="mt-4 p-4 bg-green-500 bg-opacity-20 rounded-lg border border-green-400 border-opacity-30">
                            <p class="text-sm">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Con SyncJornada, tu empresa cumple automáticamente con todos los requisitos legales desde el primer día.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white bg-opacity-5 backdrop-blur-sm rounded-xl p-8 border border-white border-opacity-10">
                <div class="text-center">
                    <h3 class="text-2xl font-bold mb-4">
                        <i class="fas fa-file-contract mr-2"></i>
                        Protección Legal para tu PYME
                    </h3>
                    <p class="text-blue-100 text-lg max-w-3xl mx-auto mb-6">
                        No arriesgues tu negocio a sanciones de Inspección de Trabajo. SyncJornada garantiza que tu sistema de fichaje cumple al 100% con la legislación española vigente, incluyendo todas las actualizaciones normativas.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 text-sm">
                        <span class="bg-blue-600 bg-opacity-40 px-4 py-2 rounded-full border border-blue-400">
                            ✓ RGPD Compliant
                        </span>
                        <span class="bg-blue-600 bg-opacity-40 px-4 py-2 rounded-full border border-blue-400">
                            ✓ LOPDGDD
                        </span>
                        <span class="bg-blue-600 bg-opacity-40 px-4 py-2 rounded-full border border-blue-400">
                            ✓ RD-ley 8/2019
                        </span>
                        <span class="bg-blue-600 bg-opacity-40 px-4 py-2 rounded-full border border-blue-400">
                            ✓ Estatuto de los Trabajadores
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Precios Transparentes para tu PYME</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Tarifas sin permanencia desde €5/mes. Sistema progresivo: €1 por empleado hasta 50 trabajadores.
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
                            <span class="text-5xl font-bold text-gray-900">€5</span>
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
                            <span class="text-5xl font-bold text-white">€10</span>
                            <span class="text-blue-100 ml-2">/mes</span>
                        </div>
                        <p class="text-sm text-blue-200 mt-2">6-10 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-300 mr-3 mt-1"></i>
                            <span class="text-white">Hasta 10 usuarios</span>
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
                            <span class="text-5xl font-bold text-gray-900">€15</span>
                            <span class="text-gray-600 ml-2">/mes</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">11-15 empleados</p>
                    </div>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Hasta 15 usuarios</span>
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
                            <span class="text-4xl font-bold text-gray-900">A partir de €20</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">16+ empleados (€5 cada 5)</p>
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
                        <i class="fas fa-calculator text-blue-600 mr-2"></i>
                        <strong>Sistema de tarifas progresivo:</strong> €5 cada 5 empleados
                    </p>
                    <div class="bg-white rounded-lg p-4 mb-4 border border-blue-200">
                        <p class="text-sm text-gray-700 mb-2 font-semibold">Ejemplos:</p>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• 1-5 empleados = €5/mes</li>
                            <li>• 6-10 empleados = €10/mes</li>
                            <li>• 11-15 empleados = €15/mes</li>
                            <li>• 16-20 empleados = €20/mes</li>
                            <li>• 21-25 empleados = €25/mes</li>
                            <li>• Y así sucesivamente... Siempre €5 cada 5 empleados adicionales</li>
                        </ul>
                    </div>
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
            <h2 class="text-4xl font-bold mb-6">Empieza a Cumplir la Normativa de Registro de Jornada</h2>
            <p class="text-xl mb-8 text-blue-100">
                Solicita acceso hoy y protege tu empresa de sanciones laborales. Implementación en menos de 24 horas.
            </p>
            <a href="{{ route('company-request.create') }}" class="inline-block bg-white text-blue-600 px-10 py-4 rounded-lg font-bold text-lg hover:bg-blue-50 transition transform hover:scale-105">
                <i class="fas fa-rocket mr-2"></i>Solicitar Acceso para mi Empresa
            </a>
            <p class="mt-6 text-blue-200">
                <i class="fas fa-clock mr-2"></i>Te contactaremos en 1-2 días hábiles • Sin compromiso • Sin permanencia
            </p>
            <p class="mt-2 text-blue-300 text-sm">
                <i class="fas fa-shield-alt mr-1"></i>
                Cumplimiento garantizado RD-ley 8/2019 • Soporte en español • Datos en UE
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
            <div class="border-t border-gray-800 mt-8 pt-8">
                <div class="grid md:grid-cols-2 gap-4 text-center md:text-left">
                    <div>
                        <p class="text-sm">&copy; 2025-2026 SyncJornada. Todos los derechos reservados.</p>
                        <p class="text-xs mt-2 text-gray-500">Software homologado para cumplimiento Real Decreto-ley 8/2019</p>
                    </div>
                    <div class="text-sm space-x-4 md:text-right">
                        <a href="#" class="hover:text-white transition">Política de Privacidad</a>
                        <span>•</span>
                        <a href="#" class="hover:text-white transition">Términos y Condiciones</a>
                        <span>•</span>
                        <a href="#" class="hover:text-white transition">Aviso Legal</a>
                        <span>•</span>
                        <a href="#" class="hover:text-white transition">Cookies</a>
                    </div>
                </div>
                <div class="mt-4 text-center text-xs text-gray-500">
                    <p>Servidor ubicado en Helsinki (Hetzner Cloud) • SSL/TLS Certificado • Backups diarios automáticos</p>
                    <p class="mt-1">Compatible con RGPD y LOPDGDD • Datos alojados en la Unión Europea</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
