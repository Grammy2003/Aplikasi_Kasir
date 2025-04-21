<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('categoryID'); // Primary key, auto increment
            $table->string('nama_category'); // Nama kategori, tipe string
            $table->text('deskripsi'); // Deskripsi kategori, gunakan text jika lebih dari 255 karakter
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories'); // Menghapus tabel categories jika dibatalkan
    }
}
