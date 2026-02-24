<?php

namespace App\Http\Controllers\ProductPricingEstimateCalculatorDownspouts;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricingEstimateCalculatorDownspout;
use Illuminate\Http\Request;

class ProductPricingEstimateCalculatorDownspoutsController extends Controller
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingestimatecalculatordownspouts = ProductPricingEstimateCalculatorDownspout::where('product_pricing_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('gutters', 'LIKE', "%$keyword%")
                ->orWhere('downspouts', 'LIKE', "%$keyword%")
                ->orWhere('guards', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingestimatecalculatordownspouts = ProductPricingEstimateCalculatorDownspout::paginate($perPage);
            }

            return view('productPricingEstimateCalculatorDownspouts.product-pricing-estimate-calculator-downspouts.index', compact('productpricingestimatecalculatordownspouts'));
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricingEstimateCalculatorDownspouts.product-pricing-estimate-calculator-downspouts.create');
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingEstimateCalculatorDownspout::create($requestData);
            return redirect('productPricingEstimateCalculatorDownspouts/product-pricing-estimate-calculator-downspouts')->with('flash_message', 'ProductPricingEstimateCalculatorDownspout added!');
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingestimatecalculatordownspout = ProductPricingEstimateCalculatorDownspout::findOrFail($id);
            return view('productPricingEstimateCalculatorDownspouts.product-pricing-estimate-calculator-downspouts.show', compact('productpricingestimatecalculatordownspout'));
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingestimatecalculatordownspout = ProductPricingEstimateCalculatorDownspout::findOrFail($id);
            return view('productPricingEstimateCalculatorDownspouts.product-pricing-estimate-calculator-downspouts.edit', compact('productpricingestimatecalculatordownspout'));
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingestimatecalculatordownspout = ProductPricingEstimateCalculatorDownspout::findOrFail($id);
             $productpricingestimatecalculatordownspout->update($requestData);

             return redirect('productPricingEstimateCalculatorDownspouts/product-pricing-estimate-calculator-downspouts')->with('flash_message', 'ProductPricingEstimateCalculatorDownspout updated!');
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
        $model = str_slug('productpricingestimatecalculatordownspouts','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingEstimateCalculatorDownspout::destroy($id);

            return redirect('productPricingEstimateCalculatorDownspouts/product-pricing-estimate-calculator-downspouts')->with('flash_message', 'ProductPricingEstimateCalculatorDownspout deleted!');
        }
        return response(view('403'), 403);

    }
}
