<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientAllergies extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_patient_drug_allergy'; 
    protected $fillable = ['patient_id','drug_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'drug'];
    protected $appends = array('drug_name');

    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug');
    }

    public function getDrugNameAttribute(){
        $drug_name = null;
        if($this->drug){ $drug_name = $this->drug->name; }
        return $drug_name;
    }
}