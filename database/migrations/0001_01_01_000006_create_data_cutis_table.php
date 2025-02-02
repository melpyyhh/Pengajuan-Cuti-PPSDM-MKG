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
        Schema::create('data_cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawais_id')->constrained('pegawais')->onDelete('cascade'); // Foreign Key ke pegawai
            $table->foreignId('jenis_cuti_id')->constrained('jenis_cuti')->onDelete('cascade'); // Foreign Key ke jenis_cuti
            $table->integer('sisa_cuti'); // Nama kolom diperbaiki
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_cutis');
    }
};
