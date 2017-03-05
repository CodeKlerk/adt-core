<?php

namespace App\Events;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;

class DispensePatientEvent extends Event
{

    protected $visit_information;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($request)
    {
        $this->visit_information = $request;
        $this->handle();
    }
    public function handle(){        
    
        $visit_update = Visit::create($this->visit_information);
        if($visit_update){
            $make_appointment = Appointment::create($this->visit_information);
            //check if drugs exists in the array
            if(array_key_exists('drugs', $this->visit_information)){
                // Looping through drug
                $new_visit_id['visit_id'] = $visit_update->id;
                $drugs = $this->visit_information['drugs'];

                foreach($drugs as $drug){
                    // add patient_id to drug
                    $visit_item = array_merge($drug, $new_visit_id);
                    // add visit item
                    VisitItem::create($visit_item);
                }
            }
        }
    }
}