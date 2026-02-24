<?php

namespace App\Http\Controllers\ProductPricePdfAreaPitch;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPricePdfAreaPitch;
use Illuminate\Http\Request;

class ProductPricePdfAreaPitchController extends Controller
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpricepdfareapitch = ProductPricePdfAreaPitch::where('product_price_pdf_measurement_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpricepdfareapitch = ProductPricePdfAreaPitch::paginate($perPage);
            }

            return view('productPricePdfAreaPitch.product-price-pdf-area-pitch.index', compact('productpricepdfareapitch'));
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPricePdfAreaPitch.product-price-pdf-area-pitch.create');
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPricePdfAreaPitch::create($requestData);
            return redirect('productPricePdfAreaPitch/product-price-pdf-area-pitch')->with('flash_message', 'ProductPricePdfAreaPitch added!');
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpricepdfareapitch = ProductPricePdfAreaPitch::findOrFail($id);
            return view('productPricePdfAreaPitch.product-price-pdf-area-pitch.show', compact('productpricepdfareapitch'));
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpricepdfareapitch = ProductPricePdfAreaPitch::findOrFail($id);
            return view('productPricePdfAreaPitch.product-price-pdf-area-pitch.edit', compact('productpricepdfareapitch'));
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpricepdfareapitch = ProductPricePdfAreaPitch::findOrFail($id);
             $productpricepdfareapitch->update($requestData);

             return redirect('productPricePdfAreaPitch/product-price-pdf-area-pitch')->with('flash_message', 'ProductPricePdfAreaPitch updated!');
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
        $model = str_slug('productpricepdfareapitch','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPricePdfAreaPitch::destroy($id);

            return redirect('productPricePdfAreaPitch/product-price-pdf-area-pitch')->with('flash_message', 'ProductPricePdfAreaPitch deleted!');
        }
        return response(view('403'), 403);

    }
}
