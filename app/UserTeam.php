<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTeam extends Model
{
    use SoftDeletes;
    protected $table = 'user_teams';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getUserTeamDetail(){
        return $this->belongsTo(User::class, 'user_id');
    }//end function getUserTeamDetail.

    public function getteam(){
        return $this->HasMany(Team::class, 'id','team_id');
    }//end function getTeam
}
