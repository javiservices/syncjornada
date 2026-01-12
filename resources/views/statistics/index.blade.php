<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas de Trabajadores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Trabajador</label>
                                <select name="user_id" id="user_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Selecciona un trabajador --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} @if($user->company) - {{ $user->company->name }}@endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                                <input type="date" name="date_from" id="date_from" value="{{ $dateFrom }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Hasta</label>
                                <input type="date" name="date_to" id="date_to" value="{{ $dateTo }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                                Ver Estadísticas
                            </button>
                            <a href="{{ route('statistics.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @if($selectedUser && $statistics)
            <!-- Header con info del trabajador -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg mb-6 p-6 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $selectedUser->name }}</h3>
                        <p class="text-blue-100">{{ $selectedUser->company->name ?? 'Sin empresa' }} • {{ $selectedUser->email }}</p>
                        <p class="text-sm text-blue-200 mt-1">Periodo: {{ \Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}</p>
                    </div>
                    <div class="lg:text-right">
                        <div class="text-4xl font-bold text-white">{{ $statistics['total_hours'] }}h {{ $statistics['total_minutes'] }}m</div>
                        <div class="text-blue-100">Horas totales</div>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de estadísticas principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                <!-- Días trabajados -->
                <div class="bg-white rounded-lg shadow p-5 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Días trabajados</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statistics['days_worked'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Promedio horas/día -->
                <div class="bg-white rounded-lg shadow p-5 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Promedio/día</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statistics['avg_hours'] }}h {{ $statistics['avg_minutes'] }}m</p>
                        </div>
                    </div>
                </div>

                <!-- Trabajo remoto -->
                <div class="bg-white rounded-lg shadow p-5 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Trabajo remoto</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statistics['remote_percentage'] }}%</p>
                            <p class="text-xs text-gray-500">{{ $statistics['remote_entries'] }} de {{ $statistics['total_entries'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Fichajes pendientes -->
                <div class="bg-white rounded-lg shadow p-5 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-100 rounded-lg p-3">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Sin cerrar</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $statistics['pending_checkouts'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos y detalles -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Horas por día de la semana -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Horas por día de la semana</h3>
                    <div class="space-y-3">
                        @foreach($statistics['day_of_week_data'] as $dayData)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $dayData['day'] }}</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $dayData['hours'] }}h ({{ $dayData['entries'] }} días)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, ($dayData['hours'] / 10) * 100) }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Información adicional</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Entrada más temprana</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $statistics['earliest_check_in'] ?? 'N/A' }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Salida más tardía</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $statistics['latest_check_out'] ?? 'N/A' }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Total fichajes</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $statistics['total_entries'] }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Fichajes completos</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $statistics['completed_entries'] }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Descansos totales</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $statistics['total_breaks'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horas por semana -->
            @if(count($statistics['weekly_data']) > 0)
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Horas por semana</h3>
                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semana</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visual</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($statistics['weekly_data'] as $week)
                            <tr>
                                <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $week['label'] }}</td>
                                <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm text-gray-900">{{ $week['hours'] }}h</td>
                                <td class="px-4 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2 max-w-md">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, ($week['hours'] / 40) * 100) }}%"></div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Selecciona un trabajador</h3>
                <p class="text-gray-500">Elige un trabajador y un rango de fechas para ver sus estadísticas detalladas</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
