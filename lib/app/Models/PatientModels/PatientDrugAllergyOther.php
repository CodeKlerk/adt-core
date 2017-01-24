<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientDrugAllergyOther extends Model
{
    protected $table = 'tbl_patient_drug_allergy_other';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'allergy_name'];
    public $timestamps = false;
}
