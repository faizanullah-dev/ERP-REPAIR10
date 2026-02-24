<?php

namespace App\Http\Controllers\RoofEstimateCalculatorFlatArea;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateCalculatorFlatArea;
use Illuminate\Http\Request;

class RoofEstimateCalculatorFlatAreaController extends Controller
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculatorflatarea = RoofEstimateCalculatorFlatArea::where('section', 'LIKE', "%$keyword%")
                ->orWhere('eave', 'LIKE', "%$keyword%")
                ->orWhere('rakes', 'LIKE', "%$keyword%")
                ->orWhere('calculate_final_value_flat_area', 'LIKE', "%$keyword%")
                ->orWhere('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimatecalculatorflatarea = RoofEstimateCalculatorFlatArea::paginate($perPage);
            }

            return view('roofEstimateCalculatorFlatArea.roof-estimate-calculator-flat-area.index', compact('roofestimatecalculatorflatarea'));
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateCalculatorFlatArea.roof-estimate-calculator-flat-area.create');
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateCalculatorFlatArea::create($requestData);
            return redirect('roofEstimateCalculatorFlatArea/roof-estimate-calculator-flat-area')->with('flash_message', 'RoofEstimateCalculatorFlatArea added!');
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculatorflatarea = RoofEstimateCalculatorFlatArea::findOrFail($id);
            return view('roofEstimateCalculatorFlatArea.roof-estimate-calculator-flat-area.show', compact('roofestimatecalculatorflatarea'));
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculatorflatarea = RoofEstimateCalculatorFlatArea::findOrFail($id);
            return view('roofEstimateCalculatorFlatArea.roof-estimate-calculator-flat-area.edit', compact('roofestimatecalculatorflatarea'));
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculatorflatarea = RoofEstimateCalculatorFlatArea::findOrFail($id);
             $roofestimatecalculatorflatarea->update($requestData);

             return redirect('roofEstimateCalculatorFlatArea/roof-estimate-calculator-flat-area')->with('flash_message', 'RoofEstimateCalculatorFlatArea updated!');
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
        $model = str_slug('roofestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculatorFlatArea::destroy($id);

            return redirect('roofEstimateCalculatorFlatArea/roof-estimate-calculator-flat-area')->with('flash_message', 'RoofEstimateCalculatorFlatArea deleted!');
        }
        return response(view('403'), 403);

    }
}
