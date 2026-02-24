<?php

namespace App\Http\Controllers\StoreSideEstimateCalculatorGutter;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreSideEstimateCalculatorGutter;
use Illuminate\Http\Request;

class StoreSideEstimateCalculatorGutterController extends Controller
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storesideestimatecalculatorgutter = StoreSideEstimateCalculatorGutter::where('roof_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storesideestimatecalculatorgutter = StoreSideEstimateCalculatorGutter::paginate($perPage);
            }

            return view('storeSideEstimateCalculatorGutter.store-side-estimate-calculator-gutter.index', compact('storesideestimatecalculatorgutter'));
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeSideEstimateCalculatorGutter.store-side-estimate-calculator-gutter.create');
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreSideEstimateCalculatorGutter::create($requestData);
            return redirect('storeSideEstimateCalculatorGutter/store-side-estimate-calculator-gutter')->with('flash_message', 'StoreSideEstimateCalculatorGutter added!');
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storesideestimatecalculatorgutter = StoreSideEstimateCalculatorGutter::findOrFail($id);
            return view('storeSideEstimateCalculatorGutter.store-side-estimate-calculator-gutter.show', compact('storesideestimatecalculatorgutter'));
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storesideestimatecalculatorgutter = StoreSideEstimateCalculatorGutter::findOrFail($id);
            return view('storeSideEstimateCalculatorGutter.store-side-estimate-calculator-gutter.edit', compact('storesideestimatecalculatorgutter'));
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storesideestimatecalculatorgutter = StoreSideEstimateCalculatorGutter::findOrFail($id);
             $storesideestimatecalculatorgutter->update($requestData);

             return redirect('storeSideEstimateCalculatorGutter/store-side-estimate-calculator-gutter')->with('flash_message', 'StoreSideEstimateCalculatorGutter updated!');
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
        $model = str_slug('storesideestimatecalculatorgutter','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreSideEstimateCalculatorGutter::destroy($id);

            return redirect('storeSideEstimateCalculatorGutter/store-side-estimate-calculator-gutter')->with('flash_message', 'StoreSideEstimateCalculatorGutter deleted!');
        }
        return response(view('403'), 403);

    }
}
