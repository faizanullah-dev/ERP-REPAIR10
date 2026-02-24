<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionBlock extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'position_blocks';

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
    protected $fillable = ['name', 'insurance_rate', 'pay_rate_weekly', 'total_yearly_pay', 'cost_of_insurance', 'pay_rate_type', 'van', 'aut_insurance', 'state_federal_payment', 'state_federal_amount'];

    
}
