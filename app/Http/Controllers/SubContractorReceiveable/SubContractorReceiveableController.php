<?php

namespace App\Http\Controllers\SubContractorReceiveable;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Notification;
use App\SubContractorInvoice;
use App\SubContractorReceiveable;
use Illuminate\Http\Request;

class SubContractorReceiveableController extends Controller
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorreceiveable = SubContractorReceiveable::where('invoice_id', 'LIKE', "%$keyword%")
                ->orWhere('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('payment_type', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorreceiveable = SubContractorReceiveable::paginate($perPage);
            }

            return view('subContractorReceiveable.sub-contractor-receiveable.index', compact('subcontractorreceiveable'));
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorReceiveable.sub-contractor-receiveable.create');
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

        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {

            if($request->status == 'approved') {
                SubContractorReceiveable::create([
                    'invoice_id' => $request->invoice_id,
                    'job_id' => $request->job_id,
                    'amount' => $request->amount,
                    'payment_type' => $request->payment_type,
                    'created_by' => auth()->user()->id,
                    'date' => $request->date,
                ]);
            }

            SubContractorInvoice::where('id', $request->invoice_id)->update([
                'status' => $request->status,
                'payment_status' => 'fully_paid'
            ]);
            return redirect()->back()->with('flash_message', 'SubContractorReceiveable added!');
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorreceiveable = SubContractorReceiveable::findOrFail($id);
            return view('subContractorReceiveable.sub-contractor-receiveable.show', compact('subcontractorreceiveable'));
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorreceiveable = SubContractorReceiveable::findOrFail($id);
            return view('subContractorReceiveable.sub-contractor-receiveable.edit', compact('subcontractorreceiveable'));
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorreceiveable = SubContractorReceiveable::findOrFail($id);
             $subcontractorreceiveable->update($requestData);

             return redirect('subContractorReceiveable/sub-contractor-receiveable')->with('flash_message', 'SubContractorReceiveable updated!');
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
        $model = str_slug('subcontractorreceiveable','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorReceiveable::destroy($id);

            return redirect('subContractorReceiveable/sub-contractor-receiveable')->with('flash_message', 'SubContractorReceiveable deleted!');
        }
        return response(view('403'), 403);

    }

    public function createReceive(Request $request){
        $requestData = $request->all();
        $requestData['created_by'] = auth()->id() ?? '';

        foreach($request->invoice_id as $key => $invoice_id) {
            $currentRequest = $requestData;
            $currentRequest['invoice_id'] = $invoice_id;
            $currentRequest['amount'] = $request->amount[$key];

            $rec_payment = SubContractorReceiveable::where('invoice_id', $invoice_id)->latest()->first();
            if(isset($rec_payment) && $rec_payment->remaining_balance > 0){
                $amount = $rec_payment->remaining_balance;
                if ($amount) {
                    $currentRequest['remaining_balance'] = floatval($amount) - floatval($currentRequest['amount']);
                }
            }
            else{
                $invoice = SubContractorInvoice::where('id', $invoice_id)->first();
                if ($invoice) {
                    $currentRequest['remaining_balance'] = floatval($invoice->total) - floatval($currentRequest['amount']);
                }
            }

            $receivePayment = SubContractorReceiveable::create($currentRequest);

            if($currentRequest['remaining_balance'] == '0'){
                $invoice = SubContractorInvoice::where('id', $invoice_id)->first();
                $invoice->update(['payment_status' => 'fully_paid']);

                if ($invoice) {
                    $invoice->update(['status' => 'approved']);
                    Notification::create([
                        'lead_id' => $invoice->lead_id,
                        'model'   => 'Invoice Status Update',
                        'title' => 'Invoice associated with the lead <b>' . @$invoice->getLead->title . '</b> of amount <b>$' . $invoice->total_amount . '</b> has been <b>' . ' approved' . '</b> by',
                        'icon'    => 'fa-solid fa-check-circle',
                        'time'    => now(),
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }

            if (isset($receivePayment) && !empty($receivePayment)) {
                Notification::create([
                    'lead_id' => $receivePayment->lead_id,
                    'model'   => 'Receive Payment Create',
                    'title'   => 'A receive payment of an amount <b>' . $receivePayment->amount . '</b> has been created against the lead <b>' . @$receivePayment->getLead->title . '</b> by',
                    'icon'    => 'fa-solid fa-money-check-dollar',
                    'time'    => $receivePayment->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }
        }

        return redirect()->back()->with('flash_message', 'Receivable Added');
    }

    public function getJobInvoices(Request $request){
        $invoice =  SubContractorInvoice::where('job_id', $request->job_id)->where('status', 'pending')->get();
        return response()->json($invoice);
    }

    public function getJobReceive(Request $request){
        $receive =  SubContractorReceiveable::where('invoice_id', $request->invoice_id)->latest()->first();
        if($receive) {
            return response()->json($receive);
        }
        else{
            $receive = SubContractorInvoice::where('id', $request->invoice_id)->first();
            return response()->json($receive);
        }
    }
}
