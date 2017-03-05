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
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'generic_id', 'generic', 'unit_id', 'unit', 'supporter_id', 'supporter', 'dose_id', 'dose'];
    protected $appends = array('drug_generic', 'drug_unit', 'drug_dose', 'drug_supporter');

    public function generic(){
        return $this->belongsTo('App\Models\ListsModels\Generic', 'generic_id');
    }

    public function stock_item(){
        return $this->hasMany('App\Models\InventoryModels\StockItem', 'drug_id');
    }
    public function unit(){
        return $this->belongsTo('App\Models\ListsModels\Unit', 'unit_id');
    }
    public function dose(){
        return $this->belongsTo('App\Models\ListsModels\Dose', 'dose_id');
    }
    public function supporter(){
        return $this->belongsTo('App\Models\ListsModels\Supporter', 'supporter_id');
    }

    public function getDrugGenericAttribute(){
        $drug_generic = null;
        if($this->generic){ $drug_generic = $this->generic->name; }
        return $drug_generic;
    }
    public function getDrugUnitAttribute(){
        $drug_unit = null;
        if($this->unit){ $drug_unit = $this->unit->name; }
        return $drug_unit;
    }
    public function getDrugDoseAttribute(){
        $drug_dose = null;
        if($this->dose){ $drug_dose = $this->dose->name; }
        return $drug_dose;
    }
    public function getDrugSupporterAttribute(){
        $drug_supporter = null;
        if($this->supporter){ $drug_supporter = $this->supporter->name; }
        return $drug_supporter;
    }

}