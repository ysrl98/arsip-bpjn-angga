<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex items-center gap-4">
                
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition duration-300 md:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="font-bold text-xl tracking-tight text-blue-900">
                    @yield('header_title', 'Sistem Arsip BPJN')
                </h2>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 group">
                            <div class="text-right mr-3">
                                <div class="text-gray-800 font-bold group-hover:text-blue-600 transition">{{ auth()->user()->nama_lengkap }}</div>
                                <div class="text-xs text-gray-400">{{ auth()->user()->nip }}</div>
                            </div>
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow-md border-2 border-white ring-1 ring-gray-100">
                                {{ substr(auth()->user()->nama_lengkap, 0, 1) }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile Saya') }}
                        </x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden absolute top-16 left-0 w-full bg-white/95 backdrop-blur-xl border-b border-gray-200 shadow-2xl z-50 rounded-b-3xl overflow-hidden">
        
        <div class="pt-4 pb-6 px-4 space-y-2">
            
            <div class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</div>

            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-yellow-100 text-yellow-800 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                <div class="p-2 bg-white rounded-lg shadow-sm mr-3 text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                Dashboard
            </a>

            <div class="px-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-4">Kategori Arsip</div>

            <div class="grid grid-cols-2 gap-3">
                
                <a href="{{ route('arsip.index', 'pembayaran') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-blue-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
                    <span class="text-xs font-medium text-gray-600">Pembayaran</span>
                </a>

                <a href="{{ route('arsip.index', 'spm') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-purple-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="text-xs font-medium text-gray-600">SPM & SP2D</span>
                </a>

                <a href="{{ route('arsip.index', 'perjalanan_dinas') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-green-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    <span class="text-xs font-medium text-gray-600">Perj. Dinas</span>
                </a>

                <a href="{{ route('arsip.index', 'kontrak') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-orange-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span class="text-xs font-medium text-gray-600">Kontrak</span>
                </a>

                <a href="{{ route('arsip.index', 'anggaran') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-teal-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /></svg>
                    <span class="text-xs font-medium text-gray-600">Anggaran</span>
                </a>

                <a href="{{ route('arsip.index', 'kepegawaian') }}" class="flex flex-col items-center justify-center p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition text-center group">
                    <svg class="w-6 h-6 text-pink-500 mb-1 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span class="text-xs font-medium text-gray-600">Kepegawaian</span>
                </a>

            </div>

            @if(auth()->user()->role === 'admin')
                <div class="px-2 text-xs font-bold text-red-400 uppercase tracking-wider mb-2 mt-4">Administrator</div>
                <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-xl bg-red-50 text-red-700 border border-red-100 mb-2">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen User
                </a>
            @endif

            <div class="border-t border-gray-100 mt-4 pt-4">
                <div class="flex items-center px-2 mb-3">
                    <div class="flex-shrink-0">
                         <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                            {{ substr(auth()->user()->nama_lengkap, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->nama_lengkap }}</div>
                        <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                     <a href="{{ route('profile') }}" class="flex items-center justify-center py-2 px-4 rounded-lg bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200">
                        Profile
                    </a>
                    <button wire:click="logout" class="flex items-center justify-center py-2 px-4 rounded-lg bg-red-100 text-red-700 text-sm font-medium hover:bg-red-200">
                        Log Out
                    </button>
                </div>
            </div>

        </div>
    </div>
</nav>