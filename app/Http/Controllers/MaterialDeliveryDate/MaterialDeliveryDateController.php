<?php

namespace App\Http\Controllers\MaterialDeliveryDate;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Material;
use App\MaterialDeliveryDate;
use App\YearEstimation;
use Illuminate\Http\Request;

class MaterialDeliveryDateController extends Controller
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $materialdeliverydate = MaterialDeliveryDate::where('material_delivery_date', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('material_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $materialdeliverydate = MaterialDeliveryDate::paginate($perPage);
            }

            return view('materialDeliveryDate.material-delivery-date.index', compact('materialdeliverydate'));
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $materials = Material::get();
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            return view('materialDeliveryDate.material-delivery-date.create', compact('materials', 'yearEstimation'));
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            MaterialDeliveryDate::create($requestData);
            return redirect('materialDeliveryDate/material-delivery-date')->with('flash_message', 'MaterialDeliveryDate added!');
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $materialdeliverydate = MaterialDeliveryDate::findOrFail($id);
            return view('materialDeliveryDate.material-delivery-date.show', compact('materialdeliverydate'));
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $materialdeliverydate = MaterialDeliveryDate::findOrFail($id);
            $materials = Material::get();
            return view('materialDeliveryDate.material-delivery-date.edit', compact('materialdeliverydate', 'materials'));
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $materialdeliverydate = MaterialDeliveryDate::findOrFail($id);
             $materialdeliverydate->update($requestData);

             return redirect('materialDeliveryDate/material-delivery-date')->with('flash_message', 'MaterialDeliveryDate updated!');
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
        $model = str_slug('materialdeliverydate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            MaterialDeliveryDate::destroy($id);

            return redirect('materialDeliveryDate/material-delivery-date')->with('flash_message', 'MaterialDeliveryDate deleted!');
        }
        return response(view('403'), 403);

    }
}
