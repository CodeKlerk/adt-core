<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientViralload extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_patient_viralload';
    protected $dates = ['deleted_at'];
    protected $fillable = ['patient_id', 'test_date', 'result', '	justification'];
    public $timestamps = false;
}
