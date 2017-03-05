<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('transaction_time');
            $table->text('transaction_detail');
            $table->string('ref_number');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('facility_id')->unsigned();
            $table->bigInteger('transaction_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // fk
            $table->foreign('user_id')->references('id')->on('tbl_users');
            $table->foreign('store_id')->references('id')->on('tbl_store');
            $table->foreign('facility_id')->references('id')->on('tbl_facility');
            $table->foreign('transaction_type_id')->references('id')->on('tbl_transaction_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_stock');
    }
}
