<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionType extends Model
{
    use SoftDeletes; 

    protected $table = 'tbl_transaction_type';
    protected $fillable = ['name', 'effect'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function stock(){
        return $this->hasMany('App\Models\InventoryModels\Stock');
    }
    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem', 'stock_id');
    }
}
