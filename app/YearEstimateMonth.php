<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearEstimateMonth extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'year_estimate_months';

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
    protected $guarded= [];
    // protected $fillable = ['year_estimation_id', 'name', 'percentage', 'amount', 'month_required_leads', 'month_needed_leads', 'extra_leads', 'extra_amount', 'status'];

    public function yearEstimation()
    {
        return $this->belongsTo(YearEstimation::class);
    }

}
