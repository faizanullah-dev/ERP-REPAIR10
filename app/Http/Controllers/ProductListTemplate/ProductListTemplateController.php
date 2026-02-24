<?php

namespace App\Http\Controllers\ProductListTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductListTemplate;
use Illuminate\Http\Request;

class ProductListTemplateController extends Controller
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productlisttemplate = ProductListTemplate::where('template_id', 'LIKE', "%$keyword%")
                ->orWhere('product_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productlisttemplate = ProductListTemplate::paginate($perPage);
            }

            return view('productListTemplate.product-list-template.index', compact('productlisttemplate'));
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productListTemplate.product-list-template.create');
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductListTemplate::create($requestData);
            return redirect('productListTemplate/product-list-template')->with('flash_message', 'ProductListTemplate added!');
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productlisttemplate = ProductListTemplate::findOrFail($id);
            return view('productListTemplate.product-list-template.show', compact('productlisttemplate'));
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productlisttemplate = ProductListTemplate::findOrFail($id);
            return view('productListTemplate.product-list-template.edit', compact('productlisttemplate'));
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productlisttemplate = ProductListTemplate::findOrFail($id);
             $productlisttemplate->update($requestData);

             return redirect('productListTemplate/product-list-template')->with('flash_message', 'ProductListTemplate updated!');
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
        $model = str_slug('productlisttemplate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductListTemplate::destroy($id);

            return redirect('productListTemplate/product-list-template')->with('flash_message', 'ProductListTemplate deleted!');
        }
        return response(view('403'), 403);

    }
}
