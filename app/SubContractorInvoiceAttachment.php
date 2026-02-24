<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorInvoiceAttachment extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_invoice_attachments';

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
//    protected $fillable = ['invoice_id', 'product_name', 'quantity', 'rate', 'tax', 'total'];

    
}
