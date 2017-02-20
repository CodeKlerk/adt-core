<?php

namespace App\Models\InventoryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_store';
    protected $fillable = ['name', 'type','facility_id'];
    protected $dates = ['deleted_at'];
}
