<?php

namespace App\Http\Controllers\SubContractorInsuranceInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SubContractorInsuranceInfo;
use Illuminate\Http\Request;

class SubContractorInsuranceInfoController extends Controller
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorinsuranceinfo = SubContractorInsuranceInfo::where('worker_compensation_insurance_company_info', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_contact_name', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_phone', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_email', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_insurance_carrier', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_policy_eff', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_policy_exp', 'LIKE', "%$keyword%")
                ->orWhere('workers_compensation_attachment', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_insurance_company_info', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_contact_name', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_phone', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_email', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_insurance_carrier', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_policy_eff', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_policy_exp', 'LIKE', "%$keyword%")
                ->orWhere('general_liability_attachment', 'LIKE', "%$keyword%")
                ->orWhere('auto_insurance_company_info', 'LIKE', "%$keyword%")
                ->orWhere('auto_contact_name', 'LIKE', "%$keyword%")
                ->orWhere('auto_phone', 'LIKE', "%$keyword%")
                ->orWhere('auto_email', 'LIKE', "%$keyword%")
                ->orWhere('auto_insurance_carrier', 'LIKE', "%$keyword%")
                ->orWhere('auto_policy_eff', 'LIKE', "%$keyword%")
                ->orWhere('auto_policy_exp', 'LIKE', "%$keyword%")
                ->orWhere('auto_attachment', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorinsuranceinfo = SubContractorInsuranceInfo::paginate($perPage);
            }

            return view('subContractorInsuranceInfo.sub-contractor-insurance-info.index', compact('subcontractorinsuranceinfo'));
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorInsuranceInfo.sub-contractor-insurance-info.create');
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SubContractorInsuranceInfo::create($requestData);
            return redirect('subContractorInsuranceInfo/sub-contractor-insurance-info')->with('flash_message', 'SubContractorInsuranceInfo added!');
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorinsuranceinfo = SubContractorInsuranceInfo::findOrFail($id);
            return view('subContractorInsuranceInfo.sub-contractor-insurance-info.show', compact('subcontractorinsuranceinfo'));
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorinsuranceinfo = SubContractorInsuranceInfo::findOrFail($id);
            return view('subContractorInsuranceInfo.sub-contractor-insurance-info.edit', compact('subcontractorinsuranceinfo'));
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorinsuranceinfo = SubContractorInsuranceInfo::findOrFail($id);
             $subcontractorinsuranceinfo->update($requestData);

             return redirect('subContractorInsuranceInfo/sub-contractor-insurance-info')->with('flash_message', 'SubContractorInsuranceInfo updated!');
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
        $model = str_slug('subcontractorinsuranceinfo','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorInsuranceInfo::destroy($id);

            return redirect('subContractorInsuranceInfo/sub-contractor-insurance-info')->with('flash_message', 'SubContractorInsuranceInfo deleted!');
        }
        return response(view('403'), 403);

    }
}
