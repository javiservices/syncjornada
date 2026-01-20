@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Alerta de Incidente</h1>
    <form action="{{ route('admin.incident-alert.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="4" required>{{ old('message', $alert->message) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select class="form-select" id="type" name="type" required>
                <option value="info" {{ old('type', $alert->type) == 'info' ? 'selected' : '' }}>Información</option>
                <option value="warning" {{ old('type', $alert->type) == 'warning' ? 'selected' : '' }}>Advertencia</option>
                <option value="danger" {{ old('type', $alert->type) == 'danger' ? 'selected' : '' }}>Peligro</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active', $alert->active) ? 'checked' : '' }}>
            <label class="form-check-label" for="active">Activa</label>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection