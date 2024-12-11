<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@2.0.0/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen  bg-secondary flex">
        <div class="flex-none basis-64">
            @include('layouts.navigation')
        </div>

        <!-- Page Content -->
        <div class="flex-1 p-6 max-w-screen-xl">
            {{ $slot }}
        </div>
    </div>
    @livewire('livewire-ui-modal')
    @livewireScripts
</body>

</html>