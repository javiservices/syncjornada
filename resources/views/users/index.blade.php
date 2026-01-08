<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Crear Usuario</a>
                    <form method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                                <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="employee" {{ request('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    @if(auth()->user()->role === 'admin')
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    @endif
                                </select>
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div>
                                <label for="company_id" class="block text-sm font-medium text-gray-700">Empresa</label>
                                <select name="company_id" id="company_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todas</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="flex items-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filtrar</button>
                                <a href="{{ route('users.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Limpiar</a>
                            </div>
                        </div>
                    </form>
                    <!-- Tabla para desktop -->
                    <div class="hidden md:block">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->company->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($user->role) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @php
                                                $canManage = auth()->user()->role === 'admin' || 
                                                           $user->id === auth()->id() ||
                                                           (auth()->user()->role === 'manager' && !in_array($user->role, ['admin', 'manager']));
                                            @endphp
                                            
                                            @if($canManage)
                                                <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                <span class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" title="Sin permisos para editar">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            @endif
                                            
                                            @if($user->id !== auth()->id() && $canManage)
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors" onclick="return confirm('¿Estás seguro de eliminar este usuario?')" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @elseif($user->id === auth()->id())
                                                <span class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" title="No puedes eliminarte a ti mismo">
                                                    <i class="fas fa-user-shield"></i>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" title="Sin permisos para eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </span>
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
                        @foreach($users as $user)
                        <div class="bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gray-50 px-3 py-2 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-xs font-semibold text-gray-900">{{ $user->name }}</h3>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ ucfirst($user->role) }}</span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-3 py-2">
                                <div class="space-y-1">
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</span>
                                        <span class="text-xs text-gray-900">{{ $user->email }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</span>
                                        <span class="text-xs text-gray-900">{{ $user->company->name }}</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                @php
                                    $canManage = auth()->user()->role === 'admin' || 
                                               $user->id === auth()->id() ||
                                               (auth()->user()->role === 'manager' && !in_array($user->role, ['admin', 'manager']));
                                @endphp
                                
                                <div class="mt-2 pt-2 border-t border-gray-200 flex space-x-2">
                                    @if($canManage)
                                        <a href="{{ route('users.edit', $user->id) }}" class="flex-1 bg-indigo-500 text-white px-2 py-1.5 rounded text-xs font-medium text-center hover:bg-indigo-600 transition-colors">Editar</a>
                                    @else
                                        <span class="flex-1 bg-gray-300 text-gray-600 px-2 py-1.5 rounded text-xs font-medium text-center cursor-not-allowed">Editar</span>
                                    @endif
                                    
                                    @if($user->id !== auth()->id() && $canManage)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 text-white px-2 py-1.5 rounded text-xs font-medium hover:bg-red-600 transition-colors" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                    @else
                                    <span class="flex-1 bg-gray-300 text-gray-500 px-2 py-1.5 rounded text-xs font-medium text-center cursor-not-allowed">
                                        {{ $user->id === auth()->id() ? 'Tú mismo' : 'Sin permisos' }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>