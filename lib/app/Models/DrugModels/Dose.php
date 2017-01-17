<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;

class Dose extends Model
{
    protected $table = 'tbl_dose';

    public function drug()
    {
       return $this->belongsTo('App\Models\DrugModels\Drug', 'id'); 
    }
}