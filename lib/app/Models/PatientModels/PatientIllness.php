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
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'illness'];
    protected $appends = array('illness_name');

    public function illness(){
        return $this->belongsTo('App\Models\ListsModels\Illnesses');
    }

    public function getIllnessNameAttribute(){
        $illness_name = null;
        if($this->illness){ $illness_name = $this->illness->name; }
        return $illness_name;
    }

}
