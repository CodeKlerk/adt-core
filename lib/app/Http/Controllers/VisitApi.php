<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;

use App\Models\VisitModels\Appointment;
use App\Models\VisitModels\Visit;

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

    

}
