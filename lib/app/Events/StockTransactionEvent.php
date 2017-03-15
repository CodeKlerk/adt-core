<?php

namespace App\Events;

use App\Models\InventoryModels\Stock;
use App\Models\InventoryModels\StockItem;

use App\Events\DispensePatientEvent;

class StockTransactionEvent extends Event
{
    protected $transaction_data;
    protected $transaction_qty_type;
    protected $store_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, $type, $store_id, $kind_of_transaction)
    {
        $this->transaction_data = $data;
        $this->transaction_qty_type = $type;
        $this->store_id = $store_id;
        $this->handle($kind_of_transaction);
    }

    public function handle($kind_of_transaction){
        $new_stock = new Stock;
        $new_stock->transaction_time = $this->transaction_data['transaction_date'];
        $new_stock->ref_number = $this->transaction_data['ref_number'];
        $new_stock->user_id = 1;
        $new_stock->store_id = $this->store_id;
        $new_stock->facility_id = 1;
        if(array_key_exists('transaction_detail',$this->transaction_data)){
            $new_stock->transaction_detail = $this->transaction_data['transaction_detail'];
        }
        $new_stock->transaction_type_id = $this->transaction_data['transaction_type_id'];
        
        if($new_stock->save()){
            if(array_key_exists('drugs', $this->transaction_data)){
                if(array_key_exists('store_id', $this->transaction_data)){
                    $store = $this->transaction_data['store_id'];
                }else{
                    $store = $this->transaction_data['store'];
                }

                $new_stock_id['stock_id'] = $new_stock->id;
                $stock_items = $this->transaction_data['drugs'];
                
                foreach($stock_items as $stock_item){
                    // add patient_id to drug
                    $si = array_merge($stock_item, $new_stock_id);
                    $new_item = new StockItem;
                    $new_item->stock_id = $si['stock_id'];
                    $new_item->batch_number = $si['batch_number'];
                    $new_item->drug_id = $si['drug_id'];
                    $new_item->unit_cost = $si['unit_cost'];
                    $new_item->store = $store; 
                    // $new_item->pack_size = $si['pack_size'];
                    $new_item->expiry_date = $si['expiry_date'];
                    $new_item->quantity_packs = $si['quantity_packs'];
                    if($si['balance_before'] > 0){
                        $balance_before = $si['balance_before'];
                    }else{
                        $balance_before = 0;
                    }
                    $new_item->balance_before = $balance_before;
                    if($this->transaction_qty_type == 'in'){
                        $new_item->quantity_in = $si['quantity'];
                    }else{
                        $new_item->quantity_out = $si['quantity'];
                    }
                    $new_item->save();
                }
            }
        }

        if($kind_of_transaction == 'dispense'){
            event(new DispensePatientEvent($this->transaction_data));
        }
    }
}
