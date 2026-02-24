<?php

namespace App\Http\Controllers\WorkCrew;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\User;
use App\WorkCrew;
use App\WorkCrewCompanyCrew;
use App\WorkCrewJobRepresentative;
use App\WorkCrewLabour;
use Illuminate\Http\Request;

class WorkCrewController extends Controller
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
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $workcrew = WorkCrew::where('lead_id', 'LIKE', "%$keyword%")->orWhere('category_id', 'LIKE', "%$keyword%")->paginate($perPage);
            } else {
                $workcrew = WorkCrew::paginate($perPage);
            }

            return view('workCrew.work-crew.index', compact('workcrew'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $categories = Category::get();
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $salesmens = User::whereHas('roles', function($q){$q->where('name', 'salesmen');})->get();
            return view('workCrew.work-crew.create', compact('leads', 'categories', 'users', 'salesmens'));
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
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {

                 extract($request->all());
                 $work_crew = WorkCrew::create([
                    'lead_id' => $request->lead_id,
                    'category_id' => $request->category_id,
                 ]);
                if (!empty($job_representative_id)){
                    foreach ($job_representative_id as $representative_id) {
                        WorkCrewJobRepresentative::create([
                            'work_crew_id' => $work_crew->id,
                            'user_id' => $representative_id,
                        ]);
                    }
                }
                if (!empty($company_crew_id)){
                    foreach ($company_crew_id as $crew_id) {
                        WorkCrewCompanyCrew::create([
                            'work_crew_id' => $work_crew->id,
                            'user_id' => $crew_id,
                        ]);
                    }
                }
                if (!empty($labour_id)){
                    foreach ($labour_id as $labour_ids) {
                        WorkCrewLabour::create([
                            'work_crew_id' => $work_crew->id,
                            'user_id'      => $labour_ids,
                        ]);
                    }
                }
            return redirect('workCrew/work-crew')->with('flash_message', 'WorkCrew added!');
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
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $workcrew = WorkCrew::with('getWorkCrewJobRepresantative','getWorkCrewCompanyCrew','getWorkCrewLabour')->findOrFail($id);
            return view('workCrew.work-crew.show', compact('workcrew'));
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
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $workcrew = WorkCrew::findOrFail($id);
            $leads = Lead::get();
            $categories = Category::get();
            $users = User::whereDoesntHave('roles', function($q) {$q->whereIn('name', ['admin', 'user']);})->get();
            $salesmens = User::whereHas('roles', function($q){$q->where('name','salesmen');})->get();
            return view('workCrew.work-crew.edit', compact('workcrew', 'leads', 'categories', 'users','salesmens'));
        }//end if
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
    $model = str_slug('workcrew','-');
    if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
        extract($request->all());
        $requestData =  $request->all();

         WorkCrew::where('id', $id )->update([
            'lead_id' => $request->lead_id,
            'category_id' => $request->category_id,
        ]);

        if (!empty($job_representative_id)){
            WorkCrewJobRepresentative::where('work_crew_id', $id)->whereNotIn('user_id', $job_representative_id)->delete();
            foreach ($job_representative_id as $representative_id) {
                WorkCrewJobRepresentative::where('work_crew_id', $id)->where('user_id', $representative_id)->updateOrCreate([
                    'work_crew_id' => $id,
                    'user_id' => $representative_id,
                ]);
            }
        }

        if (!empty($company_crew_id)){
            WorkCrewCompanyCrew::where('work_crew_id', $id)->whereNotIn('user_id', $company_crew_id)->delete();
            foreach ($company_crew_id as $crew_id) {
               WorkCrewCompanyCrew::where('work_crew_id', $id)->where('user_id', $crew_id)->updateOrCreate([
                    'work_crew_id' => $id,
                    'user_id' => $crew_id,
                ]);
            }
        }
        if (!empty($labour_id)){
            WorkCrewLabour::where('work_crew_id', $id)->whereNotIn('user_id', $labour_id)->delete();
            foreach ($labour_id as $labour_ids) {
                WorkCrewLabour::where('work_crew_id', $id)->where('user_id', $labour_ids)->updateOrCreate([
                    'work_crew_id' => $id,
                    'user_id'      => $labour_ids,
                ]);
            }
        }
        return redirect('workCrew/work-crew')->with('flash_message', 'WorkCrew updated!');
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
        $model = str_slug('workcrew','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WorkCrew::destroy($id);

            return redirect('workCrew/work-crew')->with('flash_message', 'WorkCrew deleted!');
        }
        return response(view('403'), 403);

    }
}
