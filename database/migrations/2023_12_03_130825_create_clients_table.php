<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('nama');
            $table->unsignedBigInteger('paket_id');
            $table->text('alamat'); // Menggunakan tipe data text
            $table->unsignedBigInteger('tool_id');
            $table->unsignedBigInteger('Instalasi');
            $table->string('nomor');
            $table->string('email');
            $table->timestamps('tgl_instalasi');
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
        Schema::dropIfExists('clients');
    }
}
