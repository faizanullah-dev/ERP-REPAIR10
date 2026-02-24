<?php

namespace App\Http\Controllers\StoreProductPricingMaterialList;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreProductPricingMaterialList;
use Illuminate\Http\Request;

class StoreProductPricingMaterialListController extends Controller
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storeproductpricingmateriallist = StoreProductPricingMaterialList::where('product_pricing_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storeproductpricingmateriallist = StoreProductPricingMaterialList::paginate($perPage);
            }

            return view('storeProductPricingMaterialList.store-product-pricing-material-list.index', compact('storeproductpricingmateriallist'));
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeProductPricingMaterialList.store-product-pricing-material-list.create');
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreProductPricingMaterialList::create($requestData);
            return redirect('storeProductPricingMaterialList/store-product-pricing-material-list')->with('flash_message', 'StoreProductPricingMaterialList added!');
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storeproductpricingmateriallist = StoreProductPricingMaterialList::findOrFail($id);
            return view('storeProductPricingMaterialList.store-product-pricing-material-list.show', compact('storeproductpricingmateriallist'));
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storeproductpricingmateriallist = StoreProductPricingMaterialList::findOrFail($id);
            return view('storeProductPricingMaterialList.store-product-pricing-material-list.edit', compact('storeproductpricingmateriallist'));
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storeproductpricingmateriallist = StoreProductPricingMaterialList::findOrFail($id);
             $storeproductpricingmateriallist->update($requestData);

             return redirect('storeProductPricingMaterialList/store-product-pricing-material-list')->with('flash_message', 'StoreProductPricingMaterialList updated!');
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
        $model = str_slug('storeproductpricingmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreProductPricingMaterialList::destroy($id);

            return redirect('storeProductPricingMaterialList/store-product-pricing-material-list')->with('flash_message', 'StoreProductPricingMaterialList deleted!');
        }
        return response(view('403'), 403);

    }
}
