<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockBalance extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_drug_stock_balance';
    protected $fillable = ['drug_id', 'stock_id', 'balance', 'stock_item_type'];
    protected $dates = ['deleted_at'];


    public function balance(){
        return $this->belongsTo('App\Models\InventoryModels\Stockitem', 'stock_item_id');
    }
}
