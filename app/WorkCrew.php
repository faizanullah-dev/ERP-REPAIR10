<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkCrew extends Model
{
    use SoftDeletes;
    protected $table = 'work_crews';
    protected $primaryKey = 'id';
    protected $fillable = ['lead_id', 'category_id'];


    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }//end function getLead

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id');
    }//end function getCategory.

    public function getWorkCrewJobRepresantative(){
        return $this->hasMany(WorkCrewJobRepresentative::class,'work_crew_id');
    }//end function getWorkCrewJobRepresantative.

    public function getWorkCrewCompanyCrew(){
        return $this->hasMany(WorkCrewCompanyCrew::class,'work_crew_id');
    }//end function getWorkCrewCompanyCrew.

    public function getWorkCrewLabour(){
        return $this->hasMany(WorkCrewLabour::class,'work_crew_id');
    }//end function getWorkCrewLabour.
}
