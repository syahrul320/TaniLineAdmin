<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('id_user_pembeli')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('biaya_admin');
            $table->integer('total_biaya');
            $table->date('tgl_transaksi');
            $table->enum('status_transaksi', ['batal', 'diterima', 'diproses','selesai']);
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
        Schema::dropIfExists('transaksis');
    }
}
