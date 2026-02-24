<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }//end function getLead.

    public function images(){
        return $this->hasMany(MaterialAttachment::class, 'material_id');
    }//end function images().

    public function getmaterialDeliveryDates(){
        return $this->hasMany(MaterialDeliveryDate::class, 'material_id');
    }//end function images().


}
