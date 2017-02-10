<?php

namespace App\Models\MapsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapsLog extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_maps_log';
    protected $fillable = [''];
    protected $dates = ['deleted_at'];
}
