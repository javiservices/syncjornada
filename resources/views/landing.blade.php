<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF para futuras peticiones --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title>SyncJornada | Software de Registro de Jornada Laboral (RD 8/2019)</title>
    <meta name="description" content="Software de registro de jornada laboral homologado según el Real Decreto-ley 8/2019. Control horario digital con geolocalización, auditoría y exportación oficial.">
    <meta name="keywords" content="registro jornada laboral, control horario, fichaje digital, RD 8/2019, control horario España">
    <meta name="author" content="SyncJornada">
    <meta name="robots" content="index, follow">

    <!-- Canonical -->
    <link rel="canonical" href="https://syncjornada.online">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="SyncJornada - Registro de Jornada Laboral">
    <meta property="og:description" content="Control horario digital homologado según RD 8/2019">
    <meta property="og:url" content="https://syncjornada.online">
    <meta property="og:image" content="https://syncjornada.online/og-image.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind + Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Schema.org -->
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "SyncJornada",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web",
      "offers": {
        "@type": "Offer",
        "price": "5.00",
        "priceCurrency": "EUR"
      },
      "description": "Software de registro de jornada laboral homologado conforme al Real Decreto-ley 8/2019.",
      "url": "https://syncjornada.online"
    }
    </script>
    @endverbatim
</head>

<body class="bg-gray-50 text-gray-900">

{{-- ================= HEADER ================= --}}
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <i class="fas fa-clock text-blue-600 text-2xl"></i>
            <span class="font-bold text-xl">SyncJornada</span>
        </div>

        <nav class="hidden md:flex gap-6 text-sm">
            <a href="#features" class="hover:text-blue-600">Características</a>
            <a href="#pricing" class="hover:text-blue-600">Precios</a>
            <a href="#legal" class="hover:text-blue-600">Legal</a>
        </nav>

        @auth
            <a href="{{ route('dashboard') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Dashboard
            </a>
        @endauth

        @guest
            <a href="{{ route('login') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Iniciar sesión
            </a>
        @endguest
    </div>
</header>

{{-- ================= HERO ================= --}}
<section class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white py-24 text-center">
    <h1 class="text-5xl font-bold mb-6">
        Registro de Jornada Laboral Homologado
    </h1>
    <p class="text-xl max-w-3xl mx-auto mb-8">
        Cumple el Real Decreto-ley 8/2019 con un sistema de fichaje digital,
        geolocalizado y auditado. Desde 5€/mes.
    </p>

    <a href="{{ route('company-request.create') }}"
       class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:bg-blue-50">
        Solicitar acceso
    </a>
</section>

{{-- ================= FEATURES ================= --}}
<section id="features" class="py-20 max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-center mb-12">
        Funcionalidades clave
    </h2>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-xl shadow">
            <i class="fas fa-clock text-blue-600 text-3xl mb-4"></i>
            <h3 class="font-bold text-xl mb-2">Fichaje obligatorio</h3>
            <p>Entrada y salida diaria conforme a la normativa.</p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow">
            <i class="fas fa-map-marker-alt text-green-600 text-3xl mb-4"></i>
            <h3 class="font-bold text-xl mb-2">Geolocalización</h3>
            <p>Verificación automática del lugar de trabajo.</p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow">
            <i class="fas fa-shield-alt text-purple-600 text-3xl mb-4"></i>
            <h3 class="font-bold text-xl mb-2">Auditoría</h3>
            <p>Trazabilidad completa para Inspección de Trabajo.</p>
        </div>
    </div>
</section>

{{-- ================= PRICING ================= --}}
<section id="pricing" class="bg-gray-100 py-20">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12">Precios</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow">
                <h3 class="text-xl font-bold mb-4">1-5 empleados</h3>
                <p class="text-4xl font-bold mb-6">5€</p>
                <a href="{{ route('company-request.create') }}"
                   class="block bg-blue-600 text-white py-3 rounded-lg">
                    Solicitar
                </a>
            </div>

            <div class="bg-blue-600 text-white p-8 rounded-xl shadow scale-105">
                <h3 class="text-xl font-bold mb-4">6-10 empleados</h3>
                <p class="text-4xl font-bold mb-6">10€</p>
                <a href="{{ route('company-request.create') }}"
                   class="block bg-white text-blue-600 py-3 rounded-lg">
                    Solicitar
                </a>
            </div>

            <div class="bg-white p-8 rounded-xl shadow">
                <h3 class="text-xl font-bold mb-4">11+ empleados</h3>
                <p class="text-4xl font-bold mb-6">Desde 15€</p>
                <a href="{{ route('company-request.create') }}"
                   class="block bg-blue-600 text-white py-3 rounded-lg">
                    Solicitar
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-900 text-gray-400 py-10 text-center">
    <p>&copy; {{ date('Y') }} SyncJornada · Cumple RD-ley 8/2019</p>
    <p class="text-sm mt-2">Datos alojados en la UE · RGPD · LOPDGDD</p>
</footer>

</body>
</html>
