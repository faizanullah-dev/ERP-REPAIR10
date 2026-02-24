<?php

namespace App\Http\Controllers\UsersMailboxConfiguration;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UsersMailboxConfiguration;
use Illuminate\Http\Request;

class UsersMailboxConfigurationController extends Controller
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $usersmailboxconfiguration = UsersMailboxConfiguration::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('mail_host', 'LIKE', "%$keyword%")
                ->orWhere('mail_port', 'LIKE', "%$keyword%")
                ->orWhere('mail_encryption_type', 'LIKE', "%$keyword%")
                ->orWhere('mail_username', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->orWhere('mail_protocol', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if (auth()->user()->hasRole('user')) {
                    $usersmailboxconfiguration = UsersMailboxConfiguration::paginate($perPage);
                }else{
                    $usersmailboxconfiguration = UsersMailboxConfiguration::where('user_id', auth()->user()->id)->paginate($perPage);
                }//end if.
            }//end elseif.
            return view('usersMailboxConfiguration.users-mailbox-configuration.index', compact('usersmailboxconfiguration'));
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('usersMailboxConfiguration.users-mailbox-configuration.create');
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            UsersMailboxConfiguration::create($requestData);
            return redirect('usersMailboxConfiguration/users-mailbox-configuration')->with('flash_message', 'UsersMailboxConfiguration added!');
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $usersmailboxconfiguration = UsersMailboxConfiguration::findOrFail($id);
            return view('usersMailboxConfiguration.users-mailbox-configuration.show', compact('usersmailboxconfiguration'));
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $usersmailboxconfiguration = UsersMailboxConfiguration::findOrFail($id);
            return view('usersMailboxConfiguration.users-mailbox-configuration.edit', compact('usersmailboxconfiguration'));
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $usersmailboxconfiguration = UsersMailboxConfiguration::findOrFail($id);
             $usersmailboxconfiguration->update($requestData);

             return redirect('usersMailboxConfiguration/users-mailbox-configuration')->with('flash_message', 'UsersMailboxConfiguration updated!');
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
        $model = str_slug('usersmailboxconfiguration','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            UsersMailboxConfiguration::destroy($id);

            return redirect('usersMailboxConfiguration/users-mailbox-configuration')->with('flash_message', 'UsersMailboxConfiguration deleted!');
        }
        return response(view('403'), 403);

    }
}
