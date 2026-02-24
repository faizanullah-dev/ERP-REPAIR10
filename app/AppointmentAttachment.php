<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'appointment_attachments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    
}
