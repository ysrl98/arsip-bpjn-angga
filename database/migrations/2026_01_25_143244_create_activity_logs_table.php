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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa pelakunya
            $table->string('action'); // Apa aksinya (CREATE, UPDATE, DELETE, APPROVE)
            $table->text('description'); // Detailnya (Misal: "Menghapus Arsip No. 123")
            $table->string('ip_address')->nullable(); // Alamat IP (Opsional, untuk keamanan)
            $table->timestamps(); // Kapan kejadiannya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
