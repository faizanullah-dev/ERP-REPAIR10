<?php

namespace App\Http\Controllers\RoofEstimateSkylight;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateSkylight;
use Illuminate\Http\Request;

class RoofEstimateSkylightController extends Controller
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimateskylight = RoofEstimateSkylight::where('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimateskylight = RoofEstimateSkylight::paginate($perPage);
            }

            return view('roofEstimateSkylight.roof-estimate-skylight.index', compact('roofestimateskylight'));
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateSkylight.roof-estimate-skylight.create');
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateSkylight::create($requestData);
            return redirect('roofEstimateSkylight/roof-estimate-skylight')->with('flash_message', 'RoofEstimateSkylight added!');
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimateskylight = RoofEstimateSkylight::findOrFail($id);
            return view('roofEstimateSkylight.roof-estimate-skylight.show', compact('roofestimateskylight'));
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimateskylight = RoofEstimateSkylight::findOrFail($id);
            return view('roofEstimateSkylight.roof-estimate-skylight.edit', compact('roofestimateskylight'));
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimateskylight = RoofEstimateSkylight::findOrFail($id);
             $roofestimateskylight->update($requestData);

             return redirect('roofEstimateSkylight/roof-estimate-skylight')->with('flash_message', 'RoofEstimateSkylight updated!');
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
        $model = str_slug('roofestimateskylight','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateSkylight::destroy($id);

            return redirect('roofEstimateSkylight/roof-estimate-skylight')->with('flash_message', 'RoofEstimateSkylight deleted!');
        }
        return response(view('403'), 403);

    }
}
