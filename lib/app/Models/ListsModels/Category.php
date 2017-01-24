<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_category';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}