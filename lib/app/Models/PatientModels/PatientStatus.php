<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientStatus extends Model
{
    protected $table = 'tbl_patient_status';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'status_id', 'change_date'];
    public $timestamps = false;
}
