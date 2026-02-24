<?php

namespace App\Http\Controllers\LeadMail;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\LeadMail;
use Illuminate\Http\Request;

class LeadMailController extends Controller
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $leadmail = LeadMail::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('from', 'LIKE', "%$keyword%")
                ->orWhere('to', 'LIKE', "%$keyword%")
                ->orWhere('cc', 'LIKE', "%$keyword%")
                ->orWhere('bcc', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('mail_attachment', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $leadmail = LeadMail::paginate($perPage);
            }

            return view('leadMail.lead-mail.index', compact('leadmail'));
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('leadMail.lead-mail.create');
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            LeadMail::create($requestData);
            return redirect('leadMail/lead-mail')->with('flash_message', 'LeadMail added!');
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $leadmail = LeadMail::findOrFail($id);
            return view('leadMail.lead-mail.show', compact('leadmail'));
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $leadmail = LeadMail::findOrFail($id);
            return view('leadMail.lead-mail.edit', compact('leadmail'));
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $leadmail = LeadMail::findOrFail($id);
             $leadmail->update($requestData);
             return back()->with('flash_message', 'LeadMail updated!');
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
        $model = str_slug('leadmail','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            LeadMail::destroy($id);

            return redirect('leadMail/lead-mail')->with('flash_message', 'LeadMail deleted!');
        }
        return response(view('403'), 403);

    }
}
