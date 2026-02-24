<?php

namespace App\Http\Controllers\Refund;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Notification;
use App\PaymentType;
use App\Refund;
use App\YearEstimation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RefundController extends Controller
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
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $refund = Refund::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('invoice_id', 'LIKE', "%$keyword%")
                ->orWhere('payment_type_id', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $refund = Refund::paginate($perPage);
            }
            return view('refund.refund.index', compact('refund'));
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
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $paymenttypes = PaymentType::get();
            $leads = Lead::get();
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            if(!empty($lead_id)){
                $paymenttypes = PaymentType::whereStatus('1')->get();
                $leadExist = lead::findorfail($lead_id);
                return view('refund.refund.create', compact('leadExist', 'paymenttypes', 'yearEstimation'));
            }
            return view('refund.refund.create', compact( 'paymenttypes', 'leads', 'yearEstimation'));
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
        extract($request->all());
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $requestData = $request->all();
            $refund = Refund::create($requestData);
            Notification::create([
                'lead_id' => $lead_id,
                'model' => "Refund Created",
                'title' => "Refund created against the lead {$refund->getLead->title} of amount {$amount} by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return back()->with('flash_message', 'Refund added!');
//            return redirect('refund/refund')->with('flash_message', 'Refund added!');
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
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $refund = Refund::findOrFail($id);
            return view('refund.refund.show', compact('refund'));
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
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $refund = Refund::findOrFail($id);
            return view('refund.refund.edit', compact('refund'));
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
        extract($request->all());
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestData = $request->all();
            $refund = Refund::findOrFail($id);
            $refund->update($requestData);
            Notification::create([
                'lead_id' => $refund->lead_id,
                'model' => "Refund Updated",
                'title' => "Refund updated against the lead {$refund->getLead->title} of amount {$amount} by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
             return back()->with('flash_message', 'Refund updated!');
//             return redirect('refund/refund')->with('flash_message', 'Refund updated!');
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
        $model = str_slug('refund','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Refund::destroy($id);

            return redirect('refund/refund')->with('flash_message', 'Refund deleted!');
        }
        return response(view('403'), 403);

    }
    public function showRefundModal(Request $request){
        $refund = Refund::find($request->id);
        return (string)view('refund.refund.view_refund_modal', compact('refund'));
    }
    public function editRefundModal(Request $request){
        $refund = Refund::find($request->id);
        $leads = Lead::find($refund->lead_id);
        $paymenttypes = PaymentType::whereStatus('1')->get();
        return (string)view('refund.refund.edit_refund_modal', compact('refund', 'leads', 'paymenttypes'));
    }
    public function deleteRefund(Request $request)
    {
        $refund = Refund::find($request->refund_id);
        if ($refund) {
            $refund->delete();
            Notification::create([
                'lead_id' => $refund->lead_id,
                'model' => "Refund Deleted",
                'title' => "Refund deleted against the lead {$refund->getLead->title} of amount {$refund->amount} by",
                'icon' => "fa-solid fa-trash",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
