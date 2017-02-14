<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'tbl_transaction_type';

    public function stock(){
        return $this->hasMany('App\Models\InventoryModels\Stock');
    }
    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem', 'stock_id');
    }
}
