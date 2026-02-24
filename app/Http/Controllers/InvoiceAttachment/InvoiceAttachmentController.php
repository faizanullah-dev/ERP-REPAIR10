<?php

namespace App\Http\Controllers\InvoiceAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\InvoiceAttachment;
use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $invoiceattachment = InvoiceAttachment::where('invoice_id', 'LIKE', "%$keyword%")
                ->orWhere('activity_name', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('rate', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $invoiceattachment = InvoiceAttachment::paginate($perPage);
            }

            return view('invoiceAttachment.invoice-attachment.index', compact('invoiceattachment'));
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('invoiceAttachment.invoice-attachment.create');
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            InvoiceAttachment::create($requestData);
            return redirect('invoiceAttachment/invoice-attachment')->with('flash_message', 'InvoiceAttachment added!');
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $invoiceattachment = InvoiceAttachment::findOrFail($id);
            return view('invoiceAttachment.invoice-attachment.show', compact('invoiceattachment'));
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $invoiceattachment = InvoiceAttachment::findOrFail($id);
            return view('invoiceAttachment.invoice-attachment.edit', compact('invoiceattachment'));
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $invoiceattachment = InvoiceAttachment::findOrFail($id);
             $invoiceattachment->update($requestData);

             return redirect('invoiceAttachment/invoice-attachment')->with('flash_message', 'InvoiceAttachment updated!');
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
        $model = str_slug('invoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            InvoiceAttachment::destroy($id);

            return redirect('invoiceAttachment/invoice-attachment')->with('flash_message', 'InvoiceAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
