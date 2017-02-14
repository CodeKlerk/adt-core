<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'tbl_stock';

    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem');
    }
}
