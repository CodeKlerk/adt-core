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
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = array('family_plan_name');

    public function familyplan(){
        return $this->belongsTo('App\Models\ListsModels\Familyplanning', 'family_planning_id');
    }

    public function getFamilyPlanNameAttribute(){
        $family_plan_name = null;
        if($this->familyplan){ $family_plan_name = $this->familyplan->name; }
        return $family_plan_name;
    }
}
