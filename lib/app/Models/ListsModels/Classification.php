<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Classification extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_classification';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
