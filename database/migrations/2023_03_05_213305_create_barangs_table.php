<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('tipe');
            $table->string('no_seri');
            $table->integer('tahun_pembelian');
            $table->string('unit_pemilik');
            $table->string('kelengkapan');
            $table->string('dokumen');
            $table->string('foto_alat');
            $table->string('foto_kelengkapan_alat');
            $table->string('kondisi_alat');
            $table->string('tanggal_statement');
            $table->string('approve_admin')->nullable();
            $table->integer('status_peminjaman')->nullable();
            $table->integer('id_pemilik_barang');
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
        Schema::dropIfExists('barangs');
    }
}
