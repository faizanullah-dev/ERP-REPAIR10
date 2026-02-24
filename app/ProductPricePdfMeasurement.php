<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPricePdfMeasurement extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_price_pdf_measurements';

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

    public function productPriceAreaPitch(){
        return $this->hasMany(ProductPricePdfAreaPitch::class, 'product_price_pdf_measurement_id', 'id');
    }
    public function productPricePdfTotal(){
        return $this->hasMany(ProductPricePdfTotal::class, 'product_price_pdf_measurement_id', 'id');
    }
}
