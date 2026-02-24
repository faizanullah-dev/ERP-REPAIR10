<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialListing extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'material_listings';

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
    protected $fillable = ['lead_id', 'material_id', 'quantity', 'status', 'delivery_date'];

//    public function getMaterial(){
//        return $this->belongsTo(Material::class, 'material_id', 'id');
//    }
    public function getMaterial(){
        return $this->belongsTo(Product::class, 'material_id', 'id');
    }
    
}
