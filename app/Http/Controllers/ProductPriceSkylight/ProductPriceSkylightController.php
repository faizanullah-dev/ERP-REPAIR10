<?php

namespace App\Http\Controllers\ProductPriceSkylight;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPriceSkylight;
use Illuminate\Http\Request;

class ProductPriceSkylightController extends Controller
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpriceskylight = ProductPriceSkylight::where('product_price_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('qunatity', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpriceskylight = ProductPriceSkylight::paginate($perPage);
            }

            return view('productPriceSkylight.product-price-skylight.index', compact('productpriceskylight'));
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPriceSkylight.product-price-skylight.create');
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPriceSkylight::create($requestData);
            return redirect('productPriceSkylight/product-price-skylight')->with('flash_message', 'ProductPriceSkylight added!');
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpriceskylight = ProductPriceSkylight::findOrFail($id);
            return view('productPriceSkylight.product-price-skylight.show', compact('productpriceskylight'));
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpriceskylight = ProductPriceSkylight::findOrFail($id);
            return view('productPriceSkylight.product-price-skylight.edit', compact('productpriceskylight'));
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpriceskylight = ProductPriceSkylight::findOrFail($id);
             $productpriceskylight->update($requestData);

             return redirect('productPriceSkylight/product-price-skylight')->with('flash_message', 'ProductPriceSkylight updated!');
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
        $model = str_slug('productpriceskylight','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPriceSkylight::destroy($id);

            return redirect('productPriceSkylight/product-price-skylight')->with('flash_message', 'ProductPriceSkylight deleted!');
        }
        return response(view('403'), 403);

    }
}
