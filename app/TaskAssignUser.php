<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAssignUser extends Model
{
    use SoftDeletes;
    protected $table = 'task_assign_users';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getUserDetails(){
        return $this->belongsTo(User::class,'user_id');
    }//ends function getUserDetails.




}
