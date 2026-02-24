<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersMailboxConfiguration extends Model
{
    use SoftDeletes;
    protected $table = 'users_mailbox_configurations';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user(){
       return $this->belongsTo(User::class);
    }//ends function getUser.


}//ends class.