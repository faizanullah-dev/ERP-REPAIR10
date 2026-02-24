<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculatorSystem extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculator_systems';
    protected $primaryKey = 'id';
    protected $guarded = [];


}
