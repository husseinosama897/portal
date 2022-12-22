<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerivceCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_cycles', function (Blueprint $table) {
            $table->id();
            $table->integer('step')->nullable();
            $table->integer('status')->nullable();
     $table->unsignedBiginteger('flowwork_step_id')->nullable();
        $table->unsignedBiginteger('role_id')->nullable();
$table->unsignedBiginteger('service_id')->nullable();
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
        Schema::dropIfExists('service_cycles');
    }
}
