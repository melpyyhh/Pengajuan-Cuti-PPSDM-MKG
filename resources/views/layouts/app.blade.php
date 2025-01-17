<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@2.0.0/dist/cdn.min.js"></script>
    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @livewireStyles
    @stack('css')
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-secondary">
        <div class="flex-1 py-4 basis-64">
            @include('layouts.navigation')
            @livewire('chatbot')
        </div>

        <!-- Page Content -->
        {{-- <div class="flex-1 max-w-screen-xl px-6 py-12">
            {{ $slot }}
    </div> --}}
    </div>
    @livewire('livewire-ui-modal')
    <!-- <script src="/livewire/livewire.js"></script> -->
    <!-- @stack('js') -->
    @livewireScripts
</body>

</html>
