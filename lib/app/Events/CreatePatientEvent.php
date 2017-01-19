<?php

namespace App\Events;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientIllness;
use App\Models\PatientModels\PatientAllergies;
use App\Models\PatientModels\PatientProphylaxis;
use App\Models\PatientModels\PatientFamilyPlanning;
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
            

            // Looping through illness
            $illnesses = $this->patient['illnesses'];

            foreach($illnesses as $illness){
               $pi = new PatientIllness;
               $pi->patient_id = $new_patient_id['patient_id'];
               $pi->illness_id = $illness;
               $pi->save(); 
            }

            // Looping through drug allergies
            $drug_allergies = $this->patient['allergies'];

            foreach($drug_allergies as $allergy){
                $da = new PatientAllergies;
                $da->patient_id = $new_patient_id['patient_id'];
                $da->drug_id = $allergy;
                $da->save();
            }

            // Looping through prophylaxis
            $prophylaxis = $this->patient['prophylaxis'];

            foreach($prophylaxis as $proph){
                $da = new PatientProphylaxis;
                $da->patient_id = $new_patient_id['patient_id'];
                $da->prophylaxis_id = $proph;
                $da->save();
            }
            // Looping through family planning
            $family_plans = $this->patient['family_planning'];

            foreach($family_plans as $family_plan){
                $pfp = new PatientFamilyPlanning;
                $pfp->patient_id = $new_patient_id['patient_id'];
                $pfp->family_planning_id = $family_plan;
                $pfp->save();
            }

        }
    }

    public function multi_model_insert(array $models, $data) {
        foreach ($models as $model) {
            $model = "\\App\Models\PatientModels\\".$model;
            $modelclass = new $model;
            $modelclass->create($data);
        }
    }

}
