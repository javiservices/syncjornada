<!-- PWA Install Banner -->
<div 
    x-data="{
        showInstallBanner: false,
        deferredPrompt: null,
        init() {
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                this.deferredPrompt = e;
                this.showInstallBanner = true;
            });
            
            window.addEventListener('appinstalled', () => {
                console.log('✅ PWA instalada exitosamente');
                this.showInstallBanner = false;
                this.deferredPrompt = null;
            });
        },
        async installPWA() {
            if (!this.deferredPrompt) return;
            
            this.deferredPrompt.prompt();
            const { outcome } = await this.deferredPrompt.userChoice;
            
            if (outcome === 'accepted') {
                console.log('✅ Usuario aceptó instalar la PWA');
            } else {
                console.log('❌ Usuario rechazó instalar la PWA');
            }
            
            this.deferredPrompt = null;
            this.showInstallBanner = false;
        },
        dismissBanner() {
            this.showInstallBanner = false;
            localStorage.setItem('pwa-banner-dismissed', 'true');
        }
    }"
    x-show="showInstallBanner"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4"
    style="display: none;"
    class="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 z-50"
>
    <div class="bg-white rounded-xl shadow-2xl border-2 border-blue-100 overflow-hidden">
        <!-- Header con gradiente -->
        <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        
        <!-- Contenido -->
        <div class="p-4">
            <div class="flex items-start gap-4">
                <!-- Icono -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Texto -->
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900 text-base mb-1">
                        Instalar SyncJornada
                    </h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Instala la app en tu dispositivo para un acceso rápido y fichaje con un solo tap.
                    </p>
                </div>
                
                <!-- Botón cerrar -->
                <button 
                    @click="dismissBanner()"
                    class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors"
                    title="Cerrar"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Botones de acción -->
            <div class="flex gap-3 mt-4">
                <button 
                    @click="installPWA()"
                    class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all shadow-md hover:shadow-lg transform hover:scale-[1.02]"
                >
                    Instalar
                </button>
                <button 
                    @click="dismissBanner()"
                    class="px-4 text-gray-600 hover:text-gray-900 font-medium transition-colors"
                >
                    Más tarde
                </button>
            </div>
        </div>
    </div>
</div>

<!-- iOS Safari Install Instructions -->
<div 
    x-data="{
        showIOSInstructions: false,
        init() {
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            const isInStandaloneMode = ('standalone' in window.navigator) && (window.navigator.standalone);
            
            if (isIOS && !isInStandaloneMode && !localStorage.getItem('ios-install-dismissed')) {
                setTimeout(() => {
                    this.showIOSInstructions = true;
                }, 2000);
            }
        },
        dismissIOSInstructions() {
            this.showIOSInstructions = false;
            localStorage.setItem('ios-install-dismissed', 'true');
        }
    }"
    x-show="showIOSInstructions"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4"
    style="display: none;"
    class="fixed bottom-4 left-4 right-4 z-50"
>
    <div class="bg-white rounded-xl shadow-2xl border-2 border-blue-100 p-4">
        <div class="flex justify-between items-start mb-3">
            <h3 class="font-bold text-gray-900">📱 Instalar en iOS</h3>
            <button 
                @click="dismissIOSInstructions()"
                class="text-gray-400 hover:text-gray-600"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <ol class="text-sm text-gray-600 space-y-2">
            <li>1. Toca el icono <strong>Compartir</strong> <svg class="inline w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg></li>
            <li>2. Selecciona <strong>"Añadir a pantalla de inicio"</strong></li>
            <li>3. Toca <strong>"Añadir"</strong></li>
        </ol>
    </div>
</div>
