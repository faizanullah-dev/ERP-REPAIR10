<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearEstimation extends Model
{
    use SoftDeletes;
    protected $table = 'year_estimations';
    protected $appends = ['leadsum'];
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function months(){
        return $this->hasMany(YearEstimateMonth::class,'year_estimation_id');
    }//end months function.

    public function getLeadSumAttribute(){
        return Lead::where('lead_status','won')->whereYear('lead_date',$this->year)->sum('lead_price');
    }//end getLeadSumAttribute function.

}//ends class.
