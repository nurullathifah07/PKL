<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('id_barang_keluar');

            // relasi pemohon
            $table->unsignedBigInteger('id_pegawai');

            $table->date('tanggal_keluar');
            $table->string('keterangan')->nullable();
        
            $table->timestamps();

            $table->foreign('id_pegawai')
                ->references('id_pegawai')
                ->on('pegawai')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
