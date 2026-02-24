<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoofEstimateSkylight extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roof_estimate_skylights';

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
    protected $fillable = ['roof_estimate_calculator_id', 'product_id', 'quantity', 'price'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
