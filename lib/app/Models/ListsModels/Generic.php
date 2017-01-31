<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Generic extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_generic';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
