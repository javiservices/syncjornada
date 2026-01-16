<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4f46e5; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Solicitud recibida</h2>
        </div>

        <div class="content">
            <p>Hola{{ isset($requestModel->contact_name) ? ' ' . $requestModel->contact_name : '' }},</p>

            <p>Hemos recibido correctamente su solicitud para crear la empresa <strong>{{ $requestModel->company_name }}</strong>. Nuestro equipo la revisará y le notificaremos cuando se tome una decisión.</p>

            <p>Resumen de la solicitud:</p>
            <ul>
                <li><strong>Empresa:</strong> {{ $requestModel->company_name }}</li>
                <li><strong>Contacto:</strong> {{ $requestModel->contact_name }}</li>
                <li><strong>Email:</strong> {{ $requestModel->email }}</li>
                <li><strong>Teléfono:</strong> {{ $requestModel->phone ?? '-' }}</li>
                <li><strong>Empleados:</strong> {{ $requestModel->employees ?? '-' }}</li>
            </ul>

            <p>Le avisaremos por correo cuando la solicitud sea revisada.</p>
        </div>

        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
