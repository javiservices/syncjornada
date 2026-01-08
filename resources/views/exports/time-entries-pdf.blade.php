<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de Jornada Laboral</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 24px;
        }
        .header .subtitle {
            color: #666;
            margin-top: 5px;
        }
        .info-box {
            background: #f3f4f6;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #2563eb;
        }
        .info-box p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #2563eb;
            color: white;
            padding: 10px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }
        td {
            padding: 8px 5px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        .remote-badge {
            background: #dbeafe;
            color: #1e40af;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
        }
        .presential-badge {
            background: #d1fae5;
            color: #065f46;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8px;
            color: #666;
        }
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
        }
        .summary {
            background: #ede9fe;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .summary-item {
            display: inline-block;
            margin-right: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REGISTRO DE JORNADA LABORAL</h1>
        <p class="subtitle">Conforme al Real Decreto-ley 8/2019</p>
        <p class="subtitle">Documento Oficial para Inspección de Trabajo</p>
    </div>

    <div class="info-box">
        <p><strong>Período:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
        <p><strong>Generado por:</strong> {{ $generatedBy->name }} ({{ $generatedBy->email }})</p>
        <p><strong>Fecha de generación:</strong> {{ $generatedAt->format('d/m/Y H:i:s') }}</p>
        @if($generatedBy->company)
        <p><strong>Empresa:</strong> {{ $generatedBy->company->name }} - CIF: {{ $generatedBy->company->cif }}</p>
        @endif
    </div>

    @php
        $totalMinutes = 0;
        $totalDays = 0;
        $remoteEntries = 0;
        $presentialEntries = 0;
    @endphp

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Empleado</th>
                <th>NIF/NIE</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Horas</th>
                <th>Modalidad</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td>{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}</td>
                <td>{{ $entry->user->name }}</td>
                <td>{{ $entry->user->nif ?? 'N/A' }}</td>
                <td>{{ $entry->check_in ? \Carbon\Carbon::parse($entry->check_in)->format('H:i') : '-' }}</td>
                <td>{{ $entry->check_out ? \Carbon\Carbon::parse($entry->check_out)->format('H:i') : '-' }}</td>
                <td>
                    @if($entry->check_in && $entry->check_out)
                        @php
                            $minutes = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out));
                            $totalMinutes += $minutes;
                            $totalDays++;
                            $hours = floor($minutes / 60);
                            $mins = $minutes % 60;
                        @endphp
                        {{ $hours }}h {{ $mins }}min
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($entry->remote_work)
                        <span class="remote-badge">REMOTO</span>
                        @php $remoteEntries++; @endphp
                    @else
                        <span class="presential-badge">PRESENCIAL</span>
                        @php $presentialEntries++; @endphp
                    @endif
                </td>
                <td style="font-size: 7px;">{{ $entry->ip_address ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($entries->count() > 0)
    <div class="summary">
        <strong>RESUMEN DEL PERÍODO:</strong><br>
        <div class="summary-item">
            <strong>Total días registrados:</strong> {{ $totalDays }}
        </div>
        <div class="summary-item">
            <strong>Horas totales:</strong> {{ floor($totalMinutes / 60) }}h {{ $totalMinutes % 60 }}min
        </div>
        <div class="summary-item">
            <strong>Promedio diario:</strong> 
            @if($totalDays > 0)
                {{ floor(($totalMinutes / $totalDays) / 60) }}h {{ round(($totalMinutes / $totalDays) % 60) }}min
            @else
                0h 0min
            @endif
        </div>
        <br>
        <div class="summary-item">
            <strong>Presenciales:</strong> {{ $presentialEntries }}
        </div>
        <div class="summary-item">
            <strong>Remotos:</strong> {{ $remoteEntries }}
        </div>
    </div>
    @endif

    <div class="warning-box">
        <strong>⚠️ DECLARACIÓN DE VERACIDAD:</strong><br>
        Este documento contiene información extraída del sistema de registro de jornada laboral de SyncJornada.
        Los datos incluyen geolocalización, direcciones IP y marcas de tiempo inmutables que garantizan la veracidad
        del registro conforme al Real Decreto-ley 8/2019.
    </div>

    <div class="footer">
        <p><strong>SyncJornada</strong> - Sistema de Registro de Jornada Laboral</p>
        <p>Cumplimiento RD-ley 8/2019 · Datos alojados en la UE · RGPD y LOPDGDD</p>
        <p>Documento generado electrónicamente el {{ $generatedAt->format('d/m/Y H:i:s') }}</p>
        <p style="margin-top: 15px; font-size: 7px;">
            Este documento tiene validez legal ante la Inspección de Trabajo y Seguridad Social.<br>
            Los datos de geolocalización y auditoría están disponibles bajo petición.
        </p>
    </div>
</body>
</html>
