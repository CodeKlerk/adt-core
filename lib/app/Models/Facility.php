<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'tbl_facility';
    protected $fillable = ['code', 'name', 'postal_address', 'email_address', 'phone_number', 'adult_age', 'service', 'weekday_max'
    , 'weekend_max', 'county_id', 'county_sub_id', 'supporter_id'];
}