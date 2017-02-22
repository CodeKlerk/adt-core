<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientFamilyPlanning extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_patient_family_planning';
    protected $fillable = ['patient_id', 'family_planning_id'];
    protected $dates = ['deleted_at'];
}
