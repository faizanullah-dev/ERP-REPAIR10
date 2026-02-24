<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeOrderAttachment extends Model
{
    use SoftDeletes;

    protected $table = 'change_order_attachments';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
