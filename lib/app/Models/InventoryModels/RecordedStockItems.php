<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;

class RecordedStockItems extends Model
{
    protected $table = 'v_recodered_stock_items';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'drug'];
    protected $appends = array('drug_name');
    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id');
    }

    public function getDrugNameAttribute(){
        $drug_name = null;
        if($this->drug){ $drug_name = $this->drug->name; }
        return $drug_name;
    }
}