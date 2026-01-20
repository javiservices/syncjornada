<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Editar Alerta de Incidente</h1>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form action="{{ route('admin.incident-alert.update') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                        <textarea class="form-control w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="message" name="message" rows="4" required>{{ old('message', $alert->message) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                        <select class="form-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="type" name="type" required>
                            <option value="info" {{ old('type', $alert->type) == 'info' ? 'selected' : '' }}>Información</option>
                            <option value="warning" {{ old('type', $alert->type) == 'warning' ? 'selected' : '' }}>Advertencia</option>
                            <option value="danger" {{ old('type', $alert->type) == 'danger' ? 'selected' : '' }}>Peligro</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="active" name="active" value="1" {{ old('active', $alert->active) ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm text-gray-900" for="active">Activa</label>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>