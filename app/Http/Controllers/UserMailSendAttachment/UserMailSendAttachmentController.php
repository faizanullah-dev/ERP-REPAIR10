<?php

namespace App\Http\Controllers\UserMailSendAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UserMailSendAttachment;
use Illuminate\Http\Request;

class UserMailSendAttachmentController extends Controller
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usermailsendattachment = UserMailSendAttachment::where('user_mail_send_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $usermailsendattachment = UserMailSendAttachment::paginate($perPage);
            }

            return view('userMailSendAttachment.user-mail-send-attachment.index', compact('usermailsendattachment'));
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('userMailSendAttachment.user-mail-send-attachment.create');
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            UserMailSendAttachment::create($requestData);
            return redirect('userMailSendAttachment/user-mail-send-attachment')->with('flash_message', 'UserMailSendAttachment added!');
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $usermailsendattachment = UserMailSendAttachment::findOrFail($id);
            return view('userMailSendAttachment.user-mail-send-attachment.show', compact('usermailsendattachment'));
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $usermailsendattachment = UserMailSendAttachment::findOrFail($id);
            return view('userMailSendAttachment.user-mail-send-attachment.edit', compact('usermailsendattachment'));
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $usermailsendattachment = UserMailSendAttachment::findOrFail($id);
             $usermailsendattachment->update($requestData);

             return redirect('userMailSendAttachment/user-mail-send-attachment')->with('flash_message', 'UserMailSendAttachment updated!');
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
        $model = str_slug('usermailsendattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            UserMailSendAttachment::destroy($id);

            return redirect('userMailSendAttachment/user-mail-send-attachment')->with('flash_message', 'UserMailSendAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
