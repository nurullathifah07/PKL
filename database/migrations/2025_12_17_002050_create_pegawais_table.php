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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');

            // relasi ke akun
            $table->unsignedBigInteger('id_akun');

            $table->enum('status_pegawai',['PNS','Non PNS']);
            $table->string('nip_bps')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->string('subbagian')->nullable();
            $table->string('golongan_akhir');
            $table->string('pendidikan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');

            $table->string('foto')->nullable();

            $table->timestamps();

            // foreign key
            $table->foreign('id_akun')
                ->references('id_akun')
                ->on('akun')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
