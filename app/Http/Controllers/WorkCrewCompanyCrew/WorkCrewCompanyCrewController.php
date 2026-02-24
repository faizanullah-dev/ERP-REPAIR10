<?php

namespace App\Http\Controllers\WorkCrewCompanyCrew;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\WorkCrewCompanyCrew;
use Illuminate\Http\Request;

class WorkCrewCompanyCrewController extends Controller
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $workcrewcompanycrew = WorkCrewCompanyCrew::where('work_crew_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $workcrewcompanycrew = WorkCrewCompanyCrew::paginate($perPage);
            }

            return view('workCrewCompanyCrew.work-crew-company-crew.index', compact('workcrewcompanycrew'));
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('workCrewCompanyCrew.work-crew-company-crew.create');
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            WorkCrewCompanyCrew::create($requestData);
            return redirect('workCrewCompanyCrew/work-crew-company-crew')->with('flash_message', 'WorkCrewCompanyCrew added!');
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $workcrewcompanycrew = WorkCrewCompanyCrew::findOrFail($id);
            return view('workCrewCompanyCrew.work-crew-company-crew.show', compact('workcrewcompanycrew'));
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $workcrewcompanycrew = WorkCrewCompanyCrew::findOrFail($id);
            return view('workCrewCompanyCrew.work-crew-company-crew.edit', compact('workcrewcompanycrew'));
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $workcrewcompanycrew = WorkCrewCompanyCrew::findOrFail($id);
             $workcrewcompanycrew->update($requestData);

             return redirect('workCrewCompanyCrew/work-crew-company-crew')->with('flash_message', 'WorkCrewCompanyCrew updated!');
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
        $model = str_slug('workcrewcompanycrew','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WorkCrewCompanyCrew::destroy($id);

            return redirect('workCrewCompanyCrew/work-crew-company-crew')->with('flash_message', 'WorkCrewCompanyCrew deleted!');
        }
        return response(view('403'), 403);

    }
}
