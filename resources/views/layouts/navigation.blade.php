<nav x-data="{ open: false, sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false' }" 
     x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
     class="bg-white border-b border-gray-200 shadow-sm fixed top-0 left-0 right-0 z-30" 
     role="navigation" 
     aria-label="Navegación principal">
    <!-- Top Navigation Bar -->
    <div class="px-6">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-6">
                <!-- Sidebar Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-all duration-200"
                        aria-label="Toggle sidebar">
                    <i class="fas fa-bars text-lg" aria-hidden="true"></i>
                </button>
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5 hover:opacity-80 transition" aria-label="Ir al Dashboard">
                        <i class="fas fa-clock text-blue-600 text-2xl" aria-hidden="true"></i>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">SyncJornada</span>
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150" aria-label="Menú de usuario" aria-haspopup="true">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-sm">
                                    <i class="fas fa-user text-white text-sm" aria-hidden="true"></i>
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                                </div>
                            </div>
                            <div class="ms-3 hidden md:block">
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
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
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-16 left-0 bottom-0 w-72 bg-gradient-to-b from-gray-50 to-white border-r border-gray-200 shadow-xl z-20 overflow-y-auto"
       style="scrollbar-width: thin; scrollbar-color: #cbd5e1 #f8fafc;"
       @click.away="if(window.innerWidth < 1024) sidebarOpen = false">
    
    <nav class="px-4 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                <i class="fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
            </div>
            <span class="text-sm font-semibold">{{ __('Dashboard') }}</span>
        </a>
        
        <!-- Jornadas -->
        <a href="{{ route('time-entries.index') }}" 
           class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('time-entries.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('time-entries.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                <i class="fas fa-clock {{ request()->routeIs('time-entries.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
            </div>
            <span class="text-sm font-semibold">{{ __('Jornadas') }}</span>
        </a>

        <!-- Vacaciones -->
        <a href="{{ route('vacation-requests.index') }}" 
           class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('vacation-requests.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('vacation-requests.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                <i class="fas fa-umbrella-beach {{ request()->routeIs('vacation-requests.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
            </div>
            <span class="text-sm font-semibold">{{ __('Vacaciones') }}</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <div class="px-4 flex items-center space-x-2">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Administración') }}</p>
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            <!-- Empresas -->
            <a href="{{ route('companies.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('companies.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('companies.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-building {{ request()->routeIs('companies.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Empresas') }}</span>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('users.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('users.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-users {{ request()->routeIs('users.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Usuarios') }}</span>
            </a>

            <!-- Reportes -->
            <a href="{{ route('reports.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('reports.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-chart-bar {{ request()->routeIs('reports.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Reportes') }}</span>
            </a>

            <!-- Estadísticas -->
            <a href="{{ route('statistics.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistics.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('statistics.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-chart-line {{ request()->routeIs('statistics.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Estadísticas') }}</span>
            </a>

            <!-- Solicitudes -->
            <a href="{{ route('company-requests.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('company-requests.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('company-requests.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-inbox {{ request()->routeIs('company-requests.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Solicitudes') }}</span>
            </a>

        @elseif(Auth::user()->role === 'manager')
            <div class="pt-4 pb-2">
                <div class="px-4 flex items-center space-x-2">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Gestión') }}</p>
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            <!-- Mi Empresa -->
            <a href="{{ route('companies.show', Auth::user()->company_id) }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('companies.show') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('companies.show') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-building {{ request()->routeIs('companies.show') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Mi Empresa') }}</span>
            </a>

            <!-- Empleados -->
            <a href="{{ route('users.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('users.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-users {{ request()->routeIs('users.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Empleados') }}</span>
            </a>

            <!-- Reportes -->
            <a href="{{ route('reports.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('reports.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-chart-bar {{ request()->routeIs('reports.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Reportes') }}</span>
            </a>

            <!-- Estadísticas -->
            <a href="{{ route('statistics.index') }}" 
               class="group flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('statistics.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('statistics.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-50' }} transition-colors">
                    <i class="fas fa-chart-line {{ request()->routeIs('statistics.*') ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }}" aria-hidden="true"></i>
                </div>
                <span class="text-sm font-semibold">{{ __('Estadísticas') }}</span>
            </a>
        @endif
    </nav>
</aside>

<!-- Overlay para cerrar sidebar en mobile -->
<div x-show="sidebarOpen && window.innerWidth < 1024" 
     @click="sidebarOpen = false"
     x-transition:enter="transition-opacity ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-10 lg:hidden"></div>
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
