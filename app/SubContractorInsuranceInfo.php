<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorInsuranceInfo extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_insurance_infos';

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
    protected $fillable = ['subcontractor_id', 'workers_compensation_insurance_company_info', 'workers_compensation_contact_name', 'workers_compensation_phone', 'workers_compensation_email', 'workers_compensation_insurance_carrier', 'workers_compensation_policy_eff', 'workers_compensation_policy_exp', 'workers_compensation_attachment', 'workers_compensation_attachment_date', 'general_liability_insurance_company_info', 'general_liability_contact_name', 'general_liability_phone', 'general_liability_email', 'general_liability_insurance_carrier', 'general_liability_policy_eff', 'general_liability_policy_exp', 'general_liability_attachment', 'general_liability_attachment_date', 'auto_insurance_company_info', 'auto_contact_name', 'auto_phone', 'auto_email', 'auto_insurance_carrier', 'auto_policy_eff', 'auto_policy_exp', 'auto_attachment', 'auto_attachment_date'];

    
}
