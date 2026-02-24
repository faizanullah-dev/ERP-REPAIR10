<?php

namespace App\Http\Controllers\RoofEstimateCalculatorLabel;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateCalculatorLabel;
use Illuminate\Http\Request;

class RoofEstimateCalculatorLabelController extends Controller
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculatorlabel = RoofEstimateCalculatorLabel::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->orWhere('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimatecalculatorlabel = RoofEstimateCalculatorLabel::paginate($perPage);
            }

            return view('roofEstimateCalculatorLabel.roof-estimate-calculator-label.index', compact('roofestimatecalculatorlabel'));
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateCalculatorLabel.roof-estimate-calculator-label.create');
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateCalculatorLabel::create($requestData);
            return redirect('roofEstimateCalculatorLabel/roof-estimate-calculator-label')->with('flash_message', 'RoofEstimateCalculatorLabel added!');
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculatorlabel = RoofEstimateCalculatorLabel::findOrFail($id);
            return view('roofEstimateCalculatorLabel.roof-estimate-calculator-label.show', compact('roofestimatecalculatorlabel'));
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculatorlabel = RoofEstimateCalculatorLabel::findOrFail($id);
            return view('roofEstimateCalculatorLabel.roof-estimate-calculator-label.edit', compact('roofestimatecalculatorlabel'));
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculatorlabel = RoofEstimateCalculatorLabel::findOrFail($id);
             $roofestimatecalculatorlabel->update($requestData);

             return redirect('roofEstimateCalculatorLabel/roof-estimate-calculator-label')->with('flash_message', 'RoofEstimateCalculatorLabel updated!');
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
        $model = str_slug('roofestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculatorLabel::destroy($id);

            return redirect('roofEstimateCalculatorLabel/roof-estimate-calculator-label')->with('flash_message', 'RoofEstimateCalculatorLabel deleted!');
        }
        return response(view('403'), 403);

    }
}
