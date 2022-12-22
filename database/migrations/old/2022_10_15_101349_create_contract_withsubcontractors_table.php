<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractWithsubcontractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_withsubcontractors', function (Blueprint $table) {
            $table->id();
            
            $table->string('ref')->nullable();
            
            $table->unsignedBigInteger('contractor_id')->nullable();

            $table->date('date')->nullable();



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
        Schema::dropIfExists('contract_withsubcontractors');
    }
}
