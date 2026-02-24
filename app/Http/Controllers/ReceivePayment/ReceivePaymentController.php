<?php

namespace App\Http\Controllers\ReceivePayment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Invoice;
use App\Lead;
use App\Notification;
use App\PaymentType;
use App\ReceivePayment;
use App\YearEstimation;
use Illuminate\Http\Request;

class ReceivePaymentController extends Controller
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
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
//            return ReceivePayment::get();
            if (!empty($keyword)) {
                $receivepayment = ReceivePayment::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('payment_type', 'LIKE', "%$keyword%")
                ->orWhere('Reference_number', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
               $receivepayment = ReceivePayment::paginate($perPage);
            }

            return view('receivePayment.receive-payment.index', compact('receivepayment'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request){
      extract($request->all());
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $yearEstimation  = YearEstimation::where('status',1)->first();
            $paymenttypes = PaymentType::where('status', '1')->get();
            if (!empty($lead_id)){
                $leadExist = Lead::findorfail($lead_id);
                return view('receivePayment.receive-payment.create',compact( 'leads', 'paymenttypes','leadExist','yearEstimation'));
            }
            return view('receivePayment.receive-payment.create', compact('leads', 'paymenttypes','yearEstimation'));
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
    public function store(Request $request){
    //    return $request->all();
        $model = str_slug('receivepayment', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $requestData = $request->all();
            $createdById = auth()->id() ?? '';

            if($request->action_type == 'approved'){
                $invoice = Invoice::where('id', $request->invoice_id)->first();
                $invoice->update(['status' => 'approved', 'payment_status' => 'fully_paid']);

                $record = ReceivePayment::where('invoice_id', $request->invoice_id)->latest()->first();
                if($record){
                    $amountToUpdate = $record->remaining_balance;
                }
                else{
                    $amountToUpdate = $request->amount;
                }
                ReceivePayment::create([
                    'lead_id' => $request->lead_id,
                    'payment_type' => $request->payment_type,
                    'reference_number' => '',
                    'date' => $request->date,
                    'amount' => $amountToUpdate,
                    'created_by' => $createdById,
                    'invoice_id' => $request->invoice_id,
                    'remaining_balance' => 0,
                ]);
            }
            else{
            $invoiceIds = is_array($request->invoice_id) ? $request->invoice_id : [$request->invoice_id];
            if (is_array($request->invoice_id)) {
                $amounts = $request->amount; // Assume $request->amount is already an array
            } else {
                $amounts = [$request->amount]; // Wrap single amount in array
            }
            foreach ($invoiceIds as $index => $invoiceId) {
                $amountRequest = $amounts[$index] ?? 0;

                $paymentData = [
                    'payment_type' => $request->payment_type,
                    'reference_number' => $request->reference_number,
                    'date' => $request->date,
                    'invoice_id' => $invoiceId,
                    'amount' => $amountRequest,
                    'created_by' => $createdById,
                    'lead_id' => null // Will be set from invoice
                ];

                $rec_payment = ReceivePayment::where('invoice_id', $invoiceId)->latest()->first();
                $invoice = Invoice::where('id', $invoiceId)->first();
                $paymentData['lead_id'] = $invoice->lead_id;
                if (isset($rec_payment) && $rec_payment->remaining_balance > 0) {
                    $amount = $rec_payment->remaining_balance;
                    if ($amount) {
                        $paymentData['remaining_balance'] = floatval($amount) - floatval($amountRequest);
                    }
                } else {
                    if ($invoice) {
                        $paymentData['remaining_balance'] = floatval($invoice->total_amount) - floatval($amountRequest);
                    }
                }
                $receivePayment = ReceivePayment::create($paymentData);
                if ($paymentData['remaining_balance'] == '0') {
                    $invoice->update(['payment_status' => 'fully_paid']);

                    if ($invoice) {
                        $invoice->update(['status' => 'approved']);
                        Notification::create([
                            'lead_id' => $invoice->lead_id,
                            'model' => 'Invoice Status Update',
                            'title' => 'Invoice associated with the lead <b>' . @$invoice->getLead->title . '</b> of amount <b>$' . $invoice->total_amount . '</b> has been <b>' . ' approved' . '</b> by',
                            'icon' => 'fa-solid fa-check-circle',
                            'time' => now(),
                            'user_id' => auth()->user()->id,
                        ]);
                    }
                }

                if (isset($receivePayment) && !empty($receivePayment)) {
                    Notification::create([
                        'lead_id' => $receivePayment->lead_id,
                        'model' => 'Receive Payment Create',
                        'title' => 'A receive payment of an amount <b>' . $receivePayment->amount . '</b> has been created against the lead <b>' . $receivePayment->getLead->title . '</b> by',
                        'icon' => 'fa-solid fa-money-check-dollar',
                        'time' => $receivePayment->created_at,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }
                if ($request->view_lead != '') {
                    return back()->with('flash_message', 'ReceivePayment added!');
                } else {
                    return redirect()->back()->with('flash_message', 'ReceivePayment added!');
                }
        
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
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $receivepayment = ReceivePayment::findOrFail($id);
            return view('receivePayment.receive-payment.show', compact('receivepayment'));
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
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $receivepayment = ReceivePayment::findOrFail($id);
            $leads = Lead::get();
            $paymenttypes = PaymentType::get();
            if (!empty($lead_id)){
                $leadExist = Lead::findorfail($lead_id);
                return view('receivePayment.receive-payment.create',compact( 'leads', 'paymenttypes','leadExist'));
            }
            return view('receivePayment.receive-payment.edit', compact('receivepayment', 'leads', 'paymenttypes'));
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
    public function update(Request $request, $id){
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
             $requestData = $request->all();
             $receivepayment = ReceivePayment::findOrFail($id);
             $receivepayment->update($requestData);
                if (isset($receivepayment) && !empty($receivepayment)) {
                    Notification::create([
                        'lead_id' => $receivepayment->lead_id,
                        'model'   => 'Receive Payment Update',
                        'title' => 'A receive payment against the lead <b>' . $receivepayment->getLead->title . '</b> has been updated to a new amount of <b>' .$ $request->amount . '</b>',
                        'icon' => 'fa-solid fa-money-check-dollar',
                        'time'    => $receivepayment->created_at,
                        'user_id' => auth()->user()->id,
                    ]);
                }//ends if.
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'ReceivePayment updated!');
            }else{
                return redirect('receivePayment/receive-payment')->with('flash_message', 'ReceivePayment updated!');
            }
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
        $model = str_slug('receivepayment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ReceivePayment::destroy($id);

            return redirect('receivePayment/receive-payment')->with('flash_message', 'ReceivePayment deleted!');
        }
        return response(view('403'), 403);
    }

    public function getInvoiceAmount(Request $request){
        $amount = ReceivePayment::where('invoice_id', $request->id)->latest()->first();
        if($amount){
            return response()->json($amount->remaining_balance??0);
        }
        else{
            $amount = Invoice::where('id', $request->id)->first();
            return response()->json($amount->total_amount??0);
        }
    }
}
