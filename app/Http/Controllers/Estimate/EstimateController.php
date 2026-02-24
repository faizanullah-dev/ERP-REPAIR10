<?php

namespace App\Http\Controllers\Estimate;

use App\EstimateAttachment;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Estimate;
use App\Lead;
use Illuminate\Http\Request;

class EstimateController extends Controller
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
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $estimate = Estimate::where('lead_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $estimate = Estimate::paginate($perPage);
            }

            return view('estimate.estimate.index', compact('estimate'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request,$lead_id= null)
    {
        extract($request->all());
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $lead = Lead::get();
            if(!empty($lead_id)){
                $leadExist=Lead::findOrfail($lead_id);
                return view('estimate.estimate.create',compact( 'lead','leadExist'));
            }
            return view('estimate.estimate.create',compact('lead'));
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
    public function store(Request $request){
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($requestData);
            $lead =  Estimate::create([
                'lead_id' => $lead_id,
            ]);
            if ($request->estimate_attachment != '') {
                foreach(explode(',',$request->estimate_attachment) as $key => $value){
                    EstimateAttachment::create([
                        'estimate_id' => $lead->id,
                        'name'        => $value
                    ]);
                }//end foreach.
            }
            if (request('lead_id')) {
                return redirect()->route('view_lead', ['id' => request('lead_id')])
                    ->with('flash_message', 'Estimate added!');
            }
            return redirect('estimate/estimate')->with('flash_message', 'Estimate added!');
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
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $estimate = Estimate::findOrFail($id);
            return view('estimate.estimate.show', compact('estimate'));
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
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $estimate = Estimate::findOrFail($id);
            $lead = Lead::get();
            return view('estimate.estimate.edit', compact('estimate','lead'));
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
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
                extract($requestData);
                $estimate = Estimate::findOrFail($id);
                Estimate::whereid($estimate->id)->update([
                    'lead_id' => $lead_id,
                ]);
                if ($request->estimate_attachment != '') {
                    foreach(explode(',',$request->estimate_attachment) as $key => $value){
                        EstimateAttachment::where('estimate_id',$id)->where('name', $value)->updateOrCreate([
                            'estimate_id' => $estimate->id,
                            'name'        => $value
                        ]);
                    }//end foreach.
                }
//                 $estimate->update($requestData);
             return redirect('estimate/estimate')->with('flash_message', 'Estimate updated!');
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
        $model = str_slug('estimate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Estimate::destroy($id);

            return redirect('estimate/estimate')->with('flash_message', 'Estimate deleted!');
        }
        return response(view('403'), 403);

    }
}
