<?php

namespace App\Http\Controllers\Mark;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $mark = Mark::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $mark = Mark::paginate($perPage);
            }

            return view('mark.mark.index', compact('mark'));
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('mark.mark.create');
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            Mark::create($requestData);
            return redirect('mark/mark')->with('flash_message', 'Mark added!');
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $mark = Mark::findOrFail($id);
            return view('mark.mark.show', compact('mark'));
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $mark = Mark::findOrFail($id);
            return view('mark.mark.edit', compact('mark'));
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
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $mark = Mark::findOrFail($id);
             $mark->update($requestData);

             return redirect('mark/mark')->with('flash_message', 'Mark updated!');
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
    public function destroy($id) {
        $model = str_slug('mark','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Mark::destroy($id);

            return redirect('mark/mark')->with('flash_message', 'Mark deleted!');
        }
        return response(view('403'), 403);

    }

    public function editMarkModal(Request  $request, $id = null){
        extract($request->all());
        $mark = Mark::findOrFail($id);
        return view('mark.mark.edit_mark_modal', compact('mark'));
    }

    public function viewMarkModal(Request $request){
        extract($request->all());
        $mark = Mark::findOrFail($id);
        return (string) view('mark.mark.ajax.view_mark_modal', compact('mark'));
    }
}
