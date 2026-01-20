@if($incidentAlert && auth()->check() && in_array(auth()->user()->role, ['admin', 'manager']) && !auth()->user()->incident_alert_shown)
<div class="bg-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-50 border border-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-200 rounded-lg p-4 mb-4 flex items-start justify-between">
    <div class="flex items-start">
        <i class="fas fa-exclamation-triangle text-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-500 text-lg mr-3 mt-1"></i>
        <div>
            <h3 class="text-sm font-medium text-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-800">{{ $incidentAlert->title }}</h3>
            <p class="text-sm text-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-700 mt-1">{!! $incidentAlert->message !!}</p>
        </div>
    </div>
    <button type="button" class="text-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-500 hover:text-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-600 ml-4" onclick="markAlertAsShown()">
        <i class="fas fa-times"></i>
    </button>
</div>
<script>
function markAlertAsShown() {
    fetch('/mark-alert-shown', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(() => {
        document.querySelector('.bg-{{ $incidentAlert->type === 'warning' ? 'yellow' : ($incidentAlert->type === 'danger' ? 'red' : 'blue') }}-50').style.display = 'none';
    });
}
</script>
@endif