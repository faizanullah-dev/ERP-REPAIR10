<?php

namespace App\Http\Controllers\CustomerOwnerType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CustomerOwnerType;
use Illuminate\Http\Request;

class CustomerOwnerTypeController extends Controller
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customerownertype = CustomerOwnerType::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customerownertype = CustomerOwnerType::paginate($perPage);
            }

            return view('customerOwnerType.customer-owner-type.index', compact('customerownertype'));
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customerOwnerType.customer-owner-type.create');
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            CustomerOwnerType::create($requestData);
            return redirect('customerOwnerType/customer-owner-type')->with('flash_message', 'CustomerOwnerType added!');
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customerownertype = CustomerOwnerType::findOrFail($id);
            return view('customerOwnerType.customer-owner-type.show', compact('customerownertype'));
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customerownertype = CustomerOwnerType::findOrFail($id);
            return view('customerOwnerType.customer-owner-type.edit', compact('customerownertype'));
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $customerownertype = CustomerOwnerType::findOrFail($id);
             $customerownertype->update($requestData);

             return redirect('customerOwnerType/customer-owner-type')->with('flash_message', 'CustomerOwnerType updated!');
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
        $model = str_slug('customerownertype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomerOwnerType::destroy($id);

            return redirect('customerOwnerType/customer-owner-type')->with('flash_message', 'CustomerOwnerType deleted!');
        }
        return response(view('403'), 403);

    }

    public function editCustomerOwnerTypeModal(Request  $request, $id = null) {
        extract($request->all());
        $customerownertype = CustomerOwnerType::findOrFail($id);
        return view('customerOwnerType.customer-owner-type.edit_customer_owner_type_modal', compact('customerownertype'));
    }

    public function viewCustomerOwnerTypeModal(Request $request){
        extract($request->all());
        $customerownertype = CustomerOwnerType::findOrFail($id);
        return (string) view('customerOwnerType.customer-owner-type.ajax.view_customer_owner_type_modal', compact('customerownertype'));
    }
}