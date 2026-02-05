<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // --- AKUN LOGIN ---
            $table->string('nip', 20)->unique(); // Username Login
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken();

            // --- DATA PRIBADI WAJIB ---
            $table->string('nama_lengkap'); // Lengkap dengan gelar
            $table->string('email')->unique()->nullable(); // Penting untuk notifikasi/reset password
            $table->string('no_hp', 15)->nullable(); // Penting untuk koordinasi cepat

            // --- DATA JABATAN & POSISI (Wajib untuk Arsip) ---
            // Contoh: "Penata Muda Tk.I (III/b)"
            $table->string('pangkat_golongan')->nullable(); 
            
            // Contoh: "PPK 1.1", "Bendahara Pengeluaran"
            $table->string('jabatan')->nullable(); 
            
            // Contoh: "Satker PJN Wilayah 1", "Subbag Tata Usaha"
            $table->string('unit_kerja')->nullable(); 
            
            // Penting untuk membedakan hak/jenis dokumen
            $table->enum('status_kepegawaian', ['PNS', 'PPPK', 'Honorer/PPNPN'])->default('PNS');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};