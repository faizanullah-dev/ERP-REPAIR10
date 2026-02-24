<?php

namespace App\Http\Controllers\YearEstimateMonth;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\YearEstimateMonth;
use Illuminate\Http\Request;

class YearEstimateMonthController extends Controller
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $yearestimatemonth = YearEstimateMonth::where('year_estimation_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('percentage', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('month_required_leads', 'LIKE', "%$keyword%")
                ->orWhere('month_needed_leads', 'LIKE', "%$keyword%")
                ->orWhere('extra_leads', 'LIKE', "%$keyword%")
                ->orWhere('extra_amount', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $yearestimatemonth = YearEstimateMonth::paginate($perPage);
            }

            return view('yearEstimateMonth.year-estimate-month.index', compact('yearestimatemonth'));
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('yearEstimateMonth.year-estimate-month.create');
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            YearEstimateMonth::create($requestData);
            return redirect('yearEstimateMonth/year-estimate-month')->with('flash_message', 'YearEstimateMonth added!');
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $yearestimatemonth = YearEstimateMonth::findOrFail($id);
            return view('yearEstimateMonth.year-estimate-month.show', compact('yearestimatemonth'));
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $yearestimatemonth = YearEstimateMonth::findOrFail($id);
            return view('yearEstimateMonth.year-estimate-month.edit', compact('yearestimatemonth'));
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $yearestimatemonth = YearEstimateMonth::findOrFail($id);
             $yearestimatemonth->update($requestData);

             return redirect('yearEstimateMonth/year-estimate-month')->with('flash_message', 'YearEstimateMonth updated!');
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
        $model = str_slug('yearestimatemonth','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            YearEstimateMonth::destroy($id);

            return redirect('yearEstimateMonth/year-estimate-month')->with('flash_message', 'YearEstimateMonth deleted!');
        }
        return response(view('403'), 403);

    }
}
