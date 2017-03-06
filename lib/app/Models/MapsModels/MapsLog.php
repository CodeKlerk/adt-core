<?php

namespace App\Models\MapsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapsLog extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_maps_log';
    protected $fillable = ['status', 'maps_id', 'user_id'];
    protected $dates = ['deleted_at'];
}
