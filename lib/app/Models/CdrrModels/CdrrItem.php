<?php

namespace App\Models\CdrrModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CdrrItem extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_cdrr_item';
    protected $fillable = [ 'balance', 'received', 'dispensed_units', 'dispensed_packs', 
                            'losses', 'adjustments_pos', 'adjustments_neg', 'count', 'expiry_quantity', 
                            'expiry_date', 'out_of_stock', 'resupply', 'aggr_consumed', 'aggr_on_hand', 
                            'drug_id', 'cdrr_id', 'created_at', 'updated_at', 'deleted_at'
                           ];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'cdrr_id', 'drug'];
    protected $appends = array('drug_name', 'drug_unit');

    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id');
    }


    public function getDrugNameAttribute(){
        $drug_name = null;
        if($this->drug){ $drug_name = $this->drug->name; }
        return $drug_name;
    }

    public function getDrugUnitAttribute(){
        $drug_unit = null;
        if($this->drug){ $drug_unit = $this->drug->unit->name; }
        return $drug_unit;
    }
}