<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;
    protected $table = 'campaigns';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getStages(){
        return $this->belongsTo(Stage::class,'stage_id');
    }//ends function getStages.

    public function getCampaignDetails(){
        return $this->hasMany(Campaign::class,'campaign_id');
    }//ends function getCampaignDetails.

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function leads() {
        return $this->belongsToMany(Lead::class, 'stage_id'); // Assuming 'lead_stage' is the pivot table name
    }

    public function campaignDetails()
    {
        return $this->hasOne(CampaignDetail::class, 'campaign_id');
    }

    public function getCampaignDetailMessage(){
        return $this->hasMany(CampaignDetail::class);
    }//ends function getCampaignDetails

}
