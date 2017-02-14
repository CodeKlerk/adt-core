<?php

namespace App\Events;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientIllness;
use App\Models\PatientModels\PatientAllergies;
use App\Models\PatientModels\PatientProphylaxis;
use App\Models\PatientModels\PatientFamilyPlanning;
use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
class CreatePatientEvent extends Event
{

    public $patient;
    public $ilnesses;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->patient = $input;
        $this->handle();
    }
    public function handle(){
        $created_patient = Patient::create($this->patient);
        if($created_patient){
            $new_patient_id['patient_id'] = $created_patient->id;
            $merged_request_and_new_id = array_merge($this->patient, $new_patient_id);
            $this->multi_model_insert(['PatientDrugAllergyOther', 'PatientDrugOther', 'PatientStatus', 'PatientTb'], $merged_request_and_new_id);
            
            //check if illnesses exists in the array
            if(array_key_exists('illnesses', $this->patient)){
                // Looping through illness
                $illnesses = $this->patient['illnesses'];

                foreach($illnesses as $illness){
                $pi = new PatientIllness;
                $pi->patient_id = $new_patient_id['patient_id'];
                $pi->illness_id = $illness;
                $pi->save(); 
                }
            }

            //check if allergies exists in the array
            if(array_key_exists('allergies', $this->patient)){
                // Looping through drug allergies
                $drug_allergies = $this->patient['allergies'];

                foreach($drug_allergies as $allergy){
                    $da = new PatientAllergies;
                    $da->patient_id = $new_patient_id['patient_id'];
                    $da->drug_id = $allergy;
                    $da->save();
                }
            }

            //check if prophylaxis exists in the array
            if(array_key_exists('prophylaxis', $this->patient)){

                // Looping through prophylaxis
                $prophylaxis = $this->patient['prophylaxis'];

                foreach($prophylaxis as $proph){
                    $da = new PatientProphylaxis;
                    $da->patient_id = $new_patient_id['patient_id'];
                    $da->prophylaxis_id = $proph;
                    $da->save();
                }
            }

            //check if family_planning exists in the array
            if(array_key_exists('family_planning', $this->patient)){
                // Looping through family planning
                $family_plans = $this->patient['family_planning'];

                foreach($family_plans as $family_plan){
                    $pfp = new PatientFamilyPlanning;
                    $pfp->patient_id = $new_patient_id['patient_id'];
                    $pfp->family_planning_id = $family_plan;
                    $pfp->save();
                }
            }

            $this->appointment_insert($merged_request_and_new_id);

        }
    }

    public function appointment_insert($data){
        $first_appointment = new Appointment;
        $first_appointment->appointment_date = $data['start_regimen_date'];
        $first_appointment->is_appointment = 1;
        $first_appointment->patient_id = $data['patient_id'];
        $first_appointment->facility_id = $data['facility_id'];
        if($first_appointment->save()){
            $appointment_id = $first_appointment->id;
            $this->visit_insert($appointment_id, $data);
        }
    }

    public function visit_insert($appointment_id, $data){
        $first_visit = Visit::create([
            'current_height' => $data['initial_weight'],
            'current_weight' => $data['initial_height'],
            'visit_date' => $data['start_regimen_date'],
            'appointment_adherence' => 100,
            'patient_id' => $data['patient_id'],
            'facility_id' => $data['facility_id'],
            'user_id' => $data['user_id'],
            'purpose_id' => $data['purpose_id'],
            'current_regimen_id' => $data['regimen_id'],
            'appointment_id' => $appointment_id
        ]);
    }

    public function multi_model_insert(array $models, $data) {
        foreach ($models as $model) {
            $model = "\\App\Models\PatientModels\\".$model;
            $modelclass = new $model;
            $modelclass->create($data);
        }
    }

}
