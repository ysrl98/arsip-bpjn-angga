<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan raw statement untuk menghindari kebutuhan library tambahan (doctrine/dbal) 
        // saat mengubah tipe data ENUM
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'pimpinan') NOT NULL DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pada down migration, idealnya kita tidak membuang data, 
        // tapi jika harus dikembalikan, pastikan pimpinan tidak ada
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user'");
    }
};
