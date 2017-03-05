<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_store';
    protected $fillable = ['name', 'type','facility_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'facility_id', 'facility'];
    protected $appends = array('facility_name');

    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities', 'facility_id');
    }

    public function getFacilityNameAttribute(){
        $facility_name = null;
        if($this->facility){ $facility_name = $this->facility->name; }
        return $facility_name;
    }

}
