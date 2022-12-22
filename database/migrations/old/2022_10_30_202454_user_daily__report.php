<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDailyReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_daily_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('daily_report_id')->nullable();
            $table->unsignedbiginteger('user_id')->nullable();
            $table->float('performance')->nullable();
            $table->float('commitment')->nullable();
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
        //
    }
}
