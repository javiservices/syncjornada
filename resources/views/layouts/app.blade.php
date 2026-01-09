<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="SyncJornada - Gestión inteligente del tiempo laboral">

        <title>{{ config('app.name', 'SyncJornada') }} - @yield('title', 'Dashboard')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" role="alert" aria-live="polite">
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3" aria-hidden="true"></i>
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" role="alert" aria-live="assertive">
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3" aria-hidden="true"></i>
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                        <p class="mb-2 sm:mb-0">&copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-blue-600 transition">Ayuda</a>
                            <a href="#" class="hover:text-blue-600 transition">Privacidad</a>
                            <a href="#" class="hover:text-blue-600 transition">Términos</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- PayPal Donation Widget -->
        <div id="donation-widget" class="fixed bottom-6 right-6 z-50">
            <!-- Botón flotante -->
            <button 
                id="donation-btn"
                onclick="toggleDonation()"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110"
                title="Apoya el proyecto"
            >
                <i class="fab fa-paypal text-2xl"></i>
            </button>
            
            <!-- Panel desplegable -->
            <div 
                id="donation-panel"
                class="hidden absolute bottom-16 right-0 bg-white rounded-lg shadow-2xl p-4 w-72 border border-gray-200"
            >
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fas fa-coffee text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">☕ Apoya SyncJornada</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Esta aplicación es 100% gratuita. Si te resulta útil, puedes invitarme a un café para ayudar a mantener los servidores activos.
                    </p>
                    <a 
                        href="https://paypal.me/javilabarumdj" 
                        target="_blank"
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition mb-2"
                    >
                        <i class="fab fa-paypal mr-2"></i>Donar con PayPal
                    </a>
                    <button 
                        onclick="toggleDonation()"
                        class="text-sm text-gray-500 hover:text-gray-700"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </div>

        <script>
        function toggleDonation() {
            const panel = document.getElementById('donation-panel');
            const btn = document.getElementById('donation-btn');
            
            if (panel.classList.contains('hidden')) {
                panel.classList.remove('hidden');
                panel.classList.add('animate-fadeIn');
                btn.classList.add('ring-4', 'ring-blue-300');
            } else {
                panel.classList.add('hidden');
                panel.classList.remove('animate-fadeIn');
                btn.classList.remove('ring-4', 'ring-blue-300');
            }
        }

        // Cerrar al hacer clic fuera
        document.addEventListener('click', function(event) {
            const widget = document.getElementById('donation-widget');
            const panel = document.getElementById('donation-panel');
            
            if (widget && !widget.contains(event.target) && !panel.classList.contains('hidden')) {
                toggleDonation();
            }
        });
        </script>

        <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
        </style>
    </body>
</html>
