<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimenChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_regimen_change', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('visit_id ')->unsigned();
            $table->bigInteger('last_regimen_id')->unsigned();
            $table->bigInteger('change_reason_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('visit_id')->references('id')->on('tbl_visit');
            $table->foreign('last_regimen_id')->references('id')->on('tbl_regimen');
            $table->foreign('change_reason_id')->references('id')->on('tbl_change_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_regimen_change');
    }
}
