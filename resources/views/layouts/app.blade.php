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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.js" defer></script>

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
    @stack('css')
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-secondary">
        <div class="flex-1 py-4 basis-64">
            @include('layouts.navigation')
        </div>

        <!-- Page Content -->
        {{-- <div class="flex-1 max-w-screen-xl px-6 py-12">
            {{ $slot }}
    </div> --}}
    </div>
    @livewire('livewire-ui-modal')
    @livewireScripts
    <script src="/livewire/livewire.js"></script>
    @stack('js')
</body>

</html>