<?php

namespace App\Http\Controllers\ProposalTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProposalTemplate;
use App\ProposalTemplateAttachment;
use Illuminate\Http\Request;

class ProposalTemplateController extends Controller
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $proposaltemplate = ProposalTemplate::where('proposal_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $proposaltemplate = ProposalTemplate::paginate($perPage);
            }

            return view('proposalTemplate.proposal-template.index', compact('proposaltemplate'));
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('proposalTemplate.proposal-template.create');
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $proposal =  ProposalTemplate::create(['title'=>$request->title??""]);
            if ($request->proposal_template_attachment != '') {
                foreach(explode(',',$request->proposal_template_attachment) as $key => $value){
                    ProposalTemplateAttachment::create([
                        'template_id' => $proposal->id,
                        'name'  => $value,
                    ]);//end foreach.
                }//end foreach.
            }

            return redirect('proposalTemplate/proposal-template')->with('flash_message', 'ProposalTemplate added!');
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $proposaltemplate = ProposalTemplate::findOrFail($id);
            return view('proposalTemplate.proposal-template.show', compact('proposaltemplate'));
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $proposaltemplate = ProposalTemplate::findOrFail($id);
            return view('proposalTemplate.proposal-template.edit', compact('proposaltemplate'));
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
             $requestData = $request->all();

            $ProposalTemplate = ProposalTemplate::findOrFail($id);
            ProposalTemplate::where('id', $ProposalTemplate->id)->update([ 'title'    => $request->title, ]);
            if ($request->proposal_template_attachment !='') {
                foreach(explode(',',$request->proposal_template_attachment) as $key => $value){
                    ProposalTemplateAttachment::where('template_id', $id)->where('name', $value)->updateOrCreate([
                        'template_id'    => $ProposalTemplate->id,
                        'name'           => $value
                    ]);
                }//end foreach.
            }//end if.
            return redirect('proposalTemplate/proposal-template')->with('flash_message', 'ProposalTemplate updated!');
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
        $model = str_slug('proposaltemplate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProposalTemplate::destroy($id);

            return redirect('proposalTemplate/proposal-template')->with('flash_message', 'ProposalTemplate deleted!');
        }
        return response(view('403'), 403);

    }
}
