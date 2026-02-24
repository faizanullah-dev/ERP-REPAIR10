<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CogsMaterial extends Model
{
    use SoftDeletes;
    protected $table = 'cogs_materials';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
}
