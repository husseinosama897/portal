<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyProductivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_productivities', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('daily_report_id')->nullable();
            $table->string('item')->nullable();
            $table->string('unit')->nullable();
            $table->float('quantity')->nullable();
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
        Schema::dropIfExists('daily_productivities');
    }
}
