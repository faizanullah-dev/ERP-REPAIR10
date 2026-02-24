<?php

namespace App\Http\Controllers\FinanceGrossExpense;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FinanceGrossExpense;
use Illuminate\Http\Request;

class FinanceGrossExpenseController extends Controller
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $financegrossexpense = FinanceGrossExpense::where('finance_sheet_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $financegrossexpense = FinanceGrossExpense::paginate($perPage);
            }

            return view('financeGrossExpense.finance-gross-expense.index', compact('financegrossexpense'));
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('financeGrossExpense.finance-gross-expense.create');
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            FinanceGrossExpense::create($requestData);
            return redirect('financeGrossExpense/finance-gross-expense')->with('flash_message', 'FinanceGrossExpense added!');
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $financegrossexpense = FinanceGrossExpense::findOrFail($id);
            return view('financeGrossExpense.finance-gross-expense.show', compact('financegrossexpense'));
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $financegrossexpense = FinanceGrossExpense::findOrFail($id);
            return view('financeGrossExpense.finance-gross-expense.edit', compact('financegrossexpense'));
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $financegrossexpense = FinanceGrossExpense::findOrFail($id);
             $financegrossexpense->update($requestData);

             return redirect('financeGrossExpense/finance-gross-expense')->with('flash_message', 'FinanceGrossExpense updated!');
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
        $model = str_slug('financegrossexpense','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FinanceGrossExpense::destroy($id);

            return redirect('financeGrossExpense/finance-gross-expense')->with('flash_message', 'FinanceGrossExpense deleted!');
        }
        return response(view('403'), 403);

    }
}
