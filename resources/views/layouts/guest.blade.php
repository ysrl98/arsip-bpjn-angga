<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <linkpreconnect href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    
    <div class="min-h-screen flex bg-white">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 justify-center items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=2069&auto=format&fit=crop" 
                     alt="Background Login" 
                     class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 to-gray-900/80"></div>
            </div>

            <div class="relative z-10 p-12 text-white text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo PUPR" class="w-24 h-auto mx-auto mb-6 drop-shadow-2xl">
                <h2 class="text-3xl font-bold mb-2">Sistem Arsip Digital</h2>
                <h3 class="text-xl font-medium text-yellow-400">Balai Pelaksanaan Jalan Nasional</h3>
                <p class="mt-4 text-blue-200 text-sm max-w-md mx-auto">
                    Kelola dokumen pembayaran, kontrak, dan kepegawaian dalam satu pintu yang aman dan terintegrasi.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 w-full h-2 bg-yellow-500"></div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-gray-50">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-auto mx-auto">
                    <h2 class="mt-4 text-xl font-bold text-gray-800">Login Pegawai</h2>
                </div>

                <div class="hidden lg:block mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                    <p class="text-sm text-gray-500">Silakan masukkan NIP dan Password Anda.</p>
                </div>

                {{ $slot }}
                
            </div>
            
            <p class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Divisi Kepegawaian BPJN.
            </p>
        </div>

    </div>

</body>
</html>