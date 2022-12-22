<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('project_id')->nullable();
            $table->date('date')->nullable();
            $table->string('The_scope_of_work')->nullable();
            $table->unsignedbiginteger('supervisor_id')->nullable();
            $table->string('workplace')->nullable();
           $table->integer('number_of_staff')->nullable(); 
            
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
        Schema::dropIfExists('daily_reports');
    }
}
