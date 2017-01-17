<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'tbl_visit';
    protected $fillable = ['current_height', 'current_weight', 'visit_date', 'appointment_adherence', 'is_active', 'patient_id', 'facility_id', 'user_id', 'purpose_id', 'last_regimen_id', 'current_regimen_id', 'change_reason_id', 'non_adherence_reason_id', 'appointment_id'];
    public $timestamps  = false;
    /**
    * function name: patient,
    * Links the tbl_visit table to the tbl_patient
    * Used to retrive the facility information on a particular Patient
    */
    public function patient(){
        return $this->belongsTo('App\Models\Patients\patient', 'id', 'patient_id');
    }

    /**
    * function name: facility,
    * Links the tbl_visit table to the tbl_facility
    * Used to retrive the facility information on a particular Patient
    */
    public function facility(){
        return $this->belongsTo('App\Models\Patients\Facility', 'id', 'facility_id');
    }

    /**
    * function name: purpose,
    * Links the tbl_visit table to the tbl_purpose
    * Used to retrive the purpose information on a particular Patient
    */
    public function purpose(){
        return $this->belongsTo('App\Purpose', 'id', 'purpose_id');
    }

    /**
    * function name: non_adherence_reason,
    * Links the tbl_visit table to the tbl_on_adherence_reason
    * Used to retrive the Non_adherence_reason information on a particular patient
    */
    public function non_adherence_reason(){
        return $this->belongsTo('App\Non_adherence_reason', 'id', 'non_adherence_reason_id');
    }    

    public function visit_item(){
        // return $this->hasMany('App')
    }
    public function last_regimen(){
        return $this->belongsTo('App\Models\Patients\Regimen');
    }
}
