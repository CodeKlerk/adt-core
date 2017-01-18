<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class PatientTb extends Model
{
    protected $table = 'tbl_patient_tb';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'category', 'phase', 'start_date', 'end_date'];
    public $timestamps = false;
}
