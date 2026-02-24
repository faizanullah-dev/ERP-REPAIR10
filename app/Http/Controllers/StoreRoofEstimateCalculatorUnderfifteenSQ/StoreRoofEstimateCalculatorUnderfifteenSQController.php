<?php

namespace App\Http\Controllers\StoreRoofEstimateCalculatorUnderfifteenSQ;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreRoofEstimateCalculatorUnderfifteenSQ;
use Illuminate\Http\Request;

class StoreRoofEstimateCalculatorUnderfifteenSQController extends Controller
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storeroofestimatecalculatorunderfifteensq = StoreRoofEstimateCalculatorUnderfifteenSQ::where('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
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
                $storeroofestimatecalculatorunderfifteensq = StoreRoofEstimateCalculatorUnderfifteenSQ::paginate($perPage);
            }

            return view('storeRoofEstimateCalculatorUnderfifteenSQ.store-roof-estimate-calculator-underfifteen-s-q.index', compact('storeroofestimatecalculatorunderfifteensq'));
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeRoofEstimateCalculatorUnderfifteenSQ.store-roof-estimate-calculator-underfifteen-s-q.create');
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreRoofEstimateCalculatorUnderfifteenSQ::create($requestData);
            return redirect('storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q')->with('flash_message', 'StoreRoofEstimateCalculatorUnderfifteenSQ added!');
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storeroofestimatecalculatorunderfifteensq = StoreRoofEstimateCalculatorUnderfifteenSQ::findOrFail($id);
            return view('storeRoofEstimateCalculatorUnderfifteenSQ.store-roof-estimate-calculator-underfifteen-s-q.show', compact('storeroofestimatecalculatorunderfifteensq'));
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storeroofestimatecalculatorunderfifteensq = StoreRoofEstimateCalculatorUnderfifteenSQ::findOrFail($id);
            return view('storeRoofEstimateCalculatorUnderfifteenSQ.store-roof-estimate-calculator-underfifteen-s-q.edit', compact('storeroofestimatecalculatorunderfifteensq'));
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storeroofestimatecalculatorunderfifteensq = StoreRoofEstimateCalculatorUnderfifteenSQ::findOrFail($id);
             $storeroofestimatecalculatorunderfifteensq->update($requestData);

             return redirect('storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q')->with('flash_message', 'StoreRoofEstimateCalculatorUnderfifteenSQ updated!');
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
        $model = str_slug('storeroofestimatecalculatorunderfifteensq','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreRoofEstimateCalculatorUnderfifteenSQ::destroy($id);

            return redirect('storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q')->with('flash_message', 'StoreRoofEstimateCalculatorUnderfifteenSQ deleted!');
        }
        return response(view('403'), 403);

    }
}
