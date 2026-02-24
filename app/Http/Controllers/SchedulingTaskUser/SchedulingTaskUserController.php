<?php

namespace App\Http\Controllers\SchedulingTaskUser;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SchedulingTaskUser;
use Illuminate\Http\Request;

class SchedulingTaskUserController extends Controller
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $schedulingtaskuser = SchedulingTaskUser::where('scheduling_task_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $schedulingtaskuser = SchedulingTaskUser::paginate($perPage);
            }

            return view('schedulingTaskUser.scheduling-task-user.index', compact('schedulingtaskuser'));
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('schedulingTaskUser.scheduling-task-user.create');
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SchedulingTaskUser::create($requestData);
            return redirect('schedulingTaskUser/scheduling-task-user')->with('flash_message', 'SchedulingTaskUser added!');
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $schedulingtaskuser = SchedulingTaskUser::findOrFail($id);
            return view('schedulingTaskUser.scheduling-task-user.show', compact('schedulingtaskuser'));
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $schedulingtaskuser = SchedulingTaskUser::findOrFail($id);
            return view('schedulingTaskUser.scheduling-task-user.edit', compact('schedulingtaskuser'));
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $schedulingtaskuser = SchedulingTaskUser::findOrFail($id);
             $schedulingtaskuser->update($requestData);

             return redirect('schedulingTaskUser/scheduling-task-user')->with('flash_message', 'SchedulingTaskUser updated!');
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
        $model = str_slug('schedulingtaskuser','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SchedulingTaskUser::destroy($id);

            return redirect('schedulingTaskUser/scheduling-task-user')->with('flash_message', 'SchedulingTaskUser deleted!');
        }
        return response(view('403'), 403);

    }
}
