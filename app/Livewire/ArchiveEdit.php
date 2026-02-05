<?php

namespace App\Livewire;

use App\Models\Archive;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ArchiveEdit extends Component
{
    use WithFileUploads;

    public $archive_id;
    public $kategori;
    public $judul_halaman;

    // Form Input
    public $nomor_dokumen;
    public $nama_dokumen;
    public $tanggal_dokumen;
    public $deskripsi;
    
    public $file_arsip; // File BARU (jika diupload)
    public $file_lama;  // Nama file LAMA (untuk preview)

    // Form Khusus
    public $nominal;
    public $penerima;
    public $lokasi_tujuan;
    public $tahun_anggaran;

    public function mount($kategori, $id)
    {
        $this->kategori = $kategori;
        $this->judul_halaman = ucwords(str_replace('_', ' ', $kategori));
        $this->archive_id = $id;

        // AMBIL DATA LAMA DARI DATABASE
        $archive = Archive::findOrFail($id);

        // Masukkan ke Form
        $this->nomor_dokumen = $archive->nomor_dokumen;
        $this->nama_dokumen = $archive->nama_dokumen;
        $this->tanggal_dokumen = $archive->tanggal_dokumen;
        $this->deskripsi = $archive->deskripsi;
        $this->file_lama = $archive->file_path; // Simpan path lama
        
        $this->nominal = $archive->nominal;
        $this->penerima = $archive->penerima;
        $this->lokasi_tujuan = $archive->lokasi_tujuan;
        $this->tahun_anggaran = $archive->tahun_anggaran;
    }

    public function update()
    {
        // 1. Validasi (File Arsip BOLEH KOSONG saat edit)
        $rules = [
            'nomor_dokumen' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'tanggal_dokumen' => 'required|date',
            'file_arsip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Nullable = Boleh kosong
        ];

        if ($this->kategori == 'pembayaran') {
            $rules['nominal'] = 'required|numeric';
            $rules['penerima'] = 'required|string';
        }
        if ($this->kategori == 'perjalanan_dinas') {
            $rules['lokasi_tujuan'] = 'required|string';
        }

        $this->validate($rules);

        $archive = Archive::findOrFail($this->archive_id);

        // 2. Cek apakah user upload file baru?
        if ($this->file_arsip) {
            // Hapus file lama biar server gak penuh
            if ($archive->file_path && Storage::disk('public')->exists($archive->file_path)) {
                Storage::disk('public')->delete($archive->file_path);
            }
            // Upload file baru
            $path = $this->file_arsip->store('arsip/' . $this->kategori, 'public');
            $archive->file_path = $path;
        }

        // 3. Update Data Text
        $archive->update([
            'nomor_dokumen' => $this->nomor_dokumen,
            'nama_dokumen' => $this->nama_dokumen,
            'tanggal_dokumen' => $this->tanggal_dokumen,
            'deskripsi' => $this->deskripsi,
            'nominal' => $this->nominal,
            'penerima' => $this->penerima,
            'lokasi_tujuan' => $this->lokasi_tujuan,
            'tahun_anggaran' => $this->tahun_anggaran,
        ]);


        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'UPDATE',
            'description' => 'Mengedit data arsip: ' . $this->nama_dokumen,
            'ip_address' => request()->ip()
        ]);
        session()->flash('message', 'Arsip berhasil diperbarui!');
        return redirect()->route('arsip.index', $this->kategori);
    }

    public function render()
    {
        return view('livewire.archive-edit')->layout('layouts.app');
    }
}