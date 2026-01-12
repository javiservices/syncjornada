<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="SyncJornada - Gestión inteligente del tiempo laboral">
        
        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#2563eb">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="SyncJornada">
        
        <!-- Google AdSense Verification -->
        <meta name="google-adsense-account" content="ca-pub-7518861337365197">
        
        <!-- Icons -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <title>{{ config('app.name', 'SyncJornada') }} - @yield('title', 'Dashboard')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Google AdSense -->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7518861337365197"
                crossorigin="anonymous"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Service Worker Registration -->
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/service-worker.js')
                        .then(registration => {
                            console.log('✅ Service Worker registrado:', registration.scope);
                            
                            // Solicitar permiso para notificaciones
                            if ('Notification' in window && Notification.permission === 'default') {
                                Notification.requestPermission().then(permission => {
                                    console.log('Permiso de notificaciones:', permission);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('❌ Error al registrar Service Worker:', error);
                        });
                });
            }
        </script>
    </head>
    <body 
        x-data="{ page: 'dashboard', 'loaded': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        class="font-sans antialiased"
    >
        @include('layouts.partials.preloader')

        <!-- ===== Page Wrapper Start ===== -->
        <div class="flex h-screen overflow-hidden">
            <!-- ===== Sidebar Start ===== -->
            @include('layouts.partials.sidebar')
            <!-- ===== Sidebar End ===== -->

            <!-- ===== Content Area Start ===== -->
            <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
                <!-- Small Device Overlay Start -->
                @include('layouts.partials.overlay')
                <!-- Small Device Overlay End -->

                <!-- ===== Header Start ===== -->
                @include('layouts.partials.header')
                <!-- ===== Header End ===== -->

                <!-- ===== Main Content Start ===== -->
                <main>
                    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                        @isset($header)
                            <header class="mb-6">
                                <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 rounded-lg px-6 py-4">
                                    {{ $header }}
                                </div>
                            </header>
                        @endisset

                        @if(session('success'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 shadow-sm flex items-start dark:bg-green-900/20 dark:border-green-800" role="alert" aria-live="polite">
                                <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 shadow-sm flex items-start dark:bg-red-900/20 dark:border-red-800" role="alert" aria-live="assertive">
                                <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
                            </div>
                        @endif

                        {{ $slot }}

                        <!-- Footer Simple -->
                        <footer class="mt-12 pt-6 border-t border-gray-200">
                            <div class="text-center text-sm text-gray-500">
                                <p class="mb-2">
                                    <a href="{{ route('privacy-policy') }}" class="hover:text-gray-700 transition">Política de Privacidad</a>
                                    <span class="mx-2">·</span>
                                    <a href="{{ route('terms') }}" class="hover:text-gray-700 transition">Términos y Condiciones</a>
                                </p>
                                <p>&copy; {{ date('Y') }} SyncJornada. Todos los derechos reservados.</p>
                            </div>
                        </footer>
                    </div>
                </main>
                <!-- ===== Main Content End ===== -->
            </div>
            <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Page Wrapper End ===== -->

        @include('components.donation-modal')
        @include('components.paypal-widget')
        @include('components.pwa-install')
    </body>
</html>
