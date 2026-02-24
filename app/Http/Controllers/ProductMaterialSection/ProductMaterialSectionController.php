<?php

namespace App\Http\Controllers\ProductMaterialSection;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProductMaterialSection;
use Illuminate\Http\Request;

class ProductMaterialSectionController extends Controller
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productmaterialsection = ProductMaterialSection::where('material_list_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productmaterialsection = ProductMaterialSection::paginate($perPage);
            }

            return view('productMaterialSection.product-material-section.index', compact('productmaterialsection'));
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('productMaterialSection.product-material-section.create');
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProductMaterialSection::create($requestData);
            return redirect('productMaterialSection/product-material-section')->with('flash_message', 'ProductMaterialSection added!');
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $productmaterialsection = ProductMaterialSection::findOrFail($id);
            return view('productMaterialSection.product-material-section.show', compact('productmaterialsection'));
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $productmaterialsection = ProductMaterialSection::findOrFail($id);
            return view('productMaterialSection.product-material-section.edit', compact('productmaterialsection'));
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $productmaterialsection = ProductMaterialSection::findOrFail($id);
             $productmaterialsection->update($requestData);

             return redirect('productMaterialSection/product-material-section')->with('flash_message', 'ProductMaterialSection updated!');
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
        $model = str_slug('productmaterialsection','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProductMaterialSection::destroy($id);

            return redirect('productMaterialSection/product-material-section')->with('flash_message', 'ProductMaterialSection deleted!');
        }
        return response(view('403'), 403);

    }
}
