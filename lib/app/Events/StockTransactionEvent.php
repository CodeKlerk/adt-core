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
                    if($this->transaction_qty_type == 'in'){
                        $stock_items_quantity['quanty_in'] = $stock_item['quantity'];
                    }else{
                        $stock_items_quantity['quanty_out'] = $stock_item['quantity'];
                    }
                    // add patient_id to drug
                    $si = array_merge($stock_item, $new_stock_id, $stock_items_quantity);
                    // add stock item
                    StockItem::create($si);
                }
            }
        }
    }
}
