<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estimate extends Model
{
    use SoftDeletes;
    protected $table = 'estimates';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function images(){
        return $this->hasMany(EstimateAttachment::class,'estimate_id',$this->primaryKey);
    }//end function images

    public function getLead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//end function getLead.
}
