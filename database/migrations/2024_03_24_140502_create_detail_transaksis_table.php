<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user_merchant')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->foreignId('id_transaksi')->references('id')->on('transaksis')->onDelete('cascade');
            $table->decimal('harga_jual', 8, 2);
            $table->integer('qty');
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
        Schema::dropIfExists('detail_transaksis');
    }
}
