<?php

namespace App\Http\Controllers\ChimneyEstimateBricksRow;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ChimneyEstimateBricksRow;
use Illuminate\Http\Request;

class ChimneyEstimateBricksRowController extends Controller
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $chimneyestimatebricksrow = ChimneyEstimateBricksRow::where('chimney_estimate_calculator_id', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('bricks', 'LIKE', "%$keyword%")
                ->orWhere('rows', 'LIKE', "%$keyword%")
                ->orWhere('total_bricks_rows', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $chimneyestimatebricksrow = ChimneyEstimateBricksRow::paginate($perPage);
            }

            return view('chimneyEstimateBricksRow.chimney-estimate-bricks-row.index', compact('chimneyestimatebricksrow'));
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('chimneyEstimateBricksRow.chimney-estimate-bricks-row.create');
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ChimneyEstimateBricksRow::create($requestData);
            return redirect('chimneyEstimateBricksRow/chimney-estimate-bricks-row')->with('flash_message', 'ChimneyEstimateBricksRow added!');
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $chimneyestimatebricksrow = ChimneyEstimateBricksRow::findOrFail($id);
            return view('chimneyEstimateBricksRow.chimney-estimate-bricks-row.show', compact('chimneyestimatebricksrow'));
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $chimneyestimatebricksrow = ChimneyEstimateBricksRow::findOrFail($id);
            return view('chimneyEstimateBricksRow.chimney-estimate-bricks-row.edit', compact('chimneyestimatebricksrow'));
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $chimneyestimatebricksrow = ChimneyEstimateBricksRow::findOrFail($id);
             $chimneyestimatebricksrow->update($requestData);

             return redirect('chimneyEstimateBricksRow/chimney-estimate-bricks-row')->with('flash_message', 'ChimneyEstimateBricksRow updated!');
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
        $model = str_slug('chimneyestimatebricksrow','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChimneyEstimateBricksRow::destroy($id);

            return redirect('chimneyEstimateBricksRow/chimney-estimate-bricks-row')->with('flash_message', 'ChimneyEstimateBricksRow deleted!');
        }
        return response(view('403'), 403);

    }
}
