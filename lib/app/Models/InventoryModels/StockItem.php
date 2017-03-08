<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockItem extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_stock_item';
    protected $fillable = [ 'batch_number', 'expiry_date', 'quantity_in', 'quantity_out', 'quantity_packs', 
                            'balance_before', 'balance_after', 'unit_cost', 'comment', 'drug_id', 'stock'
                          ];
                          
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'drug'];
    protected $appends = array('drug_name');

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

    public function balance(){
        return $this->hasOne('App\Models\InventoryModels\StockBalance', 'stock_item_id');
    }

    public function getDrugNameAttribute(){
        $drug_name = null;
        if($this->drug){ $drug_name = $this->drug->name; }
        return $drug_name;
    }
} 