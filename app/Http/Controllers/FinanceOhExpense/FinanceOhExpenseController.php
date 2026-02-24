<?php

namespace App\Http\Controllers\FinanceOhExpense;

use App\FinanceSheet;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FinanceOhExpense;
use Illuminate\Http\Request;

class FinanceOhExpenseController extends Controller
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $financeohexpense = FinanceOhExpense::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $financeohexpense = FinanceOhExpense::paginate($perPage);
            }

            return view('financeOhExpense.finance-oh-expense.index', compact('financeohexpense'));
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('financeOhExpense.finance-oh-expense.create');
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
//        return $request->all();
        extract($request->all());
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            foreach ($expense as $name => $item) {
                FinanceOhExpense::updateOrCreate(
                    [
                        'finance_sheet_id' => $finance_sheet_id,
                        'name' => $name,
                    ],
                    [
                        'value' => $item['value'],  // Update the value of each expense
                    ]
                );
            }
            FinanceSheet::where('id', $finance_sheet_id)->update([
                'total_oh_expense' => (float) str_replace('$', '', $total_oh_expense),
            ]);
            return back()->with('flash_message', 'Total overhead expense added!');
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $financeohexpense = FinanceOhExpense::findOrFail($id);
            return view('financeOhExpense.finance-oh-expense.show', compact('financeohexpense'));
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $financeohexpense = FinanceOhExpense::findOrFail($id);
            return view('financeOhExpense.finance-oh-expense.edit', compact('financeohexpense'));
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $financeohexpense = FinanceOhExpense::findOrFail($id);
             $financeohexpense->update($requestData);

             return redirect('financeOhExpense/finance-oh-expense')->with('flash_message', 'FinanceOhExpense updated!');
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
        $model = str_slug('financeohexpense','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FinanceOhExpense::destroy($id);

            return redirect('financeOhExpense/finance-oh-expense')->with('flash_message', 'FinanceOhExpense deleted!');
        }
        return response(view('403'), 403);

    }
}
