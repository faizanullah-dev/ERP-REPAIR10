<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Models\Activity;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected  $appends = ['AssignAnnouncement', 'UserTime', 'CurrentWeekHours', 'CurrentMonthHours'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function permissionsList()
    {
        $roles = $this->roles;
        $permissions = [];
        foreach ($roles as $role) {
            $permissions[] = $role->permissions()->pluck('name')->implode(',');
        }
        return collect($permissions);
    }

    public function permissions()
    {
        $permissions = [];
        $role = $this->roles->first();
        $permissions = $role->permissions()->get();
        return $permissions;
    }

    public function isAdmin()
    {

        $is_admin = $this->roles()->where('name', 'admin')->first();
        if ($is_admin != null) {
            $is_admin = true;
        } else {
            $is_admin = false;
        }
        return $is_admin;
    }
    public function staffPosition()
    {
        return $this->hasOne(StaffFinance::class, 'staff_id');
    }
    public function referralSource()
    {
        return $this->belongsTo(ReferralSource::class, 'referral_source_id');
    } //end function referralSource.
    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id');
    } //end function customerType
    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    } //ends function salesman
    public function customerPhones()
    {
        return $this->hasMany(CustomerPhone::class, 'customer_id');
    } //ends function customerPhones
    public function customerPhonePrimary()
    {
        return $this->hasOne(CustomerPhone::class, 'customer_id');
    } //ends function customerPhones
    public function activities()
    {
        return $this->hasMany(Activity::class, 'subject_id', 'id');
    } //ends function activities
    public function leads()
    {
        return $this->hasMany(Lead::class, 'representative_id');
    } //ends function leads
    public function getAssignAnnouncementAttribute()
    {
        return UserTeam::where('user_id', $this->id)->first();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    public function category()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
    public function customerLeads()
    {
        return $this->hasMany(Lead::class, 'customer_id');
    }

    public function customerCommunications()
    {
        return $this->hasMany(CustomerCommunication::class, 'user_id');
    }
    public function userCheckIn()
    {
        return $this->hasMany(UserCheckIn::class, 'user_id');
    }

    // Inside the User model

    public function getUserTimeAttribute()
    {
        // Fetch all distinct dates for the user
        $dates = UserCheckIn::where('user_id', $this->id)
            ->distinct()
            ->pluck('date');  // This will give us a collection of distinct dates
        $userTimes = [];
        foreach ($dates as $date) {
            $totalSeconds = UserCheckIn::where('user_id', $this->id)
                ->where('date', $date)
                ->get()
                ->sum(function ($checkIn) {
                    $timeParts = explode(':', $checkIn->total_hours);
                    $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                    $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;
                    $seconds = isset($timeParts[2]) ? (int)$timeParts[2] : 0;
                    return ($hours * 3600) + ($minutes * 60) + $seconds;
                });
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;
            $userTimes[$date] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return $userTimes;
    }
    // In your User model

    public function getCurrentWeekHoursAttribute()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $totalSeconds = UserCheckIn::where('user_id', $this->id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get()
            ->sum(function ($checkIn) {
                $timeParts = explode(':', $checkIn->total_hours);
                $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;
                $seconds = isset($timeParts[2]) ? (int)$timeParts[2] : 0;
                return ($hours * 3600) + ($minutes * 60) + $seconds;
            });
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }


    public function getCurrentMonthHoursAttribute()
    {
        $totalSeconds = UserCheckIn::where('user_id', $this->id)
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->get()
            ->sum(function ($checkIn) {
                $timeParts = explode(':', $checkIn->total_hours);
                $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;
                $seconds = isset($timeParts[2]) ? (int)$timeParts[2] : 0;
                return ($hours * 3600) + ($minutes * 60) + $seconds;
            });

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        // Return formatted time as hours
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function subContractorCompany()
    {
        return $this->hasOne(SubContractorCompanyDetail::class);
    }

    public function subContractorInsuranceInfo()
    {
        return $this->hasOne(SubContractorInsuranceInfo::class, 'subcontractor_id', 'id');
    }
    public function subContractorRecurringEmail()
    {
        return $this->hasMany(SubContractorRecurringEmail::class, 'subcontractor_id', 'id');
    }
    public function subContractorProposal()
    {
        return $this->hasMany(SubContractorProposal::class, 'sub_contractor_id', 'id');
    }

    public function subContractorJobs()
    {
        return $this->hasMany(SchedulingTask::class, 'subcontractor_id', 'id');
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'sender_id', 'id');
    }
}
