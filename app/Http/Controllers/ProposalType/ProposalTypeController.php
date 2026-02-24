<?php

namespace App\Http\Controllers\ProposalType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProposalType;
use Illuminate\Http\Request;

class ProposalTypeController extends Controller
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $proposaltype = ProposalType::where('type', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $proposaltype = ProposalType::paginate($perPage);
            }

            return view('proposalType.proposal-type.index', compact('proposaltype'));
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('proposalType.proposal-type.create');
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProposalType::create($requestData);
            return redirect('proposalType/proposal-type')->with('flash_message', 'ProposalType added!');
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $proposaltype = ProposalType::findOrFail($id);
            return view('proposalType.proposal-type.show', compact('proposaltype'));
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $proposaltype = ProposalType::findOrFail($id);
            return view('proposalType.proposal-type.edit', compact('proposaltype'));
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $proposaltype = ProposalType::findOrFail($id);
             $proposaltype->update($requestData);

             return redirect('proposalType/proposal-type')->with('flash_message', 'ProposalType updated!');
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
        $model = str_slug('proposaltype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProposalType::destroy($id);

            return redirect('proposalType/proposal-type')->with('flash_message', 'ProposalType deleted!');
        }
        return response(view('403'), 403);

    }
}
