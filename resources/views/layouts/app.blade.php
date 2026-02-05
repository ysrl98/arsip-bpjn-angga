<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arsip BPJN') }}</title>

    <linkpreconnect href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-slate-50 flex font-sans relative">
        
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <livewire:layout.navigation />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                {{ $slot }}
            </main>
            
        </div>

        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 md:hidden"
             style="display: none;">
        </div>

    </div>
</body>
</html>