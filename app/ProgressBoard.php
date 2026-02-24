<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgressBoard extends Model
{
    use SoftDeletes;
    protected $table = 'progress_boards';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getprogressBoardCategory(){
        return $this->hasMany(ProgressBoardCategory::class,'progress_board_id');
    }//end function getprogressBoardCategory.

    public function getLead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//end function getLead.
}
