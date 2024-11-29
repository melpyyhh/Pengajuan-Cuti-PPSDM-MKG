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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaju_id')->constrained('pegawais')->onDelete('cascade');
            $table->foreignId('penyetuju_id')->constrained('pegawais')->onDelete('cascade');
            $table->foreignId('cuti_id')->constrained('jenis_cuti')->onDelete('cascade');
            $table->string('alasan');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
