<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailBranding extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_brandings';

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
    protected $fillable = ['pre_body_description', 'description', 'name', 'designation', 'phone', 'email', 'website', 'address', 'logo', 'logo_position', 'logo_alignment', 'logo_background', 'social_link_one', 'social_link_two', 'social_link_three', 'social_link_four'];

    
}
