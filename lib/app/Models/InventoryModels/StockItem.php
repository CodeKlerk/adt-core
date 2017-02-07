<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $table = 'tbl_stock_item';

    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id');
    }
    // shows just the drug name
    public function _drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id')->select(array('id','name', 'pack_size'));
    }
    public function stock(){
        return $this->belongsTo('App\Models\InventoryModels\Stock', 'stock_id');
    }
}
