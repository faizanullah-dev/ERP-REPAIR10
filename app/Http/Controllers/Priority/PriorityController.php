<?php

namespace App\Http\Controllers\Priority;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $priority = Priority::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $priority = Priority::paginate($perPage);
            }

            return view('priority.priority.index', compact('priority'));
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('priority.priority.create');
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            Priority::create($requestData);
            return redirect('priority/priority')->with('flash_message', 'Priority added!');
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $priority = Priority::findOrFail($id);
            return view('priority.priority.show', compact('priority'));
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $priority = Priority::findOrFail($id);
            return view('priority.priority.edit', compact('priority'));
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $priority = Priority::findOrFail($id);
             $priority->update($requestData);

             return redirect('priority/priority')->with('flash_message', 'Priority updated!');
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
        $model = str_slug('priority','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Priority::destroy($id);

            return redirect('priority/priority')->with('flash_message', 'Priority deleted!');
        }
        return response(view('403'), 403);

    }

    public function editPriorityModal(Request  $request, $id = null){
        extract($request->all());
        $priority = Priority::findOrFail($id);
        return view('priority.priority.edit_priority_modal', compact('priority'));
    }

    public function viewPriorityModal(Request $request){
        extract($request->all());
        $priority = Priority::findOrFail($id);
        return (string) view('priority.priority.ajax.view_priority_modal', compact('priority'));
    }
}
