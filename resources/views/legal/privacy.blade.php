@extends('legal.layout')

@section('title', 'Política de Privacidad y RGPD')

@section('content')
<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Responsable del Tratamiento</h2>
<p class="mb-4">
    <strong>Identidad:</strong> SyncJornada<br>
    <strong>Email:</strong> <a href="mailto:syncjornada@gmail.com" class="text-blue-600 hover:underline">syncjornada@gmail.com</a><br>
    <strong>Sitio web:</strong> <a href="https://syncjornada.online" class="text-blue-600 hover:underline">https://syncjornada.online</a>
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Datos que Recopilamos</h2>
<p class="mb-4">Recopilamos y tratamos los siguientes datos personales:</p>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2.1 Datos de Empresas</h3>
<ul class="list-disc pl-6 mb-4">
    <li>Nombre de la empresa</li>
    <li>CIF</li>
    <li>Email de contacto</li>
    <li>Teléfono</li>
    <li>Dirección postal</li>
    <li>Zona horaria</li>
</ul>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2.2 Datos de Usuarios/Empleados</h3>
<ul class="list-disc pl-6 mb-4">
    <li>Nombre completo</li>
    <li>Email corporativo</li>
    <li>NIF/DNI</li>
    <li>Contraseña (encriptada)</li>
    <li>Rol (admin, manager, empleado)</li>
</ul>

<h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2.3 Datos de Registros Laborales</h3>
<ul class="list-disc pl-6 mb-4">
    <li>Fecha y hora de entrada/salida</li>
    <li>Duración de jornadas</li>
    <li>Pausas realizadas</li>
    <li>Geolocalización (si se activa)</li>
    <li>Dispositivo utilizado</li>
    <li>Historial de modificaciones (auditoría)</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Finalidad del Tratamiento</h2>
<p class="mb-4">Sus datos personales serán tratados para:</p>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Cumplimiento legal:</strong> Registro obligatorio de jornada laboral (RD-ley 8/2019)</li>
    <li><strong>Gestión del servicio:</strong> Administración de cuentas y funcionalidades</li>
    <li><strong>Comunicaciones:</strong> Notificaciones de entrada/salida, recordatorios</li>
    <li><strong>Facturación:</strong> Emisión de facturas y gestión de pagos</li>
    <li><strong>Soporte técnico:</strong> Atención al cliente y resolución de incidencias</li>
    <li><strong>Mejora del servicio:</strong> Análisis estadísticos anónimos</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Base Legal</h2>
<p class="mb-4">El tratamiento de sus datos se basa en:</p>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Obligación legal:</strong> Cumplimiento del RD-ley 8/2019</li>
    <li><strong>Ejecución de contrato:</strong> Prestación del servicio contratado</li>
    <li><strong>Consentimiento:</strong> Para envío de comunicaciones comerciales (opcional)</li>
    <li><strong>Interés legítimo:</strong> Prevención de fraude y seguridad</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Conservación de Datos</h2>
<p class="mb-4">
    Los datos se conservarán durante:
</p>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Registros de jornada:</strong> 4 años (obligación legal)</li>
    <li><strong>Datos de facturación:</strong> 6 años (normativa fiscal)</li>
    <li><strong>Datos de cuenta activa:</strong> Mientras dure la relación contractual</li>
    <li><strong>Datos tras cancelación:</strong> 30 días (posible recuperación), luego eliminación definitiva</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">6. Destinatarios de los Datos</h2>
<p class="mb-4">Sus datos podrán ser comunicados a:</p>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Proveedores de hosting:</strong> Servidores ubicados en la Unión Europea</li>
    <li><strong>Servicios de email:</strong> Gmail/Google Workspace (con garantías RGPD)</li>
    <li><strong>Pasarelas de pago:</strong> Para procesamiento de suscripciones</li>
    <li><strong>Autoridades competentes:</strong> Inspección de Trabajo si es requerido legalmente</li>
</ul>
<p class="mb-4">
    <strong>No vendemos ni cedemos sus datos a terceros para fines comerciales.</strong>
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">7. Sus Derechos (RGPD)</h2>
<p class="mb-4">Como interesado, tiene derecho a:</p>
<ul class="list-disc pl-6 mb-4">
    <li><strong>Acceso:</strong> Conocer qué datos tratamos sobre usted</li>
    <li><strong>Rectificación:</strong> Corregir datos inexactos o incompletos</li>
    <li><strong>Supresión:</strong> Solicitar eliminación de datos (derecho al olvido)</li>
    <li><strong>Limitación:</strong> Restringir el tratamiento en determinadas circunstancias</li>
    <li><strong>Portabilidad:</strong> Recibir sus datos en formato estructurado</li>
    <li><strong>Oposición:</strong> Oponerse al tratamiento de sus datos</li>
    <li><strong>Revocación del consentimiento:</strong> Retirar consentimientos otorgados</li>
    <li><strong>Reclamación:</strong> Presentar reclamación ante la Agencia Española de Protección de Datos (AEPD)</li>
</ul>
<p class="mb-4">
    Para ejercer sus derechos, contacte en: <a href="mailto:syncjornada@gmail.com" class="text-blue-600 hover:underline">syncjornada@gmail.com</a>
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">8. Medidas de Seguridad</h2>
<p class="mb-4">Implementamos medidas técnicas y organizativas para proteger sus datos:</p>
<ul class="list-disc pl-6 mb-4">
    <li>Cifrado SSL/TLS en todas las comunicaciones</li>
    <li>Contraseñas encriptadas con algoritmos seguros</li>
    <li>Acceso restringido por roles</li>
    <li>Copias de seguridad diarias</li>
    <li>Auditoría de accesos y modificaciones</li>
    <li>Servidores en la Unión Europea</li>
    <li>Protección contra ataques informáticos</li>
</ul>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">9. Geolocalización</h2>
<p class="mb-4">
    La geolocalización es <strong>opcional</strong> y requiere consentimiento explícito del empleado. 
    Solo se captura en el momento del fichaje y se utiliza exclusivamente para verificar la ubicación laboral.
</p>
<p class="mb-4">
    Puede desactivar la geolocalización en cualquier momento desde la configuración de su navegador.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">10. Cookies</h2>
<p class="mb-4">
    Utilizamos cookies técnicas necesarias para el funcionamiento del servicio. Consulte nuestra 
    <a href="{{ route('cookies') }}" class="text-blue-600 hover:underline">Política de Cookies</a> para más información.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">11. Transferencias Internacionales</h2>
<p class="mb-4">
    Todos los datos se almacenan en servidores ubicados en la Unión Europea. En caso de transferencias 
    internacionales, se aplicarán las garantías adecuadas previstas en el RGPD.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">12. Menores de Edad</h2>
<p class="mb-4">
    La Plataforma está dirigida a empresas y empleados mayores de 18 años. No recopilamos datos de menores conscientemente.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">13. Actualizaciones</h2>
<p class="mb-4">
    Esta política puede actualizarse periódicamente. Le notificaremos cambios significativos por email 
    y mediante aviso en la Plataforma.
</p>

<h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">14. Contacto DPO</h2>
<p class="mb-4">
    Para cuestiones relacionadas con protección de datos:
</p>
<ul class="list-none mb-4">
    <li><strong>Email:</strong> <a href="mailto:syncjornada@gmail.com" class="text-blue-600 hover:underline">syncjornada@gmail.com</a></li>
    <li><strong>Asunto:</strong> "Protección de Datos - RGPD"</li>
</ul>

<div class="bg-green-50 border-l-4 border-green-600 p-4 mt-8">
    <p class="text-sm text-green-900">
        <i class="fas fa-shield-alt mr-2"></i>
        Sus datos están protegidos según el RGPD (UE) 2016/679 y la LOPDGDD 3/2018.
    </p>
</div>
@endsection
