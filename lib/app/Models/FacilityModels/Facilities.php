<?php

namespace App\Models\FacilityModels;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $table = 'tbl_facility';
    protected $fillable = ['code', 'name', 'postal_address', 'email_address', 'phone_number', 'adult_age', 'service', 'weekday_max'
    , 'weekend_max', 'county_id', 'county_sub_id', 'supporter_id', 'facility_type_id'];
    protected $hidden = ['supporter_id', 'county_sub_id', 'created_at', 'updated_at', 'deleted_at', 'county_id', 'facility_type_id'];
    public function subcounty(){
        return $this->belongsTo('App\Models\ListsModels\Sub_county', 'county_sub_id');
    }

    public function supporter(){
        return $this->belongsTo('App\Models\ListsModels\Supporter', 'supporter_id');
    }

    public function county(){
        return $this->belongsTo('App\Models\ListsModels\County', 'county_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\FacilityModels\FacilityTypes', 'facility_type_id');
    }

}