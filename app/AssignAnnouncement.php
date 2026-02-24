<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignAnnouncement extends Model
{
    use SoftDeletes;
    protected $table = 'assign_announcements';
    protected $primaryKey = 'id';
    protected $appends = ['announcement'];
    protected $guarded = [];

    public function getAnnouncementUserTeam(){
        return $this->belongsTo(Team::class, 'team_id');
    }//end function getAnnouncementUserDetail.

    public function  getAssignAnnouncement(){
        return $this->hasMany(Announcement::class, 'id','announcement_id');
    }
    public function getAnnouncementAttribute(){
      return  Announcement::where('id',$this->announcement_id)->get();
    }
}
