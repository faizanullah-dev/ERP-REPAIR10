<?php

namespace App\Http\Controllers\Call;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Call;
use App\Notification;
use Illuminate\Http\Request;

class CallController extends Controller
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $call = Call::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('time', 'LIKE', "%$keyword%")
                ->orWhere('duration', 'LIKE', "%$keyword%")
                ->orWhere('notes', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $call = Call::paginate($perPage);
            }

            return view('call.call.index', compact('call'));
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('call.call.create');
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
//        return $request->all();
        $model = str_slug('call','-');
        extract($request->all());
//        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $call = Call::create([
                'lead_id' => $lead_id,
                'phone' => $phone,
                'time' => $time,
                'date' => $date,
                'notes' => $notes,
                'duration' => $duration,
            ]);
            return response()->json(['call' => $call]);
//        }
//        return response(view('403'), 403);
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $call = Call::findOrFail($id);
            return view('call.call.show', compact('call'));
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $call = Call::findOrFail($id);
            return view('call.call.edit', compact('call'));
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $call = Call::findOrFail($id);
             $call->update($requestData);

             return redirect('call/call')->with('flash_message', 'Call updated!');
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
        $model = str_slug('call','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Call::destroy($id);

            return redirect('call/call')->with('flash_message', 'Call deleted!');
        }
        return response(view('403'), 403);

    }
    public function editCallModal(Request $request){
        $call = Call::find($request->call_id);
        return view('call.call.edit_call_modal', compact('call'));
    }
    public function updateCallModal(Request $request){
        extract($request->all());
        $call = Call::find($request->call_id);
        $call->update([
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'duration' => $duration,
            'notes' => $notes,
        ]);
        return back()->with('flash_message', 'Call Updated!');
    }
    public function deleteCall(Request $request){
        extract($request->all());
        $callDelete = Call::find($call_id);
        if (!$callDelete) {
            return response()->json(['status' => false, 'message' => 'Call not found']);
        }
        if($callDelete->delete()) {
            Notification::create([
                'lead_id' => $callDelete->lead_id ?? null,
                'model' => 'Call Deleted',
                'title' => 'Call deleted against the lead <b>' . $callDelete->getLead->title . '</b> by',
                'icon' => 'fa-regular fa-trash',
                'time' => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Call Deleted Successfully']);
        }
    }

}
