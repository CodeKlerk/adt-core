<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\DB;

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
        // $patient = Patient::get();
        // $response = Status::where('patient_id', 6)->withPivot('patient_id','status_id')->get();
        // return response()->json($patient, 200);
        // $response = DB::table('tbl_visit')
        //                 ->join('tbl_visit_item', 'tbl_visit.id' , 'tbl_visit_item.visit_id')
        //                 ->join('tbl_dose', 'tbl_visit_item.dose_id', 'tbl_dose.id')
        //                 ->join('tbl_stock_item', 'tbl_visit_item.stock_item_id', 'tbl_stock_item.id')
        //                 ->join('tbl_drug', 'tbl_stock_item.drug_id', 'tbl_drug.id')
        //                 // ->select('patient_id', 'drug_id', 'frequency')
        //                 ->get();
         $response = DB::select('SELECT DATEDIFF(now(),visit_date)  as dayscount,
                                 quantity_out * quantity_packs  - DATEDIFF(now(),visit_date) *td.quantity * td.frequency as expected_pillcount
                                 FROM tbl_visit tv, tbl_visit_item tvi, tbl_dose td, tbl_stock_item  tsi
                                 where tv.id = tvi.visit_id
                                 LIMIT 1'
                             );
        return $response;
        //     ->join('')
        //  tvi, tbl_dose td, tbl_stock_item  tsi, tbl_drug tdr


    }
    
}