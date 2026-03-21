<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Jornada Laboral — SyncJornada</title>
    <style>
        /* ── Reset & base ──────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 9px; color: #1e293b; line-height: 1.45; }

        /* ── Page setup ────────────────────────────── */
        @page {
            margin: 18mm 14mm 22mm 14mm;
        }

        /* ── Header band ───────────────────────────── */
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { background: #4f46e5; color: #ffffff; padding: 16px 22px; }

        /* ── Meta info ─────────────────────────────── */
        .meta-row { margin-top: 12px; border: 1px solid #e2e8f0; }
        .meta-row table { width: 100%; border-collapse: collapse; }
        .meta-row td { padding: 7px 12px; font-size: 8.5px; border-right: 1px solid #e2e8f0; }
        .meta-row td:last-child { border-right: none; }
        .meta-label { color: #64748b; font-size: 6.5px; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600; display: block; margin-bottom: 2px; }
        .meta-val { color: #1e293b; font-weight: 600; font-size: 8.5px; }

        /* ── Stat cards ────────────────────────────── */
        .stats { margin-top: 12px; }
        .stats table { width: 100%; border-collapse: collapse; }
        .stat-box { text-align: center; padding: 8px 4px; border: 1px solid #e2e8f0; }
        .stat-num { font-size: 14px; font-weight: 700; color: #4f46e5; display: block; }
        .stat-label { font-size: 6.5px; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px; font-weight: 600; margin-top: 1px; display: block; }
        .stat-green .stat-num { color: #059669; }
        .stat-amber .stat-num { color: #d97706; }
        .stat-red .stat-num { color: #dc2626; }
        .stat-blue .stat-num { color: #2563eb; }

        /* ── Section titles ────────────────────────── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            color: #1e293b;
            margin: 16px 0 6px 0;
            padding-bottom: 3px;
            border-bottom: 2px solid #4f46e5;
        }

        /* ── Employee sub-header ───────────────────── */
        .employee-header {
            background: #f1f5f9;
            padding: 6px 10px;
            margin: 10px 0 3px 0;
            border-left: 3px solid #4f46e5;
        }
        .employee-name { font-size: 9.5px; font-weight: 700; color: #1e293b; }
        .employee-info { font-size: 7px; color: #64748b; margin-top: 1px; }

        /* ── Data table ────────────────────────────── */
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 4px; }
        .data-table thead th {
            background: #4f46e5;
            color: #ffffff;
            padding: 6px 4px;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 600;
            text-align: left;
            border: none;
        }
        .data-table tbody td {
            padding: 5px 4px;
            font-size: 8px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }
        .data-table tbody tr:nth-child(even) td { background: #f8fafc; }

        /* ── Badges ────────────────────────────────── */
        .badge {
            display: inline-block;
            padding: 1px 5px;
            border-radius: 2px;
            font-size: 6.5px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        .badge-remote { background: #dbeafe; color: #1e40af; }
        .badge-presencial { background: #d1fae5; color: #065f46; }
        .badge-modified { background: #fef3c7; color: #92400e; }
        .badge-ok { background: #d1fae5; color: #065f46; }
        .badge-incomplete { background: #fee2e2; color: #991b1b; }
        .badge-break { background: #ede9fe; color: #5b21b6; }
        .badge-pending { background: #f1f5f9; color: #64748b; }

        /* ── Breaks sub-row ────────────────────────── */
        .breaks-info { font-size: 6.5px; color: #7c3aed; margin-top: 1px; }

        /* ── Employee summary ──────────────────────── */
        .emp-summary {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 5px 10px;
            margin-bottom: 12px;
            font-size: 7.5px;
            color: #475569;
        }
        .emp-summary strong { color: #1e293b; }

        /* ── Legal box ─────────────────────────────── */
        .legal-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            padding: 10px 12px;
            margin: 16px 0 8px 0;
            font-size: 7.5px;
            color: #92400e;
        }
        .legal-box strong { font-size: 8px; }

        /* ── Audit box ─────────────────────────────── */
        .audit-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #22c55e;
            padding: 10px 12px;
            margin: 8px 0;
            font-size: 7.5px;
            color: #166534;
        }

        /* ── Footer ────────────────────────────────── */
        .page-footer {
            position: fixed;
            bottom: -12mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 6.5px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 4px;
        }

        /* ── Utilities ─────────────────────────────── */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-muted { color: #94a3b8; }
        .text-xs { font-size: 6.5px; }
        .fw-bold { font-weight: 700; }
        .nowrap { white-space: nowrap; }
    </style>
</head>
<body>

    {{-- ═══ FIXED FOOTER WITH PAGE NUMBERS ═══ --}}
    <div class="page-footer">
        <span style="font-weight:700; color:#4f46e5;">SyncJornada</span> · Registro de Jornada Laboral · Ref: {{ $docRef }}
        <script type="text/php">
            if (isset($pdf)) {
                $font = $fontMetrics->getFont('Helvetica');
                $pdf->page_text(710, 555, "Pág. {PAGE_NUM} / {PAGE_COUNT}", $font, 7, array(0.58, 0.64, 0.72));
            }
        </script>
    </div>

    {{-- ═══ HEADER BAND ═══ --}}
    <table class="header-table">
        <tr>
            <td>
                <span style="font-size:17px; font-weight:700; letter-spacing:0.5px;">REGISTRO DE JORNADA LABORAL</span><br>
                <span style="font-size:8.5px; opacity:0.85;">Conforme al Real Decreto-ley 8/2019 · Documento oficial para Inspección de Trabajo</span>
            </td>
            <td style="text-align:right; width:170px;">
                <span style="font-size:6.5px; opacity:0.7; text-transform:uppercase; letter-spacing:1px;">Referencia</span><br>
                <span style="font-size:12px; font-weight:700; letter-spacing:1.5px;">{{ $docRef }}</span><br>
                <span style="font-size:7.5px; opacity:0.7;">{{ $generatedAt->format('d/m/Y H:i') }}</span>
            </td>
        </tr>
    </table>

    {{-- ═══ META INFO ═══ --}}
    <div class="meta-row">
        <table>
            <tr>
                <td style="width:25%;">
                    <span class="meta-label">Período</span>
                    <span class="meta-val">{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</span>
                </td>
                <td style="width:25%;">
                    <span class="meta-label">Generado por</span>
                    <span class="meta-val">{{ $generatedBy->name }}</span>
                    <span class="text-xs text-muted">({{ $generatedBy->email }})</span>
                </td>
                <td style="width:25%;">
                    <span class="meta-label">Empresa</span>
                    @if($generatedBy->company)
                        <span class="meta-val">{{ $generatedBy->company->name }}</span>
                        <span class="text-xs text-muted">CIF: {{ $generatedBy->company->cif ?? '—' }}</span>
                    @else
                        <span class="meta-val">Administrador global</span>
                    @endif
                </td>
                <td style="width:25%;">
                    <span class="meta-label">Fecha de generación</span>
                    <span class="meta-val">{{ $generatedAt->format('d/m/Y H:i:s') }}</span>
                </td>
            </tr>
        </table>
    </div>

    {{-- ═══ SUMMARY STATS ═══ --}}
    <div class="stats">
        <table>
            <tr>
                <td class="stat-box">
                    <span class="stat-num">{{ $entries->count() }}</span>
                    <span class="stat-label">Registros</span>
                </td>
                <td class="stat-box">
                    <span class="stat-num">{{ $totalDays }}</span>
                    <span class="stat-label">Días completos</span>
                </td>
                <td class="stat-box">
                    <span class="stat-num">{{ floor($totalMinutes / 60) }}h {{ $totalMinutes % 60 }}m</span>
                    <span class="stat-label">Horas brutas</span>
                </td>
                <td class="stat-box stat-green">
                    <span class="stat-num">{{ floor($netMinutes / 60) }}h {{ $netMinutes % 60 }}m</span>
                    <span class="stat-label">Horas netas</span>
                </td>
                <td class="stat-box">
                    <span class="stat-num">{{ $totalBreakMinutes > 0 ? floor($totalBreakMinutes / 60) . 'h ' . ($totalBreakMinutes % 60) . 'm' : '0' }}</span>
                    <span class="stat-label">Pausas</span>
                </td>
                <td class="stat-box stat-blue">
                    @if($totalDays > 0)
                        <span class="stat-num">{{ floor(($netMinutes / $totalDays) / 60) }}h {{ round(($netMinutes / $totalDays) % 60) }}m</span>
                    @else
                        <span class="stat-num">0h</span>
                    @endif
                    <span class="stat-label">Media diaria</span>
                </td>
                <td class="stat-box stat-green">
                    <span class="stat-num">{{ $presentialCount }}</span>
                    <span class="stat-label">Presencial</span>
                </td>
                <td class="stat-box stat-blue">
                    <span class="stat-num">{{ $remoteCount }}</span>
                    <span class="stat-label">Remoto</span>
                </td>
            </tr>
        </table>
    </div>

    {{-- ═══ ENTRIES GROUPED BY EMPLOYEE ═══ --}}
    <div class="section-title">DETALLE DE REGISTROS POR EMPLEADO</div>

    @foreach($grouped as $userId => $employeeEntries)
        @php
            $emp = $employeeEntries->first()->user;
            $empMinutes = 0;
            $empBreakMin = 0;
            $empDays = 0;
            $empRemote = 0;

            foreach ($employeeEntries as $e) {
                if ($e->check_in && $e->check_out) {
                    $empMinutes += $e->check_in->diffInMinutes($e->check_out);
                    $empDays++;
                    foreach ($e->breaks as $b) {
                        if ($b->break_end) {
                            $empBreakMin += $b->break_start->diffInMinutes($b->break_end);
                        }
                    }
                }
                if ($e->remote_work) $empRemote++;
            }
            $empNet = max(0, $empMinutes - $empBreakMin);
        @endphp

        <div class="employee-header">
            <span class="employee-name">{{ $emp->name }}</span>
            <span class="employee-info">
                NIF: {{ $emp->nif ?? 'N/A' }} &nbsp;·&nbsp;
                {{ $emp->email }} &nbsp;·&nbsp;
                {{ $emp->company->name ?? '—' }}
                @if($emp->company && $emp->company->cif) (CIF: {{ $emp->company->cif }}) @endif
            </span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:62px;">Fecha</th>
                    <th style="width:44px;">Entrada</th>
                    <th style="width:44px;">Salida</th>
                    <th style="width:52px;">Bruto</th>
                    <th style="width:52px;">Pausas</th>
                    <th style="width:52px;">Neto</th>
                    <th style="width:56px;">Modalidad</th>
                    <th style="width:52px;">Estado</th>
                    <th>Notas</th>
                    <th style="width:76px;">IP</th>
                    <th style="width:58px;">Auditoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employeeEntries->sortBy('date') as $entry)
                @php
                    $grossMin = 0;
                    $breakMin = 0;
                    if ($entry->check_in && $entry->check_out) {
                        $grossMin = $entry->check_in->diffInMinutes($entry->check_out);
                        foreach ($entry->breaks as $b) {
                            if ($b->break_end) $breakMin += $b->break_start->diffInMinutes($b->break_end);
                        }
                    }
                    $netMin = max(0, $grossMin - $breakMin);

                    // Check for external modifications
                    $externalEdits = $entry->audits->filter(fn($a) => $a->action !== 'created' && $a->user_id !== $entry->user_id);
                    $wasModified = $externalEdits->count() > 0;
                @endphp
                <tr>
                    <td class="nowrap fw-bold">{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}</td>
                    <td class="nowrap">{{ $entry->check_in ? $entry->check_in->format('H:i') : '—' }}</td>
                    <td class="nowrap">{{ $entry->check_out ? $entry->check_out->format('H:i') : '—' }}</td>
                    <td class="nowrap">
                        @if($entry->check_in && $entry->check_out)
                            {{ floor($grossMin / 60) }}h {{ $grossMin % 60 }}m
                        @else
                            —
                        @endif
                    </td>
                    <td class="nowrap">
                        @if($breakMin > 0)
                            <span class="badge badge-break">{{ floor($breakMin / 60) }}h {{ $breakMin % 60 }}m</span>
                            <div class="breaks-info">
                                @foreach($entry->breaks as $brk)
                                    @if($brk->break_end)
                                        {{ $brk->break_start->format('H:i') }}–{{ $brk->break_end->format('H:i') }}@if($brk->reason) ({{ $brk->reason }})@endif<br>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="nowrap fw-bold">
                        @if($entry->check_in && $entry->check_out)
                            {{ floor($netMin / 60) }}h {{ $netMin % 60 }}m
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($entry->remote_work)
                            <span class="badge badge-remote">REMOTO</span>
                        @else
                            <span class="badge badge-presencial">PRESENCIAL</span>
                        @endif
                    </td>
                    <td>
                        @if(!$entry->check_out)
                            <span class="badge badge-incomplete">SIN SALIDA</span>
                        @elseif($entry->employee_confirmed)
                            <span class="badge badge-ok">CONFIRMADO</span>
                        @else
                            <span class="badge badge-pending">PENDIENTE</span>
                        @endif
                    </td>
                    <td style="max-width:110px; overflow:hidden; font-size:7px;">{{ Str::limit($entry->notes ?? '', 55) }}</td>
                    <td style="font-size:6.5px;" class="text-muted nowrap">{{ $entry->ip_address ?? '—' }}</td>
                    <td style="font-size:6.5px;">
                        @if($wasModified)
                            <span class="badge badge-modified">EDITADO</span>
                            @php $lastEdit = $externalEdits->sortByDesc('created_at')->first(); @endphp
                            <div style="margin-top:1px; font-size:6px; color:#92400e;">
                                {{ $lastEdit->user->name ?? 'Sistema' }}<br>
                                {{ $lastEdit->created_at->format('d/m H:i') }}
                            </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Employee summary line --}}
        <div class="emp-summary">
            <strong>{{ $emp->name }}:</strong> &nbsp;
            {{ $empDays }} días &nbsp;·&nbsp;
            {{ floor($empMinutes / 60) }}h {{ $empMinutes % 60 }}m brutas &nbsp;·&nbsp;
            @if($empBreakMin > 0) {{ floor($empBreakMin / 60) }}h {{ $empBreakMin % 60 }}m pausas &nbsp;·&nbsp; @endif
            <strong>{{ floor($empNet / 60) }}h {{ $empNet % 60 }}m netas</strong> &nbsp;·&nbsp;
            {{ $empRemote }} remoto / {{ $employeeEntries->count() - $empRemote }} presencial
        </div>
    @endforeach

    {{-- ═══ INTEGRITY & AUDIT INFO ═══ --}}
    <div class="audit-box">
        <strong>✓ INFORMACIÓN DE INTEGRIDAD Y AUDITORÍA</strong><br>
        Todos los registros contienen marcas de tiempo inmutables, direcciones IP y datos de geolocalización cifrados (AES-256)
        conforme al RGPD (Art. 32) y la LOPDGDD.
        @if($modifiedCount > 0)
            <br><span style="color:#b45309;">{{ $modifiedCount }} registro(s) modificado(s) por personal autorizado (manager/admin). Las modificaciones quedan registradas con auditoría completa.</span>
        @endif
        @if($incompleteCount > 0)
            <br><span style="color:#dc2626;">{{ $incompleteCount }} registro(s) sin fichaje de salida en el período seleccionado.</span>
        @endif
        <br>Ref: <strong>{{ $docRef }}</strong> · Empleados incluidos: <strong>{{ $grouped->count() }}</strong> · Total registros: <strong>{{ $entries->count() }}</strong>
    </div>

    {{-- ═══ LEGAL DISCLAIMER ═══ --}}
    <div class="legal-box">
        <strong>⚠ DECLARACIÓN DE VERACIDAD Y CUMPLIMIENTO NORMATIVO</strong><br>
        Este documento ha sido generado electrónicamente por <strong>SyncJornada</strong> y contiene información extraída de registros digitales inmutables.
        Los datos incluyen marcas de tiempo, geolocalización (cifrada), direcciones IP y trazabilidad de auditoría que garantizan la veracidad del registro
        conforme al <strong>Real Decreto-ley 8/2019</strong>, de 8 de marzo.
        Este documento tiene validez legal ante la <strong>Inspección de Trabajo y Seguridad Social</strong>.
        Los datos de geolocalización y auditoría detallada están disponibles bajo petición oficial.
        El tratamiento de datos personales se realiza conforme al <strong>RGPD</strong> (Reglamento UE 2016/679) y la <strong>LOPDGDD</strong> (LO 3/2018).
    </div>

    {{-- ═══ SIGNATURE AREA ═══ --}}
    <table style="width:100%; margin-top:18px; border-collapse:collapse;">
        <tr>
            <td style="width:48%; padding:16px; border:1px solid #e2e8f0; text-align:center; vertical-align:bottom;">
                <div style="border-top:1px solid #cbd5e1; margin-top:45px; padding-top:5px;">
                    <span style="font-size:7.5px; color:#64748b;">Firma del Responsable de RRHH / Representante legal</span><br>
                    <span style="font-size:6.5px; color:#94a3b8;">Nombre y cargo:</span>
                </div>
            </td>
            <td style="width:4%;"></td>
            <td style="width:48%; padding:16px; border:1px solid #e2e8f0; text-align:center; vertical-align:bottom;">
                <div style="border-top:1px solid #cbd5e1; margin-top:45px; padding-top:5px;">
                    <span style="font-size:7.5px; color:#64748b;">Firma del Representante de los Trabajadores</span><br>
                    <span style="font-size:6.5px; color:#94a3b8;">Nombre y cargo:</span>
                </div>
            </td>
        </tr>
    </table>

    <div style="text-align:center; margin-top:12px; font-size:6.5px; color:#94a3b8;">
        <strong style="color:#4f46e5;">SyncJornada</strong> · Sistema de Registro de Jornada Laboral ·
        Cumplimiento RD-ley 8/2019 · Datos alojados en la UE · RGPD y LOPDGDD<br>
        Documento generado el {{ $generatedAt->format('d/m/Y \a \l\a\s H:i:s') }} · Ref: {{ $docRef }}
    </div>

</body>
</html>
