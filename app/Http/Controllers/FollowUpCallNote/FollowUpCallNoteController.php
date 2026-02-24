<?php

namespace App\Http\Controllers\FollowUpCallNote;

use App\FollowUpCallNotesUser;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FollowUpCallNote;
use App\Lead;
use App\Mark;
use App\Notification;
use App\User;
use App\YearEstimation;
use Illuminate\Http\Request;

class FollowUpCallNoteController extends Controller
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $followupcallnote = FollowUpCallNote::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('mark', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('follow_up_reminder', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else  {
                if (auth()->user()->hasRole('staff')) {
                    $followupcallnote = FollowUpCallNote::orderBy('id', 'DESC')
                        ->whereHas('getLead', function ($query) {
                            $query->where('representative_id', auth()->user()->id);
                        })
                        ->paginate($perPage);
                } else {
                    $followupcallnote = FollowUpCallNote::orderBy('id', 'DESC')->paginate($perPage);
                }
            }

            return view('followUpCallNote.follow-up-call-note.index', compact('followupcallnote'));
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $marks = Mark::get();
            $yearEstimation = YearEstimation::where('status', 1)->first();
            if(!empty($lead_id)){
                $leadExist=lead::findorfail($lead_id);
                return view('followUpCallNote.follow-up-call-note.create', compact('leads', 'users','leadExist', 'marks', 'yearEstimation'));

            }
            return view('followUpCallNote.follow-up-call-note.create', compact('leads', 'users', 'marks', 'yearEstimation'));
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

        $model = str_slug('followupcallnote','-');
        if (auth()->user()->permissions()->where('name','=','add-'.$model)->first() !== null) {

//            return $request->all();
            $followUpCallNote = FollowUpCallNote::create([
                'lead_id' => $request->lead_id,
                'mark_id' => $request->mark_id,
                'description' => $request->description,
                'follow_up_reminder' => $request->follow_up_reminder,
            ]);

            if (!empty($request->user_id)) {
                foreach($request->user_id as $key => $value){
                    FollowUpCallNotesUser::create([
                        'follow_up_call_note_id' => $followUpCallNote->id,
                        'user_id' => $value,
                    ]);
                }
            }
            Notification::create([
                'lead_id' => $request->lead_id,
                'model' => 'Follow Up Call Notes Added',
                'title' => "Follow up call note added to against the lead <b>{$followUpCallNote->getLead->title}</b> by",
                'icon' => "fa fa-refresh",
                'time' => $followUpCallNote->created_at,
                'user_id' => auth()->user()->id,
            ]);
            if (request('lead_id')) {
                return redirect()->route('view_lead', ['id' => request('lead_id')])
                    ->with('flash_message', 'FollowUpCallNote added!');
            }
            return redirect('followUpCallNote/follow-up-call-note')->with('flash_message', 'FollowUpCallNote added!');
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $followupcallnote = FollowUpCallNote::findOrFail($id);
            return view('followUpCallNote.follow-up-call-note.show', compact('followupcallnote'));
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $followupcallnote = FollowUpCallNote::findOrFail($id);
            $leads = Lead::get();
            $users = User::get();
            $marks = Mark::get();
            return view('followUpCallNote.follow-up-call-note.edit', compact('followupcallnote', 'leads', 'users', 'marks'));
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $followupcallnote = FollowUpCallNote::findOrFail($id);
            FollowUpCallNote::where('id',$followupcallnote->id)->update([
                'lead_id' => $request->lead_id,
                'mark_id' => $request->mark_id,
                'description' => $request->description,
                'follow_up_reminder' => $request->follow_up_reminder,
            ]);

            if (!empty($request->user_id)) {
                FollowUpCallNotesUser::where('follow_up_call_note_id', $id)->whereNotIn('user_id', $request->user_id)->delete();
                foreach($request->user_id as $key => $value){
                    FollowUpCallNotesUser::where('follow_up_call_note_id', $id)->where('user_id', $value)->updateOrCreate([
                        'follow_up_call_note_id' => $followupcallnote->id,
                        'user_id' => $value,
                    ]);
                }
            }
             return redirect('followUpCallNote/follow-up-call-note')->with('flash_message', 'FollowUpCallNote updated!');
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
        $model = str_slug('followupcallnote','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FollowUpCallNote::destroy($id);

            return redirect('followUpCallNote/follow-up-call-note')->with('flash_message', 'FollowUpCallNote deleted!');
        }
        return response(view('403'), 403);

    }
}
