<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdrrItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cdrr_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('balance');
            $table->integer('received');
            $table->integer('dispensed_units');
            $table->integer('dispensed_packs');
            $table->integer('losses');
            $table->integer('adjustments_pos');
            $table->integer('adjustments_neg');
            $table->integer('count');
            $table->integer('expiry_quantity');
            $table->integer('out_of_stock');
            $table->integer('resupply');
            $table->integer('aggr_consumed');
            $table->integer('aggr_on_hand');
            $table->date('expiry_date');
            $table->bigInteger('drug_id')->unsigned();
            $table->bigInteger('cdrr_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk

            $table->foreign('drug_id')->references('id')->on('tbl_drug');
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
        Schema::dropIfExists('tbl_cdrr_item');
    }
}
