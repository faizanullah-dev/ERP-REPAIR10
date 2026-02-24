<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Product;
use App\ProductCategory;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $product = Product::where('name', 'LIKE', "%$keyword%")->get();
            } else {
                $productCategory = ProductCategory::get();
                $product = Product::get();
            }

            return view('product.product.index', compact('product','productCategory'));
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $productCategory = ProductCategory::get();
            return view('product.product.create', compact('productCategory'));
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
//        return $request->all();
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            Product::create($requestData);
            return redirect('product/product')->with('flash_message', 'Product added!');
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
            return view('product.product.show', compact('product'));
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
            $productCategory = ProductCategory::get();
            return view('product.product.edit', compact('product', 'productCategory'));
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $product = Product::findOrFail($id);
             $product->update($requestData);

             return redirect('product/product')->with('flash_message', 'Product updated!');
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Product::destroy($id);

            return redirect('product/product')->with('flash_message', 'Product deleted!');
        }
        return response(view('403'), 403);
    }

    public function editProductModal(Request  $request, $id = null){
        extract($request->all());
        $product = Product::findOrFail($id);
        $productCategory = ProductCategory::get();
        return view('product.product.edit_product_modal', compact('product', 'productCategory'));
    }

    public function defaultProduct(Request $request) {
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $product = Product::where('name', 'LIKE', "%$keyword%")->get();
            } else {
                $productCategory = ProductCategory::get();
                $product = Product::get();
            }
            $getCategory = Category::where('status', 1)->get();
            return view('product.product.default_product', compact('product','productCategory','getCategory'));
        }
        return response(view('403'), 403);
    }

    public function getCategories(Product $product)
    {
        $categories = json_decode($product->default_category, true) ?? [];
        return response()->json(['categories' => $categories]);
    }

}