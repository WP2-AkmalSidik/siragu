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
        Schema::create('penilaian_tipes', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // e.g. "Skala Sering", "Ya/Tidak", "Angka Bebas", "Teks Bebas"
            $table->string('tipe_input');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_tipes');
    }
};
