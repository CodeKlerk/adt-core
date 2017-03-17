<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regimen extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_regimen';
    protected $fillables = ['name','code', 'service_id', 'category_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'category'];
    protected $dates = ['deleted_at'];
    protected $appends = array('category_name');

    public function drug(){
        return $this->belongsToMany('App\Models\DrugModels\Drug', 'tbl_regimen_drug');
    }

    public function category(){
        return $this->belongsTo('App\Models\ListsModels\Category', 'category_id');
    }

    public function getCategoryNameAttribute(){
        $category_name = null;
        if($this->category){ $category_name = $this->category->name; }
        return $category_name;
    }
}