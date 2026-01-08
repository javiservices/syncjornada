<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .info-box {
            background: #dbeafe;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⏰ SyncJornada</h1>
            <p>Recordatorio Diario</p>
        </div>
        <div class="content">
            <h2>Buenos días {{ $user->name }},</h2>
            
            <div class="info-box">
                <strong>📋 Recuerda registrar tu jornada laboral</strong>
            </div>
            
            <p>Este es un recordatorio para que no olvides <strong>fichar tu entrada</strong> cuando comiences tu jornada laboral hoy.</p>
            
            <p>El registro de jornada es <strong>obligatorio según el RD-ley 8/2019</strong> y debe incluir tanto la hora de entrada como la de salida.</p>
            
            <a href="{{ route('dashboard') }}" class="button">
                Ir al Dashboard
            </a>
            
            <p style="color: #666; font-size: 14px; margin-top: 30px;">
                <strong>¿Necesitas ayuda?</strong><br>
                Si tienes alguna duda sobre cómo registrar tu jornada, contacta con tu responsable o con soporte técnico.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SyncJornada · Cumplimiento RD-ley 8/2019</p>
            <p>Este es un mensaje automático, por favor no responder.</p>
        </div>
    </div>
</body>
</html>
