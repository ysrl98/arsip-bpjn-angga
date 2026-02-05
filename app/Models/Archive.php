<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori',
        'nomor_dokumen',
        'nama_dokumen',
        'tanggal_dokumen',
        'deskripsi',
        'file_path',
        // Field Khusus
        'nominal',
        'penerima',
        'lokasi_tujuan',
        'tahun_anggaran',
        'status',        // BARU
        'catatan_admin', // BARU
    ];

    // Relasi: Setiap arsip milik satu User (Uploader)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}