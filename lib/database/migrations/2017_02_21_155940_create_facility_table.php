<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_facility', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('postal_address');
            $table->string('email_address');
            $table->string('phone_number');
            $table->integer('adult_age');
            $table->text('service');
            $table->integer('weekend_max');
            $table->integer('weekday_max');
            $table->tinyInteger('is_sms');
            $table->integer('county_sub_id')->unsigned();
            $table->integer('supporter_id')->unsigned();
            $table->integer('facility_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('county_sub_id')->references('id')->on('tbl_county_sub');
            $table->foreign('supporter_id')->references('id')->on('tbl_supporter');
            $table->foreign('facility_type_id')->references('id')->on('tbl_facility_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_facility');
    }
}
