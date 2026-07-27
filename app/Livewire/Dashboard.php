<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Archive;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    // Tambahkan properti tahun
    public $tahun;

    public function mount()
    {
        $this->tahun = date('Y');
    }

    public function render()
    {
        // Query Dasar dengan Filter Tahun
        $query = Archive::query();
        
        if ($this->tahun != 'semua') {
            $query->whereYear('tanggal_dokumen', $this->tahun);
        }

        // Statistik per Kategori (Grafik)
        $per_kategori = Archive::select('kategori', DB::raw('count(*) as total'))
                            ->when($this->tahun != 'semua', function($q) {
                                return $q->whereYear('tanggal_dokumen', $this->tahun);
                            })
                            ->groupBy('kategori')
                            ->get();

        return view('livewire.dashboard', [
            // Statistik Kartu (Mengikuti Filter Tahun)
            'total_arsip' => $query->count(),
            
            // Total Pegawai (Tidak kena filter tahun, karena pegawai tetap)
            'total_pegawai' => User::whereIn('role', ['user', 'pimpinan'])->count(),

            // Arsip Baru (Khusus Bulan Ini di Tahun Terpilih)
            'arsip_bulan_ini' => Archive::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y')) // Tetap tahun berjalan
                                ->count(),
            
            // Data untuk Grafik Batang (Per Bulan)
            'chart_data' => collect(range(1, 12))->map(function($month) use ($query) {
                $q = Archive::whereMonth('tanggal_dokumen', $month);
                if ($this->tahun != 'semua') {
                    $q->whereYear('tanggal_dokumen', $this->tahun);
                }
                return $q->count();
            })->toArray(),
            
            'per_kategori' => $per_kategori,

            // Tabel Terbaru (Tidak kena filter, selalu tampilkan yg input terakhir)
            'recent_archives' => Archive::with('user')->latest()->take(5)->get()
        ])->layout('layouts.app');
    }
}