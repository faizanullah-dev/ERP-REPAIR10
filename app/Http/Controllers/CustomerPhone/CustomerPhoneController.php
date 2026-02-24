<?php

namespace App\Http\Controllers\CustomerPhone;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CustomerPhone;
use Illuminate\Http\Request;

class CustomerPhoneController extends Controller
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customerphone = CustomerPhone::where('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('phone_type_id', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('extension', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customerphone = CustomerPhone::paginate($perPage);
            }

            return view('customerPhone.customer-phone.index', compact('customerphone'));
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customerPhone.customer-phone.create');
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'customer_id' => 'required',
			'phone_type_id' => 'required',
			'phone' => 'required'
		]);
            $requestData = $request->all();
            
            CustomerPhone::create($requestData);
            return redirect('customerPhone/customer-phone')->with('flash_message', 'CustomerPhone added!');
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customerphone = CustomerPhone::findOrFail($id);
            return view('customerPhone.customer-phone.show', compact('customerphone'));
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customerphone = CustomerPhone::findOrFail($id);
            return view('customerPhone.customer-phone.edit', compact('customerphone'));
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'customer_id' => 'required',
			'phone_type_id' => 'required',
			'phone' => 'required'
		]);
            $requestData = $request->all();
            
            $customerphone = CustomerPhone::findOrFail($id);
             $customerphone->update($requestData);

             return redirect('customerPhone/customer-phone')->with('flash_message', 'CustomerPhone updated!');
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
        $model = str_slug('customerphone','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomerPhone::destroy($id);

            return redirect('customerPhone/customer-phone')->with('flash_message', 'CustomerPhone deleted!');
        }
        return response(view('403'), 403);

    }
}
