<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sub_county extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_county_sub';
    protected $fillable = ['name', 'county_id'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
}