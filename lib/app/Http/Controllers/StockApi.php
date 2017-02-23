<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\InventoryModels\StockItem;
use App\Models\InventoryModels\Stock;
use App\Models\InventoryModels\Store;

use App\Models\InventoryModels\TransactionType;
use App\Models\DrugModels\Drug;
use App\Models\InventoryModels\StockBalance;

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
     * Operation stocks
     *
     * Fetch a 's stock.
     *
     
     * @param int  ID&#39;s of  that needs to be fetched (required)
     *
     * @return Http response
     */
    public function stockget()
    {
        $response = Stock::get();
        if(!$response){  
            return response()->json(['msg' => 'could not find stock'], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation stocks
     *
     * Fetch a 's stock.
     *
     
     * @param int  ID&#39;s of  that needs to be fetched (required)
     * @param int $stock_id ID stock that needs to be fetched (required)
     *
     * @return Http response
     */
    public function stockByIdget($stock_id)
    {
        $response = Stock::findOrFail($stock_id);
        if(!$response){  
            return response()->json(['msg' => 'could not find stock for this '], 204);
        }else{
            return response()->json($response, 200);
        }
    }
    /**
     * Operation addstocks
     *
     * Add a new stock to a .
     *
     * @param int  ID&#39;s of  (required)
     *
     * @return Http response
     */
    public function stockpost()
    {
        $input = Request::all();
        $new_stock = Stock::create($input);
        if($new_stock){
            return response()->json(['msg'=> 'added stock to ', 'response'=> $new_stock], 201);
        }else{
            return response()->json(['msg'=> 'Could not add stock'], 400);
        }
    }

    /**
     * Operation updatestocks
     *
     * Update an existing stocks .
     *
     * @param int   id to update (required)
     * @param int $stock_id stock id to update (required)
     *
     * @return Http response
     */
    public function stockput($stock_id)
    {
        $input = Request::all();
        $stock = Stock::findOrFail($stock_id)->update([
                                        
                                    ]);
        if($stock){
            return response()->json(['msg' => 'Updated stock']);
        }else{
            return response()->json(['msg' => 'Could not update record'], 405);
        }
    }

    /**
     * Operation deletestock
     *
     * Remove a  stock.
     *
     * @param int  ID&#39;s of  and tb that needs to be fetched (required)
     * @param int $stock_id ID of tb that needs to be fetched (required)
     *
     * @return Http response
     */
    public function stockdelete($stock_id)
    {
        $deleted_stock = Stock::destroy($stock_id);
        if($deleted_stock){
            return response()->json(['msg' => 'Saftly deleted the  stock'],200);
        }else{
            return response()->json(['msg' => 'Could not delete record'], 400);
        }
    }

    // bincard
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

        $drug_information = StockBalance::where('drug_id', $drug_id)->get();
        // $drug_information = [ 
        //     'commodity' => "ABACAVIR (ABC) Liquid 20MG/ML (240ml)",
        //     'unit' => 'Bottle',
        //     'total_stock' => '0',
        //     'max_stock_level' => '0',
        //     'min_stock_level' => '0',
        //     'avg_monthly_consumption' => '0' 
        // ];
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


    public function storeget(){
        $response = Store::all();
        return response()->json($response, 200);
    }
    public function storeByIdget($store_id){
        $input = Request::all();
        // $map = Maps::findOrFail($maps_id);

        $response = Store::findOrFail($store_id);
        return response()->json($response, 200);
    }

    public function storepost(){
        $input = Request::all();
        $new_store = Store::create($input);
        if($new_store){
            return response()->json(['msg' => 'Store added' , 'data'=>$new_store]);
        }else{
            return response('Failed to add Store');
        }
    }

    public function storeput($store_id)
    {
        $input = Request::all();
        $store = Store::findOrFail($store_id);
        $store->update([
            'name' => $input['name'],
            'type' => $input['type'],
            'facility_id' => $input['facility_id']
            ]);
        if($store->save()){
            return response()->json(['msg' => 'Update store' ,'data'=>$store]);
        }else{
            return response('Oops, it seems like there was a problem updating the store');
        } 
    }
    public function storesdelete($store_id)
    {
      $deleted_store = Store::destroy($store_id);
      if($deleted_store){
        return response()->json(['msg' => 'Deleted store']);
    }
}    




}