<?php

namespace App\Events;

use App\Models\PatientModels\Patient;

class CreatePatientEvent extends Event
{

    public $patient;
    public $regimen;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->patient = $input;
        // $this->regimen = $input['regimen'];
        $this->handle();
    }
    public function handle(){
        $created_patient = Patient::create($this->patient);
        if($created_patient){
            $new_patient_id['patient_id'] = $created_patient->id;
            $merged_request_and_new_id = array_merge($this->patient, $new_patient_id);
            $this->multi_model_insert(['PatientDrugAllergyOther', 'PatientDrugOther', 'PatientStatus', 'PatientTb'], $merged_request_and_new_id);
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
