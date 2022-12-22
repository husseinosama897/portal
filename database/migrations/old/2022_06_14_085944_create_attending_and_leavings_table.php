<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendingAndLeavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attending_and_leavings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->timestamp('attending_time')->nullable();
            $table->timestamp('attending_leaving')->nullable();
            $table->string('out_of_place')->nullable();
            $table->integer('status')->length(1)->nullable();

            $table->date('absence')->nullable();
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
        Schema::dropIfExists('attending_and_leavings');
    }
}
