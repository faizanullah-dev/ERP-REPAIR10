<?php

namespace App\Http\Controllers\WorkCrewJobRepresentative;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\WorkCrewJobRepresentative;
use Illuminate\Http\Request;

class WorkCrewJobRepresentativeController extends Controller
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $workcrewjobrepresentative = WorkCrewJobRepresentative::where('work_crew_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $workcrewjobrepresentative = WorkCrewJobRepresentative::paginate($perPage);
            }

            return view('workCrewJobRepresentative.work-crew-job-representative.index', compact('workcrewjobrepresentative'));
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('workCrewJobRepresentative.work-crew-job-representative.create');
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            WorkCrewJobRepresentative::create($requestData);
            return redirect('workCrewJobRepresentative/work-crew-job-representative')->with('flash_message', 'WorkCrewJobRepresentative added!');
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $workcrewjobrepresentative = WorkCrewJobRepresentative::findOrFail($id);
            return view('workCrewJobRepresentative.work-crew-job-representative.show', compact('workcrewjobrepresentative'));
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $workcrewjobrepresentative = WorkCrewJobRepresentative::findOrFail($id);
            return view('workCrewJobRepresentative.work-crew-job-representative.edit', compact('workcrewjobrepresentative'));
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $workcrewjobrepresentative = WorkCrewJobRepresentative::findOrFail($id);
             $workcrewjobrepresentative->update($requestData);

             return redirect('workCrewJobRepresentative/work-crew-job-representative')->with('flash_message', 'WorkCrewJobRepresentative updated!');
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
        $model = str_slug('workcrewjobrepresentative','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WorkCrewJobRepresentative::destroy($id);

            return redirect('workCrewJobRepresentative/work-crew-job-representative')->with('flash_message', 'WorkCrewJobRepresentative deleted!');
        }
        return response(view('403'), 403);

    }
}
