<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Digital Kepegawaian - BPJN</title>

    <linkpreconnect href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">

    <div class="relative min-h-screen flex flex-col justify-center items-center bg-gray-900 selection:bg-yellow-500 selection:text-white overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1596734162489-08a8a2528148?q=80&w=2070&auto=format&fit=crop" 
                 alt="Background Infrastruktur" 
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-blue-900/80 to-slate-900/90"></div>
        </div>

        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

        <div class="relative z-10 w-full max-w-4xl px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-8 bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl overflow-hidden">
                
                <div class="p-8 md:p-12 flex flex-col justify-center text-white">
                    <div class="mb-6">
                        <div class="mb-6">
                        <img src="{{ asset('images/logo.png') }}" 
                            alt="Logo PUPR" 
                            class="w-20 h-auto drop-shadow-xl hover:scale-105 transition transform duration-300">
                    </div>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-2">
                        Arsip Digital
                    </h1>
                    <h2 class="text-xl md:text-2xl font-semibold text-yellow-400 mb-6">
                        Divisi Kepegawaian
                    </h2>
                    
                    <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 opacity-90">
                        Sistem Informasi Pengelolaan Dokumen Balai Pelaksanaan Jalan Nasional (BPJN). 
                        Mengelola Arsip Pembayaran, SPM, Kontrak, dan Kepegawaian secara terintegrasi, aman, dan efisien.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold rounded-xl shadow-lg hover:shadow-yellow-500/30 transition transform hover:-translate-y-1 text-center">
                                    Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold rounded-xl shadow-lg hover:shadow-yellow-500/30 transition transform hover:-translate-y-1 text-center flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    Login Pegawai
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>

                <div class="hidden md:flex flex-col justify-center bg-blue-900/40 p-12 border-l border-white/10">
                    <h3 class="text-white font-bold text-lg mb-6 border-b border-white/20 pb-2">Fitur Utama</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-white/5 transition">
                            <div class="bg-blue-500/20 p-2 rounded-lg text-yellow-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-sm">Arsip Terpusat</h4>
                                <p class="text-blue-200 text-xs">Akses dokumen Pembayaran, SPM, dan Kontrak dalam satu pintu.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-white/5 transition">
                            <div class="bg-blue-500/20 p-2 rounded-lg text-yellow-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-sm">Keamanan Data</h4>
                                <p class="text-blue-200 text-xs">Proteksi akses berbasis NIP dan Role (Admin/User).</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-white/5 transition">
                            <div class="bg-blue-500/20 p-2 rounded-lg text-yellow-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-sm">Statistik Real-time</h4>
                                <p class="text-blue-200 text-xs">Monitoring jumlah upload dan aktivitas kepegawaian.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-white/10 text-center">
                        <p class="text-xs text-blue-300 font-mono tracking-widest uppercase">Sigap Membangun Negeri</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-blue-200 text-xs opacity-60">
                    &copy; {{ date('Y') }} Balai Pelaksanaan Jalan Nasional. Kementerian PUPR.
                </p>
            </div>
        </div>
    </div>
</body>
</html>