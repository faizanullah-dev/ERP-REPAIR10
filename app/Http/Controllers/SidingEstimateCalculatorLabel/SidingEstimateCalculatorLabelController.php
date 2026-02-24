<?php

namespace App\Http\Controllers\SidingEstimateCalculatorLabel;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SidingEstimateCalculatorLabel;
use Illuminate\Http\Request;

class SidingEstimateCalculatorLabelController extends Controller
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $sidingestimatecalculatorlabel = SidingEstimateCalculatorLabel::where('siding_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $sidingestimatecalculatorlabel = SidingEstimateCalculatorLabel::paginate($perPage);
            }

            return view('sidingEstimateCalculatorLabel.siding-estimate-calculator-label.index', compact('sidingestimatecalculatorlabel'));
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('sidingEstimateCalculatorLabel.siding-estimate-calculator-label.create');
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SidingEstimateCalculatorLabel::create($requestData);
            return redirect('sidingEstimateCalculatorLabel/siding-estimate-calculator-label')->with('flash_message', 'SidingEstimateCalculatorLabel added!');
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $sidingestimatecalculatorlabel = SidingEstimateCalculatorLabel::findOrFail($id);
            return view('sidingEstimateCalculatorLabel.siding-estimate-calculator-label.show', compact('sidingestimatecalculatorlabel'));
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $sidingestimatecalculatorlabel = SidingEstimateCalculatorLabel::findOrFail($id);
            return view('sidingEstimateCalculatorLabel.siding-estimate-calculator-label.edit', compact('sidingestimatecalculatorlabel'));
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $sidingestimatecalculatorlabel = SidingEstimateCalculatorLabel::findOrFail($id);
             $sidingestimatecalculatorlabel->update($requestData);

             return redirect('sidingEstimateCalculatorLabel/siding-estimate-calculator-label')->with('flash_message', 'SidingEstimateCalculatorLabel updated!');
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
        $model = str_slug('sidingestimatecalculatorlabel','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SidingEstimateCalculatorLabel::destroy($id);

            return redirect('sidingEstimateCalculatorLabel/siding-estimate-calculator-label')->with('flash_message', 'SidingEstimateCalculatorLabel deleted!');
        }
        return response(view('403'), 403);

    }
}
