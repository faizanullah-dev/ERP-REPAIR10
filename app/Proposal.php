<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use SoftDeletes;
    protected $table = 'proposals';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ProposalAttachment::class,'proposal_id');
    }//end function images
    public function getLead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }//end function getLead.
    public function getProposalTemplates(){
        return $this->belongsTo(ProposalTemplate::class, 'proposal_template_id');
    }
}
