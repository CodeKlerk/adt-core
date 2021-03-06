<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purpose extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_purpose';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}