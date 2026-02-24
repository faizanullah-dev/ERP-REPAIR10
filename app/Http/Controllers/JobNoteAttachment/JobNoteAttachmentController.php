<?php

namespace App\Http\Controllers\JobNoteAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\JobNoteAttachment;
use Illuminate\Http\Request;

class JobNoteAttachmentController extends Controller
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $jobnoteattachment = JobNoteAttachment::where('job_note_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $jobnoteattachment = JobNoteAttachment::paginate($perPage);
            }

            return view('jobNoteAttachment.job-note-attachment.index', compact('jobnoteattachment'));
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('jobNoteAttachment.job-note-attachment.create');
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            JobNoteAttachment::create($requestData);
            return redirect('jobNoteAttachment/job-note-attachment')->with('flash_message', 'JobNoteAttachment added!');
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $jobnoteattachment = JobNoteAttachment::findOrFail($id);
            return view('jobNoteAttachment.job-note-attachment.show', compact('jobnoteattachment'));
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $jobnoteattachment = JobNoteAttachment::findOrFail($id);
            return view('jobNoteAttachment.job-note-attachment.edit', compact('jobnoteattachment'));
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $jobnoteattachment = JobNoteAttachment::findOrFail($id);
             $jobnoteattachment->update($requestData);

             return redirect('jobNoteAttachment/job-note-attachment')->with('flash_message', 'JobNoteAttachment updated!');
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
        $model = str_slug('jobnoteattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            JobNoteAttachment::destroy($id);

            return redirect('jobNoteAttachment/job-note-attachment')->with('flash_message', 'JobNoteAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
