<?php

namespace App\Http\Controllers\SubContractorInvoice;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\SchedulingTask;
use App\SubContractorInvoice;
use App\SubContractorInvoiceAttachment;
use Illuminate\Http\Request;

class SubContractorInvoiceController extends Controller
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorinvoice = SubContractorInvoice::where('invoice_unique_id', 'LIKE', "%$keyword%")
                ->orWhere('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('job_id', 'LIKE', "%$keyword%")
                ->orWhere('subcontractor_id', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('sub_total', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('payment_status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorinvoice = SubContractorInvoice::paginate($perPage);
            }

            return view('subContractorInvoice.sub-contractor-invoice.index', compact('subcontractorinvoice'));
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorInvoice.sub-contractor-invoice.create');
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            $invoiceId = $request->job_id . now()->second;
            $invoice = SubContractorInvoice::create([
                'subcontractor_id' => $request->subcontractor_id,
                'bill_from' => $request->bill_from,
                'address' => $request->address,
                'sub_total' => $request->sub_total,
                'tax' => $request->tax_total,
                'total' => $request->total_amount,
                'bill_to' => $request->bill_to,
                'lead_id' => $request->lead_id,
                'job_id' => $request->job_id,
                'status' => 'pending',
                'created_by' => auth()->user()->id
            ]);
            $invoice->update(['invoice_unique_id' => $invoiceId .'-'.$invoice->id]);
            $products = $request->products;
            $quantities = $request->quantities;
            $unitPrices = $request->unit_prices;
            $amounts = $request->amounts;
            $tax = $request->row_taxes;
            foreach ($products as $key => $product) {
                SubContractorInvoiceAttachment::create([
                    'invoice_id' => $invoice->id,
                    'product_name' => $product,
                    'quantity' => $quantities[$key],
                    'rate' => $unitPrices[$key],
                    'tax' => $tax[$key],
                    'total' => $amounts[$key],
                ]);
            }
            return redirect()->back()->with('flash_message', 'SubContractorInvoice added!');
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorinvoice = SubContractorInvoice::findOrFail($id);
            return view('subContractorInvoice.sub-contractor-invoice.show', compact('subcontractorinvoice'));
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorinvoice = SubContractorInvoice::findOrFail($id);
            return view('subContractorInvoice.sub-contractor-invoice.edit', compact('subcontractorinvoice'));
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorinvoice = SubContractorInvoice::findOrFail($id);
             $subcontractorinvoice->update($requestData);

             return redirect('subContractorInvoice/sub-contractor-invoice')->with('flash_message', 'SubContractorInvoice updated!');
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
        $model = str_slug('subcontractorinvoice','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorInvoice::destroy($id);

            return redirect('subContractorInvoice/sub-contractor-invoice')->with('flash_message', 'SubContractorInvoice deleted!');
        }
        return response(view('403'), 403);

    }

    public function getLeadJobs(Request $request){
        $task = SchedulingTask::where('lead_id', $request->lead_id)->where('subcontractor_id', $request->subcontractor_id)->get();
        $lead = Lead::where('id', $request->lead_id)->first();
        return response()->json(['task' => $task, 'lead' => $lead]);
    }

    public function getSubcontractorInvoice(Request $request){
        $invoice = SubContractorInvoice::where('id', $request->id)->first();
        return (string) view('subContractorInvoice.sub-contractor-invoice.ajax.invoice',compact('invoice'));
    }
}
