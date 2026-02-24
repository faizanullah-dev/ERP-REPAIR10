<?php

namespace App\Http\Controllers\ProductTemplate;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Product;
use App\ProductListTemplate;
use App\ProductTemplate;
use Illuminate\Http\Request;

class ProductTemplateController extends Controller
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $producttemplate = ProductTemplate::where('name', 'LIKE', "%$keyword%")
                ->orWhere('categories', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $producttemplate = ProductTemplate::paginate($perPage);
            }

            return view('productTemplate.product-template.index', compact('producttemplate'));
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $products = Product::get();
            $categories = Category::get();
            return view('productTemplate.product-template.create', compact('products', 'categories'));
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $template = ProductTemplate::create([
                'name' => $request->name,
                'categories' => json_encode($request->default_category),
            ]);

            foreach ($request->product_id as $key => $product){
                ProductListTemplate::create([
                    'template_id' => $template->id,
                    'product_id' => $product,
                    'sort_index' => $key,
                ]);
            }
            return redirect('productTemplate/product-template')->with('flash_message', 'ProductTemplate added!');
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $producttemplate = ProductTemplate::findOrFail($id);
            return view('productTemplate.product-template.show', compact('producttemplate'));
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $producttemplate = ProductTemplate::findOrFail($id);
            $products = Product::get();
            $categories = Category::get();
            $selectedProductIds = $producttemplate->templateProducts->pluck('product_id')->toArray();
            return view('productTemplate.product-template.edit', compact('producttemplate', 'products', 'categories', 'selectedProductIds'));
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();

            $template = ProductTemplate::where('id', $id)->update([
                'name' => $request->name,
                'categories' => json_encode($request->default_category),
            ]);

            $existingProducts = ProductListTemplate::where('template_id', $id)
                ->pluck('product_id')->toArray();

            foreach ($request->product_id as $key => $product_id) {
                ProductListTemplate::updateOrCreate(
                    [
                        'template_id' => $id,
                        'product_id' => $product_id
                    ],
                    [
                        'sort_index' => $key
                    ]
                );
            }

            $newProductIds = $request->product_id;
            $productsToDelete = array_diff($existingProducts, $newProductIds);

            if (!empty($productsToDelete)) {
                ProductListTemplate::where('template_id', $id)
                    ->whereIn('product_id', $productsToDelete)
                    ->delete();
            }

             return redirect('productTemplate/product-template')->with('flash_message', 'ProductTemplate updated!');
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
        $model = str_slug('producttemplate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductListTemplate::where('template_id', $id)->delete();
            ProductTemplate::destroy($id);

            return redirect('productTemplate/product-template')->with('flash_message', 'ProductTemplate deleted!');
        }
        return response(view('403'), 403);

    }
}
