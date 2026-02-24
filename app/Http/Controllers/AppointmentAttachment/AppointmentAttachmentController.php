<?php

namespace App\Http\Controllers\AppointmentAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\AppointmentAttachment;
use Illuminate\Http\Request;

class AppointmentAttachmentController extends Controller
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $appointmentattachment = AppointmentAttachment::where('appointment_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('url', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $appointmentattachment = AppointmentAttachment::paginate($perPage);
            }

            return view('appointmentAttachment.appointment-attachment.index', compact('appointmentattachment'));
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('appointmentAttachment.appointment-attachment.create');
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            AppointmentAttachment::create($requestData);
            return redirect('appointmentAttachment/appointment-attachment')->with('flash_message', 'AppointmentAttachment added!');
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $appointmentattachment = AppointmentAttachment::findOrFail($id);
            return view('appointmentAttachment.appointment-attachment.show', compact('appointmentattachment'));
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $appointmentattachment = AppointmentAttachment::findOrFail($id);
            return view('appointmentAttachment.appointment-attachment.edit', compact('appointmentattachment'));
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $appointmentattachment = AppointmentAttachment::findOrFail($id);
             $appointmentattachment->update($requestData);

             return redirect('appointmentAttachment/appointment-attachment')->with('flash_message', 'AppointmentAttachment updated!');
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
        $model = str_slug('appointmentattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            AppointmentAttachment::destroy($id);

            return redirect('appointmentAttachment/appointment-attachment')->with('flash_message', 'AppointmentAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
