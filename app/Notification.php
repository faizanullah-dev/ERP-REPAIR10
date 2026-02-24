<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function lead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
