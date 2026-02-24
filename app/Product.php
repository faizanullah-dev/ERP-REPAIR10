<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function getMaterial(){
        return $this->belongsTo(Product::class, 'material_id', 'id');
    }
    public function getMaterialData(){
        return $this->belongsTo(MaterialListing::class, 'id', 'material_id');
    }

    public function getCategoryNamesAttribute()
    {
        $categoryIds = json_decode($this->default_category, true) ?? [];
        $categories = Category::whereIn('id', $categoryIds)->get();
        return $categories->pluck('name')->implode(', ');
    }

    public function templateProduct(){
        return $this->belongsTo(ProductListTemplate::class, 'product_id', 'id');
    }

}
