<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostOfGoodSold extends Model
{
    use SoftDeletes;
    protected $table = 'cost_of_good_solds';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }//ends function lead

    public function cogsSheetsDetails()
    {
        return $this->hasMany(CostOfGoodSoldSheet::class, 'cost_of_good_sold_id');
    }//ends function cogsSheets

}
