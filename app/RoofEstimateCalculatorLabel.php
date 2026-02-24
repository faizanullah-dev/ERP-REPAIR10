<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateCalculatorLabel extends Model
{
    use SoftDeletes;
    protected $table = 'roof_estimate_calculator_labels';
    protected $primaryKey = 'id';
    protected $guarded = [];


}
