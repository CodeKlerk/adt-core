<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NonAdherenceReason extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_non_adherence_reason';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
