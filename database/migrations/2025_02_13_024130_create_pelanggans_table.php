<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('PelangganID'); // bigint primary key auto-increment
            $table->string('namapelanggan', 255); // varchar
            $table->text('alamat'); // text
            $table->string('no_tlp', 20); // varchar dengan panjang maksimum 20 karakter
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // enum
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
