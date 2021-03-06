<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegimenDrug extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_regimen_drug';
    protected $fillable = ['drug_id','regimen_id', 'source'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];

    public function drug(){
        return $this->belongsToMany('App\Models\DrugModels\Drug', 'drug_id');
    }
}