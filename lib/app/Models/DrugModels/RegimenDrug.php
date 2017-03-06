<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegimenDrug extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_regimen_drug';
    protected $fillable = ['drug_id','regimen_id', 'source', 'ccc_store_sp'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];

    public function drug(){
        return $this->belongsTo('App\Models\DrugModels\Drug', 'drug_id');
    }
}