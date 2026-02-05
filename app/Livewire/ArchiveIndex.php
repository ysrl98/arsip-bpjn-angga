<?php

namespace App\Livewire;

use App\Exports\ArchiveExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Archive;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage; // <--- PASTIKAN BARIS INI ADA!
use Barryvdh\DomPDF\Facade\Pdf; // Untuk PDF

class ArchiveIndex extends Component
{
    // ... sisa kode di bawahnya biarkan saja ...
    use WithPagination;

    public $kategori;
    public $judul_halaman;
    public $tahun;
    public $search = '';

    // Menangkap parameter dari URL saat halaman dimuat
    public function mount($kategori)
    {
        $this->kategori = $kategori;
        
        // Ubah slug URL menjadi Judul yang cantik (misal: "perjalanan_dinas" -> "Perjalanan Dinas")
        $this->judul_halaman = ucwords(str_replace('_', ' ', $kategori));
        $this->tahun = date('Y');
        }

    
    
    public function delete($id)
    {
        // 1. Cari data arsip berdasarkan ID
        $archive = Archive::find($id);

        if ($archive) {
            $judul = $archive->nama_dokumen;
            // 2. Hapus File Fisik (PDF/Gambar) dari Folder Storage
            if ($archive->file_path && Storage::disk('public')->exists($archive->file_path)) {
                Storage::disk('public')->delete($archive->file_path);
            }

            // 3. Hapus Data dari Database
            $archive->delete();

            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'DELETE',
                'description' => 'Menghapus arsip permanen: ' . $judul,
                'ip_address' => request()->ip()
            ]);

            // 4. Berikan notifikasi (Flash Message)
            session()->flash('message', 'Arsip berhasil dihapus!');
        }
    }
    // ----------------------------
    
    public function approve($id)
    {
        // Hanya Admin yang boleh
        if(auth()->user()->role !== 'admin') { return; }

        $archive = Archive::find($id);
        if ($archive) {
            $archive->update(['status' => 'valid']);
            // ... setelah update status ...
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'VERIFIKASI',
                'description' => 'Menyetujui (Approve) arsip ID: ' . $id,
                'ip_address' => request()->ip()
            ]);
            session()->flash('message', 'Dokumen berhasil diverifikasi (Valid).');
        }
    }

    // FUNGSI 2: TOLAK DOKUMEN
    public function reject($id)
    {
        if(auth()->user()->role !== 'admin') { return; }

        $archive = Archive::find($id);
        if ($archive) {
            $archive->update(['status' => 'rejected']);
            // ... setelah update status ...
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'TOLAK',
                'description' => 'Menolak arsip ID: ' . $id,
                'ip_address' => request()->ip()
            ]);
            session()->flash('message', 'Dokumen ditandai sebagai Ditolak/Salah.');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // public function render()
    // {
    //     $archives = Archive::where('kategori', $this->kategori)
    //         ->with('user')
    //         ->latest()
    //         ->paginate(10);

    //     return view('livewire.archive-index', [
    //         'archives' => $archives
    //     ])->layout('layouts.app');
    // }

    public function render()
    {
        // 1. Mulai Query Dasar
        $query = Archive::where('kategori', $this->kategori);

        // === LOGIKA HYBRID (RECOMMENDED) ===
        
        // Jika User BUKAN Admin...
        if (auth()->user()->role !== 'admin') {
            
            // Cek Kategori:
            // Jika sedang membuka menu 'kepegawaian', aktifkan Mode Privat
            if ($this->kategori == 'kepegawaian') {
                $query->where('user_id', auth()->id());
            }
            
            // Jika kategori lain (Kontrak, SPM, dll), biarkan terbuka (tidak ada filter user_id)
            // agar pegawai bisa saling backup data pekerjaan.
        }

        // ===================================

        // 2. Filter Tahun
        if ($this->tahun != 'semua') {
            $query->whereYear('tanggal_dokumen', $this->tahun);
        }

        // 3. Filter Pencarian
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_dokumen', 'like', '%' . $this->search . '%')
                ->orWhere('nomor_dokumen', 'like', '%' . $this->search . '%');
            });
        }

        $archives = $query->with('user')->latest()->paginate(10);

        return view('livewire.archive-index', [
            'archives' => $archives
        ])->layout('layouts.app');
    }

    public function exportExcel()
    {
        // Nama file otomatis: arsip-pembayaran-2026.xlsx
        $namaFile = 'arsip-' . $this->kategori . '-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(
            new ArchiveExport($this->kategori, $this->tahun, $this->search), 
            $namaFile
        );
    }

    public function exportPdf()
    {
        // 1. Ambil Data (Query sama persis dengan Filter di Render)
        $query = Archive::where('kategori', $this->kategori);

        if ($this->tahun != 'semua') {
            $query->whereYear('tanggal_dokumen', $this->tahun);
        }

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_dokumen', 'like', '%' . $this->search . '%')
                  ->orWhere('nomor_dokumen', 'like', '%' . $this->search . '%');
            });
        }

        $data = $query->latest()->get(); // Ambil semua data (bukan paginate)

        // 2. Generate PDF
        $pdf = Pdf::loadView('pdf.archive-rekap', [
            'data' => $data,
            'kategori' => strtoupper($this->kategori),
            'tahun' => $this->tahun
        ])->setPaper('a4', 'portrait');

        // 3. Download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Laporan-' . $this->kategori . '.pdf');
    }
}
