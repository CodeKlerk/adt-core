<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->date('appointment_date');
            $table->integer('patient_id')->unsigned();
            $table->integer('facility_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->integer('patient_id')->unsigned();
            $table->integer('facility_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_appointment');
    }
}
