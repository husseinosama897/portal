<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('contract_withsubcontractor_id')->nullable();
$table->string('name')->nullable();
$table->string('unit')->nullable();
$table->float('unit_price')->nullable();
$table->float('expctedqty')->nullable();
$table->float('previous_qty')->nullable();
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
        Schema::dropIfExists('attributes_contracts');
    }
}
