<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchedulingTask extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scheduling_tasks';

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
    protected $guarded = [];

    public function getSchedulingUser(){
        return $this->hasMany(SchedulingTaskUser::class, 'scheduling_task_id', 'id');
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function getTeam(){
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
