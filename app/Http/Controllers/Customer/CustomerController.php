<?php

namespace App\Http\Controllers\Customer;

use App\Appointment;
use App\Category;
use App\ChatMessage;
use App\CogsMaterial;
use App\ControlPanel;
use App\CostOfGoodSold;
use App\CustomerOwnerType;
use App\CustomerReferral;
use App\EmailTemplateFolder;
use App\FolderManagement;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LeadMail;
use App\Mark;
use App\Message;
use App\PaymentType;
use App\PhotoAndDocument;
use App\Priority;
use App\Product;
use App\ProductCategory;
use App\ProposalTemplate;
use App\Team;
use App\YearEstimation;
use App\Customer;
use App\Lead;
use App\LeadStage;
use App\Notification;
use App\Stage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\CustomerType;
use App\ReferralSource;
use App\Profile;
use App\CustomerPhone;
use App\Role;
use App\EmailTemplate;
use App\ChangeOrder;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
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
        $model = str_slug('customer', '-');
        $yearEstimation = YearEstimation::where('status',1)->first();
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 25;
            if (!empty($keyword)) {
                $customer = User::whereHas(
                    'roles', function ($q) {
                    $q->where('name', 'customer');
                }
                )->where('customer_type_id', 'LIKE', "%$keyword%")
                    ->orWhere('salesman_id', 'LIKE', "%$keyword%")
                    ->orWhere('referral_source_id', 'LIKE', "%$keyword%")
                    ->orWhere('call_center_representative_id', 'LIKE', "%$keyword%")
                    ->orWhere('first_name', 'LIKE', "%$keyword%")
                    ->orWhere('last_name', 'LIKE', "%$keyword%")
                    ->orWhere('company', 'LIKE', "%$keyword%")
                    ->orWhere('secondary_first_name', 'LIKE', "%$keyword%")
                    ->orWhere('secondary_last_name', 'LIKE', "%$keyword%")
                    ->orWhere('referred_by_note', 'LIKE', "%$keyword%")
                    ->orWhere('custom', 'LIKE', "%$keyword%")
                    ->orWhere('customer_note', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->orderBy('id', 'DESC')
                    ->paginate($perPage);
            } else {
                $customersQuery = User::query()->whereHas('roles', function ($q) {
                    $q->where('name', 'customer');
                });
                if ($request->customer_filter == 'yes') {
                    $customersQuery->whereBetween('created_at', [$request->duration_starts, $request->duration_ends]);
                } else {
                    $customersQuery->orderBy('id', 'DESC');
                }//ends if condition.
                $customer = $customersQuery->get();
                $emailTemplates = EmailTemplate::get();
                return view('customer.customer.index', compact('customer', 'emailTemplates','yearEstimation'));
            }//ends if condition.
            return response(view('403'), 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $customerTypes = CustomerType::get();
            $roles = Role::whereNotIn('name',['admin','outsideowner'])->with('permissions')->orderBy('id','DESC')->get();
            $isCreate = true;
            $referralSources = ReferralSource::get();
            $categories = Category::wherestatus(1)->get();
            $saleMen = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','customer');})->get();
            $customers = User::whereHas('roles', function($q){$q->where('name', 'customer');})->get();
            $yearEstimation = YearEstimation::where('status',1)->first();
            $customerOwnerTypes = CustomerOwnerType::whereStatus('1')->get();

            if ($yearEstimation) {
                $createdYear = now()->format('y');
                $monthThisYear = now()->format('m');
                $date = now()->format('d');

                $leadsCount = Lead::whereYear('lead_status_date', $yearEstimation->year)
                        ->count() + 1;

                $customerLeadCount = 1;

                $CustomerCount = User::withTrashed()->whereYear('created_at', $yearEstimation->year)->count() + 1;

                $leadNumber = 'L' . $createdYear . '-' . $monthThisYear . $date . '-' . $leadsCount . '-' . $customerLeadCount;
                $customerNumber = $createdYear . '-' . $monthThisYear . $date . '-' . $CustomerCount;
            }

            if($request->referral){
                $referral = CustomerReferral::where('id', $request->referral)->first();
            }
            else{
                $referral = null;
            }

            return view('customer.customer.create',compact('isCreate','categories','customerTypes','roles', 'referralSources', 'saleMen','yearEstimation', 'customers', 'customerOwnerTypes', 'leadNumber', 'customerNumber', 'referral'));
        }
        return response(view('403'), 403);
    }//ends function create

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

//    public function store(Request $request){
//        $model = str_slug('customer','-');
//        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first() != null) {
//            extract($request->all());
//            DB::beginTransaction();
//            $password = str_random(8);
//            $user = User::create([
//                    'first_name'            => $first_name,
//                    'last_name'             =>$last_name,
//                    'name'                  =>$first_name.' '.$last_name,
//                    'company'               =>$company ?? null,
//                    'customer_type_id'      =>$customer_type_id,
//                    'salesman_id'           =>$salesman_id,
//                    'referral_source_id'    =>$referral_source_id,
//                    'reference_customer_id' =>$reference_customer_id ?? null,
//                    'email'                 => isset($email) ? $email : $first_name . time() . "@yopmail.com",
//                    'password'              =>bcrypt($password),
//                    'created_by'            => auth()->id(),
//                    'created_at'            => $request->has('customer_date')
//                    ? Carbon::parse($request->input('customer_date'))->format('Y-m-d') . ' ' . now()->format('H:i:s')
//                    : now()->format('Y-m-d H:i:s'),]);
//            if($request->signature_type === 'signature_file') {
//                $signature = $this->storeImage('customer_signature', $request->signature);
//            }elseif ($request->signature_type === 'signature_pad') {
//                $signature = $request->signature;
//            }//ends if condition.
//            $profile = Profile::create([
//                'user_id'           => $user->id,
//                'address'           => $request->address,
//                'city'              => $request->city,
//                'state'             => $request->state,
//                'country'           => $request->country,
//                'zip'               => $request->zip,
//                'longitude'         => $request->longitude ??'',
//                'latitude'          => $request->latitude ?? '',
//                'signature_type'    => $request->signature_type,
//                'upload_signature'  => isset($signature) ?  $signature : null,
//                'notes'             => $request->notes ?? null,
//                'customer_owner_type_id'     => $request->customer_owner_type_id ?? null,
////                'category_id'    => $request->user_category_id ?? '',
//            ]);//ends create profile.
//            if ($request->phone != null){
//                foreach ($request->phone as $key => $item) {
//                    $formattedNumber =  str_replace(['(', ')', '-', ' '], '', $item);
//                    CustomerPhone::create([
//                        'customer_id' => $user->id,
//                        'phone'       => $formattedNumber
//                    ]);
//                }//end foreach.
//            }//end second if condition.
//            $role = Role::find(6);
//            $user->assignRole($role->name);
////            if ($request->title != null && $request->lead_price != null && $request->lead_date != null){
//            if ($request->title != null && $request->lead_date != null){
////                    if (isset($request->lead_price)) {
////                        $formattedPrice = str_replace(',', '', $request->lead_price);
////                        $request->lead_price = (int) $formattedPrice;
////                    }//ends if condition.
//                    $lead = Lead::create([
//                            'title'             => $request->title ?? null,
//                            'description'       => $request->description ?? null,
//                            'customer_id'       => $user->id ?? null,
//                            'category_id'       => $request->category_id ?? null,
//                            'representative_id' => $request->representative_id ?? null,
//                            'lead_number'       => $request->lead_number ?? null,
//                            'project_price'     => $request->project_price ?? 0,
//                            'minimum_days'      => $request->minimum_days ?? 0,
//                            'maximum_days'      => $request->maximum_days ?? 0,
//                            'duration_minutes'  => $request->duration_minutes ?? null,
//                            'address'           => $profile->address ?? null,
//                            'latitude'          => $profile->latitude ?? null,
//                            'longitude'         => $profile->longitude ?? null,
//                            'contact_person'    => $request->contact_person ?? null,
//                            'other_information' => $request->other_information ?? null,
//                            'lead_price'        => $request->lead_price ?? null,
//                            'lead_date'         => $request->lead_date ?? null,
//                            'lead_status_date'         => $request->lead_date ?? now(),
//                            'created_by'        => auth()->id(),
//                    ]);
//                    $stages = Stage::get();
//                    $date = now()->format('Y-m-d');
//                    if ($stages != null){
//                        foreach ($stages as $stage){
//                            LeadStage::create([
//                                'lead_id'  => $lead->id,
//                                'stage_id' => $stage->id,
//                                'date'     => $date,
//                                'position' => $stage->position,
//                                'status'   => $stage->status,
//                            ]);//ends create.
//                        }//ends foreach.
//                    }//ends if condition.
//                    if (isset($lead) && !empty($lead)) {
//                        Notification::create([
//                            'lead_id' =>  $lead->id,
//                            'model'   => 'Lead Created',
//                            'title'   => 'Lead created name<b>' . $lead->title . '</b> by ',
//                            'icon'    => 'fa-solid fa-file-image',
//                            'time'    => $lead->updated_at,
//                            'user_id' => auth()->user()->id,
//                        ]);
//                    }//ends if.
//                DB::commit();
//                try {
//                    $client = new \GuzzleHttp\Client();
//                    $requestBody = [
//                        'name' =>  $lead->title ??'',
//                        'address' => [
//                            'street_address_1' => strlen($lead->address) > 100 ? substr($lead->address, 0, 97) . '...' : $lead->address,
//                            'city' => $lead->city ?? 'Città Metropolitana di Milano',
//                            'state' => $lead->state ?? 'Lombardia',
//                            'postal_code' => $lead->postal_code ??  '20126',
//                            'country' => $lead->country ?? 'Italy'
//                        ],
//                        'coordinates' => [
//                            'lat' => $lead->latitude  ?? '28.425852468018288',
//                            'lon' => $lead->longitude ?? '-81.47155671113255'
//                        ],
//                        'geofence' => [
//                            ['lat' => 28.425852468018288, 'lon' => -81.47155671113255],
//                            ['lat' => 18.425852468018288, 'lon' => -81.47155671113255],
//                            ['lat' => 8.425852468018288,  'lon' => -91.47155671113255],
//                            ['lat' => 28.425852468018288, 'lon' => -101.47155671113255]
//                        ],
//                        'primary_contact' => [
//                            'name' => $lead->customer->name ?? 'Joe Smith',
//                            'email' => $lead->customer->email ?? 'joe.smith@companycam.com',
//                            'phone_number' => $lead->customer->customerPhones->first()->phone ?? '123-456-7890'
//                        ]
//                    ];
//                    $body = json_encode($requestBody);
//                    $response = $client->request('POST', env('STORE_LEAD_COMPANY_CAMP'), [
//                        'body' => $body,
//                        'headers' => [
//                            'Accept' => 'application/json',
//                            'Authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
//                            'Content-Type' => 'application/json',
//                        ],
//                    ]);
//                    $responseBody = json_decode($response->getBody(), true);
//                    $lead->update(['company_camp_id' => $responseBody['id']]);
//                } catch (\Exception $e) {
//
//                }//ends try catch.
//            }//ends if condition.
//            try { $this->sendWelcomeEmailWithLoginDetails($user, $password); }catch (\Exception $e) {}//ends try catch.
//            if ($request->title != null && $request->lead_date != null){
//                return redirect('view_lead/' . $lead->id)->with('flash_message', 'Lead and Customer added!');
//            }
//            return redirect('customer/customer')->with('flash_message', 'Customer added!');
//        }//ends if condition.
//        return response(view('403'), 403);
//    }//ends function store

    public function store(Request $request)
    {
//        return $request->all();
        $model = str_slug('customer', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            extract($request->all());
            DB::beginTransaction();
            try {
                $password = str_random(8);
                $user = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'name' => $first_name . ' ' . $last_name,
                    'company' => $company ?? null,
                    'customer_type_id' => $customer_type_id,
                    'salesman_id' => $salesman_id,
                    'referral_source_id' => $referral_source_id,
                    'reference_customer_id' => $reference_customer_id ?? null,
                    'email' => isset($email) ? $email : $first_name . time() . "@yopmail.com",
                    'password' => bcrypt($password),
                    'created_by' => auth()->id(),
                    // 'created_at' => $request->has('customer_date') ? Carbon::createFromFormat('d/m/Y', $request->input('customer_date'))->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
                    'created_at' => $request->has('customer_date') && !empty($request->input('customer_date')) ? Carbon::createFromFormat('m/d/Y', $request->input('customer_date'))->setTime(now()->hour, now()->minute, now()->second)->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),

                ]);

                if ($request->signature_type === 'signature_file') {
                    $signature = $this->storeImage('customer_signature', $request->signature);
                } elseif ($request->signature_type === 'signature_pad') {
                    $signature = $request->signature;
                }

                $profile = Profile::create([
                    'user_id' => $user->id,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'zip' => $request->zip,
                    'longitude' => $request->longitude ?? '',
                    'latitude' => $request->latitude ?? '',
                    'signature_type' => $request->signature_type,
                    'upload_signature' => isset($signature) ? $signature : null,
                    'notes' => $request->notes ?? null,
                    'customer_owner_type_id' => $request->customer_owner_type_id ?? null,
                    'customer_number' => $request->customer_number ?? null,
                ]);
                if ($request->phone != null) {
                    foreach ($request->phone as $key => $item) {
                        $formattedNumber = str_replace(['(', ')', '-', ' '], '', $item);
                        CustomerPhone::create([
                            'customer_id' => $user->id,
                            'phone' => $formattedNumber
                        ]);
                    }
                }
                $role = Role::find(6);
                $user->assignRole($role->name);
                if ($request->title != null && $request->lead_date != null) {
                    $lead = Lead::create([
                        'title' => $request->title ?? null,
                        'description' => $request->description ?? null,
                        'customer_id' => $user->id ?? null,
                        'category_id' => $request->category_id ?? null,
                        'representative_id' => $request->representative_id ?? null,
                        'lead_number' => $request->lead_number ?? null,
                        'project_price' => $request->project_price ?? 0,
                        'minimum_days' => $request->minimum_days ?? 0,
                        'maximum_days' => $request->maximum_days ?? 0,
                        'duration_minutes' => $request->duration_minutes ?? null,
                        'address' => $request->has('lead_address') ? $request->lead_address : ($profile->address ?? null),
                        'latitude' => $profile->latitude ?? null,
                        'longitude' => $profile->longitude ?? null,
                        'contact_person' => $request->contact_person ?? null,
                        'other_information' => $request->other_information ?? null,
                        'lead_price' => $request->lead_price ?? null,
                        'lead_date' => $request->has('lead_date')
                            ? Carbon::createFromFormat('m/d/Y', $request->lead_date)->format('Y-m-d')
                            : null,
                        'lead_status_date' => $request->has('lead_date')
                            ? Carbon::createFromFormat('m/d/Y', $request->lead_date)->format('Y-m-d')
                            : now(),
//                        'lead_status_date' => $request->lead_date ?? now(),
                        'created_by' => auth()->id(),
                    ]);


                    $stages = Stage::get();
                    $date = now()->format('Y-m-d');
                    if ($stages != null) {
                        foreach ($stages as $stage) {
                            LeadStage::create([
                                'lead_id' => $lead->id,
                                'stage_id' => $stage->id,
                                'date' => $date,
                                'position' => $stage->position,
                                'status' => $stage->status,
                            ]);
                        }
                    }

                    if (isset($lead) && !empty($lead)) {
                        Notification::create([
                            'lead_id' => $lead->id,
                            'model' => 'Lead Created',
                            'title' => 'Lead created name<b>' . $lead->title . '</b> by ',
                            'icon' => 'fa-solid fa-file-image',
                            'time' => $lead->updated_at,
                            'user_id' => auth()->user()->id,
                        ]);
                    }

                    $subject = 'Lead Assigned';
                    $staff = User::where('id', $user->id)->first();
                    $rep = User::where('id', $request->representative_id)->first();
                    $leadUrl = env('APP_URL') . "/view_lead/{$lead->id}";

                    $emailData = [
                        'staffName' => $staff->name,
                        'categoryName' => $lead->category->name,
                        'leadUrl' => $leadUrl,
                        'lead' => $lead
                    ];

                    // Send to Job Rep
                    Mail::send('lead.lead.emails.lead_assignment_user', $emailData, function($message) use ($rep, $subject) {
                        $message->to($rep->email)
                            ->subject($subject);
                    });

                    // Send to Customer
                    $emailData['staffName'] = $rep->name;
                    Mail::send('lead.lead.emails.lead_assignment_customer', $emailData, function($message) use ($staff, $subject) {
                        $message->to($staff->email)
                            ->subject($subject);
                    });

                }
                DB::commit();
                $control = ControlPanel::where('module', 'Customer Email')->first();
                try {
                    if($control->status == 'active'){
                        $this->sendWelcomeEmailWithLoginDetails($user, $password);
                    }
                } catch (\Exception $e) {
                }
                if ($request->title != null && $request->lead_date != null) {
                    return redirect('view_lead/' . $lead->id)->with('flash_message', 'Lead and Customer added!');
                }
                return redirect('customer/customer')->with('flash_message', 'Customer added!');
            } catch (\Exception $e) {
                DB::rollBack();
                abort(500);
                return response()->json($e);
//                return response(view('403'), 403);
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
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
             $customer = User::with('customerLeads')->findOrFail($id);
//             $customer_pending_price = $customer->customerLeads->where('lead_status', 'pending')->sum('lead_price');
//             $customer_won_price = $customer->customerLeads->where('lead_status', 'won')->sum('lead_price');
//             $customer_lost_price = $customer->customerLeads->where('lead_status', 'lost')->sum('lead_price');
            $customer_pending_price = $customer->customerLeads->where('lead_status', 'pending')->sum(function ($lead) {
                $changeOrderSum = ChangeOrder::where('lead_id', $lead->id)
                    ->where('status', 'approved')
                    ->sum('total_amount');
                $leadPrice = is_numeric($lead->lead_price) ? (float) $lead->lead_price : 0;
                $changeOrderPrice = is_numeric($changeOrderSum) ? (float) $changeOrderSum : 0;
                return $leadPrice + $changeOrderPrice;
            });
            $customer_won_price = $customer->customerLeads->where('lead_status', 'won')->sum(function ($lead) {
                $changeOrderSum = ChangeOrder::where('lead_id', $lead->id)
                    ->where('status', 'approved')
                    ->sum('total_amount');
                $leadPrice = is_numeric($lead->lead_price) ? (float) $lead->lead_price : 0;
                $changeOrderPrice = is_numeric($changeOrderSum) ? (float) $changeOrderSum : 0;
                return $leadPrice + $changeOrderPrice;
            });
            $customer_lost_price = $customer->customerLeads->where('lead_status', 'lost')->sum(function ($lead) {
                $changeOrderSum = ChangeOrder::where('lead_id', $lead->id)
                    ->where('status', 'approved')
                    ->sum('total_amount');
                $leadPrice = is_numeric($lead->lead_price) ? (float) $lead->lead_price : 0;
                $changeOrderPrice = is_numeric($changeOrderSum) ? (float) $changeOrderSum : 0;
                return $leadPrice + $changeOrderPrice;
            });
            return view('customer.customer.show', compact('customer', 'customer_won_price', 'customer_lost_price', 'customer_pending_price'));
        }//end if condition.
        return response(view('403'), 403);
    }//ends function show

    public function userView(Request $request){
        $model = str_slug('customer','-');
        $perPage = 24;
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            $lead = Lead::with('getAppointment')->get();
            $appointment_count = Appointment::count();
            $sold_lead_count = $lead->where('lead_status', 'won')->count();
            $sold_leads = $lead->where('lead_status', 'won')->whereNotNull('lead_price')->where('lead_price', '!=', '')->sum('lead_price');
            $customersQuery = User::query();
            $customersQuery->whereHas('roles', function ($q) {
                $q->where('name', 'customer');
            });
            if ($request->customer_filter == 'yes') {
                $customersQuery->whereBetween('created_at', [$request->duration_starts, $request->duration_ends]);
            }
            if ($request->filled('search')) {
                $searchTerm = '%' . $request->search . '%';
                $customersQuery->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', $searchTerm);
                });
            }
            $customers = $customersQuery->orderBy('id', 'DESC')->paginate($perPage);
            if ($request->ajax()) {
                return response()->json([
                    'customers' => $customers->items(),
                    'pagination_html' => $customers->appends($request->except('page'))->links()->toHtml()
                ]);
            }
            return view('customer.customer.user_view', compact('customers', 'lead', 'sold_leads', 'sold_lead_count', 'appointment_count', 'yearEstimation'));
        }//end if condition.
        return response(view('403'), 403);
    }//ends function show

    public function customerOnboarding(Request $request)
    {
        $model = str_slug('customer', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $yearEstimation = YearEstimation::whereStatus('1')->first();
            $customersQuery = User::query();
            $customersQuery->whereHas('roles', function ($q) {
                $q->where('name', 'customer');
            });
            $customers=$customersQuery->orderBy('id', 'DESC')->get();
            return view('customer.customer.customer_onboarding', compact('customers','yearEstimation'));
        }
        return response(view('403'), 403);
    }

    public function sendWelcomeEmailToCustomers(Request $request)
    {
        $customerIds = $request->customer_ids;
        $subject = $request->subject;
        $description = $request->description;

        if (empty($customerIds) || empty($subject) || empty($description)) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields: customer IDs, subject, or description.'
            ]);
        }

        $successCount = 0;
        $failedCount = 0;
        $processedEmails = [];

        foreach ($customerIds as $customerId) {
            $customer = User::find($customerId);

//            if (!$customer || !$customer->email || in_array($customer->email, $processedEmails)) {
//                $failedCount++;
//                continue;
//            }

//            $processedEmails[] = $customer->email;

            // Update status
            $customer->status = 1;
            $customer->save();

            $emailData = [
                'customer_name' => $customer->first_name . ' ' . $customer->last_name,
                'subject' => $subject,
                'description' => $description,
                'company_name' => env('APP_NAME', 'LeadUp'),
            ];

            try {
                Mail::send('customer.customer.email.welcome_email', $emailData, function ($message) use ($customer, $subject) {
                    $message->to($customer->email)->subject($subject);
                });
                $successCount++;
            } catch (\Exception $e) {
                return $e->getMessage();
                $failedCount++;
            }
        }

        return response()->json([
            'success' => $successCount > 0,
            'message' => $successCount > 0
                ? "Welcome emails sent successfully to {$successCount} customer(s)." . ($failedCount > 0 ? " {$failedCount} email(s) failed to send." : "")
                : "Failed to send welcome emails to any customers."
        ]);
    }

    public function indexNew()
    {
        return view('dashboard.customerDashboard.index-new');
    }
    public function customerIndex()
    {
        return view('dashboard.customerDashboard.customer-index');
    }
    public function roofMeasurement($id)
    {
        $lead = Lead::findOrFail($id);
        return view('dashboard.customerDashboard.roof_measurement', compact('lead'));
    }
    public function customerChat()
    {
        $leads = Lead::where('customer_id', auth()->user()->id)
            ->with(['chatMessages' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->get();
        return view('dashboard.customerDashboard.customer-chat', compact('leads'));
    }
//    public function customerManagement()
//    {
//        return view('customer.customer.customer-management');
//    }
    public function customerManagement(Request $request, $id)
    {
        if (!$id || !Lead::find($id)) {
            return redirect(url('lead_card_view?lead_card_view_status=unarchive'));
        }
        $leadMails = LeadMail::where('lead_id', $id)->orderBy('id', 'desc')->get();
        $messages = Message::where('lead_id', $id)->orderBy('id', 'desc')->get();
        $paymenttypes = PaymentType::whereStatus('1')->orderBy('id', 'desc')->get();
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'staff')->where('name', '!=', 'customer')->where('name', '!=', 'admin')->where('name', '!=', 'user');
        })->orderBy('created_at', 'desc')->get();
        $taskUsers = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'user');
            $q->where('name', '!=', 'customer');
            $q->where('name', '!=', 'admin');
        })->orderBy('created_at', 'desc')->get();
        $leads = Lead::orderBy('created_at', 'desc')->get();
        $appointmentUsers = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['user', 'staff']);
        })->get();
        $categories = Category::whereStatus(1)->orderBy('created_at', 'desc')->get();
        $priorities = Priority::whereStatus(1)->orderBy('created_at', 'desc')->get();
        $leadId = $id;
        $notificationList = Notification::where('lead_id', $leadId)->orderBy('id', 'desc')->get();
        $stages = Stage::whereStatus(1)->orderBy('created_at', 'desc')->get();
        $lead = Lead::find($id);
        $leadStages = LeadStage::with('stage')->where('lead_id', $id)->orderBy('id', 'desc')->get();
        $ChangeOrder = ChangeOrder::where('lead_id', $id)->where('status', 'approved')->sum('total_amount');
        $appointments = Appointment::where('appointment_for_lead_id', $lead->id)->orderBy('created_at', 'desc')->get();
        $appointmentCounts = $appointments->count() ?? "0";
        $photo = PhotoAndDocument::find($id);
        $leadCustomer = $lead->customer_id;
        $userEmail = User::where('id', $leadCustomer)->orderBy('id', 'desc')->first();
        $leadStages = LeadStage::with('stage')->where('lead_id', $id)->get();
        $notifications = Notification::latest()->orderBy('id', 'desc')->get();
        $teams = Team::orderBy('created_at', 'desc')->get();
        $adminUser = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['user']);
        })->orderBy('created_at', 'desc')->first();
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->orderBy('created_at', 'desc')->get();
        $cogs_materials = CogsMaterial::where('status', true)->orderBy('id', 'desc')->get();
        $costOfGoodSolds = CostOfGoodSold::where('lead_id', $id)->orderBy('id', 'desc')->get();
        $proposalTemplates = ProposalTemplate::orderBy('id', 'desc')->get();
        $holidays = Holiday::with('getHoliday')->where('user_id', auth()->id())->where('status', 1)->orderBy('id', 'desc')->get();
        $folders = FolderManagement::with('files')->where('lead_id', $id)->orderBy('id', 'desc')->get();
        $emailTemplates = EmailTemplate::orderBy('id', 'desc')->get();
        $yearEstimation = YearEstimation::where('status', 1)->orderBy('id', 'desc')->first();
        $emailTemplateFolder = EmailTemplateFolder::whereStatus('1')->get();
//        $materials = Material::whereStatus('1')->get();
        $productCategories = ProductCategory::whereStatus('1')->get();
        $products = Product::get();
        $marks = Mark::whereStatus('1')->get();
        $scheduling_task_users = User::whereHas(
            'roles', function($q){
            $q->where('name','!=', 'user');
            $q->where('name','!=', 'customer');
            $q->where('name','!=', 'admin');
        })->get();
        if (!empty($id)) {
            $leadExist = Lead::findorfail($id);
            return view('dashboard.customerDashboard.customer-management', compact('emailTemplates', 'folders', 'userEmail', 'holidays', 'costOfGoodSolds', 'cogs_materials', 'appointmentUsers', 'taskUsers', 'proposalTemplates', 'customers', 'categories', 'teams', 'notifications', 'notificationList', 'stages', 'lead', 'appointments', 'appointmentCounts', 'photo', 'users', 'leads', 'priorities', 'paymenttypes', 'leadExist', 'leadStages', 'messages', 'leadMails', 'adminUser', 'ChangeOrder', 'yearEstimation', 'emailTemplateFolder', 'products', 'productCategories', 'marks', 'scheduling_task_users','leadId'));
        }//ends if.
        return view('dashboard.customerDashboard.customer-management', compact('emailTemplates', 'folders', 'userEmail', 'holidays', 'cogs_materials', 'costOfGoodSolds', 'proposalTemplates', 'appointmentUsers', 'categories', 'taskUsers', 'customers', 'teams', 'notifications', 'notificationList', 'stages', 'lead', 'appointments', 'appointmentCounts', 'photo', 'users', 'leads', 'priorities', 'paymenttypes', 'leadStages', 'adminUser', 'ChangeOrder', 'yearEstimation', 'emailTemplateFolder', 'products', 'productCategories','leadId'));
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
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customer = User::findOrFail($id);
            $customerNumber = $customer->profile->customer_number??'';
            $customerTypes = CustomerType::get();
            $referralSources = ReferralSource::get();

            $saleMen = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user')->where('name','!=','customer');})->get();
            $customers = User::whereHas('roles', function($q){$q->where('name', 'customer');})->get();
            $roles = Role::whereNotIn('name',['admin','user','outsideowner'])->with('permissions')->orderBy('id','DESC')->get();
            $isCreate = false;
            $categories = Category::wherestatus(1)->get();
            $yearEstimation = YearEstimation::where('status',1)->first();
            $customerOwnerTypes = CustomerOwnerType::whereStatus('1')->get();
            return view('customer.customer.edit', compact('isCreate','categories','customer','roles', 'customerTypes', 'referralSources', 'saleMen','yearEstimation', 'customers', 'customerOwnerTypes', 'customerNumber'));
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
//


    public function update(Request $request, $id)
    {
        $model = str_slug('customer', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $user = User::findOrFail($id);//ends
            User::where('id',$id)->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'name'=>$request->first_name.' '.$request->last_name,
                'company'=>$request->company,
                'customer_type_id'=>$request->customer_type_id,
                'salesman_id'=>$request->salesman_id,
                'referral_source_id'=>$request->referral_source_id,
                'reference_customer_id' =>$request->reference_customer_id ?? null,
                'customer_note'=>$request->customer_note,
                'email' => isset($request->email) ? $request->email : $request->first_name . time() . "@yopmail.com",
                'created_at' => $request->customer_date
                    ? Carbon::parse($request->customer_date)->format('Y-m-d') . ' ' . now()->format('H:i:s')
                    : now()->format('Y-m-d H:i:s'),
            ]);
            if ($request->signature_type === 'signature_file') {
                $signature = $this->storeImage('customer_signature', $request->signature);
            }elseif ($request->signature_type === 'signature_pad') {
                $signature = $request->signature;
            }//ends if condition.
            Profile::where('user_id',$id)->update([
                'user_id' => $id,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip' => $request->zip,
                'longitude' => $request->longitude ??'',
                'latitude' => $request->latitude ?? '',
                'signature_type' => $request->signature_type,
                'notes' => $request->notes,
                'customer_owner_type_id'     => $request->customer_owner_type_id ?? null,
                'upload_signature' => isset($request->signature) ?  $signature : $user->profile->upload_signature,
//                'category_id'    => $request->user_category_id ?? '',
            ]);//ends update profile.
            if ($request->phone != null){
                CustomerPhone::where('customer_id', $id)->delete();
                foreach ($request->phone as $key => $item) {
                    $formattedNumber =  str_replace(['(', ')', '-', ' '], '', $item);
                    CustomerPhone::create([
                        'customer_id' => $id,
                        'phone' => $formattedNumber
                    ]);//ends create.
                }//end foreach.
            }//end second if condition.
            return redirect('customer/customer')->with('flash_message', 'Customer updated!');
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
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            $user = User::find($id);
            $user->update([
                'email' => $user->email . now(),
                'deleted_at' => now(),

            ]);
            return redirect('customer/customer')->with('flash_message', 'Customer deleted!');
        }
        return response(view('403'), 403);

    }

    public function export(Request $request)
    {
        $model = str_slug('customer', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $customersQuery = User::query();
            $customersQuery->whereHas('roles', function ($q) {
                $q->where('name', 'customer');
            });
            if ($request->customer_filter == 'yes') {
                $customersQuery->whereBetween('created_at', [$request->duration_starts, $request->duration_ends]);
            }

            $customers = $customersQuery->with(['profile.category', 'customerLeads'])
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function ($customer) {
                    $totalJobPrice = 0;
                    if ($customer->customerLeads && $customer->customerLeads->isNotEmpty()) {
                        $totalJobPrice = $customer->customerLeads->where('lead_status', 'won')->sum(function ($lead) {
                            $changeOrderSum = ChangeOrder::where('lead_id', $lead->id)
                                ->where('status', 'approved')
                                ->sum('total_amount');
                            $leadPrice = is_numeric($lead->lead_price) ? (float) $lead->lead_price : 0;
                            $changeOrderPrice = is_numeric($changeOrderSum) ? (float) $changeOrderSum : 0;
                            return $leadPrice + $changeOrderPrice;
                        });
                    }

                    return [
                        'id' => $customer->id,
                        'first_name' => $customer->first_name,
                        'last_name' => $customer->last_name,
                        'email' => $customer->email,
                        'created_at' => $customer->created_at ? $customer->created_at->toISOString() : null,
                        'profile' => [
                            'phone' => $customer->profile ? $customer->profile->phone : null,
                            'category' => ['name' => $customer->profile && $customer->profile->category ? $customer->profile->category->name : null],
                            'address' => $customer->profile ? $customer->profile->address : null,
                            'city' => $customer->profile ? $customer->profile->city : null,
                            'state' => $customer->profile ? $customer->profile->state : null,
                            'zip' => $customer->profile ? $customer->profile->zip : null,
                        ],
                        'customerLeads' => $customer->customerLeads->where('lead_status', 'won')->count(),
                        'total_job_price' => $totalJobPrice,
                    ];
                });

            return response()->json($customers);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function matchCustomer(Request $request)
    {
        // 1. Query builder shuru kiya
        $query = User::query();

        // 2. Agar first_name request mein hai, toh WHERE lagega
        if ($request->filled('first_name')) {
            $firstName = $request->first_name;
            $query->where('first_name', 'LIKE', '%' . $firstName . '%');
        }

        // 3. Agar last_name request mein hai, toh AND WHERE lagega
        if ($request->filled('last_name')) {
            $lastName = $request->last_name;
            // Pichli condition ke saath AND mein jud jaega
            $query->where('last_name', 'LIKE', '%' . $lastName . '%');
        }

        // 4. Agar address request mein hai, toh AND WHERE lagao
        if ($request->filled('address')) {
            $address = $request->address;
            // Pichli saari conditions ke saath AND mein jud jaega
            $query->whereHas('profile', function ($q) use ($address) {
                $q->where('address', $address);
            })->with('profile');
        }

        // 5. Agar phone request mein hai, toh AND WHERE lagao
        if ($request->filled('phone')) {
            $rawPhone = preg_replace('/\D/', '', $request->phone);
            // Pichli saari conditions ke saath AND mein jud jaega
            $query->whereHas('customerPhones', function ($q) use ($rawPhone) {
                $q->where('phone', $rawPhone);
            })->with('customerPhones');
        }

        // Yahan check kiya ja raha hai ke kam se kam ek field toh bhara gaya ho.
        if ($request->filled('first_name') || $request->filled('last_name') || $request->filled('address') || $request->filled('phone')) {

            // 6. Saari AND conditions ko mila kar final result hasil kiya
            $finalRecords = $query->with('profile', 'customerPhones')->get();

            if ($finalRecords->isNotEmpty()) {
                return response()->json([
                    'matched' => true,
                    'records' => $finalRecords,
                    'count' => $finalRecords->count()
                ]);
            }
        }

        return response()->json(['matched' => false]);
    }

    public function getCamPhotos(){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.companycam.com/v2/photos",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60, // Increased timeout
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false, // Disable for testing
            CURLOPT_SSL_VERIFYHOST => false, // Disable for testing
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer M6XVE1BYh3Vj35lhNoszeOpvlO5Nyu9nbDgTudkuSzw"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return response()->json(['response'=>$response]);
        }
    }

    public function sendSupportMessage(Request $request){
        ChatMessage::create([
            'message' => $request->message,
            'type' => 'support',
            'sender_id' => $request->sender_id,
            'sender_type' => $request->sender_type,
        ]);

        return response()->json('success');
    }

    public function getSupportMessage(Request $request)
    {
        try {
            $senderId = $request->sender_id;
            $lastId = $request->last_id ?? 0;

            // Get messages where:
            // 1. User is sender (customer messages)
            // 2. User is recipient (admin replies to this user)
            $messages = ChatMessage::where(function($query) use ($senderId) {
                $query->where('sender_id', $senderId)
                    ->where('sender_type', 'customer');
            })
                ->orWhere(function($query) use ($senderId) {
                    $query->where('reply_to', $senderId)
                        ->where('sender_type', 'admin');
                })
                ->where('id', '>', $lastId)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'messages' => $messages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load messages'
            ], 500);
        }
    }
}
