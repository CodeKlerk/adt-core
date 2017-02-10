<?php

namespace App\Models\MapsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapsItem extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_maps_item';
    protected $fillable = [''];
    protected $dates = ['deleted_at'];
}
