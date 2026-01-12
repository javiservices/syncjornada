<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - SyncJornada</title>
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
                    <h1 class="text-4xl font-bold text-gray-900">Términos y Condiciones</h1>
                </div>
                <p class="text-gray-600">Última actualización: {{ date('d/m/Y') }}</p>
            </div>

            <!-- Content -->
            <div class="prose prose-blue max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">1. Aceptación de los Términos</h2>
                <p class="text-gray-700 mb-6">
                    Al acceder y utilizar SyncJornada, aceptas estar sujeto a estos Términos y Condiciones, 
                    todas las leyes y regulaciones aplicables, y aceptas que eres responsable del cumplimiento 
                    de las leyes locales aplicables. Si no estás de acuerdo con alguno de estos términos, 
                    no utilices este servicio.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">2. Descripción del Servicio</h2>
                <p class="text-gray-700 mb-4">
                    SyncJornada es una plataforma de gestión de jornadas laborales que permite:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Registrar entradas y salidas de jornadas laborales.</li>
                    <li>Gestionar pausas y descansos.</li>
                    <li>Solicitar y aprobar vacaciones.</li>
                    <li>Generar reportes de tiempo trabajado.</li>
                    <li>Administrar usuarios y empresas (para administradores).</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">3. Registro y Cuenta</h2>
                <p class="text-gray-700 mb-4">
                    Para utilizar SyncJornada, debes:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Proporcionar información precisa y completa durante el registro.</li>
                    <li>Mantener la seguridad de tu contraseña.</li>
                    <li>Notificarnos de inmediato cualquier uso no autorizado de tu cuenta.</li>
                    <li>Ser mayor de 16 años.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Eres responsable de todas las actividades que ocurran en tu cuenta.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">4. Uso Aceptable</h2>
                <p class="text-gray-700 mb-4">
                    Al usar SyncJornada, te comprometes a:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Utilizar el servicio solo para fines lícitos.</li>
                    <li>No manipular o falsificar registros de jornada.</li>
                    <li>No intentar acceder a cuentas de otros usuarios.</li>
                    <li>No interferir con el funcionamiento del servicio.</li>
                    <li>No utilizar el servicio para distribuir malware o spam.</li>
                    <li>Cumplir con todas las leyes laborales aplicables.</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">5. Roles y Permisos</h2>
                <p class="text-gray-700 mb-4">
                    SyncJornada cuenta con tres roles principales:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li><strong>Empleado:</strong> Puede registrar jornadas, pausas y solicitar vacaciones.</li>
                    <li><strong>Manager:</strong> Además de lo anterior, puede ver y aprobar registros de su equipo.</li>
                    <li><strong>Administrador:</strong> Tiene acceso completo al sistema, incluida la gestión de empresas y usuarios.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Los administradores de la empresa son responsables de asignar los roles correctos a cada usuario.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">6. Datos y Privacidad</h2>
                <p class="text-gray-700 mb-6">
                    El uso de tus datos personales está regulado por nuestra 
                    <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Política de Privacidad</a>. 
                    Al utilizar SyncJornada, aceptas el procesamiento de tus datos según lo descrito en dicha política.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">7. Geolocalización</h2>
                <p class="text-gray-700 mb-6">
                    SyncJornada puede solicitar acceso a tu ubicación para registrar la geolocalización de las entradas y salidas. 
                    Esta funcionalidad es opcional y puedes denegarla. Sin embargo, algunas empresas pueden requerir geolocalización 
                    como parte de sus políticas internas.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">8. Publicidad</h2>
                <p class="text-gray-700 mb-6">
                    SyncJornada muestra anuncios publicitarios a través de Google AdSense para mantener el servicio gratuito. 
                    Los anuncios se muestran de manera no intrusiva y no afectan la funcionalidad principal del servicio.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">9. Propiedad Intelectual</h2>
                <p class="text-gray-700 mb-6">
                    Todo el contenido, características y funcionalidades de SyncJornada (incluidos, entre otros, el software, 
                    texto, gráficos, logotipos y marcas) son propiedad de SyncJornada y están protegidos por las leyes de 
                    propiedad intelectual. No puedes copiar, modificar, distribuir o vender ninguna parte del servicio sin 
                    nuestro consentimiento expreso.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">10. Responsabilidad y Garantías</h2>
                <p class="text-gray-700 mb-4">
                    SyncJornada se proporciona "tal cual" y "según disponibilidad". No garantizamos que:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>El servicio estará disponible en todo momento sin interrupciones.</li>
                    <li>El servicio estará libre de errores o virus.</li>
                    <li>Los resultados obtenidos serán precisos o fiables al 100%.</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    En la medida máxima permitida por la ley, SyncJornada no será responsable de daños indirectos, incidentales, 
                    especiales o consecuentes derivados del uso o la imposibilidad de usar el servicio.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">11. Cumplimiento Normativo</h2>
                <p class="text-gray-700 mb-6">
                    SyncJornada está diseñado para ayudar a las empresas a cumplir con las normativas laborales vigentes. 
                    Sin embargo, cada empresa es responsable de garantizar que su uso de la plataforma cumple con todas 
                    las leyes y regulaciones aplicables en su jurisdicción.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">12. Terminación del Servicio</h2>
                <p class="text-gray-700 mb-4">
                    Nos reservamos el derecho de:
                </p>
                <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                    <li>Suspender o terminar tu cuenta si incumples estos términos.</li>
                    <li>Modificar o discontinuar el servicio en cualquier momento.</li>
                    <li>Cambiar las tarifas (si en el futuro se implementan planes de pago).</li>
                </ul>
                <p class="text-gray-700 mb-6">
                    Puedes solicitar la eliminación de tu cuenta en cualquier momento contactándonos.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">13. Modificaciones a los Términos</h2>
                <p class="text-gray-700 mb-6">
                    Podemos actualizar estos Términos y Condiciones ocasionalmente. Te notificaremos de cualquier cambio 
                    significativo mediante un aviso en la plataforma o por correo electrónico. El uso continuado del servicio 
                    después de dichos cambios constituye tu aceptación de los nuevos términos.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">14. Ley Aplicable y Jurisdicción</h2>
                <p class="text-gray-700 mb-6">
                    Estos términos se rigen por las leyes de España. Cualquier disputa relacionada con estos términos 
                    será sometida a la jurisdicción exclusiva de los tribunales de España.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">15. Contacto</h2>
                <p class="text-gray-700 mb-4">
                    Si tienes preguntas sobre estos términos, puedes contactarnos en:
                </p>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <p class="text-gray-900"><strong>SyncJornada</strong></p>
                    <p class="text-gray-700">Email: <a href="mailto:syncjornada@ejemplo.com" class="text-blue-600 hover:underline">syncjornada@ejemplo.com</a></p>
                    <p class="text-gray-700">Web: <a href="https://syncjornada.online" class="text-blue-600 hover:underline">https://syncjornada.online</a></p>
                </div>

                <div class="mt-12 pt-6 border-t">
                    <p class="text-sm text-gray-500 text-center">
                        Al utilizar SyncJornada, aceptas estos Términos y Condiciones y nuestra 
                        <a href="{{ route('privacy-policy') }}" class="text-blue-600 hover:underline">Política de Privacidad</a>.
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
