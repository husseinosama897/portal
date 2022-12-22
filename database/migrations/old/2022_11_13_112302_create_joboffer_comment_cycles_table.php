<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobofferCommentCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joboffer_comment_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('joboffer_cycle_id')->nullable();
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
        Schema::dropIfExists('joboffer_comment_cycles');
    }
}
