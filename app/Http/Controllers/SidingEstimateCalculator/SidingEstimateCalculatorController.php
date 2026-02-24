<?php

namespace App\Http\Controllers\SidingEstimateCalculator;

use App\CalculatorBaseValue;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Lead;
use App\SidingEstimateCalculator;
use App\StoreSideEstimateOverExist;
use App\StoreSideEstimateReplacement;
use Illuminate\Http\Request;

class SidingEstimateCalculatorController extends Controller
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $sidingestimatecalculator = SidingEstimateCalculator::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('waste_percent_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('waste_eave_rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_rakes_total', 'LIKE', "%$keyword%")
                ->orWhere('eave_rakes_subtotal', 'LIKE', "%$keyword%")
                ->orWhere('gutters_total', 'LIKE', "%$keyword%")
                ->orWhere('guards_total', 'LIKE', "%$keyword%")
                ->orWhere('downspout_total', 'LIKE', "%$keyword%")
                ->orWhere('eave_rakes_total_percent', 'LIKE', "%$keyword%")
                ->orWhere('soffit_eave', 'LIKE', "%$keyword%")
                ->orWhere('soffit_rakes', 'LIKE', "%$keyword%")
                ->orWhere('soffit_porch', 'LIKE', "%$keyword%")
                ->orWhere('soffit_eave_total', 'LIKE', "%$keyword%")
                ->orWhere('soffit_rakes_total', 'LIKE', "%$keyword%")
                ->orWhere('soffit_porch_total', 'LIKE', "%$keyword%")
                ->orWhere('soffit_eave_percent', 'LIKE', "%$keyword%")
                ->orWhere('soffit_rakes_percent', 'LIKE', "%$keyword%")
                ->orWhere('soffit_porch_percent', 'LIKE', "%$keyword%")
                ->orWhere('soffit_total_sum', 'LIKE', "%$keyword%")
                ->orWhere('notes', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $sidingestimatecalculator = SidingEstimateCalculator::paginate($perPage);
                $sideBase = CalculatorBaseValue::first();

            }

            return view('sidingEstimateCalculator.siding-estimate-calculator.index', compact('sidingestimatecalculator', 'sideBase'));
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $sidingestimatecalculators = SidingEstimateCalculator::get();
            $leadIds = $sidingestimatecalculators->pluck('lead_id')->toArray();
            $leads = Lead::whereNotIn('id', $leadIds)->get();
            return view('sidingEstimateCalculator.siding-estimate-calculator.create',compact('leads'));
        }
        return response(view('403'), 403);

    }
    public function sideBase()
    {
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $sidingBase = CalculatorBaseValue::find(1);
            $formData = json_decode($sidingBase->siding, true);
            $sideBaseValue = [
                'side_replacement'     => json_decode($sidingBase->siding_replacement, true),
                'side_over_existing'     => json_decode($sidingBase->siding_over_existing, true),
                'side_gutter'   => json_decode($sidingBase->siding_gutter, true),
            ];
            return view('sidingEstimateCalculator.siding-estimate-calculator.side_base',compact('formData', 'sideBaseValue'));
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SidingEstimateCalculator::create($requestData);
            return redirect('sidingEstimateCalculator/siding-estimate-calculator')->with('flash_message', 'SidingEstimateCalculator added!');
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $sidingestimatecalculator = SidingEstimateCalculator::findOrFail($id);
            return view('sidingEstimateCalculator.siding-estimate-calculator.show', compact('sidingestimatecalculator'));
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $sidingestimatecalculator = SidingEstimateCalculator::findOrFail($id);
            return view('sidingEstimateCalculator.siding-estimate-calculator.edit', compact('sidingestimatecalculator'));
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $sidingestimatecalculator = SidingEstimateCalculator::findOrFail($id);
             $sidingestimatecalculator->update($requestData);

             return redirect('sidingEstimateCalculator/siding-estimate-calculator')->with('flash_message', 'SidingEstimateCalculator updated!');
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
        $model = str_slug('sidingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SidingEstimateCalculator::destroy($id);

            return redirect('sidingEstimateCalculator/siding-estimate-calculator')->with('flash_message', 'SidingEstimateCalculator deleted!');
        }
        return response(view('403'), 403);

    }
    public function getSidingBaseValue(Request $request)
    {
        try {
            $sidingBase = CalculatorBaseValue::first()->siding ?? null;
            if ($sidingBase === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No data found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'siding' => $sidingBase,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve base value',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function storeSidingReplacement(Request  $request){
        extract($request->all());
        try {
            StoreSideEstimateReplacement::updateOrCreate(['side_estimate_calculator_id' => $side_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeSidingReplacement.

    public function storeSidingOverExisting(Request  $request){
        extract($request->all());
        try {
            StoreSideEstimateOverExist::updateOrCreate(['side_estimate_calculator_id' => $side_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeSidingReplacement.
}
