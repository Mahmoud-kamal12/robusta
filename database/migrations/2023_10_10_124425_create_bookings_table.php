<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('start_station_id');
            $table->unsignedInteger('start_station_order');

            $table->unsignedBigInteger('end_station_id');
            $table->unsignedInteger('end_station_order');

            $table->unsignedBigInteger('trip_id');
            $table->unsignedInteger('seat_number');

            $table->foreign('start_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('end_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('bookings');
    }
};
