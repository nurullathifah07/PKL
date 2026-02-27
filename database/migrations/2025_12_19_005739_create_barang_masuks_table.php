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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_barang_masuk');

            // relasi ke barang
            $table->unsignedBigInteger('id_barang');

            $table->string('no_bon')->nullable();
            $table->date('tanggal_pembelian');
            $table->integer('jumlah_barang')->unsigned();
            $table->bigInteger('harga_satuan');
            $table->bigInteger('total_harga');

            $table->timestamps();

            //foreign key
            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('barang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
