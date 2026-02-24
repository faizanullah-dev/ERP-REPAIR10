<?php

namespace App\Http\Controllers\CustomerReferral;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerReferral;
use Illuminate\Http\Request;

class CustomerReferralController extends Controller
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customerreferral = CustomerReferral::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customerreferral = CustomerReferral::paginate($perPage);
            }

            return view('customerReferral.customer-referral.index', compact('customerreferral'));
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customerReferral.customer-referral.create');
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            CustomerReferral::create($requestData);
            return redirect()->back()->with('flash_message', 'Customer Referral added!');
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customerreferral = CustomerReferral::findOrFail($id);
            return view('customerReferral.customer-referral.show', compact('customerreferral'));
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customerreferral = CustomerReferral::findOrFail($id);
            return view('customerReferral.customer-referral.edit', compact('customerreferral'));
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $customerreferral = CustomerReferral::findOrFail($id);
             $customerreferral->update($requestData);

             return redirect('customerReferral/customer-referral')->with('flash_message', 'CustomerReferral updated!');
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
        $model = str_slug('customerreferral','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomerReferral::destroy($id);

            return redirect('customerReferral/customer-referral')->with('flash_message', 'CustomerReferral deleted!');
        }
        return response(view('403'), 403);

    }
}
