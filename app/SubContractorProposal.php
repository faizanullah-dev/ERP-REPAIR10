<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubContractorProposal extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_contractor_proposals';

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
    protected $guarded = [];

    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function getProposal(){
        return $this->belongsTo(ProposalTemplate::class, 'proposal_template_id', 'id');
    }
}
