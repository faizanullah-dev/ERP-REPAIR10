<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credits';

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
    protected $fillable = ['lead_id', 'invoice_id', 'amount', 'date', 'description'];
    public function getlead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function getInvoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
    
}
