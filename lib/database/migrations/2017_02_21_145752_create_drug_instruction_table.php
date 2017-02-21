<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugInstructionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_drug_instruction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id')->unsigned();
            $table->integer('instruction_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk
            $table->foreign('drug_id')->references('id')->on('tbl_drug');
            $table->foreign('instruction_id')->references('id')->on('tbl_instruction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_drug_instruction');
    }
}
