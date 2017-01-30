<?php

namespace App\Events;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;

class DispensePatientEvent extends Event
{

    protected $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($request, $patient)
    {
        $patient_id['patient_id'] = $patient;
        $this->data = array_merge($request, $patient_id);
        $this->handle();
    }
    public function handle(){
        $visit_update = Visit::create($this->data);
        if($visit_update){
            $make_appointment = Appointment::create($this->data);
        }
    }
}
