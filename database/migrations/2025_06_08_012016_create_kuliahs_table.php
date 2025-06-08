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
        Schema::create('kuliah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biodata_id')->constrained('biodata')->onDelete('cascade');
            $table->string('nama_kampus');
            $table->string('jurusan');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuliahs');
    }
};
