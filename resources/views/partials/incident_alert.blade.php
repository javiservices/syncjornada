@if($incidentAlert && auth()->check() && in_array(auth()->user()->role, ['admin', 'manager']) && !auth()->user()->incident_alert_shown)
<div class="alert alert-{{ $incidentAlert->type }} alert-dismissible fade show" role="alert">
    <strong>¡Aviso Importante!</strong> {{ $incidentAlert->message }}
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