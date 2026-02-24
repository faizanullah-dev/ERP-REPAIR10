<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPricingEstimateCalculator extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_pricing_estimate_calculators';

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

    public function productPricingEstimateCalculatorLabels(){
        return $this->hasMany(ProductPricingEstimateCalculatorLabel::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorLabels.

    public function productPricingEstimateCalculatorEaveRakes(){
        return $this->hasMany(ProductPricingEstimateCalculatorEaveRake::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    public function productPricingEstimateCalculatorFlatArea(){
        return $this->hasMany(ProductPricingEstimateCalculatorFlatArea::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    public function productPricingEstimateCalculatorDownspout(){
        return $this->hasMany(ProductPricingEstimateCalculatorDownspout::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    public function productPricingEstimateCalculatorMaterialList(){
        return $this->hasMany(StoreProductPricingMaterialList::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    public function productPricingEstimateCalculatorPriceList(){
        return $this->hasMany(ProductPricingPriceList::class,'product_pricing_calculator_id');
    }//end function sidingEstimateCalculatorEaveRakes.
    public function productPricingPdfMeasurement(){
        return $this->hasMany(ProductPricePdfMeasurement::class, 'product_pricing_calculator_id', 'id');
    }
    public function Lead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//ends function Lead.
}
