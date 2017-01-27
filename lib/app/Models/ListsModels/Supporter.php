<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supporter extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_supporter';
    protected $fillable = ['name'];
    protected $dates = ['deleted_by'];
}