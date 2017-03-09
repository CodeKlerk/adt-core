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

    public function get_test($name = null, $limit = 0)
    {
        if($name == null){
            return "brian with Limit".$limit;
        }else{
            return $name.'with Limit: '.$limit;
        }
        
    }
    
}