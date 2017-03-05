<?php

namespace App\Models\FacilityModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityTypes extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_facility_type';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}