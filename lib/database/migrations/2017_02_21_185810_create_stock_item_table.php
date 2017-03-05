<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stock_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch_number');
            $table->date('expiry_date');
            $table->integer('quantity_in');
            $table->integer('quantity_out');
            $table->integer('quantity_packs');
            $table->integer('balance_before');
            $table->integer('balance_after');
            $table->double('unit_cost');
            $table->double('total_cost');
            $table->text('comment');
            $table->bigInteger('drug_id')->unsigned();
            $table->bigInteger('stock_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk
            $table->foreign('drug_id')->references('id')->on('tbl_drug');
            $table->foreign('stock_id')->references('id')->on('tbl_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stock_item');
    }
}
