<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Approval Board (Antrean Persetujuan)
            </h2>
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
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Tanggal Dokumen</th>
                            <th class="px-6 py-3">Detail Dokumen</th>
                            <th class="px-6 py-3">Uploader</th>
                            <th class="px-6 py-3 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archives as $archive)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 uppercase font-semibold text-blue-800">
                                    {{ str_replace('_', ' ', $archive->kategori) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($archive->tanggal_dokumen)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $archive->nomor_dokumen }}</div>
                                    <div class="text-gray-700">{{ $archive->nama_dokumen }}</div>
                                    @if($archive->nominal)
                                    <div class="text-green-600 font-semibold mt-1">Rp {{ number_format($archive->nominal, 0, ',', '.') }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $archive->user->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-500">{{ $archive->user->unit_kerja }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">
                                        
                                        <a href="{{ route('dokumen.download', $archive->id) }}" target="_blank" 
                                           class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition" title="Lihat/Download Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>

                                        <button wire:click="approve({{ $archive->id }})" 
                                                wire:confirm="Setujui dokumen ini? Sistem akan menghitung Hash secara otomatis."
                                                class="p-2 text-white bg-green-600 hover:bg-green-700 rounded-md transition shadow-sm font-bold flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Setujui
                                        </button>
                                        
                                        <button wire:click="reject({{ $archive->id }})" 
                                                wire:confirm="Tolak dokumen ini dan minta perbaikan?"
                                                class="p-2 text-white bg-red-600 hover:bg-red-700 rounded-md transition shadow-sm font-bold flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Tolak
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p>Tidak ada antrean dokumen yang butuh persetujuan.</p>
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
