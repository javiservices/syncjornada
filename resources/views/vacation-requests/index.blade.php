<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vacaciones') }}
            </h2>
            <a href="{{ route('vacation-requests.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg">
                Solicitar Vacaciones
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <form method="GET" class="flex gap-4">
                        <select name="status" class="rounded-md border-gray-300">
                            <option value="">Todos los estados</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Aprobadas</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rechazadas</option>
                        </select>
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                            Filtrar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Lista de solicitudes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($vacationRequests->isEmpty())
                        <p class="text-gray-500 text-center py-8">No hay solicitudes de vacaciones.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table id="vacation-requests-table" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                                        @endif
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inicio</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Días</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha solicitud</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($vacationRequests as $request)
                                        <tr>
                                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $request->start_date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $request->end_date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $request->days }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($request->status === 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pendiente
                                                    </span>
                                                @elseif($request->status === 'approved')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Aprobada
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Rechazada
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $request->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('vacation-requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                    Ver
                                                </a>
                                                
                                                @if($request->canBeEditedBy(auth()->user()))
                                                    <a href="{{ route('vacation-requests.edit', $request) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('vacation-requests.destroy', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro?')">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $vacationRequests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#vacation-requests-table').length) {
                $('#vacation-requests-table').DataTable({
                    "language": {"url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
                    "pageLength": 20,
                    "order": [[{{ auth()->user()->role === 'admin' || auth()->user()->role === 'manager' ? '1' : '0' }}], "desc"],
                    "columnDefs": [{"orderable": false, "targets": -1}],
                    "scrollX": true
                });
            }
        });
    </script>
</x-app-layout>
