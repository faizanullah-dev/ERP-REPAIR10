<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidingEstimateCalculator extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'siding_estimate_calculators';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public function sidingEstimateCalculatorLabels(){
        return $this->hasMany(SidingEstimateCalculatorLabel::class,'siding_estimate_calculator_id');
    }//end function sidingEstimateCalculatorLabels.

    public function sidingEstimateCalculatorEaveRakes(){
        return $this->hasMany(SidingEstimateCalculatorEaveRake::class,'siding_estimate_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.

   
    public function sidingEstimateCalculatorGuttersDownspouts(){
        return $this->hasMany(SidingEstimateCalculatorGuttersDownSpout::class,'siding_estimate_calculator_id');
    }//end function sidingEstimateCalculatorDownspouts.


    public function storeSidingEstimateCalculatorGutter(){
        return $this->hasOne(StoreSideEstimateCalculatorGutter::class,'siding_estimate_calculator_id');
    }//ends function storeSidingEstimateCalculatorGutter.

    public function Lead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }

    public function sideEstimateCalculatorReplacement(){
        return $this->hasOne(StoreSideEstimateReplacement::class,'side_estimate_calculator_id');
    }//end function roofEstimateCalculatorSystem.

    public function storeSidingOverExisting(){
        return $this->hasOne(StoreSideEstimateOverExist::class,'side_estimate_calculator_id');
    }//end function roofEstimateCalculatorSystem.
}
