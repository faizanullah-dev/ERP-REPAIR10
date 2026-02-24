<?php

namespace App\Http\Controllers\UsersMailboxesSent;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UsersMailboxesSent;
use Illuminate\Http\Request;

class UsersMailboxesSentController extends Controller
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usersmailboxessent = UsersMailboxesSent::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('configuration_email', 'LIKE', "%$keyword%")
                ->orWhere('uid', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('from', 'LIKE', "%$keyword%")
                ->orWhere('to', 'LIKE', "%$keyword%")
                ->orWhere('cc', 'LIKE', "%$keyword%")
                ->orWhere('bcc', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('mail_attachment', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $usersmailboxessent = UsersMailboxesSent::paginate($perPage);
            }

            return view('usersMailboxesSent.users-mailboxes-sent.index', compact('usersmailboxessent'));
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('usersMailboxesSent.users-mailboxes-sent.create');
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            UsersMailboxesSent::create($requestData);
            return redirect('usersMailboxesSent/users-mailboxes-sent')->with('flash_message', 'UsersMailboxesSent added!');
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $usersmailboxessent = UsersMailboxesSent::findOrFail($id);
            return view('usersMailboxesSent.users-mailboxes-sent.show', compact('usersmailboxessent'));
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $usersmailboxessent = UsersMailboxesSent::findOrFail($id);
            return view('usersMailboxesSent.users-mailboxes-sent.edit', compact('usersmailboxessent'));
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $usersmailboxessent = UsersMailboxesSent::findOrFail($id);
             $usersmailboxessent->update($requestData);

             return redirect('usersMailboxesSent/users-mailboxes-sent')->with('flash_message', 'UsersMailboxesSent updated!');
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
        $model = str_slug('usersmailboxessent','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            UsersMailboxesSent::destroy($id);

            return redirect('usersMailboxesSent/users-mailboxes-sent')->with('flash_message', 'UsersMailboxesSent deleted!');
        }
        return response(view('403'), 403);

    }
}
