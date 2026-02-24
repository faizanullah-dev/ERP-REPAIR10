<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMailSend extends Model
{
    use SoftDeletes;
    protected $table = 'user_mail_sends';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }//end function getUser.
}//end model.
