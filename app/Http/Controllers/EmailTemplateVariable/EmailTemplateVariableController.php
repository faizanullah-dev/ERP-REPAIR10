<?php

namespace App\Http\Controllers\EmailTemplateVariable;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\EmailTemplateVariable;
use App\EmailVariableType;
use Illuminate\Http\Request;

class EmailTemplateVariableController extends Controller
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $emailtemplatevariable = EmailTemplateVariable::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->orWhere('email_variable_type_id', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $emailtemplatevariable = EmailTemplateVariable::paginate($perPage);
            }

            return view('emailTemplateVariable.email-template-variable.index', compact('emailtemplatevariable'));
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $variableType = EmailVariableType::get();
            return view('emailTemplateVariable.email-template-variable.create',compact('variableType'));
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            EmailTemplateVariable::create($requestData);
            return redirect('emailTemplateVariable/email-template-variable')->with('flash_message', 'EmailTemplateVariable added!');
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $emailtemplatevariable = EmailTemplateVariable::findOrFail($id);
            return view('emailTemplateVariable.email-template-variable.show', compact('emailtemplatevariable'));
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $emailtemplatevariable = EmailTemplateVariable::findOrFail($id);
            $variableType = EmailVariableType::get();

            return view('emailTemplateVariable.email-template-variable.edit', compact('emailtemplatevariable','variableType'));
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $emailtemplatevariable = EmailTemplateVariable::findOrFail($id);
             $emailtemplatevariable->update($requestData);

             return redirect('emailTemplateVariable/email-template-variable')->with('flash_message', 'EmailTemplateVariable updated!');
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
        $model = str_slug('emailtemplatevariable','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            EmailTemplateVariable::destroy($id);

            return redirect('emailTemplateVariable/email-template-variable')->with('flash_message', 'EmailTemplateVariable deleted!');
        }
        return response(view('403'), 403);

    }
}
