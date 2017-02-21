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
    
    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities', 'facility_id');
    }
}
