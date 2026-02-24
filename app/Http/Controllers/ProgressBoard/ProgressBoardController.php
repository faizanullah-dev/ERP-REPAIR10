<?php

namespace App\Http\Controllers\ProgressBoard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Priority;
use App\ProgressBoard;
use App\ProgressBoardCategory;
use App\Task;
use App\TaskAssignUser;
use App\TaskAttachment;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class ProgressBoardController extends Controller
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
//
//            if (!empty($keyword)) {
//                $progressboard = ProgressBoard::where('lead_id', 'LIKE', "%$keyword%")
//                ->paginate($perPage);
//            }else {
//                $progressboard = ProgressBoard::paginate($perPage);
//            }
            $lead = Lead::where('progress_status', 1)->paginate($perPage);
            return view('progressBoard.progress-board.index', compact('lead'));
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $lead = Lead::get();
            $categories = Category::wherestatus(1)->get();
            return view('progressBoard.progress-board.create',compact('lead','categories'));
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($requestData);
            $progressBoard = ProgressBoard::create([
                'lead_id' => $lead_id,
            ]);
            foreach($category_id as $category) {
                ProgressBoardCategory::create([
                   'progress_board_id' => $progressBoard->id,
                   'category_id'       => $category,
                ]);
            }
            return redirect('progressBoard/progress-board')->with('flash_message', 'ProgressBoard added!');
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $progressboard = ProgressBoard::findOrFail($id);
            return view('progressBoard.progress-board.show', compact('progressboard'));
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $progressboard = ProgressBoard::findOrFail($id);
            $lead = Lead::get();
            $categories = Category::wherestatus(1)->get();
            return view('progressBoard.progress-board.edit', compact('progressboard','categories','lead'));
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

                 $requestData = $request->all();
                 extract($requestData);
                 $progressboard = ProgressBoard::findOrFail($id);
                    ProgressBoard::whereid($id)->update([
                        'lead_id' => $lead_id,
                    ]);
                    if (!empty($category_id)){
                        ProgressBoardCategory::where('progress_board_id',$id)->whereNotIn('category_id',$category_id)->delete();
                        foreach($category_id as $category) {
                            ProgressBoardCategory::where('progress_board_id', $id)->where('category_id', $category)->updateOrCreate([
                                'progress_board_id' => $progressboard->id,
                                'category_id'       => $category,
                            ]);
                        }
                    }

             return redirect('progressBoard/progress-board')->with('flash_message', 'ProgressBoard updated!');
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
        $model = str_slug('progressboard','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProgressBoard::destroy($id);
            return redirect('progressBoard/progress-board')->with('flash_message', 'ProgressBoard deleted!');
        }
        return response(view('403'), 403);
    }
    public function editProgressTaskModal(Request $request){
        $task = Task::findOrFail($request->task_id);
        $priorities = Priority::where('status', 1)->get();
        $teams = Team::get();
        $taskUsers = User::whereHas(
            'roles', function($q){
            $q->where('name','!=', 'user');
            $q->where('name','!=', 'customer');
            $q->where('name','!=', 'admin');
        })->get();
        return view('progressBoard.progress-board.edit_progress_task_modal', compact('priorities', 'teams', 'taskUsers', 'task'));
    }
    public function updateProgressTask(Request $request){
//        return $request->all();
                $requestData = $request->all();
                extract($requestData);
                $task = Task::findOrFail($task_id);
                Task::where('id',$task->id)->update([
                    'title' => $title??"",
                    'priority_id' => $priority_id??"null",
                    'due_date' => $due_date??"null",
                    'description' => $description??"null",
                    'assign_to_team_id' => $assign_to_team_id??"null",
                ]);
                if(!empty($assign_to_user_id)) {
                    TaskAssignUser::where('task_id',$task_id)->whereNotIn('user_id',$assign_to_user_id)->delete();
                    foreach($assign_to_user_id as $key => $value) {
                        TaskAssignUser::where('task_id', $task_id)->where('user_id', $value)->updateOrCreate([
                            'task_id' => $task->id,
                            'user_id'   => $value,
                        ]);
                    }//endforeach
//                TaskAttendees::where('task_id',$id)->whereNotIn('attendees_id',$assign_to_user_id)->delete();
                }//end if.
                if ($request->task_attachment!='') {
                    foreach(explode(',',$request->task_attachment) as $key=>$value){
                        TaskAttachment::where('task_id', $task_id)->where('name', $value)->updateOrCreate([
                            'task_id' => $task->id,
                            'name'    => $value
                        ]);
                    }//end foreach.
                }
        return back()->with('flash_message', 'Task updated!');
    }
}
