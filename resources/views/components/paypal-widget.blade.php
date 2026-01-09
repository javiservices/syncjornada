<!-- PayPal Donation Widget -->
<div id="donation-widget" class="fixed bottom-6 right-6 z-50">
    <!-- Botón flotante -->
    <button 
        id="donation-btn"
        onclick="toggleDonation()"
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110"
        title="Apoya el proyecto"
    >
        <i class="fab fa-paypal text-2xl"></i>
    </button>
    
    <!-- Panel desplegable -->
    <div 
        id="donation-panel"
        class="hidden absolute bottom-16 right-0 bg-white rounded-lg shadow-2xl p-4 w-72 border border-gray-200"
    >
        <div class="text-center">
            <div class="mb-3">
                <i class="fas fa-coffee text-blue-600 text-3xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 mb-2">☕ Apoya SyncJornada</h3>
            <p class="text-sm text-gray-600 mb-4">
                Esta aplicación es 100% gratuita. Si te resulta útil, puedes invitarme a un café para ayudar a mantener los servidores activos.
            </p>
            <a 
                href="https://paypal.me/javilabarumdj" 
                target="_blank"
                class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition mb-2"
            >
                <i class="fab fa-paypal mr-2"></i>Donar con PayPal
            </a>
            <button 
                onclick="toggleDonation()"
                class="text-sm text-gray-500 hover:text-gray-700"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
function toggleDonation() {
    const panel = document.getElementById('donation-panel');
    const btn = document.getElementById('donation-btn');
    
    if (panel.classList.contains('hidden')) {
        panel.classList.remove('hidden');
        panel.classList.add('animate-fadeIn');
        btn.classList.add('ring-4', 'ring-blue-300');
    } else {
        panel.classList.add('hidden');
        panel.classList.remove('animate-fadeIn');
        btn.classList.remove('ring-4', 'ring-blue-300');
    }
}

// Cerrar al hacer clic fuera
document.addEventListener('click', function(event) {
    const widget = document.getElementById('donation-widget');
    const panel = document.getElementById('donation-panel');
    
    if (widget && !widget.contains(event.target) && !panel.classList.contains('hidden')) {
        toggleDonation();
    }
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
