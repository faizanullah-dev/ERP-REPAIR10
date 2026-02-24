<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentAttendee extends Model
{
    use SoftDeletes;
    protected $table = 'appointment_attendees';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function AttendeesDetail(){
        return $this->hasOne(User::class,'id','attendees_id');
    }//end FeatureAmenityDetail function.
}
