<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_keluar_detail', function (Blueprint $table) {

            $table->id('id_detail_bk');

            $table->unsignedBigInteger('id_barang_keluar');
            $table->unsignedBigInteger('id_barang');

            $table->integer('jumlah_keluar');

            $table->timestamps();

            $table->foreign('id_barang_keluar')
                ->references('id_barang_keluar')
                ->on('barang_keluar')
                ->onDelete('cascade');

            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('barang')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_detail');
    }
};
