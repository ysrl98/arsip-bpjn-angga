<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Dokumen - Arsip BPJN</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen flex flex-col justify-center items-center p-4">
    
    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        
        <!-- Header -->
        <div class="bg-blue-900 p-6 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo BPJN" class="w-16 h-16 mx-auto mb-3 drop-shadow-md">
            <h1 class="text-white text-xl font-bold tracking-wider">Verifikasi Keaslian</h1>
            <p class="text-blue-200 text-sm">Sistem Informasi Arsip Digital BPJN</p>
        </div>

        <div class="p-6">
            @if($archive)
                <!-- Valid State -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mb-4 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-800 text-center">DOKUMEN VALID</h2>
                    <p class="text-sm text-green-600 font-semibold text-center mt-1 bg-green-50 px-3 py-1 rounded-full">Telah Disahkan oleh Pimpinan</p>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Nomor Dokumen</p>
                        <p class="text-md font-semibold text-gray-900">{{ $archive->nomor_dokumen }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Perihal / Nama</p>
                        <p class="text-md font-semibold text-gray-900">{{ $archive->nama_dokumen }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <p class="text-xs text-gray-500 uppercase font-bold mb-1">Tanggal</p>
                            <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($archive->tanggal_dokumen)->format('d M Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <p class="text-xs text-gray-500 uppercase font-bold mb-1">Kategori</p>
                            <p class="text-sm font-semibold text-blue-700 capitalize">{{ str_replace('_', ' ', $archive->kategori) }}</p>
                        </div>
                    </div>

                    @if($archive->nominal)
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Nominal</p>
                        <p class="text-lg font-bold text-green-600">Rp {{ number_format($archive->nominal, 0, ',', '.') }}</p>
                    </div>
                    @endif

                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mt-6">
                        <p class="text-xs text-blue-500 uppercase font-bold mb-1">Diunggah Oleh</p>
                        <p class="text-sm font-semibold text-blue-900">{{ $archive->user->nama_lengkap }}</p>
                        <p class="text-xs text-blue-700">{{ $archive->user->unit_kerja }}</p>
                    </div>
                </div>

                <div class="mt-8 text-center text-xs text-gray-400 break-all bg-gray-50 p-2 rounded border border-gray-100">
                    <span class="font-bold">Hash:</span><br> {{ $hash }}
                </div>
            @else
                <!-- Invalid State -->
                <div class="flex flex-col items-center my-10">
                    <div class="w-24 h-24 bg-red-100 text-red-500 rounded-full flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-800 text-center">DOKUMEN PALSU / TIDAK DITEMUKAN</h2>
                    <p class="text-sm text-gray-600 text-center mt-3 leading-relaxed">
                        Dokumen yang Anda scan <strong>tidak terdapat di sistem kami</strong>, atau isi dokumen telah <strong>dimanipulasi</strong> sehingga nilai sidik jari digital (Hash) tidak cocok.
                    </p>
                </div>
            @endif
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-center text-xs text-gray-500">
            Arsip Digital BPJN &copy; {{ date('Y') }}
        </div>
    </div>

</body>
</html>
