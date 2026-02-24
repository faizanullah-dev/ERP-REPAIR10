<?php

namespace App\Http\Controllers\SubContractorInvoiceAttachment;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SubContractorInvoiceAttachment;
use Illuminate\Http\Request;

class SubContractorInvoiceAttachmentController extends Controller
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorinvoiceattachment = SubContractorInvoiceAttachment::where('invoice_id', 'LIKE', "%$keyword%")
                ->orWhere('product_name', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('rate', 'LIKE', "%$keyword%")
                ->orWhere('tax', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorinvoiceattachment = SubContractorInvoiceAttachment::paginate($perPage);
            }

            return view('subContractorInvoiceAttachment.sub-contractor-invoice-attachment.index', compact('subcontractorinvoiceattachment'));
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorInvoiceAttachment.sub-contractor-invoice-attachment.create');
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SubContractorInvoiceAttachment::create($requestData);
            return redirect('subContractorInvoiceAttachment/sub-contractor-invoice-attachment')->with('flash_message', 'SubContractorInvoiceAttachment added!');
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorinvoiceattachment = SubContractorInvoiceAttachment::findOrFail($id);
            return view('subContractorInvoiceAttachment.sub-contractor-invoice-attachment.show', compact('subcontractorinvoiceattachment'));
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorinvoiceattachment = SubContractorInvoiceAttachment::findOrFail($id);
            return view('subContractorInvoiceAttachment.sub-contractor-invoice-attachment.edit', compact('subcontractorinvoiceattachment'));
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorinvoiceattachment = SubContractorInvoiceAttachment::findOrFail($id);
             $subcontractorinvoiceattachment->update($requestData);

             return redirect('subContractorInvoiceAttachment/sub-contractor-invoice-attachment')->with('flash_message', 'SubContractorInvoiceAttachment updated!');
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
        $model = str_slug('subcontractorinvoiceattachment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorInvoiceAttachment::destroy($id);

            return redirect('subContractorInvoiceAttachment/sub-contractor-invoice-attachment')->with('flash_message', 'SubContractorInvoiceAttachment deleted!');
        }
        return response(view('403'), 403);

    }
}
