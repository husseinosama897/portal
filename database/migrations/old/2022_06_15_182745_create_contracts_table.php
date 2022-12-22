<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

        
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
$table->integer('vacations')->nullable();
$table->integer('weekly_vacation')->nullable();
$table->unsignedBigInteger('project_id')->unsigned()->nullable();
$table->date('contract_date')->nullable();
$table->date('contract_ex')->nullable();
$table->integer('contract_type')->length(1)->nullable();
$table->float('working_hours')->length(1,2)->nullable();

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
        Schema::dropIfExists('contracts');
    }
}
