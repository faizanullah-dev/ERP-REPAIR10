<?php

namespace App\Http\Controllers\StoreRoofEstimateCalculatorGutter;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreRoofEstimateCalculatorGutter;
use Illuminate\Http\Request;

class StoreRoofEstimateCalculatorGutterController extends Controller
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storeroofestimatecalculatorgutter = StoreRoofEstimateCalculatorGutter::where('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('recommended_price', 'LIKE', "%$keyword%")
                ->orWhere('gutter_sub_total', 'LIKE', "%$keyword%")
                ->orWhere('gutter_per_sq_price', 'LIKE', "%$keyword%")
                ->orWhere('gutter_sq_total_price', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_sub_total', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_per_sq_price', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_sq_total_price', 'LIKE', "%$keyword%")
                ->orWhere('guards_sub_total', 'LIKE', "%$keyword%")
                ->orWhere('guards_per_sq_price', 'LIKE', "%$keyword%")
                ->orWhere('guards_sq_total_price', 'LIKE', "%$keyword%")
                ->orWhere('project_cost', 'LIKE', "%$keyword%")
                ->orWhere('margin_profit', 'LIKE', "%$keyword%")
                ->orWhere('super_percentage', 'LIKE', "%$keyword%")
                ->orWhere('super_total', 'LIKE', "%$keyword%")
                ->orWhere('sales_percentage', 'LIKE', "%$keyword%")
                ->orWhere('sales_total', 'LIKE', "%$keyword%")
                ->orWhere('direct_cost', 'LIKE', "%$keyword%")
                ->orWhere('net_profit', 'LIKE', "%$keyword%")
                ->orWhere('margin_percentage', 'LIKE', "%$keyword%")
                ->orWhere('net_profit_percentage', 'LIKE', "%$keyword%")
                ->orWhere('recommended_price_two', 'LIKE', "%$keyword%")
                ->orWhere('gutter_sub_total_two', 'LIKE', "%$keyword%")
                ->orWhere('gutter_per_sq_price_two', 'LIKE', "%$keyword%")
                ->orWhere('gutter_sq_total_price_two', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_sub_total_two', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_per_sq_price_two', 'LIKE', "%$keyword%")
                ->orWhere('downspouts_sq_total_price_two', 'LIKE', "%$keyword%")
                ->orWhere('guards_sub_total_two', 'LIKE', "%$keyword%")
                ->orWhere('guards_per_sq_price_two', 'LIKE', "%$keyword%")
                ->orWhere('guards_sq_total_price_two', 'LIKE', "%$keyword%")
                ->orWhere('project_cost_two', 'LIKE', "%$keyword%")
                ->orWhere('margin_profit_two', 'LIKE', "%$keyword%")
                ->orWhere('super_percentage_two', 'LIKE', "%$keyword%")
                ->orWhere('super_total_two', 'LIKE', "%$keyword%")
                ->orWhere('sales_percentage_two', 'LIKE', "%$keyword%")
                ->orWhere('sales_total_two', 'LIKE', "%$keyword%")
                ->orWhere('direct_cost_two', 'LIKE', "%$keyword%")
                ->orWhere('net_profit_two', 'LIKE', "%$keyword%")
                ->orWhere('margin_percentage_two', 'LIKE', "%$keyword%")
                ->orWhere('net_profit_percentage_two', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storeroofestimatecalculatorgutter = StoreRoofEstimateCalculatorGutter::paginate($perPage);
            }

            return view('storeRoofEstimateCalculatorGutter.store-roof-estimate-calculator-gutter.index', compact('storeroofestimatecalculatorgutter'));
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeRoofEstimateCalculatorGutter.store-roof-estimate-calculator-gutter.create');
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreRoofEstimateCalculatorGutter::create($requestData);
            return redirect('storeRoofEstimateCalculatorGutter/store-roof-estimate-calculator-gutter')->with('flash_message', 'StoreRoofEstimateCalculatorGutter added!');
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storeroofestimatecalculatorgutter = StoreRoofEstimateCalculatorGutter::findOrFail($id);
            return view('storeRoofEstimateCalculatorGutter.store-roof-estimate-calculator-gutter.show', compact('storeroofestimatecalculatorgutter'));
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storeroofestimatecalculatorgutter = StoreRoofEstimateCalculatorGutter::findOrFail($id);
            return view('storeRoofEstimateCalculatorGutter.store-roof-estimate-calculator-gutter.edit', compact('storeroofestimatecalculatorgutter'));
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storeroofestimatecalculatorgutter = StoreRoofEstimateCalculatorGutter::findOrFail($id);
             $storeroofestimatecalculatorgutter->update($requestData);

             return redirect('storeRoofEstimateCalculatorGutter/store-roof-estimate-calculator-gutter')->with('flash_message', 'StoreRoofEstimateCalculatorGutter updated!');
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
        $model = str_slug('storeroofestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreRoofEstimateCalculatorGutter::destroy($id);

            return redirect('storeRoofEstimateCalculatorGutter/store-roof-estimate-calculator-gutter')->with('flash_message', 'StoreRoofEstimateCalculatorGutter deleted!');
        }
        return response(view('403'), 403);

    }
}
