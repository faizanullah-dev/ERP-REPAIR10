<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculatorFlatRoof extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculator_flat_roofs';
    protected $primaryKey = 'id';
    protected $guarded = [];

}//ends class RoofEstimateCalculatorFlatRoof
