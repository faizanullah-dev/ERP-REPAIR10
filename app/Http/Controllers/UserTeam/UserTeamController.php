<?php

namespace App\Http\Controllers\UserTeam;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UserTeam;
use Illuminate\Http\Request;

class UserTeamController extends Controller
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $userteam = UserTeam::where('team_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $userteam = UserTeam::paginate($perPage);
            }

            return view('userTeam.user-team.index', compact('userteam'));
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('userTeam.user-team.create');
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            UserTeam::create($requestData);
            return redirect('userTeam/user-team')->with('flash_message', 'UserTeam added!');
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $userteam = UserTeam::findOrFail($id);
            return view('userTeam.user-team.show', compact('userteam'));
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $userteam = UserTeam::findOrFail($id);
            return view('userTeam.user-team.edit', compact('userteam'));
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $userteam = UserTeam::findOrFail($id);
             $userteam->update($requestData);

             return redirect('userTeam/user-team')->with('flash_message', 'UserTeam updated!');
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
        $model = str_slug('userteam','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            UserTeam::destroy($id);

            return redirect('userTeam/user-team')->with('flash_message', 'UserTeam deleted!');
        }
        return response(view('403'), 403);

    }
}
