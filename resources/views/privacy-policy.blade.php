<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - SyncJornada</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm p-8">
            <!-- Header -->
            <div class="mb-8 border-b pb-6">
                <div class="flex items-center mb-4">
                    <a href="/" class="text-blue-600 hover:text-blue-700 transition mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-4xl font-bold text-gray-900">Política de Privacidad</h1>
                </div>
                <p class="text-gray-600">Última actualización: {{ date('d/m/Y') }}</p>
            </div>

            <!-- Content -->
            <div class="prose prose-blue max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">1. Información que Recopilamos</h2>
                <p class="text-gray-700 mb-4">
                    En SyncJornada recopilamos la siguiente información:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Información de cuenta:</strong> Nombre, correo electrónico, empresa, rol.</li>
                    <li><strong>Registros de jornada:</strong> Hora de entrada/salida, pausas, ubicación (si se concede permiso).</li>
                    <li><strong>Información de uso:</strong> Páginas visitadas, acciones realizadas en la plataforma.</li>
                    <li><strong>Cookies:</strong> Utilizamos cookies para mejorar la experiencia del usuario y mostrar anuncios relevantes.</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">2. Cómo Usamos tu Información</h2>
                <p class="text-gray-700 mb-4">
                    Utilizamos la información recopilada para:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Proporcionar y mejorar nuestros servicios de gestión de jornadas laborales.</li>
                    <li>Generar reportes y estadísticas para managers y administradores.</li>
                    <li>Enviar notificaciones relacionadas con tu actividad (recordatorios de fichaje, solicitudes de vacaciones).</li>
                    <li>Cumplir con obligaciones legales y normativas laborales.</li>
                    <li>Mostrar anuncios publicitarios relevantes a través de Google AdSense.</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">3. Compartir Información</h2>
                <p class="text-gray-700 mb-4">
                    No vendemos tu información personal. Podemos compartir información con:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Managers y administradores:</strong> Tienen acceso a los registros de jornada de sus equipos.</li>
                    <li><strong>Proveedores de servicios:</strong> Google AdSense para mostrar anuncios publicitarios.</li>
                    <li><strong>Autoridades:</strong> Si es requerido por ley o para proteger nuestros derechos.</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">4. Cookies y Tecnologías Similares</h2>
                <p class="text-gray-700 mb-4">
                    Utilizamos cookies para:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Mantener tu sesión activa.</li>
                    <li>Recordar tus preferencias.</li>
                    <li>Analizar el uso de la plataforma.</li>
                    <li>Mostrar anuncios personalizados a través de Google AdSense.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Puedes configurar tu navegador para rechazar cookies, aunque esto puede afectar la funcionalidad de la plataforma.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">5. Google AdSense</h2>
                <p class="text-gray-700 mb-4">
                    Utilizamos Google AdSense para mostrar anuncios en nuestra plataforma. Google puede utilizar cookies para:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Mostrar anuncios basados en tus visitas anteriores a este u otros sitios web.</li>
                    <li>Optimizar la efectividad de los anuncios.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Puedes optar por no participar en la publicidad personalizada visitando 
                    <a href="https://www.google.com/settings/ads" target="_blank" class="text-blue-600 hover:underline">Configuración de anuncios de Google</a>.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">6. Seguridad de los Datos</h2>
                <p class="text-gray-700 mb-6">
                    Implementamos medidas de seguridad técnicas y organizativas para proteger tu información personal contra acceso no autorizado, alteración, divulgación o destrucción. 
                    Todos los datos se transmiten mediante conexiones HTTPS cifradas.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">7. Tus Derechos</h2>
                <p class="text-gray-700 mb-4">
                    Tienes derecho a:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Acceder a tu información personal.</li>
                    <li>Rectificar datos inexactos.</li>
                    <li>Solicitar la eliminación de tus datos (sujeto a obligaciones legales).</li>
                    <li>Oponerte al procesamiento de tus datos.</li>
                    <li>Solicitar la portabilidad de tus datos.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Para ejercer estos derechos, contacta con nosotros a través de <strong>syncjornada@ejemplo.com</strong>.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">8. Retención de Datos</h2>
                <p class="text-gray-700 mb-6">
                    Conservamos tus datos mientras tu cuenta esté activa o según sea necesario para cumplir con obligaciones legales, 
                    resolver disputas o hacer cumplir nuestros acuerdos. Los registros de jornada se conservan durante el período mínimo 
                    requerido por la legislación laboral vigente.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">9. Menores de Edad</h2>
                <p class="text-gray-700 mb-6">
                    SyncJornada no está dirigido a menores de 16 años. No recopilamos conscientemente información personal de menores de edad. 
                    Si descubrimos que un menor nos ha proporcionado información, la eliminaremos de inmediato.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">10. Cambios en la Política</h2>
                <p class="text-gray-700 mb-6">
                    Podemos actualizar esta política de privacidad ocasionalmente. Te notificaremos de cualquier cambio significativo 
                    publicando la nueva política en esta página y actualizando la fecha de "última actualización".
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">11. Contacto</h2>
                <p class="text-gray-700 mb-4">
                    Si tienes preguntas sobre esta política de privacidad, puedes contactarnos en:
                </p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <p class="text-gray-900"><strong>SyncJornada</strong></p>
                    <p class="text-gray-700">Email: <a href="mailto:syncjornada@ejemplo.com" class="text-blue-600 hover:underline">syncjornada@ejemplo.com</a></p>
                    <p class="text-gray-700">Web: <a href="https://syncjornada.online" class="text-blue-600 hover:underline">https://syncjornada.online</a></p>
                </div>

                <div class="mt-12 pt-6 border-t">
                    <p class="text-sm text-gray-500 text-center">
                        Al utilizar SyncJornada, aceptas esta Política de Privacidad y nuestros 
                        <a href="{{ route('terms') }}" class="text-blue-600 hover:underline">Términos y Condiciones</a>.
                    </p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="/" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-home mr-2"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</body>
</html>
