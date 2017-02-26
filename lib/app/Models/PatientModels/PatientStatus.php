<?php

namespace App\Models\PatientModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientStatus extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_patient_status';
    protected $fillable = ['patient_id', 'status_id'];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $apends = array('status_name');

    public function status(){
        return $this->belongsTo('App\Models\ListsModels\Status', 'id','status_id');
    }

    public function getStatusNameAttribute(){
        $status_name = null;
        if($this->status){ $status_name = $this->status->name; }
        return $status_name;
    }
}
