<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            
            // RELASI: Siapa yang upload?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // JENIS ARSIP (Sesuai Sidebar)
            $table->enum('kategori', [
                'pembayaran', 
                'spm', 
                'perjalanan_dinas', 
                'kontrak', 
                'anggaran', 
                'kepegawaian'
            ]);

            // DATA UTAMA (Wajib Ada di semua surat)
            $table->string('nomor_dokumen');
            $table->string('nama_dokumen'); // Bisa untuk Perihal/Judul
            $table->date('tanggal_dokumen');
            $table->text('deskripsi')->nullable();
            $table->string('file_path'); // Lokasi file PDF tersimpan

            // DATA KHUSUS (Nullable / Boleh Kosong)
            // Untuk Pembayaran
            $table->decimal('nominal', 15, 2)->nullable(); 
            $table->string('penerima')->nullable();
            
            // Untuk Perjalanan Dinas
            $table->string('lokasi_tujuan')->nullable();
            
            // Untuk Anggaran / SPM
            $table->string('tahun_anggaran', 4)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};