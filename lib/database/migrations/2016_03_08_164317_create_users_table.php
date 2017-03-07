<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->bigInteger('access_level_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            // fk
            $table->foreign('access_level_id')->references('id')->on('tbl_access_level');
            $table->foreign('facility_id')->references('id')->on('tbl_facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_users');
    }
}
