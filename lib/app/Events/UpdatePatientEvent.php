<?php

namespace App\Events;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientIllness;
use App\Models\PatientModels\PatientAllergies;
use App\Models\PatientModels\PatientProphylaxis;
use App\Models\PatientModels\PatientFamilyPlanning;
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
        $patient->update([
            'ccc_number' => $this->patient['ccc_number'],
            'first_name' => $this->patient['first_name'],
            'last_name' => $this->patient['last_name'],
            'other_name' => $this->patient['other_name'],
            'phone_number' => $this->patient['phone_number'],
            'alternate_number' => $this->patient['alternate_number'],
            'physical_address' => $this->patient['physical_address'],
            'gender' => $this->patient['gender'],
            'birth_date' => $this->patient['birth_date'],
            'enrollment_date' => $this->patient['enrollment_date'],
            'support_group' => $this->patient['support_group'],
            'is_pregnant' => $this->patient['is_pregnant'],
            'is_tb' => $this->patient['is_tb'],
            'is_tb_tested' => $this->patient['is_tb_tested'],
            'is_smoke' => $this->patient['is_smoke'],
            'is_alcohol' => $this->patient['is_alcohol'],
            'is_sms' => $this->patient['is_sms'],
            'service_id' => $this->patient['service_id'],
            'facility_id' => $this->patient['facility_id'],
            'supporter_id' => $this->patient['supporter_id'],
            'source_id' => $this->patient['source_id'],
            'county_sub_id' => $this->patient['county_sub_id'],
            'who_stage_id' => $this->patient['who_stage_id'],
            'status' => $this->patient['status']
        ]);
    }
}
