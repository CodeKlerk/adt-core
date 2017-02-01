<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_drug';
    protected $fillable = ['name', 'pack_size', 'duration', 'quantity', 'is_arv', 'is_tb', 'deleted_at', 'unit_id', 'dose_id', 'generic_id', 'supporter_id'];
    protected $dates = ['deleted_at'];

    public function generic(){
        return $this->belongsTo('App\Models\ListsModels\Generic', 'generic_id');
    }

    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem', 'drug_id');
    }
    public function unit(){
        return $this->belongsTo('App\Models\ListsModels\Unit', 'unit_id');
    }

}