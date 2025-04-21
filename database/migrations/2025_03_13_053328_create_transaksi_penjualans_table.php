
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID'); // Primary Key
            $table->unsignedBigInteger('PelangganID')->nullable();
            $table->date('TglPenjualan');
            $table->string('TotalHarga');
            $table->string('UangBayar');
            $table->string('Kembali');
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
        Schema::dropIfExists('transaksi_penjualans');
    }
}
