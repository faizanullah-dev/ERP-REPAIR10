<?php

namespace App\Http\Controllers\CalculatorBaseValue;

use App\ChimneyBase;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CalculatorBaseValue;
use Illuminate\Http\Request;

class CalculatorBaseValueController extends Controller
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $calculatorbasevalue = CalculatorBaseValue::where('roof', 'LIKE', "%$keyword%")
                ->orWhere('siding', 'LIKE', "%$keyword%")
                ->orWhere('chimney', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $calculatorbasevalue = CalculatorBaseValue::paginate($perPage);
            }

            return view('calculatorBaseValue.calculator-base-value.index', compact('calculatorbasevalue'));
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('calculatorBaseValue.calculator-base-value.create');
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $jsonData = $request->all();
            unset($jsonData['_token']);
            $jsonString = json_encode($jsonData);
            $record = CalculatorBaseValue::find(1);
            $record->update(['chimney'=>$jsonString]);
            return back()->with('message','Chimney Base Added Successfully');
        }
        return response(view('403'), 403);
    }

    public function storeSideBaseValue(Request $request)
    {
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $jsonData = $request->all();
            unset($jsonData['_token']);
            $jsonString = json_encode($jsonData);
            $record = CalculatorBaseValue::find(1);
            $record->update(['siding'=>$jsonString]);
            return back()->with('message','Siding Base Added Successfully');
        }
        return response(view('403'), 403);
    }

    public function storeRoofBaseValue(Request $request)
    {
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $jsonData = $request->all();
            unset($jsonData['_token']);
            $jsonString = json_encode($jsonData);
            $record = CalculatorBaseValue::first();
            if ($record) {
                $record->update(['roof' => $jsonString]);
            } else {
                CalculatorBaseValue::create(['roof' => $jsonString]);
            }
            return back()->with('message','Roof Base Added Successfully');
        }
        return response(view('403'), 403);
    }

    public function storeRoofPreferredBaseValue(Request $request)
    {
        return $request->all();
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $jsonData = $request->all();
            unset($jsonData['_token']);
            $jsonString = json_encode($jsonData);
            $record = CalculatorBaseValue::first();
            if ($record) {
                $record->update(['roof' => $jsonString]);
            } else {
                CalculatorBaseValue::create(['roof' => $jsonString]);
            }
            return back()->with('message','Roof Base Added Successfully');
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $calculatorbasevalue = CalculatorBaseValue::findOrFail($id);
            return view('calculatorBaseValue.calculator-base-value.show', compact('calculatorbasevalue'));
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $calculatorbasevalue = CalculatorBaseValue::findOrFail($id);
            return view('calculatorBaseValue.calculator-base-value.edit', compact('calculatorbasevalue'));
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $calculatorbasevalue = CalculatorBaseValue::findOrFail($id);
             $calculatorbasevalue->update($requestData);

             return redirect('calculatorBaseValue/calculator-base-value')->with('flash_message', 'CalculatorBaseValue updated!');
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
        $model = str_slug('calculatorbasevalue','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CalculatorBaseValue::destroy($id);

            return redirect('calculatorBaseValue/calculator-base-value')->with('flash_message', 'CalculatorBaseValue deleted!');
        }
        return response(view('403'), 403);
    }

    public function storeRoofMarginProfit(Request $request){
        $validated = $request->validate([
            'roof_margin_profit' => 'required|numeric|min:0|max:100',
        ]);
        $roofBase = CalculatorBaseValue::first();
        if ($roofBase) {
            $roofBase->update(['roof_margin_profit' => $validated['roof_margin_profit']]);
            return back()->with('flash_message', 'Roof Margin Profit Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeSideMarginProfit(Request $request){
        $validated = $request->validate([
            'siding_margin_profit' => 'required|numeric|min:0|max:100',
        ]);
        $sideBase = CalculatorBaseValue::first();
        if ($sideBase) {
            $sideBase->update(['siding_margin_profit' => $validated['siding_margin_profit']]);
            return back()->with('flash_message', 'Side Margin Profit Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeChimneyBaseChimney(Request $request){
        $validated = $request->validate([
            'chimney.stories' => 'required|numeric|min:0',
            'chimney.pitch' => 'required|numeric|min:0',
            'chimney.difficulty' => 'required|numeric|min:0',
            'chimney.cap' => 'required|numeric|min:0',
            'chimney.margin_profit' => 'required|numeric|min:0',
        ]);
        $chimneyBase = CalculatorBaseValue::first();

        if ($chimneyBase) {
            $chimneyBase->update([
                'chimney_chimney' => json_encode($request['chimney']),
            ]);
            return back()->with('flash_message', 'Chimney Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function storeChimneyMarginProfit(Request $request){
//        $validated = $request->validate([
//            'margin_profit' => 'required|numeric|min:0|max:100',
//        ]);
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'chimney_liner' => json_encode($request['liner'])
            ]);
            return back()->with('flash_message', 'Chimney Margin Profit Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function storeRoofBasePrefer(Request $request){
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'roof_prefer' => json_encode($request['prefer']),
            ]);
            return back()->with('flash_message', 'Roof Prefer Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeRoofBaseSystem(Request $request){
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'roof_system' => json_encode($request['system']),
            ]);
            return back()->with('flash_message', 'Roof System Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeRoofBaseUnderSq(Request $request){
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'roof_under_sq' => json_encode($request['under_sq']),
            ]);
            return back()->with('flash_message', 'Roof Under 15 sq Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeRoofBaseGutter(Request $request){
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'roof_gutter' => json_encode($request['gutter']),
            ]);
            return back()->with('flash_message', 'Roof Gutter Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeRoofBaseFlatRoof(Request $request){
        $chimneyBase = CalculatorBaseValue::first();
        if ($chimneyBase) {
            $chimneyBase->update([
                'roof_flat_roof' => json_encode($request['flat_roof']),
            ]);
            return back()->with('flash_message', 'Roof flat roof Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
    public function storeSideBaseReplacement(Request $request){
        $sidingBase = CalculatorBaseValue::first();
        if ($sidingBase) {
            $sidingBase->update([
                'siding_replacement' => json_encode($request['replacement']),
            ]);
            return back()->with('flash_message', 'Siding replacement Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
        }

        public function storeSideBaseOverExisting(Request $request){
            $sidingBase = CalculatorBaseValue::first();
            if ($sidingBase) {
                $sidingBase->update([
                    'siding_over_existing' => json_encode($request['existing']),
                ]);
                return back()->with('flash_message', 'Siding over existing Base Updated!');
            } else {
                return response()->json(['message' => 'Record not found'], 404);
            }
        }
    public function storeSideBaseGutter(Request $request){
        $sidingBase = CalculatorBaseValue::first();
        if ($sidingBase) {
            $sidingBase->update([
                'siding_gutter' => json_encode($request['gutter']),
            ]);
            return back()->with('flash_message', 'Siding gutter Base Updated!');
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
}
