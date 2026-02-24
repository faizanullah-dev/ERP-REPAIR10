<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getTaskAssignUser(){
        return $this->hasMany(TaskAssignUser::class,'task_id');
    }//end function getTaskAssignUser.

    public function images(){
        return $this->hasMany(TaskAttachment::class,'task_id');
    }//end function getTaskAssignUser.

    public function getLead(){
        return $this->belongsTo(Lead::class,'assign_to_lead_id',$this->primaryKey);
    }//ends function getLead.
    

    public function getPriority(){
        return $this->belongsTo(Priority::class,'priority_id');
    }//ends function getPriority.

    public function team(){
        return $this->belongsTo(Team::class,'assign_to_team_id');
    }//ends function team.
}
