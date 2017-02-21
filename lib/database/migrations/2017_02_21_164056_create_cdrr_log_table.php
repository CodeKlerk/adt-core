<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdrrLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cdrr_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->integer('cdrr_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk

            $table->foreign('user_id')->references('id')->on('tbl_users');
            $table->foreign('cdrr_id')->references('id')->on('tbl_cdrr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cdrr_log');
    }
}
