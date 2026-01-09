<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SyncJornada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    {{-- Header --}}
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl text-gray-900">SyncJornada</span>
                        <span class="block text-xs text-gray-500 -mt-1">RD-ley 8/2019</span>
                    </div>
                </a>
                <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al inicio
                </a>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">@yield('title')</h1>
            <p class="text-sm text-gray-500 mb-8">Última actualización: {{ date('d/m/Y') }}</p>
            
            <div class="prose prose-lg max-w-none">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-8 mt-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados.</p>
            <div class="flex justify-center gap-6 mt-4">
                <a href="{{ route('terms') }}" class="hover:text-white transition">Términos</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition">Privacidad</a>
                <a href="{{ route('cookies') }}" class="hover:text-white transition">Cookies</a>
            </div>
        </div>
    </footer>

    @include('legal.cookie-banner')
    @include('components.paypal-widget')
</body>
</html>
