<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Upload Arsip: {{ $judul_halaman }}
            </h2>
            <a href="{{ route('arsip.index', $kategori) }}" class="text-sm text-blue-600 hover:underline">
                &larr; Kembali ke Daftar Arsip
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form wire:submit="save" enctype="multipart/form-data">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Dokumen</label>
                        <input type="text" wire:model="nomor_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nomor_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Dokumen</label>
                        <input type="date" wire:model="tanggal_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tanggal_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Dokumen / Perihal</label>
                        <input type="text" wire:model="nama_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama_dokumen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($kategori == 'pembayaran')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nominal (Rp)</label>
                            <input type="number" wire:model="nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Penerima</label>
                            <input type="text" wire:model="penerima" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    @endif

                    @if($kategori == 'perjalanan_dinas')
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Lokasi Tujuan</label>
                            <input type="text" wire:model="lokasi_tujuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file" wire:model="file_arsip" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('file_arsip') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="file_arsip" class="text-sm text-blue-500 mt-1">Mengupload...</div>
                    </div>

                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                        Simpan Arsip
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>