<?php

namespace App\Http\Controllers\ProposalTemplateAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProposalTemplateAttachment;
use Illuminate\Http\Request;

class ProposalTemplateAttachmentController extends Controller
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $proposaltemplateattachment = ProposalTemplateAttachment::where('template_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('is_primary', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $proposaltemplateattachment = ProposalTemplateAttachment::paginate($perPage);
            }

            return view('proposalTemplateAttachment.proposal-template-attachment.index', compact('proposaltemplateattachment'));
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('proposalTemplateAttachment.proposal-template-attachment.create');
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProposalTemplateAttachment::create($requestData);
            return redirect('proposalTemplateAttachment/proposal-template-attachment')->with('flash_message', 'ProposalTemplateAttachment added!');
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $proposaltemplateattachment = ProposalTemplateAttachment::findOrFail($id);
            return view('proposalTemplateAttachment.proposal-template-attachment.show', compact('proposaltemplateattachment'));
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $proposaltemplateattachment = ProposalTemplateAttachment::findOrFail($id);
            return view('proposalTemplateAttachment.proposal-template-attachment.edit', compact('proposaltemplateattachment'));
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $proposaltemplateattachment = ProposalTemplateAttachment::findOrFail($id);
             $proposaltemplateattachment->update($requestData);

             return redirect('proposalTemplateAttachment/proposal-template-attachment')->with('flash_message', 'ProposalTemplateAttachment updated!');
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
        $model = str_slug('proposaltemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProposalTemplateAttachment::destroy($id);

            return redirect('proposalTemplateAttachment/proposal-template-attachment')->with('flash_message', 'ProposalTemplateAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
