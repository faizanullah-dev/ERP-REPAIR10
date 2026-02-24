<?php

namespace App\Http\Controllers\RoofEstimateCalculatorFlatRoof;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoofEstimateCalculatorFlatRoof;
use Illuminate\Http\Request;

class RoofEstimateCalculatorFlatRoofController extends Controller
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculatorflatroof = RoofEstimateCalculatorFlatRoof::where('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('recommended_price', 'LIKE', "%$keyword%")
                ->orWhere('roofing_price', 'LIKE', "%$keyword%")
                ->orWhere('total_sq', 'LIKE', "%$keyword%")
                ->orWhere('additional_layer', 'LIKE', "%$keyword%")
                ->orWhere('additional_layer_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('step_charge', 'LIKE', "%$keyword%")
                ->orWhere('step_charge_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('chimney_size', 'LIKE', "%$keyword%")
                ->orWhere('chimney_size_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('siding_azeck', 'LIKE', "%$keyword%")
                ->orWhere('siding_azeck_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('plywood', 'LIKE', "%$keyword%")
                ->orWhere('plywood_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('skylight_price', 'LIKE', "%$keyword%")
                ->orWhere('skylight_price_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('materials_price_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('materials_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('labour_price_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('labour_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('dumpster_price_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('dumster_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('permit_warranty_price_price_per_sq', 'LIKE', "%$keyword%")
                ->orWhere('permit_warranty_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('project_cost', 'LIKE', "%$keyword%")
                ->orWhere('margin_profit', 'LIKE', "%$keyword%")
                ->orWhere('super_percentage', 'LIKE', "%$keyword%")
                ->orWhere('super_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('sales_percentage', 'LIKE', "%$keyword%")
                ->orWhere('sales_price_price_final', 'LIKE', "%$keyword%")
                ->orWhere('directory_cost', 'LIKE', "%$keyword%")
                ->orWhere('net_profit', 'LIKE', "%$keyword%")
                ->orWhere('margin_percentage', 'LIKE', "%$keyword%")
                ->orWhere('net_profit_percentage', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roofestimatecalculatorflatroof = RoofEstimateCalculatorFlatRoof::paginate($perPage);
            }

            return view('roofEstimateCalculatorFlatRoof.roof-estimate-calculator-flat-roof.index', compact('roofestimatecalculatorflatroof'));
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roofEstimateCalculatorFlatRoof.roof-estimate-calculator-flat-roof.create');
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            RoofEstimateCalculatorFlatRoof::create($requestData);
            return redirect('roofEstimateCalculatorFlatRoof/roof-estimate-calculator-flat-roof')->with('flash_message', 'RoofEstimateCalculatorFlatRoof added!');
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculatorflatroof = RoofEstimateCalculatorFlatRoof::findOrFail($id);
            return view('roofEstimateCalculatorFlatRoof.roof-estimate-calculator-flat-roof.show', compact('roofestimatecalculatorflatroof'));
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculatorflatroof = RoofEstimateCalculatorFlatRoof::findOrFail($id);
            return view('roofEstimateCalculatorFlatRoof.roof-estimate-calculator-flat-roof.edit', compact('roofestimatecalculatorflatroof'));
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculatorflatroof = RoofEstimateCalculatorFlatRoof::findOrFail($id);
             $roofestimatecalculatorflatroof->update($requestData);

             return redirect('roofEstimateCalculatorFlatRoof/roof-estimate-calculator-flat-roof')->with('flash_message', 'RoofEstimateCalculatorFlatRoof updated!');
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
        $model = str_slug('roofestimatecalculatorflatroof','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculatorFlatRoof::destroy($id);

            return redirect('roofEstimateCalculatorFlatRoof/roof-estimate-calculator-flat-roof')->with('flash_message', 'RoofEstimateCalculatorFlatRoof deleted!');
        }
        return response(view('403'), 403);

    }
}
