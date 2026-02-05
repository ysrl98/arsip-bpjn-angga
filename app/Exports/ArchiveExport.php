<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArchiveExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $kategori;
    protected $tahun;
    protected $search;

    // Terima data filter dari Livewire
    public function __construct($kategori, $tahun, $search)
    {
        $this->kategori = $kategori;
        $this->tahun = $tahun;
        $this->search = $search;
    }

    public function query()
    {
        $query = Archive::query()->where('kategori', $this->kategori);

        // Terapkan Filter yang sama persis dengan di Halaman Index
        if ($this->tahun != 'semua') {
            $query->whereYear('tanggal_dokumen', $this->tahun);
        }

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_dokumen', 'like', '%' . $this->search . '%')
                  ->orWhere('nomor_dokumen', 'like', '%' . $this->search . '%');
            });
        }

        return $query->latest(); // Urutkan dari yang terbaru
    }

    // Judul Kolom (Header)
    public function headings(): array
    {
        $headers = ['Tanggal', 'No. Dokumen', 'Perihal/Nama', 'Deskripsi'];

        // Header Dinamis
        if ($this->kategori == 'pembayaran' || $this->kategori == 'kontrak') {
            $headers[] = 'Nominal (Rp)';
            $headers[] = 'Penerima/Pihak Terkait';
        }
        if ($this->kategori == 'perjalanan_dinas') {
            $headers[] = 'Lokasi Tujuan';
        }

        // Header Umum Tambahan
        $headers[] = 'Tahun Anggaran';
        $headers[] = 'Status Verifikasi';
        $headers[] = 'Uploader';

        return $headers;
    }

    // Isi Data per Baris
    public function map($archive): array
    {
        $row = [
            $archive->tanggal_dokumen,
            $archive->nomor_dokumen,
            $archive->nama_dokumen,
            $archive->deskripsi,
        ];

        // Data Dinamis
        if ($this->kategori == 'pembayaran' || $this->kategori == 'kontrak') {
            $row[] = $archive->nominal;
            $row[] = $archive->penerima;
        }
        if ($this->kategori == 'perjalanan_dinas') {
            $row[] = $archive->lokasi_tujuan;
        }

        // Data Umum Tambahan
        $row[] = $archive->tahun_anggaran ?? '-';
        $row[] = strtoupper($archive->status);
        $row[] = $archive->user->nama_lengkap ?? 'Unknown';

        return $row;
    }

    // Styling Header (Bold)
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}