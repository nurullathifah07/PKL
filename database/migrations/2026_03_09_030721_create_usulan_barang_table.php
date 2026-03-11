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
        Schema::create('usulan_barang', function (Blueprint $table) {
            $table->id('id_usulan_barang');
            $table->string('nama_barang_usulan');
            $table->integer('jumlah_usulan');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('id_pegawai');
            $table->enum('status', ['pending','disetujui','ditolak'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_barang');
    }
};
