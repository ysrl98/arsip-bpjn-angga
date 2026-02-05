<x-app-layout>
    
    @section('header_title', 'Pengaturan Akun')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-2xl p-6 text-white shadow-xl flex items-center justify-between relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->nama_lengkap }}!</h2>
                    <p class="text-blue-200 text-sm mt-1">Kelola informasi pribadi dan keamanan akun Anda di sini.</p>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-yellow-500 opacity-10 transform skew-x-12 translate-x-10"></div>
                <div class="relative z-10 h-12 w-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/30">
                     <span class="text-xl font-bold">{{ substr(auth()->user()->nama_lengkap, 0, 1) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-xl border border-gray-100">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </span>
                                Informasi Profil
                            </h3>
                            <livewire:profile.update-profile-information-form />
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    
                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-xl border border-gray-100">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <span class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </span>
                                Ganti Password
                            </h3>
                            <livewire:profile.update-password-form />
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-xl border border-red-100">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-bold text-red-600 mb-4 flex items-center">
                                <span class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </span>
                                Zona Bahaya
                            </h3>
                            <livewire:profile.delete-user-form />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 