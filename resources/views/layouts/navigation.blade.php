<nav x-data="{ open: false, sidebarOpen: true }" class="bg-white border-b border-gray-200 shadow-sm fixed top-0 left-0 right-0 z-30" role="navigation" aria-label="Navegación principal">
    <!-- Top Navigation Bar -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-4">
                <!-- Sidebar Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                    <i class="fas fa-bars text-xl" aria-hidden="true"></i>
                </button>
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition" aria-label="Ir al Dashboard">
                        <i class="fas fa-clock text-blue-600 text-2xl" aria-hidden="true"></i>
                        <span class="text-xl font-bold text-gray-900">SyncJornada</span>
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" aria-label="Menú de usuario" aria-haspopup="true">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm" aria-hidden="true"></i>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                </div>
                            </div>
                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                            <i class="fas fa-user-circle text-gray-500" aria-hidden="true"></i>
                            <span>{{ __('Perfil') }}</span>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt text-gray-500" aria-hidden="true"></i>
                                <span>{{ __('Cerrar Sesión') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Navigation -->
<aside x-show="sidebarOpen" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200 shadow-lg z-20 overflow-y-auto"
       @click.away="if(window.innerWidth < 768) sidebarOpen = false">
    
    <nav class="px-3 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-home text-lg w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">{{ __('Dashboard') }}</span>
        </a>
        
        <!-- Jornadas -->
        <a href="{{ route('time-entries.index') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('time-entries.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-clock text-lg w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">{{ __('Jornadas') }}</span>
        </a>

        <!-- Vacaciones -->
        <a href="{{ route('vacation-requests.index') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('vacation-requests.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-umbrella-beach text-lg w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">{{ __('Vacaciones') }}</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('Administración') }}</p>
            </div>

            <!-- Empresas -->
            <a href="{{ route('companies.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-building text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Empresas') }}</span>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('users.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-users text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Usuarios') }}</span>
            </a>

            <!-- Reportes -->
            <a href="{{ route('reports.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-chart-bar text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Reportes') }}</span>
            </a>

            <!-- Estadísticas -->
            <a href="{{ route('statistics.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-chart-line text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Estadísticas') }}</span>
            </a>

            <!-- Solicitudes -->
            <a href="{{ route('company-requests.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('company-requests.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-inbox text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Solicitudes') }}</span>
            </a>

        @elseif(Auth::user()->role === 'manager')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('Gestión') }}</p>
            </div>

            <!-- Mi Empresa -->
            <a href="{{ route('companies.show', Auth::user()->company_id) }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.show') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-building text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Mi Empresa') }}</span>
            </a>

            <!-- Empleados -->
            <a href="{{ route('users.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-users text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Empleados') }}</span>
            </a>

            <!-- Reportes -->
            <a href="{{ route('reports.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-chart-bar text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Reportes') }}</span>
            </a>

            <!-- Estadísticas -->
            <a href="{{ route('statistics.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-chart-line text-lg w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">{{ __('Estadísticas') }}</span>
            </a>
        @endif
    </nav>
</aside>

<!-- Overlay para cerrar sidebar en mobile -->
<div x-show="sidebarOpen && window.innerWidth < 768" 
     @click="sidebarOpen = false"
     x-transition:enter="transition-opacity ease-linear duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-gray-900 bg-opacity-50 z-10 md:hidden"></div>

<script>
    // Guardar estado del sidebar en localStorage
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false',
            init() {
                this.$watch('sidebarOpen', value => {
                    localStorage.setItem('sidebarOpen', value);
                });
            }
        }));
    });
</script>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2.5 py-2 border border-gray-300 text-xs leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" aria-label="Menú de usuario" aria-haspopup="true">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-xs" aria-hidden="true"></i>
                                </div>
                                <div class="hidden xl:block text-xs">{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                            <i class="fas fa-user-circle text-gray-500" aria-hidden="true"></i>
                            <span>{{ __('Perfil') }}</span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span>{{ __('Cerrar Sesión') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
