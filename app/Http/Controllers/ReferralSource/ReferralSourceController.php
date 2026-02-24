<?php

namespace App\Http\Controllers\ReferralSource;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ReferralSource;
use Illuminate\Http\Request;

class ReferralSourceController extends Controller
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $referralsource = ReferralSource::where('name', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')->paginate($perPage);
            } else {
                $referralsource = ReferralSource::orderBy('id','DESC')->paginate($perPage);
            }

            return view('referralSource.referral-source.index', compact('referralsource'));
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('referralSource.referral-source.create');
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
            'status' => 'required'
		]);
            $requestData = $request->all();
            
            ReferralSource::create($requestData);
            return redirect('referralSource/referral-source')->with('flash_message', 'ReferralSource added!');
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $referralsource = ReferralSource::findOrFail($id);
            return view('referralSource.referral-source.show', compact('referralsource'));
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $referralsource = ReferralSource::findOrFail($id);
            return view('referralSource.referral-source.edit', compact('referralsource'));
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required'
		]);
            $requestData = $request->all();
            
            $referralsource = ReferralSource::findOrFail($id);
             $referralsource->update($requestData);

             return redirect('referralSource/referral-source')->with('flash_message', 'ReferralSource updated!');
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
        $model = str_slug('referralsource','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ReferralSource::destroy($id);

            return redirect('referralSource/referral-source')->with('flash_message', 'ReferralSource deleted!');
        }
        return response(view('403'), 403);

    }
}
