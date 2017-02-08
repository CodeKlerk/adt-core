<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class StockBalance extends Model
{
    protected $table = 'tbl_drug_stock_balance';

    public function balance(){
        return $this->belongsTo('App\Models\InventoryModels\Stockitem', 'stock_item_id');
    }
}
