<?php

namespace App\Http\Controllers\FollowUpCallNotesUser;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FollowUpCallNotesUser;
use Illuminate\Http\Request;

class FollowUpCallNotesUserController extends Controller
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $followupcallnotesuser = FollowUpCallNotesUser::where('follow_up_call_note_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $followupcallnotesuser = FollowUpCallNotesUser::paginate($perPage);
            }

            return view('followUpCallNotesUser.follow-up-call-notes-user.index', compact('followupcallnotesuser'));
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('followUpCallNotesUser.follow-up-call-notes-user.create');
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            FollowUpCallNotesUser::create($requestData);
            return redirect('followUpCallNotesUser/follow-up-call-notes-user')->with('flash_message', 'FollowUpCallNotesUser added!');
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $followupcallnotesuser = FollowUpCallNotesUser::findOrFail($id);
            return view('followUpCallNotesUser.follow-up-call-notes-user.show', compact('followupcallnotesuser'));
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $followupcallnotesuser = FollowUpCallNotesUser::findOrFail($id);
            return view('followUpCallNotesUser.follow-up-call-notes-user.edit', compact('followupcallnotesuser'));
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $followupcallnotesuser = FollowUpCallNotesUser::findOrFail($id);
             $followupcallnotesuser->update($requestData);

             return redirect('followUpCallNotesUser/follow-up-call-notes-user')->with('flash_message', 'FollowUpCallNotesUser updated!');
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
        $model = str_slug('followupcallnotesuser','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FollowUpCallNotesUser::destroy($id);

            return redirect('followUpCallNotesUser/follow-up-call-notes-user')->with('flash_message', 'FollowUpCallNotesUser deleted!');
        }
        return response(view('403'), 403);

    }
}
