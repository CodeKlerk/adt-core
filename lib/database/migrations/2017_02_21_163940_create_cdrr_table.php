<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdrrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cdrr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->enum('code', ['D-CDRR','F-CDRR_units','F-CDRR_packs']);
            $table->date('period_begin');
            $table->date('period_end');
            $table->string('comments');
            $table->integer('reports_expected');
            $table->integer('reports_actual');
            $table->text('service');
            $table->tinyInteger('is_non_arv');
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
        Schema::dropIfExists('tbl_cdrr');
    }
}
