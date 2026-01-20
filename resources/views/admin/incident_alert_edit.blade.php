<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Alerta de Incidente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.incident-alert.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('title', $alert->title) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                            <textarea name="message" id="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('message', $alert->message) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="info" {{ old('type', $alert->type) == 'info' ? 'selected' : '' }}>Información</option>
                                <option value="warning" {{ old('type', $alert->type) == 'warning' ? 'selected' : '' }}>Advertencia</option>
                                <option value="danger" {{ old('type', $alert->type) == 'danger' ? 'selected' : '' }}>Peligro</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="active" id="active" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('active', $alert->active) ? 'checked' : '' }}>
                                <label for="active" class="ml-2 block text-sm text-gray-900">Activa</label>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>