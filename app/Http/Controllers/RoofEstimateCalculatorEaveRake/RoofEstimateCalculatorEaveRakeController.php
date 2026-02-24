<?php

namespace App\Http\Controllers\RoofEstimateCalculatorEaveRake;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateCalculatorEaveRake;
use Illuminate\Http\Request;

class RoofEstimateCalculatorEaveRakeController extends Controller
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculatoreaverake = RoofEstimateCalculatorEaveRake::where('section', 'LIKE', "%$keyword%")
                ->orWhere('eave', 'LIKE', "%$keyword%")
                ->orWhere('rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_final_rakes', 'LIKE', "%$keyword%")
                ->orWhere('calculate_final_value_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimatecalculatoreaverake = RoofEstimateCalculatorEaveRake::paginate($perPage);
            }

            return view('roofEstimateCalculatorEaveRake.roof-estimate-calculator-eave-rake.index', compact('roofestimatecalculatoreaverake'));
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateCalculatorEaveRake.roof-estimate-calculator-eave-rake.create');
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateCalculatorEaveRake::create($requestData);
            return redirect('roofEstimateCalculatorEaveRake/roof-estimate-calculator-eave-rake')->with('flash_message', 'RoofEstimateCalculatorEaveRake added!');
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculatoreaverake = RoofEstimateCalculatorEaveRake::findOrFail($id);
            return view('roofEstimateCalculatorEaveRake.roof-estimate-calculator-eave-rake.show', compact('roofestimatecalculatoreaverake'));
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculatoreaverake = RoofEstimateCalculatorEaveRake::findOrFail($id);
            return view('roofEstimateCalculatorEaveRake.roof-estimate-calculator-eave-rake.edit', compact('roofestimatecalculatoreaverake'));
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculatoreaverake = RoofEstimateCalculatorEaveRake::findOrFail($id);
             $roofestimatecalculatoreaverake->update($requestData);

             return redirect('roofEstimateCalculatorEaveRake/roof-estimate-calculator-eave-rake')->with('flash_message', 'RoofEstimateCalculatorEaveRake updated!');
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
        $model = str_slug('roofestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculatorEaveRake::destroy($id);

            return redirect('roofEstimateCalculatorEaveRake/roof-estimate-calculator-eave-rake')->with('flash_message', 'RoofEstimateCalculatorEaveRake deleted!');
        }
        return response(view('403'), 403);

    }
}
