<?php

namespace App\Http\Controllers\PaymentType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $paymenttype = PaymentType::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $paymenttype = PaymentType::paginate($perPage);
            }

            return view('paymentType.payment-type.index', compact('paymenttype'));
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('paymentType.payment-type.create');
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            PaymentType::create($requestData);
            return redirect('paymentType/payment-type')->with('flash_message', 'PaymentType added!');
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $paymenttype = PaymentType::findOrFail($id);
            return view('paymentType.payment-type.show', compact('paymenttype'));
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $paymenttype = PaymentType::findOrFail($id);
            return view('paymentType.payment-type.edit', compact('paymenttype'));
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
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $paymenttype = PaymentType::findOrFail($id);
             $paymenttype->update($requestData);

             return redirect('paymentType/payment-type')->with('flash_message', 'PaymentType updated!');
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
    public function destroy($id) {
        $model = str_slug('paymenttype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PaymentType::destroy($id);

            return redirect('paymentType/payment-type')->with('flash_message', 'PaymentType deleted!');
        }
        return response(view('403'), 403);
    }

    public function editPaymentTypeModal(Request  $request, $id = null){
        extract($request->all());
        $paymenttype = PaymentType::findOrFail($id);
        return view('paymentType.payment-type.edit_payment_type_modal', compact('paymenttype'));
    }

    public function viewPaymentTypeModal(Request $request){
        extract($request->all());
        $paymenttype = PaymentType::findOrFail($id);
        return (string) view('paymentType.payment-type.ajax.view_payment_type_modal', compact('paymenttype'));
    }
}
