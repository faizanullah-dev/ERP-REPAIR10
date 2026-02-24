<?php

namespace App\Http\Controllers\EmailTemplateFolder;

use App\EmailBranding;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailTemplateFolder;
use Illuminate\Http\Request;

class EmailTemplateFolderController extends Controller
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailtemplatefolder = EmailTemplateFolder::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailtemplatefolder = EmailTemplateFolder::paginate($perPage);
            }

            return view('emailTemplateFolder.email-template-folder.index', compact('emailtemplatefolder'));
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('emailTemplateFolder.email-template-folder.create');
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            EmailTemplateFolder::create($requestData);
            return redirect('emailTemplateFolder/email-template-folder')->with('flash_message', 'EmailTemplateFolder added!');
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailtemplatefolder = EmailTemplateFolder::findOrFail($id);
            return view('emailTemplateFolder.email-template-folder.show', compact('emailtemplatefolder'));
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailtemplatefolder = EmailTemplateFolder::findOrFail($id);
            return view('emailTemplateFolder.email-template-folder.edit', compact('emailtemplatefolder'));
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $emailtemplatefolder = EmailTemplateFolder::findOrFail($id);
             $emailtemplatefolder->update($requestData);

             return redirect('emailTemplateFolder/email-template-folder')->with('flash_message', 'EmailTemplateFolder updated!');
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
        $model = str_slug('emailtemplatefolder','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailTemplateFolder::destroy($id);

            return redirect('emailTemplateFolder/email-template-folder')->with('flash_message', 'EmailTemplateFolder deleted!');
        }
        return response(view('403'), 403);

    }

    public function editEmailTemplateFolderModal(Request $request, $id = null){
        extract($request->all());
        $emailtemplatefolder = EmailTemplateFolder::findOrFail($id);
        return (string)view('emailTemplateFolder.email-template-folder.edit_email_template_folder_modal', compact('emailtemplatefolder'));
    }

    public function emailBranding(Request $request){
        $branding = EmailBranding::first();
        return view('emailTemplateFolder.email-template-folder.email_branding', compact('branding'));
    }
}
