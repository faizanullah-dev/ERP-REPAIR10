<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgressBoardCategory extends Model
{
    use SoftDeletes;
    protected $table = 'progress_board_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['progress_board_id', 'category_id'];

    public function getCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }//end function getCategory.
    
}
