<?php

namespace App\Models\CdrrModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CdrrLog extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_cdrr_log';
    protected $fillable = ['status', 'user_id', 'cdrr_id'];
    protected $dates = ['deleted_at'];
}
