<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_visit_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('duration');
            $table->integer('expected_pill_count');
            $table->integer('actual_pill_count');
            $table->integer('missed_pill_count');
            $table->integer('non_adherence_reason_id');
            $table->text('comment');
            $table->bigInteger('visit_id')->unsigned();
            $table->bigInteger('stock_item_id')->unsigned();
            $table->bigInteger('dose_id')->unsigned();
            $table->bigInteger('indication_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // fk
            $table->foreign('visit_id')->references('id')->on('tbl_visit');
            $table->foreign('stock_item_id')->references('id')->on('tbl_stock_item');
            $table->foreign('dose_id')->references('id')->on('tbl_dose');
            $table->foreign('indication_id')->references('id')->on('tbl_indication');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_visit_item');
    }
}
