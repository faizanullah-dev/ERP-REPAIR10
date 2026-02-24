<?php

namespace App\Http\Controllers\SidingEstimateCalculatorEaveRake;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SidingEstimateCalculatorEaveRake;
use Illuminate\Http\Request;

class SidingEstimateCalculatorEaveRakeController extends Controller
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $sidingestimatecalculatoreaverake = SidingEstimateCalculatorEaveRake::where('siding_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('eave', 'LIKE', "%$keyword%")
                ->orWhere('rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_final_rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_final_rakes_total', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $sidingestimatecalculatoreaverake = SidingEstimateCalculatorEaveRake::paginate($perPage);
            }

            return view('sidingEstimateCalculatorEaveRake.siding-estimate-calculator-eave-rake.index', compact('sidingestimatecalculatoreaverake'));
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('sidingEstimateCalculatorEaveRake.siding-estimate-calculator-eave-rake.create');
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SidingEstimateCalculatorEaveRake::create($requestData);
            return redirect('sidingEstimateCalculatorEaveRake/siding-estimate-calculator-eave-rake')->with('flash_message', 'SidingEstimateCalculatorEaveRake added!');
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $sidingestimatecalculatoreaverake = SidingEstimateCalculatorEaveRake::findOrFail($id);
            return view('sidingEstimateCalculatorEaveRake.siding-estimate-calculator-eave-rake.show', compact('sidingestimatecalculatoreaverake'));
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $sidingestimatecalculatoreaverake = SidingEstimateCalculatorEaveRake::findOrFail($id);
            return view('sidingEstimateCalculatorEaveRake.siding-estimate-calculator-eave-rake.edit', compact('sidingestimatecalculatoreaverake'));
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $sidingestimatecalculatoreaverake = SidingEstimateCalculatorEaveRake::findOrFail($id);
             $sidingestimatecalculatoreaverake->update($requestData);

             return redirect('sidingEstimateCalculatorEaveRake/siding-estimate-calculator-eave-rake')->with('flash_message', 'SidingEstimateCalculatorEaveRake updated!');
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
        $model = str_slug('sidingestimatecalculatoreaverake','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SidingEstimateCalculatorEaveRake::destroy($id);

            return redirect('sidingEstimateCalculatorEaveRake/siding-estimate-calculator-eave-rake')->with('flash_message', 'SidingEstimateCalculatorEaveRake deleted!');
        }
        return response(view('403'), 403);

    }
}
