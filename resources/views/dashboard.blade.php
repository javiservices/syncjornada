<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title">
            @php
                $hour = now()->hour;
                $greeting = $hour < 12 ? 'Buenos días' : ($hour < 20 ? 'Buenas tardes' : 'Buenas noches');
            @endphp
            {{ $greeting }}, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h1>
        <p class="page-sub">
            {{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            @if(Auth::user()->company)
                &middot;
                <span class="inline-flex items-center gap-1 text-blue-600 font-medium">
                    <i class="fas fa-building text-xs"></i>
                    {{ Auth::user()->company->name }}
                </span>
            @endif
        </p>
    </div>
    <span class="badge {{ Auth::user()->role === 'admin' ? 'badge-indigo' : (Auth::user()->role === 'manager' ? 'badge-purple' : 'badge-blue') }} px-3 py-1.5 text-sm font-semibold capitalize">
        <i class="fas {{ Auth::user()->role === 'admin' ? 'fa-shield-halved' : (Auth::user()->role === 'manager' ? 'fa-user-tie' : 'fa-user') }} mr-1"></i>
        {{ Auth::user()->role }}
    </span>
</div>

{{-- AVISO FICHAJES PENDIENTES (admin/manager) --}}
@if(isset($pendingCheckouts) && $pendingCheckouts > 0 && in_array(Auth::user()->role, ['admin','manager']))
<div class="alert alert-warning">
    <i class="fas fa-triangle-exclamation text-lg flex-shrink-0"></i>
    <div>
        <span class="font-semibold">{{ $pendingCheckouts }} {{ $pendingCheckouts === 1 ? 'empleado tiene' : 'empleados tienen' }} fichaje sin cerrar.</span>
        <a href="{{ route('reports.index') }}" class="ml-2 underline font-medium hover:no-underline">Ver reportes →</a>
    </div>
</div>
@endif

{{-- ESTADÍSTICAS --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="stat-card">
        <div class="stat-icon bg-blue-100 text-blue-600"><i class="fas fa-clock"></i></div>
        <div>
            <p class="stat-val">{{ $hoursToday['hours'] ?? 0 }}h {{ $hoursToday['minutes'] ?? 0 }}m</p>
            <p class="stat-lbl">Hoy</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-indigo-100 text-indigo-600"><i class="fas fa-calendar-week"></i></div>
        <div>
            <p class="stat-val">{{ $hoursWeek['hours'] ?? 0 }}h {{ $hoursWeek['minutes'] ?? 0 }}m</p>
            <p class="stat-lbl">Esta semana</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-violet-100 text-violet-600"><i class="fas fa-calendar"></i></div>
        <div>
            <p class="stat-val">{{ $hoursMonth['hours'] ?? 0 }}h {{ $hoursMonth['minutes'] ?? 0 }}m</p>
            <p class="stat-lbl">Este mes</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-emerald-100 text-emerald-600"><i class="fas fa-briefcase"></i></div>
        <div>
            <p class="stat-val">{{ $daysWorked ?? 0 }}</p>
            <p class="stat-lbl">Días trabajados</p>
        </div>
    </div>
</div>

{{-- BLOQUE PRINCIPAL: FICHAR + GRÁFICO --}}
<div class="grid lg:grid-cols-5 gap-6">

    {{-- TARJETA DE FICHAJE --}}
    <div class="lg:col-span-2">
        <div class="checkin-card">
            {{-- Cabecera con gradiente --}}
            <div class="checkin-card-hd {{ $isCheckedIn ? 'bg-gradient-to-br from-emerald-600 to-emerald-700' : 'bg-gradient-to-br from-blue-600 to-indigo-700' }}">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wider {{ $isCheckedIn ? 'text-emerald-200' : 'text-blue-200' }} mb-1">Control de jornada</p>
                    @if($isCheckedIn)
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-300 animate-pulse"></span>
                            <p class="text-xl font-bold text-white" id="timer" data-start="{{ $lastEntry?->check_in?->timestamp }}">00:00:00</p>
                        </div>
                        <p class="text-sm text-emerald-200 mt-1">
                            Entrada a las {{ $lastEntry?->check_in?->format('H:i') }}
                            @if($lastEntry?->remote_work)
                                &middot; <i class="fas fa-house-laptop"></i> Remoto
                            @endif
                        </p>
                    @else
                        <p class="text-xl font-bold text-white">Sin fichar</p>
                        <p class="text-sm text-blue-200 mt-1">Registra tu entrada para empezar</p>
                    @endif
                </div>
                <div class="w-12 h-12 rounded-full {{ $isCheckedIn ? 'bg-white/15' : 'bg-white/10' }} flex items-center justify-center text-2xl flex-shrink-0">
                    @if($isCheckedIn)
                        <i class="fas fa-circle-check text-green-300"></i>
                    @else
                        <i class="far fa-circle text-blue-200"></i>
                    @endif
                </div>
            </div>

            {{-- Cuerpo del formulario --}}
            <div class="checkin-card-body">
                <form method="POST" action="{{ route('check-in-out') }}" id="checkin-form">
                    @csrf

                    {{-- Campos solo al fichar entrada --}}
                    @if(!$isCheckedIn)
                    <label class="flex items-center gap-3 bg-slate-50 rounded-xl px-4 py-3 mb-4 cursor-pointer hover:bg-slate-100 transition-colors border border-slate-200">
                        <input type="checkbox" name="remote_work" value="1" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700 font-medium">
                            <i class="fas fa-house-laptop mr-1.5 text-slate-400"></i> Trabajo remoto
                        </span>
                    </label>
                    @endif

                    <div class="field mb-4">
                        <textarea name="notes" rows="2" class="input resize-none"
                            placeholder="{{ $isCheckedIn ? 'Notas de salida (opcional)' : 'Notas de entrada (opcional)' }}"></textarea>
                    </div>

                    {{-- Campos ocultos de geolocalización --}}
                    <input type="hidden" name="latitude" id="geo-lat">
                    <input type="hidden" name="longitude" id="geo-lng">

                    <button type="submit"
                        class="w-full py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all duration-200 shadow-lg flex items-center justify-center gap-2
                        {{ $isCheckedIn
                            ? 'bg-red-500 hover:bg-red-600 active:bg-red-700 text-white'
                            : 'bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white' }}">
                        @if($isCheckedIn)
                            <i class="fas fa-arrow-right-from-bracket"></i> Registrar salida
                        @else
                            <i class="fas fa-arrow-right-to-bracket"></i> Registrar entrada
                        @endif
                    </button>
                </form>

                {{-- Info de geolocalización --}}
                @if(Auth::user()->geolocation_consent)
                <p class="text-xs text-slate-400 mt-3 flex items-center gap-1.5">
                    <i class="fas fa-location-dot"></i> GPS activado — tu ubicación se registrará
                </p>
                @endif
            </div>
        </div>
    </div>

    {{-- GRÁFICO 7 DÍAS --}}
    <div class="lg:col-span-3 card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-slate-100 text-slate-500"><i class="fas fa-chart-area"></i></span>
                <span class="card-title">Últimos 7 días</span>
            </div>
            <span class="text-xs text-slate-400 font-medium">
                Total: {{ array_sum($hoursPerDay ?? []) > 0 ? number_format(array_sum($hoursPerDay ?? []), 1) . 'h' : '0h' }}
            </span>
        </div>
        <div class="card-body">
            <canvas id="hoursChart" height="200"></canvas>
        </div>
    </div>
</div>

{{-- BLOQUE INFERIOR: EQUIPO + ÚLTIMAS JORNADAS --}}
<div class="grid {{ isset($teamStats) && $teamStats ? 'lg:grid-cols-3' : '' }} gap-6">

    {{-- EQUIPO (solo admin/manager) --}}
    @if(isset($teamStats) && $teamStats)
    <div class="lg:col-span-1 space-y-4">
        <div class="card">
            <div class="card-hd">
                <div class="card-hd-title">
                    <span class="card-icon bg-indigo-50 text-indigo-600"><i class="fas fa-users"></i></span>
                    <span class="card-title">Equipo hoy</span>
                </div>
            </div>
            <div class="card-body space-y-1 pt-0">
                <div class="flex items-center justify-between py-3.5 border-b border-slate-50">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <i class="fas fa-user-check text-emerald-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Activos ahora</span>
                    </div>
                    <span class="text-xl font-bold text-emerald-600">{{ $teamStats['active_today'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between py-3.5 border-b border-slate-50">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center">
                            <i class="fas fa-clock text-orange-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Sin cerrar</span>
                    </div>
                    <span class="text-xl font-bold text-orange-600">{{ $teamStats['pending_today'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Total empleados</span>
                    </div>
                    <span class="text-xl font-bold text-blue-600">{{ $teamStats['total_employees'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        {{-- Accesos rápidos --}}
        <div class="card">
            <div class="card-hd">
                <div class="card-hd-title">
                    <span class="card-icon bg-amber-50 text-amber-600"><i class="fas fa-bolt"></i></span>
                    <span class="card-title">Acceso rápido</span>
                </div>
            </div>
            <div class="card-body space-y-2 pt-0">
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3 py-2.5 px-1 text-sm text-slate-600 hover:text-blue-600 transition-colors group">
                    <i class="fas fa-chart-bar text-slate-400 group-hover:text-blue-500 w-5 text-center"></i>
                    <span class="font-medium">Reportes del equipo</span>
                    <i class="fas fa-chevron-right text-xs text-slate-300 ml-auto"></i>
                </a>
                <a href="{{ route('vacation-requests.index') }}" class="flex items-center gap-3 py-2.5 px-1 text-sm text-slate-600 hover:text-blue-600 transition-colors group">
                    <i class="fas fa-umbrella-beach text-slate-400 group-hover:text-blue-500 w-5 text-center"></i>
                    <span class="font-medium">Vacaciones</span>
                    <i class="fas fa-chevron-right text-xs text-slate-300 ml-auto"></i>
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 py-2.5 px-1 text-sm text-slate-600 hover:text-blue-600 transition-colors group">
                    <i class="fas fa-user-gear text-slate-400 group-hover:text-blue-500 w-5 text-center"></i>
                    <span class="font-medium">Gestión de usuarios</span>
                    <i class="fas fa-chevron-right text-xs text-slate-300 ml-auto"></i>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- JORNADAS RECIENTES --}}
    <div class="{{ isset($teamStats) && $teamStats ? 'lg:col-span-2' : '' }} card">
        <div class="card-hd">
            <div class="card-hd-title">
                <span class="card-icon bg-slate-100 text-slate-500"><i class="fas fa-list-check"></i></span>
                <span class="card-title">Jornadas recientes</span>
            </div>
            <a href="{{ route('time-entries.index') }}" class="btn btn-ghost btn-sm">
                Ver todas <i class="fas fa-arrow-right ml-1 text-xs"></i>
            </a>
        </div>
        <div class="card-body p-0">
            @if(isset($timeEntries) && $timeEntries->count() > 0)
            <div class="tbl-wrap rounded-none border-0 shadow-none">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Duración</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeEntries->take(7) as $entry)
                        <tr>
                            <td class="font-medium text-slate-900">{{ $entry->check_in?->isoFormat('ddd D MMM') }}</td>
                            <td>
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fas fa-arrow-right-to-bracket text-emerald-400 text-xs"></i>
                                    {{ $entry->check_in?->format('H:i') }}
                                </span>
                            </td>
                            <td>
                                @if($entry->check_out)
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="fas fa-arrow-right-from-bracket text-red-400 text-xs"></i>
                                        {{ $entry->check_out->format('H:i') }}
                                    </span>
                                @else
                                    <span class="badge badge-orange"><i class="fas fa-spinner fa-spin mr-1"></i>En curso</span>
                                @endif
                            </td>
                            <td>
                                @if($entry->check_out)
                                    @php $mins = $entry->check_in->diffInMinutes($entry->check_out); @endphp
                                    <span class="font-semibold text-slate-800">{{ floor($mins/60) }}h {{ $mins%60 }}m</span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td>
                                @if($entry->remote_work)
                                    <span class="badge badge-indigo"><i class="fas fa-house-laptop mr-1"></i>Remoto</span>
                                @else
                                    <span class="badge badge-gray"><i class="fas fa-building mr-1"></i>Oficina</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state py-12">
                <div class="empty-icon"><i class="fas fa-clock-rotate-left"></i></div>
                <p class="empty-title">Sin jornadas registradas</p>
                <p class="empty-text">Tus fichajes aparecerán aquí cuando empieces a registrar tu jornada.</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- RESUMEN SEMANAL --}}
@if(isset($weekEntries) && $weekEntries->count() > 0)
<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-purple-50 text-purple-600"><i class="fas fa-calendar-week"></i></span>
            <span class="card-title">Resumen de la semana</span>
        </div>
        <span class="text-xs text-slate-400">
            {{ now()->startOfWeek()->isoFormat('D MMM') }} — {{ now()->endOfWeek()->isoFormat('D MMM') }}
        </span>
    </div>
    <div class="card-body p-0">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 divide-x divide-slate-100">
            @php
                $weekDays = ['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'];
                $startWeek = now()->startOfWeek();
            @endphp
            @for($i = 0; $i < 7; $i++)
                @php
                    $day = $startWeek->copy()->addDays($i);
                    $dayStr = $day->toDateString();
                    $dayEntries = $weekEntries->where('date', $dayStr);
                    $dayMins = 0;
                    foreach($dayEntries as $we) {
                        if($we->check_out) {
                            $dayMins += \Carbon\Carbon::parse($we->check_in)->diffInMinutes(\Carbon\Carbon::parse($we->check_out));
                        }
                    }
                    $isToday = $day->isToday();
                @endphp
                <div class="flex flex-col items-center py-4 px-2 {{ $isToday ? 'bg-blue-50/50' : '' }}">
                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $isToday ? 'text-blue-600' : 'text-slate-400' }}">{{ $weekDays[$i] }}</span>
                    <span class="text-lg font-bold mt-1 {{ $dayMins > 0 ? ($isToday ? 'text-blue-600' : 'text-slate-800') : 'text-slate-300' }}">
                        {{ $dayMins > 0 ? floor($dayMins/60) . 'h' : '—' }}
                    </span>
                    @if($dayMins > 0)
                        <span class="text-[10px] text-slate-400 mt-0.5">{{ $dayMins % 60 }}m</span>
                    @endif
                    @if($isToday)
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5"></span>
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>
@endif

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function(){
    /* ── Cronómetro en vivo ────────────────────────── */
    const timerEl = document.getElementById('timer');
    if (timerEl && timerEl.dataset.start) {
        const start = parseInt(timerEl.dataset.start) * 1000;
        function tick() {
            const diff = Date.now() - start;
            const h = Math.floor(diff / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            timerEl.textContent = [h, m, s].map(n => String(n).padStart(2, '0')).join(':');
        }
        tick();
        setInterval(tick, 1000);
    }

    /* ── Geolocalización ───────────────────────────── */
    if (navigator.geolocation && document.getElementById('geo-lat')) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            document.getElementById('geo-lat').value = pos.coords.latitude;
            document.getElementById('geo-lng').value = pos.coords.longitude;
        }, function() {}, { enableHighAccuracy: true, timeout: 8000 });
    }

    /* ── Gráfico de horas ──────────────────────────── */
    const ctx = document.getElementById('hoursChart');
    if (!ctx) return;

    const labels = @json($last7Days ?? []);
    const data   = @json($hoursPerDay ?? []);
    const max    = Math.max(...data, 8);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Horas',
                data,
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const {ctx: c, chartArea} = chart;
                    if (!chartArea) return 'rgba(99,102,241,.2)';
                    const gradient = c.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                    gradient.addColorStop(0, 'rgba(99,102,241,.08)');
                    gradient.addColorStop(1, 'rgba(99,102,241,.25)');
                    return gradient;
                },
                borderColor: 'rgba(99,102,241,.9)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(99,102,241,.35)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: { duration: 600, easing: 'easeOutQuart' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 13 },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: { label: ctx => ' ' + ctx.raw.toFixed(1) + ' horas' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.ceil(max + 1),
                    grid: { color: 'rgba(0,0,0,.04)', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 11 }, callback: v => v + 'h', stepSize: 2 },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 11 } },
                    border: { display: false }
                }
            }
        }
    });
})();
</script>
@endpush

</x-app-layout>
