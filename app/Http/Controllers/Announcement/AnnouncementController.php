<?php

namespace App\Http\Controllers\Announcement;

use App\AssignAnnouncement;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Announcement;
use App\Team;
use App\User;
use App\UserTeam;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $announcement = Announcement::where('announcement', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
//                $announcement = Announcement::paginate($perPage);
                if (auth()->user()->hasRole('user')){
                    $announcement = Announcement::get();
                    $teams = Team::get();
                }else{
                    $userteam = UserTeam::with('getteam')->where('user_id', auth()->user()->id)->first();
                    if($userteam){
                        $userTeams = UserTeam::with('getteam')->where('user_id', auth()->user()->id)->get();
                        $teamIds = $userTeams->pluck('getteam.*.id')->flatten()->toArray();
                        $announcement = AssignAnnouncement::whereIn('team_id', $teamIds)->get()->pluck('announcement')->flatten();
                    }//elseif.
                }//end elseif.
            }

            return view('announcement.announcement.index', compact('announcement', 'teams'));
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $teams = Team::get();
            return view('announcement.announcement.create', compact('teams'));
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $announcement = Announcement::create([
                'description' => $description??"",
                'created_by' => auth()->id(),
            ]);
            if (!empty($assign_announcement_user_id) && is_array($assign_announcement_user_id)) {
                $teams = Team::whereIn('id', $assign_announcement_user_id)->get();
                foreach ($teams as $team) {
                    $teamUsers = UserTeam::where('team_id', $team->id)->get();
                    foreach ($teamUsers as $teamUser) {
                        // Use firstOrCreate to avoid duplicating user_id for the same announcement_id
                        AssignAnnouncement::firstOrCreate([
                            'announcement_id' => $announcement->id,
                            'user_id'         => $teamUser->user_id,
                        ],[
                            'team_id'         => $team->id,
                        ]);
                    }//end foreach.
                }//end foreach.
            }//end if.
            return redirect('announcement/announcement')->with('flash_message', 'Announcement added!');
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $announcement = Announcement::with('getAnnouncementUser.getAnnouncementUserTeam.getUserTeam.getteam')->findOrFail($id);
            return view('announcement.announcement.show', compact('announcement'));
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $announcement = Announcement::findOrFail($id);
            $teams = Team::get(); //User::whereDoesntHave('roles', function($q) {$q->whereIn('name', ['admin', 'user']);})->get();
            return view('announcement.announcement.edit', compact('announcement', 'teams'));
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            extract($request->all());
            $requestData = $request->all();
            $announcement = Announcement::findOrFail($id);
            Announcement::where('id', $id)->update(['description' => $description??""]);
            if (!empty($assign_announcement_user_id) && is_array($assign_announcement_user_id)) {
                AssignAnnouncement::where('announcement_id', $id)->delete();
                $teams = Team::whereIn('id', $assign_announcement_user_id)->get();
                foreach($teams as $team){
                    $teamUsers = UserTeam::where('team_id', $team->id)->get();
                    foreach ($teamUsers as $teamUser) {
                        AssignAnnouncement::firstOrCreate([
                            'announcement_id' => $announcement->id,
                            'user_id'         => $teamUser->user_id,
                        ],[
                            'team_id'         => $team->id,
                        ]);
                    }//end foreach.
                }//end foreach.
            }//end if.
           return redirect('announcement/announcement')->with('flash_message', 'Announcement updated!');
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
        $model = str_slug('announcement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Announcement::destroy($id);

            return redirect('announcement/announcement')->with('flash_message', 'Announcement deleted!');
        }
        return response(view('403'), 403);

    }

    public function editAnnouncementModal(Request  $request, $id = null) {
        extract($request->all());
        $announcement = Announcement::findOrFail($id);
        $teams = Team::get();
        return view('announcement.announcement.edit_announcement_modal', compact('announcement','teams'));
    }

    public function viewAnnouncementModal(Request $request){
        extract($request->all());
        $announcement = Announcement::findOrFail($id);
        return (string) view('announcement.announcement.ajax.view_announcement_modal', compact('announcement'));
    }
}
