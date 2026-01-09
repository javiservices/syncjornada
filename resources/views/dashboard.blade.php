<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Hola, {{ auth()->user()->name }}
                        </h1>
                        <p class="mt-2 text-base text-gray-600">
                            {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                            @if(auth()->user()->company)
                                <span class="inline-flex items-center ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-building mr-1"></i>{{ auth()->user()->company->name }}
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Role-based Quick Info -->
                @if(auth()->user()->role === 'admin')
                    <div class="mt-6 bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-crown text-white"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Panel de Administrador</h3>
                                <p class="text-sm text-gray-700">Acceso completo al sistema. Gestiona empresas, usuarios y solicitudes desde el menú superior.</p>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->role === 'manager')
                    <div class="mt-6 bg-gradient-to-r from-green-50 to-teal-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Panel de Manager</h3>
                                <p class="text-sm text-gray-700">Supervisa registros de tiempo y genera reportes del equipo desde el menú "Reportes".</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Bienvenido a SyncJornada</h3>
                                <p class="text-sm text-gray-700">Registra tu entrada/salida abajo y revisa tu historial en "Jornadas" del menú superior.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

           <!-- Check In/Out Card - Simplified and Modern -->
            <div class="mb-6">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $isCheckedIn ? 'Registrar Salida' : 'Registrar Entrada' }}
                            </h2>
                            @if($isCheckedIn && $lastEntry)
                                <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-700 text-sm font-medium rounded-full">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                    Activo desde {{ \Carbon\Carbon::parse($lastEntry->check_in)->format('H:i') }}
                                </span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('time-entries.store') }}" id="checkInOutForm" class="space-y-4">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <input 
                                    type="checkbox" 
                                    id="is_remote" 
                                    name="is_remote" 
                                    value="1"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                >
                                <label for="is_remote" class="ml-3 text-sm font-medium text-gray-700 cursor-pointer">
                                    <i class="fas fa-home mr-1 text-gray-500"></i>
                                    Trabajo remoto
                                </label>
                            </div>

                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                            >
                                <i class="fas {{ $isCheckedIn ? 'fa-sign-out-alt' : 'fa-sign-in-alt' }}"></i>
                                {{ $isCheckedIn ? 'Registrar Salida' : 'Registrar Entrada' }}
                            </button>
                        </form>

                        {{-- Botón de Pausa/Reanudar (solo si está fichado) --}}
                        @if($isCheckedIn && $lastEntry)
                            @php
                                $activeBreak = $lastEntry->breaks()->whereNull('break_end')->first();
                            @endphp
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                @if($activeBreak)
                                    <form method="POST" action="{{ route('breaks.end', $lastEntry) }}">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 shadow-sm">
                                            <i class="fas fa-play"></i>
                                            Reanudar Trabajo
                                            <span class="ml-2 text-xs bg-green-500 px-2 py-0.5 rounded">
                                                En pausa desde {{ $activeBreak->break_start->format('H:i') }}
                                            </span>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('breaks.start', $lastEntry) }}" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label for="break-reason" class="block text-sm font-medium text-gray-700 mb-1">
                                                Motivo de la pausa
                                            </label>
                                            <select 
                                                id="break-reason"
                                                name="reason" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white shadow-sm"
                                            >
                                                <option value="Descanso">☕ Descanso</option>
                                                <option value="Comida">🍽️ Comida</option>
                                                <option value="Personal">👤 Asunto personal</option>
                                                <option value="Otro">📝 Otro</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 shadow-sm">
                                            <i class="fas fa-pause"></i>
                                            Iniciar Pausa
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif

                        <div id="locationStatus" class="mt-3 text-xs text-center text-gray-500"></div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics Cards - Professional Design -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Hours Today Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-gray-300 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Horas Hoy</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $hoursToday['hours'] }}h {{ $hoursToday['minutes'] }}min</p>
                        </div>
                    </div>
                </div>

                <!-- Hours Week Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-gray-300 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-week text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Esta Semana</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $hoursWeek['hours'] }}h {{ $hoursWeek['minutes'] }}min</p>
                        </div>
                    </div>
                </div>

                <!-- Hours Month Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-gray-300 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Este Mes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $hoursMonth['hours'] }}h {{ $hoursMonth['minutes'] }}min</p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-600">
                            <i class="fas fa-briefcase mr-1 text-gray-400"></i>{{ $daysWorked }} días trabajados</p>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-gray-300 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 {{ $isCheckedIn ? 'bg-green-100' : 'bg-gray-100' }} rounded-lg flex items-center justify-center">
                                <i class="fas {{ $isCheckedIn ? 'fa-user-check' : 'fa-user-clock' }} {{ $isCheckedIn ? 'text-green-600' : 'text-gray-600' }} text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Estado</p>
                            <p class="text-2xl font-bold {{ $isCheckedIn ? 'text-green-600' : 'text-gray-600' }}">
                                {{ $isCheckedIn ? 'Activo' : 'Inactivo' }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-600">
                            @if($pendingCheckouts > 0)
                                <i class="fas fa-exclamation-circle mr-1 text-orange-500"></i>
                                {{ $pendingCheckouts }} {{ $pendingCheckouts === 1 ? 'entrada pendiente' : 'entradas pendientes' }}
                            @else
                                <i class="fas fa-check-circle mr-1 text-green-500"></i>
                                Todo al día
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Gráficos y Estadísticas -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Gráfico de horas trabajadas -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                            Horas Trabajadas (Últimos 7 días)
                        </h3>
                    </div>
                    <div style="height: 250px;">
                        <canvas id="hoursChart"></canvas>
                    </div>
                </div>

                @if($teamStats)
                <!-- Estadísticas del equipo (solo managers/admins) -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-users mr-2 text-purple-600"></i>
                            Estado del Equipo Hoy
                        </h3>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <p class="text-3xl font-bold text-green-600">{{ $teamStats['active_today'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Activos ahora</p>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-4 text-center">
                            <p class="text-3xl font-bold text-orange-600">{{ $teamStats['pending_today'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Sin cerrar</p>
                        </div>
                    </div>
                    <div style="height: 150px;">
                        <canvas id="teamChart"></canvas>
                    </div>
                </div>
                @else
                <!-- Resumen semanal para empleados -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 border border-blue-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar-week mr-2 text-blue-600"></i>
                        Resumen de la Semana
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Horas totales:</span>
                            <span class="text-2xl font-bold text-blue-600">
                                {{ $hoursWeek['hours'] }}h {{ $hoursWeek['minutes'] }}min
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Promedio diario:</span>
                            <span class="text-lg font-semibold text-gray-900">
                                @php
                                    $avgMinutes = $hoursWeek['hours'] * 60 + $hoursWeek['minutes'];
                                    $daysWorkedWeek = $weekEntries->pluck('date')->unique()->count();
                                    if ($daysWorkedWeek > 0) {
                                        $avgDaily = $avgMinutes / $daysWorkedWeek;
                                        $avgHours = floor($avgDaily / 60);
                                        $avgMins = round($avgDaily % 60);
                                        echo "{$avgHours}h {$avgMins}min";
                                    } else {
                                        echo "0h 0min";
                                    }
                                @endphp
                            </span>
                        </div>
                        <div class="pt-4 border-t border-blue-200">
                            <p class="text-sm text-gray-600 text-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Objetivo: 40 horas semanales
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Recent Time Entries - Simplified -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Registros Recientes</h2>
                        <a href="{{ route('time-entries.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                            Ver todos →
                        </a>
                    </div>
                </div>

                @if($timeEntries->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay registros aún</h3>
                        <p class="text-sm text-gray-600">
                            Usa el botón de arriba para registrar tu primera entrada
                        </p>
                    </div>
                @else
                    <!-- Mobile View: Cards -->
                    <div class="sm:hidden divide-y divide-gray-100">
                        @foreach($timeEntries as $entry)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}
                                    </span>
                                    @if(!$entry->check_out)
                                        <span class="flex items-center text-xs font-medium text-green-600">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                            Activo
                                        </span>
                                    @elseif($entry->is_remote)
                                        <span class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-home mr-1 text-gray-500"></i>
                                            Remoto
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center justify-between text-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Entrada</p>
                                        <p class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($entry->check_in)->format('H:i') }}
                                        </p>
                                    </div>
                                    <div class="text-gray-400">→</div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500 mb-1">Salida</p>
                                        <p class="font-medium text-gray-900">
                                            {{ $entry->check_out ? \Carbon\Carbon::parse($entry->check_out)->format('H:i') : '-' }}
                                        </p>
                                    </div>
                                </div>

                                @if($entry->check_out)
                                    <div class="mt-3 pt-3 border-t border-gray-100 text-right">
                                        @php
                                            $totalMinutes = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out));
                                            $hours = floor($totalMinutes / 60);
                                            $minutes = $totalMinutes % 60;
                                        @endphp
                                        <span class="text-sm font-semibold text-gray-900">
                                            {{ $hours }}h {{ $minutes }}min
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop View: Table -->
                    <div class="hidden sm:block">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entrada</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Salida</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duración</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($timeEntries as $entry)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($entry->check_in)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $entry->check_out ? \Carbon\Carbon::parse($entry->check_out)->format('H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($entry->check_out)
                                                @php
                                                    $totalMinutes = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out));
                                                    $hours = floor($totalMinutes / 60);
                                                    $minutes = $totalMinutes % 60;
                                                @endphp
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ $hours }}h {{ $minutes }}min
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-400">-</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(!$entry->check_out)
                                                <span class="flex items-center text-xs font-medium text-green-600">
                                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                                    Activo
                                                </span>
                                            @elseif($entry->is_remote)
                                                <span class="flex items-center text-xs text-gray-600">
                                                    <i class="fas fa-home mr-1 text-gray-500"></i>
                                                    Remoto
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-500">
                                                    <i class="fas fa-building mr-1"></i>
                                                    Oficina
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Get user's location when form loads
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    document.getElementById('locationStatus').innerHTML = 
                        '<i class="fas fa-check-circle mr-1"></i> Ubicación obtenida correctamente';
                    setTimeout(() => {
                        document.getElementById('locationStatus').innerHTML = '';
                    }, 3000);
                },
                function(error) {
                    console.error('Error getting location:', error);
                    document.getElementById('locationStatus').innerHTML = 
                        '<i class="fas fa-exclamation-triangle mr-1"></i> No se pudo obtener la ubicación. Continuando sin geolocalización.';
                }
            );
        } else {
            document.getElementById('locationStatus').innerHTML = 
                '<i class="fas fa-info-circle mr-1"></i> Geolocalización no disponible en este navegador';
        }
    </script>

    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Gráfico de horas trabajadas últimos 7 días
        const ctx = document.getElementById('hoursChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($last7Days),
                    datasets: [{
                        label: 'Horas trabajadas',
                        data: @json($hoursPerDay),
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgb(37, 99, 235)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toFixed(2) + ' horas';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + 'h';
                                }
                            }
                        }
                    }
                }
            });
        }

        @if($teamStats)
        // Gráfico de empleados activos para managers/admins
        const ctxTeam = document.getElementById('teamChart');
        if (ctxTeam) {
            new Chart(ctxTeam, {
                type: 'doughnut',
                data: {
                    labels: ['Activos', 'Inactivos'],
                    datasets: [{
                        data: [{{ $teamStats['active_today'] }}, {{ $teamStats['total_employees'] - $teamStats['active_today'] }}],
                        backgroundColor: [
                            'rgb(34, 197, 94)',
                            'rgb(229, 231, 235)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
        @endif
    </script>
</x-app-layout>
