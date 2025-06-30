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
        Schema::create('penilaian_opsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_tipe_id')->constrained()->cascadeOnDelete();
            $table->string('label'); // e.g. "Sangat Sering"
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_opsis');
    }
};
