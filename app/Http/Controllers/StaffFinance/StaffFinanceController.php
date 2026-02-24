<?php

namespace App\Http\Controllers\StaffFinance;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\StaffFinance;
use Illuminate\Http\Request;

class StaffFinanceController extends Controller
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $stafffinance = StaffFinance::where('staff_id', 'LIKE', "%$keyword%")
                ->orWhere('staff_position', 'LIKE', "%$keyword%")
                ->orWhere('staff_compensation', 'LIKE', "%$keyword%")
                ->orWhere('position_record', 'LIKE', "%$keyword%")
                ->orWhere('compensation_record', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $stafffinance = StaffFinance::paginate($perPage);
            }

            return view('staffFinance.staff-finance.index', compact('stafffinance'));
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('staffFinance.staff-finance.create');
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            StaffFinance::create($requestData);
            return redirect('staffFinance/staff-finance')->with('flash_message', 'StaffFinance added!');
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $stafffinance = StaffFinance::findOrFail($id);
            return view('staffFinance.staff-finance.show', compact('stafffinance'));
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $stafffinance = StaffFinance::findOrFail($id);
            return view('staffFinance.staff-finance.edit', compact('stafffinance'));
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $stafffinance = StaffFinance::findOrFail($id);
             $stafffinance->update($requestData);

             return redirect('staffFinance/staff-finance')->with('flash_message', 'StaffFinance updated!');
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
        $model = str_slug('stafffinance','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StaffFinance::destroy($id);

            return redirect('staffFinance/staff-finance')->with('flash_message', 'StaffFinance deleted!');
        }
        return response(view('403'), 403);

    }
}
