<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobNote extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_notes';

    /**
    * The database primary key value.
    *
    * @var string
     *
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['lead_id', 'description', 'status'];

    public function getLead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//end function getLead.


    public function images(){
        return $this->hasMany(JobNoteAttachment::class,'job_note_id');
    }//end images function.
}
