<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 mt-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
                        <p class="mt-1 text-sm text-gray-600">Información de la empresa</p>
                    </div>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                        <a href="{{ route('companies.edit', $company->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-edit mr-2"></i>
                            Editar Empresa
                        </a>
                    @endif
                </div>
            </div>

            <!-- Company Details -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Detalles de la Empresa</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nombre</label>
                            <p class="text-base text-gray-900">{{ $company->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-base text-gray-900">
                                <a href="mailto:{{ $company->email }}" class="text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-envelope mr-1"></i>{{ $company->email }}
                                </a>
                            </p>
                        </div>
                        @if($company->phone)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Teléfono</label>
                                <p class="text-base text-gray-900">
                                    <a href="tel:{{ $company->phone }}" class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-phone mr-1"></i>{{ $company->phone }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if($company->address)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Dirección</label>
                                <p class="text-base text-gray-900">
                                    <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>{{ $company->address }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Company Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Usuarios</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $company->users->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-tie text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Managers</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $company->users->where('role', 'manager')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600">Empleados</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $company->users->where('role', 'employee')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vacation Settings -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Configuración de Vacaciones</h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('companies.update-vacation-settings', $company->id) }}">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Días laborables -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Días Laborables</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2">
                                @php
                                    $days = [
                                        1 => 'Lunes',
                                        2 => 'Martes',
                                        3 => 'Miércoles',
                                        4 => 'Jueves',
                                        5 => 'Viernes',
                                        6 => 'Sábado',
                                        0 => 'Domingo'
                                    ];
                                    $workingDays = $company->working_days ?? [1,2,3,4,5];
                                @endphp
                                @foreach($days as $value => $label)
                                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 {{ in_array($value, $workingDays) ? 'bg-blue-50 border-blue-300' : 'border-gray-300' }}">
                                        <input type="checkbox" 
                                               name="working_days[]" 
                                               value="{{ $value }}"
                                               {{ in_array($value, $workingDays) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Selecciona los días que son laborables para tu empresa</p>
                        </div>

                        <!-- Festivos -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-sm font-medium text-gray-700">Festivos de la Empresa</label>
                                <button type="button" onclick="addHoliday()" class="text-sm text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-plus mr-1"></i>Agregar Festivo
                                </button>
                            </div>
                            
                            <div id="holidays-container" class="space-y-2">
                                @foreach($company->holidays as $holiday)
                                    <div class="flex gap-2 items-start holiday-row">
                                        <input type="hidden" name="holidays[{{ $loop->index }}][id]" value="{{ $holiday->id }}">
                                        <input type="text" 
                                               name="holidays[{{ $loop->index }}][name]" 
                                               value="{{ $holiday->name }}"
                                               placeholder="Nombre del festivo"
                                               class="flex-1 rounded-md border-gray-300">
                                        <input type="date" 
                                               name="holidays[{{ $loop->index }}][date]" 
                                               value="{{ $holiday->date->format('Y-m-d') }}"
                                               class="flex-1 rounded-md border-gray-300">
                                        <button type="button" onclick="removeHoliday(this)" class="px-3 py-2 text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Los festivos no se contarán como días laborables en las vacaciones</p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                                Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Users List -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Usuarios de la Empresa</h2>
                </div>
                @if($company->users->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay usuarios</h3>
                        <p class="text-sm text-gray-600">
                            Esta empresa aún no tiene usuarios asignados
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($company->users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-blue-600"></i>
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->role === 'admin')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    <i class="fas fa-crown mr-1"></i>Administrador
                                                </span>
                                            @elseif($user->role === 'manager')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-user-tie mr-1"></i>Gerente
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-user mr-1"></i>Empleado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center text-xs font-medium text-green-600">
                                                <i class="fas fa-check-circle mr-1"></i>Activo
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let holidayIndex = {{ $company->holidays->count() }};
        
        function addHoliday() {
            const container = document.getElementById('holidays-container');
            const row = document.createElement('div');
            row.className = 'flex gap-2 items-start holiday-row';
            row.innerHTML = `
                <input type="text" 
                       name="holidays[${holidayIndex}][name]" 
                       placeholder="Nombre del festivo"
                       class="flex-1 rounded-md border-gray-300"
                       required>
                <input type="date" 
                       name="holidays[${holidayIndex}][date]" 
                       class="flex-1 rounded-md border-gray-300"
                       required>
                <button type="button" onclick="removeHoliday(this)" class="px-3 py-2 text-red-600 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(row);
            holidayIndex++;
        }
        
        function removeHoliday(button) {
            button.closest('.holiday-row').remove();
        }
    </script>
</x-app-layout>
