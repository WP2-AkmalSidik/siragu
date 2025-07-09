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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_penilaian_id')->constrained()->onDelete('cascade');
            $table->foreignId('pengisi_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('target_id')->constrained('users')->onDelete('cascade');
            $table->string('nilai');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->unique(
                ['form_penilaian_id', 'pengisi_id', 'target_id', 'tahun_ajaran', 'semester'],
                'nilai_unik_periode_idx'
            ); $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
