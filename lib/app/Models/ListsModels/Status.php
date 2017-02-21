<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'tbl_status';
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}