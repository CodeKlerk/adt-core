<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Familyplanning extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_family_planning';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

}