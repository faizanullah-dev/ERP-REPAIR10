<?php

namespace App\Http\Controllers\SubContractorRecurringEmail;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SubContractorRecurringEmail;
use Illuminate\Http\Request;

class SubContractorRecurringEmailController extends Controller
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $subcontractorrecurringemail = SubContractorRecurringEmail::where('email_template_id', 'LIKE', "%$keyword%")
                ->orWhere('subcontractor_id', 'LIKE', "%$keyword%")
                ->orWhere('insurance_type', 'LIKE', "%$keyword%")
                ->orWhere('no_of_days_before', 'LIKE', "%$keyword%")
                ->orWhere('same_agency', 'LIKE', "%$keyword%")
                ->orWhere('policy_expiry_date', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $subcontractorrecurringemail = SubContractorRecurringEmail::paginate($perPage);
            }

            return view('subContractorRecurringEmail.sub-contractor-recurring-email.index', compact('subcontractorrecurringemail'));
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('subContractorRecurringEmail.sub-contractor-recurring-email.create');
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
//        return $request->all();
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
//            $requestData = $request->all();
//            $schedules = $request->input('schedule');
//            foreach ($schedules as $schedule) {
//                SubContractorRecurringEmail::create([
//                'email_template_id' => $schedule['email_template'],
//                'subcontractor_id' => $request->subcontractor_id,
//                'insurance_type' => $request->insurance_type,
//                'no_of_days_before' => $schedule['days_before'],
//                'same_agency' => '0',
//                'policy_expiry_date' => $request->expiry_date,
//                ]);
//            }
            $schedules = $request->input('schedule');
            $existingIds = [];

            foreach ($schedules as $schedule) {
                $data = [
                    'email_template_id' => $schedule['email_template'],
                    'subcontractor_id' => $request->subcontractor_id,
                    'insurance_type' => $request->insurance_type,
                    'no_of_days_before' => $schedule['days_before'],
                    'policy_expiry_date' => $request->expiry_date,
                ];

                if (!empty($schedule['id'])) {
                    SubContractorRecurringEmail::where('id', $schedule['id'])->update($data);
                    $existingIds[] = $schedule['id'];
                } else {
                    $newRecord = SubContractorRecurringEmail::create($data);
                    $existingIds[] = $newRecord->id;
                }
            }

            SubContractorRecurringEmail::where('subcontractor_id', $request->subcontractor_id)
                ->where('insurance_type', $request->insurance_type)
                ->whereNotIn('id', $existingIds)
                ->delete();
            return redirect()->back()->with('flash_message', 'Recurring Email Scheduled!');
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $subcontractorrecurringemail = SubContractorRecurringEmail::findOrFail($id);
            return view('subContractorRecurringEmail.sub-contractor-recurring-email.show', compact('subcontractorrecurringemail'));
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $subcontractorrecurringemail = SubContractorRecurringEmail::findOrFail($id);
            return view('subContractorRecurringEmail.sub-contractor-recurring-email.edit', compact('subcontractorrecurringemail'));
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $subcontractorrecurringemail = SubContractorRecurringEmail::findOrFail($id);
             $subcontractorrecurringemail->update($requestData);

             return redirect('subContractorRecurringEmail/sub-contractor-recurring-email')->with('flash_message', 'SubContractorRecurringEmail updated!');
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
        $model = str_slug('subcontractorrecurringemail','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SubContractorRecurringEmail::destroy($id);

            return redirect('subContractorRecurringEmail/sub-contractor-recurring-email')->with('flash_message', 'SubContractorRecurringEmail deleted!');
        }
        return response(view('403'), 403);

    }
}
