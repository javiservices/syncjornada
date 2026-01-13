<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornada Completa</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .alert-box {
            background: #f0fdf4;
            border-left: 4px solid #22c55e;
            padding: 16px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .alert-box h2 {
            margin: 0 0 8px 0;
            color: #15803d;
            font-size: 18px;
        }
        .alert-box p {
            margin: 0;
            color: #166534;
        }
        .stats {
            display: flex;
            gap: 16px;
            margin: 24px 0;
        }
        .stat-card {
            flex: 1;
            background: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-card .label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .stat-card .value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background: #f9fafb;
            color: #6b7280;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 16px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Jornada Completa</h1>
        </div>
        
        <div class="content">
            <p>Hola <strong>{{ $user->name }}</strong>,</p>
            
            <div class="alert-box">
                <h2>¡Has completado tu jornada laboral!</h2>
                <p>Has alcanzado las horas programadas para hoy. Si lo deseas, puedes registrar tu salida.</p>
            </div>
            
            <div class="stats">
                <div class="stat-card">
                    <div class="label">Horas Trabajadas</div>
                    <div class="value">{{ number_format($hoursWorked, 2) }}h</div>
                </div>
                <div class="stat-card">
                    <div class="label">Horas Esperadas</div>
                    <div class="value">{{ number_format($expectedHours, 2) }}h</div>
                </div>
            </div>
            
            <p style="margin-top: 24px;">
                Este es un recordatorio automático. Si aún tienes trabajo pendiente, puedes continuar sin problema.
            </p>
            
            <p style="margin-top: 16px; color: #6b7280; font-size: 14px;">
                <strong>Nota:</strong> Este cálculo incluye todas tus entradas y salidas del día, incluyendo pausas y reanudaciones.
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} SyncJornada. Sistema de gestión de jornadas.</p>
            <p style="margin-top: 8px; font-size: 12px;">
                Este correo es generado automáticamente. No es necesario responder.
            </p>
        </div>
    </div>
</body>
</html>
