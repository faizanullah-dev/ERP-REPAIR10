<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorReceiveable extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_receiveables';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
//    protected $fillable = ['invoice_id', 'lead_id', 'payment_type', 'date', 'amount', 'created_by'];

    public function getInvoice(){
        return $this->belongsTo(SubContractorInvoice::class, 'invoice_id', 'id');
    }

    public function getPaymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type', 'id');
    }

    public function getJob(){
        return $this->belongsTo(SchedulingTask::class, 'job_id', 'id');
    }
    
}
