<?php

namespace App\Events;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientIllness;
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
        // $this->ilnesses = $input['illnesses'];
        // $this->handle();
        $this->test();
    }
    public function handle(){
        $created_patient = Patient::create($this->patient);
        if($created_patient){
            $new_patient_id['patient_id'] = $created_patient->id;
            $merged_request_and_new_id = array_merge($this->patient, $new_patient_id);
            $this->multi_model_insert(['PatientDrugAllergyOther', 'PatientDrugOther', 'PatientStatus', 'PatientTb'], $merged_request_and_new_id);
            
            // Looping through illness
            $illnesses = $input['illnesses'];
            foreach($illnesses as $illness){
               //code to loop 
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

    public function test(){
        foreach($this->patient['illnesses'] as $illness){
               dd($illness);
        }
    }
}
