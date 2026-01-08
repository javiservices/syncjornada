@extends('legal.layout')

@section('title', 'Términos y Condiciones')

@section('content')
<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Información General</h2>
<p class="mb-4">
    Bienvenido a SyncJornada. Estos Términos y Condiciones regulan el acceso y uso de la plataforma de registro de jornada laboral (en adelante, "la Plataforma") conforme al Real Decreto-ley 8/2019.
</p>
<p class="mb-4">
    Al utilizar nuestros servicios, usted acepta estar vinculado por estos términos. Si no está de acuerdo, no utilice la Plataforma.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Descripción del Servicio</h2>
<p class="mb-4">
    SyncJornada es un software de registro de jornada laboral que permite a las empresas:
</p>
<ul class="list-disc pl-6 mb-4">
    <li>Registrar entradas y salidas de empleados</li>
    <li>Gestionar pausas laborales</li>
    <li>Geolocalizar fichajes (opcional)</li>
    <li>Generar informes y exportaciones</li>
    <li>Auditar cambios en registros</li>
    <li>Cumplir con la normativa española vigente</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Registro y Cuenta de Usuario</h2>
<p class="mb-4">
    Para utilizar la Plataforma, es necesario:
</p>
<ul class="list-disc pl-6 mb-4">
    <li>Proporcionar información veraz y actualizada</li>
    <li>Mantener la confidencialidad de sus credenciales</li>
    <li>Notificar inmediatamente cualquier uso no autorizado</li>
    <li>Ser mayor de 18 años o tener autorización legal</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Uso Aceptable</h2>
<p class="mb-4">Usted se compromete a:</p>
<ul class="list-disc pl-6 mb-4">
    <li>Utilizar la Plataforma únicamente para fines legítimos</li>
    <li>No intentar acceder a áreas restringidas</li>
    <li>No interferir con el funcionamiento de la Plataforma</li>
    <li>No utilizar el servicio para actividades fraudulentas</li>
    <li>Respetar los derechos de propiedad intelectual</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Precios y Facturación</h2>
<p class="mb-4">
    Los planes de suscripción se facturan mensualmente según el número de empleados:
</p>
<ul class="list-disc pl-6 mb-4">
    <li>1-5 empleados: 5€/mes</li>
    <li>6-10 empleados: 10€/mes</li>
    <li>11+ empleados: 15€/mes</li>
</ul>
<p class="mb-4">
    Los pagos se procesan de forma segura. Los precios pueden modificarse con previo aviso de 30 días.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">6. Periodo de Prueba</h2>
<p class="mb-4">
    Ofrecemos 30 días de prueba gratuita. Durante este periodo, tiene acceso completo a todas las funcionalidades. 
    Puede cancelar en cualquier momento sin cargos.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">7. Cancelación y Reembolsos</h2>
<p class="mb-4">
    Puede cancelar su suscripción en cualquier momento desde su panel de control. La cancelación será efectiva 
    al final del periodo de facturación actual. No se realizan reembolsos por periodos parciales.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">8. Protección de Datos</h2>
<p class="mb-4">
    El tratamiento de datos personales se realiza conforme al Reglamento General de Protección de Datos (RGPD) 
    y la normativa española vigente. Consulte nuestra <a href="{{ route('privacy') }}" class="text-blue-600 hover:underline">Política de Privacidad</a> 
    para más información.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">9. Propiedad Intelectual</h2>
<p class="mb-4">
    Todos los derechos de propiedad intelectual sobre la Plataforma, incluyendo código, diseño, logotipos y 
    contenido, pertenecen a SyncJornada. No se concede ninguna licencia excepto el derecho de uso del servicio.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">10. Limitación de Responsabilidad</h2>
<p class="mb-4">
    SyncJornada proporciona la Plataforma "tal cual" y no garantiza que esté libre de errores o interrupciones. 
    No nos hacemos responsables de:
</p>
<ul class="list-disc pl-6 mb-4">
    <li>Pérdidas indirectas o consecuentes</li>
    <li>Pérdida de datos (se recomienda realizar copias de seguridad)</li>
    <li>Interrupciones del servicio por mantenimiento o causas de fuerza mayor</li>
    <li>Uso inadecuado de la Plataforma por parte del cliente</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">11. Modificaciones del Servicio</h2>
<p class="mb-4">
    Nos reservamos el derecho de modificar, suspender o descontinuar cualquier aspecto de la Plataforma 
    con previo aviso de 15 días.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">12. Legislación Aplicable</h2>
<p class="mb-4">
    Estos Términos se rigen por la legislación española. Cualquier disputa se resolverá en los tribunales 
    de España, renunciando expresamente a cualquier otro fuero.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">13. Contacto</h2>
<p class="mb-4">
    Para cualquier consulta relacionada con estos Términos y Condiciones:
</p>
<ul class="list-none mb-4">
    <li><strong>Email:</strong> <a href="mailto:syncjornada@gmail.com" class="text-blue-600 hover:underline">syncjornada@gmail.com</a></li>
    <li><strong>Web:</strong> <a href="https://syncjornada.online" class="text-blue-600 hover:underline">https://syncjornada.online</a></li>
</ul>

<div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-8">
    <p class="text-sm text-blue-900">
        <i class="fas fa-info-circle mr-2"></i>
        Al utilizar SyncJornada, confirma que ha leído, comprendido y aceptado estos Términos y Condiciones.
    </p>
</div>
@endsection
