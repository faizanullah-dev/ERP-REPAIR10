<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreRoofEstimateCalculatorGutter extends Model
{
    use SoftDeletes;
    protected $table = 'store_roof_estimate_calculator_gutters';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
