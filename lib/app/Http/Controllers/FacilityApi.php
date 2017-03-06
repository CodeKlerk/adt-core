<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\FacilityModels\Facilities;

class FacilityApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    public function facilityget(){
        $response = Facilities::all();
        return response()->json($response, 200);
    }
    public function facilityByIdget($facility_id){
        $response = Facilities::findOrFail($facility_id);
        return response()->json($response, 200);
    }

    public function facilitypost(){
        $input = Request::all();
        $new_facility = Facilities::create($input);
        if($new_facility){
            return response()->json(['msg' => 'Added a facility', 'facility' => $new_facility],200);
        }else{
            return response()->json(['msg' => 'could not create facility'],400);
        }
    }

    public function facilityput($facility_id){
        $input = Request::all();
        $facility = Facilities::findOrFail($facility_id);

            $facility->update([
                'code' => $input['code'],
                'name' => $input['name'],
                'postal_address' => $input['postal_address'],
                'email_address' => $input['email_address'],
                'phone_number' => $input['phone_number'],
                'adult_age' => $input['adult_age'],
                'service' => $input['service'],
                'weekday_max' => $input['weekday_max'],
                'weekend_max' => $input['weekend_max'],
                'county_sub_id' => $input['county_sub_id'],
                'supporter_id' => $input['supporter_id'],
                'facility_type_id' => $input['facility_type_id'],
                'is_sms' => $input['is_sms']
            ]);
            if($facility->save()){
                return response()->json(['msg'=> 'updated facility', 'facility' => $facility], 200);
            }else{
                return response()->json(['msg' => 'could not update facility'],400);
            }
    }

    public function facilitydelete($facility_id){
        $deleted_facility = Facilities::destroy($facility_id);
        if($deleted_facility){
            return response()->json(['msg' => 'Deleted the facility']);
        }else{
            return response()->json('Deleted facility');
        }
    }
    
}