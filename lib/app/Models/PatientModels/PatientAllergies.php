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
    
}