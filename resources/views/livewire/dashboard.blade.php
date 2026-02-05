
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Overview Statistik</h2>
                <p class="text-sm text-gray-500">Pantau kinerja pengarsipan secara real-time.</p>
            </div>
            <div class="w-40">
                <select wire:model.live="tahun" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50">
                    <option value="semua">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}">Tahun {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Dokumen Arsip</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $total_arsip }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Upload Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $arsip_bulan_ini }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pegawai Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $total_pegawai }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="bg-white shadow-sm sm:rounded-lg p-6 lg:col-span-1">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Sebaran Arsip</h3>
                <div class="space-y-4">
                    @foreach($per_kategori as $data)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $data->kategori) }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $data->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                @php $persen = ($total_arsip > 0) ? ($data->total / $total_arsip) * 100 : 0; @endphp
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $persen }}%"></div>
                            </div>
                        </div>
                    @endforeach
                    
                    @if($total_arsip == 0)
                        <p class="text-sm text-gray-400 text-center italic">Belum ada data arsip.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 lg:col-span-2">
                <h3 class="text-lg font-bold text-gray-800 mb-4">5 Arsip Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Kategori</th>
                                <th class="px-4 py-2">Perihal</th>
                                <th class="px-4 py-2">Oleh</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_archives as $archive)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($archive->created_at)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded capitalize">
                                            {{ str_replace('_', ' ', $archive->kategori) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 truncate max-w-xs font-medium text-gray-900">
                                        {{ $archive->nama_dokumen }}
                                    </td>
                                    <td class="px-4 py-3">{{ $archive->user->nama_lengkap }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ asset('storage/' . $archive->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-400">Belum ada aktivitas terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>