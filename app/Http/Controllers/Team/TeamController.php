<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Role;
use App\Team;
use App\User;
use App\UserTeam;
use Illuminate\Http\Request;

class TeamController extends Controller
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
        $model = str_slug('team','-');

        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $team = Team::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
            } else {
                $team = Team::get();
//                $roles = Role::get();
                $users = User::whereDoesntHave('roles', function($q) {
                    $q->whereIn('name', ['admin', 'user']);
                })->get();
                $roles = Role::with('users')->get();

            }

            return view('team.team.index', compact('team', 'roles', 'users'));
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
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $roles = Role::get();
            return view('team.team.create', compact('users', 'roles'));
        }
        return response(view('403'), 403);

    }


    public function store(Request $request)
    {
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $team = Team::create([ 'name'=>$request->name, 'created_by' => auth()->user()->id ]);
            if (!empty($user_team_id)){
                foreach ($user_team_id as $user_id) {
                    UserTeam::create(['team_id'=> $team->id,'user_id'=> $user_id,]);
                }//ends foreach.
            }//ends if.
            return redirect('team/team')->with('flash_message', 'Team added!');
        }//ends if.
        return response(view('403'), 403);
    }//ends store function.

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $team = Team::findOrFail($id);
            return view('team.team.show', compact('team'));
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
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $team = Team::findOrFail($id);
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $roles = Role::get();
            return view('team.team.edit', compact('team','roles', 'users'));
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
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            extract($request->all());
            $requestData = $request->all();
                Team::where('id', $id)->update([ 'name'=>$request->name, ]);
            if (!empty($user_team_id)){
                UserTeam::where('team_id', $id)->whereNotIn('user_id', $user_team_id)->delete();
                foreach ($user_team_id as $user_id) {
                    UserTeam::where('team_id', $id)->where('user_id', $user_id)->updateOrCreate([
                        'team_id'=> $id,
                        'user_id'=> $user_id,
                    ]);
                }
            }
             return redirect('team/team')->with('flash_message', 'Team updated!');
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
        $model = str_slug('team','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Team::destroy($id);

            return redirect('team/team')->with('flash_message', 'Team deleted!');
        }
        return response(view('403'), 403);

    }

    public function editTeamModal(Request $request, $id = null){
        extract($request->all());
        $team = Team::findOrFail($id);
        $users = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['admin', 'user']);
        })->get();
        $roles = Role::get();
        return (string)view('team.team.edit_team_modal', compact('team','roles', 'users'));
    }

    public function viewTeamModal(Request $request){
        extract($request->all());
        $team = Team::findOrFail($id);
        return (string) view('team.team.ajax.view_team_modal', compact('team'));
    }
}
