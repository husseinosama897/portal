<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serivce_id')->nullable();
        $table->string('item')->nullable();
        $table->float('amount')->nullable();
        $table->float('percentage')->nullable();
$table->float('employee_cost')->nullable();
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
        Schema::dropIfExists('service_attributes');
    }
}
