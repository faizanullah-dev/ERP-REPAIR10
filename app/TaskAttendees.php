<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAttendees extends Model
{
    protected $table = 'task_attendees';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function AttendeesDetail(){
        return $this->hasOne(User::class,'id','attendees_id');
    }//end FeatureAmenityDetail function.
}
