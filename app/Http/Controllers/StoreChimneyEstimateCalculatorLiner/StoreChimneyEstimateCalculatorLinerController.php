<?php

namespace App\Http\Controllers\StoreChimneyEstimateCalculatorLiner;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreChimneyEstimateCalculatorLiner;
use Illuminate\Http\Request;

class StoreChimneyEstimateCalculatorLinerController extends Controller
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storechimneyestimatecalculatorliner = StoreChimneyEstimateCalculatorLiner::where('chimney_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storechimneyestimatecalculatorliner = StoreChimneyEstimateCalculatorLiner::paginate($perPage);
            }

            return view('storeChimneyEstimateCalculatorLiner.store-chimney-estimate-calculator-liner.index', compact('storechimneyestimatecalculatorliner'));
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeChimneyEstimateCalculatorLiner.store-chimney-estimate-calculator-liner.create');
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreChimneyEstimateCalculatorLiner::create($requestData);
            return redirect('storeChimneyEstimateCalculatorLiner/store-chimney-estimate-calculator-liner')->with('flash_message', 'StoreChimneyEstimateCalculatorLiner added!');
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storechimneyestimatecalculatorliner = StoreChimneyEstimateCalculatorLiner::findOrFail($id);
            return view('storeChimneyEstimateCalculatorLiner.store-chimney-estimate-calculator-liner.show', compact('storechimneyestimatecalculatorliner'));
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storechimneyestimatecalculatorliner = StoreChimneyEstimateCalculatorLiner::findOrFail($id);
            return view('storeChimneyEstimateCalculatorLiner.store-chimney-estimate-calculator-liner.edit', compact('storechimneyestimatecalculatorliner'));
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storechimneyestimatecalculatorliner = StoreChimneyEstimateCalculatorLiner::findOrFail($id);
             $storechimneyestimatecalculatorliner->update($requestData);

             return redirect('storeChimneyEstimateCalculatorLiner/store-chimney-estimate-calculator-liner')->with('flash_message', 'StoreChimneyEstimateCalculatorLiner updated!');
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
        $model = str_slug('storechimneyestimatecalculatorliner','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreChimneyEstimateCalculatorLiner::destroy($id);

            return redirect('storeChimneyEstimateCalculatorLiner/store-chimney-estimate-calculator-liner')->with('flash_message', 'StoreChimneyEstimateCalculatorLiner deleted!');
        }
        return response(view('403'), 403);

    }
}
