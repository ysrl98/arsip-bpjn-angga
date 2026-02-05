<aside class="w-64 bg-blue-900 text-white min-h-screen hidden md:flex flex-col flex-shrink-0 transition-all duration-300 shadow-xl relative z-20">
    
    <div class="h-20 flex items-center px-6 border-b border-blue-800 bg-blue-950">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-auto mr-3 drop-shadow-md">
        <div>
            <h1 class="text-lg font-extrabold tracking-wider text-white leading-none">ARSIP</h1>
            <span class="text-xs text-yellow-400 font-semibold tracking-widest">DIGITAL BPJN</span>
        </div>
    </div>

    <div class="px-6 py-6 border-b border-blue-800 bg-blue-900/50">
        <p class="text-xs text-blue-300 uppercase tracking-wider mb-1">Login Sebagai</p>
        <p class="font-bold text-white truncate">{{ auth()->user()->nama_lengkap }}</p>
        <p class="text-xs text-yellow-400 capitalize">{{ auth()->user()->role }}</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-yellow-500 text-blue-900 shadow-lg shadow-yellow-500/20' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-900' : 'text-blue-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        <div class="pt-6 pb-2">
            <p class="px-4 text-xs font-bold text-blue-400 uppercase tracking-widest">
                Dokumen Arsip
            </p>
        </div>

        @php
            $menus = [
                ['route' => 'pembayaran', 'label' => 'Pembayaran', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z'],
                ['route' => 'spm', 'label' => 'SPM & SP2D', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'perjalanan_dinas', 'label' => 'Perjalanan Dinas', 'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8'],
                ['route' => 'kontrak', 'label' => 'Kontrak Proyek', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['route' => 'anggaran', 'label' => 'Anggaran', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z'],
                ['route' => 'kepegawaian', 'label' => 'Kepegawaian', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ route('arsip.index', $menu['route']) }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->is('arsip/'.$menu['route'].'*') ? 'bg-blue-800 text-white border-l-4 border-yellow-400' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->is('arsip/'.$menu['route'].'*') ? 'text-yellow-400' : 'text-blue-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}" />
                </svg>
                {{ $menu['label'] }}
            </a>
        @endforeach

        @if(auth()->user()->role === 'admin')
            <div class="pt-6 pb-2">
                <p class="px-4 text-xs font-bold text-blue-400 uppercase tracking-widest">
                    Administrator
                </p>
            </div>

            <a href="{{ route('users.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('users.*') ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'text-blue-100 hover:bg-red-900/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Manajemen User
            </a>
            <a href="{{ route('activity-log') }}" 
            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('activity-log') ? 'bg-indigo-600 text-white shadow-lg' : 'text-blue-100 hover:bg-indigo-900/50 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('activity-log') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Log Aktivitas
            </a>
        @endif
    </nav>
    
    <div class="p-4 text-center">
        <p class="text-[10px] text-blue-400 opacity-60">Sistem Arsip v1.0.0 BPJN</p>
    </div>
</aside>