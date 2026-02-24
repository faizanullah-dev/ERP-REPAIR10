<?php

namespace App\Http\Controllers\WorkCrewLabour;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\WorkCrewLabour;
use Illuminate\Http\Request;

class WorkCrewLabourController extends Controller
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $workcrewlabour = WorkCrewLabour::where('work_crew_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $workcrewlabour = WorkCrewLabour::paginate($perPage);
            }

            return view('workCrewLabour.work-crew-labour.index', compact('workcrewlabour'));
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('workCrewLabour.work-crew-labour.create');
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            WorkCrewLabour::create($requestData);
            return redirect('workCrewLabour/work-crew-labour')->with('flash_message', 'WorkCrewLabour added!');
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $workcrewlabour = WorkCrewLabour::findOrFail($id);
            return view('workCrewLabour.work-crew-labour.show', compact('workcrewlabour'));
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $workcrewlabour = WorkCrewLabour::findOrFail($id);
            return view('workCrewLabour.work-crew-labour.edit', compact('workcrewlabour'));
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $workcrewlabour = WorkCrewLabour::findOrFail($id);
             $workcrewlabour->update($requestData);

             return redirect('workCrewLabour/work-crew-labour')->with('flash_message', 'WorkCrewLabour updated!');
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
        $model = str_slug('workcrewlabour','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WorkCrewLabour::destroy($id);

            return redirect('workCrewLabour/work-crew-labour')->with('flash_message', 'WorkCrewLabour deleted!');
        }
        return response(view('403'), 403);

    }
}
