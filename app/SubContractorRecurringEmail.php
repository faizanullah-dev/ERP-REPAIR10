<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorRecurringEmail extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_recurring_emails';

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
    protected $fillable = ['email_template_id', 'subcontractor_id', 'insurance_type', 'no_of_days_before', 'same_agency', 'policy_expiry_date'];

    public function subcontractor(){
        return $this->belongsTo(User::class, 'subcontractor_id', 'id');
    }
}
