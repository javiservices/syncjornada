<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="SyncJornada - Gestión inteligente del tiempo laboral">

        <title>{{ config('app.name', 'SyncJornada') }} - @yield('title', 'Dashboard')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
             x-init="window.addEventListener('resize', () => { if (window.innerWidth >= 1024) sidebarOpen = true })"
             class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="pt-16 lg:pl-64">
                <div class="flex-1 min-w-0">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-4">
                        @isset($header)
                            <header class="bg-white shadow-sm border border-gray-200 rounded-2xl">
                                <div class="py-4 px-4 sm:py-5 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset

                        @if(session('success'))
                            <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 shadow-sm flex items-start" role="alert" aria-live="polite">
                                <i class="fas fa-check-circle text-green-500 text-lg mr-3" aria-hidden="true"></i>
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 shadow-sm flex items-start" role="alert" aria-live="assertive">
                                <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3" aria-hidden="true"></i>
                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                            </div>
                        @endif

                        <main class="min-h-screen pb-12">
                            {{ $slot }}
                        </main>

                        <footer class="bg-white border border-gray-200 rounded-2xl">
                            <div class="py-4 px-4 sm:px-6 lg:px-8">
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
        </div>

        @include('components.paypal-widget')
    </body>
</html>
