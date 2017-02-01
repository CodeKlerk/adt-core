<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\InventoryModels\StockItem;
use App\Models\DrugModels\Drug;

class StockApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('api.auth');
    }

    /**
     * Operation stockGet
     *
     * fetches a list of services at a facility.
     *
     *
     * @return Http response
     */
    public function stockget()
    {
        $response = StockItem::all();
        return $response;
    }
    /**
     * Operation stockPost
     *
     * Add a new service to the facility.
     *
     *
     * @return Http response
     */
    public function stockpost()
    {
        $input = Request::all();

        //path params validation


        //not path params validation
        $body = $input['body'];


        return response('How about implementing stockPost as a POST method ?');
    }
    /**
     * Operation stockStockIdBincardGet
     *
     * Fetch all details of a commodity specified by stockId.
     *
     * @param int $stock_id ID of commodity whose details needs to be fetched (required)
     *
     * @return Http response
     */
    public function stockBincardget($drug_id)
    {
        // $response = StockItem::where('drug_id', $drug_id)->get();
        $response = Drug::with('unit','stock_item', 'stock_item.stock')->where('id', $drug_id)->get();
        return response()->json($response,200);
    }
    
}