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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('nama_alat');
            $table->string('kode_alat')->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_tersedia');
            $table->integer('jumlah_total');
            $table->enum('kondisi', ['baik', 'rusak', 'perlu_perbaikan'])->default('baik');
            $table->text('lokasi_penyimpanan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
