<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { padding: 20px; text-align: center; border-radius: 8px 8px 0 0; color: white; }
        .header.approved { background-color: #10b981; }
        .header.rejected { background-color: #ef4444; }
        .content { background-color: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .details { background-color: white; padding: 20px; margin: 20px 0; border-radius: 8px; }
        .details.approved { border-left: 4px solid #10b981; }
        .details.rejected { border-left: 4px solid #ef4444; }
        .label { font-weight: bold; color: #6b7280; }
        .value { margin-bottom: 10px; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
        .status { padding: 8px 16px; border-radius: 20px; display: inline-block; font-weight: bold; }
        .status.approved { background-color: #d1fae5; color: #065f46; }
        .status.rejected { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header {{ $vacationRequest->status }}">
            <h2>
                @if($vacationRequest->status === 'approved')
                    ✓ Solicitud de Vacaciones Aprobada
                @else
                    ✗ Solicitud de Vacaciones Rechazada
                @endif
            </h2>
        </div>
        
        <div class="content">
            <p>Hola {{ $vacationRequest->user->name }},</p>
            
            <p>Tu solicitud de vacaciones ha sido 
                <span class="status {{ $vacationRequest->status }}">
                    {{ $vacationRequest->status === 'approved' ? 'APROBADA' : 'RECHAZADA' }}
                </span>
            </p>
            
            <div class="details {{ $vacationRequest->status }}">
                <div class="value">
                    <span class="label">Fecha de inicio:</span> {{ $vacationRequest->start_date->format('d/m/Y') }}
                </div>
                
                <div class="value">
                    <span class="label">Fecha de fin:</span> {{ $vacationRequest->end_date->format('d/m/Y') }}
                </div>
                
                <div class="value">
                    <span class="label">Total de días:</span> {{ $vacationRequest->days }}
                </div>
                
                <div class="value">
                    <span class="label">Revisado por:</span> {{ $vacationRequest->reviewer->name }}
                </div>
                
                <div class="value">
                    <span class="label">Fecha de revisión:</span> {{ $vacationRequest->reviewed_at->format('d/m/Y H:i') }}
                </div>
                
                @if($vacationRequest->manager_notes)
                <div class="value">
                    <span class="label">Notas del gerente:</span><br>
                    {{ $vacationRequest->manager_notes }}
                </div>
                @endif
            </div>
            
            @if($vacationRequest->status === 'approved')
                <p style="color: #065f46;">
                    ¡Disfruta tus vacaciones! 🌴
                </p>
            @else
                <p style="color: #991b1b;">
                    Si tienes preguntas sobre esta decisión, puedes contactar con tu gerente.
                </p>
            @endif
        </div>
        
        <div class="footer">
            <p>SyncJornada - Sistema de Gestión de Jornadas</p>
            <p>{{ config('app.url') }}</p>
        </div>
    </div>
</body>
</html>
