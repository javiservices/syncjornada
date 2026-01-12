@if(auth()->user()->role === 'manager')
<!-- Modal de Donación para Managers -->
<div 
    x-data="{ 
        showDonationModal: !localStorage.getItem('donation_modal_shown_{{ auth()->id() }}'),
        closeDonationModal() {
            this.showDonationModal = false;
            localStorage.setItem('donation_modal_shown_{{ auth()->id() }}', 'true');
        }
    }"
    x-show="showDonationModal"
    x-cloak
    class="fixed inset-0 z-[99999] flex items-center justify-center px-4 py-6 sm:px-6"
    style="display: none;"
>
    <!-- Overlay -->
    <div 
        x-show="showDonationModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm"
        @click="closeDonationModal()"
    ></div>

    <!-- Modal -->
    <div 
        x-show="showDonationModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden"
        @click.stop
    >
        <!-- Decorative header gradient -->
        <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        
        <!-- Close button -->
        <button 
            @click="closeDonationModal()"
            class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-100"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Content -->
        <div class="px-6 py-8 sm:px-8 sm:py-10">
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-4">
                ¡Gracias por usar SyncJornada!
            </h3>

            <!-- Message -->
            <div class="text-gray-600 space-y-3 mb-8 text-center text-sm">
                <p class="leading-relaxed">
                    Esta aplicación es <span class="font-semibold text-gray-900">100% gratuita</span> y de código abierto, desarrollada con pasión para ayudar a empresas como la tuya a gestionar el tiempo laboral de forma eficiente.
                </p>
                <p class="leading-relaxed">
                    Sin embargo, mantener los servidores activos y seguir mejorando la aplicación tiene un coste. <span class="font-semibold text-gray-900">Una pequeña donación</span> nos ayudaría enormemente a continuar con el desarrollo y mantener el servicio funcionando.
                </p>
            </div>

            <!-- Donation buttons as circles -->
            <div class="flex justify-center items-center gap-6 mb-8">
                <!-- PayPal -->
                <a 
                    href="https://paypal.me/javilabarumdj" 
                    target="_blank"
                    class="group flex flex-col items-center"
                    title="Donar con PayPal"
                >
                    <div class="w-20 h-20 bg-[#0070ba] hover:bg-[#005ea6] rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all hover:scale-110 transform">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.32 21.97a.546.546 0 0 1-.26-.32c-.03-.15-.01-.3.05-.44l2.12-7.7H7.3c-.14 0-.27-.04-.38-.12a.723.723 0 0 1-.25-.31c-.06-.13-.08-.28-.05-.42.03-.14.1-.27.21-.36.1-.1.24-.15.38-.15h3.66L12.26 7.4H9.33c-.14 0-.27-.04-.38-.12a.723.723 0 0 1-.25-.31c-.06-.13-.08-.28-.05-.42.03-.14.1-.27.21-.36.1-.1.24-.15.38-.15h3.66l1.21-4.39c.03-.15.12-.28.24-.37a.64.64 0 0 1 .43-.11c.15.02.28.09.38.2.1.1.15.24.14.38l-1.14 4.29h3.49l1.21-4.39c.03-.15.12-.28.24-.37a.64.64 0 0 1 .43-.11c.15.02.28.09.38.2.1.1.15.24.14.38l-1.14 4.29h2.91c.14 0 .27.04.38.12.11.08.19.19.25.31.06.13.08.28.05.42-.03.14-.1.27-.21.36-.1.1-.24.15-.38.15h-3.22l-1.39 4.75h2.93c.14 0 .27.04.38.12.11.08.19.19.25.31.06.13.08.28.05.42-.03.14-.1.27-.21.36-.1.1-.24.15-.38.15h-3.33l-1.2 4.37c-.03.15-.12.28-.24.37a.64.64 0 0 1-.43.11.553.553 0 0 1-.38-.2.533.533 0 0 1-.14-.38l1.14-4.27h-3.49l-1.2 4.37c-.03.15-.12.28-.24.37a.64.64 0 0 1-.43.11z"/>
                        </svg>
                    </div>
                    <span class="mt-2 text-xs font-medium text-gray-600 group-hover:text-gray-900">PayPal</span>
                </a>

                <!-- Buy Me a Coffee -->
                <a 
                    href="https://www.buymeacoffee.com/syncjornadl" 
                    target="_blank"
                    class="group flex flex-col items-center"
                    title="Invítame un Café"
                >
                    <div class="w-20 h-20 bg-[#FFDD00] hover:bg-[#FFED4E] rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all hover:scale-110 transform">
                        <svg class="w-10 h-10 text-gray-900" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.216 7.042a5.775 5.775 0 0 0-.898-1.287 5.65 5.65 0 0 0-1.286-.898l.002-.003A5.693 5.693 0 0 0 15.87 4h-7.74a5.693 5.693 0 0 0-2.164.854l.002.003a5.65 5.65 0 0 0-1.286.898 5.775 5.775 0 0 0-.898 1.287A5.693 5.693 0 0 0 3 9.206V18c0 1.657 1.343 3 3 3h12c1.657 0 3-1.343 3-3V9.206a5.693 5.693 0 0 0-.784-2.164zM8.13 6h7.74c.684 0 1.341.17 1.929.486A5.035 5.035 0 0 0 16.42 8H7.58a5.035 5.035 0 0 0-1.379-1.514A3.693 3.693 0 0 1 8.13 6zM19 18c0 .551-.449 1-1 1H6c-.551 0-1-.449-1-1V9.206c0-.684.17-1.341.486-1.929.134.048.276.076.423.076h12.182c.147 0 .289-.028.423-.076.316.588.486 1.245.486 1.929V18z"/>
                        </svg>
                    </div>
                    <span class="mt-2 text-xs font-medium text-gray-600 group-hover:text-gray-900">Buy Me a Coffee</span>
                </a>
            </div>

            <!-- Footer note -->
            <div class="pt-4 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center leading-relaxed">
                    No es obligatorio, pero cualquier contribución es muy apreciada.<br>
                    <button 
                        @click="closeDonationModal()" 
                        class="text-blue-600 hover:text-blue-700 font-medium underline mt-1 inline-block"
                    >
                        Continuar sin donar
                    </button>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endif
