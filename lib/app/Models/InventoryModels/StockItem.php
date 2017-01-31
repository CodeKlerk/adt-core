<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $table = 'tbl_stock_item';

    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id');
    }
}
