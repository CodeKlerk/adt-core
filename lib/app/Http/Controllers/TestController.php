<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\DB;

use App\Models\FacilityModels\Facilities;
use App\Models\InventoryModels\StockItem;
use App\Models\InventoryModels\Stock;

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
        // $stocks_by_store = DB::table('tbl_store')
        //                       ->join('tbl_stock', 'tbl_store.id', 'tbl_stock.store_id')
        //                       ->join('tbl_stock_item', 'tbl_stock.id', 'tbl_stock_item.stock_id')
        //                       ->where('tbl_store.id', $id)
        //                       ->select('batch_number', 'expiry_date', 'balance_before', 'unit_cost', 'comment', 'store')
        //                       ->get();
        
        // return response()->json($stocks_by_store,200);
    }


    public function get_test($date = "now",$store_id, $drug_id){
        if($date == 'now'){
            $current_date = date('Y-m-d');
            // $response = [
            //     'store' => $store_id,
            //     'date' => date('y-m-d'),
            //     'drug' => $drug_id
            // ];
        }else{
            $current_date = '0000:00:00';
            //  $response = [
                
            //     'store' => $store_id,
            //     'date' => $date,
            //     'drug' => $drug_id
            // ];
        }
        // return $current_date;
        $response = DB::table('tbl_store')
                       ->join('tbl_stock', 'tbl_store.id', 'tbl_stock.store_id')
                       ->join('tbl_stock_item', 'tbl_stock.id', 'tbl_stock_item.stock_id')
                       ->join('tbl_drug', 'tbl_stock_item.drug_id', 'tbl_drug.id')
                       ->join('tbl_unit', 'tbl_drug.unit_id', 'tbl_unit.id')
                       ->join('tbl_dose', 'tbl_drug.dose_id', 'tbl_dose.id')
                       ->join('tbl_generic', 'tbl_drug.generic_id', 'tbl_generic.id')
                       ->where('tbl_store.id', $store_id)
                       ->where('tbl_stock_item.drug_id', $drug_id) 
                       ->where('tbl_stock_item.expiry_date', '>', $current_date)  
                       ->select( 'tbl_unit.name as unit', 'pack_size', 'tbl_generic.name as generic', 
                                 'tbl_dose.name as dose', 'batch_number', 'expiry_date', 'balance_before', 
                                 'balance_after', 'unit_cost', 'comment', 'store', 'drug_id as id', 
                                 'tbl_drug.name', 'tbl_stock.ref_number', 'tbl_stock.transaction_time',
                                 'tbl_stock.transaction_detail', 'tbl_stock.transaction_type_id',
                                 'tbl_stock_item.expiry_date', 'tbl_stock_item.quantity_packs', 'tbl_stock_item.total_cost'
                               )
                       ->get();
        return response()->json($response,200);
    }
}