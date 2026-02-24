<?php

namespace App\Http\Controllers\ProductPricePdfTotal;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricePdfTotal;
use Illuminate\Http\Request;

class ProductPricePdfTotalController extends Controller
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricepdftotal = ProductPricePdfTotal::where('product_price_pdf_measurement_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricepdftotal = ProductPricePdfTotal::paginate($perPage);
            }

            return view('productPricePdfTotal.product-price-pdf-total.index', compact('productpricepdftotal'));
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricePdfTotal.product-price-pdf-total.create');
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricePdfTotal::create($requestData);
            return redirect('productPricePdfTotal/product-price-pdf-total')->with('flash_message', 'ProductPricePdfTotal added!');
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricepdftotal = ProductPricePdfTotal::findOrFail($id);
            return view('productPricePdfTotal.product-price-pdf-total.show', compact('productpricepdftotal'));
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricepdftotal = ProductPricePdfTotal::findOrFail($id);
            return view('productPricePdfTotal.product-price-pdf-total.edit', compact('productpricepdftotal'));
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricepdftotal = ProductPricePdfTotal::findOrFail($id);
             $productpricepdftotal->update($requestData);

             return redirect('productPricePdfTotal/product-price-pdf-total')->with('flash_message', 'ProductPricePdfTotal updated!');
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
        $model = str_slug('productpricepdftotal','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricePdfTotal::destroy($id);

            return redirect('productPricePdfTotal/product-price-pdf-total')->with('flash_message', 'ProductPricePdfTotal deleted!');
        }
        return response(view('403'), 403);

    }
}
