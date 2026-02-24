<?php

namespace App\Http\Controllers\HolidayDate;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\HolidayDate;
use Illuminate\Http\Request;

class HolidayDateController extends Controller
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $holidaydate = HolidayDate::where('holiday_id', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $holidaydate = HolidayDate::paginate($perPage);
            }

            return view('holidayDate.holiday-date.index', compact('holidaydate'));
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('holidayDate.holiday-date.create');
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            HolidayDate::create($requestData);
            return redirect('holidayDate/holiday-date')->with('flash_message', 'HolidayDate added!');
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $holidaydate = HolidayDate::findOrFail($id);
            return view('holidayDate.holiday-date.show', compact('holidaydate'));
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $holidaydate = HolidayDate::findOrFail($id);
            return view('holidayDate.holiday-date.edit', compact('holidaydate'));
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $holidaydate = HolidayDate::findOrFail($id);
             $holidaydate->update($requestData);

             return redirect('holidayDate/holiday-date')->with('flash_message', 'HolidayDate updated!');
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
        $model = str_slug('holidaydate','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            HolidayDate::destroy($id);

            return redirect('holidayDate/holiday-date')->with('flash_message', 'HolidayDate deleted!');
        }
        return response(view('403'), 403);

    }
}
