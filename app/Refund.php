<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'refunds';

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
    protected $fillable = ['lead_id', 'invoice_id', 'payment_type_id', 'amount', 'date', 'description'];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function getInvoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

}
