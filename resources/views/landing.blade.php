<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-adsense-account" content="ca-pub-7518861337365197">

    {{-- CSRF para futuras peticiones --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Optimizado -->
    <title>SyncJornada - Registro de Jornada Laboral Obligatorio RD-ley 8/2019 | Control Horario Digital</title>
    <meta name="description" content="✓ Software de registro de jornada laboral obligatorio según RD-ley 8/2019. Control horario con geolocalización, fichaje digital y exportación para Inspección de Trabajo. Prueba GRATIS 30 días.">
    <meta name="keywords" content="registro jornada laboral obligatorio, control horario empresa, fichaje digital, RD-ley 8/2019, registro horario trabajadores, control jornada laboral, sistema fichaje empleados, cumplimiento inspección trabajo, geolocalización laboral, exportar jornada laboral, software RRHH España">
    <meta name="author" content="SyncJornada">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical -->
    <link rel="canonical" href="https://syncjornada.online">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SyncJornada">
    <meta property="og:title" content="SyncJornada - Registro de Jornada Laboral Obligatorio | Control Horario Digital">
    <meta property="og:description" content="✓ Cumple el RD-ley 8/2019. Control horario con geolocalización.">
    <meta property="og:url" content="https://syncjornada.online">
    <meta property="og:image" content="https://syncjornada.online/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="es_ES">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SyncJornada - Registro de Jornada Laboral RD 8/2019">
    <meta name="twitter:description" content="Control horario obligatorio desde 5€/mes según número de empleados. Prueba gratis 30 días.">
    <meta name="twitter:image" content="https://syncjornada.online/og-image.jpg">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Tailwind + Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Schema.org Mejorado -->
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "SyncJornada",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web",
      "browserRequirements": "Requires JavaScript. Requires HTML5.",
      "offers": {
        "@type": "AggregateOffer",
        "lowPrice": "5.00",
        "highPrice": "15.00",
        "priceCurrency": "EUR",
        "priceSpecification": {
          "@type": "UnitPriceSpecification",
          "price": "5.00",
          "priceCurrency": "EUR",
          "billingDuration": "P1M"
        }
      },
      "description": "Software de registro de jornada laboral obligatorio conforme al Real Decreto-ley 8/2019. Sistema de control horario con geolocalización, fichaje digital y exportación para Inspección de Trabajo.",
      "url": "https://syncjornada.online",
      "screenshot": "https://syncjornada.online/screenshot.jpg",
      "featureList": [
        "Registro de entrada y salida obligatorio",
        "Geolocalización automática",
        "Exportación para Inspección de Trabajo",
        "Auditoría completa de fichajes",
        "Notificaciones automáticas",
        "Panel de control en tiempo real",
        "Cumplimiento RD-ley 8/2019"
      ],
      "softwareVersion": "1.0",
      "author": {
        "@type": "Organization",
        "name": "SyncJornada"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿Es obligatorio el registro de jornada laboral en España?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sí, desde el 12 de mayo de 2019, el Real Decreto-ley 8/2019 obliga a todas las empresas en España a llevar un registro diario de la jornada laboral de sus trabajadores, incluyendo hora de entrada y salida."
          }
        },
        {
          "@type": "Question",
          "name": "¿Cuánto cuesta SyncJornada?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "SyncJornada tiene precios simples: 5€/mes hasta 5 empleados, 10€/mes hasta 10 empleados y 15€/mes hasta 15 empleados. Todos los planes incluyen las mismas funcionalidades completas y 30 días de prueba gratuita. Para empresas mayores, contactar para plan personalizado."
          }
        },
        {
          "@type": "Question",
          "name": "¿Qué sanciones hay por no llevar el registro de jornada?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Las sanciones por no llevar el registro de jornada o llevarlo incorrectamente pueden ir desde 626€ hasta 6.250€ por infracción grave, según la Inspección de Trabajo y Seguridad Social."
          }
        }
      ]
    }
    </script>
    @endverbatim

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        .gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

{{-- ================= HEADER MEJORADO ================= --}}
<header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div>
                    <span class="font-bold text-xl text-gray-900">SyncJornada</span>
                    <span class="block text-xs text-gray-500 -mt-1">RD-ley 8/2019</span>
                </div>
            </div>

            <nav class="hidden md:flex gap-8 text-sm font-medium">
                <a href="#caracteristicas" class="text-gray-600 hover:text-blue-600 transition">Características</a>
                <a href="#precios" class="text-gray-600 hover:text-blue-600 transition">Gratis</a>
                <a href="#como-funciona" class="text-gray-600 hover:text-blue-600 transition">Cómo funciona</a>
                <a href="#faq" class="text-gray-600 hover:text-blue-600 transition">FAQ</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 sm:px-6 py-2.5 rounded-lg hover:from-blue-700 hover:to-blue-800 transition font-medium shadow-sm">
                        <i class="fas fa-tachometer-alt mr-2"></i><span class="hidden sm:inline">Dashboard</span><span class="sm:hidden">Panel</span>
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="text-gray-600 hover:text-blue-600 font-medium transition px-3 sm:px-4 py-2">
                        <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i><span class="hidden sm:inline">Iniciar sesión</span><span class="sm:hidden">Entrar</span>
                    </a>
                    <a href="{{ route('company-request.create') }}"
                       class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 sm:px-6 py-2.5 rounded-lg hover:from-blue-700 hover:to-purple-700 transition font-medium shadow-lg shadow-blue-500/30 text-sm sm:text-base">
                        <i class="fas fa-rocket mr-1 sm:mr-2"></i><span class="hidden sm:inline">Prueba Gratis</span><span class="sm:hidden">Probar</span>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>

{{-- ================= BANNER URGENCIA ================= --}}
<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-2 text-center text-sm">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <strong>Obligatorio desde 2019:</strong> Multas de hasta 6.250€ por no llevar registro de jornada
</div>

{{-- ================= HERO SECTION MEJORADO ================= --}}
<section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-purple-800 text-white py-20 lg:py-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjEiIHN0cm9rZS13aWR0aD0iMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPjwvc3ZnPg==')] opacity-20"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left animate-fade-in-up">
                <div class="inline-block bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-6">
                    <span class="text-sm font-semibold">✓ Cumplimiento RD-ley 8/2019 Garantizado</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Registro de Jornada Laboral <span class="text-yellow-300">Obligatorio</span>
                </h1>
                
                <p class="text-xl sm:text-2xl mb-4 text-blue-100 font-light">
                    Control horario digital que cumple la normativa
                </p>
                
                <p class="text-lg mb-8 text-blue-50 max-w-xl mx-auto lg:mx-0">
                    Sistema completo de fichaje con geolocalización, auditoría y exportación para Inspección de Trabajo.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                    <a href="{{ route('company-request.create') }}"
                       class="group bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition shadow-2xl inline-flex items-center justify-center">
                        <i class="fas fa-rocket mr-3 group-hover:scale-110 transition"></i>
                        Solicitar Acceso
                    </a>
                    <a href="#precios"
                       class="bg-white/10 backdrop-blur-sm border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition inline-flex items-center justify-center">
                        <i class="fas fa-gift mr-3"></i>
                        100% Gratuito
                    </a>
                </div>

                <div class="flex flex-wrap gap-6 justify-center lg:justify-start text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Sin permanencia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>Soporte incluido</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-300"></i>
                        <span>RGPD + LOPDGDD</span>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition duration-300">
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                                <i class="fas fa-sign-in-alt text-green-600 text-2xl"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">Entrada registrada</p>
                                    <p class="text-sm text-gray-600">08:00 - Oficina Central</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <i class="fas fa-map-marker-alt text-blue-600 text-2xl"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">Geolocalización activa</p>
                                    <p class="text-sm text-gray-600">Madrid, España</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                                <i class="fas fa-file-export text-purple-600 text-2xl"></i>
                                <div>
                                    <p class="font-semibold text-gray-900">Exportación lista</p>
                                    <p class="text-sm text-gray-600">Formato Inspección Trabajo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= BADGES CONFIANZA ================= --}}
<section class="py-8 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center items-center gap-8 text-center text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-green-600"></i>
                <span><strong class="text-gray-900">Datos en UE</strong></span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-lock text-blue-600"></i>
                <span><strong class="text-gray-900">RGPD</strong> Cumplido</span>
            </div>
        </div>
    </div>
</section>

{{-- ================= CARACTERÍSTICAS DETALLADAS ================= --}}
<section id="caracteristicas" class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Todo lo que necesitas para cumplir la <span class="gradient-text">normativa</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Sistema completo de registro de jornada laboral con todas las funcionalidades requeridas por ley
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Feature 1 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Fichaje Obligatorio</h3>
                <p class="text-gray-600 mb-4">Registro de entrada y salida diaria según RD-ley 8/2019. Interfaz simple para empleados.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Entrada y salida con un clic</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Registro de pausas y descansos</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Marca de tiempo inmutable</span>
                    </li>
                </ul>
            </div>

            {{-- Feature 2 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Geolocalización GPS</h3>
                <p class="text-gray-600 mb-4">Verificación automática de ubicación en cada fichaje para mayor control.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Coordenadas GPS en tiempo real</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Validación de lugar de trabajo</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Historial de ubicaciones</span>
                    </li>
                </ul>
            </div>

            {{-- Feature 3 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-file-export text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Exportación Legal</h3>
                <p class="text-gray-600 mb-4">Informes listos para presentar ante la Inspección de Trabajo.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Formato oficial Excel/PDF</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Filtros por fechas y empleados</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Descarga instantánea</span>
                    </li>
                </ul>
            </div>

            {{-- Feature 4 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Auditoría Total</h3>
                <p class="text-gray-600 mb-4">Trazabilidad completa de todos los registros y modificaciones.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Registro inmutable de fichajes</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Histórico de cambios</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Evidencia ante inspecciones</span>
                    </li>
                </ul>
            </div>

            {{-- Feature 5 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-bell text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Notificaciones</h3>
                <p class="text-gray-600 mb-4">Alertas automáticas para empleados y administradores.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Recordatorio de fichaje</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Alertas de fichajes pendientes</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Notificaciones por email</span>
                    </li>
                </ul>
            </div>

            {{-- Feature 6 --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900">Dashboard en Tiempo Real</h3>
                <p class="text-gray-600 mb-4">Panel de control completo con estadísticas y análisis.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Quién está trabajando ahora</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Horas trabajadas por empleado</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Gráficos y estadísticas</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ================= CÓMO FUNCIONA ================= --}}
<section id="como-funciona" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Empieza en <span class="gradient-text">3 pasos</span>
            </h2>
            <p class="text-xl text-gray-600">
                Configuración en menos de 5 minutos
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6 shadow-lg">
                    1
                </div>
                <h3 class="font-bold text-2xl mb-4 text-gray-900">Registro</h3>
                <p class="text-gray-600">
                    Solicita acceso rellenando un formulario simple. Sin tarjeta de crédito.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6 shadow-lg">
                    2
                </div>
                <h3 class="font-bold text-2xl mb-4 text-gray-900">Configuración</h3>
                <p class="text-gray-600">
                    Añade tus empleados y configura los parámetros básicos de tu empresa.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6 shadow-lg">
                    3
                </div>
                <h3 class="font-bold text-2xl mb-4 text-gray-900">¡Listo!</h3>
                <p class="text-gray-600">
                    Tus empleados pueden empezar a fichar desde cualquier dispositivo.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ================= PRICING MEJORADO ================= --}}
<section id="precios" class="py-20 bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                100% <span class="gradient-text">Gratuito</span>
            </h2>
            <p class="text-xl text-gray-600 mb-6">
                SyncJornada es completamente gratis para todas las empresas, sin límites ni restricciones.
            </p>
            <div class="inline-block bg-green-100 border border-green-300 rounded-full px-6 py-2">
                <span class="text-green-800 font-semibold">
                    <i class="fas fa-gift mr-2"></i>Gratis (por ahora). Todas las funcionalidades incluidas.
                </span>
            </div>
        </div>

        {{-- Funcionalidades incluidas --}}
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-blue-200">
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-6">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    Todas las funcionalidades incluidas
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Fichaje con geolocalización</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Exportación Excel/PDF para Inspección</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Dashboard completo</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Notificaciones automáticas</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Gestión de vacaciones</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Informes y auditoría completa</span>
                        </li>
                    </ul>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Multi-empresa</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Configuración personalizada</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Cumplimiento RGPD</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">SSL y backups diarios</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Soporte técnico incluido</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span class="text-gray-700">Actualizaciones gratuitas</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Apoyo opcional --}}
        <div class="text-center mt-12 max-w-3xl mx-auto">
            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6">
                <div class="mb-3">
                    <i class="fas fa-coffee text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">¿Te resulta útil SyncJornada?</h3>
                <p class="text-gray-700 mb-4">
                    Esta aplicación es 100% gratuita y siempre lo será. Si quieres apoyar el proyecto y ayudar a mantener los servidores activos, puedes hacer una donación voluntaria. 
                </p>
                <p class="text-sm text-gray-600 italic">
                    <i class="fas fa-heart text-red-500 mr-1"></i>
                    Mira el icono de PayPal en la esquina inferior derecha para apoyar con un café ☕
                </p>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('company-request.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition transform hover:scale-105 shadow-lg">
                <i class="fas fa-rocket mr-2"></i>Solicitar Acceso Gratis
            </a>
        </div>
    </div>
</section>

{{-- ================= FAQ ================= --}}
<section id="faq" class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Preguntas <span class="gradient-text">frecuentes</span>
            </h2>
            <p class="text-xl text-gray-600">
                Resolvemos tus dudas sobre el registro de jornada laboral
            </p>
        </div>

        <div class="space-y-6">
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Es obligatorio el registro de jornada laboral en España?
                </h3>
                <p class="text-gray-700 pl-8">
                    Sí, desde el 12 de mayo de 2019, el Real Decreto-ley 8/2019 obliga a <strong>todas las empresas en España</strong> a llevar un registro diario de la jornada laboral de sus trabajadores, incluyendo hora de entrada y salida, independientemente del tamaño de la empresa o tipo de contrato.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Qué sanciones hay por no llevar el registro de jornada?
                </h3>
                <p class="text-gray-700 pl-8">
                    Las sanciones por no llevar el registro de jornada o llevarlo incorrectamente pueden ir desde <strong>626€ hasta 6.250€</strong> por infracción grave, según la Inspección de Trabajo y Seguridad Social. En casos de reincidencia, las multas pueden ser aún mayores.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Puedo probar SyncJornada gratis?
                </h3>
                <p class="text-gray-700 pl-8">
                    Sí, ofrecemos <strong>30 días de prueba gratuita</strong> en todos nuestros planes. No necesitas tarjeta de crédito para empezar. Puedes probar todas las funcionalidades sin compromiso y decidir después si quieres continuar.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Los datos están protegidos según RGPD?
                </h3>
                <p class="text-gray-700 pl-8">
                    Absolutamente. Todos los datos se almacenan en <strong>servidores ubicados en la Unión Europea</strong> y cumplimos estrictamente con el RGPD y la LOPDGDD. Implementamos cifrado SSL, backups automáticos diarios y medidas de seguridad avanzadas.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Cómo funciona la geolocalización?
                </h3>
                <p class="text-gray-700 pl-8">
                    Cuando un empleado ficha, el sistema captura automáticamente las coordenadas GPS desde su dispositivo (con su consentimiento). Esto permite verificar que el fichaje se realiza desde el lugar de trabajo autorizado y proporciona evidencia adicional ante posibles inspecciones.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Qué formato tiene la exportación para la Inspección?
                </h3>
                <p class="text-gray-700 pl-8">
                    Generamos informes en formato <strong>Excel y PDF</strong> que incluyen todos los datos requeridos: nombre del empleado, fecha, hora de entrada, hora de salida, total de horas trabajadas y ubicación. El formato está preparado para ser presentado directamente ante la Inspección de Trabajo.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Hay permanencia o puedo cancelar cuando quiera?
                </h3>
                <p class="text-gray-700 pl-8">
                    <strong>No hay permanencia</strong>. Puedes cancelar tu suscripción en cualquier momento sin penalizaciones. Si cancelas, mantendrás acceso hasta el final de tu período de facturación actual y podrás exportar todos tus datos históricos.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h3 class="font-bold text-lg text-gray-900 mb-3 flex items-start gap-3">
                    <i class="fas fa-question-circle text-blue-600 mt-1"></i>
                    ¿Necesito instalar algo o funciona desde el navegador?
                </h3>
                <p class="text-gray-700 pl-8">
                    SyncJornada es una aplicación web que funciona directamente desde cualquier navegador moderno (Chrome, Firefox, Safari, Edge). No necesitas instalar nada. Funciona en ordenadores, tablets y móviles, tanto en iOS como en Android.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CTA FINAL ================= --}}
<section class="py-20 bg-gradient-to-br from-blue-600 via-blue-700 to-purple-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl lg:text-5xl font-bold mb-6">
            ¿Listo para cumplir la normativa?
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Empieza a registrar la jornada laboral de forma fácil, segura y conforme a la ley
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('company-request.create') }}"
               class="inline-flex items-center justify-center bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition shadow-2xl">
                <i class="fas fa-rocket mr-3"></i>
                Empieza gratis ahora
            </a>
        </div>
    </div>
</section>


{{-- ================= FOOTER MEJORADO ================= --}}
<footer class="bg-gray-900 text-gray-400 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            {{-- Columna 1: Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl text-white">SyncJornada</span>
                        <span class="block text-xs text-gray-500 -mt-1">RD-ley 8/2019</span>
                    </div>
                </div>
                <p class="text-sm text-gray-400">
                    Software de registro de jornada laboral obligatorio para empresas españolas.
                </p>
            </div>

            {{-- Columna 2: Producto --}}
            <div>
                <h3 class="font-bold text-white mb-4">Producto</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#caracteristicas" class="hover:text-white transition">Características</a></li>
                    <li><a href="#precios" class="hover:text-white transition">Gratis</a></li>
                    <li><a href="#como-funciona" class="hover:text-white transition">Cómo funciona</a></li>
                    <li><a href="#faq" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>

            {{-- Columna 3: Legal --}}
            <div>
                <h3 class="font-bold text-white mb-4">Legal</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('terms') }}" class="hover:text-white transition">Términos y Condiciones</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="hover:text-white transition">Política de Privacidad</a></li>
                    <li><a href="{{ route('cookies') }}" class="hover:text-white transition">Política de Cookies</a></li>
                </ul>
            </div>

            {{-- Columna 4: Contacto --}}
            <div>
                <h3 class="font-bold text-white mb-4">Contacto</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope text-blue-500"></i>
                        <a href="mailto:syncjornada@gmail.com" class="hover:text-white transition">syncjornada@gmail.com</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                        <span>España, UE</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Línea divisoria --}}
        <div class="border-t border-gray-800 pt-8 mt-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500 text-center md:text-left">
                    &copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados. Sin responsabilidad alguna por problemas legales.
                </p>
                <div class="flex items-center gap-6 text-sm text-gray-500">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        Datos en la UE
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-lock text-blue-500"></i>
                        RGPD
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-balance-scale text-purple-500"></i>
                        RD-ley 8/2019
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('legal.cookie-banner')

@include('components.paypal-widget')

</body>
</html>
