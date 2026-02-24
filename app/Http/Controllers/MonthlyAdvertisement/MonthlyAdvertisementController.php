<?php

namespace App\Http\Controllers\MonthlyAdvertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\MonthlyAdvertisement;
use Illuminate\Http\Request;

class MonthlyAdvertisementController extends Controller
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $monthlyadvertisement = MonthlyAdvertisement::where('advertisement_id', 'LIKE', "%$keyword%")
                ->orWhere('referral_source_id', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $monthlyadvertisement = MonthlyAdvertisement::paginate($perPage);
            }

            return view('monthlyAdvertisement.monthly-advertisement.index', compact('monthlyadvertisement'));
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('monthlyAdvertisement.monthly-advertisement.create');
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            MonthlyAdvertisement::create($requestData);
            return redirect('monthlyAdvertisement/monthly-advertisement')->with('flash_message', 'MonthlyAdvertisement added!');
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $monthlyadvertisement = MonthlyAdvertisement::findOrFail($id);
            return view('monthlyAdvertisement.monthly-advertisement.show', compact('monthlyadvertisement'));
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $monthlyadvertisement = MonthlyAdvertisement::findOrFail($id);
            return view('monthlyAdvertisement.monthly-advertisement.edit', compact('monthlyadvertisement'));
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $monthlyadvertisement = MonthlyAdvertisement::findOrFail($id);
             $monthlyadvertisement->update($requestData);

             return redirect('monthlyAdvertisement/monthly-advertisement')->with('flash_message', 'MonthlyAdvertisement updated!');
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
        $model = str_slug('monthlyadvertisement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            MonthlyAdvertisement::destroy($id);

            return redirect('monthlyAdvertisement/monthly-advertisement')->with('flash_message', 'MonthlyAdvertisement deleted!');
        }
        return response(view('403'), 403);

    }
}
