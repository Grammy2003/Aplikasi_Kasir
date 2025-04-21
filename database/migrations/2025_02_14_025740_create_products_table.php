<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('produkID');
            $table->bigInteger('categoryID')->unsigned();
            $table->bigInteger('satuanID')->unsigned();
            $table->string('nama_produk');
            $table->string('harga');
            $table->string('stok');
            $table->bigInteger('supplierID')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
