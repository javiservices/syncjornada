<x-app-layout>

{{-- CABECERA --}}
<div class="page-hd">
    <div>
        <h1 class="page-title"><i class="fas fa-triangle-exclamation mr-2 text-amber-500"></i>Alerta de incidente</h1>
        <p class="page-sub">Configura el mensaje de alerta visible para todos los usuarios</p>
    </div>
</div>

{{-- FORMULARIO --}}
<div class="card max-w-3xl">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-amber-50 text-amber-600"><i class="fas fa-bell"></i></span>
            <span class="card-title">Configuración de la alerta</span>
        </div>
        @if($alert->active)
            <span class="badge badge-green"><i class="fas fa-circle mr-1 text-[8px]"></i>Activa</span>
        @else
            <span class="badge badge-gray"><i class="fas fa-circle mr-1 text-[8px]"></i>Inactiva</span>
        @endif
    </div>
    <div class="card-body">
        <form action="{{ route('admin.incident-alert.update') }}" method="POST" class="space-y-5">
            @csrf

            <div class="field">
                <label for="title" class="field-label">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $alert->title) }}" class="input" required placeholder="Título de la alerta">
                @error('title')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="message" class="field-label">Mensaje</label>
                <textarea name="message" id="message" rows="5" class="input resize-y" required placeholder="Escribe el mensaje de la alerta...">{!! old('message', $alert->message) !!}</textarea>
                @error('message')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="type" class="field-label">Tipo de alerta</label>
                <select name="type" id="type" class="select" required>
                    <option value="info" {{ old('type', $alert->type) == 'info' ? 'selected' : '' }}>ℹ️ Información</option>
                    <option value="warning" {{ old('type', $alert->type) == 'warning' ? 'selected' : '' }}>⚠️ Advertencia</option>
                    <option value="danger" {{ old('type', $alert->type) == 'danger' ? 'selected' : '' }}>🚨 Peligro</option>
                </select>
            </div>

            <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200">
                <input type="checkbox" name="active" id="active" value="1" {{ old('active', $alert->active) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <label for="active" class="text-sm font-medium text-slate-700 cursor-pointer">
                    Alerta activa <span class="text-slate-400 font-normal">— Visible para todos los usuarios</span>
                </label>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Guardar alerta</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#message'), {
    toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
}).catch(e => console.error(e));
</script>
@endpush

</x-app-layout>
