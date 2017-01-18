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

}