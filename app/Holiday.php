<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use SoftDeletes;
    protected $table = 'holidays';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getHoliday()
    {
        return $this->hasMany(HolidayDate::class, 'holiday_id', 'id');
    }
    
}
