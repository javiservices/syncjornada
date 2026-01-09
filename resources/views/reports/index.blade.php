<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes de Jornada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            @if(Auth::user()->role === 'admin')
                            <div>
                                <label for="company_id" class="block text-sm font-medium text-gray-700">Empresa</label>
                                <select name="company_id" id="company_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todas</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Usuario</label>
                                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700">Fecha Desde</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700">Fecha Hasta</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="remote_work" class="block text-sm font-medium text-gray-700">Remoto</label>
                                <select name="remote_work" id="remote_work" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all" {{ request('remote_work') == 'all' ? 'selected' : '' }}>Todos</option>
                                    <option value="1" {{ request('remote_work') === '1' ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ request('remote_work') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filtrar</button>
                                <a href="{{ route('reports.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Limpiar</a>
                            </div>
                        </div>
                    </form>

                    <!-- Botón de exportación oficial (normativa española) -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-blue-900">Exportación Oficial (Normativa RD-ley 8/2019)</h3>
                                <p class="text-xs text-blue-700 mt-1">Exporta los registros con auditoría completa para inspección de trabajo</p>
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('time-entries.export') }}">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
                                    <input type="hidden" name="end_date" value="{{ request('date_to', now()->format('Y-m-d')) }}">
                                    <input type="hidden" name="company_id" value="{{ request('company_id') }}">
                                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                    <input type="hidden" name="format" value="csv">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Exportar CSV
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('time-entries.export') }}">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
                                    <input type="hidden" name="end_date" value="{{ request('date_to', now()->format('Y-m-d')) }}">
                                    <input type="hidden" name="company_id" value="{{ request('company_id') }}">
                                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                    <input type="hidden" name="format" value="pdf">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Exportar PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla para desktop -->
                    <div class="hidden md:block">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if(Auth::user()->role === 'admin')
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                    @endif
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrada</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salida</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remoto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($timeEntries as $entry)
                                <tr>
                                    @if(Auth::user()->role === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->user->company->name }}</td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->check_in ? \Carbon\Carbon::parse($entry->check_in)->format('H:i') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->check_out ? \Carbon\Carbon::parse($entry->check_out)->format('H:i') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($entry->check_in && $entry->check_out)
                                            @php
                                                $totalMinutes = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out));
                                                $hours = floor($totalMinutes / 60);
                                                $minutes = $totalMinutes % 60;
                                            @endphp
                                            {{ $hours }}h {{ $minutes }}min
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->remote_work ? 'Sí' : 'No' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($entry->check_in_latitude && $entry->check_in_longitude)
                                            <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Ver check-in en mapa">
                                                📍 Check-in
                                            </a>
                                            @if($entry->check_out_latitude && $entry->check_out_longitude)
                                                <br>
                                                <a href="https://www.google.com/maps?q={{ $entry->check_out_latitude }},{{ $entry->check_out_longitude }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Ver check-out en mapa">
                                                    📍 Check-out
                                                </a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->notes ?: '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('time-entries.edit', ['time_entry' => $entry->id, 'from' => 'reports']) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition">
                                                <i class="fas fa-edit mr-1"></i>
                                                Editar
                                            </a>
                                            @if(Auth::user()->role === 'admin')
                                                <form method="POST" action="{{ route('reports.destroy', $entry) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?\n\nUsuario: {{ $entry->user->name }}\nFecha: {{ $entry->date }}\n\nEsta acción no se puede deshacer.');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Cards para móvil -->
                    <div class="md:hidden space-y-2">
                        @foreach($timeEntries as $entry)
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gray-50 px-3 py-2 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-xs font-semibold text-gray-900">{{ $entry->user->name }}</h3>
                                        @if(Auth::user()->role === 'admin')
                                        <p class="text-xs text-gray-600">{{ $entry->user->company->name }}</p>
                                        @endif
                                    </div>
                                    <span class="text-xs text-gray-600">{{ $entry->date }}</span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-3 py-2">
                                <div class="grid grid-cols-2 gap-2">
                                    <!-- Columna izquierda -->
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Entrada</span>
                                            <span class="text-xs text-gray-900">{{ $entry->check_in ? \Carbon\Carbon::parse($entry->check_in)->format('H:i') : '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Salida</span>
                                            <span class="text-xs text-gray-900">{{ $entry->check_out ? \Carbon\Carbon::parse($entry->check_out)->format('H:i') : '-' }}</span>
                                        </div>
                                    </div>

                                    <!-- Columna derecha -->
                                    <div class="space-y-1">
                                        <div class="flex justify-between">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Horas</span>
                                            <span class="text-xs text-gray-900">
                                                @if($entry->check_in && $entry->check_out)
                                                    @php
                                                        $totalMinutes = \Carbon\Carbon::parse($entry->check_in)->diffInMinutes(\Carbon\Carbon::parse($entry->check_out));
                                                        $hours = floor($totalMinutes / 60);
                                                        $minutes = $totalMinutes % 60;
                                                    @endphp
                                                    {{ $hours }}h {{ $minutes }}min
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Remoto</span>
                                            <span class="text-xs text-gray-900">{{ $entry->remote_work ? 'Sí' : 'No' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ubicación -->
                                <div class="mt-2 pt-2 border-t border-gray-200">
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</span>
                                        <span class="text-xs text-gray-900">
                                            @if($entry->check_in_latitude && $entry->check_in_longitude)
                                                <a href="https://www.google.com/maps?q={{ $entry->check_in_latitude }},{{ $entry->check_in_longitude }}" target="_blank" class="text-blue-600 hover:text-blue-800">📍 Check-in</a>
                                                @if($entry->check_out_latitude && $entry->check_out_longitude)
                                                    <br>
                                                    <a href="https://www.google.com/maps?q={{ $entry->check_out_latitude }},{{ $entry->check_out_longitude }}" target="_blank" class="text-blue-600 hover:text-blue-800">📍 Check-out</a>
                                                @endif
                                            @else
                                                No registrada
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @if($entry->notes)
                                <div class="mt-2 pt-2 border-t border-gray-200">
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</span>
                                        <span class="text-xs text-gray-900 flex-1 ml-2">{{ $entry->notes }}</span>
                                    </div>
                                </div>
                                @endif

                                <!-- Actions -->
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <div class="flex gap-2">
                                        <a href="{{ route('time-entries.edit', ['time_entry' => $entry->id, 'from' => 'reports']) }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                                            <i class="fas fa-edit mr-2"></i>
                                            Editar
                                        </a>
                                        @if(Auth::user()->role === 'admin')
                                            <form method="POST" action="{{ route('reports.destroy', $entry) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?\n\nUsuario: {{ $entry->user->name }}\nFecha: {{ $entry->date }}\n\nEsta acción no se puede deshacer.');" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-full px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{ $timeEntries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>