<?php

namespace App\Http\Controllers\Trade;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $trade = Trade::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $trade = Trade::paginate($perPage);
            }

            return view('trade.trade.index', compact('trade'));
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('trade.trade.create');
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            Trade::create($requestData);
            return redirect('trade/trade')->with('flash_message', 'Trade added!');
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $trade = Trade::findOrFail($id);
            return view('trade.trade.show', compact('trade'));
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $trade = Trade::findOrFail($id);
            return view('trade.trade.edit', compact('trade'));
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $trade = Trade::findOrFail($id);
             $trade->update($requestData);

             return redirect('trade/trade')->with('flash_message', 'Trade updated!');
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
        $model = str_slug('trade','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Trade::destroy($id);

            return redirect('trade/trade')->with('flash_message', 'Trade deleted!');
        }
        return response(view('403'), 403);

    }
}
