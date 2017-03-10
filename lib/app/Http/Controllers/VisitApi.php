<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
use App\Models\VisitModels\VisitItem;

use App\Models\DrugModels\Drug;
use App\Models\InventoryModels\StockItem;

class VisitApi extends Controller
{
    public function __construct(){}

    /**
     * Operation patientAppointmentss
     *
     * Fetch a patient's appointment.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientAppointmentsget($patient_id)
    {
        $response = Appointment::where('patient_id',  $patient_id)->get();
        if(!$response){  
            return response()->json(['msg' => 'could not find appointmant'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation patientAppointmentss
     *
     * Fetch a patient's familyplanning.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     * @param int $appointment_id ID family plan that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientAppointmentsByIdget($patient_id, $appointment_id)
    {
        $response = Appointment::where('patient_id', $patient_id)
                                            ->where('id', $appointment_id)
                                            ->first();
        if(!$response){  
            return response()->json(['msg' => 'could not find appointment for this patient'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation addpatientAppointmentss
     *
     * Add a new patient tb to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     *
     * @return Http response
     */
    public function patientAppointmentspost()
    {
        $input = Request::all();
        $new_appointment = Appointment::create($input);
        if($new_appointment){
            return response()->json(['msg'=> 'added tb to patient', 'response'=> $new_appointment], 201);
        }else{
            return response()->json(['msg'=> 'Could not add patient appointment'], 400);
        }
    }

    /**
     * Operation updatepatientAppointmentss
     *
     * Update an existing patient tbs plannings.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $appointment_id appointment id to update (required)
     *
     * @return Http response
     */
    public function patientAppointmentsput($patient_id, $appointment_id)
    {
        $input = Request::all();
        $patient_appointment = Appointment::where('patient_id', $patient_id)
                                   ->where('id', $appointment_id)
                                   ->update([
                                       "appointment_date" => $input['appointment_date'],
                                        "is_appointment" => $input['is_appointment'],
                                        "facility_id" => $input['facility_id']
                                   ]);
        if($patient_appointment){
            return response()->json(['msg' => 'Updated appointment', 'appointment' => $patient_appointment], 201);
        }else{
            return response()->json(['msg' => 'Could not update record'], 405);
        }
    }

    /**
     * Operation deletepatientAppointmentss
     *
     * Remove a patient patientAppointmentss.
     *
     * @param int $patient_id ID&#39;s of patient and tb that needs to be fetched (required)
     * @param int $appointment_id ID of tb that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientAppointmentsdelete($patient_id, $appointment_id)
    {
        $patient_tb = Appointment::where('patient_id', $patient_id)
                                            ->where('id', $appointment_id)
                                            ->delete();
        if($patient_tb){
            return response()->json(['msg' => 'Saftly deleted the patient appointment'],200);
        }else{
            return response()->json(['msg' => 'Could not delete record'], 400);
        }
    }


    // //////////
    // Visit  //
    // ////////
    /**
     * Operation Visits
     *
     * Fetch a patient's Visit.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientVisitsget($patient_id)
    {
        $response = Visit::where('patient_id',  $patient_id)->with('regimen_change','visit_item.stock_item')->get();
        
        if(!$response){  
            return response()->json(['msg' => 'could not find visit'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation Visits
     *
     * Fetch a patient's visit.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     * @param int $visit_id ID visit that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientVisitsByIdget($patient_id, $visit_id)
    {
        $response = Visit::where('patient_id', $patient_id)
                                            ->where('id', $visit_id)
                                            ->first();
        if(!$response){  
            return response()->json(['msg' => 'could not find visit for this patient'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation addVisits
     *
     * Add a new visit to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     *
     * @return Http response
     */
    public function patientVisitspost()
    {
        $input = Request::all();
        $new_patient_visit = Visit::create($input);
        if($new_patient_visit){
            return response()->json(['msg'=> 'added visit to patient', 'response'=> $new_patient_visit], 201);
        }else{
            return response()->json(['msg'=> 'Could not add visit'], 400);
        }
    }

    /**
     * Operation updateVisits
     *
     * Update an existing visits .
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $visit_id Visit id to update (required)
     *
     * @return Http response
     */
    public function patientVisitsput($patient_id, $visit_id)
    {
        $input = Request::all();
        $patient_visit = Visit::where('patient_id', $patient_id)
                                ->where('id', $visit_id)
                                ->update([
                                    "current_height" => $input['current_height'],
                                    "current_weight" => $input['current_weight'],
                                    "current_bsa" => $input['current_bsa'],
                                    "visit_date" => $input['visit_date'],
                                    "appointment_adherence" => $input['appointment_adherence'],
                                    "patient_id" => $input['patient_id'],
                                    "facility_id" => $input['facility_id'],
                                    "user_id" => $input['user_id'],
                                    "purpose_id" => $input['purpose_id'],
                                    "last_regimen_id" => $input['last_regimen_id'],
                                    "current_regimen_id" => $input['current_regimen_id'],
                                    "change_reason_id" => $input['change_reason_id'],
                                    "appointment_id" => $input['appointment_id']
                                ]);
        if($patient_visit){
            return response()->json(['msg' => 'Updated visit']);
        }else{
            return response()->json(['msg' => 'Could not update record'], 405);
        }
    }

    /**
     * Operation deletevisit
     *
     * Remove a patient visit.
     *
     * @param int $patient_id ID&#39;s of patient and tb that needs to be fetched (required)
     * @param int $visit_id ID of tb that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientVisitsdelete($patient_id, $visit_id)
    {
        $patient_tb = Visit::where('patient_id', $patient_id)
                                            ->where('id', $visit_id)
                                            ->delete();
        if($patient_tb){
            return response()->json(['msg' => 'Saftly deleted the patient visit'],200);
        }else{
            return response()->json(['msg' => 'Could not delete record'], 400);
        }
    }


    // ///////////////
    // Visit items //
    // //////////////
    
    /**
     * Operation vistItems
     *
     * Fetch a visit's vistItem.
     *
     
     * @param int $visit_id ID&#39;s of visit that needs to be fetched (required)
     *
     * @return Http response
     */
    public function visitsItemget($visit_id)
    {
        $response = VisitItem::where('visit_id',  $visit_id)->get();
        if(!$response){  
            return response()->json(['msg' => 'could not find vistItem'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation vistItems
     *
     * Fetch a visit's vistItem.
     *
     
     * @param int $visit_id ID&#39;s of visit that needs to be fetched (required)
     * @param int $vistItem_id ID vistItem that needs to be fetched (required)
     *
     * @return Http response
     */
    public function visitsItemByIdget($visit_id, $vistItem_id)
    {
        $response = VisitItem::where('visit_id', $visit_id)
                                            ->where('id', $vistItem_id)
                                            ->first();
        if(!$response){  
            return response()->json(['msg' => 'could not find vistItem for this visit'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation addvistItems
     *
     * Add a new vistItem to a visit.
     *
     * @param int $visit_id ID&#39;s of visit (required)
     *
     * @return Http response
     */
    public function visitsItempost()
    {
        $input = Request::all();
        $new_vistItem = VisitItem::create($input);
        if($new_vistItem){
            return response()->json(['msg'=> 'added vistItem to visit', 'response'=> $new_vistItem], 201);
        }else{
            return response()->json(['msg'=> 'Could not add vistItem'], 400);
        }
    }

    /**
     * Operation updatevistItems
     *
     * Update an existing vistItems .
     *
     * @param int $visit_id visit id to update (required)
     * @param int $vistItem_id vistItem id to update (required)
     *
     * @return Http response
     */
    public function visitsItemput($visit_id, $vistItem_id)
    {
        $input = Request::all();
        $visit_vistItem = VisitItem::where('visit_id', $visit_id)
                                    ->where('id', $vistItem_id)
                                    ->update([
                                        "duration" => $input['duration'],
                                        "expected_pill_count" => $input['expected_pill_count'],
                                        "actual_pill_count" => $input['actual_pill_count'],
                                        "missed_pill_count" => $input['missed_pill_count'],
                                        "non_adherence_reason_id" => $input['non_adherence_reason_id'],
                                        "comment" => $input['comment'],
                                        "visit_id" => $input['visit_id'],
                                        "stock_item_id" => $input['stock_item_id'],
                                        "dose_id" => $input['dose_id'],
                                        "indication_id" => $input['indication_id']
                                    ]);
        if($visit_vistItem){
            return response()->json(['msg' => 'Updated vistItem']);
        }else{
            return response()->json(['msg' => 'Could not update record'], 405);
        }
    }

    /**
     * Operation deletevistItem
     *
     * Remove a visit vistItem.
     *
     * @param int $visit_id ID&#39;s of visit and tb that needs to be fetched (required)
     * @param int $vistItem_id ID of tb that needs to be fetched (required)
     *
     * @return Http response
     */
    public function visitsItemdelete($visit_id, $vistItem_id)
    {
        $visit_tb = VisitItem::where('visit_id', $visit_id)
                                            ->where('id', $vistItem_id)
                                            ->delete();
        if($visit_tb){
            return response()->json(['msg' => 'Saftly deleted the visit vistItem'],200);
        }else{
            return response()->json(['msg' => 'Could not delete record'], 400);
        }
    }

    // //////////////////
    // dispense       //
    // ////////////////
    
    /**
     * Operation dispenses
     *
     * Fetch a dispense
     *
     
     * @param int $patient_id ID&#39;s of dispense that needs to be fetched (required)
     *
     * @return Http response
     */
    public function dispenseget($patient_id)
    {
        $response = Visit::where('patient_id', $patient_id)->get();
        $response->load('visit_item.stock_item.drug');
        return response()->json($response,200);
    }
    /**
     * Operation dispenses
     *
     * Fetch a dispense
     *
     
     * @param int $patient_id ID&#39;s of dispense that needs to be fetched (required)
     * @param int $dispense_id ID dispense that needs to be fetched (required)
     *
     * @return Http response
     */
    public function dispenseByIdget($patient_id, $dispense_id)
    {
        // 
    }
    /**
     * Operation adddispenses
     *
     * Add a new dispense to a dispense.
     *
     * @param int $patient_id ID&#39;s of dispense (required)
     *
     * @return Http response
     */
    public function dispensepost($patient_id)
    {
        $input = Request::all();
        $patient['patient_id'] = $patient_id;
    $visit_information = array_merge($input, $patient);
        event(new DispensePatientEvent($visit_information));
    }

    /**
     * Operation updatedispenses
     *
     * Update an existing dispenses .
     *
     * @param int $patient_id dispense id to update (required)
     * @param int $dispense_id dispense id to update (required)
     *
     * @return Http response
     */
    public function dispenseput($patient_id, $dispense_id)
    {
        $input = Request::all();
    }

    /**
     * Operation deletedispense
     *
     * Remove a dispense dispense.
     *
     * @param int $patient_id ID&#39;s of dispense and tb that needs to be fetched (required)
     * @param int $dispense_id ID of tb that needs to be fetched (required)
     *
     * @return Http response
     */
    public function dispensedelete($patient_id, $dispense_id)
    {

    }

    // return drug
    public function dispenseGetDrug($drug_id){
        $drug = Drug::findOrFail($drug_id);
        $stock_item = StockItem::where('drug_id', $drug_id)->get();
        $stock_counts = DB::select('SELECT DATEDIFF(now(),visit_date)  as dayscount,
                                 quantity_out * quantity_packs  - DATEDIFF(now(),visit_date) *td.quantity * td.frequency as expected_pillcount
                                 FROM tbl_visit tv, tbl_visit_item tvi, tbl_dose td, tbl_stock_item  tsi
                                 where tv.id = tvi.visit_id
                                 AND tsi.drug_id = 3
                                 LIMIT 1'
                             );
        $response = [
            'drug_id' => $drug->id,
            'drug_name' => $drug->name,
            'duration' => $drug->duration,
            'unit' => $drug->unit['name'],
            'refill' => 'true',
            'expected_pill_count' => 0,
            'days_count' => 0,
            'batches' => $stock_item
        ];
        return $response;
    }

    public function patientVisitItemsget($patient_id){
	$response = DB::table('tbl_stock_item')
		       ->join('tbl_visit_item', 'tbl_stock_item.id', 'tbl_visit_item.stock_item_id')
		       ->join('tbl_visit', 'tbl_visit.id', 'tbl_visit_item.visit_id')
               ->join('tbl_drug', 'tbl_stock_item.drug_id', 'tbl_drug.id')
               ->join('tbl_unit', 'tbl_drug.unit_id', 'tbl_unit.id')
               ->where('tbl_visit.patient_id', $patient_id)
               ->select('drug_id', 'batch_number', 'tbl_unit.name as unit','tbl_visit_item.dose_id', 'expected_pill_count', 'tbl_visit_item.duration', 'quantity_out', 'indication_id', 'expiry_date', 'balance_before')
		       ->get();
	return response()->json($response,200);
    }

}

