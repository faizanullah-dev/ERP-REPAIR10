<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadStage extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lead_stages';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['view_lead'];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id')->withTrashed();
    }

}
