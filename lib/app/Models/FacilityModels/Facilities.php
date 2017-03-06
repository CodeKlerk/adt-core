<?php

namespace App\Models\FacilityModels;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $table = 'tbl_facility';
    protected $fillable = [ 'code', 'name', 'postal_address', 
                            'email_address', 'phone_number', 'adult_age', 'service', 'weekday_max',
                            'weekend_max', 'county_id', 'county_sub_id', 'supporter_id', 'facility_type_id'
                          ];
    protected $hidden = [   'supporter_id', 'county_sub_id', 'created_at', 'updated_at', 'deleted_at', 
                            'facility_type_id', 'type_id', 'type', 'supporter_id', 'supporter', 'subcounty'
                        ];
    protected $appends = array('subcounty_name', 'supporter_name', 'type_name');

    public function subcounty(){
        return $this->belongsTo('App\Models\ListsModels\Sub_county', 'county_sub_id');
    }

    public function supporter(){
        return $this->belongsTo('App\Models\ListsModels\Supporter', 'supporter_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\FacilityModels\FacilityTypes', 'facility_type_id');
    }

    public function getSubcountyNameAttribute(){
        $subcounty_name = null;
        if($this->subcounty){ $subcounty_name = $this->subcounty->name; }
        return $subcounty_name;
    }

    public function getSupporterNameAttribute(){
        $supporter_name = null;
        if($this->supporter){ $supporter_name = $this->supporter->name; }
        return $supporter_name;
    }

    public function getTypeNameAttribute(){
        $type_name = null;
        if($this->type){ $type_name = $this->type->name; }
        return $type_name;
    }

}