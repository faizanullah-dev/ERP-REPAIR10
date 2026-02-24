<?php

namespace App\Http\Controllers\SchedulingTask;

use App\Category;
use App\Notification;
use App\Team;
use App\YearEstimation;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\SchedulingTask;
use App\SchedulingTaskUser;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchedulingTaskController extends Controller
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

    public function index(Request $request, $id=null)
    {
        extract($request->all());
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $schedulingtask = SchedulingTask::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('assign_user', 'LIKE', "%$keyword%")
                    ->orWhere('start_date', 'LIKE', "%$keyword%")
                    ->orWhere('end_date', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $yearEstimation = YearEstimation::where('status',1)->first();
                $schedulingtask = SchedulingTask::with('getSchedulingUser')->where('lead_id', $request->lead_id)->get();
                $scheduling_task = SchedulingTask::with('getSchedulingUser')->where('id', $request->task_id)->first();
                $task = Task::get();
                $categories = Category::where('status', 1)->get();
                $leads = Lead::whereYear('lead_status_date', $yearEstimation->year)->get();
                $upcomingleads = SchedulingTask::whereRaw(
                    "STR_TO_DATE(end_date, '%Y-%m-%d') >= ?",
                    [Carbon::today()->format('Y-m-d')]
                )->get();
                $teams = Team::get();
                $scheduling_task_users = User::whereHas(
                    'roles', function($q){
                    $q->where('name','!=', 'user');
                    $q->where('name','!=', 'customer');
                    $q->where('name','!=', 'admin');
                })->get();
                $subcontractors = User::whereHas(
                    'roles', function($q){
                    $q->where('name', 'subcontractor');
                })->get();
            }
            if(!empty($lead_id)){
                $leadExist=lead::findorfail($lead_id);
                return view('schedulingTask.scheduling-task.index',compact('yearEstimation', 'leads','leadExist', 'schedulingtask', 'task', 'categories', 'scheduling_task_users', 'scheduling_task', 'teams', 'subcontractors'));
            }
            $categoryCounts = SchedulingTask::whereHas('getLead')->with('getLead')->get()->groupBy('getLead.category_id')->map->count();
            $query = SchedulingTask::with('getSchedulingUser');
            if ($request->filled('user_id')) {
                $query->whereHas('getSchedulingUser', function($q) use ($request) {
                    $q->whereIn('user_id', $request->input('user_id'));
                });
            }
            if ($request->filled('category_id')) {
                $query->whereHas('getLead', function($q) use ($request) {
                    $q->where('category_id', $request->input('category_id'));
                });
            }
            $schedulingtask = $query->with('getLead.getChangeOrder')->get();
            return view('schedulingTask.scheduling-task.index', compact('yearEstimation','categoryCounts', 'schedulingtask', 'leads', 'task', 'categories', 'scheduling_task_users', 'scheduling_task', 'teams', 'upcomingleads', 'subcontractors'));
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
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('schedulingTask.scheduling-task.create');
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
//        return $request->all();
        extract($request->all());
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $scheduling_task = SchedulingTask::create([
                'name' => $name ?? null,
                'lead_id' => $lead_id ?? null,
                'start_date' => $start_date ?? null,
                'end_date' => $end_date ?? null,
                'color_id' => $color_id ?? null,
                'team_id' => $team_id ?? null,
                'description' => $description ?? null,
                'subcontractor_id' => $subcontractor_id ?? null,
            ]);
            foreach($user_id as $value)
                SchedulingTaskUser::create([
                    'scheduling_task_id' => $scheduling_task->id,
                    'user_id' => $value ?? null,
                ]);
            if(isset($scheduling_task) && !empty($scheduling_task)) {
                Notification::create([
                    'icon' => 'fa fa-tasks' ?? null,
                    'lead_id' =>$lead_id ?? null,
                    'model' => 'Scheduling Task Create',
                    'title' => $name ?? null,
                    'time' => $scheduling_task->created_at ?? null,
                ]);
            }
            if(auth()->user()->hasRole('user')) {
                return redirect("schedulingTask/scheduling-task")->with('flash_message', 'SchedulingTask added!');
            }else{
            return redirect("schedulingTask/scheduling-task?lead_id={$request->lead_id}")->with('flash_message', 'SchedulingTask added!');
        }
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
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $schedulingtask = SchedulingTask::findOrFail($id);
            return view('schedulingTask.scheduling-task.show', compact('schedulingtask'));
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
    public function edit(Request $request, $id)
    {
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
//            $schedulingtask = SchedulingTask::findOrFail($id);
            return $scheduling_task = SchedulingTask::with('getSchedulingUser')->where('id', $request->task_id)->first();
            return view('schedulingTask.scheduling-task.edit', compact('scheduling_task'));
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
        return $request->all();
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $schedulingtask = SchedulingTask::findOrFail($id);
            $schedulingtask->update($requestData);
            return redirect('schedulingTask/scheduling-task?lead_id=?')->with('flash_message', 'SchedulingTask updated!');
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
        $model = str_slug('schedulingtask','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SchedulingTask::destroy($id);
            return redirect('schedulingTask/scheduling-task')->with('flash_message', 'SchedulingTask deleted!');
        }
        return response(view('403'), 403);
    }
    public function deleteSchedulingTask(Request $request)
    {
        extract($request->all());
//        $scheduling_task = SchedulingTask::find($task_id)->delete();
//        if ($scheduling_task){
//            return response()->json(['status' => true, 'message' => 'Scheduling Task Deleted Successfully']);
//        } else {
//            return response()->json(['status' => false, 'message' => 'something wents wrong']);
//        }
        $scheduling_task = SchedulingTask::find($task_id);
        if (!$scheduling_task) {
            return response()->json(['status' => false, 'message' => 'Scheduling Task not found']);
        }
        if ($scheduling_task->delete()) {
            Notification::create([
                'icon' => 'fa fa-trash' ?? null,
                'lead_id' => $scheduling_task->lead_id ?? null,
                'model' => 'Scheduling Task Deleted',
                'title' => $scheduling_task->name ?? null,
                'time' => now(),
            ]);
            return response()->json(['status' => true, 'message' => 'Scheduling Task Successfully']);
        }
    }

    public function updateDateSchedulingTask(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|integer|exists:scheduling_tasks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $task = SchedulingTask::findOrFail($validated['task_id']);
        $task->update([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Task dates updated successfully'
        ]);
    }

    public function getLeadDetails(Request $request){
        $lead = Lead::where('id', $request->lead_id)->with('category')->first();
        return response()->json($lead);
    }

}
