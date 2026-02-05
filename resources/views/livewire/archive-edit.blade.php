<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Edit Arsip: {{ $judul_halaman }}
            </h2>
            <a href="{{ route('arsip.index', $kategori) }}" class="text-sm text-blue-600 hover:underline">
                &larr; Batal & Kembali
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form wire:submit="update" enctype="multipart/form-data">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Dokumen</label>
                        <input type="text" wire:model="nomor_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        @error('nomor_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Dokumen</label>
                        <input type="date" wire:model="tanggal_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        @error('tanggal_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Dokumen / Perihal</label>
                        <input type="text" wire:model="nama_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        @error('nama_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($kategori == 'pembayaran')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nominal (Rp)</label>
                            <input type="number" wire:model="nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Penerima</label>
                            <input type="text" wire:model="penerima" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        </div>
                    @endif

                    @if($kategori == 'perjalanan_dinas')
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Lokasi Tujuan</label>
                            <input type="text" wire:model="lokasi_tujuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea wire:model="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"></textarea>
                    </div>

                    <div class="md:col-span-2 p-4 bg-gray-50 border rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Arsip</label>
                        
                        @if($file_lama)
                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span>File saat ini: <a href="{{ asset('storage/'.$file_lama) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></span>
                            </div>
                        @endif

                        <input type="file" wire:model="file_arsip" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                        <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika tidak ingin mengubah file.</p>
                        
                        @error('file_arsip') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="file_arsip" class="text-sm text-blue-500 mt-1">Mengupload file baru...</div>
                    </div>

                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                        Update Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>