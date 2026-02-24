<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ControlPanel;
use Illuminate\Http\Request;

class ControlPanelController extends Controller
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $controlpanel = ControlPanel::where('module', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $controlpanel = ControlPanel::paginate($perPage);
            }

            return view('controlPanel.control-panel.index', compact('controlpanel'));
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('controlPanel.control-panel.create');
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ControlPanel::create($requestData);
            return redirect('controlPanel/control-panel')->with('flash_message', 'ControlPanel added!');
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $controlpanel = ControlPanel::findOrFail($id);
            return view('controlPanel.control-panel.show', compact('controlpanel'));
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $controlpanel = ControlPanel::findOrFail($id);
            return view('controlPanel.control-panel.edit', compact('controlpanel'));
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $controlpanel = ControlPanel::findOrFail($id);
             $controlpanel->update($requestData);

             return redirect('controlPanel/control-panel')->with('flash_message', 'ControlPanel updated!');
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
        $model = str_slug('controlpanel','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ControlPanel::destroy($id);

            return redirect('controlPanel/control-panel')->with('flash_message', 'ControlPanel deleted!');
        }
        return response(view('403'), 403);

    }

    public function updateControl(Request $request){
        ControlPanel::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(['message' => 'success']);
    }
}
