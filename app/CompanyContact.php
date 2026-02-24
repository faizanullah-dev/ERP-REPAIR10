<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyContact extends Model
{
    use SoftDeletes;

    protected $table = 'company_contacts';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }//ends function category


}
