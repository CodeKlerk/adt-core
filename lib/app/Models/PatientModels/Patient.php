<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient';
    protected $dates = ['deleted_at'];
    protected $fillable = ['ccc_number', 'first_name', 'last_name',
     'other_name', 'phone_number', 'alternate_number', 'physical_address', 'initial_regimen_id', 
     'gender', 'birth_date', 'enrollment_date', 'support_group', 'is_pregnant', 'is_tb', 'is_tb_tested', 
     'is_smoke', 'is_alchohol', 'is_sms', 'service_id', 'facility_id', 'supporter_id', 'source_id', 'county_sub_id', 'who_stage_id', 'status'];

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
        return $this->hasMany('App\Models\PatientModels\PatientProphylaxis', 'patient_id', 'id');
    }

    public function tb(){
        return $this->hasOne('App\Models\PatientModels\PatientTb', 'patient_id', 'id');
    }

    public function other_drug(){
        return $this->hasMany('App\Models\PatientModels\PatientDrugOther', 'patient_id', 'id');
    }

    public function current_status(){
        return $this->hasMany('App\Models\PatientModels\PatientStatus', 'patient_id', 'id')->latest()->take(1);
    }

    public function drug_allergy(){
        return $this->hasMany('App\Models\PatientModels\PatientAllergies', 'patient_id', 'id');
    }

    public function other_drug_allergy(){
        return $this->hasMany('App\Models\PatientModels\PatientDrugAllergyOther');
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

    public function visit(){
        return $this->hasMany('App\Models\VisitModels\Visit')->latest()->take(1);
    }
    public function next_appointment(){
        return $this->hasMany('App\Models\VisitModels\Appointment')->latest()->take(1);
    }

    public function start_regimen(){
        return $this->belongsTo('App\Models\RegimenModels\Regimen', 'initial_regimen_id');
    }
}