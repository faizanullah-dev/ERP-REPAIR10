<?php

namespace App\Http\Controllers\ChimneyEstimateCalculator;

use App\CalculatorBaseValue;
use App\ChimneyBase;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Lead;

use App\ChimneyEstimateCalculator;
use Illuminate\Http\Request;

class ChimneyEstimateCalculatorController extends Controller
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chimneyestimatecalculator = ChimneyEstimateCalculator::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('sub_total_bricks_rows', 'LIKE', "%$keyword%")
                ->orWhere('waste_bricks_rows', 'LIKE', "%$keyword%")
                ->orWhere('total_waste_bricks_rows', 'LIKE', "%$keyword%")
                ->orWhere('total_bricks_rows', 'LIKE', "%$keyword%")
                ->orWhere('notes', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chimneyestimatecalculator = ChimneyEstimateCalculator::paginate($perPage);
            }

                return view('chimneyEstimateCalculator.chimney-estimate-calculator.index', compact('chimneyestimatecalculator'));
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $chimneyestimatecalculators = ChimneyEstimateCalculator::get();
//            $leadIds = $chimneyestimatecalculators->pluck('lead_id')->toArray();
            $leadIds = $chimneyestimatecalculators->pluck('lead_id')->filter()->toArray();
            $leads = Lead::whereNotIn('id', $leadIds)->get();
            return view('chimneyEstimateCalculator.chimney-estimate-calculator.create',compact('leads'));
        }
        return response(view('403'), 403);

    }
    public function chimneyBase()
    {
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $chimneyBase = CalculatorBaseValue::find(1);
            $formData = json_decode($chimneyBase->chimney, true);
            $chimneyChimney = json_decode($chimneyBase->chimney_chimney);
            $chimneyLiner = json_decode($chimneyBase->chimney_liner);
            return view('chimneyEstimateCalculator.chimney-estimate-calculator.chimney_base',compact('chimneyBase','formData', 'chimneyChimney','chimneyLiner'));
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChimneyEstimateCalculator::create($requestData);
            return redirect('chimneyEstimateCalculator/chimney-estimate-calculator')->with('flash_message', 'ChimneyEstimateCalculator added!');
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chimneyestimatecalculator = ChimneyEstimateCalculator::findOrFail($id);
            return view('chimneyEstimateCalculator.chimney-estimate-calculator.show', compact('chimneyestimatecalculator'));
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chimneyestimatecalculator = ChimneyEstimateCalculator::findOrFail($id);
            return view('chimneyEstimateCalculator.chimney-estimate-calculator.edit', compact('chimneyestimatecalculator'));
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chimneyestimatecalculator = ChimneyEstimateCalculator::findOrFail($id);
             $chimneyestimatecalculator->update($requestData);

             return redirect('chimneyEstimateCalculator/chimney-estimate-calculator')->with('flash_message', 'ChimneyEstimateCalculator updated!');
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
        $model = str_slug('chimneyestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChimneyEstimateCalculator::destroy($id);

            return redirect('chimneyEstimateCalculator/chimney-estimate-calculator')->with('flash_message', 'ChimneyEstimateCalculator deleted!');
        }
        return response(view('403'), 403);

    }
    public function getChimneyBaseValue(Request $request)
    {
        try {
            $chimneyBase = CalculatorBaseValue::first()->chimney ?? null;
            if ($chimneyBase === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No data found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'chimney' => $chimneyBase,
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
