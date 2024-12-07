<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-secondary flex">
        <!-- Sidebar -->
        <div class="w-64">
            @include('layouts.navigation')
        </div>

        <!-- Page Content -->
        <main class="flex-grow bg-white">
            <div class="max-w-7xl mx-auto w-full px-5 py-10">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>