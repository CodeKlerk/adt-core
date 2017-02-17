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

    public function visit_item(){
        return $this->hasMany('App\Models\VisitModels\VisitItem');
        // return $this->hasMany('App\Models\VisitModels\VisitItem')->select(array('id','visit_id'));
    }
    public function current_regimen(){
        return $this->belongsTo('App\Models\RegimenModels\Regimen', 'current_regimen_id');
    }
    public function appointment(){
        return $this->belongsTo('App\Models\VisitModels\Appointment', 'appointment_id');
    }
}