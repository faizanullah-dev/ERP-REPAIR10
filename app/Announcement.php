<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;
    protected $table = 'announcements';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getAnnouncementUser(){
        return $this->hasMany(AssignAnnouncement::class,'announcement_id');
    }//end function getWorkCrewJobRepresantative.


    public function getUserTeam(){
        return $this->hasMany(UserTeam::class,'team_id');
    }//end function getWorkCrewJobRepresantative.

}
