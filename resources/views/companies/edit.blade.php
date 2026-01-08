<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('companies.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="cif" class="block text-sm font-medium text-gray-700">CIF</label>
                            <input type="text" name="cif" id="cif" value="{{ old('cif', $company->cif) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="A12345678">
                            @error('cif') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $company->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address', $company->address) }}</textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="timezone" class="block text-sm font-medium text-gray-700">Zona Horaria</label>
                            <select name="timezone" id="timezone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Europe/Madrid" {{ old('timezone', $company->timezone) == 'Europe/Madrid' ? 'selected' : '' }}>Europa/Madrid (GMT+1)</option>
                                <option value="Europe/London" {{ old('timezone', $company->timezone) == 'Europe/London' ? 'selected' : '' }}>Europa/Londres (GMT+0)</option>
                                <option value="America/New_York" {{ old('timezone', $company->timezone) == 'America/New_York' ? 'selected' : '' }}>América/Nueva York (GMT-5)</option>
                                <option value="America/Los_Angeles" {{ old('timezone', $company->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>América/Los Ángeles (GMT-8)</option>
                                <option value="America/Mexico_City" {{ old('timezone', $company->timezone) == 'America/Mexico_City' ? 'selected' : '' }}>América/Ciudad de México (GMT-6)</option>
                                <option value="America/Argentina/Buenos_Aires" {{ old('timezone', $company->timezone) == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }}>América/Buenos Aires (GMT-3)</option>
                                <option value="UTC" {{ old('timezone', $company->timezone) == 'UTC' ? 'selected' : '' }}>UTC (GMT+0)</option>
                            </select>
                            @error('timezone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Configuración de Notificaciones -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-bell mr-2 text-blue-600"></i>
                                Configuración de Notificaciones
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Notificación de Check-in -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="mb-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="enable_checkin_notifications" value="1" 
                                                {{ old('enable_checkin_notifications', $company->enable_checkin_notifications ?? true) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm font-medium text-gray-700">Activar recordatorio de entrada</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label for="checkin_notification_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de recordatorio</label>
                                        <input type="time" name="checkin_notification_time" id="checkin_notification_time" 
                                            value="{{ old('checkin_notification_time', $company->checkin_notification_time ?? '08:00') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Se enviará email a empleados que no hayan fichado</p>
                                    </div>
                                </div>

                                <!-- Notificación de Check-out -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="mb-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="enable_checkout_notifications" value="1" 
                                                {{ old('enable_checkout_notifications', $company->enable_checkout_notifications ?? true) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm font-medium text-gray-700">Activar recordatorio de salida</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label for="checkout_notification_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de recordatorio</label>
                                        <input type="time" name="checkout_notification_time" id="checkout_notification_time" 
                                            value="{{ old('checkout_notification_time', $company->checkout_notification_time ?? '19:00') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Se enviará email a empleados con fichaje sin cerrar</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('companies.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>