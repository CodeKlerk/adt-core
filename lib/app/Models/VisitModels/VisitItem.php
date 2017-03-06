<?php

namespace App\Models\VisitModels;

use Illuminate\Database\Eloquent\Model;

class VisitItem extends Model
{
    protected $table = 'tbl_visit_item';
    protected $fillable = ['duration', 'expected_pill_count', 'actual_pill_count', 'missed_pill_count', 'comment', 'visit_id', 'stock_item_id', 'dose_id', 'indication_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $appends = array();

    public function stock_item(){
        return $this->belongsTo('App\Models\InventoryModels\StockItem');
    }
}
