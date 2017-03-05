<?php

namespace App\Events;

use App\Models\InventoryModels\Stock;
use App\Models\InventoryModels\StockItem;

class StockTransactionEvent extends Event
{
    protected $transaction_data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->transaction_data = $data;
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
                    // add stock item
                    StockItem::create($si);
                }
            }
        }
    }
}
