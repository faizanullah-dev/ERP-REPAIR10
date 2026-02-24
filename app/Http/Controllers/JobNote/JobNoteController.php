<?php

namespace App\Http\Controllers\JobNote;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\JobNote;
use App\JobNoteAttachment;
use App\Lead;
use App\Notification;
use Illuminate\Http\Request;

class JobNoteController extends Controller
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $jobnote = JobNote::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if (auth()->user()->hasRole('staff')) {
                    $jobnote = JobNote::orderBy('id', 'DESC')
                        ->whereHas('getLead', function ($query) {
                            $query->where('representative_id', auth()->user()->id);
                        })
                        ->paginate($perPage);
                } else {
                    $jobnote = JobNote::orderBy('id', 'DESC')->paginate($perPage);
                }
            }
            return view('jobNote.job-note.index', compact('jobnote'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request,$lead_id = null)
    {
        extract($request->all());
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
        if(!empty($lead_id)){
            $leadExist=lead::findorfail($lead_id);
            return view('jobNote.job-note.create',compact('leads','leadExist'));
        }
            return view('jobNote.job-note.create',compact('leads'));
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $job_note = JobNote::create([
                'lead_id'=>$request->lead_id,
                'description'=>$request->description,
                'status'=>$request->input('status'),
                'created_by' => auth()->id() ??'',
            ]);
            if (isset($job_note) && !empty($job_note)) {
                Notification::create([
                    'lead_id' => $job_note->lead_id,
                    'model'   => 'Job Notes Create',
                    'title'   => 'Jobnote has been created for the lead <b>' . @$job_note->getLead->title . '</b> by',
                    'icon'    => 'fa-regular fa-clipboard',
                    'time'    => $job_note->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if ($request->job_note_attachment!='') {
                foreach(explode(',',$request->job_note_attachment) as $key => $value){
                    JobNoteAttachment::create([
                        'job_note_id'    => $job_note->id,
                        'name'           => $value
                    ]);
                }//end foreach.
            }
            if($request->view_lead != ''){
                return back()->with('flash_message', 'JobNote added!');
            }else{
                return redirect('jobNote/job-note')->with('flash_message', 'JobNote added!');
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
           $jobnote = JobNote::findOrFail($id);
            return view('jobNote.job-note.show', compact('jobnote'));
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $jobnote = JobNote::findOrFail($id);
            $leads = Lead::get();
            return view('jobNote.job-note.edit', compact('jobnote', 'leads'));
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
             $jobnote = JobNote::findOrFail($id);
                JobNote::where('id', $jobnote->id)->update([
                'lead_id'=>$request->lead_id,
                'description'=>$request->description,
                'status'=>$request->input('status'),
            ]);
            if (!empty($request->job_note_attachment!='')) {
                foreach(explode(',',$request->job_note_attachment) as $key => $value){
                    JobNoteAttachment::where('job_note_id', $id)->where('name', $value)->updateOrCreate([
                        'job_note_id' => $jobnote->id,
                        'name'           => $value,
                    ]);
                }//end foreach.
            }
            if (isset($jobnote) && !empty($jobnote)) {
                Notification::create([
                    'lead_id' => $jobnote->lead_id,
                    'model'   => 'Job Notes Update',
                    'title'   => 'Jobnote has been updated for the lead <b>' . $jobnote->getLead->title . '</b> by',
                    'icon'    => 'fa-regular fa-clipboard',
                    'time'    => $jobnote->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if($request->view_lead != ''){
                return back()->with('flash_message', 'JobNote added!');
            }else {
                return redirect('jobNote/job-note')->with('flash_message', 'JobNote updated!');
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
        $model = str_slug('jobnote','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            JobNote::destroy($id);

            return redirect('jobNote/job-note')->with('flash_message', 'JobNote deleted!');
        }
        return response(view('403'), 403);

    }
}
