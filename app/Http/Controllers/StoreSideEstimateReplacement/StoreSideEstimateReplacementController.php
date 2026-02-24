<?php

namespace App\Http\Controllers\StoreSideEstimateReplacement;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StoreSideEstimateReplacement;
use Illuminate\Http\Request;

class StoreSideEstimateReplacementController extends Controller
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $storesideestimatereplacement = StoreSideEstimateReplacement::where('side_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $storesideestimatereplacement = StoreSideEstimateReplacement::paginate($perPage);
            }

            return view('storeSideEstimateReplacement.store-side-estimate-replacement.index', compact('storesideestimatereplacement'));
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('storeSideEstimateReplacement.store-side-estimate-replacement.create');
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StoreSideEstimateReplacement::create($requestData);
            return redirect('storeSideEstimateReplacement/store-side-estimate-replacement')->with('flash_message', 'StoreSideEstimateReplacement added!');
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $storesideestimatereplacement = StoreSideEstimateReplacement::findOrFail($id);
            return view('storeSideEstimateReplacement.store-side-estimate-replacement.show', compact('storesideestimatereplacement'));
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $storesideestimatereplacement = StoreSideEstimateReplacement::findOrFail($id);
            return view('storeSideEstimateReplacement.store-side-estimate-replacement.edit', compact('storesideestimatereplacement'));
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $storesideestimatereplacement = StoreSideEstimateReplacement::findOrFail($id);
             $storesideestimatereplacement->update($requestData);

             return redirect('storeSideEstimateReplacement/store-side-estimate-replacement')->with('flash_message', 'StoreSideEstimateReplacement updated!');
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
        $model = str_slug('storesideestimatereplacement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StoreSideEstimateReplacement::destroy($id);

            return redirect('storeSideEstimateReplacement/store-side-estimate-replacement')->with('flash_message', 'StoreSideEstimateReplacement deleted!');
        }
        return response(view('403'), 403);

    }
}
