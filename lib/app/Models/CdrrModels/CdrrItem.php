<?php

namespace App\Models\CdrrModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CdrrItem extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_cdrr_item';
    protected $fillable = [''];
    protected $dates = ['deleted_at'];
}
