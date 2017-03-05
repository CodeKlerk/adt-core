<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\FacilityModels\Facilities;
use App\Models\InventoryModels\StockItem;


use App\Models\VisitModels\Appointment; 
use App\Models\VisitModels\Visit;

use App\Models\InventoryModels\TransactionType;
use App\Models\ListsModels\Status;
class TestController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    public function post_test()
    {
        $input = Request::all();
        if(!array_key_exists('illnesses', $input)){
            return response('can not read the illnesses');
        }else{
            return response('Illnesses are present');
        }
        // return response()->json($input, 200);
    }

    public function get_test_with_id($id){
        return response()->json(Visit::where('patient_id', $id)->latest()->take(1)->get(),200);
    }

    public function get_test()
    {
        // return response()->json(TransactionType::with('stock_item.drug')->get(),200);
        $patient = Patient::get();
        $response = Status::where('patient_id', 6)->withPivot('patient_id','status_id')->get();
        return response()->json($patient, 200);

    }
    
}