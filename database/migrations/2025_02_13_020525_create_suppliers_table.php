<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('supplierID');  // Assuming you're using 'id' as the primary key
            $table->string('nama_supplier');  // Ensure the column name is 'nama_supplier'
            $table->string('no_tlp');
            $table->string('email_supplier');
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
        Schema::dropIfExists('suppliers'); // Hapus tabel jika migration di-rollback
    }
}
