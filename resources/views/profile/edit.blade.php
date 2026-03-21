<x-app-layout>

<div class="page-hd mb-8">
    <div>
        <h1 class="page-title"><i class="fas fa-circle-user mr-2 text-blue-600"></i>Mi perfil</h1>
        <p class="page-sub">Gestiona tu información personal y seguridad de la cuenta</p>
    </div>
</div>

<div class="max-w-2xl space-y-6">
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.gdpr-privacy-form')
    @include('profile.partials.delete-user-form')
</div>

</x-app-layout>
