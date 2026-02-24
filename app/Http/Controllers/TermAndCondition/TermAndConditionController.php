<?php

namespace App\Http\Controllers\TermAndCondition;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TermAndCondition;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $termandcondition = TermAndCondition::where('description', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $termandcondition = TermAndCondition::paginate($perPage);
            }

            return view('termAndCondition.term-and-condition.index', compact('termandcondition'));
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('termAndCondition.term-and-condition.create');
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            TermAndCondition::create($requestData);
            return redirect('termAndCondition/term-and-condition')->with('flash_message', 'TermAndCondition added!');
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $termandcondition = TermAndCondition::findOrFail($id);
            return view('termAndCondition.term-and-condition.show', compact('termandcondition'));
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $termandcondition = TermAndCondition::findOrFail($id);
            return view('termAndCondition.term-and-condition.edit', compact('termandcondition'));
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $termandcondition = TermAndCondition::findOrFail($id);
            $termandcondition->update($requestData);
//          return redirect('termAndCondition/term-and-condition')->with('flash_message', 'TermAndCondition updated!');
            return redirect('terms_and_condition')->with('flash_message', 'Term And Condition updated!');
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
        $model = str_slug('termandcondition','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TermAndCondition::destroy($id);

            return redirect('termAndCondition/term-and-condition')->with('flash_message', 'TermAndCondition deleted!');
        }
        return response(view('403'), 403);

    }
}
