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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreign('kode')->references('kode')->on('dvds')->onDelete('cascade');
            $table->integer('jumlah');
            $table->string('nama_peminjam');
            $table->string('alamat_peminjam');
            $table->string('no_kontak_peminjam');
            $table->integer('lama_meminjam');
            $table->date('tanggal_meminjam');
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
