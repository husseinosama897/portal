<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentContractWithsubcontractorCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_contract_withsubcontractor_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('contract_withsubcontractor_cycle_id')->nullable();
            $table->string('content')->nullable();
            $table->unsignedbiginteger('user_id')->nullable();
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
        Schema::dropIfExists('comment_contract_withsubcontractor_cycles');
    }
}
