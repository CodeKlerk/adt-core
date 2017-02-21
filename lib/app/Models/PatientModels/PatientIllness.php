<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientIllness extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_patient_illness';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'illness_id'];
    public $timestamps = false;
}
