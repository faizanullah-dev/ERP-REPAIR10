<?php

namespace App\Http\Controllers\Lead;

use App\Appointment;
use App\Category;
use App\ChimneyEstimateBricksRow;
use App\ChimneyEstimateCalculator;
use App\ChimneyEstimateCalculatorLabel;
use App\EmailTemplate;
use App\EmailTemplateFolder;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Notification;
use App\PhotoAndDocument;
use App\PhotoAndDocumentAttachment;
use App\Priority;
use App\ProductMaterialSection;
use App\ProductPdfMaterialList;
use App\ProductPricePdfAreaPitch;
use App\ProductPricePdfMeasurement;
use App\ProductPricePdfTotal;
use App\ProductPriceSkylight;
use App\ProductPricingEstimateCalculator;
use App\ProductPricingEstimateCalculatorDownspout;
use App\ProductPricingEstimateCalculatorEaveRake;
use App\ProductPricingEstimateCalculatorFlatArea;
use App\ProductPricingEstimateCalculatorLabel;
use App\ProductPricingPriceList;
use App\ProgressBoard;
use App\RoofEstimateSkylight;
use App\StoreProductPricingMaterialList;
use App\RoofEstimateCalculator;
use App\RoofEstimateCalculatorDownspout;
use App\RoofEstimateCalculatorEaveRake;
use App\RoofEstimateCalculatorFlatArea;
use App\RoofEstimateCalculatorFlatRoof;
use App\RoofEstimateCalculatorLabel;
use App\Roofestimatecalculatorpreferd;
use App\RoofEstimateCalculatorSystem;
use App\SidingEstimateCalculator;
use App\SidingEstimateCalculatorDownspout;
use App\SidingEstimateCalculatorGuttersDownSpout;
use App\SidingEstimateCalculatorEaveRake;
use App\SidingEstimateCalculatorFlatArea;
use App\SidingEstimateCalculatorLabel;
use App\StoreChimneyEstimateCalculatorChimney;
use App\StoreChimneyEstimateCalculatorLiner;
use App\StoreProductPricingPriceList;
use App\StoreRoofEstimateCalculatorGutter;
use App\StoreRoofEstimateCalculatorUnderfifteenSQ;
use App\StoreSideEstimateCalculatorGutter;
use App\Task;
use App\TaskAssignUser;
use App\TaskAttachment;
use App\Team;
use App\LeadStage;
use App\Stage;
use App\YearEstimation;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\CompanyContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\Email;
use App\ChangeOrder;
class LeadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $yearEstimation = YearEstimation::where('status',1)->first();
        $model = str_slug('lead','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $lead = Lead::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('customer_id', 'LIKE', "%$keyword%")
                ->orWhere('representative_id', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('lead_number', 'LIKE', "%$keyword%")
                ->orWhere('duration_days', 'LIKE', "%$keyword%")
                ->orWhere('duration_hours', 'LIKE', "%$keyword%")
                ->orWhere('duration_minutes', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('contact_person', 'LIKE', "%$keyword%")
                ->orWhere('other_information', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')
                ->paginate($perPage);
            } else {
                $users = User::whereHas('roles', function($q) {
                    $q->where('name', '!=', 'admin')->where('name', '!=', 'user');
                })->get();

                $priorities = Priority::get();
                $teams = Team::get();
                $categories = Category::get();

                $userID = auth()->user()->id;

                if (!auth()->user()->hasRole('user')) {
                    $leadQuery = Lead::where(function($query) use ($userID) {
                        $query->where('representative_id', $userID)
                            ->orWhere('customer_id', $userID);
                    });
                } else {
                    $leadQuery = Lead::query();
                }//ends if.
                if (in_array($request->lead_type, ['pending', 'won', 'lost'])) {
                    $leadQuery->where('lead_status', $request->lead_type);
                }

                if ($request->lead_filter == 'yes') {
                    $leadQuery->whereBetween('lead_date', [$request->duration_starts, $request->duration_ends]);
                    if (!empty($request->category_id)) {
                        $leadQuery->where('category_id', $request->category_id);
                    }//ends if.
                }//ends if.
                $lead = $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                    ->orderBy('id', 'DESC')
                    ->get();

                $statusCounts = Lead::whereYear('lead_status_date', $yearEstimation->year)
                    ->whereIn('lead_status', ['won', 'pending', 'lost'])
                    ->get()
                    ->groupBy('lead_status')
                    ->map(function ($statusGroup) {
                        return $statusGroup->count();
                    });

                $wonCount = $statusCounts['won'] ?? 0;
                $pendingCount = $statusCounts['pending'] ?? 0;
                $lostCount = $statusCounts['lost'] ?? 0;

                $emailTemplates = EmailTemplate::get();

            }//ends if.
            return view('lead.lead.index', compact('yearEstimation','lead', 'users', 'priorities', 'teams', 'categories', 'wonCount', 'lostCount', 'pendingCount', 'emailTemplates'));
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
        $model = str_slug('lead', '-');
        $yearEstimation = YearEstimation::where('status', 1)->first();
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $customers = User::whereHas('roles', function ($q) {
                $q->where('name', 'customer');
            })->get(); 
            $preselectedCustomerId = $request->get('customer_id', null);
 
            if ($preselectedCustomerId) {
                $customerExists = $customers->where('id', $preselectedCustomerId)->first();
                if (!$customerExists) { 
                    $preselectedCustomer = User::find($preselectedCustomerId);
                    if ($preselectedCustomer) {
                        $customers = $customers->push($preselectedCustomer);
                    }
                }
            }

            $representatives = User::whereHas('roles', function ($q) {
                $q->where('name', 'staff');
            })->get();
            $categories = Category::wherestatus(1)->get();
            $companies = CompanyContact::get();

            $roles = Role::get();
            return view('lead.lead.create', compact('yearEstimation', 'customers', 'representatives', 'customers', 'categories', 'roles', 'companies', 'preselectedCustomerId'));
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

    public function store(Request $request){
            $model = str_slug('lead','-');
            if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
                $this->validate($request, ['title' => 'required' , 'customer_id' => 'required']);
            $requestData = $request->all();
            if (isset($requestData['lead_price'])) {
                $formattedPrice = str_replace(',', '', $requestData['lead_price']);
                $requestData['lead_price'] = (int) $formattedPrice;
                $requestData['lead_price_with_change_order_price'] = (int) $formattedPrice;
            }//ends if.
            $requestData['created_by'] = auth()->id();
            $requestData['lead_status_date'] = $requestData['lead_date'];
            if($request->lead_icon){
                $iconPath = $this->storeImage('images', $request->lead_icon);
                $requestData['lead_icon'] = $iconPath??null;
            }
            $lead = Lead::create($requestData);
            $stages = Stage::get();
            $firstStage = $stages->where('position', 1)->first();
                if ($firstStage) {
                    $lead->update([
                        'stage_id' => $firstStage->id,
                        'stage_position' => $firstStage->position,
                    ]);
                }
            $date = now()->format('Y-m-d');
            if (!empty($stages) && isset($stages)) {
            foreach ($stages as $stage){
                LeadStage::create([
                    'lead_id'  => $lead->id,
                    'stage_id' => $stage->id,
                    'date'     => $date,
                    'position' => $stage->position,
                    'status'   => $stage->status,
                    ]);//ends create.
                }//ends foreach.
            }//ends if.
            if (isset($lead) && !empty($lead)) {
                Notification::create([
                    'lead_id' =>  $lead->id,
                    'model'   => 'Lead Created',
                    'title'   => 'Lead created name<b>' . $lead->title . '</b> by ',
                    'icon'    => 'fa-solid fa-file-image',
                    'time'    => $lead->updated_at,
                    'user_id' => auth()->user()->id,
                ]);
            }
            try {
                $client = new \GuzzleHttp\Client();
                $requestBody = [
                    'name' =>  $lead->title ??'',
                        'address' => [
                            'street_address_1' => strlen($lead->address) > 100 ? substr($lead->address, 0, 97) . '...' : $lead->address,
//                            'city' => $lead->city ?? '',
//                            'state' => $lead->state ?? '',
//                            'F' => $lead->postal_code ??  '',
//                            'country' => $lead->country ?? ''
                    ],
                    'coordinates' => [
                        'lat' => $lead->latitude  ?? '28.425852468018288',
                        'lon' => $lead->longitude ?? '-81.47155671113255'
                    ],
                    'geofence' => [
                        ['lat' => 28.425852468018288, 'lon' => -81.47155671113255],
                        ['lat' => 18.425852468018288, 'lon' => -81.47155671113255],
                        ['lat' => 8.425852468018288,  'lon' => -91.47155671113255],
                        ['lat' => 28.425852468018288, 'lon' => -101.47155671113255]
                    ],
                    'primary_contact' => [
                        'name' => $lead->customer->name ?? 'Joe Smith',
                        'email' => $lead->customer->email ?? 'joe.smith@companycam.com',
                        'phone_number' => $lead->customer->customerPhones->first()->phone ?? '123-456-7890'
                    ]
                ];
                $body = json_encode($requestBody);
                $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP'), [
                    'body' => $body,
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $responseBody = json_decode($response->getBody(), true);
                $lead->update(['company_camp_id' => $responseBody['id']]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error occurred while processing the request.');
            }
                $subject = 'Lead Assigned';
                $staff = User::where('id', $request->customer_id)->first();
                $user = User::where('id', $request->representative_id)->first();
                $leadUrl = env('APP_URL') . "/view_lead/{$lead->id}";

                $emailData = [
                    'staffName' => $staff->name,
                    'categoryName' => $lead->category->name,
                    'leadUrl' => $leadUrl,
                    'lead' => $lead
                ];

                // Send to Job Rep
                Mail::send('lead.lead.emails.lead_assignment_user', $emailData, function($message) use ($user, $subject) {
                    $message->to($user->email)
                        ->subject($subject);
                });

                // Send to Customer
                $emailData['staffName'] = $user->name;
                Mail::send('lead.lead.emails.lead_assignment_customer', $emailData, function($message) use ($staff, $subject) {
                    $message->to($staff->email)
                        ->subject($subject);
                });
            return redirect('lead_card_view?lead_card_view_status=unarchive')->with('flash_message', 'Lead added!');
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
        $model = str_slug('lead','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
              $lead = Lead::findOrFail($id);
            return view('lead.lead.show', compact('lead'));
//            return view('admin.by_salesman', compact('lead'));
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
        $model = str_slug('lead','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
           $lead = Lead::findOrFail($id);
            $customers = User::whereHas(
                'roles', function($q){
                $q->where('name', 'customer');
            }
            )->get();
            $representatives= User::whereHas(
                'roles', function($q){
                $q->whereNotIn('name', ['admin','user']);
            }
            )->get();
            $categories = Category::wherestatus(1)->get();
            return view('lead.lead.edit', compact('lead', 'representatives', 'customers', 'categories'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.f
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id){
        $model = str_slug('lead','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'customer_id' => 'required'
		]);
            $requestData = $request->all();
            if (isset($requestData['lead_price'])) {
                $formattedPrice = str_replace(',', '', $requestData['lead_price']);
                $requestData['lead_price'] = (int) $formattedPrice;
            }//ends if.
            $lead = Lead::findOrFail($id);

            $subject = 'Lead Assigned';
            $staff = User::where('id', $request->customer_id)->first();
            $user = User::where('id', $request->representative_id)->first();
            $leadUrl = env('APP_URL') . "/view_lead/{$lead->id}";

            $emailData = [
                'staffName' => $staff->name,
                'categoryName' => $lead->category->name,
                'leadUrl' => $leadUrl,
                'lead' => $lead
            ];

            if($lead->customer_id != $request->customer_id) {
                // Send to Job Rep
                Mail::send('lead.lead.emails.customer_assignment_user', $emailData, function($message) use ($user, $subject) {
                    $message->to($user->email)
                        ->subject($subject);
                });

                // Send to Customer
                $emailData['staffName'] = $user->name;
                Mail::send('lead.lead.emails.lead_assignment_customer', $emailData, function($message) use ($staff, $subject) {
                    $message->to($staff->email)
                        ->subject($subject);
                });
            }

            if($lead->representative_id != $request->representative_id){
                // Send to Job Rep
                Mail::send('lead.lead.emails.lead_assignment_user', $emailData, function($message) use ($user, $subject) {
                    $message->to($user->email)
                        ->subject($subject);
                });

                // Send to Customer
                $emailData['staffName'] = $user->name;
                Mail::send('lead.lead.emails.user_assignment_customer', $emailData, function($message) use ($staff, $subject) {
                    $message->to($staff->email)
                        ->subject($subject);
                });
            }


            $lead->update($requestData);
            if (isset($lead) && !empty($lead)) {
                Notification::create([
                    'lead_id' =>  $lead->id,
                    'model'   => 'Lead Update',
                    'title'   => 'Job detail updated against the lead <b>' . $lead->title . '</b> by ',
                    'icon'    => 'fa-solid fa-file-image',
                    'time'    => $lead->updated_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if ($lead->company_camp_id) {
                try {
                    $client = new \GuzzleHttp\Client();
                    $requestBody = [
                        'name' => $lead->title ?? '',
                        'address' => [
                            'street_address_1' => strlen($lead->address) > 100 ? substr($lead->address, 0, 97) . '...' : $lead->address,
                        ],
                        'coordinates' => [
                            'lat' => $lead->latitude ?? '28.425852468018288',
                            'lon' => $lead->longitude ?? '-81.47155671113255'
                        ]
                    ];
                    $body = json_encode($requestBody);
                    $response = $client->request('PUT', env('STORE_LEAD_COMPANY_CAMP') . '/' . $lead->company_camp_id, [
                        'body' => $body,
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                            'Content-Type' => 'application/json',
                        ],
                    ]);
                    $responseBody = json_decode($response->getBody(), true);
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error occurred while updating the address on CompanyCam.');
                }
            }
            return redirect(url('view_lead',[$id]))->with('flash_message', 'Lead updated!');
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
//    public function destroy($id)
//    {
//        $model = str_slug('lead','-');
//        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
//            Lead::destroy($id);
//
//            return redirect('lead/lead')->with('flash_message', 'Lead deleted!');
//        }
//        return response(view('403'), 403);
//
//    }
    public function destroy($id){
        $model = str_slug('lead', '-');
        if (auth()->user()->permissions()->where('name', '=', 'delete-' . $model)->first() != null) {
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            if ($yearEstimation) {
                $lead = Lead::findOrFail($id);
                $currentDateTime = now();
                $modifiedDateTime = $currentDateTime->setYear($yearEstimation->year);
                $lead->update(['deleted_at' => $modifiedDateTime]);
                Notification::create([
                    'lead_id' =>  $lead->id,
                    'model'   => 'Lead Deleted',
                    'title'   => 'Lead <b>' . $lead->title . '</b> deleted by ',
                    'icon' => 'fa-solid fa-trash',
                    'time'    => $lead->updated_at,
                    'user_id' => auth()->user()->id,
                ]);
                return redirect()->to(url()->previous())->with('flash_message', 'Lead deleted!');
//                return redirect('lead/lead')->with('flash_message', 'Lead deleted!');
            }
            return redirect('lead/lead')->withErrors('Year Estimation not found.');
        }
        return response(view('403'), 403);
    }
    public function mapViewLead(Request $request){
        $users = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
        $priorities = Priority::get();
        $teams = Team::get();
        $categories= Category::get();
        $yearEstimation = YearEstimation::where('status', 1)->first();
        if(!auth()->user()->hasRole('user')){
            if ($request->lead_filter == 'yes'){
                if (!empty($request->category_id)){
                    $lead = Lead::where('representative_id', auth()->user()->id)->where('category_id',$request->category_id)->whereBetween('lead_date', [$request->duration_starts, $request->duration_ends])->latest()->get();
                }else{
                    $lead = Lead::where('representative_id', auth()->user()->id)->whereBetween('lead_date', [$request->duration_starts, $request->duration_ends])->latest()->get();
                }
            }else{
                $lead = Lead::where('representative_id', auth()->user()->id)->latest()->get();
            }//ends if.
        }else{
            if ($request->lead_filter == 'yes'){
                if (!empty($request->category_id)){
                    $lead = Lead::where('category_id',$request->category_id)->whereBetween('lead_date', [$request->duration_starts, $request->duration_ends])->orderBy('id','DESC')->get();
                }else{
                    $lead = Lead::whereBetween('lead_date', [$request->duration_starts, $request->duration_ends])->latest()->get();
                }
            }else{
//               $lead = Lead::get();
                $lead = Lead::whereYear('lead_status_date', $yearEstimation->year)
                    ->orderBy('id', 'DESC')
                    ->get();
            }//ends if.
        }//ends if.
        return view('lead.lead.map_view_lead', compact('lead','users','priorities','teams' ,'categories','yearEstimation'));
    }//ends function mapViewLead.
    public function calenderTaskView(Request $request){//unaiz
        $users = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $priorities = Priority::get();
        $teams = Team::get();
        $categories= Category::get();
        $userID = auth()->user()->id;
        if (!auth()->user()->hasRole('user')) {
            $leadQuery = Lead::where(function($query) use ($userID) {
                $query->where('representative_id', $userID)
                    ->orWhere('customer_id', $userID);
            });
        } else {
            $leadQuery = Lead::query();
        }//ends if.
        if ($request->lead_filter == 'yes') {
            $leadQuery->whereBetween('lead_date', [$request->duration_starts, $request->duration_ends]);
            if (!empty($request->category_id)) {
                $leadQuery->where('category_id', $request->category_id);
            }//ends if.
        }//ends if.
        $lead    = $leadQuery->orderBy('id', 'DESC')->paginate(25);
        $leadIds = $lead->pluck('id');
        $task    = Task::whereIn('assign_to_lead_id', $leadIds)->get();
        return view('lead.lead.calendar_task.calendar_task',compact('lead','users','priorities','teams' ,'categories', 'task', 'yearEstimation'));
    }
    public function jobInsuranceForLead(Request  $request, $id){
        $lead = Lead::find($id);
        $yearEstimation = YearEstimation::where('status',1)->first();
        $companies = CompanyContact::get();
        return (string) view('lead.lead.job_insurance_view',compact('lead','yearEstimation','companies'));
    }//ends function jobInsuranceForLead.

   public function leadCardView(Request  $request){
        $yearEstimation = YearEstimation::where('status',1)->first();
       $model = str_slug('lead','-');
       if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
           $keyword = $request->get('search');
           $perPage = 24;
           if (!empty($keyword)) {
               $lead = Lead::where('title', 'LIKE', "%$keyword%")
                   ->orWhere('description', 'LIKE', "%$keyword%")
                   ->orWhere('customer_id', 'LIKE', "%$keyword%")
                   ->orWhere('representative_id', 'LIKE', "%$keyword%")
                   ->orWhere('category_id', 'LIKE', "%$keyword%")
                   ->orWhere('lead_number', 'LIKE', "%$keyword%")
                   ->orWhere('duration_days', 'LIKE', "%$keyword%")
                   ->orWhere('duration_hours', 'LIKE', "%$keyword%")
                   ->orWhere('duration_minutes', 'LIKE', "%$keyword%")
                   ->orWhere('address', 'LIKE', "%$keyword%")
                   ->orWhere('contact_person', 'LIKE', "%$keyword%")
                   ->orWhere('other_information', 'LIKE', "%$keyword%")
                   ->orWhere('status', 'LIKE', "%$keyword%")
                   ->orderBy('id','DESC')
                   ->paginate($perPage);
           } else {
               $users = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
               $priorities = Priority::where('status', 1)->get();
               $teams = Team::get();
               $categories= Category::where('status','1')->get();
               $emailTemplateFolder = EmailTemplateFolder::whereStatus('1')->get();
               $emailTemplates = EmailTemplate::get();
               $userID = auth()->user()->id;
               if (!auth()->user()->hasRole('user')) {
                   $leadQuery = Lead::where(function($query) use ($userID) {
                       $query->where('representative_id', $userID)
                           ->orWhere('customer_id', $userID);
                   });
               } else {
                   $leadQuery = Lead::query();
               }//ends if.
               if ($request->lead_filter == 'yes') {
                   $leadQuery->when($request->duration_starts && $request->duration_ends, function ($query) use ($request) {
                       $query->whereBetween('lead_status_date', [$request->duration_starts, $request->duration_ends]);
                   })->when($request->category_id, function ($query) use ($request) {
                       $query->where('category_id', $request->category_id);
                   });
               }
               $yearEstimation = YearEstimation::where('status', '1')->first();
//               if (in_array($request->lead_type, ['pending', 'won', 'lost'])) {
//                   $leadQuery->whereYear('lead_date', $yearEstimation->year)->where('lead_status', $request->lead_type);
//               }
               if (in_array($request->lead_type, ['pending'])) {
                   $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                       ->where('lead_status', $request->lead_type);
               } elseif ($request->lead_type == 'lost') {
                   $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                       ->where('lead_status', $request->lead_type);
               } elseif ($request->lead_type == 'won') {
                   $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                       ->where('lead_status', $request->lead_type);
               } elseif ($request->lead_type == 'new') {
                   $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                       ->where('lead_status', $request->lead_type);
               } elseif ($request->lead_type == 'delete') {
                   $leadQuery->whereYear('deleted_at', $yearEstimation->year)->onlyTrashed();
               }
               $leadCount = $leadQuery->with('companyInsurrance','notifications')->orderBy('id', 'DESC')->get();
               $lead = $leadQuery->with('companyInsurrance','notifications')->orderBy('id', 'DESC')->paginate($perPage);
               if ($request->lead_card_view_status == 'unarchive') {
                   $lead = Lead::whereYear('lead_status_date', $yearEstimation->year)->with('companyInsurrance', 'notifications')->orderBy('id', 'DESC')->where('archive_status', 'archive')->paginate($perPage);
                   $leadCount = Lead::whereYear('lead_status_date', $yearEstimation->year)->with('companyInsurrance', 'notifications')->orderBy('id', 'DESC')->where('archive_status', 'archive')->get();

               } elseif ($request->lead_card_view_status == 'archive') {
                   $lead = Lead::whereYear('lead_status_date', $yearEstimation->year)->with('companyInsurrance', 'notifications')->orderBy('id', 'DESC')->where('archive_status', 'unarchive')->paginate($perPage);
                   $leadCount = Lead::whereYear('lead_status_date', $yearEstimation->year)->with('companyInsurrance', 'notifications')->orderBy('id', 'DESC')->where('archive_status', 'unarchive')->get();
               }

           }
           return view('lead.lead.card_view', compact('lead','users','priorities','teams' ,'categories','yearEstimation', 'emailTemplates','leadCount', 'emailTemplateFolder'));
       }
       return response(view('403'), 403);
    }//ends function jobInsuranceForLead.
    public function exportLeads(Request $request)
    {
        $model = str_slug('lead', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $yearEstimation = YearEstimation::where('status', 1)->first();
            if (!$yearEstimation) {
                return response()->json(['error' => 'Year estimation not found'], 400);
            }
            $userID = auth()->user()->id;

            // Initialize the query
            $leadQuery = Lead::query();

            // Apply user role-based filtering for non-deleted leads
            if (!auth()->user()->hasRole('user') && $request->lead_type != 'delete') {
                $leadQuery->where(function ($query) use ($userID) {
                    $query->where('representative_id', $userID)
                        ->orWhere('customer_id', $userID);
                });
            }

            // Handle soft-deleted leads for lead_type=delete
            if ($request->lead_type == 'delete') {
                $leadQuery->whereYear('deleted_at', $yearEstimation->year)->onlyTrashed();
            } elseif (in_array($request->lead_type, ['pending', 'won', 'lost'])) {
                $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                    ->where('lead_status', $request->lead_type);
            }

            // Apply search filter
            if (!empty($keyword)) {
                $leadQuery->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->orWhere('customer_id', 'LIKE', "%$keyword%")
                    ->orWhere('representative_id', 'LIKE', "%$keyword%")
                    ->orWhere('category_id', 'LIKE', "%$keyword%")
                    ->orWhere('lead_number', 'LIKE', "%$keyword%")
                    ->orWhere('duration_days', 'LIKE', "%$keyword%")
                    ->orWhere('duration_hours', 'LIKE', "%$keyword%")
                    ->orWhere('duration_minutes', 'LIKE', "%$keyword%")
                    ->orWhere('address', 'LIKE', "%$keyword%")
                    ->orWhere('contact_person', 'LIKE', "%$keyword%")
                    ->orWhere('other_information', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%");
                });
            }

            // Apply lead filter (date range and category)
            if ($request->lead_filter == 'yes') {
                $leadQuery->when($request->duration_starts && $request->duration_ends, function ($query) use ($request) {
                    $query->whereBetween('lead_status_date', [$request->duration_starts, $request->duration_ends]);
                })->when($request->category_id, function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                });
            }

            if ($request->lead_card_view_status == 'unarchive') {
                $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                    ->where('archive_status', 'archive');
            } elseif ($request->lead_card_view_status == 'archive') {
                $leadQuery->whereYear('lead_status_date', $yearEstimation->year)
                    ->where('archive_status', 'unarchive');
            }

            // Fetch leads with relationships
            $leads = $leadQuery->with(['customer.profile', 'representative', 'category', 'notifications'])
                ->orderBy('id', 'DESC')
                ->get();

            $leads = $leads->map(function ($lead) {
                $changeOrderSum = ChangeOrder::where('lead_id', $lead->id)->where('status', 'approved')->sum('total_amount');
                $lead->ChangeOrder = (float) ($changeOrderSum ?? 0); // Cast sum to float, default to 0
                return $lead;
            });

            return response()->json($leads);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function updateJobInsuranceForLead(Request $request, $id){
        extract($request->all());
        $updateLead = Lead::where('id',$id)->update([
            'company_id'              => $company_id ?? null,
            'claim_number'            => $claim_number ?? null,
            'policy_number'           => $policy_number ?? null,
            'phone_insurance'         => $phone_insurance ?? null,
            'fax_number'              => $fax_number ?? null,
            'email_insurance'         => $email_insurance ?? null,
            'adjust_name_insurance'   => $adjust_name_insurance ?? null,
            'adjust_Phone_insurance'  => $adjust_Phone_insurance ?? null,
            'adjust_email_insurance'  => $adjust_email_insurance ?? null,
            'contract_signed_date'    => $contract_signed_date ?? null,
            'date_loss_insurance'     => $date_loss_insurance ?? null,
            'claim_filled_date'       => $claim_filled_date ?? null,
        ]);
        if($updateLead){
            return redirect()->back()->with('message','Job Insurance Updated Successfully');
        }else {
            return redirect()->back()->with('message','something went wrong');
        }//ends if.
    }//ends function updateJobInsuranceForLead.
    public function getCompanyDetail(Request $request){
        $companies = CompanyContact::where('id',$request->companyId)->first();
        return $companies;
    }
    public function statusChangeLeadCardView($id = null, $archive_status = null)
    {
        if (Lead::where('id', $id)->update(['archive_status' => $archive_status])) {
            if ($archive_status == 'unarchive') {
                return redirect('lead_card_view?lead_card_view_status=archive')->with('flash_message', 'Lead Saved To Archive!');
            } elseif ($archive_status == 'archive') {
                return redirect('lead_card_view?lead_card_view_status=unarchive')->with('flash_message', 'Lead Removed From Archive!');
            }
        } else {
            return response(view('403'), 403);
        }
    }

    public function getLeadListCompanyCampProject(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', env('STORE_LEAD_COMPANY_CAMP'), [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                'content-type' => 'application/json',
            ],
        ]);
        $formattedBody = $response->getBody()->getContents(); // Assuming $response is the Guzzle response object
        $responseData = json_decode($formattedBody, true); // Decode the JSON response
        foreach ($responseData as $data) {
            $lead = Lead::where('company_camp_id', $data['id'])->first();
            if ($lead){
                $lead->update([
                    'title'       => $data['name'],
                    'address'     => $data['address']['street_address_1'],
                    'city'        => $data['address']['city'],
                    'state'       => $data['address']['state'],
                    'postal_code' => $data['address']['postal_code'],
                    'country'     => $data['address']['country'],
                    'latitude'    => $data['coordinates']['lat'],
                    'longitude'   => $data['coordinates']['lon'],
                ]);
            }//ends if.
        }//ends foreach.
    }//ends function getLeadListCompanyCampProject.

    public function getDocumentCompanyCamp(Request $request)
    {
        $leads = Lead::with('getphotoandDocument.getDocuments')->whereNotNull('company_camp_id')->get();
        foreach ($leads as $lead) {
            if ($lead->relationLoaded('getphotoandDocument') && $lead->getphotoandDocument->count() > 0) {
                try {
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('GET', env('STORE_LEAD_COMPANY_CAMP') . '/' . $lead->company_camp_id . '/documents', [
                        'headers' => [
                            'accept' => 'application/json',
                            'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                            'content-type' => 'application/json',
                        ],
                    ]);
                    $responseData = json_decode($response->getBody()->getContents(), true);
                    foreach ($responseData as $document) {
                        $photoAndDocument = PhotoAndDocumentAttachment::where('company_camp_file_id', $document['id'])->first();
                        $fileName = $document['name'] ?: basename($document['url']);
                        if ($photoAndDocument && $photoAndDocument->file_name === $fileName) {
                            continue; // Document already exists with matching name, skip to the next document
                        }
                        if (!empty($document['url'])) {
                            $pdfContent = file_get_contents($document['url']);
                            if ($pdfContent === false) {
                                continue;
                            }
                            // Save PDF content to the 'leads' disk
                            $saveResult = Storage::disk('leads')->put($fileName, $pdfContent);
                            if ($saveResult === false) {
                                continue;
                            }
                            $localFilePath = Storage::disk('leads')->path($fileName);
                            $doc = PhotoAndDocument::firstOrCreate([
                                'lead_id' => $lead->id,
                                'company_camp_id' => $lead->company_camp_id,
                                'created_by' => $lead->created_by,
                            ]);
                            PhotoAndDocumentAttachment::create([
                                'document_id' => $doc->id,
                                'name' => 'photo_and_documents_attachment/'.$fileName, // Path where the file is saved, use relative path or URL as needed
                                'file_name' => $fileName, // Name of the file
                                'doc_primary' => 0,
                                'company_camp_id' => $lead->company_camp_id,
                                'company_camp_file_id' => $document['id'],
                                'lead_id' => $lead->id,
                            ]);
                        }//ends if.
                    }//ends foreach.
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
                }//ends try catch.
            }//ends if.
        }//ends foreach.

    }//ends function getPhotoAndDocumentCompanyCamp.



    public function getPhotoCompanyCamp(Request $request)
    {
        $leads = Lead::with('getphotoandDocument.getDocuments')->whereNotNull('company_camp_id')->get();
        foreach ($leads as $lead) {
            if ($lead->relationLoaded('getphotoandDocument') && $lead->getphotoandDocument->count() > 0) {
                try {
                    $client = new \GuzzleHttp\Client();
                     $response = $client->request('GET', env('STORE_LEAD_COMPANY_CAMP') . '/' . $lead->company_camp_id . '/photos', [
                        'headers' => [
                            'accept' => 'application/json',
                            'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                            'content-type' => 'application/json',
                        ],
                    ]);
                    $responseData = json_decode($response->getBody()->getContents(), true);
                    foreach ($responseData as $photo) {
                        $originalImageUrl = collect($photo['uris'])->firstWhere('type', 'original')['url'] ?? null;
                        if ($originalImageUrl && !PhotoAndDocumentAttachment::where('company_camp_file_id', $photo['id'])->exists() ) {
                            $fileName = basename(parse_url($originalImageUrl, PHP_URL_PATH));
                            $photoContents = file_get_contents($originalImageUrl);
                            if ($photoContents === false) {
                                continue;
                            }//ends if.
                            $saveResult = Storage::disk('leads')->put($fileName, $photoContents);
                            if ($saveResult === false) {
                                continue;
                            }//ends if.
                            $localFilePath = Storage::disk('leads')->path($fileName);
                            $doc = PhotoAndDocument::firstOrCreate([
                                'lead_id' => $lead->id,
                                'company_camp_id' => $lead->company_camp_id,
                                'created_by' => $lead->created_by,
                            ]);
                            PhotoAndDocumentAttachment::create([
                                'document_id' => $doc->id,
                                'name' => 'photo_and_documents_attachment/'.$fileName,
                                'file_name' => $fileName,
                                'doc_primary' => 0,
                                'company_camp_id' => $lead->company_camp_id,
                                'company_camp_file_id' => $photo['id'],
                                'lead_id' => $lead->id,
                            ]);
                        }//ends if.
                    }//ends foreach.
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
                }//ends try catch.
            }//ends if.
        }//ends foreach.
    }//ends function getPhotoCompanyCamp.

//    public function storeRoofEstimationCalculator(Request  $request){
//        try {
//            extract($request->all());
//            if ($roof_estimate_calculator_id == 0){
//                $roofEstimateCalculator = RoofEstimateCalculator::create([
//                    'lead_id' => $lead_id ?? NULL,
//                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
//                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
//                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
//                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
//                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
//                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
//                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
//                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
//                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
//                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
//                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
//                    'guards_sub_total' => $guards_sub_total ?? NULL,
//                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
//                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
//                    'note' => $note ?? NULL,
//                ]);
//                if (!empty($labels)){
//                    foreach ($labels as $section => $data){
//                        RoofEstimateCalculatorLabel::create([
//                            'section' => $section ?? NULL,
//                            'name' => $data['name'] ?? NULL,
//                            'value' => $data['value'] ?? NULL,
//                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($eave_rakes)) {
//                    foreach ($eave_rakes as $section => $data) {
//                        RoofEstimateCalculatorEaveRake::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
//                            'calculate_final_value_eave_rakes' => $data['calculate_final_value_eave_rakes'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($flat_area)) {
//                    foreach ($flat_area as $section => $data) {
//                        RoofEstimateCalculatorFlatArea::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
//                    $length = count($downspouts['downspouts']);
//                    for ($i = 0; $i < $length; $i++) {
//                        RoofEstimateCalculatorDownspout::create([
//                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
//                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
//                            'guards'     => $downspouts['guards'][$i] ?? NULL,
//                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
//                        ]);//emds create.
//                    }//ends for.
//                }//ends if.
//
//            }else{
//                $roof_id = RoofEstimateCalculator::find($roof_estimate_calculator_id);
//                RoofEstimateCalculator::where('id',$roof_id->id)->update([
//                    'lead_id' => $lead_id ?? NULL,
//                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
//                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
//                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
//                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
//                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
//                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
//                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
//                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
//                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
//                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
//                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
//                    'guards_sub_total' => $guards_sub_total ?? NULL,
//                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
//                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
//                    'note' => $note ?? NULL,
//                ]);
//                if (!empty($labels)){
//                    RoofEstimateCalculatorLabel::where('roof_estimate_calculator_id',$roof_id->id)->delete();
//                    foreach ($labels as $section => $data){
//                        RoofEstimateCalculatorLabel::create([
//                            'section' => $section ?? NULL,
//                            'name' => $data['name'] ?? NULL,
//                            'value' => $data['value'] ?? NULL,
//                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($eave_rakes)) {
//                    RoofEstimateCalculatorEaveRake::where('roof_estimate_calculator_id',$roof_id->id)->delete();
//                    foreach ($eave_rakes as $section => $data) {
//                        RoofEstimateCalculatorEaveRake::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
//                            'calculate_final_value_eave_rakes' => $data['calculate_final_value_eave_rakes'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($flat_area)) {
//                    RoofEstimateCalculatorFlatArea::where('roof_estimate_calculator_id',$roof_id->id)->delete();
//                    foreach ($flat_area as $section => $data) {
//                        RoofEstimateCalculatorFlatArea::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
//                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
//                    RoofEstimateCalculatorDownspout::where('roof_estimate_calculator_id',$roof_id->id)->delete();
//                    $length = count($downspouts['downspouts']);
//                    for ($i = 0; $i < $length; $i++) {
//                        RoofEstimateCalculatorDownspout::create([
//                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
//                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
//                            'guards'     => $downspouts['guards'][$i] ?? NULL,
//                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
//                        ]);//ends create.
//                    }//ends for.
//                }//ends if.
//            }//ends else if.
//
//            if (!isset($roof_estimated)){
//                return back()->with('message','Roof Estimation Calculator Added Successfully');
//            }else{
//                return redirect(url('roofEstimateCalculator/roof-estimate-calculator/'))->with('message','Roof Estimation Calculator Updated Successfully');
//            }//ends if.
//        }catch (\Exception $e){
//            dd($e);
//            return back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
//        }//ends try catch.
//    }//ends function storeRoofEstimationCalculator.

    public function storeRoofEstimationCalculator(Request $request){
//        return $request->all();
        try {
            extract($request->all());

            if ($roof_estimate_calculator_id == 0) {
                // Create RoofEstimateCalculator record
                $roofEstimateCalculator = RoofEstimateCalculator::create([
                    'lead_id' => $lead_id ?? NULL,
                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'guards_sub_total' => $guards_sub_total ?? NULL,
                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
                    'note' => $note ?? NULL,
                ]);

                // Check if ProductPricingEstimateCalculator exists for the given lead_id
                $productEstimateCalculator = ProductPricingEstimateCalculator::where('lead_id', $lead_id)->first();
                if (!$productEstimateCalculator) {
                    // Create ProductPricingEstimateCalculator record
                    $productEstimateCalculator = ProductPricingEstimateCalculator::create([
                        'lead_id' => $lead_id ?? NULL,
                        'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
                        'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
                        'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
                        'eave_rakes_total' => $eave_rakes_total ?? NULL,
                        'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                        'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
                        'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
                        'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
                        'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
                        'gutter_sub_total' => $gutter_sub_total ?? NULL,
                        'downspout_sub_total' => $downspout_sub_total ?? NULL,
                        'guards_sub_total' => $guards_sub_total ?? NULL,
                        'total_all_downspouts' => $total_all_downspouts ?? NULL,
                        'note' => $note ?? NULL,
                    ]);
                }

                // Handle labels
                if (!empty($labels)) {
                    foreach ($labels as $section => $data) {
                        RoofEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
                        ]);

                        ProductPricingEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'product_pricing_calculator_id' => $productEstimateCalculator->id ?? NULL,
                        ]);
                    }
                }

                // Handle eave_rakes
                if (!empty($eave_rakes)) {
                    foreach ($eave_rakes as $section => $data) {
                        RoofEstimateCalculatorEaveRake::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'calculate_final_value_eave_rakes' => $data['calculate_final_value_eave_rakes'][0] ?? NULL,
                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
                        ]);

                        ProductPricingEstimateCalculatorEaveRake::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'product_pricing_calculator_id' => $productEstimateCalculator->id ?? NULL,
                        ]);
                    }
                }

                // Handle flat_area
                if (!empty($flat_area)) {
                    foreach ($flat_area as $section => $data) {
                        RoofEstimateCalculatorFlatArea::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
                        ]);

                        ProductPricingEstimateCalculatorFlatArea::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_rakes_total' => $data['eave_rakes_total'][0] ?? NULL,
                            'product_pricing_calculator_id' => $productEstimateCalculator->id ?? NULL,
                        ]);
                    }
                }

                // Handle downspouts
                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        RoofEstimateCalculatorDownspout::create([
                            'gutters' => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards' => $downspouts['guards'][$i] ?? NULL,
                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
                        ]);

                        ProductPricingEstimateCalculatorDownspout::create([
                            'gutters' => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards' => $downspouts['guards'][$i] ?? NULL,
                            'product_pricing_calculator_id' => $productEstimateCalculator->id ?? NULL,
                        ]);
                    }
                }

                if (!empty($skylight)) {
                    foreach ($skylight as $section => $data) {
                        foreach ($data['quantity'] as $index => $quantity) {
                            ProductPriceSkylight::create([
                                'size' => $data['size'][$index] ?? NULL,
                                'quantity' => $quantity ?? NULL,
                                'price' => $data['price'][$index] ?? NULL,
                                'product_price_calculator_id' => $productEstimateCalculator->id ?? NULL,
                            ]);
                            RoofEstimateSkylight::create([
                                'product_id' => $data['product_id'][$index] ?? NULL,
                                'quantity' => $quantity ?? NULL,
                                'price' => $data['price'][$index] ?? NULL,
                                'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
                            ]);
                        }
                    }
                }

            } else {
                // Update existing RoofEstimateCalculator record
                $roof_id = RoofEstimateCalculator::find($roof_estimate_calculator_id);
                RoofEstimateCalculator::where('id', $roof_id->id)->update([
                    'lead_id' => $lead_id ?? NULL,
                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'guards_sub_total' => $guards_sub_total ?? NULL,
                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
                    'note' => $note ?? NULL,
                ]);

                // Update existing related models in RoofEstimateCalculator
                if (!empty($labels)) {
                    RoofEstimateCalculatorLabel::where('roof_estimate_calculator_id', $roof_id->id)->delete();
                    foreach ($labels as $section => $data) {
                        RoofEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);
                    }
                }

                if (!empty($eave_rakes)) {
                    RoofEstimateCalculatorEaveRake::where('roof_estimate_calculator_id', $roof_id->id)->delete();
                    foreach ($eave_rakes as $section => $data) {
                        RoofEstimateCalculatorEaveRake::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'calculate_final_value_eave_rakes' => $data['calculate_final_value_eave_rakes'][0] ?? NULL,
                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);
                    }
                }

                if (!empty($flat_area)) {
                    RoofEstimateCalculatorFlatArea::where('roof_estimate_calculator_id', $roof_id->id)->delete();
                    foreach ($flat_area as $section => $data) {
                        RoofEstimateCalculatorFlatArea::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);
                    }
                }

                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    RoofEstimateCalculatorDownspout::where('roof_estimate_calculator_id', $roof_id->id)->delete();
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        RoofEstimateCalculatorDownspout::create([
                            'gutters' => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards' => $downspouts['guards'][$i] ?? NULL,
                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);
                    }
                }
                RoofEstimateSkylight::where('roof_estimate_calculator_id', $roof_id->id)->delete();
                if (!empty($skylight)) {
                    foreach ($skylight as $section => $data) {
                        foreach ($data['quantity'] as $index => $quantity) {
                            RoofEstimateSkylight::create([
                                'product_id' => $data['product_id'][$index] ?? NULL,
                                'quantity' => $quantity ?? NULL,
                                'price' => $data['price'][$index] ?? NULL,
                                'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
                            ]);
                        }
                    }
                }
            }
            return back()->with('message', 'Roof Estimation Calculator Saved/Updated Successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
        }
    }


    public function storeRoofEstimateCalculatorPrefer(Request  $request){
        extract($request->all());
        try {
            RoofEstimateCalculatorPreferd::updateOrCreate(['roof_estimate_calculator_id' => $roof_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeRoofEstimateCalculatorPrefer.

    public function storeRoofEstimateCalculatorSystem(Request  $request){
        extract($request->all());
        try {
            RoofEstimateCalculatorSystem::updateOrCreate(['roof_estimate_calculator_id' => $roof_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeRoofEstimateCalculatorSystem.

    public function storeRoofEstimateCalculatorUnderfifteenSQ(Request $request){
        extract($request->all());
        try {
            StoreRoofEstimateCalculatorUnderfifteenSQ::updateOrCreate(['roof_estimate_calculator_id' => $roof_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeRoofEstimateCalculatorUnderfifteenSQ.

    public function storeRoofEstimateCalculatorFlatRoof(Request $request){
        extract($request->all());
        try {
            RoofEstimateCalculatorFlatRoof::updateOrCreate(['roof_estimate_calculator_id' => $roof_estimate_calculator_id],$request->all());
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeRoofEstimateCalculatorFlatRoof.

    public function storeRoofEstimateCalculatorGutter(Request $request){
//        extract($request->all());
        $data = $request->all();
//        $data['miscellaneous'] = '0';
//        $data['miscellaneous_two'] = '0';
        try {
            StoreRoofEstimateCalculatorGutter::updateOrCreate(['roof_estimate_calculator_id' => $data['roof_estimate_calculator_id']], $data);
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }//ends function storeRoofEstimateCalculatorGutter.

    public function storeSidingEstimationCalculator(Request  $request){
//        return $request->all();
        try {
            extract($request->all());
            if ($siding_estimate_calculator_id == 0){
                $sidingEstimateCalculator = SidingEstimateCalculator::create([
                     'lead_id' => $lead_id ?? NULL,
                     'waste_percent_eave_rakes' => $waste_percent_eave_rakes ?? NULL,
                     'waste_eave_rakes' => $waste_eave_rakes ?? NULL,
                     'eave_rakes_total' => $eave_rakes_total ?? NULL,
                     'eave_rakes_subtotal' => $eave_rakes_subtotal ?? NULL,
                     'gutters_total' => $gutters_total ?? NULL,
                     'guards_total' => $guards_total ?? NULL,
                     'downspout_total' => $downspout_total ?? NULL,
                     'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                     'soffit_eave' => $soffit_eave ?? NULL,
                     'soffit_rakes' => $soffit_rakes ?? NULL,
                     'soffit_porch' => $soffit_porch ?? NULL,
                    'soffit_eave_total' => $soffit_eave_total ?? NULL,
                    'soffit_rakes_total' => $soffit_rakes_total ?? NULL,
                    'soffit_porch_total' => $soffit_porch_total ?? NULL,
                    'soffit_eave_percent' => $soffit_eave_percent ?? NULL,
                    'soffit_rakes_percent' => $soffit_rakes_percent ?? NULL,
                    'soffit_porch_percent' => $soffit_porch_percent ?? NULL,
                    'soffit_total_sum' => $soffit_total_sum ?? NULL,
                    'note' => $note ?? NULL,
                    'soffit' => $soffit ?? NULL,

                ]);
                if (!empty($labels)){
                    foreach ($labels as $section => $data){
                        SidingEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'siding_estimate_calculator_id' => $sidingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($eave_rakes)) {
                    foreach ($eave_rakes as $section => $data) {
                        SidingEstimateCalculatorEaveRake::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'eave_final_rakes_total' => $data['eave_final_rakes_total'][0] ?? NULL,
                            'siding_estimate_calculator_id' => $sidingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
//                if (!empty($flat_area)) {
//                    foreach ($flat_area as $section => $data) {
//                        RoofEstimateCalculatorFlatArea::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roofEstimateCalculator->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        SidingEstimateCalculatorGuttersDownSpout::create([
                            'section' =>  $downspouts['letters'][$i] ?? NULL,
                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards'     => $downspouts['guards'][$i] ?? NULL,
                            'siding_estimate_calculator_id' => $sidingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends for.
                }//ends if.

            }else{
                $roof_id = SidingEstimateCalculator::find($siding_estimate_calculator_id);
                SidingEstimateCalculator::where('id',$roof_id->id)->update([
                    'lead_id' => $lead_id ?? NULL,
                    'waste_percent_eave_rakes' => $waste_percent_eave_rakes ?? NULL,
                    'waste_eave_rakes' => $waste_eave_rakes ?? NULL,
                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
                    'eave_rakes_subtotal' => $eave_rakes_subtotal ?? NULL,
                    'gutters_total' => $gutters_total ?? NULL,
                    'guards_total' => $guards_total ?? NULL,
                    'downspout_total' => $downspout_total ?? NULL,
                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                    'soffit_eave' => $soffit_eave ?? NULL,
                    'soffit_rakes' => $soffit_rakes ?? NULL,
                    'soffit_porch' => $soffit_porch ?? NULL,
                    'soffit_eave_total' => $soffit_eave_total ?? NULL,
                    'soffit_rakes_total' => $soffit_rakes_total ?? NULL,
                    'soffit_porch_total' => $soffit_porch_total ?? NULL,
                    'soffit_eave_percent' => $soffit_eave_percent ?? NULL,
                    'soffit_rakes_percent' => $soffit_rakes_percent ?? NULL,
                    'soffit_porch_percent' => $soffit_porch_percent ?? NULL,
                    'soffit_total_sum' => $soffit_total_sum ?? NULL,
                    'note' => $note ?? NULL,
                    'soffit' => $soffit ?? NULL,
                ]);
                if (!empty($labels)){
                    SidingEstimateCalculatorLabel::where('siding_estimate_calculator_id',$roof_id->id)->delete();
                    foreach ($labels as $section => $data){
                        SidingEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'siding_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($eave_rakes)) {
                    SidingEstimateCalculatorEaveRake::where('siding_estimate_calculator_id',$roof_id->id)->delete();
                    foreach ($eave_rakes as $section => $data) {
                        SidingEstimateCalculatorEaveRake::create([
                            'section' => $section ?? NULL,
                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'eave_final_rakes_total' => $data['eave_final_rakes_total'][0] ?? NULL,
                            'siding_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
//                if (!empty($flat_area)) {
//                    RoofEstimateCalculatorFlatArea::where('roof_estimate_calculator_id',$roof_id->id)->delete();
//                    foreach ($flat_area as $section => $data) {
//                        RoofEstimateCalculatorFlatArea::create([
//                            'section' => $section ?? NULL,
//                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
//                            'rakes' => $data['rakes'][0] ?? NULL,
//                            'calculate_final_value_flat_area' => $data['calculate_final_value_flat_area'][0] ?? NULL,
//                            'roof_estimate_calculator_id' => $roof_id->id ?? NULL,
//                        ]);//ends create.
//                    }//ends foreach.
//                }//ends if.
                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    SidingEstimateCalculatorGuttersDownSpout::where('siding_estimate_calculator_id',$roof_id->id)->delete();
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        SidingEstimateCalculatorGuttersDownSpout::create([
                            'section' =>  $downspouts['letters'][$i] ?? NULL,
                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards'     => $downspouts['guards'][$i] ?? NULL,
                            'siding_estimate_calculator_id' => $roof_id->id ?? NULL,
                        ]);//ends create.
                    }//ends for.
                }//ends if.
            }//ends else if.
            if (!isset($roof_estimated)){
                return back()->with('message','Siding Estimation Calculator Added Successfully');
            }else{
                return redirect(url('sidingEstimateCalculator/siding-estimate-calculator/'))->with('message','Siding Estimation Calculator Updated Successfully');
            }//ends if.
        }catch (\Exception $e){
            dd($e);
            return back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
        }//ends try catch.
    }//ends function storeRoofEstimationCalculator.

    public function storeSideEstimateCalculatorGutter(Request $request){
        extract($request->all());
        StoreSideEstimateCalculatorGutter::updateOrCreate(['siding_estimate_calculator_id' => $siding_estimate_calculator_id],$request->all());
    }//ends function storeSideEstimateCalculatorGutter.

    public function storeChimneyEstimationCalculator(Request $request){
    try {
        extract($request->all());
        if ($chimney_estimate_calculator_id == 0){
            $chimneyEstimateCalculator = ChimneyEstimateCalculator::create([
                'lead_id' => $lead_id ?? NULL,
                'sub_total_bricks_rows' => $sub_total_bricks_rows ?? NULL,
                'waste_bricks_rows' => $waste_bricks_rows ?? NULL,
                'total_waste_bricks_rows' => $total_waste_bricks_rows ?? NULL,
                'total_bricks_rows' => $total_bricks_rows ?? NULL,
                'notes' => $notes ?? NULL,
//                'base_value_id' => $base_value_id,
            ]);
            if (!empty($labels)){
                foreach ($labels as $section => $data){
                    ChimneyEstimateCalculatorLabel::create([
                        'section' => $section ?? NULL,
                        'name' => $data['name'] ?? NULL,
                        'value' => $data['value'] ?? NULL,
                        'chimney_estimate_calculator_id' => $chimneyEstimateCalculator->id ?? NULL,
                    ]);//ends create.
                }//ends foreach.
            }//ends if.
            if (!empty($bricks_rows)) {
                foreach ($bricks_rows as $section => $data) {
                    ChimneyEstimateBricksRow::create([
                        'section' => $section ?? NULL,
                        'bricks' => $data['bricks'][0] ?? NULL,
                        'rows' => $data['rows'][0] ?? NULL,
                        'total_bricks_rows' => $data['total_bricks_rows'][0] ?? NULL,
                        'chimney_estimate_calculator_id' => $chimneyEstimateCalculator->id ?? NULL,
                    ]);//ends create.
                }//ends foreach.
            }//ends if.
        }else{
            $chimney_id = ChimneyEstimateCalculator::find($chimney_estimate_calculator_id);
            ChimneyEstimateCalculator::where('id',$chimney_id->id)->update([
                'lead_id' => $lead_id ?? NULL,
                'sub_total_bricks_rows' => $sub_total_bricks_rows ?? NULL,
                'waste_bricks_rows' => $waste_bricks_rows ?? NULL,
                'total_waste_bricks_rows' => $total_wastes_brick_rows ?? NULL,
                'total_bricks_rows' => $total_bricks_rows ?? NULL,
                'notes' => $notes ?? NULL,
//                'base_value_id' => $base_value_id ?? NULL,
            ]);
            if (!empty($labels)){
                ChimneyEstimateCalculatorLabel::where('chimney_estimate_calculator_id',$chimney_id->id)->delete();
                foreach ($labels as $section => $data){
                    ChimneyEstimateCalculatorLabel::create([
                        'section' => $section ?? NULL,
                        'name' => $data['name'] ?? NULL,
                        'value' => $data['value'] ?? NULL,
                        'chimney_estimate_calculator_id' => $chimney_id->id ?? NULL,
                    ]);//ends create.
                }//ends foreach.
            }//ends if.
            if (!empty($bricks_rows)) {
                ChimneyEstimateBricksRow::where('chimney_estimate_calculator_id',$chimney_id->id)->delete();
                foreach ($bricks_rows as $section => $data) {
                    ChimneyEstimateBricksRow::create([
                        'section' => $section ?? NULL,
                        'bricks' => $data['bricks'][0] ?? NULL,
                        'rows' => $data['rows'][0] ?? NULL,
                        'total_brick_rows' => $data['total_brick_rows'][0] ?? NULL,
                        'chimney_estimate_calculator_id' => $chimney_id->id ?? NULL,
                    ]);//ends create.
                }//ends foreach.
            }//ends if.
        }//ends else if.
        if (!isset($roof_estimated)){
            return back()->with('message','Chimney Estimation Calculator Added Successfully');
        }else{
            return redirect(url('chimneyEstimateCalculator/chimney-estimate-calculator/'))->with('message','Chimney Estimation Calculator Updated Successfully');
        }//ends if.
    }catch (\Exception $e){
        dd($e);
        return back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
    }//ends try catch.
    }//ends function storeSideEstimateCalculatorDownspout.
    public function storeChimneyEstimateCalculatorChimney(Request $request){
        extract($request->all());
        try {
            if($chimney_estimate_calculator_id != null || $chimney_estimate_calculator_id != '') {
            StoreChimneyEstimateCalculatorChimney::updateOrCreate(['chimney_estimate_calculator_id' => $chimney_estimate_calculator_id],$request->all());
            return response()->json(['success' => 'Chimney Estimate Calculator Chimney Added Successfully']);
            }else{
                return response()->json(['error' => 'Chimney Estimate Calculator Chimney Not Found']);
            }

        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }
    public function storeChimneyEstimateCalculatorLiner(Request $request){
        extract($request->all());
        try {
            if($chimney_estimate_calculator_id != null || $chimney_estimate_calculator_id != '') {
            StoreChimneyEstimateCalculatorLiner::updateOrCreate(['chimney_estimate_calculator_id' => $chimney_estimate_calculator_id],$request->all());
            return response()->json(['success' => 'Chimney Estimate Calculator Liner Added Successfully']);
            }else{
                return response()->json(['error' => 'Chimney Estimate Calculator Chimney Not Found']);
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }//ends try catch.
    }
    public function storeProductPricingCalculatorMaterialList(Request $request){
//        return $request->all();
        extract($request->all());
        try {
            $product_pricing_calculator_id = $request->product_pricing_calculator_id;
//            foreach ($name as $product_name => $data) {
//                if (isset($data['unit']) && isset($data['quantity'])) {
//                    for ($i = 0; $i < count($data['unit']); $i++) {
//                        StoreProductPricingMaterialList::updateOrCreate(
//                            [
//                                'product_pricing_calculator_id' => $product_pricing_calculator_id,
//                                'name' => $product_name,
//                            ],
//                            [
//                                'unit' => $data['unit'][$i],
//                                'quantity' => $data['quantity'][$i],
//                            ]
//                        );
//                    }
//                }
//            }
            foreach ($name as $product_name => $data) {
                if (isset($data['unit']) && isset($data['quantity'])) {
                    for ($i = 0; $i < count($data['unit']); $i++) {
                        $materialList = StoreProductPricingMaterialList::updateOrCreate(
                            [
                                'product_pricing_calculator_id' => $product_pricing_calculator_id,
                                'name' => $product_name,
                            ],
                            [
                                'unit' => $data['unit'][$i],
                                'quantity' => $data['quantity'][$i] ?? 0,
                            ]
                        );
                    }
                }
            }
//            foreach ($name as $product_name => $data) {
//                if (isset($data['unit']) && isset($data['value'])) {
//                    for ($i = 0; $i < count($data['unit']); $i++) {
//            if (!empty($data['unit'][$i]) || !empty($data['value'][$i])) {
//                ProductMaterialSection::create([
//                    'product_pricing_calculator_id' => $product_pricing_calculator_id,
//                    'material_list_id' => $product_name,
//                    'name' =>  $data['value'][$i],
//                    'unit' => $data['unit'][$i],
//                ]);
//            }
//            }
//            }
//            }
            foreach ($name as $product_name => $data) {
                ProductMaterialSection::where('product_pricing_calculator_id', $product_pricing_calculator_id)
                    ->where('material_list_id', $product_name)
                    ->delete();
                if (!empty($data['unit']) && !empty($data['value'])) {
                    foreach ($data['unit'] as $i => $unit) {
                        if (!empty($unit) || !empty($data['value'][$i])) {
                            ProductMaterialSection::create([
                                'product_pricing_calculator_id' => $product_pricing_calculator_id,
                                'material_list_id' => $product_name,
                                'name' => $data['value'][$i],
                                'unit' => $unit,
                            ]);
                        }
                    }
                }
            }
            return back()->with(['success' => 'Product Pricing Calculator Added Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeProducPricingEstimateCalculator(Request  $request){
        try {
//            return $request->all();
            extract($request->all());
            if ($product_pricing_calculator_id == 0){
                $productPricingEstimateCalculator = ProductPricingEstimateCalculator::create([
                    'lead_id' => $lead_id ?? NULL,
                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'guards_sub_total' => $guards_sub_total ?? NULL,
                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'note' => $note ?? NULL,
                ]);
                if (!empty($labels)){
                    foreach ($labels as $section => $data){
                        ProductPricingEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'product_pricing_calculator_id' => $productPricingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($skylight)) {
                    foreach ($skylight as $section => $data) {
                        foreach ($data['quantity'] as $index => $quantity) {
                            ProductPriceSkylight::create([
                                    'size' => $data['size'][$index] ?? NULL,
                                    'quantity' => $quantity ?? NULL,
                                    'price' => $data['price'][$index] ?? NULL,
                                    'product_price_calculator_id' => $productPricingEstimateCalculator->id ?? NULL,
                                ]);
                        }
                    }
                }
                if (!empty($eave_rakes)) {
                    foreach ($eave_rakes as $section => $data) {
                        ProductPricingEstimateCalculatorEaveRake::create([
                            'section' => $section,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'eave_final_rakes_total' => $data['eave_final_rakes_total'][0] ?? NULL,
                            'product_pricing_calculator_id' => $productPricingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($flat_area)) {
                    foreach ($flat_area as $section => $data) {
                        ProductPricingEstimateCalculatorFlatArea::create([
                            'section' => $section ,
                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_rakes_total' => $data['eave_rakes_total'][0] ?? NULL,
                            'product_pricing_calculator_id' => $productPricingEstimateCalculator->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        ProductPricingEstimateCalculatorDownspout::create([
                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards'     => $downspouts['guards'][$i] ?? NULL,
                            'product_pricing_calculator_id' => $productPricingEstimateCalculator->id ?? NULL,
                        ]);//emds create.
                    }//ends for.
                }//ends if.

            }else{
                $product_pricing_id = ProductPricingEstimateCalculator::find($product_pricing_calculator_id);
                ProductPricingEstimateCalculator::where('id',$product_pricing_id->id)->update([
                    'lead_id' => $lead_id ?? NULL,
                    'eave_rakes_sub_total' => $eave_rakes_sub_total ?? NULL,
                    'eave_rakes_waste' => $eave_rakes_waste ?? NULL,
                    'eave_rakes_total_waste' => $eave_rakes_total_waste ?? NULL,
                    'eave_rakes_total' => $eave_rakes_total ?? NULL,
                    'eave_rakes_total_percent' => $eave_rakes_total_percent ?? NULL,
                    'eave_rakes_flat_area_sub_total' => $eave_rakes_flat_area_sub_total ?? NULL,
                    'eave_rakes_flat_area_waste' => $eave_rakes_flat_area_waste ?? NULL,
                    'eave_rakes_total_flat_area_waste' => $eave_rakes_total_flat_area_waste ?? NULL,
                    'eave_rakes_flat_area_total' => $eave_rakes_flat_area_total ?? NULL,
                    'gutter_sub_total' => $gutter_sub_total ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'guards_sub_total' => $guards_sub_total ?? NULL,
                    'total_all_downspouts' => $total_all_downspouts ?? NULL,
                    'downspout_sub_total' => $downspout_sub_total ?? NULL,
                    'note' => $note ?? NULL,
                ]);
                if (!empty($skylight) && is_array($skylight)) {
                    ProductPriceSkylight::where('product_price_calculator_id', $product_pricing_id->id)->delete();
                    foreach ($skylight as $section => $data) {
                        if (isset($data['quantity']) && is_array($data['quantity'])) {
                            foreach ($data['quantity'] as $index => $quantity) {
                                ProductPriceSkylight::create([
                                    'size' => $data['size'][$index] ?? NULL,
                                    'quantity' => $quantity ?? NULL,
                                    'price' => $data['price'][$index] ?? NULL,
                                    'product_price_calculator_id' => $product_pricing_id->id ?? NULL,
                                ]);
                            }
                        }
                    }
                }
                if (!empty($labels)){
                    ProductPricingEstimateCalculatorLabel::where('product_pricing_calculator_id',$product_pricing_id->id)->delete();
                    foreach ($labels as $section => $data){
                        ProductPricingEstimateCalculatorLabel::create([
                            'section' => $section ?? NULL,
                            'name' => $data['name'] ?? NULL,
                            'value' => $data['value'] ?? NULL,
                            'product_pricing_calculator_id' => $product_pricing_id->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($eave_rakes)) {
                    ProductPricingEstimateCalculatorEaveRake::where('product_pricing_calculator_id',$product_pricing_id->id)->delete();
                    foreach ($eave_rakes as $section => $data) {
                        ProductPricingEstimateCalculatorEaveRake::create([
                            'section' => $section,
                            'eave' => $data['eave'][0] ?? NULL,  // Taking the first element as a sample
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_final_rakes' => $data['eave_final_rakes'][0] ?? NULL,
                            'eave_final_rakes_total' => $data['eave_final_rakes_total'][0] ?? NULL,
                            'product_pricing_calculator_id' => $product_pricing_id->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($flat_area)) {
                    ProductPricingEstimateCalculatorFlatArea::where('product_pricing_calculator_id',$product_pricing_id->id)->delete();
                    foreach ($flat_area as $section => $data) {
                        ProductPricingEstimateCalculatorFlatArea::create([
                            'section' => $section,
                            'eave' => $data['eave'][0] ?? NULL,
                            'rakes' => $data['rakes'][0] ?? NULL,
                            'eave_rakes_total' => $data['eave_rakes_total'][0] ?? NULL,
                            'product_pricing_calculator_id' => $product_pricing_id->id ?? NULL,
                        ]);//ends create.
                    }//ends foreach.
                }//ends if.
                if (!empty($downspouts['downspouts']) && !empty($downspouts['gutters']) && !empty($downspouts['guards'])) {
                    ProductPricingEstimateCalculatorDownspout::where('product_pricing_calculator_id',$product_pricing_id->id)->delete();
                    $length = count($downspouts['downspouts']);
                    for ($i = 0; $i < $length; $i++) {
                        ProductPricingEstimateCalculatorDownspout::create([
                            'gutters'    => $downspouts['gutters'][$i] ?? NULL,
                            'downspouts' => $downspouts['downspouts'][$i] ?? NULL,
                            'guards'     => $downspouts['guards'][$i] ?? NULL,
                            'product_pricing_calculator_id' => $product_pricing_id->id ?? NULL,
                        ]);//ends create.
                    }//ends for.
                }//ends if.
            }//ends else if.
            if (!isset($roof_estimated)){
                return redirect('product_pricing_calculator/'.$lead_id)->with('message', 'Product Pricing Estimation Calculator Added Successfully');
            }else{
                return redirect('productPricingEstimateCalculator/roof-estimate-calculator/')->with('message','Product Pricing Estimation Calculator Updated Successfully');
            }//ends if.
        }catch (\Exception $e){
            dd($e);
            return back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
        }//ends try catch.
    }//ends function storeProducPricingEstimateCalculator.

    public function storeProductPricingCalculatorPriceList(Request $request){
//        return $request->all();
        extract($request->all());
        $productPriceList = ProductPricingPriceList::updateOrCreate(['product_pricing_calculator_id' => $product_pricing_calculator_id], [
            'product_pricing_calculator_id' => $product_pricing_calculator_id,
            'estimated_total' => $estimated_total,
        ]);
        foreach ($request->quantity as $category => $quantities) {
            foreach ($quantities as $index => $quantity) {
                StoreProductPricingPriceList::where('product_pricing_price_list_id', $product_pricing_price_list_id)->updateOrCreate(
                    [
                        'product_pricing_price_list_id' => $product_pricing_price_list_id ?? null,
                        'name' => $category,
                    ],
                    [
                        'name' => $category,
                        'quantity' => $quantity ?? null,
                        'price' => $price[$category][$index] ?? null,
                        'ext_price' => $ext_price[$category][$index] ?? null,
                        'product_pricing_price_list_id' => $productPriceList->id ?? null,
                    ]
                );
            }
        }
        return back();
    }//ends function storeProductPricingEstimateCalculatorMaterialList.
    public function storeProductPricingCalculatorPdfMeasurement(Request $request){
//        return $request->all();
        extract($request->all());
        $product_pdf_measurement = ProductPricePdfMeasurement::updateOrCreate(['product_pricing_calculator_id' => $product_pricing_calculator_id], [
            'product_pricing_calculator_id' => $product_pricing_calculator_id,
            'total_area' => $total_area,
            'total_square_ft' => $total_square_ft,
            'note' => $note,
        ]);
        foreach ($name as $index => $name) {
            ProductPricePdfTotal::updateOrCreate(['product_price_pdf_measurement_id' => $product_price_pdf_measurement_id, 'name' => $name],
                [
                    'name' => $name,
                    'value' => $value[$index] ?? null,
                    'product_price_pdf_measurement_id' => $product_pdf_measurement->id ?? null,
                ]);
        }
        $fields = ['pitch', 'area', 'square', 'waste'];
        foreach ($fields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                foreach ($data[$field] as $index => $value) {
                    ProductPricePdfAreaPitch::updateOrCreate(['product_price_pdf_measurement_id' => $product_price_pdf_measurement_id, 'name' => $field, 'index' => $index],
                        [
                            'name' => $field,
                            'value' => $value,
                            'product_price_pdf_measurement_id' => $product_pdf_measurement->id,
                            'index' => $index,
                        ]
                    );
                }
            }
        }
        return back()->with('message', 'Product Pricing Calculator Pdf Measurement Added Successfully');
    }//ends function storeProductPricingCalculatorPdfMeasurement.
    public function productPdfMaterialList(Request $request){
//        return $request->all();
        extract($request->all());
        foreach ($product['name'] as $index => $name) {
            ProductPdfMaterialList::updateOrCreate(['name' => $name, 'product_price_pdf_measurement_id' => $product_price_pdf_measurement_id],
                [
                'name' => $name,
                'unit' => $product['unit'][$index],
                'quantity' => $product['quantity'][$index],
                'product_price_pdf_measurement_id' => $product_price_pdf_measurement_id,
            ]);
        }
        return back()->with('message', 'Product Pdf Material List Added Successfully');
    }
    public function storeProgressBoard(Request $request){
        extract($request->all());
        $progressBoard = ProgressBoard::updateOrCreate(['lead_id' => $lead_id, 'name' => $name,],
            [
                'lead_id' => $lead_id ?? NULL,
                'name' => $name ?? NULL,
                'date' => $date ?? NULL,
                'mark_as_done' => $mark_as_done ?? NULL,
                'description' => $description ?? NULL,
            ]
        );
        return back()->with('message','Progress Board Updated Successfully');
    }
    public function storeProgressBoardTask(Request $request){
        extract($request->all());
        $task =  Task::create(
            [
            'title' => $title??"",
            'priority_id' => $priority_id??"null",
            'due_date' => $due_date??"null",
            'assign_to_lead_id' => $lead_id??"null",
            'description' => $description??"null",
            'progress_name' => $progress_name??"null",
            'assign_to_team_id' => $assign_to_team_id??"null",
            'created_by' => auth()->id()??'',
        ]);
        if (!empty($assign_to_user_id)) {
            foreach($assign_to_user_id as $key => $value) {
                TaskAssignUser::create([
                    'task_id'   => $task->id,
                    'user_id'   => $value,
                ]);
            }//endforeach
        }//end if.
        if ($request->task_attachment!='') {
            foreach(explode(',',$request->task_attachment) as $key=>$value){
                TaskAttachment::create([
                    'task_id' => $task->id,
                    'name'    => $value
                ]);
            }//end foreach.
        }
        return back()->with('message','Progress Board Task Updated Successfully');
    }
        public function updateProgressBoardColor(Request $request){
//        return $request->all();
        extract($request->all());
            $progressBoardColor = ProgressBoard::updateOrCreate(['lead_id' => $lead_id, 'name' => $name],
                [
                    'color' => $color ?? NULL,
                ]);
            return back()->with('message', 'Progress Board Color Updated Successfully');
        }
//        if (isset($task) && !empty($task)) {
//            Notification::create([
//                'lead_id' => $task->assign_to_lead_id,
//                'model' => 'Task Create',
//                'title' => $task->title,
//                'time' => $task->created_at,
//            ]);
//        }//ends if.

}//ends class LeadController.

