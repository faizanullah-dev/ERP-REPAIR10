<?php

namespace App\Http\Controllers\RoofEstimateCalculatorDownspout;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateCalculatorDownspout;
use Illuminate\Http\Request;

class RoofEstimateCalculatorDownspoutController extends Controller
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculatordownspout = RoofEstimateCalculatorDownspout::where('gutters', 'LIKE', "%$keyword%")
                ->orWhere('downspouts', 'LIKE', "%$keyword%")
                ->orWhere('guards', 'LIKE', "%$keyword%")
                ->orWhere('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimatecalculatordownspout = RoofEstimateCalculatorDownspout::paginate($perPage);
            }

            return view('roofEstimateCalculatorDownspout.roof-estimate-calculator-downspout.index', compact('roofestimatecalculatordownspout'));
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateCalculatorDownspout.roof-estimate-calculator-downspout.create');
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateCalculatorDownspout::create($requestData);
            return redirect('roofEstimateCalculatorDownspout/roof-estimate-calculator-downspout')->with('flash_message', 'RoofEstimateCalculatorDownspout added!');
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculatordownspout = RoofEstimateCalculatorDownspout::findOrFail($id);
            return view('roofEstimateCalculatorDownspout.roof-estimate-calculator-downspout.show', compact('roofestimatecalculatordownspout'));
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculatordownspout = RoofEstimateCalculatorDownspout::findOrFail($id);
            return view('roofEstimateCalculatorDownspout.roof-estimate-calculator-downspout.edit', compact('roofestimatecalculatordownspout'));
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculatordownspout = RoofEstimateCalculatorDownspout::findOrFail($id);
             $roofestimatecalculatordownspout->update($requestData);

             return redirect('roofEstimateCalculatorDownspout/roof-estimate-calculator-downspout')->with('flash_message', 'RoofEstimateCalculatorDownspout updated!');
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
        $model = str_slug('roofestimatecalculatordownspout','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculatorDownspout::destroy($id);

            return redirect('roofEstimateCalculatorDownspout/roof-estimate-calculator-downspout')->with('flash_message', 'RoofEstimateCalculatorDownspout deleted!');
        }
        return response(view('403'), 403);

    }
}
