<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculatorEaveRake extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculator_eave_rakes';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
}
