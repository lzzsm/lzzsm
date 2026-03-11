<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/form.css', 'resources/js/form.js'])
    @livewireStyles

</head>

<body>

    <!-- Conteúdo principal -->
    <main class="font-sans text-gray-900 antialiased">
        <!-- Flash Notifications -->
        @include('components.flash-notification')
        @yield('content')
    </main>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
</body>

</html>
