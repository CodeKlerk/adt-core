<?php

namespace App\Events;

use App\Models\InventoryModels\Stock;
use App\Models\InventoryModels\StockItem;

class StockTransactionEvent extends Event
{
    protected $transaction_data;
    protected $transaction_qty_type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, $type)
    {
        $this->transaction_data = $data;
        $this->transaction_qty_type = $type;
        $this->handle();
    }

    public function handle(){
        $new_stock = Stock::create($this->transaction_data);
        if($new_stock){
            if(array_key_exists('drugs', $this->transaction_data)){
                $new_stock_id['stock_id'] = $new_stock->id;
                $stock_items = $this->transaction_data['drugs'];

                foreach($stock_items as $stock_item){
                    // add patient_id to drug
                    $si = array_merge($stock_item, $new_stock_id);
                    $new_item = new StockItem;
                    $new_item->batch_number = $si['batch_number'];
                    $new_item->drug_id = $si['drug_id'];
                    $new_item->unit_cost = $si['unit_cost'];
                    if(array_key_exists('stock_id', $stock_item)){
                        $new_item->stock = $si['stock_id'];
                    }else{
                        $new_item->stock = $si['stock'];
                    }
                    // $new_item->pack_size = $si['pack_size'];
                    $new_item->expiry_date = $si['expiry_date'];
                    $new_item->quantity_packs = $si['quantity_packs'];
                    if($this->transaction_qty_type == 'in'){
                        $new_item->quantity_in = $si['quantity'];
                    }else{
                        $new_item->quantity_out = $si['quantity'];
                    }
                    $new_item->save();
                }
            }
        }
    }
}
