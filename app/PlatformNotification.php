<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformNotification extends Model
{
    use SoftDeletes;
    protected $table = 'platform_notifications';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }
        public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getReceivePayment(){
        return $this->belongsTo(ReceivePayment::class, 'lead_id');
    }
}
