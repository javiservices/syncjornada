<nav class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-sm z-30 h-16" role="navigation" aria-label="Barra superior">
    <div class="h-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-full">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition" aria-label="Alternar menú lateral">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition" aria-label="Ir al dashboard">
                    <i class="fas fa-clock text-blue-600 text-2xl" aria-hidden="true"></i>
                    <span class="text-xl font-bold text-gray-900">SyncJornada</span>
                </a>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center space-x-3 px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition" aria-label="Menú de usuario">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm" aria-hidden="true"></i>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
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
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            <span>{{ __('Cerrar Sesión') }}</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

<aside x-show="sidebarOpen"
       x-transition:enter="transform transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200 shadow-lg z-20 overflow-y-auto"
       @click.away="if (window.innerWidth < 1024) sidebarOpen = false">
    <nav class="p-4 space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-home w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a href="{{ route('time-entries.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('time-entries.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-clock w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">Jornadas</span>
        </a>
        <a href="{{ route('vacation-requests.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('vacation-requests.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-umbrella-beach w-5" aria-hidden="true"></i>
            <span class="text-sm font-medium">Vacaciones</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <div class="px-3 text-xs font-semibold text-gray-500 uppercase">Administración</div>
            </div>
            <a href="{{ route('companies.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-building w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Empresas</span>
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-users w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Usuarios</span>
            </a>
            <a href="{{ route('reports.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-bar w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Reportes</span>
            </a>
            <a href="{{ route('statistics.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-line w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Estadísticas</span>
            </a>
            <a href="{{ route('company-requests.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('company-requests.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-inbox w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Solicitudes</span>
            </a>
        @elseif(Auth::user()->role === 'manager')
            <div class="pt-4 pb-2">
                <div class="px-3 text-xs font-semibold text-gray-500 uppercase">Gestión</div>
            </div>
            <a href="{{ route('companies.show', Auth::user()->company_id) }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.show') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-building w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Mi Empresa</span>
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-users w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Empleados</span>
            </a>
            <a href="{{ route('reports.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-bar w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Reportes</span>
            </a>
            <a href="{{ route('statistics.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-line w-5" aria-hidden="true"></i>
                <span class="text-sm font-medium">Estadísticas</span>
            </a>
        @endif
    </nav>
</aside>

<div x-show="sidebarOpen && window.innerWidth < 1024"
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-gray-900/50 z-10 lg:hidden"></div><nav x-data="{ sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false' }" 
    x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
     class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-sm z-30 h-16">
    
    <div class="h-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-full">
            <!-- Left: Toggle + Logo -->
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-900">SyncJornada</span>
                </a>
            </div>

            <!-- Right: User Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center space-x-3 px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-gray-500"></i>
                        <span>Perfil</span>
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Cerrar Sesión</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<aside x-show="sidebarOpen" 
       x-transition:enter="transform transition ease-out duration-200"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200 shadow-lg z-20 overflow-y-auto"
       @click.away="if (window.innerWidth < 1024) sidebarOpen = false">
    
    <nav class="p-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-home w-5"></i>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        
        <!-- Jornadas -->
        <a href="{{ route('time-entries.index') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('time-entries.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-clock w-5"></i>
            <span class="text-sm font-medium">Jornadas</span>
        </a>

        <!-- Vacaciones -->
        <a href="{{ route('vacation-requests.index') }}" 
           class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('vacation-requests.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <i class="fas fa-umbrella-beach w-5"></i>
            <span class="text-sm font-medium">Vacaciones</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <!-- Divider -->
            <div class="pt-4 pb-2">
                <div class="px-3 text-xs font-semibold text-gray-500 uppercase">Administración</div>
            </div>

            <a href="{{ route('companies.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-building w-5"></i>
                <span class="text-sm font-medium">Empresas</span>
            </a>

            <a href="{{ route('users.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-users w-5"></i>
                <span class="text-sm font-medium">Usuarios</span>
            </a>

            <a href="{{ route('reports.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="text-sm font-medium">Reportes</span>
            </a>

            <a href="{{ route('statistics.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-line w-5"></i>
                <span class="text-sm font-medium">Estadísticas</span>
            </a>

            <a href="{{ route('company-requests.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('company-requests.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-inbox w-5"></i>
                <span class="text-sm font-medium">Solicitudes</span>
            </a>

        @elseif(Auth::user()->role === 'manager')
            <!-- Divider -->
            <div class="pt-4 pb-2">
                <div class="px-3 text-xs font-semibold text-gray-500 uppercase">Gestión</div>
            </div>

            <a href="{{ route('companies.show', Auth::user()->company_id) }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('companies.show') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-building w-5"></i>
                <span class="text-sm font-medium">Mi Empresa</span>
            </a>

            <a href="{{ route('users.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-users w-5"></i>
                <span class="text-sm font-medium">Empleados</span>
            </a>

            <a href="{{ route('reports.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="text-sm font-medium">Reportes</span>
            </a>

            <a href="{{ route('statistics.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('statistics.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-line w-5"></i>
                <span class="text-sm font-medium">Estadísticas</span>
            </a>
        @endif
    </nav>
</aside>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen && window.innerWidth < 1024" 
     x-transition:enter="transition-opacity ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-gray-900/50 z-10 lg:hidden"></div>
