<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersMailboxesSent extends Model
{
    use SoftDeletes;
    protected $table = 'users_mailboxes_sents';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
