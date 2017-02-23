<?php

namespace App\Models\ListsModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dose extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_dose';
    protected $fillable = ['name', 'quantity', 'frequency'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function drug()
    {
       return $this->belongsTo('App\Models\DrugModels\Drug', 'id'); 
    }
}