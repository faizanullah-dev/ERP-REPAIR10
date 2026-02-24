<?php


namespace App\Helpers;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use App\LogActivity as LogActivityModel;


class LogActivity
{
    use SoftDeletes;

    public static function addToLog(){
        $min_time_interval = 10;
        $current_time = Carbon::now()->timestamp;
        $last_activity = LogActivityModel::latest()->orderBy('created_at','desc')->first();
        if ($last_activity === null) {
            // No previous activity record found, insert a new record
            $log = [];
            $log['subject'] = 'Activity';
            $log['url']     = Request::fullUrl();
            $log['method']  = Request::method();
            $log['ip']      = Request::ip();
            $log['agent']   = Request::header('user-agent');
            $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
            LogActivityModel::create($log);
        } else {
            // Check if the same activity occurred within the minimum time interval
            $last_activity_time = $last_activity->created_at->timestamp;
            if (Carbon::createFromTimestamp($last_activity_time)->diffInSeconds(Carbon::now()) >= $min_time_interval) {
                // Insert a new record for the activity
                $log = [];
                $log['subject'] = 'Activity';
                $log['url']     = Request::fullUrl();
                $log['method']  = Request::method();
                $log['ip']      = Request::ip();
                $log['agent']   = Request::header('user-agent');
                $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
                LogActivityModel::create($log);
            }//end if
        }//end elseif
    }


    public static function logActivityLists(){
        return LogActivityModel::latest()->orderBy('created_at','desc')->where('method','GET')->get();
    }//end function logActivityLists.
    public static function logActivityUsers(){
        return LogActivityModel::latest()->orderBy('created_at','desc')->where('method','GET')->where('user_id',auth()->user()->id)->get();
    }//end function logActivityUsers.


}