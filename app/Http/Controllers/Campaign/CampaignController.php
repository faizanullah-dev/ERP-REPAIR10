<?php

namespace App\Http\Controllers\Campaign;

use App\CampaignDetail;
use App\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Campaign;
use App\Stage;
use Illuminate\Http\Request;

class CampaignController extends Controller
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $campaign = Campaign::where('name', 'LIKE', "%$keyword%")
                ->orWhere('stage_id', 'LIKE', "%$keyword%")
                ->orWhere('status'  , 'LIKE', "%$keyword%")
                ->paginate($perPage);
            }else{
               if($request->campaign_type == 'active'){
                   $campaign = Campaign::where('status', 1)->paginate($perPage);
               }elseif($request->campaign_type == 'inactive'){
                       $campaign = Campaign::where('status', 0)->paginate($perPage);
               }//end else if.
            }//end if.
            return view('campaign.campaign.index', compact('campaign'));
        }//end if.
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('campaign.campaign.create');
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            Campaign::create($requestData);
            return redirect('campaign/campaign?campaign_type=' . $requestData['status'])->with('flash_message', 'Campaign added!');
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $campaign = Campaign::findOrFail($id);
            $campaignDetails = CampaignDetail::where('campaign_id' ,$id)->get();
            $stages = Stage::get();
            return view('campaign.campaign.show', compact('campaign', 'campaignDetails', 'stages'));
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $campaign = Campaign::findOrFail($id);
            $campaignDetails = CampaignDetail::where('campaign_id' ,$id)->get();
            $stages = Stage::get();
            $emailTemplates = EmailTemplate::get();
            return view('campaign.campaign.edit', compact('campaign', 'stages', 'campaignDetails', 'emailTemplates'));
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            $requestData = $request->all();

            $campaign = Campaign::findOrFail($id);
             $campaign->update($requestData);

             return redirect('campaign/campaign')->with('flash_message', 'Campaign updated!');
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
        $model = str_slug('campaign','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Campaign::destroy($id);

            return back()->with('flash_message', 'Campaign deleted!');
        }
        return response(view('403'), 403);

    }
}
