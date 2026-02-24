<?php

namespace App\Http\Controllers\AppointmentAttendee;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\AppointmentAttendee;
use Illuminate\Http\Request;

class AppointmentAttendeeController extends Controller
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $appointmentattendee = AppointmentAttendee::where('appointment_id', 'LIKE', "%$keyword%")
                ->orWhere('attendees_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $appointmentattendee = AppointmentAttendee::paginate($perPage);
            }

            return view('appointmentAttendee.appointment-attendee.index', compact('appointmentattendee'));
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('appointmentAttendee.appointment-attendee.create');
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            AppointmentAttendee::create($requestData);
            return redirect('appointmentAttendee/appointment-attendee')->with('flash_message', 'AppointmentAttendee added!');
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $appointmentattendee = AppointmentAttendee::findOrFail($id);
            return view('appointmentAttendee.appointment-attendee.show', compact('appointmentattendee'));
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $appointmentattendee = AppointmentAttendee::findOrFail($id);
            return view('appointmentAttendee.appointment-attendee.edit', compact('appointmentattendee'));
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $appointmentattendee = AppointmentAttendee::findOrFail($id);
             $appointmentattendee->update($requestData);

             return redirect('appointmentAttendee/appointment-attendee')->with('flash_message', 'AppointmentAttendee updated!');
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
        $model = str_slug('appointmentattendee','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            AppointmentAttendee::destroy($id);

            return redirect('appointmentAttendee/appointment-attendee')->with('flash_message', 'AppointmentAttendee deleted!');
        }
        return response(view('403'), 403);

    }
}
