<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChimneyEstimateCalculator extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chimney_estimate_calculators';

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

    public function chimneyEstimateCalculatorLabels(){
        return $this->hasMany(ChimneyEstimateCalculatorLabel::class,'chimney_estimate_calculator_id');
    }//end function sidingEstimateCalculatorLabels.

    public function chimneyEstimateCalculatorBricksRows(){
        return $this->hasMany(ChimneyEstimateBricksRow::class,'chimney_estimate_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    
    public function Lead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }
    public function storeChimney(){
        return $this->hasOne(StoreChimneyEstimateCalculatorChimney::class,'chimney_estimate_calculator_id');
    }

    public function storeLiner(){
        return $this->hasOne(StoreChimneyEstimateCalculatorLiner::class,'chimney_estimate_calculator_id');
    }
}
