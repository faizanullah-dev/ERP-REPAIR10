<?php

namespace App\Http\Controllers\ChangeOrder;

use App\Category;
use App\ChangeOrderAttachment;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Invoice;
use App\InvoiceAttachment;
use App\Notification;
use App\YearEstimation;
use Illuminate\Support\Facades\Storage;
use App\ChangeOrder;
use App\Lead;
use App\User;
use Illuminate\Http\Request;

class ChangeOrderController extends Controller
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
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $changeorder = ChangeOrder::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('user_name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('due_date', 'LIKE', "%$keyword%")
                ->orWhere('activity_name', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('rate', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('total_amount', 'LIKE', "%$keyword%")
                ->orWhere('signature', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $changeorder = ChangeOrder::paginate($perPage);
            }
            return view('changeOrder.change-order.index', compact('changeorder'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status',1)->first();
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $categories = Category::wherestatus(1)->get();
            $adminUser = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['user']);
            })->first();
            if(!empty($lead_id)){
                $leadExist=lead::findorfail($lead_id);
                return view('changeOrder.change-order.create', compact('yearEstimation','leads','categories', 'leadExist'));
            }
            return view('changeOrder.change-order.create', compact('yearEstimation','leads', 'users', 'categories','adminUser'));
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
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $signatureData = $request['signature'] ;
//           if($request->upload_signature) {
                $changeorder = ChangeOrder::create([
                    'lead_id' => $lead_id ?? "",
                    'customer_id' => $customer_id ?? "",
                    'address' => $address ?? "",
                    'due_date' => $due_date ?? "",
                    'total_amount' => $total_amount ?? 0,
                    'description' => $description ?? "",
                    'signature_type' => 'upload_image',
//                    'signature' => 'website/customer_signature/'.$request->upload_signature ?? "",
                    'signature' => $signatureData?? null,
                    'total_tax' => $total_tax ?? "",
                    'sub_total' => $sub_total ?? "",
                    'representative_id' => $representative_id ?? "",
                    'change_order_unique_id' => $change_order_unique_id ?? "",
                    'created_by' => auth()->id() ?? '',

                ]);
//            }elseif ($signatureData){
//                $changeorder = ChangeOrder::create([
//                    'lead_id' => $lead_id ?? "",
//                    'customer_id' => $customer_id ?? "",
//                    'address' => $address ?? "",
//                    'due_date' => $due_date ?? "",
//                    'total_amount' => $total_amount ?? "",
//                    'description' => $description ?? "",
//                    'tax' => $tax ?? "",
//                    'sub_total' => $sub_total ?? "",
//                    'representative_id' => $representative_id ?? "",
//                    'change_order_unique_id' => $change_order_unique_id ?? "",
//                    'signature' => $signatureData ?? "",
//                    'signature_type' => 'e_signature',
//                ]);
//            }
            
            if (!empty($activity_name)){
                foreach ($activity_name as $key => $value){
                    ChangeOrderAttachment::create([
                        'change_order_id' => $changeorder->id,
                        'activity_name'     => isset($activity_name[$key]) ? $activity_name[$key] : null,
                        'category_id'       => isset($category_id[$key]) ? $category_id[$key] : null,
                        'quantity'          => isset($quantity[$key]) ? $quantity[$key] : null,
                        'rate'              => isset($rate[$key]) ? $rate[$key] : null,
                        'amount'            => isset($amount[$key]) ? $amount[$key] : null,
                        'tax'            => isset($tax[$key]) ? $tax[$key] : null,
                    ]);
                }
            }//endif
            $this->storeImage('signatures', $signatureData);
            $invoice_unique_id = rand(100000, 999999);
            $lead = Lead::find($lead_id);
            if (isset($with_invoice) && $with_invoice == 1) {
                $invoice = Invoice::create([
                'lead_id' => $lead_id ?? "",
                'customer_id' => $customer_id ?? "",
                'address' => $address ?? "",
                'due_date' => $due_date ?? "",
                'total_amount' => $total_amount ?? "",
                'description' => $description ?? "",
                'total_tax' => $total_tax ?? "",
                'sub_total' => $sub_total ?? "",
                    'invoice_unique_id' =>
                        (isset($lead->category->name) ? substr($lead->category->name, 0, 1) : '') .
                        (isset($lead->created_at) ? $lead->created_at->format('y') : '') .
                        '-' .
                        (isset($invoice_unique_id) ? $invoice_unique_id : '') .
                        '-' .
                        (isset($lead->customer->customerLeads) ? $lead->customer->customerLeads->count() : '0'),
                    'created_by' => auth()->id() ?? '',
			    'status' => 'pending',
            ]);
                if (!empty($activity_name)){
                    foreach ($activity_name as $key => $value){
                        InvoiceAttachment::create([
                            'invoice_id' => $invoice->id,
                            'activity_name'     => isset($activity_name[$key]) ? $activity_name[$key] : null,
                            'category_id'       => isset($category_id[$key]) ? $category_id[$key] : null,
                            'quantity'          => isset($quantity[$key]) ? $quantity[$key] : null,
                            'rate'              => isset($rate[$key]) ? $rate[$key] : null,
                            'tax'              => isset($tax[$key]) ? $tax[$key] : null,
                            'amount'            => isset($amount[$key]) ? $amount[$key] : null,
                        ]);
                    }
                }//endif
            }
            if (isset($changeorder) && !empty($changeorder)) {
                Notification::create([
                    'lead_id' => $lead_id,
                    'model'   => 'Change Order Create',
                    'title' => 'Change order has been created for the lead <b>' . @$changeorder->getLead->title . '</b> of amount <b>$' . $changeorder->total_amount . '</b> by',
                    'time' => $changeorder->created_at,
                    'icon'    => 'fa-regular fa-square-plus',
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.

            if($request->view_lead!=''){
                return back()->with('flash_message', 'ChangeOrder added!');
            }else{
            return redirect('changeOrder/change-order')->with('flash_message', 'ChangeOrder added!');
        }
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
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $changeorder = ChangeOrder::findOrFail($id);
            $adminUser = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['user']);
            })->first();
            return view('changeOrder.change-order.show', compact('changeorder','adminUser'));
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
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $changeorder = ChangeOrder::with('getChangeOrderAttachments')->findOrFail($id);
            $leads = Lead::get();
            $users = User::whereDoesntHave('roles', function($q) {
                $q->whereIn('name', ['admin', 'user']);
            })->get();
            $adminUser = User::whereHas('roles', function($q) {
                $q->whereIn('name', ['user']);
            })->first();
            $categories = Category::get();

            return view('changeOrder.change-order.edit', compact('changeorder', 'leads', 'users', 'categories','adminUser'));
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
    public function update(Request $request, $id){
//        return $request->all();
        $model = str_slug('changeorder','-');
        if (auth()->user()->permissions()->where('name','=','edit-'.$model)->first() != null) {
            $requestData = $request->all();
            $changeorder = ChangeOrder::findorfail($id);
            extract($request->all());
               $newChangeOrder =  ChangeOrder::where('id', $id)->update([
                    'lead_id' => $lead_id??"",
                    'customer_id' => $customer_id??"",
                    'address' => $address??"",
                    'due_date' => $due_date??"",
                    'total_amount' => $total_amount??"",
                    'description' => $description??"",
                    'signature' => $signature??"",
                    'total_tax' => $total_tax??"",
                    'sub_total' => $sub_total??"",
                ]);
            if (!empty($requestData['activity_name'])) {
                ChangeOrderAttachment::where('change_order_id', $id)->delete();
                foreach ($requestData['activity_name'] as $key => $value) {
                    ChangeOrderAttachment::where('change_order_id', $id)->where('activity_name', $activity_name)->where('category_id', $id)->where('quantity', $quantity)->where('rate', $rate)->where('amount', $amount)->updateOrCreate([
                        'change_order_id' => $id,
                        'activity_name'     => isset($activity_name[$key]) ? $activity_name[$key] : null,
                        'category_id'       => isset($category_id[$key]) ? $category_id[$key] : null,
                        'quantity'          => isset($quantity[$key]) ? $quantity[$key] : null,
                        'rate'              => isset($rate[$key]) ? $rate[$key] : null,
                        'amount'            => isset($amount[$key]) ? $amount[$key] : null,
                        'tax'            => isset($tax[$key]) ? $tax[$key] : null,

                    ]);
                }
            }
            $leadId = $changeorder->lead_id;
            $lead = Lead::findOrFail($leadId);
            $jobPrice = $lead->lead_price ?? 0;
            $changeOrderPrice = ChangeOrder::where('lead_id', $leadId)->where('status', 'approved')->sum('total_amount');
            $totalJobPrice = $jobPrice + $changeOrderPrice;
            $lead->update([
                'lead_price_with_change_order_price' => $totalJobPrice,
            ]);
            if (isset($changeorder) && !empty($changeorder)) {
                Notification::create([
                    'lead_id' => $changeorder->lead_id,
                    'model'   => 'Change Order Update',
                    'title' => 'Change order has been updated for the lead <b>' . @$changeorder->getLead->title . '</b> of amount <b>$' . $total_amount . '</b> by',
                    'icon'    => 'fa-regular fa-square-plus',
                    'time'    => $changeorder->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if($request->view_lead!=''){
                return back()->with('flash_message', 'ChangeOrder updated!');
            }else{
            return redirect('changeOrder/change-order')->with('flash_message', 'ChangeOrder updated!');
        }
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
        $model = str_slug('changeorder','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ChangeOrder::destroy($id);

            return redirect('changeOrder/change-order')->with('flash_message', 'ChangeOrder deleted!');
        }
        return response(view('403'), 403);

    }
}
