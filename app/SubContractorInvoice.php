<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorInvoice extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_invoices';

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
//    protected $fillable = ['invoice_unique_id', 'lead_id', 'job_id', 'subcontractor_id', 'address', 'sub_total', 'tax', 'total', 'created_by', 'status', 'payment_status'];


        public function getJob(){
            return $this->belongsTo(SchedulingTask::class, 'job_id', 'id');
        }

        public function getLead(){
            return $this->belongsTo(Lead::class, 'lead_id', 'id');
        }

        public function getSubContractor(){
            return $this->belongsTo(User::class, 'subcontractor_id', 'id');
        }

        public function getProducts(){
            return $this->hasMany(SubContractorInvoiceAttachment::class, 'invoice_id', 'id');
        }

        public function creator(){
            return $this->belongsTo(User::class, 'created_by', 'id');
        }

        public function getReceivable(){
            return $this->belongsTo(SubContractorReceiveable::class, 'id', 'invoice_id');
        }

        public function receivables(){
            return $this->hasMany(SubContractorReceiveable::class, 'invoice_id', 'id');
        }
    
}
