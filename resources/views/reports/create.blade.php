<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Registro de Jornada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf

                        <!-- Selección de usuario -->
                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Trabajador <span class="text-red-500">*</span>
                            </label>
                            <select name="user_id" id="user_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Selecciona un trabajador --</option>
                                @foreach(\App\Models\User::orderBy('name')->get() as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->company->name ?? 'Sin empresa' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fecha y hora de entrada -->
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <h3 class="text-sm font-semibold text-green-900 mb-3">Entrada</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Fecha <span class="text-red-500">*</span></label>
                                    <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date', now()->format('Y-m-d')) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_in_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="check_in_time" class="block text-sm font-medium text-gray-700">Hora <span class="text-red-500">*</span></label>
                                    <input type="time" name="check_in_time" id="check_in_time" value="{{ old('check_in_time', '09:00') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_in_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Fecha y hora de salida -->
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <h3 class="text-sm font-semibold text-red-900 mb-3">Salida (opcional)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="check_out_date" class="block text-sm font-medium text-gray-700">Fecha</label>
                                    <input type="date" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_out_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="check_out_time" class="block text-sm font-medium text-gray-700">Hora</label>
                                    <input type="time" name="check_out_time" id="check_out_time" value="{{ old('check_out_time') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @error('check_out_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Modalidad -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="remote_work" value="1" {{ old('remote_work') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Trabajo Remoto</span>
                            </label>
                        </div>

                        <!-- Notas -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Notas (opcional)
                            </label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Información adicional sobre el registro...">{{ old('notes') }}</textarea>
                            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Crear Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
