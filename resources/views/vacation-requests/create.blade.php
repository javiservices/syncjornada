<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar Vacaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('vacation-requests.store') }}">
                        @csrf

                        <!-- Selector de fechas -->
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                            <input type="date" 
                                   name="start_date" 
                                   id="start_date" 
                                   value="{{ old('start_date') }}"
                                   min="{{ date('Y-m-d') }}"
                                   required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de fin</label>
                            <input type="date" 
                                   name="end_date" 
                                   id="end_date" 
                                   value="{{ old('end_date') }}"
                                   min="{{ date('Y-m-d') }}"
                                   required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mostrar días calculados -->
                        <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-700">
                                <strong>Días laborables seleccionados:</strong> 
                                <span id="working-days" class="text-indigo-600 font-bold">0</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                * Se excluyen sábados y domingos del cálculo
                            </p>
                        </div>

                        <!-- Motivo -->
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700">Motivo (opcional)</label>
                            <textarea name="reason" 
                                      id="reason" 
                                      rows="3" 
                                      maxlength="500"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('reason') }}</textarea>
                            @error('reason')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Máximo 500 caracteres</p>
                        </div>

                        <div class="flex justify-end gap-3">
                            <a href="{{ route('vacation-requests.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg">
                                Enviar Solicitud
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="font-semibold text-yellow-800 mb-2">ℹ️ Información importante</h3>
                <ul class="list-disc list-inside text-sm text-yellow-700 space-y-1">
                    <li>Tu solicitud será revisada por un gerente de la empresa</li>
                    <li>Recibirás un email cuando tu solicitud sea aprobada o rechazada</li>
                    <li>Puedes editar o eliminar solicitudes pendientes</li>
                    <li>Los sábados y domingos no se cuentan como días laborables</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Calcular días laborables
        function calculateWorkingDays() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            
            if (!startDate || !endDate) {
                document.getElementById('working-days').textContent = '0';
                return;
            }
            
            const start = new Date(startDate);
            const end = new Date(endDate);
            
            if (end < start) {
                document.getElementById('working-days').textContent = '0';
                return;
            }
            
            let count = 0;
            let current = new Date(start);
            
            while (current <= end) {
                const dayOfWeek = current.getDay();
                // Excluir sábado (6) y domingo (0)
                if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                    count++;
                }
                current.setDate(current.getDate() + 1);
            }
            
            document.getElementById('working-days').textContent = count;
        }
        
        // Agregar event listeners
        document.getElementById('start_date').addEventListener('change', calculateWorkingDays);
        document.getElementById('end_date').addEventListener('change', calculateWorkingDays);
        
        // Actualizar end_date min cuando cambia start_date
        document.getElementById('start_date').addEventListener('change', function() {
            document.getElementById('end_date').min = this.value;
            if (document.getElementById('end_date').value < this.value) {
                document.getElementById('end_date').value = this.value;
            }
            calculateWorkingDays();
        });
    </script>
</x-app-layout>
