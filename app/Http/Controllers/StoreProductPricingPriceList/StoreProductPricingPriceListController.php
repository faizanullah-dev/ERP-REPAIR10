<?php

namespace App\Http\Controllers\StoreProductPricingPriceList;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreProductPricingPriceList;
use Illuminate\Http\Request;

class StoreProductPricingPriceListController extends Controller
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storeproductpricingpricelist = StoreProductPricingPriceList::where('produc_pricing_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('ext_price', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storeproductpricingpricelist = StoreProductPricingPriceList::paginate($perPage);
            }

            return view('storeProductPricingPriceList.store-product-pricing-price-list.index', compact('storeproductpricingpricelist'));
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeProductPricingPriceList.store-product-pricing-price-list.create');
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreProductPricingPriceList::create($requestData);
            return redirect('storeProductPricingPriceList/store-product-pricing-price-list')->with('flash_message', 'StoreProductPricingPriceList added!');
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storeproductpricingpricelist = StoreProductPricingPriceList::findOrFail($id);
            return view('storeProductPricingPriceList.store-product-pricing-price-list.show', compact('storeproductpricingpricelist'));
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storeproductpricingpricelist = StoreProductPricingPriceList::findOrFail($id);
            return view('storeProductPricingPriceList.store-product-pricing-price-list.edit', compact('storeproductpricingpricelist'));
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storeproductpricingpricelist = StoreProductPricingPriceList::findOrFail($id);
             $storeproductpricingpricelist->update($requestData);

             return redirect('storeProductPricingPriceList/store-product-pricing-price-list')->with('flash_message', 'StoreProductPricingPriceList updated!');
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
        $model = str_slug('storeproductpricingpricelist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreProductPricingPriceList::destroy($id);

            return redirect('storeProductPricingPriceList/store-product-pricing-price-list')->with('flash_message', 'StoreProductPricingPriceList deleted!');
        }
        return response(view('403'), 403);

    }
}
