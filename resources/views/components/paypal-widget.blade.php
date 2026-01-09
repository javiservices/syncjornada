<!-- PayPal Donation Widget -->
<div id="donation-widget" class="fixed bottom-6 right-6" style="z-index: 9999;">
    <!-- Botón flotante -->
    <button 
        id="donation-btn"
        onclick="toggleDonation()"
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-2xl transition-all duration-300 hover:scale-110"
        style="box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);"
        title="Apoya el proyecto"
    >
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.76-4.852a.932.932 0 0 1 .924-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.858-4.46z"/>
        </svg>
    </button>
    
    <!-- Panel desplegable -->
    <div 
        id="donation-panel"
        class="hidden absolute bottom-20 right-0 bg-white rounded-lg shadow-2xl p-6 w-80 border-2 border-blue-200"
        style="z-index: 10000;"
    >
        <div class="text-center">
            <div class="mb-4">
                <svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="font-bold text-xl text-gray-900 mb-3">☕ Apoya SyncJornada</h3>
            <p class="text-sm text-gray-600 mb-5 leading-relaxed">
                Esta aplicación es <strong>100% gratuita</strong>. Si te resulta útil, puedes invitarme a un café para ayudar a mantener los servidores activos. ¡Cada aporte cuenta! 🙏
            </p>
            <a 
                href="https://paypal.me/javilabarumdj" 
                target="_blank"
                class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all hover:shadow-lg mb-3 text-lg"
            >
                <svg class="inline-block w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.76-4.852a.932.932 0 0 1 .924-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.858-4.46z"/>
                </svg>
                Donar con PayPal
            </a>
            <button 
                onclick="toggleDonation()"
                class="text-sm text-gray-500 hover:text-gray-700 font-medium"
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
