<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_service';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    public function regimen(){
        return $this->hasMany('App\Models\ListsModels\Regimen', 'service_id');
    }
}