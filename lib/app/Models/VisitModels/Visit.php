<?php

namespace App\Models\VisitModels;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'tbl_visit';
    protected $fillable = [ 'current_height', 'current_weight', 'visit_date', 
                            'appointment_adherence', 'patient_id', 'facility_id', 'user_id', 'purpose_id', 
                            'last_regimen_id', 'current_regimen_id', 'change_reason_id', 'non_adherence_reason_id', 
                            'appointment_id'
                            ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'facility', 'purpose'];

    protected $appends = array('facility_name', 'purpose_name');

    public function visit_item(){
        return $this->hasMany('App\Models\VisitModels\VisitItem');
    }
    
    public function current_regimen(){
        return $this->belongsTo('App\Models\RegimenModels\Regimen', 'current_regimen_id');
    }
    public function appointment(){
        return $this->belongsTo('App\Models\VisitModels\Appointment', 'appointment_id');
    }

    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities', 'facility_id');
    }

    public function purpose(){
        return $this->belongsTo('App\Models\ListsModels\Purpose', 'purpose_id');
    }

    public function regimen_change(){
        return $this->hasMany('App\Models\DrugModels\RegimenChange', 'visit_id');
    }



    public function getFacilityNameAttribute(){
        $faciltiy_name = null;
        if($this->facility){ $faciltiy_name = $this->facility->name; }
        return $faciltiy_name;
    }
    public function getPurposeNameAttribute(){
        $purpose_name = null;
        if($this->purpose){ $purpose_name = $this->purpose->name; }
        return $purpose_name;
    }
}