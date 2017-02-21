<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = 'tbl_county';
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}