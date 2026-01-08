<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('companies.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Crear Empresa</a>
                        <form method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="name" id="name" value="{{ request('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="text" name="email" id="email" value="{{ request('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filtrar</button>
                                    <a href="{{ route('companies.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Limpiar</a>
                                </div>
                            </div>
                        </form>
                    @endif
                    <!-- Tabla para desktop -->
                    <div class="hidden md:block">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($companies as $company)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->phone ?: '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $company->address ?: '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('companies.show', $company->id) }}" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('companies.edit', $company->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Cards para móvil -->
                    <div class="md:hidden space-y-2">
                        @foreach($companies as $company)
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gray-50 px-3 py-2 border-b border-gray-200">
                                <h3 class="text-xs font-semibold text-gray-900">{{ $company->name }}</h3>
                            </div>

                            <!-- Content -->
                            <div class="px-3 py-2">
                                <div class="space-y-1">
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</span>
                                        <span class="text-xs text-gray-900">{{ $company->email }}</span>
                                    </div>
                                    @if($company->phone)
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</span>
                                        <span class="text-xs text-gray-900">{{ $company->phone }}</span>
                                    </div>
                                    @endif
                                    @if($company->address)
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</span>
                                        <span class="text-xs text-gray-900 flex-1 ml-2 text-right">{{ $company->address }}</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="mt-2 pt-2 border-t border-gray-200 flex {{ auth()->user()->role === 'admin' ? 'space-x-2' : '' }}">
                                    <a href="{{ route('companies.edit', $company->id) }}" class="bg-indigo-500 text-white px-3 py-2 rounded text-sm font-medium text-center hover:bg-indigo-600 transition-colors {{ auth()->user()->role === 'admin' ? 'flex-1' : 'w-full' }}">Editar</a>
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded text-sm font-medium hover:bg-red-600 transition-colors" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>