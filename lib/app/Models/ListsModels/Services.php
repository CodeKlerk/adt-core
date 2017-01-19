<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'tbl_service';

    public function regimen(){
        return $this->hasMany('App\Models\ListsModels\Regimen', 'service_id');
    }
}