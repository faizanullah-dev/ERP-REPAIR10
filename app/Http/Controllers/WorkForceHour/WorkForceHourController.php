<?php

namespace App\Http\Controllers\WorkForceHour;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WorkForceHour;
use Illuminate\Http\Request;

class WorkForceHourController extends Controller
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $workforcehour = WorkForceHour::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('task_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('time', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $workforcehour = WorkForceHour::paginate($perPage);
            }

            return view('workForceHour.work-force-hour.index', compact('workforcehour'));
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('workForceHour.work-force-hour.create');
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
//        return $request->all();
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();

            $leadIds = $request->input('lead_id', []);
            $taskIds = $request->input('task_id', []);
            $times = $request->input('time', []);

            foreach ($taskIds as $key => $task_id) {
                if($times[$key] != '00:00:00'){
                    WorkForceHour::create([
                        'lead_id' => $leadIds[$key],
                        'task_id' => $task_id,
                        'user_id' => $request->user_id,
                        'time' => $times[$key],
                    ]);
                }
            }
            return redirect()->back()->with('flash_message', 'Work Hours added!');
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $workforcehour = WorkForceHour::findOrFail($id);
            return view('workForceHour.work-force-hour.show', compact('workforcehour'));
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $workforcehour = WorkForceHour::findOrFail($id);
            return view('workForceHour.work-force-hour.edit', compact('workforcehour'));
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $workforcehour = WorkForceHour::findOrFail($id);
             $workforcehour->update($requestData);

             return redirect('workForceHour/work-force-hour')->with('flash_message', 'WorkForceHour updated!');
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
        $model = str_slug('workforcehour','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WorkForceHour::destroy($id);

            return redirect('workForceHour/work-force-hour')->with('flash_message', 'WorkForceHour deleted!');
        }
        return response(view('403'), 403);

    }
}
