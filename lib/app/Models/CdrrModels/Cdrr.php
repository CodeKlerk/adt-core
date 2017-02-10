<?php

namespace App\Models\CdrrModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cdrr extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_cdrr';
    protected $fillable = [ 'status', 'code', 'period_begin', 'period_end', 
                            'comments', 'reports_expected', 'reports_actual', 
                            'services', 'is_non_arv', 'facility_id', 'supporter_id' ];
    protected $dates = ['deleted_at'];
}
