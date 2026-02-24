<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Notification;
use App\Priority;
use App\Task;
use App\TaskAssignUser;
use App\TaskAttachment;
use App\TaskAttendees;
use App\Team;
use App\User;
use App\YearEstimation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
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
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $task = Task::where('title', 'LIKE', "%$keyword%")
                ->orWhere('high_priority', 'LIKE', "%$keyword%")
                ->orWhere('assign_to_user_id', 'LIKE', "%$keyword%")
                ->orWhere('due_date', 'LIKE', "%$keyword%")
                ->orWhere('assign_to_lead_id', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            }else {
                if (auth()->user()->hasRole('staff')) {
                    $task = Task::orderBy('id', 'DESC')
                        ->whereHas('getLead', function ($query) {
                            $query->where('representative_id', auth()->user()->id)->orwhere('customer_id', auth()->user()->id);
                        })
                        ->paginate($perPage);
                } else {
                    $task = Task::orderBy('id', 'DESC')->paginate($perPage);
                }
            }
            return view('task.task.index', compact('task'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        extract($request->all());
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            //$users = User::whereHas('roles', function($q){$q->where('name','!=','staff')->where('name','!=','customer')->where('name','!=','admin')->where('name','!=','user');})->get();
            $taskUsers = User::whereHas(
                'roles', function($q){
                $q->where('name','!=', 'user');
                $q->where('name','!=', 'customer');
                $q->where('name','!=', 'admin');
            })->get();
           $yearEstimation  = YearEstimation::where('status',1)->first();
            $leads = Lead::get();
            $priorities = Priority::where('status', 1)->get();
            $teams = Team::get();
            if (!empty($lead_id)){
                $leadExist = Lead::findorfail($lead_id);
                return view('task.task.create',compact( 'leads', 'priorities','leadExist','teams','taskUsers','yearEstimation'));
            }
            return view('task.task.create',compact( 'leads', 'priorities','teams','taskUsers','yearEstimation'));
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
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
                $requestData = $request->all();
                extract($requestData);
                $task =  Task::create([
                    'title' => $title??"",
                    'priority_id' => $priority_id??"null",
                    'due_date' => $due_date??"null",
                    'assign_to_lead_id' => $assign_to_lead_id??"null",
                    'description' => $description??"null",
                    'assign_to_team_id' => $assign_to_team_id??"null",
                    'created_by' => auth()->id()??'',
                ]);
                if (!empty($assign_to_user_id)) {
                    foreach($assign_to_user_id as $key => $value) {
                        TaskAssignUser::create([
                            'task_id'   => $task->id,
                            'user_id'   => $value,
                        ]);

                        if($request->send_email){
                            $recipientEmail = User::where('id', $value)->first();
                            Mail::raw("A new task has been assigned to you:\n\n" .
                                "Title: {$task->title}\n" .
                                "Description: {$task->description}\n" .
                                "Due Date: {$task->due_date}\n" .
                                "Priority: {$task->getPriority->name}\n", // Assuming priority has a name field
                                function ($message) use ($recipientEmail, $task) {
                                    $message->to($recipientEmail->email)
                                        ->subject("New Task Assigned: {$task->title}");
                                }
                            );
                        }
                    }//endforeach
                }//end if.
                if ($request->task_attachment!='') {
                    foreach(explode(',',$request->task_attachment) as $key=>$value){
                        TaskAttachment::create([
                            'task_id' => $task->id,
                            'name'    => $value
                        ]);
                    }//end foreach.
                }
                if (isset($task) && !empty($task)) {
                    Notification::create([
                        'lead_id' => $task->assign_to_lead_id,
                        'model' => 'Task Created',
                        'title' => 'A task <b>' . @$task->title??"" . '</b> has been created for the lead <b>' . @$task->getLead->title??"" . '</b> by',
                        'time' => $task->created_at,
                        'icon' => 'fa-solid fa-list-check',
                        'user_id' => auth()->user()->id,
                        ]);
                }//ends if.

            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Task added!');
            }else{
                return redirect('task/task')->with('flash_message', 'Task added!');
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
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $task = Task::findOrFail($id);
            return view('task.task.show', compact('task'));
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
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $task = Task::findOrFail($id);
            $leads = Lead::get();
            $teams = Team::get();
            $priorities = Priority::get();
            $taskUsers = User::whereHas(
                'roles', function($q){
                $q->where('name','!=', 'user');
                $q->where('name','!=', 'customer');
                $q->where('name','!=', 'admin');
            })->get();
            return view('task.task.edit', compact('task','teams', 'taskUsers', 'leads', 'priorities'));
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
//        return $request->all();
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($requestData);
            $task = Task::findOrFail($id);
             Task::where('id',$task->id)->update([
                'title' => $title??"",
                'priority_id' => $priority_id??"null",
                'due_date' => $due_date??"null",
                'assign_to_lead_id' => $assign_to_lead_id??"null",
                'description' => $description??"null",
                'assign_to_team_id' => $assign_to_team_id??"null",
            ]);
            if(!empty($assign_to_user_id)) {
                TaskAssignUser::where('task_id',$id)->whereNotIn('user_id',$assign_to_user_id)->delete();
                foreach($assign_to_user_id as $key => $value) {
                    TaskAssignUser::where('task_id', $id)->where('user_id', $value)->updateOrCreate([
                        'task_id' => $task->id,
                        'user_id'   => $value,
                    ]);
                }//endforeach
//                TaskAttendees::where('task_id',$id)->whereNotIn('attendees_id',$assign_to_user_id)->delete();
            }//end if.
            if ($request->task_attachment!='') {
                foreach(explode(',',$request->task_attachment) as $key=>$value){
                    TaskAttachment::where('task_id', $id)->where('name', $value)->updateOrCreate([
                        'task_id' => $task->id,
                        'name'    => $value
                    ]);
                }//end foreach.
            }
            if (isset($task) && !empty($task)) {
                Notification::create([
                    'lead_id' => $task->assign_to_lead_id,
                    'model'   => 'Task Updated',
                    'title' => 'A task <b>' . $task->title . '</b> has been updated for the lead <b>' . $task->getLead->title . '</b> by',
                    'time' => $task->created_at,
                    'icon' => 'fa-solid fa-square-pen',
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Task Updated!');
            }else {
                return redirect('task/task')->with('flash_message', 'Task updated!');
            }
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
        $model = str_slug('task','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Task::destroy($id);

            return redirect('task/task')->with('flash_message', 'Task deleted!');
        }
        return response(view('403'), 403);

    }
}
