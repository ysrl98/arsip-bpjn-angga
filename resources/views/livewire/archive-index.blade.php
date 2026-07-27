<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Arsip: {{ $judul_halaman }}
            </h2>
            
            <div class="flex gap-2">
    
                <div x-data="{ open: false }" class="relative">
                    
                    <button @click="open = !open" @click.outside="open = false" 
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Rekapitulasi
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-gray-100"
                        style="display: none;">
                        
                        <div class="py-1">
                            <button wire:click="exportExcel" @click="open = false" class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Export Excel (.xlsx)
                            </button>

                            <button wire:click="exportPdf" @click="open = false" class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700">
                                <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Export PDF (.pdf)
                            </button>
                        </div>
                    </div>
                </div>
                <a href="{{ route('arsip.create', $kategori) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah
                </a>
            </div>
        </div>
        

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row gap-4">
    
            <div class="w-full md:w-1/4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tahun Dokumen</label>
                <select wire:model.live="tahun" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="semua">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="w-full md:w-3/4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cari Arsip</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" 
                        placeholder="Ketik Nomor Surat atau Nama Dokumen..." 
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

        </div>

        @if (session()->has('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">No. Dokumen</th>
                            <th class="px-6 py-3">Perihal / Nama</th>
                            
                            @if($kategori == 'pembayaran')
                                <th class="px-6 py-3">Nominal</th>
                                <th class="px-6 py-3">Penerima</th>
                            @endif

                             @if($kategori == 'perjalanan_dinas')
                                <th class="px-6 py-3">Tujuan</th>
                            @endif

                            <th class="px-6 py-3">Uploader</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archives as $archive)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($archive->tanggal_dokumen)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($archive->status == 'valid')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">VALID</span>
                                    @elseif($archive->status == 'rejected')
                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">DITOLAK</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded blink">PENDING</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $archive->nomor_dokumen }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $archive->nama_dokumen }}
                                    <p class="text-xs text-gray-400 mt-1 truncate w-48">{{ $archive->deskripsi }}</p>
                                </td>

                                @if($kategori == 'pembayaran')
                                    <td class="px-15 py-4 font-semibold text-green-600">
                                        Rp {{ number_format($archive->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">{{ $archive->penerima }}</td>
                                @endif

                                @if($kategori == 'perjalanan_dinas')
                                    <td class="px-6 py-4">{{ $archive->lokasi_tujuan }}</td>
                                @endif

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="text-xs">
                                            <p class="font-medium text-gray-900">{{ $archive->user->nama_lengkap }}</p>
                                            <p class="text-gray-500">{{ $archive->user->unit_kerja }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    
                                    <div class="flex items-center gap-1 bg-gray-50 p-1 rounded-lg border border-gray-100">
                                        
                                        <a href="{{ route('dokumen.download', $archive->id) }}" target="_blank" 
                                        class="p-1.5 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>

                                        @if(auth()->user()->role == 'admin' || auth()->id() == $archive->user_id)
                                            <a href="{{ route('arsip.edit', ['kategori' => $kategori, 'id' => $archive->id]) }}" 
                                            class="p-1.5 text-yellow-600 hover:bg-yellow-100 rounded-md transition" title="Edit Arsip">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                        @endif

                                        @if(auth()->user()->role == 'admin' || auth()->id() == $archive->user_id)
                                            <button wire:click="delete({{ $archive->id }})"
                                                    wire:confirm="Yakin ingin menghapus arsip ini?"
                                                    class="p-1.5 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus Arsip">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        @endif
                                    </div>



                                </div>
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p>Belum ada arsip di kategori ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4">
                {{ $archives->links() }}
            </div>
        </div>
    </div>
</div>