<?php

namespace App\Http\Controllers\SubContractorCompanyDetail;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SubContractorCompanyDetail;
use Illuminate\Http\Request;

class SubContractorCompanyDetailController extends Controller
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorcompanydetail = SubContractorCompanyDetail::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('state', 'LIKE', "%$keyword%")
                ->orWhere('zip_code', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('corporation', 'LIKE', "%$keyword%")
                ->orWhere('trades', 'LIKE', "%$keyword%")
                ->orWhere('website', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorcompanydetail = SubContractorCompanyDetail::paginate($perPage);
            }

            return view('subContractorCompanyDetail.sub-contractor-company-detail.index', compact('subcontractorcompanydetail'));
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorCompanyDetail.sub-contractor-company-detail.create');
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SubContractorCompanyDetail::create($requestData);
            return redirect('subContractorCompanyDetail/sub-contractor-company-detail')->with('flash_message', 'SubContractorCompanyDetail added!');
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorcompanydetail = SubContractorCompanyDetail::findOrFail($id);
            return view('subContractorCompanyDetail.sub-contractor-company-detail.show', compact('subcontractorcompanydetail'));
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorcompanydetail = SubContractorCompanyDetail::findOrFail($id);
            return view('subContractorCompanyDetail.sub-contractor-company-detail.edit', compact('subcontractorcompanydetail'));
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorcompanydetail = SubContractorCompanyDetail::findOrFail($id);
             $subcontractorcompanydetail->update($requestData);

             return redirect('subContractorCompanyDetail/sub-contractor-company-detail')->with('flash_message', 'SubContractorCompanyDetail updated!');
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
        $model = str_slug('subcontractorcompanydetail','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorCompanyDetail::destroy($id);

            return redirect('subContractorCompanyDetail/sub-contractor-company-detail')->with('flash_message', 'SubContractorCompanyDetail deleted!');
        }
        return response(view('403'), 403);

    }
}
