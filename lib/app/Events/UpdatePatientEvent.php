<?php

namespace App\Events;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientIllness;
use App\Models\PatientModels\PatientAllergies;
use App\Models\PatientModels\PatientProphylaxis;
use App\Models\PatientModels\PatientFamilyPlanning;
use App\Models\PatientModels\PatientPartner;
use App\Models\PatientModels\PatientStatus;

class UpdatePatientEvent extends Event
{

    public $patient;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($input, $patient_id)
    {
        $this->patient = $input;
        $this->id = $patient_id;
        $this->handle();
    }
    public function handle(){
        $patient = Patient::findOrFail($this->id);
        $patient->ccc_number = $this->patient['ccc_number'];
        $patient->first_name = $this->patient['first_name'];
        $patient->last_name = $this->patient['last_name'];
        $patient->other_name = $this->patient['other_name'];
        $patient->phone_number = $this->patient['phone_number'];
        $patient->alternate_number = $this->patient['alternate_number'];
        $patient->physical_address = $this->patient['physical_address'];
        $patient->gender = $this->patient['gender'];
        $patient->birth_date = $this->patient['birth_date'];
        $patient->initial_height = $this->patient['initial_height'];
        $patient->initial_weight = $this->patient['initial_weight'];
        $patient->initial_bsa = $this->patient['initial_bsa'];
        $patient->enrollment_date = $this->patient['enrollment_date'];
        $patient->support_group = $this->patient['support_group'];
        $patient->is_pregnant = $this->patient['is_pregnant'];
        $patient->is_tb = $this->patient['is_tb'];
        $patient->is_tb_tested = $this->patient['is_tb_tested'];
        $patient->is_smoke = $this->patient['is_smoke'];
        $patient->is_alcohol = $this->patient['is_alcohol'];
        $patient->is_sms = $this->patient['is_sms'];
        $patient->service_id = $this->patient['service_id'];
        $patient->facility_id = $this->patient['facility_id'];
        $patient->supporter_id = $this->patient['supporter_id'];
        $patient->source_id = $this->patient['source_id'];
        $patient->county_sub_id = $this->patient['county_sub_id'];
        $patient->who_stage_id = $this->patient['who_stage_id'];
        if(array_key_exists('disclosure', $this->patient)){
            $patient->disclosure = $this->patient['disclosure'];
        }
        if(array_key_exists('status', $this->patient)){
            $patient->status = $this->patient['status'];
        }
        if(array_key_exists('supporter', $this->patient)){}
        $patient->save();

        
        // if(array_key_exists('source_id', $this->patient)){}
        if(array_key_exists('who_stage', $this->patient)){}
        if(array_key_exists('prophylaxis', $this->patient)){}
        if(array_key_exists('other_drug', $this->patient)){}
        if(array_key_exists('drug_allergy', $this->patient)){} 
        if(array_key_exists('drug_id', $this->patient)){}
        if(array_key_exists('drug_name', $this->patient)){}
        if(array_key_exists('allergy_name', $this->patient)){}
        if(array_key_exists('illnesses', $this->patient)){}
        if(array_key_exists('other_illnesses', $this->patient)){}
        if(array_key_exists('patient_dependant', $this->patient)){}
        if(array_key_exists('family_planning', $this->patient)){}
        if(array_key_exists('partner', $this->patient)){ // change to partner
            $patient_partner = PatientPartner::where('patient_id', $this->id)->first()->delete();
            $new_partner = new PatientPartner;
            $new_partner->patient_id = $this->id;
            $new_partner->partner_id = $this->patient['partner'];
            $new_partner->save();
        }
        if(array_key_exists('status_id', $this->patient)){
            $patient_status = PatientStatus::where('patient_id', $this->id)->first()->delete();
            $new_status = new PatientStatus;
            $new_status->patient_id = $this->id;
            $new_status->status_id = $this->patient['status_id'];
        }
        if(array_key_exists('regimen_start_date', $this->patient)){}

    }
}
