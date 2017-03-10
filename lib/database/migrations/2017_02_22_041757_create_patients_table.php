<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ccc_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name');
            $table->string('phone_number');
            $table->string('alternate_number');
            $table->text('physical_address');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->float('initial_height');
            $table->float('initial_weight');
            $table->float('initial_bsa');
            $table->date('enrollment_date');
            $table->text('support_group');
            $table->enum('status', ['no partner','concordant','discordunt']);
            $table->tinyInteger('disclosure');
            $table->tinyInteger('is_pregnant');
            $table->tinyInteger('is_tb');
            $table->tinyInteger('is_tb_tested');
            $table->tinyInteger('is_smoke');
            $table->tinyInteger('is_alcohol');
            $table->tinyInteger('is_sms');
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('supporter_id')->unsigned();
            $table->bigInteger('source_id')->unsigned();
            $table->bigInteger('county_sub_id')->unsigned();
            $table->bigInteger('who_stage_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('service_id')->references('id')->on('tbl_service');
            $table->foreign('facility_id')->references('id')->on('tbl_facility');
            $table->foreign('supporter_id')->references('id')->on('tbl_supporter');
            $table->foreign('source_id')->references('id')->on('tbl_source');
            $table->foreign('county_sub_id')->references('id')->on('tbl_county_sub');
            $table->foreign('who_stage_id')->references('id')->on('tbl_who_stage');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_patient');
    }
}
