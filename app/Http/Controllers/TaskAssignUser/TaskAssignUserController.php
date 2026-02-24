<?php

namespace App\Http\Controllers\TaskAssignUser;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TaskAssignUser;
use Illuminate\Http\Request;

class TaskAssignUserController extends Controller
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $taskassignuser = TaskAssignUser::where('task_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $taskassignuser = TaskAssignUser::paginate($perPage);
            }

            return view('taskAssignUser.task-assign-user.index', compact('taskassignuser'));
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('taskAssignUser.task-assign-user.create');
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            TaskAssignUser::create($requestData);
            return redirect('taskAssignUser/task-assign-user')->with('flash_message', 'TaskAssignUser added!');
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $taskassignuser = TaskAssignUser::findOrFail($id);
            return view('taskAssignUser.task-assign-user.show', compact('taskassignuser'));
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $taskassignuser = TaskAssignUser::findOrFail($id);
            return view('taskAssignUser.task-assign-user.edit', compact('taskassignuser'));
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $taskassignuser = TaskAssignUser::findOrFail($id);
             $taskassignuser->update($requestData);

             return redirect('taskAssignUser/task-assign-user')->with('flash_message', 'TaskAssignUser updated!');
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
        $model = str_slug('taskassignuser','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TaskAssignUser::destroy($id);

            return redirect('taskAssignUser/task-assign-user')->with('flash_message', 'TaskAssignUser deleted!');
        }
        return response(view('403'), 403);

    }
}
