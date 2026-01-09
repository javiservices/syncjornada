<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Image/Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative z-10 flex flex-col justify-center items-center text-white p-12">
                    <div class="max-w-md">
                        <div class="flex items-center space-x-3 mb-8">
                            <i class="fas fa-clock text-5xl"></i>
                            <h1 class="text-4xl font-bold">SyncJornada</h1>
                        </div>
                        <h2 class="text-3xl font-bold mb-6">Gestión Inteligente del Tiempo Laboral</h2>
                        <p class="text-xl text-blue-100 mb-8">
                            Optimiza tu jornada laboral con seguimiento automático, análisis inteligente y reportes detallados.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="text-lg">Registro de tiempo preciso</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="text-lg">Análisis y reportes detallados</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="text-lg">Gestión por proyectos</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white opacity-5 rounded-full -ml-48 -mb-48"></div>
            </div>

            <!-- Right Side - Form -->
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24 bg-gray-50">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-8">
                        <a href="/" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 transition mb-6">
                            <i class="fas fa-arrow-left"></i>
                            <span>Volver al inicio</span>
                        </a>
                        <div class="lg:hidden flex items-center space-x-2 mb-4">
                            <i class="fas fa-clock text-blue-600 text-3xl"></i>
                            <h1 class="text-3xl font-bold text-gray-900">SyncJornada</h1>
                        </div>
                    </div>

                    <div class="bg-white py-8 px-6 shadow-xl rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        @include('components.paypal-widget')
    </body>
</html>
