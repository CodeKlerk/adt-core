<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_stock';
    protected $fillable = ['transaction_time', 'transaction_detail', 'ref_number', 'user_id', 'store_id', 'facility_id', 'transaction_type_id'];
    protected $hidden = ['updated_at', 'deleted_at'];
    
    
    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem');
    }
}
 