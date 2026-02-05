<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Audit Trail (Log Aktivitas)</h2>
            <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded shadow-sm">
                Total Rekaman: {{ $logs->total() }}
            </span>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Waktu Kejadian</th>
                            <th class="px-6 py-3">Pelaku (User)</th>
                            <th class="px-6 py-3">Jenis Aksi</th>
                            <th class="px-6 py-3">Deskripsi Aktivitas</th>
                            <th class="px-6 py-3">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr class="bg-white border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        {{ $log->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $log->created_at->format('H:i:s') }} WITA
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 text-xs">
                                            {{ substr($log->user->nama_lengkap ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $log->user->nama_lengkap ?? 'User Terhapus' }}</div>
                                            <div class="text-xs text-gray-400">{{ $log->user->nip ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $colors = [
                                            'UPLOAD' => 'bg-green-100 text-green-800',
                                            'UPDATE' => 'bg-yellow-100 text-yellow-800',
                                            'DELETE' => 'bg-red-100 text-red-800',
                                            'VERIFIKASI' => 'bg-blue-100 text-blue-800',
                                            'TOLAK' => 'bg-gray-100 text-gray-800',
                                        ];
                                        $color = $colors[$log->action] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="{{ $color }} text-xs font-bold px-2.5 py-0.5 rounded border border-opacity-20">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $log->description }}
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-gray-400">
                                    {{ $log->ip_address }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-100">
                {{ $logs->links() }}
            </div>
        </div>

    </div>
</div>