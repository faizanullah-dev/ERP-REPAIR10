<?php

namespace App\Http\Controllers\CustomerType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customertype = CustomerType::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customertype = CustomerType::paginate($perPage);
            }

            return view('customerType.customer-type.index', compact('customertype'));
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customerType.customer-type.create');
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required'
		]);
            $requestData = $request->all();
            
            CustomerType::create($requestData);
            return redirect('customerType/customer-type')->with('flash_message', 'CustomerType added!');
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customertype = CustomerType::findOrFail($id);
            return view('customerType.customer-type.show', compact('customertype'));
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customertype = CustomerType::findOrFail($id);
            return view('customerType.customer-type.edit', compact('customertype'));
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required'
		]);
            $requestData = $request->all();
            
            $customertype = CustomerType::findOrFail($id);
             $customertype->update($requestData);

             return redirect('customerType/customer-type')->with('flash_message', 'CustomerType updated!');
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
        $model = str_slug('customertype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            CustomerType::destroy($id);

            return redirect('customerType/customer-type')->with('flash_message', 'CustomerType deleted!');
        }
        return response(view('403'), 403);

    }
}
