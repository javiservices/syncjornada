<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4f46e5; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .details { background-color: white; padding: 20px; margin: 20px 0; border-radius: 8px; border-left: 4px solid #4f46e5; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
        .button { display: inline-block; background-color: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin-top: 20px; }
        .muted { color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Su empresa ha sido aprobada</h2>
        </div>

        <div class="content">
            <p>Hola{{ isset($user->name) ? ' ' . $user->name : '' }},</p>

            <p>Hemos aprobado la solicitud de su empresa <strong>{{ $company->name }}</strong>. A continuación tiene sus credenciales temporales de acceso:</p>

            <div class="details">
                <p style="margin:0"><strong>Email:</strong> {{ $user->email }}</p>
                <p style="margin:0"><strong>Contraseña temporal:</strong> {{ $password }}</p>
            </div>

            <p>Por seguridad, le recomendamos cambiar la contraseña lo antes posible. Puede hacerlo pulsando el siguiente botón:</p>

            <p style="text-align:center;">
                <a href="{{ $resetUrl }}" class="button">Cambiar mi contraseña</a>
            </p>

            <p class="muted">Si no puede pulsar el botón, copie y pegue este enlace en su navegador:</p>
            <p style="word-break: break-all; color:#4f46e5">{{ $resetUrl }}</p>

            <p>Bienvenido a SyncJornada.</p>
        </div>

        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
