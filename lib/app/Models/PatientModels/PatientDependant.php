<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientDependant extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient_dependant'; 
    protected $fillable = ['patient_id', 'dependant_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    // protected $appends = array('dependant_ccc_number');  

    public function dependant(){
        return $this->hasMany('App\Models\PatientModels\Patient', 'id', 'dependant_id');
    }

    // public function getDependantCccNumberAttribute(){
    //     $dependant_ccc_number = null;
    //     if($this->dependant){ $dependant_ccc_number = $this->dependant->ccc_number;  }
    //     return $dependant_ccc_number;
    // }

}