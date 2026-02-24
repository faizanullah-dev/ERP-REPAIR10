<?php

namespace App\Http\Controllers\StoreSideEstimateOverExist;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreSideEstimateOverExist;
use Illuminate\Http\Request;

class StoreSideEstimateOverExistController extends Controller
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storesideestimateoverexist = StoreSideEstimateOverExist::where('side_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storesideestimateoverexist = StoreSideEstimateOverExist::paginate($perPage);
            }

            return view('storeSideEstimateOverExist.store-side-estimate-over-exist.index', compact('storesideestimateoverexist'));
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeSideEstimateOverExist.store-side-estimate-over-exist.create');
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreSideEstimateOverExist::create($requestData);
            return redirect('storeSideEstimateOverExist/store-side-estimate-over-exist')->with('flash_message', 'StoreSideEstimateOverExist added!');
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storesideestimateoverexist = StoreSideEstimateOverExist::findOrFail($id);
            return view('storeSideEstimateOverExist.store-side-estimate-over-exist.show', compact('storesideestimateoverexist'));
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storesideestimateoverexist = StoreSideEstimateOverExist::findOrFail($id);
            return view('storeSideEstimateOverExist.store-side-estimate-over-exist.edit', compact('storesideestimateoverexist'));
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storesideestimateoverexist = StoreSideEstimateOverExist::findOrFail($id);
             $storesideestimateoverexist->update($requestData);

             return redirect('storeSideEstimateOverExist/store-side-estimate-over-exist')->with('flash_message', 'StoreSideEstimateOverExist updated!');
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
        $model = str_slug('storesideestimateoverexist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreSideEstimateOverExist::destroy($id);

            return redirect('storeSideEstimateOverExist/store-side-estimate-over-exist')->with('flash_message', 'StoreSideEstimateOverExist deleted!');
        }
        return response(view('403'), 403);

    }
}
