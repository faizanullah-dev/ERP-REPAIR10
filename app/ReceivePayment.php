<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivePayment extends Model
{
    use SoftDeletes;
    protected $table = 'receive_payments';
    protected $primaryKey = 'id';
    protected $guarded = ['view_lead'];

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function getPaymenttype(){
        return $this->belongsTo(PaymentType::class, 'payment_type');
    }
    public function invoice(){
        return$this->belongsTo(Invoice::class, 'invoice_id');
    }
}
