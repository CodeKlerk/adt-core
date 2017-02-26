<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTb extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient_tb';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'category', 'phase', 'start_date', 'end_date'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
}
