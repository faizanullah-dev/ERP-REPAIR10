<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUpCallNote extends Model
{
    use SoftDeletes;
    protected $table = 'follow_up_call_notes';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function getLead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//end function getLead.

    public function getMark(){
        return $this->belongsTo(Mark::class,'mark_id');
    }//end function getMark.

    public function getFollowUpCallNoteUser(){
        return $this->hasMany(FollowUpCallNotesUser::class,'follow_up_call_note_id');
    }//end function getFollowUpCallNoteUser.
}
