<?php

namespace App\Http\Controllers\UserCheckIn;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SchedulingTask;
use App\UserCheckIn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserCheckInController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usercheckin = UserCheckIn::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('check_in', 'LIKE', "%$keyword%")
                ->orWhere('check_out', 'LIKE', "%$keyword%")
                ->orWhere('total_hours', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $usercheckin = UserCheckIn::paginate($perPage);
            }

            return view('userCheckIn.user-check-in.index', compact('usercheckin'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('userCheckIn.user-check-in.create');
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            UserCheckIn::create($requestData);
            return redirect('userCheckIn/user-check-in')->with('flash_message', 'UserCheckIn added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $usercheckin = UserCheckIn::findOrFail($id);
            return view('userCheckIn.user-check-in.show', compact('usercheckin'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $usercheckin = UserCheckIn::findOrFail($id);
            return view('userCheckIn.user-check-in.edit', compact('usercheckin'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $usercheckin = UserCheckIn::findOrFail($id);
             $usercheckin->update($requestData);

             return redirect('userCheckIn/user-check-in')->with('flash_message', 'UserCheckIn updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('usercheckin','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            UserCheckIn::destroy($id);

            return redirect('userCheckIn/user-check-in')->with('flash_message', 'UserCheckIn deleted!');
        }
        return response(view('403'), 403);

    }
    public function storeCheckIn(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $date = now()->toDateString();
            $existingSession = UserCheckIn::where('user_id', $user_id)
                ->where('date', $date)
                ->whereNull('check_out')
                ->first();
            if ($existingSession) {
                return response()->json([
                    'status' => 'Session already running',
                    'check_in' => $existingSession->check_in
                ]);
            }
            $checkIn = UserCheckIn::create([
                'user_id' => $user_id,
                'date' => $date,
                'check_in' => now(),
                'check_out' => null,
                'total_hours' => 0,
                'status' => 'running'
            ]);

            return response()->json([
                'status' => 'Session started',
                'check_in' => $checkIn->check_in
            ]);

        } catch (Exception $e) {
            Log::error('Error in storeCheckIn: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeCheckOut(Request $request){
//        return $request->all();
        try {
            $user_id = $request->input('user_id');
            if (!$user_id) {
                throw new Exception('User ID is required.');
            }
            $time = $request->total_resume_time;
            $session = UserCheckIn::where('user_id', $user_id)
                ->whereNull('check_out')
                ->first();
            if (!$session) {
                throw new Exception('No active session found for the user.');
            }
            $checkInTime = Carbon::parse($session->check_in);
            $checkOutTime = Carbon::now();
            $diffInSeconds = $checkInTime->diffInSeconds($checkOutTime);
            $hours = floor($diffInSeconds / 3600);
            $minutes = floor(($diffInSeconds % 3600) / 60);
            $seconds = $diffInSeconds % 60;
            $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            $currentDate = Carbon::today()->toDateString();

            $schedulingTasks = SchedulingTask::join('scheduling_task_users', 'scheduling_task_users.scheduling_task_id', '=', 'scheduling_tasks.id')
                ->join('leads', 'scheduling_tasks.lead_id', '=', 'leads.id')
                ->where('scheduling_task_users.user_id', $user_id)
                ->whereRaw("STR_TO_DATE(scheduling_tasks.start_date, '%Y-%m-%d') <= ?", [$currentDate])
                ->whereRaw("STR_TO_DATE(scheduling_tasks.end_date, '%Y-%m-%d') >= ?", [$currentDate])
                ->select('scheduling_tasks.*', 'leads.title as lead_title')
                ->get();

            $session->update([
                'check_out' => $checkOutTime,
                'total_hours' => $time,
                'status' => 'stopped'
            ]);
            return response()->json([
                'status' => 'Session stopped successfully',
                'check_out' => $session->check_out,
                'total_hours' => $hours + ($minutes / 60) + ($seconds / 3600),
                'formatted_time' => $formattedTime,
                'hour_text' => $hours . ' hour' . ($hours != 1 ? 's' : ''),
                'minute_text' => $minutes . ' minute' . ($minutes != 1 ? 's' : ''),
                'second_text' => $seconds . ' second' . ($seconds != 1 ? 's' : ''),
                'scheduling_task' => $schedulingTasks,
            ]);
        } catch (Exception $e) {
            Log::error('Error in storeCheckOut: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getActiveSession(Request $request){
        try {
            $user_id = auth()->user()->id;
            $session = UserCheckIn::where('user_id', $user_id)
                ->whereNull('check_out')
                ->first();
            $sessionsToday = UserCheckIn::where('user_id', $user_id)
                ->whereDate('check_in', Carbon::today())
                ->get();
            $totalTimeToday = 0;
            foreach ($sessionsToday as $sessionToday) {
                if ($sessionToday->total_hours) {
                    $totalHours = Carbon::parse($sessionToday->total_hours);
                    $totalTimeToday += $totalHours->hour * 3600 + $totalHours->minute * 60 + $totalHours->second;
                }
            }
            if ($session) {
                $checkIn = Carbon::parse($session->check_in);
                $elapsedTime = $checkIn->diffInSeconds(Carbon::now());
                return response()->json([
                    'status' => 'running',
                    'check_in' => $session->check_in,
                    'elapsed_time' => $elapsedTime,
                    'total_time_today' => $totalTimeToday,
                ]);
            } else {
                return response()->json([
                    'status' => 'No active session',
                    'total_time_today' => $totalTimeToday,  // Always return total time for today
                ]);
            }
        } catch (Exception $e) {
            Log::error('Error in getActiveSession: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function pauseSession(Request $request){
        try {
            $user_id = auth()->user()->id;
            $session = UserCheckIn::where('user_id', $user_id)
                ->whereNull('check_out')
                ->first();
            if ($session) {
                $session->update([
                    'status' => 'paused',
                ]);
                return response()->json([
                    'status' => 'Session paused',
                ]);
            } else {
                return response()->json([
                    'status' => 'No active session',
                ], 404);
            }

        } catch (Exception $e) {
            Log::error('Error in pauseSession: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
