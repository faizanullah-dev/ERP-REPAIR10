<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkForceHour extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'work_force_hours';

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
    protected $fillable = ['lead_id', 'task_id', 'user_id', 'time'];

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function getSchedule(){
        return $this->belongsTo(SchedulingTask::class, 'task_id', 'id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
