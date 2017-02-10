<?php

namespace App\Models\UserModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AccessLevel extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_access_level';
    protected $fillable = ['name', 'description'];
    protected $dates = ['deleted_at'];
}
