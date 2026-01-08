{{-- Cookie Banner --}}
<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-gray-900 text-white shadow-2xl transition-transform duration-300" style="display: none; z-index: 9999; transform: translateY(100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-start gap-3 flex-1">
                <i class="fas fa-cookie-bite text-yellow-400 text-2xl mt-1 flex-shrink-0"></i>
                <div class="text-sm">
                    <p class="font-semibold mb-1">Utilizamos cookies</p>
                    <p class="text-gray-300">
                        Usamos cookies técnicas necesarias para el funcionamiento de la plataforma. 
                        Al continuar navegando, aceptas su uso. 
                        <a href="{{ route('cookies') }}" class="text-blue-400 hover:text-blue-300 underline">Más información</a>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <button onclick="acceptCookies()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2.5 rounded-lg font-medium transition shadow-lg text-sm sm:text-base whitespace-nowrap">
                    <i class="fas fa-check mr-1 sm:mr-2"></i>Aceptar
                </button>
                <button onclick="rejectCookies()" class="bg-gray-700 hover:bg-gray-600 text-white px-4 sm:px-6 py-2.5 rounded-lg font-medium transition text-sm sm:text-base whitespace-nowrap">
                    Rechazar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para obtener una cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // Función para establecer una cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }

    // Función para aceptar cookies
    function acceptCookies() {
        setCookie('cookies_accepted', 'true', 365);
        hideCookieBanner();
    }

    // Función para rechazar cookies (solo acepta las técnicas necesarias)
    function rejectCookies() {
        setCookie('cookies_accepted', 'false', 365);
        hideCookieBanner();
        
        // Mostrar mensaje informativo
        alert('Has rechazado las cookies opcionales. Las cookies técnicas necesarias seguirán activas para el funcionamiento básico de la plataforma.');
    }

    // Función para ocultar el banner
    function hideCookieBanner() {
        const banner = document.getElementById('cookie-banner');
        banner.style.transform = 'translateY(100%)';
        setTimeout(() => {
            banner.style.display = 'none';
        }, 300);
    }

    // Mostrar banner si no se ha aceptado/rechazado
    function checkCookieConsent() {
        const consent = getCookie('cookies_accepted');
        if (consent === null) {
            // No ha respondido al banner, mostrarlo
            setTimeout(() => {
                const banner = document.getElementById('cookie-banner');
                banner.style.display = 'block';
                setTimeout(() => {
                    banner.style.transform = 'translateY(0)';
                }, 100);
            }, 1000); // Esperar 1 segundo después de cargar la página
        }
    }

    // Ejecutar al cargar la página
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkCookieConsent);
    } else {
        checkCookieConsent();
    }
</script>
