<?php

namespace App\Http\Controllers\SidingEstimateCalculatorGuttersDownSpout;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SidingEstimateCalculatorGuttersDownSpout;
use Illuminate\Http\Request;

class SidingEstimateCalculatorGuttersDownSpoutController extends Controller
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $sidingestimatecalculatorguttersdownspout = SidingEstimateCalculatorGuttersDownSpout::where('siding_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('gutters', 'LIKE', "%$keyword%")
                ->orWhere('guards', 'LIKE', "%$keyword%")
                ->orWhere('downspouts', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $sidingestimatecalculatorguttersdownspout = SidingEstimateCalculatorGuttersDownSpout::paginate($perPage);
            }

            return view('sidingEstimateCalculatorGuttersDownSpout.siding-estimate-calculator-gutters-down-spout.index', compact('sidingestimatecalculatorguttersdownspout'));
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('sidingEstimateCalculatorGuttersDownSpout.siding-estimate-calculator-gutters-down-spout.create');
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SidingEstimateCalculatorGuttersDownSpout::create($requestData);
            return redirect('sidingEstimateCalculatorGuttersDownSpout/siding-estimate-calculator-gutters-down-spout')->with('flash_message', 'SidingEstimateCalculatorGuttersDownSpout added!');
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $sidingestimatecalculatorguttersdownspout = SidingEstimateCalculatorGuttersDownSpout::findOrFail($id);
            return view('sidingEstimateCalculatorGuttersDownSpout.siding-estimate-calculator-gutters-down-spout.show', compact('sidingestimatecalculatorguttersdownspout'));
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $sidingestimatecalculatorguttersdownspout = SidingEstimateCalculatorGuttersDownSpout::findOrFail($id);
            return view('sidingEstimateCalculatorGuttersDownSpout.siding-estimate-calculator-gutters-down-spout.edit', compact('sidingestimatecalculatorguttersdownspout'));
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $sidingestimatecalculatorguttersdownspout = SidingEstimateCalculatorGuttersDownSpout::findOrFail($id);
             $sidingestimatecalculatorguttersdownspout->update($requestData);

             return redirect('sidingEstimateCalculatorGuttersDownSpout/siding-estimate-calculator-gutters-down-spout')->with('flash_message', 'SidingEstimateCalculatorGuttersDownSpout updated!');
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
        $model = str_slug('sidingestimatecalculatorguttersdownspout','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SidingEstimateCalculatorGuttersDownSpout::destroy($id);

            return redirect('sidingEstimateCalculatorGuttersDownSpout/siding-estimate-calculator-gutters-down-spout')->with('flash_message', 'SidingEstimateCalculatorGuttersDownSpout deleted!');
        }
        return response(view('403'), 403);

    }
}
