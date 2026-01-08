<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            <i class="fas fa-history text-purple-600"></i>
                            Historial de Auditoría
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Registro completo de todas las modificaciones realizadas en los fichajes
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                <form method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @if(in_array(auth()->user()->role, ['admin', 'manager']))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Empleado</label>
                            <select name="user_id" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todos</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha desde</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                   class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha hasta</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                   class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Acción</label>
                            <select name="action" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todas</option>
                                <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Creación</option>
                                <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Modificación</option>
                                <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Eliminación</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-filter mr-2"></i>Aplicar Filtros
                        </button>
                        <a href="{{ route('audits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-redo mr-2"></i>Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabla de Auditorías -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Fecha/Hora
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Empleado Afectado
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Fecha Fichaje
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Acción
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Modificado Por
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Detalles
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($audits as $audit)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $audit->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $audit->timeEntry->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $audit->timeEntry ? \Carbon\Carbon::parse($audit->timeEntry->date)->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($audit->action === 'created')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-plus-circle mr-1"></i>Creación
                                        </span>
                                    @elseif($audit->action === 'updated')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-edit mr-1"></i>Modificación
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-trash mr-1"></i>Eliminación
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $audit->user->name ?? 'Sistema' }}
                                </td>
                                <td class="px-6 py-4">
                                    <button type="button" 
                                            onclick="toggleDetails('audit-{{ $audit->id }}')"
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-eye mr-1"></i>Ver Cambios
                                    </button>
                                </td>
                            </tr>
                            <tr id="audit-{{ $audit->id }}" class="hidden bg-gray-50">
                                <td colspan="6" class="px-6 py-4">
                                    <div class="space-y-4">
                                        @if($audit->old_values)
                                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-red-900 mb-2">
                                                <i class="fas fa-arrow-left mr-2"></i>Valores Anteriores
                                            </h4>
                                            <div class="text-sm text-red-800 space-y-1">
                                                @foreach($audit->old_values as $key => $value)
                                                    <div class="flex">
                                                        <span class="font-medium w-32">{{ ucfirst($key) }}:</span>
                                                        <span>{{ is_array($value) ? json_encode($value) : ($value ?? 'NULL') }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if($audit->new_values)
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-green-900 mb-2">
                                                <i class="fas fa-arrow-right mr-2"></i>Valores Nuevos
                                            </h4>
                                            <div class="text-sm text-green-800 space-y-1">
                                                @foreach($audit->new_values as $key => $value)
                                                    <div class="flex">
                                                        <span class="font-medium w-32">{{ ucfirst($key) }}:</span>
                                                        <span>{{ is_array($value) ? json_encode($value) : ($value ?? 'NULL') }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <div class="bg-gray-100 border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-900 mb-2">
                                                <i class="fas fa-info-circle mr-2"></i>Información Técnica
                                            </h4>
                                            <div class="text-sm text-gray-700 space-y-1">
                                                <div class="flex">
                                                    <span class="font-medium w-32">IP Address:</span>
                                                    <span>{{ $audit->ip_address ?? 'N/A' }}</span>
                                                </div>
                                                <div class="flex">
                                                    <span class="font-medium w-32">User Agent:</span>
                                                    <span class="truncate">{{ $audit->user_agent ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-inbox text-4xl mb-3"></i>
                                        <p class="text-lg font-medium">No hay registros de auditoría</p>
                                        <p class="text-sm mt-1">Los cambios en los fichajes aparecerán aquí</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($audits->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $audits->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
