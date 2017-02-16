<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\InventoryModels\StockItem;
use App\Models\InventoryModels\Stock;
use App\Models\InventoryModels\TransactionType;
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
        return response()->json(TransactionType::with('stock_item.drug')->get(),200);
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
        $transactions = Drug::with('unit','stock_item', 'stock_item.stock')->where('id', $drug_id)->get();

        $batch_information = Drug::with('unit','stock_item')->where('id', $drug_id)->whereHas('stock_item.balance', function($query){
            $query->where('balance', '>', '0');
        })->get();
        $drug_information = [ 
            'commodity' => "ABACAVIR (ABC) Liquid 20MG/ML (240ml)",
            'unit' => 'Bottle',
            'total_stock' => '0',
            'max_stock_level' => '0',
            'min_stock_level' => '0',
            'avg_monthly_consumption' => '0' 
        ];
        $response = [
            'transactions' => $transactions,
            'batch_information' => $batch_information,
            'drug_information' => $drug_information
        ];
        return response()->json($response,200);
    }

    // transactions
    public function stock_transaction_get(){
        return response()->json(TransactionType::with('stock.stock_item')->get(),200);
    }
    
}