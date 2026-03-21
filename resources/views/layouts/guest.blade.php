<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SyncJornada') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-sm">
    {{-- Logo --}}
    <a href="/" class="flex items-center justify-center gap-3 mb-8">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg">
            <i class="fas fa-clock text-white text-base"></i>
        </div>
        <span class="text-xl font-bold text-slate-800">Sync<span class="text-blue-600">Jornada</span></span>
    </a>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    <p class="text-center text-xs text-slate-400 mt-6">
        &copy; {{ date('Y') }} SyncJornada &mdash; Control de jornada laboral
    </p>
</div>

</body>
</html>
