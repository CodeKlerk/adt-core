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
    
}