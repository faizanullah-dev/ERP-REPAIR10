<?php

namespace App\Http\Controllers\LeadStage;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\LeadStage;
use Illuminate\Http\Request;

class LeadStageController extends Controller
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $leadstage = LeadStage::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('stage_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $leadstage = LeadStage::paginate($perPage);
            }

            return view('leadStage.lead-stage.index', compact('leadstage'));
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('leadStage.lead-stage.create');
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
        return $request->all();
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            LeadStage::create($requestData);
            return redirect('leadStage/lead-stage')->with('flash_message', 'LeadStage added!');
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $leadstage = LeadStage::findOrFail($id);
            return view('leadStage.lead-stage.show', compact('leadstage'));
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $leadstage = LeadStage::findOrFail($id);
            return view('leadStage.lead-stage.edit', compact('leadstage'));
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
             $requestData = $request->all();
             $leadstage = LeadStage::findOrFail($id);
             $leadstage->update($requestData);
             return back()->with('flash_message', 'Date updated!');
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
        $model = str_slug('leadstage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            LeadStage::destroy($id);

            return redirect('leadStage/lead-stage')->with('flash_message', 'LeadStage deleted!');
        }
        return response(view('403'), 403);

    }
}
