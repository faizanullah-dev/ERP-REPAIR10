<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $restrictedPatterns = [
        '/<\?php.*\?>/',                // PHP code injection
        '/<script.*>.*<\/script>/',     // JavaScript injection
        '/eval\(/',                     // eval() function
        '/base64_encode\(/',            // Base64 encoded code
        '/system\($_GET\[.*\]\)/',      // Command injection
        '/<iframe.*>.*<\/iframe>/',     // iframe injection
        '/onerror=.*>/i',               // onerror event handler
        '/alert\(/',                    // JavaScript alert()
        '/<meta.*http-equiv.*refresh.*content=.*>/i', // Meta refresh injection
        '/document\.location/',         // Document location change
        '/window\.location/',           // Window location change
        '/<.*on\w+=.*>/i',              // Inline event handlers (onerror, onclick, etc.)
    ];

    // Setter for the description attribute
    public function setDescriptionAttribute($value)
    {
        foreach ($this->restrictedPatterns as $pattern) {
            $value = preg_replace($pattern, '', $value);
        }
        $this->attributes['description'] = strip_tags(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }


    public function images(){
       return $this->hasMany(AppointmentAttachment::class,'appointment_id');
    }//end images function.
    public function getAppointmentAttendee(){
       return $this->hasMany(AppointmentAttendee::class,'appointment_id');
    }//end getfeatureAmenity function.
    public function getLead(){
        return $this->belongsTo(Lead::class,'appointment_for_lead_id');
    }//end function getLead.
    public function getCustomer(){
        return $this->belongsTo(User::class,'customer_id');
    }//end function getLead.

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'appointment_for_lead_id');
    }
    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }//end function customer
    public function getTeam(){
        return $this->belongsTo(Team::class, 'team_id');
    }
    public static function statusChangeAppointment($id, $status){
        return Appointment::where('id', $id)->update(['status' => $status]);
    }//end function statusChangeAppointment.


}
