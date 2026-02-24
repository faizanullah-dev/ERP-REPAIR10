<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';

    protected $primaryKey = 'id';

    protected $guarded = [];


    public function getInvoiceAttachments(){
        return $this->hasMany(InvoiceAttachment::class,'invoice_id');
    }//ends function getInvoiceAttachments.

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function getCustomer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    


}
