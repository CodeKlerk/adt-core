<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit_item extends Model
{
    protected $table = 'tbl_visit_item';
    protected $fillable = ['duration', 'expected_pill_count', 'actual_pill_count', 'missed_pill_count', 'comment', 'visit_id', 'stock_id', 'dose_id', 'indication_id'];
    public $timestamps  = false;
    /**
    * function name: visit,
    * Links the tbl_visit_item table to the tbl_visit
    * Used to retrive the visit_item information on a particular visit
    */
    public function visit(){
        return $this->belongsTo('App\Visit', 'id', 'visit_id');
    }

    /**
    * function name: stock,
    * Links the tbl_visit_item table to the tbl_stock
    * Used to retrive the visit_item information on a particular stock
    */
    public function stock(){
        return $this->belongsTo('App\Stock', 'id', 'stock_id');
    }

    /**
    * function name: dose,
    * Links the tbl_visit_item table to the tbl_dose
    * Used to retrive the visit_item information on a particular dose
    */
    public function dose(){
        return $this->belongsTo('App\Dose', 'id', 'dose_id');
    }

    /**
    * function name: indication,
    * Links the tbl_visit_item table to the tbl_indication
    * Used to retrive the visit_item information on a particular indication
    */
    public function indication(){
        return $this->belongsTo('App\Indication', 'id', 'indication_id');
    }

}
