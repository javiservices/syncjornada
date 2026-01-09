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
        .warning { background-color: #fef3c7; padding: 15px; border-radius: 6px; margin: 20px 0; border-left: 4px solid #f59e0b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Restablecimiento de Contraseña</h2>
        </div>
        
        <div class="content">
            <p>Hola{{ isset($user->name) ? ' ' . $user->name : '' }},</p>
            
            <p>Has recibido este correo porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.</p>
            
            <p style="text-align: center;">
                <a href="{{ $url }}" class="button">
                    Restablecer Contraseña
                </a>
            </p>
            
            <div class="warning">
                <p style="margin: 0;"><strong>⏰ Este enlace expirará en 60 minutos.</strong></p>
            </div>
            
            <p>Si no solicitaste restablecer tu contraseña, no es necesario realizar ninguna acción. Tu cuenta permanece segura.</p>
            
            <div class="details">
                <p style="margin: 0; font-size: 12px; color: #6b7280;">
                    <strong>¿Problemas con el botón?</strong><br>
                    Copia y pega el siguiente enlace en tu navegador:
                </p>
                <p style="word-break: break-all; font-size: 12px; color: #4f46e5; margin-top: 10px;">
                    {{ $url }}
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
