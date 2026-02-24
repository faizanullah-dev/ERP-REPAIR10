<?php

namespace App\Http\Controllers\ProductPricingEstimateCalculatorEaveRakes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricingEstimateCalculatorEaveRake;
use Illuminate\Http\Request;

class ProductPricingEstimateCalculatorEaveRakesController extends Controller
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingestimatecalculatoreaverakes = ProductPricingEstimateCalculatorEaveRake::where('product_pricing_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('eave', 'LIKE', "%$keyword%")
                ->orWhere('rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_final_rakes', 'LIKE', "%$keyword%")
                ->orWhere('eave_final_rakes_total', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingestimatecalculatoreaverakes = ProductPricingEstimateCalculatorEaveRake::paginate($perPage);
            }

            return view('productPricingEstimateCalculatorEaveRakes.product-pricing-estimate-calculator-eave-rakes.index', compact('productpricingestimatecalculatoreaverakes'));
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricingEstimateCalculatorEaveRakes.product-pricing-estimate-calculator-eave-rakes.create');
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingEstimateCalculatorEaveRake::create($requestData);
            return redirect('productPricingEstimateCalculatorEaveRakes/product-pricing-estimate-calculator-eave-rakes')->with('flash_message', 'ProductPricingEstimateCalculatorEaveRake added!');
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingestimatecalculatoreaverake = ProductPricingEstimateCalculatorEaveRake::findOrFail($id);
            return view('productPricingEstimateCalculatorEaveRakes.product-pricing-estimate-calculator-eave-rakes.show', compact('productpricingestimatecalculatoreaverake'));
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingestimatecalculatoreaverake = ProductPricingEstimateCalculatorEaveRake::findOrFail($id);
            return view('productPricingEstimateCalculatorEaveRakes.product-pricing-estimate-calculator-eave-rakes.edit', compact('productpricingestimatecalculatoreaverake'));
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingestimatecalculatoreaverake = ProductPricingEstimateCalculatorEaveRake::findOrFail($id);
             $productpricingestimatecalculatoreaverake->update($requestData);

             return redirect('productPricingEstimateCalculatorEaveRakes/product-pricing-estimate-calculator-eave-rakes')->with('flash_message', 'ProductPricingEstimateCalculatorEaveRake updated!');
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
        $model = str_slug('productpricingestimatecalculatoreaverakes','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingEstimateCalculatorEaveRake::destroy($id);

            return redirect('productPricingEstimateCalculatorEaveRakes/product-pricing-estimate-calculator-eave-rakes')->with('flash_message', 'ProductPricingEstimateCalculatorEaveRake deleted!');
        }
        return response(view('403'), 403);

    }
}
