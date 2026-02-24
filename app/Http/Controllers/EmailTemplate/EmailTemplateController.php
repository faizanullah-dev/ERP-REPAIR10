<?php

namespace App\Http\Controllers\EmailTemplate;

use App\EmailTemplateAttachment;
use App\EmailTemplateFolder;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailTemplate;
use App\EmailTemplateVariable;
use App\JobNoteAttachment;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailtemplate = EmailTemplate::where('title', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('body', 'LIKE', "%$keyword%")
                ->orWhere('attachment', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailtemplate = EmailTemplate::paginate($perPage);
            }

            return view('emailTemplate.email-template.index', compact('emailtemplate'));
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $variables = EmailTemplateVariable::get();
            $emailTemplateFolders = EmailTemplateFolder::whereStatus('1')->get();
            return view('emailTemplate.email-template.create', compact('variables', 'emailTemplateFolders'));
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $emailTemplate = EmailTemplate::create([
                'email_template_folder_id' => $request->email_template_folder_id,
                'title'    => $request->title,
                'subject'  => $request->subject,
                'body'     => $request->body,
                'created_by'  => auth()->id(),
            ]);
            if ($request->email_template_attachment!='') {
                foreach(explode(',',$request->email_template_attachment) as $key => $value){
                    EmailTemplateAttachment::create([
                        'email_template_id'    => $emailTemplate->id,
                        'name'                 => $value
                    ]);
                }//end foreach.
            }//end if.
            if ($request->email_template != '') {
                return back()->with('flash_message', 'EmailTemplate added!!');
            }
            return redirect('emailTemplate/email-template')->with('flash_message', 'EmailTemplate added!');
        }//end if.
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailtemplate = EmailTemplate::findOrFail($id);
            return view('emailTemplate.email-template.show', compact('emailtemplate'));
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailtemplate = EmailTemplate::findOrFail($id);
            $variables = EmailTemplateVariable::get();
            $emailTemplateFolders = EmailTemplateFolder::whereStatus('1')->get();
            return view('emailTemplate.email-template.edit', compact('emailtemplate','variables', 'emailTemplateFolders'));
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $emailtemplate = EmailTemplate::findOrFail($id);
                 EmailTemplate::where('id', $emailtemplate->id)->update([
                    'email_template_folder_id' => $request->email_template_folder_id ?? null,
                    'title'    => $request->title,
                    'subject'  => $request->subject,
                    'body'     => $request->body,
                    'created_by'  => auth()->user()->id,
                 ]);
                if ($request->email_template_attachment!='') {
                    foreach(explode(',',$request->email_template_attachment) as $key => $value){
                        EmailTemplateAttachment::where('email_template_id', $id)->where('name', $value)->updateOrCreate([
                            'email_template_id'    => $emailtemplate->id,
                            'name'                 => $value
                        ]);
                    }//end foreach.
                }//end if.
             return redirect('email_template_listing/'.$request->email_template_folder_id)->with('flash_message', 'EmailTemplate updated!');
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
        $model = str_slug('emailtemplate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailTemplate::destroy($id);

            return redirect('emailTemplate/email-template')->with('flash_message', 'EmailTemplate deleted!');
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
    public function emailTemplateListing(Request $request, $id){
        $model = str_slug('emailTemplate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $emailTemplate = EmailTemplate::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('subject', 'LIKE', "%$keyword%")
                    ->orWhere('body', 'LIKE', "%$keyword%")
                    ->orWhere('attachment', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $emailTemplate = EmailTemplate::where('email_template_folder_id', $id)->paginate($perPage);
            }
            return view('emailTemplate/email-template/email_template_listing', compact('emailTemplate'));
        }
        return response(view('403'), 403);
    }
}
