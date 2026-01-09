<!-- PayPal Donation Widget -->
<div id="donation-widget" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 9999 !important; pointer-events: auto !important;">
    <!-- Botón flotante -->
    <button 
        id="donation-btn"
        onclick="toggleDonation()"
        style="background-color: #2563eb; color: white; border-radius: 50%; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); transition: all 0.3s; border: none; cursor: pointer;"
        onmouseover="this.style.backgroundColor='#1d4ed8'; this.style.transform='scale(1.1)'"
        onmouseout="this.style.backgroundColor='#2563eb'; this.style.transform='scale(1)'"
        title="Apoya el proyecto"
    >
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.76-4.852a.932.932 0 0 1 .924-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.858-4.46z"/>
        </svg>
    </button>
    
    <!-- Panel desplegable -->
    <div 
        id="donation-panel"
        style="display: none; position: absolute; bottom: 80px; right: 0; background: white; border-radius: 8px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 24px; width: 320px; border: 2px solid #bfdbfe; z-index: 10000;"
    >
        <div style="text-align: center;">
            <div style="margin-bottom: 16px;">
                <svg style="width: 48px; height: 48px; margin: 0 auto; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 style="font-weight: bold; font-size: 20px; color: #111827; margin-bottom: 12px;">☕ Apoya SyncJornada</h3>
            <p style="font-size: 14px; color: #4b5563; margin-bottom: 20px; line-height: 1.6;">
                Esta aplicación es <strong>100% gratuita</strong>. Si te resulta útil, puedes invitarme a un café para ayudar a mantener los servidores activos. ¡Cada aporte cuenta! 🙏
            </p>
            <a 
                href="https://paypal.me/javilabarumdj" 
                target="_blank"
                style="display: block; width: 100%; background-color: #2563eb; color: white; font-weight: bold; padding: 12px 24px; border-radius: 8px; text-decoration: none; margin-bottom: 12px; font-size: 18px; transition: background-color 0.3s;"
                onmouseover="this.style.backgroundColor='#1d4ed8'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'"
                onmouseout="this.style.backgroundColor='#2563eb'; this.style.boxShadow='none'"
            >
                <svg style="display: inline-block; width: 24px; height: 24px; margin-right: 8px; vertical-align: middle;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.76-4.852a.932.932 0 0 1 .924-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.858-4.46z"/>
                </svg>
                Donar con PayPal
            </a>
            <button 
                onclick="toggleDonation()"
                style="font-size: 14px; color: #6b7280; background: none; border: none; cursor: pointer; font-weight: 500;"
                onmouseover="this.style.color='#374151'"
                onmouseout="this.style.color='#6b7280'"
            >
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    // Prevenir múltiples ejecuciones
    if (window.donationWidgetLoaded) return;
    window.donationWidgetLoaded = true;

    window.toggleDonation = function() {
        const panel = document.getElementById('donation-panel');
        const btn = document.getElementById('donation-btn');
        
        if (!panel || !btn) return;
        
        if (panel.style.display === 'none' || panel.style.display === '') {
            panel.style.display = 'block';
            panel.style.animation = 'fadeIn 0.3s ease-out';
            btn.style.boxShadow = '0 0 0 4px rgba(37, 99, 235, 0.3), 0 10px 25px rgba(0, 0, 0, 0.3)';
        } else {
            panel.style.display = 'none';
            btn.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.3)';
        }
    };

    // Cerrar al hacer clic fuera
    document.addEventListener('click', function(event) {
        const widget = document.getElementById('donation-widget');
        const panel = document.getElementById('donation-panel');
        
        if (!widget || !panel) return;
        
        if (!widget.contains(event.target) && panel.style.display === 'block') {
            window.toggleDonation();
        }
    });
})();
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
