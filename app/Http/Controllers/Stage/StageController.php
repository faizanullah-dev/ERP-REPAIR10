<?php

namespace App\Http\Controllers\Stage;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\LeadStage;
use App\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
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
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 2500;

            if (!empty($keyword)) {
                $stage = Stage::where('name', 'LIKE', "%$keyword%")
                ->orWhere('position', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $stage = Stage::paginate($perPage);
            }

            return view('stage.stage.index', compact('stage'));
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
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('stage.stage.create');
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

        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            try{
                $maxPositionValue = Stage::withTrashed()->select(\DB::raw('MAX(CAST(position AS UNSIGNED)) as max_position'))->value('max_position');
                $maxPositionValue = ($maxPositionValue === null || $maxPositionValue === '') ? 0 : $maxPositionValue;
                $finalPosition = $maxPositionValue + 1;
                $stage = Stage::create([
                    'name'      => $request->name,
                    'position'  => $finalPosition,
                    'colour_id' => $request->colour_id,
                    'created_by'   => auth()->id(),
                    'status'    => $request->status,
                ]);
//              $leadStages = LeadStage::get();
                $leadStages = LeadStage::withTrashed()->get();
                $date = now()->format('Y-m-d');
                foreach ($leadStages as $leadStage){
                    LeadStage::firstOrCreate(
                        [
                            'lead_id'  => $leadStage->lead_id,
                            'stage_id' => $stage->id,
                        ],
                        [
                            'lead_id'  => $leadStage->lead_id,
                            'stage_id' => $stage->id,
                            'date'     => $date,
                            'position' => $stage->position,
                            'status'   => $stage->status,
                        ]
                    );
                }
                return redirect('stage/stage')->with('flash_message', 'Stage added!');
            }catch(\Exception $e){
                return $e->getMessage();
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
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $stage = Stage::findOrFail($id);
            return view('stage.stage.show', compact('stage'));
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
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $stage = Stage::findOrFail($id);
            return view('stage.stage.edit', compact('stage'));
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
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
             $requestData = $request->all();
             $stage = Stage::findOrFail($id);
             $stage->update($requestData);
                 LeadStage::where('stage_id', $stage->id)->update(['status' => $requestData['status']]);

             return redirect('stage/stage')->with('flash_message', 'Stage updated!');
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
    public function destroy($id) {
        $model = str_slug('stage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            LeadStage::where('stage_id',$id)->delete();
            Stage::destroy($id);
            return redirect('stage/stage')->with('flash_message', 'Stage deleted!');
        }
        return response(view('403'), 403);
    }

    public function editStageModal(Request $request, $id = null){
        extract($request->all());
        $stage = Stage::findOrFail($id);
        return (string)view('stage.stage.edit_stage_modal', compact('stage'));
    }

    public function viewStageModal(Request $request, $id = null){
        extract($request->all());
        $stage = Stage::findOrFail($id);
        return view('stage.stage.view_stage_modal', compact('stage'));
    }
}
