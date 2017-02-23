<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimenDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_regimen_drug', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ccc_store_sp');
            $table->string('source');
            $table->integer('drug_id')->unsigned();
            $table->integer('regimen_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('drug_id')->references('id')->on('tbl_drug');
            $table->foreign('regimen_id')->references('id')->on('tbl_regimen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_regimen_drug');
    }
}
