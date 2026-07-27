<?php

namespace App\Livewire;

use App\Models\Archive;
use Livewire\Component;
use Livewire\WithFileUploads; 
use Illuminate\Support\Facades\Auth;

class ArchiveCreate extends Component
{
    use WithFileUploads;

    public $kategori;
    public $judul_halaman;
    
    // Form Input
    public $nomor_dokumen;
    public $nama_dokumen;
    public $tanggal_dokumen;
    public $deskripsi;
    public $file_arsip = []; // Diubah jadi array

    // Form Khusus
    public $nominal;
    public $penerima;
    public $lokasi_tujuan;
    public $tahun_anggaran;

    public function mount($kategori)
    {
        $this->kategori = $kategori;
        $this->judul_halaman = ucwords(str_replace('_', ' ', $kategori));
        $this->tanggal_dokumen = date('Y-m-d'); 
    }

    public function save()
    {
        $rules = [
            'nomor_dokumen' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'tanggal_dokumen' => 'required|date',
            'file_arsip' => 'required|array|min:1',
            'file_arsip.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120', 
        ];

        if ($this->kategori == 'pembayaran') {
            $rules['nominal'] = 'required|numeric';
            $rules['penerima'] = 'required|string';
        }
        if ($this->kategori == 'perjalanan_dinas') {
            $rules['lokasi_tujuan'] = 'required|string';
        }

        $this->validate($rules);

        // Menyimpan multi file
        $paths = [];
        foreach ($this->file_arsip as $file) {
            $paths[] = $file->store('arsip/' . $this->kategori, 'public');
        }

        Archive::create([
            'user_id' => Auth::id(),
            'kategori' => $this->kategori,
            'nomor_dokumen' => $this->nomor_dokumen,
            'nama_dokumen' => $this->nama_dokumen,
            'tanggal_dokumen' => $this->tanggal_dokumen,
            'deskripsi' => $this->deskripsi,
            'file_path' => $paths[0], // Ambil path pertama sebagai main file
            'attachments' => $paths,  // Simpan seluruh array path di attachments
            'nominal' => $this->nominal,
            'penerima' => $this->penerima,
            'lokasi_tujuan' => $this->lokasi_tujuan,
            'tahun_anggaran' => $this->tahun_anggaran,
        ]);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'UPLOAD',
            'description' => 'Mengupload arsip baru: ' . $this->nama_dokumen . ' (' . $this->nomor_dokumen . ')',
            'ip_address' => request()->ip()
        ]);

        session()->flash('message', 'Arsip berhasil disimpan!');
        return redirect()->route('arsip.index', $this->kategori);
    }

    public function render()
    {
        return view('livewire.archive-create')->layout('layouts.app');
    }
}