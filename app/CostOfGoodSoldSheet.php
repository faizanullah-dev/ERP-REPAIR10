<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostOfGoodSoldSheet extends Model
{
    use SoftDeletes;
    protected $table = 'cost_of_good_solds_sheet';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function cogsMaterial()
    {
        return $this->belongsTo(CogsMaterial::class, 'cogs_material_id');
    }//ends function cogsMaterial

}
