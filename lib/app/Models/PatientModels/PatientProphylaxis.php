<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientProphylaxis extends Model
{
    protected $table = 'tbl_patient_prophylaxis'; 

    public function prophylaxis(){
        return $this->belongsTo('App\Models\ListsModels\Prophylaxis');
    }
}