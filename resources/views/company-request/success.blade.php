<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Enviada - SyncJornada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-2xl w-full">
            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-12 text-center">
                <!-- Success Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                    <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                </div>

                <!-- Title -->
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    ¡Solicitud Enviada con Éxito!
                </h1>

                <!-- Message -->
                <p class="text-lg text-gray-600 mb-8">
                    Gracias por tu interés en SyncJornada. Hemos recibido tu solicitud y la estamos revisando.
                </p>

                <!-- What's Next Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8 text-left">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-clipboard-list text-blue-600 mr-2"></i>
                        Próximos Pasos
                    </h3>
                    <div class="space-y-3 text-gray-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                1
                            </div>
                            <div>
                                <p class="font-semibold">Revisión (1-2 días hábiles)</p>
                                <p class="text-sm text-gray-600">Evaluaremos tu solicitud y las necesidades de tu empresa.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                2
                            </div>
                            <div>
                                <p class="font-semibold">Contacto Directo</p>
                                <p class="text-sm text-gray-600">Te contactaremos por email o teléfono para coordinar la configuración.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                3
                            </div>
                            <div>
                                <p class="font-semibold">Configuración de Cuenta</p>
                                <p class="text-sm text-gray-600">Crearemos tu empresa y usuario administrador en el sistema.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                4
                            </div>
                            <div>
                                <p class="font-semibold">¡Listo para Empezar!</p>
                                <p class="text-sm text-gray-600">Recibirás tus credenciales y podrás comenzar a usar SyncJornada.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <p class="text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>
                        <strong>Email de confirmación:</strong> Revisa tu bandeja de entrada
                    </p>
                    <p class="text-gray-700">
                        <i class="fas fa-phone text-blue-600 mr-2"></i>
                        <strong>Preguntas:</strong> 
                        <a href="mailto:soporte@syncjornada.com" class="text-blue-600 hover:text-blue-700 font-semibold">
                            soporte@syncjornada.com
                        </a>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a 
                        href="/" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-all transform hover:scale-105"
                    >
                        <i class="fas fa-home mr-2"></i>
                        Volver al Inicio
                    </a>
                    <a 
                        href="mailto:soporte@syncjornada.com" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-lg border-2 border-gray-300 transition-all"
                    >
                        <i class="fas fa-envelope mr-2"></i>
                        Contactar Soporte
                    </a>
                </div>
            </div>

            <!-- Additional Note -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">
                    <i class="fas fa-shield-alt text-blue-600 mr-1"></i>
                    Tu información está segura y será tratada con confidencialidad
                </p>
            </div>
        </div>
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
