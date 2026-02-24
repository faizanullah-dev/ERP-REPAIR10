<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProposalTemplate extends Model
{
    use SoftDeletes;
    protected $table = 'proposal_templates';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ProposalTemplateAttachment::class,'template_id');
    }//end images function.

}//ends class ProposalTemplate.
