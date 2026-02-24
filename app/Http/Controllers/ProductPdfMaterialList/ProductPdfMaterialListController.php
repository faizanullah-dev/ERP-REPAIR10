<?php

namespace App\Http\Controllers\ProductPdfMaterialList;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductPdfMaterialList;
use Illuminate\Http\Request;

class ProductPdfMaterialListController extends Controller
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productpdfmateriallist = ProductPdfMaterialList::where('product_price_pdf_measurement_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('unit', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productpdfmateriallist = ProductPdfMaterialList::paginate($perPage);
            }

            return view('productPdfMaterialList.product-pdf-material-list.index', compact('productpdfmateriallist'));
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productPdfMaterialList.product-pdf-material-list.create');
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductPdfMaterialList::create($requestData);
            return redirect('productPdfMaterialList/product-pdf-material-list')->with('flash_message', 'ProductPdfMaterialList added!');
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productpdfmateriallist = ProductPdfMaterialList::findOrFail($id);
            return view('productPdfMaterialList.product-pdf-material-list.show', compact('productpdfmateriallist'));
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productpdfmateriallist = ProductPdfMaterialList::findOrFail($id);
            return view('productPdfMaterialList.product-pdf-material-list.edit', compact('productpdfmateriallist'));
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productpdfmateriallist = ProductPdfMaterialList::findOrFail($id);
             $productpdfmateriallist->update($requestData);

             return redirect('productPdfMaterialList/product-pdf-material-list')->with('flash_message', 'ProductPdfMaterialList updated!');
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
        $model = str_slug('productpdfmateriallist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductPdfMaterialList::destroy($id);

            return redirect('productPdfMaterialList/product-pdf-material-list')->with('flash_message', 'ProductPdfMaterialList deleted!');
        }
        return response(view('403'), 403);

    }
}
