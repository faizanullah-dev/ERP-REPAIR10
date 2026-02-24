<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $notification = Notification::where('notification_name', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('time', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $notification = Notification::paginate($perPage);
            }

            return view('notification.notification.index', compact('notification'));
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('notification.notification.create');
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            Notification::create($requestData);
            return redirect('notification/notification')->with('flash_message', 'Notification added!');
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $notification = Notification::findOrFail($id);
            return view('notification.notification.show', compact('notification'));
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $notification = Notification::findOrFail($id);
            return view('notification.notification.edit', compact('notification'));
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $notification = Notification::findOrFail($id);
             $notification->update($requestData);

             return redirect('notification/notification')->with('flash_message', 'Notification updated!');
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
        $model = str_slug('notification','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Notification::destroy($id);

            return redirect('notification/notification')->with('flash_message', 'Notification deleted!');
        }
        return response(view('403'), 403);

    }
}
