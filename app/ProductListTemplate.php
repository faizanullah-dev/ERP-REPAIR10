<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductListTemplate extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_list_templates';

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
    protected $fillable = ['template_id', 'product_id', 'sort_index'];

    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    public function getTemplate(){
        return $this->belongsTo(ProductTemplate::class, 'template_id', 'id');
    }
}
