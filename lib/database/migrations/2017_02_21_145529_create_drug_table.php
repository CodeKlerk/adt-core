<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_drug', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('pack_size');
            $table->integer('duration');
            $table->integer('quantity');
            $table->tinyInteger('is_arv');
            $table->tinyInteger('is_tb');
            $table->tinyInteger('is_oi');
            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('dose_id')->unsigned();
            $table->bigInteger('generic_id')->unsigned();
            $table->bigInteger('supporter_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk
            $table->foreign('unit_id')->references('id')->on('tbl_unit');
            $table->foreign('dose_id')->references('id')->on('tbl_dose');
            $table->foreign('generic_id')->references('id')->on('tbl_generic');
            $table->foreign('supporter_id')->references('id')->on('tbl_supporter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_drug');
    }
}
