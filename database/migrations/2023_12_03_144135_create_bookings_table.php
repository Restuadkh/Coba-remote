<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamp('booking_date');
            $table->integer('number_of_tickets');
            $table->unsignedBigInteger('total_price');
            $table->string('payment_status');
            $table->timestamps(); // Ini akan membuat kolom created_at dan updated_at

            // Menambahkan foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('event_id')->references('event_id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
