<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            <i class="fas fa-inbox mr-2 text-purple-600"></i>Solicitudes de Empresas
                        </h1>
                        <p class="mt-2 text-gray-600">
                            Gestiona las solicitudes de acceso para nuevas empresas
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Solicitudes</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $requests->total() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pendientes</p>
                            <p class="text-3xl font-bold text-yellow-600 mt-1">
                                {{ \App\Models\CompanyRequest::where('status', 'pending')->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Aprobadas</p>
                            <p class="text-3xl font-bold text-green-600 mt-1">
                                {{ \App\Models\CompanyRequest::where('status', 'approved')->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requests Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if($requests->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500 text-lg font-medium">No hay solicitudes aún</p>
                        <p class="text-gray-400 text-sm mt-2">Las solicitudes aparecerán aquí cuando las empresas las envíen</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table id="company-requests-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Empresa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contacto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Empleados
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teléfono
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($requests as $request)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $request->company_name }}
                                            </div>
                                            @if($request->message)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ Str::limit($request->message, 50) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $request->contact_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $request->email }}</div>
                                            @if($request->phone)
                                                <div class="text-xs text-gray-500">{{ $request->phone }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $request->employees ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $request->phone ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $request->created_at->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $request->created_at->diffForHumans() }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($request->status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-clock mr-1"></i>Pendiente
                                                </span>
                                            @elseif($request->status === 'approved')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i>Aprobada
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times mr-1"></i>Rechazada
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center space-x-2">
                                                @if($request->status === 'pending')
                                                    <form method="POST" action="{{ route('company-requests.update-status', $request) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:bg-green-50 text-green-700 shadow-sm" title="Aprobar">
                                                            <i class="fas fa-check"></i>
                                                            <span class="text-sm">Aprobar</span>
                                                        </button>
                                                    </form>

                                                    <button type="button" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:bg-red-50 text-red-700 shadow-sm reject-btn" data-id="{{ $request->id }}" data-action="{{ route('company-requests.update-status', $request) }}" title="Rechazar">
                                                        <i class="fas fa-times"></i>
                                                        <span class="text-sm">Rechazar</span>
                                                    </button>
                                                @endif

                                                <button type="button" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 shadow-sm view-btn" data-request='@json($request)' title="Ver solicitud">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="text-sm">Ver</span>
                                                </button>

                                                <a href="mailto:{{ $request->email }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-blue-700 shadow-sm" title="Enviar email">
                                                    <i class="fas fa-envelope"></i>
                                                    <span class="text-sm">Email</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($requests->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $requests->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#company-requests-table').length) {
                $('#company-requests-table').DataTable({
                    "language": {"url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
                    "pageLength": 20,
                    "order": [[5], "desc"],
                    "columnDefs": [{"orderable": false, "targets": -1}],
                    "scrollX": true
                });
            }
        });
    </script>
</x-app-layout>

<!-- Rechazo Modal -->
<div id="reject-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6">
        <h3 class="text-lg font-semibold mb-4">Motivo del rechazo</h3>
        <form id="reject-form" method="POST" action="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Notas para el solicitante</label>
                <textarea name="admin_notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Explique por qué se rechaza la solicitud (opcional)"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="reject-cancel" class="px-4 py-2 bg-gray-200 rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Enviar y rechazar</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        $('.reject-btn').on('click', function(e){
            e.preventDefault();
            var action = $(this).data('action');
            $('#reject-form').attr('action', action);
            $('#reject-modal').removeClass('hidden').addClass('flex');
        });

        $('#reject-cancel').on('click', function(){
            $('#reject-modal').removeClass('flex').addClass('hidden');
        });

        // View request modal
        $('.view-btn').on('click', function(){
            var req = $(this).data('request');
            $('#view-company').text(req.company_name || '-');
            $('#view-contact').text(req.contact_name || '-');
            $('#view-email').text(req.email || '-');
            $('#view-phone').text(req.phone || '-');
            $('#view-employees').text(req.employees || '-');
            $('#view-message').text(req.message || '-');
            $('#view-status').text(req.status || '-');
            $('#view-admin-notes').text(req.admin_notes || '-');
            $('#view-created').text(req.created_at || '-');
            $('#view-modal').removeClass('hidden').addClass('flex');
        });

        $('.view-close').on('click', function(){
            $('#view-modal').removeClass('flex').addClass('hidden');
        });
    });
</script>

<!-- Ver solicitud Modal -->
<div id="view-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-2xl p-6">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold mb-2">Detalle de la solicitud</h3>
            <button class="view-close text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <p class="text-xs text-gray-500">Empresa</p>
                <p id="view-company" class="font-medium text-gray-900">-</p>

                <p class="text-xs text-gray-500 mt-3">Contacto</p>
                <p id="view-contact" class="font-medium text-gray-900">-</p>

                <p class="text-xs text-gray-500 mt-3">Email</p>
                <p id="view-email" class="font-medium text-gray-900">-</p>

                <p class="text-xs text-gray-500 mt-3">Teléfono</p>
                <p id="view-phone" class="font-medium text-gray-900">-</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Empleados</p>
                <p id="view-employees" class="font-medium text-gray-900">-</p>

                <p class="text-xs text-gray-500 mt-3">Estado</p>
                <p id="view-status" class="font-medium text-gray-900">-</p>

                <p class="text-xs text-gray-500 mt-3">Fecha</p>
                <p id="view-created" class="font-medium text-gray-900">-</p>
            </div>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500">Mensaje</p>
            <div id="view-message" class="mt-1 p-3 bg-gray-50 rounded text-gray-800">-</div>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500">Notas del admin</p>
            <div id="view-admin-notes" class="mt-1 p-3 bg-gray-50 rounded text-gray-800">-</div>
        </div>

        <div class="flex justify-end mt-6">
            <button class="view-close px-4 py-2 bg-gray-200 rounded">Cerrar</button>
        </div>
    </div>
</div>
