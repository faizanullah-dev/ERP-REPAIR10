<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Lead;

class Stage extends Model
{
    use SoftDeletes;
    protected $table = 'stages';
    protected $primaryKey = 'id';
    protected $appends = ['stageCount','LeadPrice'];
    protected $guarded = [];

//    public function getStageCountAttribute(){
//        return Lead::where('stage_id',$this->id)->count();
//    }//end function getstagecountAttributes.

//    public function getStageCountAttribute()
//    {
//        $user = auth()->user();
//        $query = Lead::where('stage_id', $this->id);
//        if (!$user->hasRole('user')) {
//            $query->where(function ($q) use ($user) {
//                $q->where('customer_id', $user->id)
//                    ->orWhere('representative_id', $user->id);
//            });
//        }//ends if...
//        return $query->count();
//    } //end function getStageCountAttribute

    public function getStageCountAttribute()
    {
        $user = auth()->user();
        $query = Lead::where('stage_id', $this->id);

        // Apply year filter if `year` is present in the request
        if (request('year')) {
            $selectedYear = request('year');
            $query->whereYear('lead_date', $selectedYear);
        }

        if (!$user->hasRole('user')) {
            $query->where(function ($q) use ($user) {
                $q->where('customer_id', $user->id)
                    ->orWhere('representative_id', $user->id);
            });
        }

        return $query->count(); // Return lead count
    }

//    public function getLeadPriceAttribute() {
//        $user = auth()->user();
//        $query = Lead::where('stage_id', $this->id);
//        if (!$user->hasRole('user')) {
//            $query->where(function ($q) use ($user) {
//                $q->where('customer_id', $user->id)
//                    ->orWhere('representative_id', $user->id);
//            });
//        }
//        $leadPrice = $query->get();
//        $priceTotalLead = $leadPrice->sum('lead_price');
//        return $priceTotalLead;
//    }//end function getLeadPriceAttribute.
    public function getLeadPriceAttribute()
    {
        $user = auth()->user();
        $query = Lead::where('stage_id', $this->id);

        // Apply year filter if a 'year' parameter exists in the request
        if (request('year')) {
            $selectedYear = request('year');
            $query->whereYear('lead_date', $selectedYear); // Filter by selected year
        }

        // Apply role-based filtering for non-user roles
        if (!$user->hasRole('user')) {
            $query->where(function ($q) use ($user) {
                $q->where('customer_id', $user->id)
                    ->orWhere('representative_id', $user->id);
            });
        }

        // Calculate the total amount from related ChangeOrder
        $changeOrderTotal = $query->get()
            ->flatMap(function ($lead) {
                return $lead->getChangeOrder; // Access related ChangeOrders
            })
            ->where('status', 'approved') // Filter by status
            ->sum('total_amount'); // Sum total_amount from ChangeOrders

        // Return the total lead price + change order amount
        return $query->sum('lead_price') + $changeOrderTotal;
    }


    public function campaigns() {
        return $this->hasMany(Campaign::class, 'stage_id');
    }

    public function leadStages()
    {
        return $this->hasMany(LeadStage::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class, 'stage_id');
    }
}
