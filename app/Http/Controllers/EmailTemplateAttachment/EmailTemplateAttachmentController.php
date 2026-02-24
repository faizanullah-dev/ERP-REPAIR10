<?php

namespace App\Http\Controllers\EmailTemplateAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailTemplateAttachment;
use Illuminate\Http\Request;

class EmailTemplateAttachmentController extends Controller
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailtemplateattachment = EmailTemplateAttachment::where('email_template_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailtemplateattachment = EmailTemplateAttachment::paginate($perPage);
            }

            return view('emailTemplateAttachment.email-template-attachment.index', compact('emailtemplateattachment'));
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('emailTemplateAttachment.email-template-attachment.create');
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            EmailTemplateAttachment::create($requestData);
            return redirect('emailTemplateAttachment/email-template-attachment')->with('flash_message', 'EmailTemplateAttachment added!');
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailtemplateattachment = EmailTemplateAttachment::findOrFail($id);
            return view('emailTemplateAttachment.email-template-attachment.show', compact('emailtemplateattachment'));
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailtemplateattachment = EmailTemplateAttachment::findOrFail($id);
            return view('emailTemplateAttachment.email-template-attachment.edit', compact('emailtemplateattachment'));
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $emailtemplateattachment = EmailTemplateAttachment::findOrFail($id);
             $emailtemplateattachment->update($requestData);

             return redirect('emailTemplateAttachment/email-template-attachment')->with('flash_message', 'EmailTemplateAttachment updated!');
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
        $model = str_slug('emailtemplateattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailTemplateAttachment::destroy($id);

            return redirect('emailTemplateAttachment/email-template-attachment')->with('flash_message', 'EmailTemplateAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
