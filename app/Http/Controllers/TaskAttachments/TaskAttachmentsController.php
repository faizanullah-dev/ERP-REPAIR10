<?php

namespace App\Http\Controllers\TaskAttachments;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TaskAttachment;
use Illuminate\Http\Request;

class TaskAttachmentsController extends Controller
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $taskattachments = TaskAttachment::where('task_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $taskattachments = TaskAttachment::paginate($perPage);
            }

            return view('taskAttachments.task-attachments.index', compact('taskattachments'));
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('taskAttachments.task-attachments.create');
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            TaskAttachment::create($requestData);
            return redirect('taskAttachments/task-attachments')->with('flash_message', 'TaskAttachment added!');
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $taskattachment = TaskAttachment::findOrFail($id);
            return view('taskAttachments.task-attachments.show', compact('taskattachment'));
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $taskattachment = TaskAttachment::findOrFail($id);
            return view('taskAttachments.task-attachments.edit', compact('taskattachment'));
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $taskattachment = TaskAttachment::findOrFail($id);
             $taskattachment->update($requestData);

             return redirect('taskAttachments/task-attachments')->with('flash_message', 'TaskAttachment updated!');
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
        $model = str_slug('taskattachments','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TaskAttachment::destroy($id);

            return redirect('taskAttachments/task-attachments')->with('flash_message', 'TaskAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
