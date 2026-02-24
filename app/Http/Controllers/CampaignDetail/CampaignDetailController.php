<?php

namespace App\Http\Controllers\CampaignDetail;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CampaignDetail;
use Illuminate\Http\Request;

class CampaignDetailController extends Controller
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $campaigndetail = CampaignDetail::where('day', 'LIKE', "%$keyword%")
                ->orWhere('time', 'LIKE', "%$keyword%")
                ->orWhere('message_type', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->orWhere('campaign_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $campaigndetail = CampaignDetail::paginate($perPage);
            }

            return view('campaignDetail.campaign-detail.index', compact('campaigndetail'));
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('campaignDetail.campaign-detail.create');
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            CampaignDetail::create($requestData);
            return redirect('campaignDetail/campaign-detail')->with('flash_message', 'CampaignDetail added!');
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $campaigndetail = CampaignDetail::findOrFail($id);
            return view('campaignDetail.campaign-detail.show', compact('campaigndetail'));
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $campaigndetail = CampaignDetail::findOrFail($id);
            return view('campaignDetail.campaign-detail.edit', compact('campaigndetail'));
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $campaigndetail = CampaignDetail::findOrFail($id);
             $campaigndetail->update($requestData);

             return redirect('campaignDetail/campaign-detail')->with('flash_message', 'CampaignDetail updated!');
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
        $model = str_slug('campaigndetail','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CampaignDetail::destroy($id);

            return redirect('campaignDetail/campaign-detail')->with('flash_message', 'CampaignDetail deleted!');
        }
        return response(view('403'), 403);

    }
}
