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
        .alert-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
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
            <p>Recordatorio de Fichaje</p>
        </div>
        <div class="content">
            <h2>Hola {{ $user->name }},</h2>
            
            <div class="alert-box">
                <strong>⚠️ Falta registrar tu salida</strong>
            </div>
            
            <p>Has registrado tu <strong>entrada</strong> el {{ \Carbon\Carbon::parse($timeEntry->check_in)->format('d/m/Y') }} a las <strong>{{ \Carbon\Carbon::parse($timeEntry->check_in)->format('H:i') }}</strong>, pero todavía no has registrado tu salida.</p>
            
            <p>Recuerda que es obligatorio según el RD-ley 8/2019 registrar tanto la entrada como la salida de tu jornada laboral.</p>
            
            <a href="{{ route('dashboard') }}" class="button">
                Registrar Salida Ahora
            </a>
            
            <p style="color: #666; font-size: 14px; margin-top: 30px;">
                <strong>Datos del fichaje:</strong><br>
                📅 Fecha: {{ \Carbon\Carbon::parse($timeEntry->date)->format('d/m/Y') }}<br>
                🕐 Entrada: {{ \Carbon\Carbon::parse($timeEntry->check_in)->format('H:i') }}<br>
                📍 Modalidad: {{ $timeEntry->remote_work ? 'Trabajo Remoto' : 'Presencial' }}
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SyncJornada · Cumplimiento RD-ley 8/2019</p>
            <p>Este es un mensaje automático, por favor no responder.</p>
        </div>
    </div>
</body>
</html>
