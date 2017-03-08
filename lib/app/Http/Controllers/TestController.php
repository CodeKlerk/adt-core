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
        $stocks_by_store = Stock::where('store_id', $id);
        // return $stocks_by_store->flatten();
        // $stocks_by_store->load('stock_item');
        foreach($stocks_by_store as $st){
            // $item = StockItem::where('stock_id', $st)->get();
            $response[] = $st->flatten();
        }
        return response()->json($response,200);
    }

    public function get_test()
    {
        $response = StockItem::get();
        return response()->json($response,200);
    }
    
}