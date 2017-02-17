<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientIllnessOther extends Model
{
    protected $table = 'tbl_patient_illness_other';
    protected $dates = ['deleted_at'];
    // protected $fillable = ['patient_id', 'illness_id'];
    public $timestamps = false;
}
