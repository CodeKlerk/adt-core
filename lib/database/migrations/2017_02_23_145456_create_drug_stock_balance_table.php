<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugStockBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_drug_stock_balance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id')->unsigned();
            $table->integer('stock_item_id')->unsigned();
            $table->integer('stock_type');
            $table->integer('balance');
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('drug_id')->references('id')->on('tbl_drug');
            $table->foreign('stock_item_id')->references('id')->on('tbl_stock_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_drug_stock_balance');
    }
}
