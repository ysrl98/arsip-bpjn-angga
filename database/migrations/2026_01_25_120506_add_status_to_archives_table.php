<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            // Default 'pending' artinya butuh persetujuan admin
            $table->enum('status', ['pending', 'valid', 'rejected'])->default('pending')->after('kategori');
            $table->text('catatan_admin')->nullable()->after('status'); // Alasan jika ditolak
        });
    }

    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropColumn(['status', 'catatan_admin']);
        });
    }
};
