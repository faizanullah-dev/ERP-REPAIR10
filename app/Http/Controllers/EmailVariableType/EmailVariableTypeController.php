<?php

namespace App\Http\Controllers\EmailVariableType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailVariableType;
use Illuminate\Http\Request;

class EmailVariableTypeController extends Controller
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailvariabletype = EmailVariableType::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailvariabletype = EmailVariableType::paginate($perPage);
            }

            return view('emailVariableType.email-variable-type.index', compact('emailvariabletype'));
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('emailVariableType.email-variable-type.create');
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            EmailVariableType::create($requestData);
            return redirect('emailVariableType/email-variable-type')->with('flash_message', 'EmailVariableType added!');
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailvariabletype = EmailVariableType::findOrFail($id);
            return view('emailVariableType.email-variable-type.show', compact('emailvariabletype'));
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailvariabletype = EmailVariableType::findOrFail($id);
            return view('emailVariableType.email-variable-type.edit', compact('emailvariabletype'));
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $emailvariabletype = EmailVariableType::findOrFail($id);
             $emailvariabletype->update($requestData);

             return redirect('emailVariableType/email-variable-type')->with('flash_message', 'EmailVariableType updated!');
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
        $model = str_slug('emailvariabletype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailVariableType::destroy($id);

            return redirect('emailVariableType/email-variable-type')->with('flash_message', 'EmailVariableType deleted!');
        }
        return response(view('403'), 403);

    }
}
