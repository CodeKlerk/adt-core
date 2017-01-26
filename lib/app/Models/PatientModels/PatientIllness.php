<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientIllness extends Model
{
    protected $table = 'tbl_patient_illness';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'illness_id'];
    public $timestamps = false;
}
