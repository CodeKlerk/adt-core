<?php

namespace App\Events;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;

class DispensePatientEvent extends Event
{

    protected $data;
    protected $patient;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($request, $patient)
    {
        $this->patient = $patient;
        $patient_id['patient_id'] = $patient;
        $this->data = array_merge($request, $patient_id);
        $this->handle();
    }
    public function handle(){
        $visit_update = Visit::create($this->data);
        if($visit_update){
            $make_appointment = Appointment::create($this->data);
            //check if drugs exists in the array
            if(array_key_exists('drug', $this->data)){
                // Looping through drug 
                $id['patient_id'] = $this->patient;
                $drug = $this->data['drugs'];
                foreach($drugs as $drug){
                    // add patient_id to drug
                    $visit_item = array_merge($drug, $id);
                    // add visit item
                    VisitItem::create($visit_item);
                } 
            }
        }
    }
}
