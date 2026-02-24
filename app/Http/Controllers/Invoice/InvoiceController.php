<?php

namespace App\Http\Controllers\Invoice;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Invoice;
use App\InvoiceAttachment;
use App\Lead;
use App\Notification;
use App\ReceivePayment;
use App\YearEstimation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $invoice = Invoice::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('due_date', 'LIKE', "%$keyword%")
                ->orWhere('total_amount', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->orWhere('sub_total', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $invoice = Invoice::paginate($perPage);
            }
            return view('invoice.invoice.index', compact('invoice'));
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
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $categories = Category::wherestatus(1)->get();
            $yearEstimation = YearEstimation::wherestatus(1)->first();
            if(!empty($lead_id)){
                $leadExist=Lead::findOrfail($lead_id);
                return view('invoice.invoice.create',compact('leads','categories','leadExist', 'yearEstimation'));
            }
            return view('invoice.invoice.create', compact('leads','categories', 'yearEstimation'));
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
//        return $request->all();
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
//            return $request->all();
            extract($request->all());
            $invoice = Invoice::create([
                'lead_id' => $lead_id??"",
                'customer_id' => $customer_id??"",
                'address' => $address??"",
                'due_date' => $due_date??"",
                'total_amount' => $total_amount,
                'description' => $description??"",
                'total_tax' => $total_tax??"",
                'sub_total' => $sub_total??"",
                'invoice_unique_id' => $invoice_unique_id??"",
                'created_by' => auth()->id() ?? '',
                'status'=> 'pending',
            ]);
            if (!empty($activity_name)){
                foreach ($activity_name as $key => $value){
                    InvoiceAttachment::create([
                        'invoice_id' => $invoice->id,
                        'activity_name'     => isset($activity_name[$key]) ? $activity_name[$key] : null,
                        'category_id'       => isset($category_id[$key]) ? $category_id[$key] : null,
                        'quantity'          => isset($quantity[$key]) ? $quantity[$key] : null,
                        'rate'              => isset($rate[$key]) ? $rate[$key] : null,
                        'tax'              => isset($tax[$key]) ? $tax[$key] : null,
                        'amount'            => isset($amount[$key]) ? $amount[$key] : null,
                    ]);
                }
            }//endif
            Notification::create([
                'lead_id' => $lead_id,
                'model' => 'Invoice Created',
                'title' => 'Invoice has been created for the lead <b>' . @$invoice->getLead->title . '</b> of amount <b>$' . $invoice->total_amount . '</b> by',
                'time' => $invoice->created_at,
                'icon'    => 'fa-regular fa-square-plus',
                'user_id' => auth()->user()->id,
            ]);
            return redirect()->back()->with('flash_message', 'Invoice added!');
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
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $invoice = Invoice::findOrFail($id);
            $invoiceattachments = InvoiceAttachment::where('invoice_id', $id)->get();
            return view('invoice.invoice.show', compact('invoice', 'invoiceattachments'));
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
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $invoice = Invoice::findOrFail($id);
            $leads = Lead::get();
            $categories = Category::get();
            $leadExist = [];
            return view('invoice.invoice.edit', compact('invoice', 'leads', 'categories', 'leadExist'));
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
//        return $request->all();
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            extract($request->all());
            $invoice  = Invoice::find($id);
            $invoice->update([
                'lead_id' => $lead_id??"",
                'customer_id' => $customer_id??"",
                'address' => $address??"",
                'due_date' => $due_date??"",
                'total_amount' => $total_amount??"",
                'description' => $description??"",
                'total_tax' => $total_tax??"",
                'sub_total' => $sub_total??"",
            ]);
            if (!empty($requestData['activity_name'])) {
                InvoiceAttachment::where('invoice_id', $id)->delete();
                foreach ($requestData['activity_name'] as $key => $value) {
                    InvoiceAttachment::where('invoice_id', $id)->where('activity_name', $activity_name)->where('category_id', $id)->where('quantity', $quantity)->where('rate', $rate)->where('amount', $amount)->updateOrCreate([
                        'invoice_id' => $id,
                        'activity_name'     => isset($activity_name[$key]) ? $activity_name[$key] : null,
                        'category_id'       => isset($category_id[$key]) ? $category_id[$key] : null,
                        'quantity'          => isset($quantity[$key]) ? $quantity[$key] : null,
                        'rate'              => isset($rate[$key]) ? $rate[$key] : null,
                        'tax'              => isset($tax[$key]) ? $tax[$key] : null,
                        'amount'            => isset($amount[$key]) ? $amount[$key] : null,
                    ]);
                }
            }
            Notification::create([
                'lead_id' => $lead_id,
                'model' => 'Invoice Updated',
                'title' => 'Invoice has been updated for the lead <b>' . @$invoice->getLead->title . '</b> of amount <b>$' . $invoice->total_amount . '</b> by',
                'time' => $invoice->created_at,
                'icon'    => 'fa-regular fa-square-plus',
                'user_id' => auth()->user()->id,
            ]);
            if($id){
                return back()->with('flash_message', 'Invoice updated!');
            }
             return redirect('invoice/invoice')->with('flash_message', 'Invoice updated!');
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
        $model = str_slug('invoice','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Invoice::destroy($id);

            return redirect('invoice/invoice')->with('flash_message', 'Invoice deleted!');
        }
        return response(view('403'), 403);

    }
    public function deleteInvoice(Request $request)
    {
        $invoice_id = $request->invoice_id;

        // Find the invoice
        $invoice = Invoice::find($invoice_id);
        if (!$invoice) {
            return response()->json(['status' => false, 'message' => 'Invoice not found']);
        }

        // Retrieve necessary details
        $leadID = $invoice->lead_id ?? null;
        $invoiceTitle = $invoice->name ?? null;

        // Check and delete associated receive payments
        $receivePayment = ReceivePayment::where('invoice_id', $invoice_id);
        if ($receivePayment->exists()) {
            $receivePaymentDetails = $receivePayment->first();
            $receivePayment->delete();

            // Notification for receive payment deletion
            Notification::create([
                'lead_id' => $leadID,
                'model'   => 'Receive Payment Deleted',
                'title'   => 'Receive Payment of amount <b>$' . $receivePaymentDetails->amount . '</b> has been deleted for the lead <b>' . @$receivePaymentDetails->getLead->title . '</b>',
                'time'    => now(),
                'icon'    => 'fa-solid fa-trash',
                'user_id' => auth()->user()->id,
            ]);
        }

        // Delete the invoice
        if ($invoice->delete()) {
            // Notification for invoice deletion
            Notification::create([
                'lead_id' => $leadID,
                'model'   => 'Invoice Deleted',
                'title'   => 'Invoice <b>' . $invoiceTitle . '</b> of amount <b>$' . $invoice->total_amount . '</b> has been deleted for the lead <b>' . @$invoice->getLead->title . '</b>',
                'time'    => now(),
                'icon'    => 'fa-solid fa-trash',
                'user_id' => auth()->user()->id,
            ]);

            return response()->json(['status' => true, 'message' => 'Invoice Deleted Successfully']);
        }

        // If invoice deletion fails
        return response()->json(['status' => false, 'message' => 'Failed to delete the invoice']);
    }
    public function invoiceCumulativeInvoice(Request $request){
        $lead = Lead::find($request->id);
        return (string)view('invoice.invoice.cumulative_invoice_modal', compact('lead'));
    }

}
