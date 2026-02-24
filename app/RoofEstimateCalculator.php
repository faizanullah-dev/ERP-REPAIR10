<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculator extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculators';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function roofEstimateCalculatorLabels(){
        return $this->hasMany(RoofEstimateCalculatorLabel::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorLabels.

    public function roofEstimateCalculatorEaveRakes(){
        return $this->hasMany(RoofEstimateCalculatorEaveRake::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorEaveRakes.

    public function roofEstimateCalculatorFlatArea(){
        return $this->hasMany(RoofEstimateCalculatorFlatArea::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorFlatArea.

    public function roofEstimateCalculatorDownspouts(){
        return $this->hasMany(RoofEstimateCalculatorDownspout::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorDownspouts.

    public function roofEstimateCalculatorpreferred(){
        return $this->hasOne(Roofestimatecalculatorpreferd::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorPreferd.

    public function roofEstimateCalculatorSystem(){
        return $this->hasOne(RoofEstimateCalculatorSystem::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorSystem.

    public function roofEstimateCalculatorUnderFifteen(){
        return $this->hasOne(StoreRoofEstimateCalculatorUnderfifteenSQ::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorSystem.

    public function roofEstimateCalculatorFlatRoof(){
        return $this->hasOne(RoofEstimateCalculatorFlatRoof::class,'roof_estimate_calculator_id');
    }//end function roofEstimateCalculatorSystem.

    public function storeRoofEstimateCalculatorGutter(){
        return $this->hasOne(StoreRoofEstimateCalculatorGutter::class,'roof_estimate_calculator_id');
    }//ends function storeRoofEstimateCalculatorGutter.

    public function Lead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//ends function Lead.

    public function roofEstimateCalculatorSkylight(){
        return $this->hasMany(RoofEstimateSkylight::class,'roof_estimate_calculator_id');
    }//ends function storeRoofEstimateCalculatorGutter.
}
