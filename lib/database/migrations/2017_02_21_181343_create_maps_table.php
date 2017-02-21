<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->enum('code', ['D-MAPS','F-MAPS']);
            $table->date('period_begin');
            $table->date('period_end');
            $table->integer('reports_expected');
            $table->integer('reports_actual');
            $table->text('services');
            $table->text('comments');
            $table->integer('facility_id')->unsigned();
            $table->integer('supporter_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('facility_id')->references('id')->on('tbl_facility');
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
        Schema::dropIfExists('tbl_maps');
    }
}
