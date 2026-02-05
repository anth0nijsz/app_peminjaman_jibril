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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->integer('jumlah_dikembalikan');
            $table->enum('kondisi_alat', ['baik', 'rusak', 'hilang'])->default('baik');
            $table->text('catatan_kondisi')->nullable();
            $table->enum('status', ['belum_dikonfirmasi', 'dikonfirmasi'])->default('belum_dikonfirmasi');
            $table->foreignId('dikonfirmasi_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->text('catatan_operator')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
