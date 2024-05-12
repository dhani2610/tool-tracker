<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pemilik_barang');
            $table->integer('id-barang');
            $table->integer('id_peminjam');
            $table->time('jam_diterima');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lokasi_penggunaan');
            $table->string('lat');
            $table->string('long');
            $table->string('keterangan');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman_barangs');
    }
}
