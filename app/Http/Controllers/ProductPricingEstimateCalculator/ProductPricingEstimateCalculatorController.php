<?php

namespace App\Http\Controllers\ProductPricingEstimateCalculator;

use App\CalculatorSize;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Lead;
use App\ProductPricingEstimateCalculator;
use Illuminate\Http\Request;

class ProductPricingEstimateCalculatorController extends Controller
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingestimatecalculator = ProductPricingEstimateCalculator::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('eaves_rakes_sub_total', 'LIKE', "%$keyword%")
                ->orWhere('eaves_rakes_waste', 'LIKE', "%$keyword%")
                ->orWhere('eaves_rakes_total_waste', 'LIKE', "%$keyword%")
                ->orWhere('eaves_rakes_total', 'LIKE', "%$keyword%")
                ->orWhere('eave_rakes_total_percent', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingestimatecalculator = ProductPricingEstimateCalculator::orderBY('id', 'DESC')->paginate($perPage);
            }

            return view('productPricingEstimateCalculator.product-pricing-estimate-calculator.index', compact('productpricingestimatecalculator'));
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $productpricingestimatecalculators = ProductPricingEstimateCalculator::get();
            $leadIds = $productpricingestimatecalculators->pluck('lead_id')->toArray();
            $leads = Lead::whereNotIn('id', $leadIds)->get();
            $calculatorSizes = CalculatorSize::get();
            return view('productPricingEstimateCalculator.product-pricing-estimate-calculator.create',compact('leads', 'calculatorSizes'));
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingEstimateCalculator::create($requestData);
            return redirect('productPricingEstimateCalculator/product-pricing-estimate-calculator')->with('flash_message', 'ProductPricingEstimateCalculator added!');
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingestimatecalculator = ProductPricingEstimateCalculator::findOrFail($id);
            return view('productPricingEstimateCalculator.product-pricing-estimate-calculator.show', compact('productpricingestimatecalculator'));
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingestimatecalculator = ProductPricingEstimateCalculator::findOrFail($id);
            return view('productPricingEstimateCalculator.product-pricing-estimate-calculator.edit', compact('productpricingestimatecalculator'));
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingestimatecalculator = ProductPricingEstimateCalculator::findOrFail($id);
             $productpricingestimatecalculator->update($requestData);

             return redirect('productPricingEstimateCalculator/product-pricing-estimate-calculator')->with('flash_message', 'ProductPricingEstimateCalculator updated!');
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
        $model = str_slug('productpricingestimatecalculator','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingEstimateCalculator::destroy($id);

            return redirect('productPricingEstimateCalculator/product-pricing-estimate-calculator')->with('flash_message', 'ProductPricingEstimateCalculator deleted!');
        }
        return response(view('403'), 403);

    }
}
