<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Registro de Jornada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('time-entries.update', $timeEntry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Campo oculto para mantener el origen -->
                        @if(request('from'))
                            <input type="hidden" name="from" value="{{ request('from') }}">
                        @endif

                        @if(auth()->user()->role === 'employee')
                            <!-- Vista simplificada para empleados - solo pueden editar notas -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-blue-800">
                                        Solo puedes agregar o editar notas en este registro. Los demás campos están bloqueados.
                                    </p>
                                </div>
                            </div>

                            <!-- Información del registro (solo lectura) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Fecha</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($timeEntry->date)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Modalidad</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $timeEntry->remote_work ? 'Trabajo remoto' : 'Presencial' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Hora de Entrada</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $timeEntry->check_in ? $timeEntry->check_in->format('H:i') : 'No registrada' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Hora de Salida</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $timeEntry->check_out ? $timeEntry->check_out->format('H:i') : 'No registrada' }}</p>
                                </div>
                            </div>
                        @else
                            <!-- Vista completa para managers y admins -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Fecha de Entrada</label>
                                    <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date', $timeEntry->check_in ? $timeEntry->check_in->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_in_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="check_in" class="block text-sm font-medium text-gray-700">Hora de Entrada</label>
                                    <input type="time" name="check_in" id="check_in" value="{{ old('check_in', $timeEntry->check_in ? $timeEntry->check_in->format('H:i') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_in') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="check_out_date" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                                    <input type="date" name="check_out_date" id="check_out_date" value="{{ old('check_out_date', $timeEntry->check_out ? $timeEntry->check_out->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_out_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="check_out" class="block text-sm font-medium text-gray-700">Hora de Salida</label>
                                    <input type="time" name="check_out" id="check_out" value="{{ old('check_out', $timeEntry->check_out ? $timeEntry->check_out->format('H:i') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_out') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    <input type="checkbox" name="remote_work" value="1" {{ old('remote_work', $timeEntry->remote_work) ? 'checked' : '' }} class="mr-2">
                                    Trabajo a Distancia
                                </label>
                                @error('remote_work') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <!-- Campo de notas (disponible para todos) -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Notas
                            </label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Agrega notas sobre tu jornada laboral...">{{ old('notes', $timeEntry->notes) }}</textarea>
                            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('time-entries.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">Cancelar</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @if(auth()->user()->role === 'employee')
                                    Guardar Notas
                                @else
                                    Actualizar Registro
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>