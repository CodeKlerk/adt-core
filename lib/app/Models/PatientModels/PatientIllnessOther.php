<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientIllnessOther extends Model
{
    protected $table = 'tbl_patient_illness_other';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'other_illness'];
    public $timestamps = false;
}
