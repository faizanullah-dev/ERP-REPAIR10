<?php

namespace App\Http\Controllers\ProductPricingPriceList;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricingPriceList;
use Illuminate\Http\Request;

class ProductPricingPriceListController extends Controller
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricingpricelist = ProductPricingPriceList::where('product_pricing_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('estimated_total', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricingpricelist = ProductPricingPriceList::paginate($perPage);
            }

            return view('productPricingPriceList.product-pricing-price-list.index', compact('productpricingpricelist'));
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricingPriceList.product-pricing-price-list.create');
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricingPriceList::create($requestData);
            return redirect('productPricingPriceList/product-pricing-price-list')->with('flash_message', 'ProductPricingPriceList added!');
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricingpricelist = ProductPricingPriceList::findOrFail($id);
            return view('productPricingPriceList.product-pricing-price-list.show', compact('productpricingpricelist'));
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricingpricelist = ProductPricingPriceList::findOrFail($id);
            return view('productPricingPriceList.product-pricing-price-list.edit', compact('productpricingpricelist'));
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricingpricelist = ProductPricingPriceList::findOrFail($id);
             $productpricingpricelist->update($requestData);

             return redirect('productPricingPriceList/product-pricing-price-list')->with('flash_message', 'ProductPricingPriceList updated!');
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
        $model = str_slug('productpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricingPriceList::destroy($id);

            return redirect('productPricingPriceList/product-pricing-price-list')->with('flash_message', 'ProductPricingPriceList deleted!');
        }
        return response(view('403'), 403);

    }
}
