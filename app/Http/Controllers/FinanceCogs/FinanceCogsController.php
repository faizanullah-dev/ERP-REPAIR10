<?php

namespace App\Http\Controllers\FinanceCogs;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FinanceCog;
use Illuminate\Http\Request;

class FinanceCogsController extends Controller
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $financecogs = FinanceCog::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $financecogs = FinanceCog::paginate($perPage);
            }

            return view('financeCogs.finance-cogs.index', compact('financecogs'));
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('financeCogs.finance-cogs.create');
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            FinanceCog::create($requestData);
            return redirect('financeCogs/finance-cogs')->with('flash_message', 'FinanceCog added!');
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $financecog = FinanceCog::findOrFail($id);
            return view('financeCogs.finance-cogs.show', compact('financecog'));
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $financecog = FinanceCog::findOrFail($id);
            return view('financeCogs.finance-cogs.edit', compact('financecog'));
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $financecog = FinanceCog::findOrFail($id);
             $financecog->update($requestData);

             return redirect('financeCogs/finance-cogs')->with('flash_message', 'FinanceCog updated!');
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
        $model = str_slug('financecogs','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FinanceCog::destroy($id);

            return redirect('financeCogs/finance-cogs')->with('flash_message', 'FinanceCog deleted!');
        }
        return response(view('403'), 403);

    }
}
