<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - SyncJornada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Registro de Jornada</h3>
                    @if($isCheckedIn)
                        <p class="text-green-600 mb-4 text-lg">Estás actualmente registrado como trabajando.</p>
                    @else
                        <p class="text-gray-600 mb-4 text-lg">No has registrado entrada hoy.</p>
                    @endif
                    <form action="{{ route('check-in-out') }}" method="POST" class="max-w-md mx-auto" role="form" aria-labelledby="check-in-out-form" id="checkInOutForm">
                        @csrf
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="mb-4">
                            <label class="inline-flex items-center text-lg">
                                <input type="checkbox" name="remote_work" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" aria-label="Marcar si el trabajo es a distancia">
                                <span class="ml-2 text-gray-700">Trabajo a distancia</span>
                            </label>
                        </div>
                        <button type="submit" style="width: 100%; background-color: {{ $isCheckedIn ? '#dc2626' : '#16a34a' }}; color: white; font-weight: bold; padding: 1rem 2rem; border-radius: 0.5rem; font-size: 1.25rem; border: 2px solid {{ $isCheckedIn ? '#dc2626' : '#16a34a' }}; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" aria-label="Registrar entrada o salida" id="checkInOutBtn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $isCheckedIn ? 'Registrar Salida' : 'Registrar Entrada' }}
                        </button>
                    </form>
                    @if(session('success'))
                        <p class="text-green-600 mt-4 text-lg font-medium">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                        <p class="text-red-600 mt-4 text-lg font-medium">{{ session('error') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Últimas Entradas</h3>
                    <table class="min-w-full divide-y divide-gray-200" role="table" aria-label="Últimas entradas de jornada">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrada</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salida</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remoto</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($timeEntries as $entry)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->check_in ? $entry->check_in->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->check_out ? $entry->check_out->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry->remote_work ? 'Sí' : 'No' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('time-entries.index') }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Ver Todas</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkInOutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('checkInOutBtn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Obteniendo ubicación...';
            btn.disabled = true;

            // Intentar obtener la ubicación
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Éxito: guardar coordenadas y enviar formulario
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;
                        
                        // Enviar el formulario
                        e.target.submit();
                    },
                    function(error) {
                        // Error: mostrar mensaje pero permitir continuar sin ubicación
                        console.warn('Error obteniendo ubicación:', error.message);
                        alert('No se pudo obtener tu ubicación. El registro se guardará sin coordenadas GPS.');
                        
                        // Enviar el formulario sin ubicación
                        e.target.submit();
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 300000 // 5 minutos
                    }
                );
            } else {
                // Geolocation no soportada
                alert('Tu navegador no soporta geolocalización. El registro se guardará sin coordenadas GPS.');
                e.target.submit();
            }
        });
    </script>
</x-app-layout>
