<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nif" class="block text-sm font-medium text-gray-700">DNI/NIE</label>
                            <input type="text" name="nif" id="nif" value="{{ old('nif', $user->nif) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="12345678Z">
                            @error('nif') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_id" class="block text-sm font-medium text-gray-700">Empresa</label>
                            @if(auth()->user()->role === 'admin')
                                <select name="company_id" id="company_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $user->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="hidden" name="company_id" value="{{ $user->company_id }}">
                                <div class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                                    {{ $user->company->name }}
                                </div>
                            @endif
                            @error('company_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                            <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>Empleado</option>
                                @if(auth()->user()->role === 'admin')
                                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Gerente</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                @endif
                            </select>
                            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <h3 class="text-md font-semibold text-gray-700 mb-3">
                                <i class="fas fa-bell mr-2"></i>Configuración de Notificaciones
                            </h3>
                            
                            <div class="mb-4">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="notify_on_daily_hours_completion" 
                                           id="notify_on_daily_hours_completion" 
                                           value="1"
                                           {{ old('notify_on_daily_hours_completion', $user->notify_on_daily_hours_completion) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm font-medium text-gray-700">
                                        Enviar correo al completar jornada diaria
                                    </span>
                                </label>
                                <p class="mt-2 ml-6 text-sm text-gray-500">
                                    <i class="fas fa-info-circle"></i>
                                    Cuando esté activado, el empleado recibirá un correo automático al alcanzar las horas esperadas.
                                </p>
                            </div>
                            
                            <div class="mb-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Horas Diarias Esperadas
                                </label>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <label for="expected_daily_hours" class="block text-xs text-gray-600 mb-1">Horas</label>
                                        <input type="number" 
                                               name="expected_daily_hours" 
                                               id="expected_daily_hours" 
                                               value="{{ old('expected_daily_hours', $user->expected_daily_hours ?? 8) }}" 
                                               min="0"
                                               max="23"
                                               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                               placeholder="8">
                                        @error('expected_daily_hours') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <span class="text-gray-400 mt-6">:</span>
                                    <div class="flex-1">
                                        <label for="expected_daily_minutes" class="block text-xs text-gray-600 mb-1">Minutos</label>
                                        <input type="number" 
                                               name="expected_daily_minutes" 
                                               id="expected_daily_minutes" 
                                               value="{{ old('expected_daily_minutes', $user->expected_daily_minutes ?? 0) }}" 
                                               min="0"
                                               max="59"
                                               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                               placeholder="0">
                                        @error('expected_daily_minutes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Ejemplos: 8h 0m = jornada completa | 6h 30m = media jornada
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex justify-end">
                            <a href="{{ route('users.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>