<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Instruction extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_instruction';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
}