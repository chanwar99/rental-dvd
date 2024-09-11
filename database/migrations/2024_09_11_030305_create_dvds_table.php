<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dvds', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('judul');
            $table->string('genre');
            $table->integer('stok');
            $table->integer('tahun_rilis');
            $table->integer('harga_sewa');
            $table->string('bahasa');
            $table->string('cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dvds');
    }
};
