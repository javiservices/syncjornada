<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Solicitud') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Estado -->
                    <div class="mb-6">
                        @if($vacationRequest->status === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                ⏳ Pendiente de revisión
                            </span>
                        @elseif($vacationRequest->status === 'approved')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                ✓ Aprobada
                            </span>
                        @else
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                ✗ Rechazada
                            </span>
                        @endif
                    </div>

                    <!-- Información del empleado -->
                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-semibold mb-3">Información del Empleado</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nombre</p>
                                <p class="font-medium">{{ $vacationRequest->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $vacationRequest->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detalles de las vacaciones -->
                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-semibold mb-3">Detalles de las Vacaciones</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Fecha de inicio</p>
                                <p class="font-medium">{{ $vacationRequest->start_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fecha de fin</p>
                                <p class="font-medium">{{ $vacationRequest->end_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Días laborables</p>
                                <p class="font-medium text-indigo-600 text-lg">{{ $vacationRequest->days }} días</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fecha de solicitud</p>
                                <p class="font-medium">{{ $vacationRequest->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($vacationRequest->reason)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Motivo</p>
                            <p class="font-medium bg-gray-50 p-3 rounded-lg mt-1">{{ $vacationRequest->reason }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Información de revisión -->
                    @if($vacationRequest->status !== 'pending')
                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-semibold mb-3">Información de Revisión</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Revisado por</p>
                                <p class="font-medium">{{ $vacationRequest->reviewer->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fecha de revisión</p>
                                <p class="font-medium">{{ $vacationRequest->reviewed_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($vacationRequest->manager_notes)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Notas del gerente</p>
                            <p class="font-medium bg-gray-50 p-3 rounded-lg mt-1">{{ $vacationRequest->manager_notes }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('vacation-requests.index') }}" class="text-gray-600 hover:text-gray-800">
                            ← Volver al listado
                        </a>

                        <div class="flex gap-3">
                            @if($vacationRequest->status === 'pending' && (auth()->user()->role === 'admin' || auth()->user()->role === 'manager'))
                                <!-- Modal para aprobar -->
                                <button onclick="document.getElementById('approve-modal').classList.remove('hidden')" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg">
                                    Aprobar
                                </button>

                                <!-- Modal para rechazar -->
                                <button onclick="document.getElementById('reject-modal').classList.remove('hidden')" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg">
                                    Rechazar
                                </button>
                            @endif

                            @if($vacationRequest->canBeEditedBy(auth()->user()))
                                <a href="{{ route('vacation-requests.edit', $vacationRequest) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg">
                                    Editar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de aprobación -->
    <div id="approve-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aprobar Solicitud</h3>
                <form method="POST" action="{{ route('vacation-requests.approve', $vacationRequest) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="approve_notes" class="block text-sm font-medium text-gray-700">Notas (opcional)</label>
                        <textarea name="manager_notes" 
                                  id="approve_notes" 
                                  rows="3" 
                                  maxlength="500"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('approve-modal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                            Aprobar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de rechazo -->
    <div id="reject-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Rechazar Solicitud</h3>
                <form method="POST" action="{{ route('vacation-requests.reject', $vacationRequest) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_notes" class="block text-sm font-medium text-gray-700">Motivo del rechazo (opcional)</label>
                        <textarea name="manager_notes" 
                                  id="reject_notes" 
                                  rows="3" 
                                  maxlength="500"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg">
                            Rechazar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
