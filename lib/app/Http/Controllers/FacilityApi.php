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
    
}