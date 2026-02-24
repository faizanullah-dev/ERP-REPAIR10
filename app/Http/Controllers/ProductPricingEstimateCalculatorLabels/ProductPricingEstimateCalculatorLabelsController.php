<?php

namespace App\Http\Controllers\ProductPricingEstimateCalculatorLabels;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricingEstimateCalculatorLabel;
use Illuminate\Http\Request;

class ProductPricingEstimateCalculatorLabelsController extends Controller
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingestimatecalculatorlabels = ProductPricingEstimateCalculatorLabel::where('product_pricing_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingestimatecalculatorlabels = ProductPricingEstimateCalculatorLabel::paginate($perPage);
            }

            return view('productPricingEstimateCalculatorLabels.product-pricing-estimate-calculator-labels.index', compact('productpricingestimatecalculatorlabels'));
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricingEstimateCalculatorLabels.product-pricing-estimate-calculator-labels.create');
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingEstimateCalculatorLabel::create($requestData);
            return redirect('productPricingEstimateCalculatorLabels/product-pricing-estimate-calculator-labels')->with('flash_message', 'ProductPricingEstimateCalculatorLabel added!');
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingestimatecalculatorlabel = ProductPricingEstimateCalculatorLabel::findOrFail($id);
            return view('productPricingEstimateCalculatorLabels.product-pricing-estimate-calculator-labels.show', compact('productpricingestimatecalculatorlabel'));
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingestimatecalculatorlabel = ProductPricingEstimateCalculatorLabel::findOrFail($id);
            return view('productPricingEstimateCalculatorLabels.product-pricing-estimate-calculator-labels.edit', compact('productpricingestimatecalculatorlabel'));
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingestimatecalculatorlabel = ProductPricingEstimateCalculatorLabel::findOrFail($id);
             $productpricingestimatecalculatorlabel->update($requestData);

             return redirect('productPricingEstimateCalculatorLabels/product-pricing-estimate-calculator-labels')->with('flash_message', 'ProductPricingEstimateCalculatorLabel updated!');
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
        $model = str_slug('productpricingestimatecalculatorlabels','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingEstimateCalculatorLabel::destroy($id);

            return redirect('productPricingEstimateCalculatorLabels/product-pricing-estimate-calculator-labels')->with('flash_message', 'ProductPricingEstimateCalculatorLabel deleted!');
        }
        return response(view('403'), 403);

    }
}
