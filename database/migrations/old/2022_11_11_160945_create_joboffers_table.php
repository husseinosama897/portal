<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoboffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joboffers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('subject')->nullable();
            $table->mediumtext('content')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('work_location')->nullable();
            $table->float('salary')->nullable();
            
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
        Schema::dropIfExists('joboffers');
    }
}
