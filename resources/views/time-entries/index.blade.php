<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
                {{ __('Mis Registros de Jornada') }}
            </h2>
            <div class="text-xs md:text-sm text-gray-500">
                {{ $timeEntries->total() }} registro{{ $timeEntries->total() !== 1 ? 's' : '' }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filtros mejorados -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 overflow-hidden shadow-sm sm:rounded-xl border border-blue-100">
                <div class="p-4 md:p-6">
                    <div class="flex items-center mb-3 md:mb-4">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <h3 class="text-base md:text-lg font-semibold text-gray-900">Filtros de búsqueda</h3>
                    </div>
                    <form method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ auth()->user()->role === 'manager' || auth()->user()->role === 'admin' ? '5' : '4' }} gap-3 md:gap-4">
                            <div class="space-y-2">
                                <label for="date_from" class="block text-xs md:text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Fecha Desde
                                </label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                       class="block w-full px-2 md:px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label for="date_to" class="block text-xs md:text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Fecha Hasta
                                </label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                       class="block w-full px-2 md:px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label for="remote_work" class="block text-xs md:text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Modalidad
                                </label>
                                <select name="remote_work" id="remote_work"
                                        class="block w-full px-2 md:px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="all" {{ request('remote_work') == 'all' ? 'selected' : '' }}>Todas las modalidades</option>
                                    <option value="1" {{ request('remote_work') === '1' ? 'selected' : '' }}>🏠 Trabajo remoto</option>
                                    <option value="0" {{ request('remote_work') === '0' ? 'selected' : '' }}>🏢 Presencial</option>
                                </select>
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Filtrar
                                </button>
                                <a href="{{ route('time-entries.index') }}"
                                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors flex items-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Vista de escritorio mejorada -->
            <div class="hidden xl:block">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-200">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Registros de Jornada
                            </h3>
                            <div class="text-sm text-gray-500">
                                Mostrando {{ $timeEntries->count() }} de {{ $timeEntries->total() }} registros
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                        <table id="time-entries-table" class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Usuario</th>
                                    @endif
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Fecha</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Horarios</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Duración</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Modalidad</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Ubicación</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($timeEntries as $entry)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $entry->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ ucfirst($entry->user->role) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($entry->date)->format('l') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="space-y-1">
                                            <div class="flex items-center text-sm">
                                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                                </svg>
                                                <div class="flex flex-col">
                                                    <span class="font-medium">{{ $entry->check_in ? $entry->check_in->format('H:i') : '—' }}</span>
                                                    @if($entry->check_in)
                                                    <span class="text-xs text-gray-500">{{ $entry->check_in->format('d/m/Y') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($entry->check_out)
                                            <div class="flex items-center text-sm">
                                                <svg class="w-4 h-4 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                <div class="flex flex-col">
                                                    <span class="font-medium">{{ $entry->check_out->format('H:i') }}</span>
                                                    <span class="text-xs text-gray-500">{{ $entry->check_out->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($entry->check_in && $entry->check_out)
                                            @php
                                                $totalMinutes = $entry->check_in->diffInMinutes($entry->check_out);
                                                $hours = floor($totalMinutes / 60);
                                                $minutes = $totalMinutes % 60;
                                            @endphp
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-lg font-bold text-gray-900">
                                                    {{ $hours }}h {{ $minutes }}min
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-gray-400">En curso</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($entry->remote_work)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                Remoto
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                Presencial
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($entry->check_in_latitude && $entry->check_in_longitude)
                                            <div class="space-y-1">
                                                <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}"
                                                   target="_blank"
                                                   class="flex items-center text-xs text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-2 py-1 rounded transition-colors w-fit">
                                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    Check-in
                                                </a>
                                                @if($entry->check_out_latitude && $entry->check_out_longitude)
                                                <a href="https://www.google.com/maps?q={{ $entry->check_out_latitude }},{{ $entry->check_out_longitude }}"
                                                   target="_blank"
                                                   class="flex items-center text-xs text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-2 py-1 rounded transition-colors w-fit">
                                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    Check-out
                                                </a>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Sin ubicación</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($entry->created_at->diffInHours(now()) <= 24)
                                            <div class="flex flex-wrap gap-1">
                                                @if($entry->notes)
                                                <button onclick="showNotes('{{ addslashes($entry->notes) }}')"
                                                       class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Notas
                                                </button>
                                                @endif
                                                @if(auth()->user()->role !== 'employee' || $entry->user_id === auth()->id())
                                                <a href="{{ route('time-entries.edit', $entry->id) }}"
                                                   class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    @if(auth()->user()->role === 'employee')
                                                        Agregar Notas
                                                    @else
                                                        Editar
                                                    @endif
                                                </a>
                                                @endif
                                                @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('time-entries.destroy', $entry->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">No editable</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay registros</h3>
                                        <p class="mt-1 text-sm text-gray-500">Comienza registrando tu primera jornada laboral.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Vista de tablet mejorada -->
            <div class="hidden lg:block xl:hidden space-y-4">
                @forelse($timeEntries as $entry)
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 hover:shadow-xl transition-shadow">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}</h3>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($entry->date)->format('l') }}</p>
                                </div>
                            </div>
                            @if($entry->remote_work)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Remoto
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Presencial
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="px-6 py-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Horarios</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $entry->check_in ? $entry->check_in->format('H:i') : '—' }}</span>
                                    </div>
                                    @if($entry->check_out)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $entry->check_out->format('H:i') }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Duración</h4>
                                @if($entry->check_in && $entry->check_out)
                                    @php
                                        $totalMinutes = $entry->check_in->diffInMinutes($entry->check_out);
                                        $hours = floor($totalMinutes / 60);
                                        $minutes = $totalMinutes % 60;
                                    @endphp
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-lg font-bold text-gray-900">
                                            {{ $hours }}h {{ $minutes }}min
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-400">En curso</span>
                                @endif
                            </div>
                        </div>

                        @if($entry->check_in_latitude && $entry->check_in_longitude)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Ubicación</h4>
                            <div class="flex space-x-4">
                                <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Check-in
                                </a>
                                @if($entry->check_out_latitude && $entry->check_out_longitude)
                                <a href="https://www.google.com/maps?q={{ $entry->check_out_latitude }},{{ $entry->check_out_longitude }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Check-out
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($entry->created_at->diffInHours(now()) <= 24)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @if($entry->notes)
                                <button onclick="showNotes('{{ addslashes($entry->notes) }}')"
                                       class="inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Ver Notas
                                </button>
                                @endif
                                @if(auth()->user()->role !== 'employee' || $entry->user_id === auth()->id())
                                <a href="{{ route('time-entries.edit', $entry->id) }}"
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    @if(auth()->user()->role === 'employee')
                                        Agregar Notas
                                    @else
                                        Editar
                                    @endif
                                </a>
                                @endif
                                @if(auth()->user()->role === 'admin')
                                <form action="{{ route('time-entries.destroy', $entry->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200">
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay registros</h3>
                        <p class="mt-1 text-sm text-gray-500">Comienza registrando tu primera jornada laboral.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Vista móvil (mantiene la original pero mejorada) -->
            <div class="xl:hidden space-y-4">
                @forelse($timeEntries as $entry)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}</h3>
                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($entry->date)->format('l') }}</p>
                            </div>
                        </div>
                        @if($entry->remote_work)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                🏠 Remoto
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                🏢 Presencial
                            </span>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Entrada</p>
                                <p class="font-medium">{{ $entry->check_in ? $entry->check_in->format('H:i') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Salida</p>
                                <p class="font-medium">{{ $entry->check_out ? $entry->check_out->format('H:i') : '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-1">Duración</p>
                            @if($entry->check_in && $entry->check_out)
                                @php
                                    $totalMinutes = $entry->check_in->diffInMinutes($entry->check_out);
                                    $hours = floor($totalMinutes / 60);
                                    $minutes = $totalMinutes % 60;
                                @endphp
                                <p class="text-lg font-bold text-gray-900">
                                    {{ $hours }}h {{ $minutes }}min
                                </p>
                            @else
                                <p class="text-gray-400">En curso</p>
                            @endif
                        </div>

                        @if($entry->check_in_latitude && $entry->check_in_longitude)
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Ubicación</p>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1 rounded-lg transition-colors">
                                    📍 Check-in
                                </a>
                                @if($entry->check_out_latitude && $entry->check_out_longitude)
                                <a href="https://www.google.com/maps?q={{ $entry->check_out_latitude }},{{ $entry->check_out_longitude }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1 rounded-lg transition-colors">
                                    📍 Check-out
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($entry->created_at->diffInHours(now()) <= 24)
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                            @if($entry->notes)
                            <button onclick="showNotes('{{ addslashes($entry->notes) }}')"
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Ver Notas
                            </button>
                            @endif
                            @if(auth()->user()->role !== 'employee' || $entry->user_id === auth()->id())
                            <a href="{{ route('time-entries.edit', $entry->id) }}"
                               class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                @if(auth()->user()->role === 'employee')
                                    Agregar Notas
                                @else
                                    Editar
                                @endif
                            </a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('time-entries.destroy', $entry->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                        onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                    Eliminar
                                </button>
                            </form>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay registros</h3>
                    <p class="text-gray-500">Comienza registrando tu primera jornada laboral.</p>
                </div>
                @endforelse
            </div>

            <!-- Paginación mejorada -->
            @if($timeEntries->hasPages())
            <div class="bg-white px-6 py-4 rounded-xl shadow-lg border border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Mostrando <span class="font-medium">{{ $timeEntries->firstItem() }}</span> a <span class="font-medium">{{ $timeEntries->lastItem() }}</span> de <span class="font-medium">{{ $timeEntries->total() }}</span> resultados
                    </div>
                    <div class="flex space-x-1">
                        {{ $timeEntries->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        function showNotes(notes) {
            alert('Notas del registro:\n\n' + notes);
        }
        
        $(document).ready(function() {
            $('#time-entries-table').DataTable({
                "language": {"url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
                "pageLength": 20,
                "order": [[{{ auth()->user()->role === 'manager' || auth()->user()->role === 'admin' ? '1' : '0' }}], "desc"],
                "columnDefs": [{"orderable": false, "targets": -1}],
                "scrollX": true
            });
        });
    </script>
</x-app-layout>