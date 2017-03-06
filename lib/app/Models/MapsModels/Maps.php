<?php

namespace App\Models\MapsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maps extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_maps';
    protected $fillable = ['status', 'code', 'period_begin', 'period_end', 'reports_expected', 
                            'reports_actual', 'services', 'comments', 'facility_id', 'supporter_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'facility_id', 'supporter_id', 'facility', 'supporter'];
    protected $appends = array('facility_name', 'supporter_name');

    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities', 'facility_id');
    }
    public function supporter(){
        return $this->belongsTo('App\Models\ListsModels\Supporter', 'supporter_id');
    }

    public function getFacilityNameAttribute(){
        $facility_name = null;
        if($this->facility){ $facility_name = $this->facility->name; }
        return $facility_name;
    }
    public function getSupporterNameAttribute(){
        $drug_supporter = null;
        if($this->supporter){ $drug_supporter = $this->supporter->name; }
        return $drug_supporter;
    }
}
