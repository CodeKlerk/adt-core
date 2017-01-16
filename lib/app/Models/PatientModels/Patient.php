<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'tbl_patient';
    protected $fillable = ['ccc_number', 'first_name', 'last_name',
     'other_name', 'phone_number', 'alternate_number', 'physical_address', 
     'gender', 'birth_date', 'enrollment_date', 'support_group', 'is_pregnant', 'is_tb', 'is_tb_tested', 
     'is_smoke', 'is_alchohol', 'is_sms', 'service_id', 'facility_id', 'supporter_id', 'source_id', 'county_sub_id', 'who_stage_id', 'status'];
}