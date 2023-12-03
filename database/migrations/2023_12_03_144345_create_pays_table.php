<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id('pay_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('biaya');
            $table->string('external_id');
            $table->string('description');
            $table->string('status');
            $table->string('pay_link');
            $table->timestamp('expiry_date');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('payment_id')->references('payment_id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
