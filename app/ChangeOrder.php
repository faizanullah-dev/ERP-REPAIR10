<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeOrder extends Model
{
    use SoftDeletes;

    protected $table = 'change_orders';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }//end function getLead.

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id', 'lead');
    }

    public function getChangeOrderAttachments(){
        return $this->HasMany(ChangeOrderAttachment::class,'change_order_id');
    }//ends function getChangeOrderAttachments.
}
