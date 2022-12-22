<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractWithsubcontractorAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_withsubcontractor_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('contract_withsubcontractor_id')->nullable();
            $table->string('path')->nullable();
            
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
        Schema::dropIfExists('contract_withsubcontractor_attachments');
    }
}
