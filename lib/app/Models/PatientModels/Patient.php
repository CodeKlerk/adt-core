<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient';
    protected $dates = ['deleted_at'];
    protected $fillable = [ 'ccc_number', 'first_name', 'last_name',
                            'other_name', 'phone_number', 'alternate_number', 'physical_address', 'initial_regimen_id', 'initial_height',
                            'initial_weight', 'initial_bsa', 'status',
                            'gender', 'birth_date', 'enrollment_date', 'support_group', 'is_pregnant', 'is_tb', 'is_tb_tested', 
                            'is_smoke', 'is_alchohol', 'is_sms', 'service_id', 'facility_id', 'supporter_id', 'source_id', 'county_sub_id', 'who_stage_id', 'status'
                          ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'next_appointment', 'latest_visit', 'facility', 'current_status'];
    protected $appends = array('next_appointment_date', 'facility_name', 'current_status_name', 'current_status_id');
    public function service(){
        return $this->belongsTo('App\Models\ListsModels\Services', 'service_id');
    }

    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities', 'facility_id');
    }

    public function supporter(){
        return $this->belongsTo('App\Models\ListsModels\Supporter', 'supporter_id');
    }

    public function source(){
        return $this->belongsTo('App\Models\ListsModels\Sources', 'source_id');
    }

    public function who_stage(){
        return $this->belongsTo('App\Models\ListsModels\WhoStage', 'who_stage_id');
    }

    public function place_of_birth(){
        return $this->belongsTo('App\Models\ListsModels\Sub_county', 'county_sub_id');
    }

    public function prophylaxis(){
        return $this->belongsToMany('App\Models\ListsModels\Prophylaxis', 'tbl_patient_prophylaxis')->withPivot('patient_id', 'prophylaxis_id');
    }

    public function tb(){
        return $this->hasOne('App\Models\PatientModels\PatientTb', 'patient_id', 'id');
    }

    public function other_drug(){
        return $this->hasOne('App\Models\PatientModels\PatientDrugOther', 'patient_id', 'id');
    }

    public function current_status(){
        return $this->belongsToMany('App\Models\ListsModels\Status', 'tbl_patient_status')->withPivot('patient_id','status_id')->latest()->take(1);
    }

    public function drug_allergy(){
        return $this->hasMany('App\Models\PatientModels\PatientAllergies', 'patient_id', 'id');
    }

    public function other_drug_allergy(){
        return $this->hasOne('App\Models\PatientModels\PatientDrugAllergyOther');
    }


    public function patient_dependant(){
        return $this->hasMany('App\Models\PatientModels\PatientDependant', 'patient_id', 'id');
    }

    public function family_planning(){
        return $this->hasMany('App\Models\PatientModels\PatientFamilyPlanning', 'patient_id', 'id');
    }

    public function partner(){
        return $this->hasMany('App\Models\PatientModels\PatientPartner');
    }

    public function illnesses(){
        return $this->hasMany('App\Models\PatientModels\PatientIllness');
    } 

    public function other_illnesses(){
        return $this->hasOne('App\Models\PatientModels\PatientIllnessOther');
    }

    public function latest_visit(){
        return $this->hasOne('App\Models\VisitModels\Visit')->latest()->take(1);
    }
    public function first_visit(){
        return $this->hasOne('App\Models\VisitModels\Visit')->take(1);
    }
    
    public function visit(){
        return $this->hasMany('App\Models\VisitModels\Visit');
    }
    
    public function next_appointment(){
        return $this->hasOne('App\Models\VisitModels\Appointment')->latest()->take(1);
    }

    public function start_regimen(){
        return $this->belongsTo('App\Models\DrugModels\Regimen', 'initial_regimen_id');
    }


    public function getNextAppointmentDateAttribute(){
        $next_appointment_date = null;
        if($this->next_appointment){ $next_appointment_date = $this->next_appointment->appointment_date; }
        return $next_appointment_date;
    }

    public function getCurrentRegimenNameAttribute(){
        $current_regimen_name = null;
        if($this->latest_visit){ $current_regimen_name = $this->latest_visit->current_regimen->name; }
        return $current_regimen_name;
    }

    public function getFacilityNameAttribute(){
        $facility_name = null;
        if($this->facility){ $facility_name = $this->facility->name; }
        return $facility_name;
    }

    public function getCurrentStatusNameAttribute(){
        // $current_status_name = $this->current_status[0]->name;
        // if($this->current_status){ $current_status_name = $this->current_status[0]->name; }
        // return ($this->current_status);
        // $this->current_status[0]->name
        if(!$this->current_status == null){
            foreach( $this->current_status as $current_status_name){
                return $current_status_name->name;
            }
        }
    }
    public function getCurrentStatusidAttribute(){
        if(!$this->current_status == null){
            foreach( $this->current_status as $current_status_name){
                return $current_status_name->id;
            }
        }
    }

}