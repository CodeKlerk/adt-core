<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indication extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_indication';
    protected $fillable = ['name','code'];
    protected $dates = ['deleted_at'];
}