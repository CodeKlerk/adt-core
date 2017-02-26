<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientProphylaxis extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient_prophylaxis'; 
    protected $fillable = ['patient_id', 'prophylaxis_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'prophylaxis'];
    protected $appends = array('prophylaxis_name');

    public function prophylaxis(){
        return $this->belongsTo('App\Models\ListsModels\Prophylaxis');
    }

    public function getProphylaxisNameAttribute(){
        $prophylaxis_name = null;
        if($this->prophylaxis){ $prophylaxis_name = $this->prophylaxis->name; }
        return $prophylaxis_name;
    }
}