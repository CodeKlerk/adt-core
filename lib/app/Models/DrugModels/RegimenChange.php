<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegimenChange extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_regimen_change';
    protected $fillable = ['last_regimen_id', 'change_reason_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
}