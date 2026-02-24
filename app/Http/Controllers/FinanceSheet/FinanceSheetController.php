<?php

namespace App\Http\Controllers\FinanceSheet;

use App\FinanceCog;
use App\FinanceGrossExpense;
use App\FinanceGrossIncome;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FinanceSheet;
use Illuminate\Http\Request;

class FinanceSheetController extends Controller
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $financesheet = FinanceSheet::where('name', 'LIKE', "%$keyword%")
                ->orWhere('value', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $financesheet = FinanceSheet::paginate($perPage);
            }

            return view('financeSheet.finance-sheet.index', compact('financesheet'));
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('financeSheet.finance-sheet.create');
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $finance_sheet = FinanceSheet::updateOrCreate([
                'year_estimation_id' => $year_estimation_id,
            ], [
                'total_gross_income' => $total_gross_income ??"0.00",
                'total_cogs' => $total_cogs ??"0.00",
                'total_gross_marging' => $total_gross_marging ??"0.00",
                'total_oh_expense' => $total_oh_expense ??"0.00",
            ]);
            FinanceGrossIncome::where('finance_sheet_id', $finance_sheet->id)->delete();
            foreach ($grossIncome as $income) {
                FinanceGrossIncome::updateOrCreate([
                    'finance_sheet_id' => $finance_sheet->id,
                    'name' => $income['name'] ?? null,
                ],  [
                    'value' => $income['value'] ?? 0.00,
                ]);
            }
            FinanceCog::where('finance_sheet_id', $finance_sheet->id)->delete();
            foreach ($grossCogs as $cogs) {
                FinanceCog::updateOrCreate([
                    'finance_sheet_id' => $finance_sheet->id,
                    'name' => $cogs['name'] ?? null,
                ], [
                    'value' => $cogs['value'] ?? '0.00',
                ]);
            }
            FinanceGrossExpense::updateOrCreate([
                'finance_sheet_id' => $finance_sheet->id,
            ],
                [
                'payroll' => $payroll ?? null,
                'owner_pay' => $owner_pay ?? null,
                'merchant_fee' => $merchant_fee ?? null,
                'employee_training' => $employee_training ?? null,
                'advertising_marketing' =>$advertising_marketing ?? null,
                'bank_charges' => $bank_charges ?? null,
                'dues_subscription' => $dues_subscription ?? null,
                'insurance' => $insurance ?? null,
                'legal' => $legal ?? null,
                'office_computer' => $office_computer ?? null,
                'rent_lease' => $rent_lease ?? null,
                'taxes' => $taxes ?? null,
                'travel' => $travel ?? null,
                'utilities' => $utilities ?? null,
                'vehicle' => $vehicle ?? null,
                'clipper' => $clipper ?? null,
                'advance_magazine' => $advance_magazine ?? null,
                'google_adds' => $google_adds ?? null,
                'social_media' => $social_media ?? null,
                'total_advertising_marketing' => $total_advertising_marketing ?? null,
            ]);
            return back()->with('flash_message', 'FinanceSheet added!');
//            return redirect('financeSheet/finance-sheet')->with('flash_message', 'FinanceSheet added!');
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $financesheet = FinanceSheet::findOrFail($id);
            return view('financeSheet.finance-sheet.show', compact('financesheet'));
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $financesheet = FinanceSheet::findOrFail($id);
            return view('financeSheet.finance-sheet.edit', compact('financesheet'));
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $financesheet = FinanceSheet::findOrFail($id);
             $financesheet->update($requestData);

             return redirect('financeSheet/finance-sheet')->with('flash_message', 'FinanceSheet updated!');
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
        $model = str_slug('financesheet','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            FinanceSheet::destroy($id);

            return redirect('financeSheet/finance-sheet')->with('flash_message', 'FinanceSheet deleted!');
        }
        return response(view('403'), 403);

    }
}
