<?php

namespace App\Http\Controllers\FinanceGrossIncome;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FinanceGrossIncome;
use Illuminate\Http\Request;

class FinanceGrossIncomeController extends Controller
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $financegrossincome = FinanceGrossIncome::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $financegrossincome = FinanceGrossIncome::paginate($perPage);
            }

            return view('financeGrossIncome.finance-gross-income.index', compact('financegrossincome'));
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('financeGrossIncome.finance-gross-income.create');
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            FinanceGrossIncome::create($requestData);
            return redirect('financeGrossIncome/finance-gross-income')->with('flash_message', 'FinanceGrossIncome added!');
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $financegrossincome = FinanceGrossIncome::findOrFail($id);
            return view('financeGrossIncome.finance-gross-income.show', compact('financegrossincome'));
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $financegrossincome = FinanceGrossIncome::findOrFail($id);
            return view('financeGrossIncome.finance-gross-income.edit', compact('financegrossincome'));
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $financegrossincome = FinanceGrossIncome::findOrFail($id);
             $financegrossincome->update($requestData);

             return redirect('financeGrossIncome/finance-gross-income')->with('flash_message', 'FinanceGrossIncome updated!');
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
        $model = str_slug('financegrossincome','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FinanceGrossIncome::destroy($id);

            return redirect('financeGrossIncome/finance-gross-income')->with('flash_message', 'FinanceGrossIncome deleted!');
        }
        return response(view('403'), 403);

    }
}
