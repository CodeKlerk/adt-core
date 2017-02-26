<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_visit', function (Blueprint $table) {
            $table->increments('id');
            $table->float('current_height');
            $table->float('current_weight');
            $table->float('current_bsa');
            $table->float('appointment_adherence');
            $table->date('visit_date');
            $table->integer('patient_id')->unsigned();
            $table->integer('facility_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('purpose_id')->unsigned();
            $table->integer('current_regimen_id')->unsigned();
            $table->integer('appointment_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('patient_id')->references('id')->on('tbl_patient');
            $table->foreign('facility_id')->references('id')->on('tbl_facility');
            $table->foreign('user_id')->references('id')->on('tbl_users');
            $table->foreign('purpose_id')->references('id')->on('tbl_purpose');
            $table->foreign('current_regimen_id')->references('id')->on('tbl_regimen');
            $table->foreign('appointment_id')->references('id')->on('tbl_appointment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_visit');
    }
}
