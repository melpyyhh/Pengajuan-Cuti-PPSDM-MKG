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
        Schema::create('pegawai_cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawais_id')->constrained()->onDelete('cascade'); // Foreign Key ke pegawai
            $table->foreignId('jenis_cuti_id')->constrained()->onDelete('cascade'); // Foreign Key ke jenis_cuti
            $table->integer('jumlah_cuti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_cuti');
    }
};
