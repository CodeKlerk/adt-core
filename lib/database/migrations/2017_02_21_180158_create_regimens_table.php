<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_regimen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            // fk
            $table->foreign('service_id')->references('id')->on('tbl_service');
            $table->foreign('category_id')->references('id')->on('tbl_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_regimen');
    }
}
