<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #ef4444; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .details { background-color: white; padding: 20px; margin: 20px 0; border-radius: 8px; border-left: 4px solid #ef4444; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
        .muted { color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Solicitud Rechazada</h2>
        </div>

        <div class="content">
            <p>Hola{{ isset($request->contact_name) ? ' ' . $request->contact_name : ' ' . $request->email }},</p>

            <p>Lamentamos informarle que su solicitud para la empresa <strong>{{ $request->company_name }}</strong> ha sido rechazada.</p>

            @if($request->admin_notes)
                <div class="details">
                    <p style="margin:0"><strong>Motivo del rechazo:</strong></p>
                    <p style="margin-top:10px; color:#374151">{{ $request->admin_notes }}</p>
                </div>
            @endif

            <p class="muted">Si tiene preguntas o desea más información, responda a este correo.</p>
        </div>

        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
