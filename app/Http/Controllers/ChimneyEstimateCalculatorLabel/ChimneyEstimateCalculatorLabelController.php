<?php

namespace App\Http\Controllers\ChimneyEstimateCalculatorLabel;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ChimneyEstimateCalculatorLabel;
use Illuminate\Http\Request;

class ChimneyEstimateCalculatorLabelController extends Controller
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chimneyestimatecalculatorlabel = ChimneyEstimateCalculatorLabel::where('chimney_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chimneyestimatecalculatorlabel = ChimneyEstimateCalculatorLabel::paginate($perPage);
            }

            return view('chimneyEstimateCalculatorLabel.chimney-estimate-calculator-label.index', compact('chimneyestimatecalculatorlabel'));
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('chimneyEstimateCalculatorLabel.chimney-estimate-calculator-label.create');
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChimneyEstimateCalculatorLabel::create($requestData);
            return redirect('chimneyEstimateCalculatorLabel/chimney-estimate-calculator-label')->with('flash_message', 'ChimneyEstimateCalculatorLabel added!');
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chimneyestimatecalculatorlabel = ChimneyEstimateCalculatorLabel::findOrFail($id);
            return view('chimneyEstimateCalculatorLabel.chimney-estimate-calculator-label.show', compact('chimneyestimatecalculatorlabel'));
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chimneyestimatecalculatorlabel = ChimneyEstimateCalculatorLabel::findOrFail($id);
            return view('chimneyEstimateCalculatorLabel.chimney-estimate-calculator-label.edit', compact('chimneyestimatecalculatorlabel'));
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chimneyestimatecalculatorlabel = ChimneyEstimateCalculatorLabel::findOrFail($id);
             $chimneyestimatecalculatorlabel->update($requestData);

             return redirect('chimneyEstimateCalculatorLabel/chimney-estimate-calculator-label')->with('flash_message', 'ChimneyEstimateCalculatorLabel updated!');
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
        $model = str_slug('chimneyestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChimneyEstimateCalculatorLabel::destroy($id);

            return redirect('chimneyEstimateCalculatorLabel/chimney-estimate-calculator-label')->with('flash_message', 'ChimneyEstimateCalculatorLabel deleted!');
        }
        return response(view('403'), 403);

    }
}
