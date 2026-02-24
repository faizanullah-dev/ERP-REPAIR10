<?php

namespace App\Http\Controllers\RoofEstimateCalculator;

use App\CalculatorBaseValue;
use App\CalculatorSize;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\RoofEstimateCalculator;
use Illuminate\Http\Request;

class RoofEstimateCalculatorController extends Controller
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roofestimatecalculator = RoofEstimateCalculator::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('sub_total_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('waste_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('total_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('waste_eave_flat_area', 'LIKE', "%$keyword%")
                ->orWhere('total_eave_flat_area', 'LIKE', "%$keyword%")
                ->orWhere('sub_total_gutters', 'LIKE', "%$keyword%")
                ->orWhere('sub_total_downspouts', 'LIKE', "%$keyword%")
                ->orWhere('sub_total_guards', 'LIKE', "%$keyword%")
                ->orWhere('total_all_guards', 'LIKE', "%$keyword%")
                ->orWhere('total_sq', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
               $roofestimatecalculator = RoofEstimateCalculator::orderBy('id','DESC')->paginate($perPage);
                $roofBase = CalculatorBaseValue::first();
            }//ends if else.
            return view('roofEstimateCalculator.roof-estimate-calculator.index', compact('roofestimatecalculator', 'roofBase'));
        }//ends if.
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
//            return $roofBase = CalculatorBaseValue::get();
            $roofestimatecalculators = RoofEstimateCalculator::get();
            $leadIds = $roofestimatecalculators->pluck('lead_id')->toArray();
            $leads = Lead::whereNotIn('id', $leadIds)->get();
            $calculatorSizes = CalculatorSize::where('status', 1)->get();
            return view('roofEstimateCalculator.roof-estimate-calculator.create',compact('leads', 'calculatorSizes'));
        }
        return response(view('403'), 403);

    }
    public function roofBase()
    {
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $roofBase = CalculatorBaseValue::first();
//            $formData = json_decode($roofBase->roof, true);
            $formData = $roofBase && $roofBase->roof ? json_decode($roofBase->roof, true) : null;
             $roofBaseValue = [
                'roof_prefer'     => json_decode($roofBase->roof_prefer, true),
                'roof_system'     => json_decode($roofBase->roof_system, true),
                'roof_under_sq'   => json_decode($roofBase->roof_under_sq, true),
                'roof_gutter'     => json_decode($roofBase->roof_gutter, true),
                'roof_flat_roof'  => json_decode($roofBase->roof_flat_roof, true),
            ];
            return view('roofEstimateCalculator.roof-estimate-calculator.roof_base',compact('formData', 'roofBaseValue'));
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            RoofEstimateCalculator::create($requestData);
            return redirect('roofEstimateCalculator/roof-estimate-calculator')->with('flash_message', 'RoofEstimateCalculator added!');
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roofestimatecalculator = RoofEstimateCalculator::findOrFail($id);
            return view('roofEstimateCalculator.roof-estimate-calculator.show', compact('roofestimatecalculator'));
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roofestimatecalculator = RoofEstimateCalculator::findOrFail($id);
            return view('roofEstimateCalculator.roof-estimate-calculator.edit', compact('roofestimatecalculator'));
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $roofestimatecalculator = RoofEstimateCalculator::findOrFail($id);
             $roofestimatecalculator->update($requestData);

             return redirect('roofEstimateCalculator/roof-estimate-calculator')->with('flash_message', 'RoofEstimateCalculator updated!');
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
        $model = str_slug('roofestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoofEstimateCalculator::destroy($id);

            return redirect('roofEstimateCalculator/roof-estimate-calculator')->with('flash_message', 'RoofEstimateCalculator deleted!');
        }
        return response(view('403'), 403);
    }

    public function getRoofBaseValue(Request $request)
    {
        try {
            $roofBase = CalculatorBaseValue::first()->roof ?? null;
            if ($roofBase === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No data found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'roof' => $roofBase,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve base value',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
