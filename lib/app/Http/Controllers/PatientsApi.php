<?php

/**
 * ADT API
 * Official & Core API for ADT  [ADT](http://adtcore.io)  Main API 
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;

use App\Models\PatientModels\Patient;
use App\Models\PatientModels\PatientFamilyPlanning;
use App\Models\PatientModels\PatientDependants;
use App\Models\PatientModels\PatientDrugAllergyOther;
use App\Models\PatientModels\PatientAllergies;
use App\Models\PatientModels\PatientDrugOther;
use App\Models\PatientModels\PatientIllness;
use App\Models\PatientModels\PatientPartner;
use App\Models\PatientModels\PatientProphylaxis;
use App\Models\PatientModels\PatientRegimens;
use App\Models\PatientModels\PatientStatus;
use App\Models\PatientModels\PatientTb;
use App\Models\PatientModels\PatientViralload;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;
// 
use App\Events\CreatePatientEvent;
use App\Events\UpdatePatientEvent;
use App\Events\DispensePatientEvent;

class PatientsApi extends Controller
    {
        /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Operation patientsGet
     *
     * get's a list of patients.
     *
     *
     * @return Http response
     */
    public function patientsGet()
    {
        $response = Patient::paginate(10);
        $response->load('next_appointment', 'visit.current_regimen', 'current_status');
        return response()->json($response, 200);
    }
    // check if ccc_number number is in use
    public function check_ccc_number($ccc_number){
        $check = Patient::where('ccc_number', $ccc_number)->count();
        if($check > 0){
            return response()->json(['msg' => 'true'],200);
        }else{
           return response()->json(['msg' => 'false'],200);
        }
    }
    /**
     * Operation getPatientById
     *
     * Find patient by patientId.
     *
     * @param int $patient_id ID of patient that needs to be fetched (required)
     *
     * @return Http response
     */
    public function getPatientById($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $patient->load('service','facility', 'supporter', 'source', 'who_stage', 'prophylaxis', 'tb', 'other_drug',
                        'current_status', 'drug_allergy', 'other_drug_allergy', 'illnesses', 
                        'other_illnesses', 'patient_dependant', 'family_planning', 'partner', 
                        'next_appointment', 'visit.current_regimen', 'visit.appointment', 'next_appointment', 'place_of_birth', 'start_regimen');
        return response()->json($patient, 200);
    }

    /**
     * Operation addPatient
     *
     * Add a new patient to the facility.
     *
     *
     * @return Http response
     */
    public function addPatient(Request $request)
    {
        $input = $request::all();
        event(new CreatePatientEvent($input));
    }

    /**
     * Operation updatePatient
     *
     * Update an existing patient.
     *
     * @param int $patient_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function updatePatient($patient_id)
    {
        $input = Request::all();
        event(new UpdatePatientEvent($input, $patient_id));
    }

    /**
     * Operation deletePatient
     *
     * Deletes a patient.
     *
     * @param int $patient_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function deletePatient($patient_id)
    {
        $patient = Patient::find($patient_id);
        $patient->delete();
        return response()->json(['msg' => 'Deleted Patient from facility']);
    }

    /**
     * Operation patientAllergies
     *
     * Fetch a patient's allergies.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     * @param int $allergie_id ID of Allergies that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientAllergies($patient_id, $allergie_id)
    {
        $response = PatientAllergies::where('patient_id',  $patient_id)->where('drug_id',  $allergie_id)->get();
        if(!$response){  
            return response('cant find patient nor allergies');
        }else{
            return response()->json($response, 200);
        }
    }

    /**
     * Operation addPatientAllergies
     *
     * Add a new PatientDrugAllergy to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     * @param int $allergie_id ID of Allergies (required)
     *
     * @return Http response
     */
    public function addPatientAllergies()
    {
        $input = Request::all();
        $save = PatientAllergies::create($input);
        if($save){
            return response()->json(['msg'=> 'Allergies added to patient', 'response'=> $input]);
        }else{
            return response()->json(['msg'=> 'There seems to have been a problem']);
        }

    }

    /**
     * Operation updatePatientAllergies
     *
     * Update an existing patient Allergies.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $allergie_id Allergies id to update (required)
     *
     * @return Http response
     */
    public function updatePatientAllergies($patient_id, $allergie_id)
    {
        $input = Request::all();
        $patientAllergy = PatientAllergies::where('patient_id', $patient_id)
                                            ->where('drug_id', $allergie_id)
                                            ->update(['drug_id' => $input['drug_id']]);
        if($patientAllergy){
            return response()->json(['msg' => 'Updated allergy']);
        }else{
            return response("there seems to have been a problem while updating");
        }

    }

    /**
     * Operation deletePatientAllergies
     *
     * Remove a patient PatientAllergies.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $allergie_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function deletePatientAllergies($patient_id, $allergie_id)
    {
        $patientAllergy = PatientAllergies::where('patient_id', $patient_id)
                                            ->where('drug_id', $allergie_id)
                                            ->delete();
        if($patientAllergy){
            return response()->json(['msg' => 'Saftly deleted the patient allergy record']);
        }else{
            return response('there seems to have been a problem while delteting');
        }

    }

#   ======================== PATIENT ILLNESS

       /**
     * Operation patientIllness
     *
     * Fetch a patient's illnesses.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     * @param int $illness_id ID of Allergies that needs to be fetched (required)
     *
     * @return Http response
     */
    public function getpatientIllness($patient_id)
    {

        $response = PatientIllness::where('patient_id',  $patient_id)->get();
        if(!$response){  
            return response('cant find patient nor Illnesses');
        }else{
            return response()->json($response, 200);
        }
    }

      public function getpatientIllnessbyId($patient_id, $illness_id)
    {
        
        // $response = PatientIllness::where('patient_id',  $patient_id)->where('illness_id',  $illness_id)->get();
        $response = PatientIllness::findOrFail($illness_id);
        if(!$response){  
            return response('cant find patient nor Illnesses');
        }else{
            return response()->json($response, 200);
        }
    }

    /**
     * Operation addPatientIllness
     *
     * Add a new PatientIllness to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     * @param int $illness_id ID of Allergies (required)
     *
     * @return Http response
     */
    public function addPatientIllness()
    {
        $input = Request::all();
        $save = PatientIllness::create($input);
        if($save){
            return response()->json(['msg'=> 'Illness added to patient', 'response'=> $input]);
        }else{
            return response()->json(['msg'=> 'There seems to have been a problem']);
        }

    }

    /**
     * Operation updatePatientIllness
     *
     * Update an existing patient Allergies.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $illness_id Allergies id to update (required)
     *
     * @return Http response
     */
    public function updatePatientIllness($patient_id, $illness_id)
    {
        // patient_id  illness_id
        $input = Request::all();
        $updatedpatientIllness = PatientIllness::findOrFail($illness_id);
        $updatedpatientIllness->update([ 'patient_id'=>$input['patient_id'], 'illness_id'=>$input['illness_id']]);
        if($updatedpatientIllness->save()){
            return response()->json(['msg' => 'Updated Illness','data'=> $updatedpatientIllness]);
        }else{
            return response("there seems to have been a problem while updating");
        }

    }

    /**
     * Operation deletePatientIllness
     *
     * Remove a patient PatientIllness.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $illness_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function deletePatientIllness($patient_id, $illness_id)
    {
        $patientIllness = PatientIllness::destroy($illness_id);

                if($patientIllness){
            return response()->json(['msg' => 'deleted the patient Illness record']);
        }else{
            return response('there seems to have been a problem while delteting');
        }

    }
#   ========================/ PATIENT ILLNESS


#   ======================== PATIENT PARTNERS

       /**
     * Operation patientPartner
     *
     * Fetch a patient's Partners.
     *
     
     * @param int $patient_id ID&#39;s of patient that needs to be fetched (required)
     * @param int $partner_id ID of Allergies that needs to be fetched (required)
     *
     * @return Http response
     */
    public function getpatientPartner($patient_id)
    {

        // $response = PatientPartner::where('patient_id',  $patient_id)->get();
        $response = PatientPartner::where('patient_id',  $patient_id)->orWhere('partner_id',  $patient_id)->get();
        if(!$response){  
            return response('cant find patient nor Partner');
        }else{
            return response()->json($response, 200);
        }
    }

   /**
     * Operation addPatientPartner
     *
     * Add a new PatientPartner to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     * @param int $partner_id ID of Allergies (required)
     *
     * @return Http response
     */
    public function addPatientPartner()
    {
        $input = Request::all();
        $save = PatientPartner::create($input);
        if($save){
            return response()->json(['msg'=> 'Partner added to patient', 'response'=> $input]);
        }else{
            return response()->json(['msg'=> 'There seems to have been a problem']);
        }

    }

    /**
     * Operation updatePatientPartner
     *
     * Update an existing patient Allergies.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $partner_id Allergies id to update (required)
     *
     * @return Http response
     */
    public function updatePatientPartner($patient_id, $partner_id)
    {
        // patient_id  partner_id
        $input = Request::all();
        $updatedpatientPartner = PatientPartner::findOrFail($partner_id);
        $updatedpatientPartner->update([ 'patient_id'=>$input['patient_id'], 'partner_id'=>$input['partner_id']]);
        if($updatedpatientPartner->save()){
            return response()->json(['msg' => 'Updated Partner','data'=> $updatedpatientPartner]);
        }else{
            return response("there seems to have been a problem while updating");
        }

    }

    /**
     * Operation deletePatientPartner
     *
     * Remove a patient PatientPartner.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $partner_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function deletePatientPartner($patient_id, $partner_id)
    {
        $patientPartner = PatientPartner::destroy($partner_id);

                if($patientPartner){
            return response()->json(['msg' => 'deleted the patient Partner record']);
        }else{
            return response('there seems to have been a problem while delteting');
        }

    }
#   ========================/ PATIENT PARTNERS


    /**
     * Operation patientAppointments
     *
     * Fetch the patient's appointments.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $appointment_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientAppointments($patient_id, $appointment_id)
    {
        $response = Appointment::where('patient_id', $patient_id)
                                ->where('id', $appointment_id)
                                ->first();
        return response()->json($response, 200);
    }

    /**
     * Operation addPatientAppointments
     *
     * Add a new Appointments to a patient.
     *
     * @param int $patient_id ID of patient (required)
     * @param int $appointment_id ID of appointment (required)
     *
     * @return Http response
     */
    public function addPatientAppointments($patient_id)
    {
        $input = Request::all();
        $appointment = Appointment::create($input);
        if($appointment){
            return response()->json(['msg'=> 'Added appointment']);
        }else{
            return response("Seems like something went while adding the appointment1");
        }
    }

    /**
     * Operation updatePatientAppointments
     *
     * Update an existing patient appointment.
     *
     * @param int $patient_id ID of patient for update (required)
     * @param int $appointment_id ID of appointment for update (required)
     *
     * @return Http response
     */
    public function updatePatientAppointments($patient_id, $appointment_id)
    {
        $input = Request::all();
        $patientAppointment = Appointment::where('patient_id', $patient_id)
                                            ->where('id', $appointment_id)
                                            ->update([
                                                'appointment_date' => $input['appointment_date'],
                                                'is_appointment' => $input['is_appointment'],
                                                'facility_id' => $input['facility_id']
                                            ]);
        if($patientAppointment){
            return response()->json(['msg'=> 'updated patient appointment'], 200);
        }else{
            return response('It seems like something went wrong while trying to update');
        }
    }

    /**
     * Operation deletePatientAppointment
     *
     * Remove a patient appointment.
     *
     * @param int $patient_id ID of patient and appointment that needs to be fetched (required)
     * @param int $appointment_id ID of appointment that needs to be deleted (required)
     *
     * @return Http response
     */
    public function deletePatientAppointment($patient_id, $appointment_id)
    {
        $patientAppointment = Appointment::where('patient_id', $patient_id)
                                            ->where('id', $appointment_id)
                                            ->delete();
    }

    /**
     * Operation patientregimens
     *
     * Fetch the regimens patient is administered.
     *
     * @param int $patient_id ID of patient that needs to be fetched (required)
     * @param int $regimen_id ID of regimen that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientregimens($patient_id, $regimen_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing patientregimens as a GET method ?');
    }

        /**
     * Operation addPatientRegimen
     *
     * Add a new regimen to a patient.
     *
     * @param int $patient_id Patient id to delete (required)
     * @param int $regimen_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function addPatientRegimen($patient_id, $regimen_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing addPatientRegimen as a POST method ?');
    }
    /**
     * Operation updatePatientRegimens
     *
     * Update an existing patient regimen.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $regimen_id Patient id to update (required)
     *
     * @return Http response
     */
    public function updatePatientRegimens($patient_id, $regimen_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing updatePatientRegimens as a PUT method ?');
    }
    /**
     * Operation deletePatientRegimens
     *
     * Remove a patient of a regimen.
     *
     * @param int $patient_id Patient id and Regimen id to delete (required)
     * @param int $regimen_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function deletePatientRegimens($patient_id, $regimen_id)
    {
        // $patient_regimen = PatientRegimen::where
    }


    /**
     * Operation patientProphylaxis
     *
     * Fetch the prophylaxis patient is administered.
     *
     * @param int $patient_id ID of patient that needs to be fetched (required)
     * @param int $prophylaxis_id ID of prophylaxis that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientProphylaxis($patient_id, $prophylaxis_id)
    {
        $patientProphylaxis = PatientProphylaxis::where('patient_id', $patient_id)
                                            ->where('prophylaxis_id', $prophylaxis_id)
                                            ->first();
        return response()-json($patientProphylaxis, 200);
    }
    /**
     * Operation updatePatientProphylaxis
     *
     * Update an existing patient prophylaxis.
     *
     * @param int $patient_id Patient id to delete (required)
     * @param int $prophylaxis_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function updatePatientProphylaxis($patient_id, $prophylaxis_id)
    {
        $input = Request::all();
        $patientProphylaxis = PatientProphylaxis::where('patient_id', $patient_id)
                                            ->where('prophylaxis_id', $prophylaxis_id)
                                            ->update(['prophylaxis_id' => $input['prophylaxis_id']]);
        if($patientProphylaxis){
            return response()->json(['msg' => 'Updated the patient prophylaxis']);
        }else{
            return response('seemes like something went wrong');
        }
    }

    /**
     * Operation deletePatientProphylaxis
     *
     * Remove a patient of a Prophylaxis.
     *
     * @param int $patient_id Patient id to delete (required)
     * @param int $prophylaxis_id Patient id to delete (required)
     *
     * @return Http response
     */
    public function deletePatientProphylaxis($patient_id, $prophylaxis_id)
    {
        $patientProphylaxis = PatientProphylaxis::where('patient_id', $patient_id)
                                            ->where('prophylaxis_id', $prophylaxis_id)
                                            ->delete();
        if($patientProphylaxis){
            return response()->json(['msg' => 'Deleted pateint']);
        }else{
            return response('Something seems to have gone wrong while trying to delete this object');
        }
    }

    /**
     * Operation patientVisits
     *
     * Fetch a patient's visit.
     *
     * @param int $patient_id ID&#39;s of patient and Visits that needs to be fetched (required)
     * @param int $visit_id ID&#39;s of Visits that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientVisits($patient_id)
    {
        $patient_visits = Patient::findOrFail($patient_id)->select('id')->with('visit.visit_item.stock_item._drug');
        $patient_visits->load('visit.visit_item.stock_item._drug');
        return response()->json($patient_visits,200);
    }

    /**
     * Operation addPatientVisits
     *
     * Add a new Visits to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     * @param int $visit_id ID&#39;s of Visits (required)
     *
     * @return Http response
     */
    public function addPatientVisits($patient_id)
    {
        $input = Request::all();
        $patient['patient_id'] = $patient_id;
        $visit_information = array_merge($input, $patient);
        event(new DispensePatientEvent($visit_information));
    }

    /** 
     * Operation updatePatientVisit
     *
     * Update an existing patient appointment.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $visit_id visit id to update (required)
     *
     * @return Http response
     */
    public function updatePatientVisit($patient_id, $visit_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing updatePatientVisit as a PUT method ?');
    }

    /**
     * Operation deletePatientVisit
     *
     * Remove a patient Visit.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $visit_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function deletePatientVisit($patient_id, $visit_id)
    {
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing deletePatientVisit as a DELETE method ?');
    }

    // viralload    
    /**
     * Operation patientviralload
     *
     * Fetch a patient's viralload.
     *
     * @param int $patient_id ID&#39;s of patient and viralload that needs to be fetched (required)
     * @param int $viralload_id ID&#39;s of viralload that needs to be fetched (required)
     *
     * @return Http response
     */
    public function patientViralload($patient_id)
    {   
        $patient_viralload = PatientViralload::get();
        return response()->json($patient_viralload,200); 
    }

    /**
     * Operation addPatientviralload
     *
     * Add a new viralload to a patient.
     *
     * @param int $patient_id ID&#39;s of patient (required)
     * @param int $viralload_id ID&#39;s of viralload (required)
     *
     * @return Http response
     */
    public function addPatientViralload($patient_id)
    {
        $input = Request::all();
        $new_virallod = PatientViralload::create($input);
        if($new_virallod){
            return response()->json('',201);
        }else{
            return response()->json('',400);
        }
    }

    /**
     * Operation updatePatientviralload
     *
     * Update an existing patient appointment.
     *
     * @param int $patient_id Patient id to update (required)
     * @param int $viralload_id viralload id to update (required)
     *
     * @return Http response
     */
    public function updatePatientViralload($patient_id, $viralload_id)
    {
        $input = Request::all();
        
        $viralload = PatientViralload::findOrFail($viralload_id)->where('patient_id', $patient_id);
        $viralload->update([
            'test_date' => $input[''],
            'result' => $input['result'],
            'justification' => $input['justification']
        ]);

        if($viralload->save()){
            return response()->json('',202);
        }else{
            return response()->json('', 400);
        }
    }

    /**
     * Operation deletePatientviralload
     *
     * Remove a patient viralload.
     *
     * @param int $patient_id ID&#39;s of patient and appointment that needs to be fetched (required)
     * @param int $viralload_id ID of appointment that needs to be fetched (required)
     *
     * @return Http response
     */
    public function deletePatientViralload($patient_id, $viralload_id)
    {
        $deleted_viralload = PatientViralload::destroy($viralload_id);
        return response()->json('',200); 
    }



    // functoins to return only the latest
    public function return_latest_appointment($patient_id){
        $appointment = Appointment::where('patient_id', $patient_id)->latest()->take(1)->get();
        return response()->json($appointment,200);
    }

    public function return_latest_visit($patient_id){
        $visit = Visit::where('patient_id', $patient_id)->latest()->take(1)->get();
        return response()->json($visit,200);
    }

    // functions to return only return the first 
    public function return_first_visit($patient_id){
        $first_visit = Visit::where('patient_id', $patient_id)->sortByDesc('created_at')->first();
        return response()->json($first_visit, 200);
    }

}