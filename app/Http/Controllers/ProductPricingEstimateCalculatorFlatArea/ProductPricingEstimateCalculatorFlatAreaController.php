<?php

namespace App\Http\Controllers\ProductPricingEstimateCalculatorFlatArea;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricingEstimateCalculatorFlatArea;
use Illuminate\Http\Request;

class ProductPricingEstimateCalculatorFlatAreaController extends Controller
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingestimatecalculatorflatarea = ProductPricingEstimateCalculatorFlatArea::where('product_pricing_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('eave', 'LIKE', "%$keyword%")
                ->orWhere('rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_rakes_total', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingestimatecalculatorflatarea = ProductPricingEstimateCalculatorFlatArea::paginate($perPage);
            }

            return view('productPricingEstimateCalculatorFlatArea.product-pricing-estimate-calculator-flat-area.index', compact('productpricingestimatecalculatorflatarea'));
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricingEstimateCalculatorFlatArea.product-pricing-estimate-calculator-flat-area.create');
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingEstimateCalculatorFlatArea::create($requestData);
            return redirect('productPricingEstimateCalculatorFlatArea/product-pricing-estimate-calculator-flat-area')->with('flash_message', 'ProductPricingEstimateCalculatorFlatArea added!');
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingestimatecalculatorflatarea = ProductPricingEstimateCalculatorFlatArea::findOrFail($id);
            return view('productPricingEstimateCalculatorFlatArea.product-pricing-estimate-calculator-flat-area.show', compact('productpricingestimatecalculatorflatarea'));
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingestimatecalculatorflatarea = ProductPricingEstimateCalculatorFlatArea::findOrFail($id);
            return view('productPricingEstimateCalculatorFlatArea.product-pricing-estimate-calculator-flat-area.edit', compact('productpricingestimatecalculatorflatarea'));
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingestimatecalculatorflatarea = ProductPricingEstimateCalculatorFlatArea::findOrFail($id);
             $productpricingestimatecalculatorflatarea->update($requestData);

             return redirect('productPricingEstimateCalculatorFlatArea/product-pricing-estimate-calculator-flat-area')->with('flash_message', 'ProductPricingEstimateCalculatorFlatArea updated!');
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
        $model = str_slug('productpricingestimatecalculatorflatarea','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingEstimateCalculatorFlatArea::destroy($id);

            return redirect('productPricingEstimateCalculatorFlatArea/product-pricing-estimate-calculator-flat-area')->with('flash_message', 'ProductPricingEstimateCalculatorFlatArea deleted!');
        }
        return response(view('403'), 403);

    }
}
