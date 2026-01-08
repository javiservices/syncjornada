@extends('legal.layout')

@section('title', 'Política de Cookies')

@section('content')
<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. ¿Qué son las Cookies?</h2>
<p class="mb-4">
    Las cookies son pequeños archivos de texto que se almacenan en su navegador cuando visita nuestro sitio web. 
    Permiten que el sitio web recuerde sus acciones y preferencias durante un período de tiempo.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. ¿Qué Cookies Utilizamos?</h2>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2.1 Cookies Técnicas (Necesarias)</h3>
<p class="mb-4">Estas cookies son esenciales para el funcionamiento de la Plataforma:</p>

<div class="bg-gray-50 rounded-lg p-4 mb-4">
    <table class="w-full text-sm">
        <thead class="border-b border-gray-300">
            <tr>
                <th class="text-left py-2 font-semibold">Nombre</th>
                <th class="text-left py-2 font-semibold">Finalidad</th>
                <th class="text-left py-2 font-semibold">Duración</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr>
                <td class="py-2 font-mono text-xs">syncjornada_session</td>
                <td class="py-2">Mantener la sesión de usuario activa</td>
                <td class="py-2">2 horas</td>
            </tr>
            <tr>
                <td class="py-2 font-mono text-xs">XSRF-TOKEN</td>
                <td class="py-2">Protección contra ataques CSRF</td>
                <td class="py-2">2 horas</td>
            </tr>
            <tr>
                <td class="py-2 font-mono text-xs">remember_token</td>
                <td class="py-2">Recordar inicio de sesión ("Recuérdame")</td>
                <td class="py-2">1 año</td>
            </tr>
            <tr>
                <td class="py-2 font-mono text-xs">cookies_accepted</td>
                <td class="py-2">Almacenar preferencias del banner de cookies</td>
                <td class="py-2">1 año</td>
            </tr>
        </tbody>
    </table>
</div>

<p class="mb-4 text-sm text-gray-600">
    <i class="fas fa-info-circle mr-2"></i>
    Las cookies técnicas NO requieren consentimiento según la normativa vigente, ya que son estrictamente necesarias para el servicio.
</p>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2.2 Cookies de Preferencias</h3>
<p class="mb-4">Permiten recordar sus preferencias:</p>

<div class="bg-gray-50 rounded-lg p-4 mb-4">
    <table class="w-full text-sm">
        <thead class="border-b border-gray-300">
            <tr>
                <th class="text-left py-2 font-semibold">Nombre</th>
                <th class="text-left py-2 font-semibold">Finalidad</th>
                <th class="text-left py-2 font-semibold">Duración</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr>
                <td class="py-2 font-mono text-xs">timezone</td>
                <td class="py-2">Almacenar zona horaria preferida</td>
                <td class="py-2">1 año</td>
            </tr>
            <tr>
                <td class="py-2 font-mono text-xs">theme</td>
                <td class="py-2">Preferencia de tema (claro/oscuro)</td>
                <td class="py-2">1 año</td>
            </tr>
        </tbody>
    </table>
</div>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Cookies de Terceros</h2>
<p class="mb-4">
    Actualmente <strong>NO utilizamos cookies de terceros</strong> para análisis, publicidad o redes sociales. 
    No compartimos información con Google Analytics, Facebook u otras plataformas publicitarias.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Finalidad de las Cookies</h2>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Autenticación:</strong> Mantener su sesión activa y segura</li>
    <li><strong>Seguridad:</strong> Protección contra ataques CSRF y accesos no autorizados</li>
    <li><strong>Funcionalidad:</strong> Recordar preferencias y configuraciones</li>
    <li><strong>Experiencia de usuario:</strong> Mejorar la navegación y usabilidad</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Gestión de Cookies</h2>
<p class="mb-4">
    Puede gestionar las cookies desde su navegador:
</p>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Google Chrome</h3>
<ol class="list-decimal pl-6 mb-4">
    <li>Menú (⋮) → Configuración → Privacidad y seguridad → Cookies</li>
    <li>Seleccione "Borrar datos de navegación" o "Configuración de sitios"</li>
</ol>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Mozilla Firefox</h3>
<ol class="list-decimal pl-6 mb-4">
    <li>Menú (☰) → Configuración → Privacidad y seguridad</li>
    <li>Sección "Cookies y datos del sitio"</li>
</ol>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Safari</h3>
<ol class="list-decimal pl-6 mb-4">
    <li>Preferencias → Privacidad</li>
    <li>Gestionar datos de sitios web</li>
</ol>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Microsoft Edge</h3>
<ol class="list-decimal pl-6 mb-4">
    <li>Configuración (⋯) → Privacidad, búsqueda y servicios</li>
    <li>Borrar datos de navegación → Elegir qué borrar</li>
</ol>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">6. Consecuencias de Deshabilitar Cookies</h2>
<div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 mb-4">
    <p class="text-sm text-yellow-900">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Advertencia:</strong> Si deshabilita las cookies técnicas, la Plataforma no funcionará correctamente. 
        No podrá iniciar sesión ni utilizar el servicio.
    </p>
</div>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">7. Consentimiento</h2>
<p class="mb-4">
    Al continuar navegando en nuestro sitio web después de cerrar el banner de cookies, usted acepta el uso de cookies 
    según lo descrito en esta política.
</p>
<p class="mb-4">
    Puede retirar su consentimiento en cualquier momento borrando las cookies de su navegador.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">8. Actualizaciones</h2>
<p class="mb-4">
    Esta política puede actualizarse cuando se implementen nuevas funcionalidades. La fecha de última actualización 
    aparece al inicio de este documento.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">9. Más Información</h2>
<p class="mb-4">
    Para más información sobre cookies y privacidad:
</p>
<ul class="list-none mb-4">
    <li>• <a href="https://www.aepd.es" target="_blank" class="text-blue-600 hover:underline">Agencia Española de Protección de Datos (AEPD)</a></li>
    <li>• <a href="https://www.allaboutcookies.org" target="_blank" class="text-blue-600 hover:underline">All About Cookies</a></li>
    <li>• <a href="https://www.youronlinechoices.com/es/" target="_blank" class="text-blue-600 hover:underline">Your Online Choices</a></li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">10. Contacto</h2>
<p class="mb-4">
    Para consultas sobre nuestra política de cookies:
</p>
<ul class="list-none mb-4">
    <li><strong>Email:</strong> <a href="mailto:syncjornada@gmail.com" class="text-blue-600 hover:underline">syncjornada@gmail.com</a></li>
    <li><strong>Web:</strong> <a href="https://syncjornada.online" class="text-blue-600 hover:underline">https://syncjornada.online</a></li>
</ul>

<div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-8">
    <p class="text-sm text-blue-900">
        <i class="fas fa-cookie-bite mr-2"></i>
        Utilizamos cookies únicamente para mejorar su experiencia y garantizar la funcionalidad del servicio.
    </p>
</div>
@endsection
