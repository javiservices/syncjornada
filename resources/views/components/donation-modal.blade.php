@if(auth()->user()->role === 'manager')
<!-- Modal de Donación para Managers -->
<div 
    x-data="{ 
        showDonationModal: (() => {
            const lastShown = localStorage.getItem('donation_modal_last_shown_{{ auth()->id() }}');
            if (!lastShown) return true;
            const lastDate = new Date(lastShown);
            const today = new Date();
            const diffTime = Math.abs(today - lastDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays >= 3;
        })(),
        closeDonationModal() {
            this.showDonationModal = false;
            localStorage.setItem('donation_modal_last_shown_{{ auth()->id() }}', new Date().toISOString());
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
                        <svg class="w-11 h-11" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.067 8.478c.492.88.556 2.014.3 3.327-.74 3.806-3.276 5.12-6.514 5.12h-.5a.805.805 0 00-.794.68l-.04.22-.63 3.993-.028.15a.805.805 0 01-.793.68H8.334a.544.544 0 01-.536-.633l1.583-10.03a.958.958 0 01.946-.806h1.96c2.577 0 4.564-.66 5.884-2.05.49-.518.85-1.094 1.097-1.728a6.87 6.87 0 01.26-.921 3.893 3.893 0 01.54.998z" fill="#179BD7"/>
                            <path d="M9.857 6.957c.074-.466.43-.822.894-.87l.144-.01h4.737c.56 0 1.083.047 1.567.147.444.092.848.221 1.206.389.087.04.17.083.251.126a3.89 3.89 0 01.54.998c.492.88.556 2.014.3 3.327-.74 3.806-3.276 5.12-6.514 5.12h-.5a.805.805 0 00-.794.68l-.04.22-.63 3.993-.028.15a.805.805 0 01-.793.68H8.334a.544.544 0 01-.536-.633l1.583-10.03c.073-.466.43-.822.894-.87z" fill="#222D65"/>
                            <path d="M11.296 6.87a.96.96 0 01.946-.806h4.737c.56 0 1.083.047 1.567.147.444.092.848.221 1.206.389.359.167.674.374.944.62-.207 1.316-.938 2.742-2.28 3.903-1.32 1.14-3.166 1.757-5.33 1.757h-1.96a.96.96 0 00-.946.806l-1.583 10.03a.544.544 0 00.536.633h2.733a.805.805 0 00.793-.68l.028-.15.63-3.993.04-.22a.805.805 0 01.794-.68h.5c3.238 0 5.774-1.314 6.514-5.12.256-1.313.192-2.447-.3-3.327a3.893 3.893 0 00-.54-.998z" fill="#253B80"/>
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
                        <svg class="w-11 h-11 text-gray-900" viewBox="0 0 512 512" fill="currentColor">
                            <path d="M88 0C74.7 0 64 10.7 64 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C120.5 112.3 128 119.9 128 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C119.5 47.7 112 40.1 112 24c0-13.3-10.7-24-24-24zM32 192c-17.7 0-32 14.3-32 32V416c0 53 43 96 96 96H288c53 0 96-43 96-96h16c61.9 0 112-50.1 112-112s-50.1-112-112-112H352 32zm352 64h16c26.5 0 48 21.5 48 48s-21.5 48-48 48H384V256zM224 24c0-13.3-10.7-24-24-24s-24 10.7-24 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C232.5 112.3 240 119.9 240 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C231.5 47.7 224 40.1 224 24zM288 0c-13.3 0-24 10.7-24 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C320.5 112.3 328 119.9 328 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C319.5 47.7 312 40.1 312 24c0-13.3-10.7-24-24-24z"/>
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
