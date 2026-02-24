<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculatorDownspout extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculator_downspouts';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
}
