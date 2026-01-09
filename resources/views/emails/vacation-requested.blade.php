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
        .label { font-weight: bold; color: #6b7280; }
        .value { margin-bottom: 10px; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
        .button { display: inline-block; background-color: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nueva Solicitud de Vacaciones</h2>
        </div>
        
        <div class="content">
            <p>Hola,</p>
            
            <p><strong>{{ $vacationRequest->user->name }}</strong> ha solicitado vacaciones:</p>
            
            <div class="details">
                <div class="value">
                    <span class="label">Empleado:</span> {{ $vacationRequest->user->name }} ({{ $vacationRequest->user->email }})
                </div>
                
                <div class="value">
                    <span class="label">Fecha de inicio:</span> {{ $vacationRequest->start_date->format('d/m/Y') }}
                </div>
                
                <div class="value">
                    <span class="label">Fecha de fin:</span> {{ $vacationRequest->end_date->format('d/m/Y') }}
                </div>
                
                <div class="value">
                    <span class="label">Total de días:</span> {{ $vacationRequest->days }}
                </div>
                
                @if($vacationRequest->reason)
                <div class="value">
                    <span class="label">Motivo:</span><br>
                    {{ $vacationRequest->reason }}
                </div>
                @endif
            </div>
            
            <p style="text-align: center;">
                <a href="{{ route('vacation-requests.show', $vacationRequest) }}" class="button">
                    Ver Solicitud
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
