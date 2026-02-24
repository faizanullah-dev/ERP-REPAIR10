<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActivity extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }//end function user.

}//end class.
