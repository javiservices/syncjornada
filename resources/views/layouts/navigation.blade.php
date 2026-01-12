<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm" role="navigation" aria-label="Navegación principal">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition" aria-label="Ir al Dashboard">
                        <i class="fas fa-clock text-blue-600 text-2xl" aria-hidden="true"></i>
                        <span class="text-xl font-bold text-gray-900 hidden sm:block">SyncJornada</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 md:space-x-3 lg:space-x-4 sm:-my-px sm:ms-4 lg:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-1 text-xs lg:text-sm">
                        <i class="fas fa-home text-xs lg:text-sm" aria-hidden="true"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    
                    <x-nav-link :href="route('time-entries.index')" :active="request()->routeIs('time-entries.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                        <i class="fas fa-clock text-xs lg:text-sm" aria-hidden="true"></i>
                        <span>{{ __('Jornadas') }}</span>
                    </x-nav-link>

                    <x-nav-link :href="route('vacation-requests.index')" :active="request()->routeIs('vacation-requests.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                        <i class="fas fa-umbrella-beach text-xs lg:text-sm" aria-hidden="true"></i>
                        <span>{{ __('Vacaciones') }}</span>
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-building text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Empresas') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-users text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Usuarios') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-chart-bar text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Reportes') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('statistics.index')" :active="request()->routeIs('statistics.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-chart-line text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Estadísticas') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('company-requests.index')" :active="request()->routeIs('company-requests.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-inbox text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Solicitudes') }}</span>
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'manager')
                        <x-nav-link :href="route('companies.show', Auth::user()->company_id)" :active="request()->routeIs('companies.show')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-building text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Mi Empresa') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-users text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Empleados') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-chart-bar text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Reportes') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('statistics.index')" :active="request()->routeIs('statistics.*')" class="flex items-center space-x-1 text-xs lg:text-sm">
                            <i class="fas fa-chart-line text-xs lg:text-sm" aria-hidden="true"></i>
                            <span>{{ __('Estadísticas') }}</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-4 lg:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 lg:px-3 py-2 border border-gray-300 text-xs lg:text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" aria-label="Menú de usuario" aria-haspopup="true">
                            <div class="flex items-center space-x-1 lg:space-x-2">
                                <div class="w-7 h-7 lg:w-8 lg:h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-xs lg:text-sm" aria-hidden="true"></i>
                                </div>
                                <div class="hidden xl:block">{{ Auth::user()->name }}</div>
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-700 transition duration-150 ease-in-out" aria-label="Abrir menú de navegación" aria-expanded="false" :aria-expanded="open.toString()">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 bg-gray-50">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2">
                <i class="fas fa-home text-sm" aria-hidden="true"></i>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('time-entries.index')" :active="request()->routeIs('time-entries.*')" class="flex items-center space-x-2">
                <i class="fas fa-clock text-sm" aria-hidden="true"></i>
                <span>{{ __('Jornadas') }}</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('vacation-requests.index')" :active="request()->routeIs('vacation-requests.*')" class="flex items-center space-x-2">
                <i class="fas fa-umbrella-beach text-sm" aria-hidden="true"></i>
                <span>{{ __('Vacaciones') }}</span>
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')" class="flex items-center space-x-2">
                    <i class="fas fa-building text-sm" aria-hidden="true"></i>
                    <span>{{ __('Empresas') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="flex items-center space-x-2">
                    <i class="fas fa-users text-sm" aria-hidden="true"></i>
                    <span>{{ __('Usuarios') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="flex items-center space-x-2">
                    <i class="fas fa-chart-bar text-sm" aria-hidden="true"></i>
                    <span>{{ __('Reportes') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('company-requests.index')" :active="request()->routeIs('company-requests.*')" class="flex items-center space-x-2">
                    <i class="fas fa-inbox text-sm" aria-hidden="true"></i>
                    <span>{{ __('Solicitudes') }}</span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->role === 'manager')
                <x-responsive-nav-link :href="route('companies.show', Auth::user()->company_id)" :active="request()->routeIs('companies.show')" class="flex items-center space-x-2">
                    <i class="fas fa-building text-sm" aria-hidden="true"></i>
                    <span>{{ __('Mi Empresa') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="flex items-center space-x-2">
                    <i class="fas fa-users text-sm" aria-hidden="true"></i>
                    <span>{{ __('Empleados') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="flex items-center space-x-2">
                    <i class="fas fa-chart-bar text-sm" aria-hidden="true"></i>
                    <span>{{ __('Reportes') }}</span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="px-4 flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-blue-600" aria-hidden="true"></i>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-sm" aria-hidden="true"></i>
                    <span>{{ __('Perfil') }}</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center space-x-2 text-red-600">
                        <i class="fas fa-sign-out-alt text-sm" aria-hidden="true"></i>
                        <span>{{ __('Cerrar Sesión') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
