@if(auth()->check() && in_array(auth()->user()->role, ['admin', 'manager']) && !auth()->user()->incident_alert_shown)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>¡Aviso Importante!</strong> El servidor sufrió un incidente de seguridad el 19 de enero, resultando en la pérdida de registros de ese día. No se trata de ransomware ni se requiere pago alguno. Para más información o asistencia, contacta al administrador.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="markAlertAsShown()"></button>
</div>
<script>
function markAlertAsShown() {
    fetch('/mark-alert-shown', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
</script>
@endif