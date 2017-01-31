<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pepreason extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_pepreason';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

}