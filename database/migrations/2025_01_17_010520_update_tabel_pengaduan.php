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
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->renameColumn('status_ajuan', 'status_pengaduan');
            $table->text('reply')->nullable();
            $table->text('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->renameColumn('status_pengaduan', 'status_ajuan');
            $table->dropColumn('reply');
            $table->dropColumn('title');
        });
    }
};
