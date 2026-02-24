<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Psy\Util\Str;
use Illuminate\Support\Facades\HTML;

class Lead extends Model
{
    use SoftDeletes;
    protected $table = 'leads';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected static function booted()
    {
        static::saving(function ($lead) {
            if ($lead->description) {
                $lead->description = preg_replace('/<\?php.*?\?>/s', '', $lead->description); // Remove PHP tags
                $lead->description = preg_replace('/<script.*?<\/script>/is', '', $lead->description); // Remove <script> tags
            }
        });
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }//end function customer
    public function user(){
        return $this->belongsTo(User::class,'customer_id');
    }//end function customer
    public function representative(){
        return $this->belongsTo(User::class,'representative_id');
    }//end function representative
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }//end function category
    public function getphotoandDocument(){
        return $this->hasMany(PhotoAndDocument::class,'lead_id',$this->primaryKey);
    }//end function getphotoandDocument.
    public function getAppointment(){
        return $this->hasMany(Appointment::class,'appointment_for_lead_id',$this->primaryKey);
    }//end function getAppointment.
    public function getTasks(){
        return $this->hasMany(Task::class,'assign_to_lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getJobNotes(){
        return $this->hasMany(JobNote::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getfollowupcallnotes(){
        return $this->hasMany(FollowUpCallNote::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getMaterials(){
        return $this->hasMany(Material::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getReceivePayments(){
        return $this->hasMany(ReceivePayment::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getProgressBoard(){
        return $this->hasMany(ProgressBoard::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getProposal(){
        return $this->hasMany(Proposal::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getChangeOrder(){
        return $this->hasMany(ChangeOrder::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getInvoice(){
        return $this->hasMany(Invoice::class,'lead_id',$this->primaryKey);
    }//end function getTasks.
    public function getStage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }//end function getStage.

    public function stages(){
        return $this->hasMany(LeadStage::class, 'lead_id')->where('status', 1);
    }//ends function stages

    public function leadStages(){
        return $this->hasMany(LeadStage::class);
    }//ends function leadStages
    public function companyInsurrance(){
        return $this->belongsTo(CompanyContact::class,'company_id');
    }//ends function companyInsurrance

    public function notifications(){
        return $this->hasMany(Notification::class, 'lead_id');
    }//ends function notifications
    public function roofEstimateCalculator(){
        return $this->hasOne(RoofEstimateCalculator::class, 'lead_id');
    }//ends function roofEstimateCalculator
    public function sidingEstimateCalculator(){
        return $this->hasOne(SidingEstimateCalculator::class, 'lead_id');
    }
    public function chimneyEstimateCalculator(){
        return $this->hasOne(ChimneyEstimateCalculator::class, 'lead_id');
    }
    public function productPricingEstimateCalculator(){
        return $this->hasOne(ProductPricingEstimateCalculator::class, 'lead_id');
    }
    public function getFolderManagement(){
        return $this->hasMany(FolderManagement::class, 'lead_id');
    }
    public function call(){
        return $this->hasMany(Call::class, 'lead_id');
    }

    public function schedulingTask(){
        return $this->hasMany(SchedulingTask::class, 'lead_id');
    }
    public function getCredit(){
        return $this->hasMany(Credit::class, 'lead_id');
    }
    public function getRefund(){
        return $this->hasMany(Refund::class, 'lead_id', 'id');
    }

    public function chatMessages(){
        return $this->hasMany(ChatMessage::class, 'lead_id', 'id');
    }

    public function getMaterialListing(){
        return $this->hasMany(MaterialListing::class,'lead_id',$this->primaryKey);
    }

    public function costOfGoodSolds(){
        return $this->hasMany(CostOfGoodSold::class,'lead_id',$this->primaryKey);
    }

    public function getCommission(){
        return $this->hasMany(WorkForceHour::class, 'lead_id', $this->primaryKey);
    }
}
