<?php

namespace App\Models\DrugModels;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = 'tbl_drug';
    protected $fillable = ['name', 'pack_size', 'duration', 'quantity', 'is_arv', 'is_tb', 'deleted_at', 'unit_id', 'dose_id', 'generic_id', 'supporter_id'];
    
}