<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_maps_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total');
            $table->bigInteger('regimen_id')->unsigned();
            $table->bigInteger('maps_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('regimen_id')->references('id')->on('tbl_regimen');
            $table->foreign('maps_id')->references('id')->on('tbl_maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_maps_item');
    }
}
