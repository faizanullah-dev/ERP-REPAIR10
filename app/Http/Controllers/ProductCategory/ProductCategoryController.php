<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productcategory = ProductCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productcategory = ProductCategory::paginate($perPage);
            }

            return view('productCategory.product-category.index', compact('productcategory'));
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productCategory.product-category.create');
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductCategory::create($requestData);
            return redirect('productCategory/product-category')->with('flash_message', 'ProductCategory added!');
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productcategory = ProductCategory::findOrFail($id);
            return view('productCategory.product-category.show', compact('productcategory'));
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productcategory = ProductCategory::findOrFail($id);
            return view('productCategory.product-category.edit', compact('productcategory'));
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
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productcategory = ProductCategory::findOrFail($id);
             $productcategory->update($requestData);

             return redirect('productCategory/product-category')->with('flash_message', 'ProductCategory updated!');
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
    public function destroy($id) {
        $model = str_slug('productcategory','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductCategory::destroy($id);

            return redirect('productCategory/product-category')->with('flash_message', 'ProductCategory deleted!');
        }
        return response(view('403'), 403);

    }

    public function editProductCategoryModal(Request  $request, $id = null){
        extract($request->all());
        $productcategory = ProductCategory::findOrFail($id);
        return view('productCategory.product-category.edit_product_category_modal', compact('productcategory'));
    }

    public function viewProductCategoryModal(Request $request){
        extract($request->all());
        $productcategory = ProductCategory::findOrFail($id);
        return (string) view('productCategory.product-category.ajax.view_product_category_modal', compact('productcategory'));
    }
}