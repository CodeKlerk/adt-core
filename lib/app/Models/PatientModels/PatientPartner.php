<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PatientPartner extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient_partner';
    protected $fillable = ['patient_id', 'partner_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // TODO : return partner ccc_number

}
