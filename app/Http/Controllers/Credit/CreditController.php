<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Credit;
use App\Lead;
use App\Notification;
use App\YearEstimation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreditController extends Controller
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
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $credit = Credit::where('lead_id', 'LIKE', "%$keyword%")
                    ->orWhere('invoice_id', 'LIKE', "%$keyword%")
                    ->orWhere('amount', 'LIKE', "%$keyword%")
                    ->orWhere('date', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
            } else {
                $credit = Credit::paginate($perPage);
            }

            return view('credit.credit.index', compact('credit'));
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
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            if(!empty($lead_id)){
                $leadExist = lead::findorfail($lead_id);
                return view('credit.credit.create', compact('leadExist', 'yearEstimation'));
            }
            return view('credit.credit.create', compact('leads', 'yearEstimation'));
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
        extract($request->all());
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $credit = Credit::create($requestData);
            Notification::create([
                'lead_id' => $lead_id,
                'model' => "Credit Created",
                'title' => "Credit created against the lead {$credit->getLead->title} of amount {$amount} by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
                return back()->with('flash_message', 'Credit added!');
//            return redirect('credit/credit')->with('flash_message', 'Credit added!');
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
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $credit = Credit::findOrFail($id);
            return view('credit.credit.show', compact('credit'));
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
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $credit = Credit::findOrFail($id);
            return view('credit.credit.edit', compact('credit'));
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
        extract($request->all());
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $credit = Credit::findOrFail($id);
            $credit->update($requestData);
            Notification::create([
                'lead_id' => $credit->lead_id,
                'model' => "Credit Updated",
                'title' => "Credit updated against the lead {$credit->getLead->title} of amount {$amount} by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return back()->with('flash_message', 'Credit updated!');
//            return redirect('credit/credit')->with('flash_message', 'Credit updated!');
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
        $model = str_slug('credit','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Credit::destroy($id);

            return redirect('credit/credit')->with('flash_message', 'Credit deleted!');
        }
        return response(view('403'), 403);

    }
    public function showCreditModal(Request $request){
        $credit = Credit::find($request->id);
        return (string)view('credit.credit.view_credit_modal', compact('credit'));
    }
    public function editCreditModal(Request $request){
        $credit = Credit::find($request->id);
        $leads = Lead::find($credit->lead_id);
        return (string)view('credit.credit.edit_credit_modal', compact('credit', 'leads'));
    }
    public function deleteCredit(Request $request)
    {
        $credit = Credit::find($request->credit_id);
        if ($credit) {
            $credit->delete();
            Notification::create([
                'lead_id' => $credit->lead_id,
                'model' => "Credit Deleted",
                'title' => "Credit deleted against the lead {$credit->getLead->title} of amount {$credit->amount} by",
                'icon' => "fa-solid fa-trash",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

}
