<?php

namespace App\Models\VisitModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_appointment';
    protected $dates = ['deleted_at'];
    protected $fillable = ['appointment_date', 'is_appointment', 'patient_id', 'facility_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'facility', 'patient_id'];
    protected $appends = array('facility_name');

    public function facility(){
        return $this->belongsTo('App\Models\FacilityModels\Facilities');
    }


    public function getFacilityNameAttribute(){
        $facility_name = null;
        if($this->facility){ $facility_name = $this->facility->name; }
        return $facility_name;
    }

}