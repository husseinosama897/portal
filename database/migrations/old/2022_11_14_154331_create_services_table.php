<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('user_id')->nullable();
$table->integer('status')->length(1)->nullable();
$table->float('total')->length(1)->nullable();
$table->float('date')->length(1)->nullable();
$table->string('subject')->nullable();
$table->string('ref')->nullable();
$table->mediumtext('content')->nullable();

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
        Schema::dropIfExists('services');
    }
}
