<?php

namespace App\Events;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;
use App\Models\InventoryModels\StockItem;

class DispensePatientEvent extends Event
{

    protected $visit_information;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($request, $stock_item_id)
    {
        $this->visit_information = $request;
        $this->handle($stock_item_id);
    }
    public function handle($stock_item_id){        
        $indication['indication_id'] = 1; //temp
        $visit_update = Visit::create($this->visit_information);
        if($visit_update){
            $make_appointment = Appointment::create($this->visit_information);
            if(array_key_exists('change_reason_id', $this->visit_information)){
                //  add to regimen change
            }
            //check if drugs exists in the array
            if(array_key_exists('drugs', $this->visit_information)){
                // Looping through drug
                $new_visit_id['visit_id'] = $visit_update->id;
                $drugs = $this->visit_information['drugs'];

                foreach($drugs as $drug){
                    // add patient_id to drug
                    $unit_cost['unit_cost'] = 10;
                    $visit_item = array_merge($unit_cost,$drug, $new_visit_id, $stock_item_id, $indication);
                    // add visit item
                    VisitItem::create($visit_item);
                }
            }
        }
    }
}