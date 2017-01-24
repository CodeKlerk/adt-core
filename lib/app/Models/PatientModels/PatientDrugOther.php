<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientDrugOther extends Model
{
    protected $table = 'tbl_patient_drug_other';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'name'];
    public $timestamps = false;
}
