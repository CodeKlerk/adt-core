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
        $response->load('subcounty', 'supporter', 'county');
        return response()->json($response, 200);
    }

    public function facilitypost(){
        $input = Request::all();
        $new_facility = Facilities::create($input);
        if($new_facility){
            $this->response->created();
        }else{
            return $this->response->errorBadRequest();
        }
    }

    public function facilityput($facility_id){
        $input = Request::all();
        $facility = Facilities::findOrFail($facility_id);
        if(!$facility){
            return $this->response->errorNotFound();
        }else{
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
                'county_id' => $input['county_id'],
                'county_sub_id' => $input['county_sub_id'],
                'supporter_id' => $input['supporter_id']
            ]);
            if($facility->save()){
                return response()->json(['msg'=> 'updated facility']);
            }else{
                return $this->response->errorBadRequest();
            }
        }
    }
    
}