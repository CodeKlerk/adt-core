<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class County extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_county';
    protected $fillable = ['name'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}