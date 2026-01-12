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
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Main Content with Sidebar spacing -->
            <div x-data="{ sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false' }" class="pt-16">
                <div :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'" class="transition-all duration-300 ease-in-out">
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
                    <main class="min-h-screen">
                        {{ $slot }}
                    </main>

                    <!-- Footer -->
                    <footer class="bg-white border-t border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                                <p class="mb-2 sm:mb-0">&copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados.</p>
                                <div class="flex space-x-4">
                                    <a href="mailto:syncjornada@gmail.com" class="hover:text-blue-600 transition">Ayuda</a>
                                    <a href="{{ url('/politica-de-privacidad') }}" class="hover:text-blue-600 transition">Política de privacidad</a>
                                    <a href="{{ url('/terminos-y-condiciones') }}" class="hover:text-blue-600 transition">Términos y Condiciones</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        @include('components.paypal-widget')
    </body>
</html>
