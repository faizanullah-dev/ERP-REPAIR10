<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Announcement;
use App\Appointment;
use App\AppointmentAttachment;
use App\AssignAnnouncement;
use App\CalculatorBaseValue;
use App\CalculatorSize;
use App\Call;
use App\Campaign;
use App\CampaignAttachment;
use App\CampaignDetail;
use App\Category;
use App\ChangeOrder;
use App\ChangeOrderAttachment;
use App\ChatBotMessage;
use App\ChatBotRoom;
use App\ChatMessage;
use App\ChimneyEstimateCalculator;
use App\CogsMaterial;
use App\CommonSetting;
use App\CompanyContact;
use App\CostOfGoodSold;
use App\Credit;
use App\CustomerPhone;
use App\CustomerReferral;
use App\CustomerType;
use App\EmailTemplate;
use App\EmailTemplateAttachment;
use App\EmailTemplateFolder;
use App\EmailTemplateVariable;
use App\Estimate;
use App\EstimateAttachment;
use App\FinanceCog;
use App\FinanceGrossExpense;
use App\FinanceGrossIncome;
use App\FinanceOhExpense;
use App\FinanceSheet;
use App\FolderManagement;
use App\FolderManagementAttachment;
use App\FollowUpCallNote;
use App\Holiday;
use App\Invoice;
use App\InvoiceAttachment;
use App\JobNote;
use App\JobNoteAttachment;
use App\Jobs\SendEmailJob;
use App\Lead;
use App\LeadMail;
use App\LeadStage;
use App\LogActivity;
use App\Mark;
use App\Material;
use App\MaterialAttachment;
use App\MaterialDeliveryDate;
use App\Message;
use App\Notification;
use App\PaymentType;
use App\PhotoAndDocument;
use App\PhotoAndDocumentAttachment;
use App\PlatformNotification;
use App\Priority;
use App\Product;
use App\ProductCategory;
use App\ProductPricePdfMeasurement;
use App\ProductPriceSkylight;
use App\ProductPricingEstimateCalculator;
use App\ProductPricingPriceList;
use App\Profile;
use App\ProgressBoard;
use App\Proposal;
use App\ProposalAttachment;
use App\ProposalTemplate;
use App\ProposalTemplateAttachment;
use App\ProposalType;
use App\ReceivePayment;
use App\ReferralSource;
use App\Refund;
use App\Role;
use App\RoofEstimateCalculator;
use App\Roofestimatecalculatorpreferd;
use App\RoofEstimateSkylight;
use App\SchedulingTask;
use App\SchedulingTaskUser;
use App\SidingEstimateCalculator;
use App\Stage;
use App\StoreProductPricingMaterialList;
use App\StoreSideEstimateCalculatorGutter;
use App\SubContractorCompanyDetail;
use App\SubContractorInsuranceInfo;
use App\SubContractorInvoice;
use App\SubContractorProposal;
use App\SubContractorRecurringEmail;
use App\Task;
use App\TaskAssignUser;
use App\TaskAttachment;
use App\Team;
use App\TermAndCondition;
use App\Trade;
use App\User;
use App\UserCheckIn;
use App\UserMailSend;
use App\UserMailSendAttachment;
use App\UsersMailboxConfiguration;
use App\UsersMailboxesSent;
use App\UserTeam;
use App\YearEstimateMonth;
use App\YearEstimation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mail;
use PhpImap\Mailbox;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\ClientManager;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;
use Exception;
use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Log;

class WebsiteController extends Controller
{
    public function __construct()
    {

    }

    public function showProposal()
    {
        return view('admin.proposal');
    }

    public function proposalEditor()
    {
        return view('admin.proposal_editor');
    }

    public function changeOrderEmail()
    {
        return view('changeOrder.change-order.change_order_email');
    }


    public function index()
    {
        return redirect(url('dashboard'));
    }//end index function.

    public function staff()
    {
        return view('admin.staff');
    }//end staff function.

    public function leads()
    {
        return view('admin.leads');
    }//end leads function.

    public function salesTeam()
    {
        return view('admin.sales_team');
    }//end sales-team function.

    public function target()
    {
        return view('admin.target');
    }//end target function.

    public function workType()
    {
        return view('admin.work_type');
    }//end work-type function.

    public function call()
    {
        return view('admin.call');
    }//end call function.

    public function customerManager()
    {
        return view('admin.customer_manager');
    }//end customer-manager function.

    public function profile()
    {
        return view('admin.profile');
    }//end profile function.

    public function changePassword()
    {
        return view('admin.change_password');
    }//end change-password function.

    public function termsAndCondition()
    {
        $termsAndCondition = TermAndCondition::first();
        return view('admin.terms_and_condition', compact('termsAndCondition'));
    }//end change-password function.

    public function email(Request $request)
    {
        return view('admin.email');
    }//end email function.

    public function newEmail()
    {
        return view('admin.new_email');
    }//end new-email function.

    public function subContractor()
    {
        $subcontractors = User::whereHas('roles', function($q) {
            $q->where('name', 'subcontractor');
        })->get();
        $allTrades = Trade::get();
        return view('subContractor.index', compact('subcontractors', 'allTrades'));
    } //subContractor
    public function subContractorCreate()
    {
        $trades = Trade::get();
        return view('subContractor.create', compact('trades'));
    } //subContractor

    public function storeSubContractor(Request $request){
//        return $request->all();
        $randomPassword = Str::random(10);
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($randomPassword),
            'status' => 1
        ]);
        Profile::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);
        $role = Role::find($request->role_id);
        $user->assignRole($role->name);

        SubContractorCompanyDetail::create([
            'user_id' => $user->id,
            'name' => $request->company_name,
            'address' => $request->company_address,
            'city' => $request->company_city,
            'state' => $request->company_state,
            'zip_code' => $request->company_zip_code,
            'phone' => $request->company_phone,
            'email' => $request->company_email,
            'corporation' => $request->corporation,
            'trades' => json_encode($request->trades),
            'website' => $request->company_website,
        ]);

        Mail::raw("Hello {$user->name},\n\n" .
            "Your account has been created. Here are your login credentials:\n\n" .
            "Email: {$request->email}\n" .
            "Password: {$randomPassword}\n\n" .
            "Please change your password after first login.\n\n" .
            "Thank you,\n",

            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Account Credentials');
            }
        );

        return redirect()->back()->with('flash_message', 'SubContractor Created');

    }

    public function subContractorShow($id)
    {
        $subcontractor = User::where('id', $id)->whereHas('roles', function($q) {
            $q->where('name', 'subcontractor');
        })->first();
        $jobs = $subcontractor->subContractorJobs()
            ->latest()
            ->get();
        $allTrades = Trade::get();
        $leads = Lead::where('lead_status', 'won')->get();
        $jobLeads = SchedulingTask::where('subcontractor_id', $id)->get();
//        $proposals = ProposalTemplate::get();
        $proposals = ProposalTemplate::where('proposal_type', 1)->get();
        $emailTemplates = EmailTemplate::get();
        $paymenttypes = PaymentType::whereStatus('1')->orderBy('id', 'desc')->get();
        $yearEstimation = YearEstimation::where('status', 1)->orderBy('id', 'desc')->first();
        $invoices = SubContractorInvoice::where('subcontractor_id', $id)->get();
        if($subcontractor) {
            return view('subContractor.show', compact('subcontractor', 'allTrades', 'leads', 'proposals', 'emailTemplates', 'jobLeads', 'invoices', 'paymenttypes', 'yearEstimation', 'jobs'));
        }
        else{
            abort(404);
        }
    } //subContractor

    public function updateSubContractorInsuranceInfo(Request $request)
    {
        $subcontractorId = $request->input('subcontractor_id');
        $insuranceType = $request->input('insurance_type');

        $existingRecord = SubContractorInsuranceInfo::where('subcontractor_id', $subcontractorId)->first();

        $updateData = [
            $insuranceType . '_insurance_company_info' => $request->input($insuranceType . '_insurance_company_info'),
            $insuranceType . '_contact_name' => $request->input($insuranceType . '_contact_name'),
            $insuranceType . '_phone' => $request->input($insuranceType . '_phone'),
            $insuranceType . '_email' => $request->input($insuranceType . '_email'),
            $insuranceType . '_insurance_carrier' => $request->input($insuranceType . '_insurance_carrier'),
            $insuranceType . '_policy_eff' => $request->input($insuranceType . '_policy_eff'),
            $insuranceType . '_policy_exp' => $request->input($insuranceType . '_policy_exp'),
        ];

        $fileField = $insuranceType . '_attachment';
        if ($request->hasFile($fileField)) {
            $path = $this->storeImage('subContractorInsurance', $request->file($fileField));
            $updateData[$fileField] = $path;
            $updateData[$insuranceType . '_attachment_date'] = now()->toDateString();
        } else {
            if ($existingRecord) {
                $updateData[$fileField] = $existingRecord->{$fileField};
                $updateData[$insuranceType . '_attachment_date'] = $existingRecord->{$insuranceType . '_attachment_date'};
            }
        }

        SubContractorInsuranceInfo::updateOrCreate(
            ['subcontractor_id' => $subcontractorId],
            $updateData
        );

        return response()->json([
            'message' => 'Insurance data updated successfully',
        ]);
    }

    public function uploadInsuranceAttachment(Request $request){
        $subcontractorId = $request->input('subcontractor_id');
        $insuranceType = $request->input('insurance_type');

        $fileField = $insuranceType . '_attachment';

        $path = $this->storeImage('subContractorInsurance', $request->file('attachment'));

        SubContractorInsuranceInfo::updateOrCreate(
            ['subcontractor_id' => $subcontractorId],
            [
                $fileField => $path,
                $insuranceType . '_attachment_date' => now()->toDateString()
            ]
        );

        return redirect()->back()->with(['type'=>'success', 'message'=>'Attachment Uploaded Successfully']);
    }

    public function updateInsuranceAgencyStatus(Request $request){
        $data = SubContractorRecurringEmail::where('subcontractor_id', $request->subcontractor_id)->where('insurance_type', $request->type)->get();
        if($data->isNotEmpty()) {
            foreach($data as $record) {
                $record->update(['same_agency' => $request->value]);
            }
            return response()->json(['message' => 'success']);
        }
        else{
            return response()->json(['message' => 'error']);
        }
    }

    public function sendExpirationReminders()
    {
        $reminders = SubContractorRecurringEmail::with('subcontractor.subContractorInsuranceInfo')->get();

        foreach ($reminders as $record) {
            try {
                $expiryDate = \Carbon\Carbon::createFromFormat('Y-m-d', $record->policy_expiry_date);

                if (!$expiryDate || $expiryDate->isPast()) {
                    continue;
                }

                $daysRemaining = now()->diffInDays($expiryDate);

                if ($daysRemaining <= $record->no_of_days_before) {
                    $to = $record->subcontractor->email;
                    $cc = [];

                    if ($record->same_agency == 1 && !empty($record->subcontractor->subContractorCompany->email)) {
                        $cc[] = $record->subcontractor->subContractorCompany->email;
                    }

                    $cleanInsuranceType = str_replace('_', ' ', $record->insurance_type);

                    $subject = "Policy Expiration Reminder - " . ucwords($cleanInsuranceType);
                    $message = "Dear {$record->subcontractor->name},\n\n"
                        . "Your " . ucwords($cleanInsuranceType) . " policy is expiring in {$daysRemaining} days "
                        . "(Expiry Date: {$expiryDate->format('Y-m-d')}).\n\n"
                        . "Please take necessary actions to renew your policy.\n\n"
                        . "Best regards,\nYour Company";

                    Mail::raw($message, function ($mail) use ($to, $cc, $subject) {
                        $mail->to($to)
                            ->subject($subject);

                        if (!empty($cc)) {
                            $mail->cc($cc);
                        }
                    });
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }


    }

    public function getRecurringEmail(Request $request){
        $data = SubContractorRecurringEmail::where('subcontractor_id', $request->subcontractorId)->where('insurance_type', $request->insuranceType)->get();
        $emailTemplates = EmailTemplate::get();
        return (string) view('subContractor.ajax.email_modal', compact('data', 'emailTemplates'));
    }

    public function deleteRecurringEmail(Request $request){
        SubContractorRecurringEmail::where('id', $request->id)->delete();
        return response()->json(['message'=>'success']);
    }

    public function progressBoard()
    {
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $taskUsers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', '!=', 'user');
            $q->where('name', '!=', 'customer');
            $q->where('name', '!=', 'admin');
        })->get();
        $leads = Lead::get();
        $priorities = Priority::where('status', 1)->get();
        $teams = Team::get();
        $leads = Lead::with('getProgressBoard')->where('progress_status', 1)->get();
        return view('admin.progress_board', compact('leads', 'taskUsers', 'priorities', 'teams', 'yearEstimation'));
    }//end email function.

    public function taskDetail(Request $request)
    {
        $task = Task::with('getTaskAssignUser', 'images')->where('id', $request->task)->first();
        if ($task) {
            return response()->json(['task' => $task]);
        } else {
            return response()->json([], 404);
        }
    }//end function taskDetail.

    public function message()
    {
        return view('admin.message');
    }//end message function.

    public function jobsWon(Request $request, $duration_starts = null, $duration_ends = null, $category_id = null, $customer_id = null, $customerType_id = null)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $query = Lead::with('customer')->where('lead_status', 'won');
        if (!empty($duration_starts) && !empty($duration_ends)) {
            $query->whereBetween('lead_status_date', [$duration_starts, $duration_ends]);
        }
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        if (!empty($customer_id)) {
            $query->where('customer_id', $customer_id);
        }
        if (!empty($customerType_id)) {
            $query->whereHas('customer', function ($q) use ($customerType_id) {
                $q->where('customer_type_id', $customerType_id);
            });
        }
        $leads = $query->whereYear('lead_status_date', $yearEstimation->year)->get();
        $categories = Category::wherestatus(1)->get();
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $groupedLeads = $leads->groupBy('customer_id');
        $leadsCount = $groupedLeads->map(function ($groupedLead) {
            return $groupedLead->count();
        });
        $groupedLeads = $leads->groupBy(function ($item) {
            return $item->customer->name ?? 'unknown';
        });
        $customerTypes = CustomerType::get();
        return view('admin.jobs_won', compact('leads', 'leadsCount', 'groupedLeads', 'categories', 'customers', 'customerTypes', 'yearEstimation'));
    }//ends jobsWon function.

    public function performance(Request $request, $duration_starts = null, $customerType_id = null, $duration_ends = null, $category_id = null, $customer_id = null)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $query = Lead::with('customer')->where('lead_status', 'won');
        if (!empty($duration_starts) && !empty($duration_ends)) {
            $query->whereBetween('lead_date', [$duration_starts, $duration_ends]);
        }
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        if (!empty($customer_id)) {
            $query->where('customer_id', $customer_id);
        }
        if (!empty($customerType_id)) {
            $query->whereHas('customer', function ($q) use ($customerType_id) {
                $q->where('customer_type_id', $customerType_id);
            });
        }//end if.
        $leads = $query->get();
        $groupedLeads = $leads->groupBy('customer_id');
        $leadsCount = $groupedLeads->map(function ($groupedLead) {
            return $groupedLead->count();
        });
        $groupedLeads = $leads->groupBy(function ($item) {
            return $item->customer->name ?? 'unknown';
        });
        $categories = Category::wherestatus(1)->get();
        $customerTypes = CustomerType::get();
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        return view('admin.performance', compact('leads', 'leadsCount', 'groupedLeads', 'categories', 'customers', 'customerTypes', 'yearEstimation'));
    }//end performance function.

    public function summary()
    {
        $leads = Lead::with('getChangeOrder')->get();
        $groupedLead = $leads->groupBy('customer_id');
        $leadsCount = $groupedLead->map(function ($groupedLead) {
            return $groupedLead->count();
        });
        $groupedLeads = $leads->groupBy(function ($item) {
            return $item->customer->name ?? 'unknown';
        });
        return view('admin.summary', compact('leads', 'groupedLeads', 'leadsCount'));
    }//end summary function.

    public function bySalesman(Request $request, $id){
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
        // $leadStages = LeadStage::with('stage')->where('lead_id', $id)->orderBy('id', 'desc')->get();
        $ChangeOrder = ChangeOrder::where('lead_id', $id)->where('status', 'approved')->sum('total_amount');
        $appointments = Appointment::where('appointment_for_lead_id', $lead->id)->orderBy('created_at', 'desc')->get();
        $appointmentCounts = $appointments->count() ?? "0";
        $photo = PhotoAndDocument::find($id);
        $leadCustomer = $lead->customer_id;
        $userEmail = User::where('id', $leadCustomer)->orderBy('id', 'desc')->first();
        $leadStages = LeadStage::with('stage')->where('lead_id', $id)->get();
        // $notifications = Notification::latest()->orderBy('id', 'desc')->get();
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
        $subcontractors = User::whereHas(
            'roles', function($q){
            $q->where('name', 'subcontractor');
        })->get();
        if (!empty($id)) {
            $leadExist = Lead::findorfail($id);
            return view('admin.by_salesman', compact('emailTemplates', 'folders', 'userEmail', 'holidays', 'costOfGoodSolds', 'cogs_materials', 'appointmentUsers', 'taskUsers', 'proposalTemplates', 'customers', 'categories', 'teams', 'notificationList', 'stages', 'lead', 'appointments', 'appointmentCounts', 'photo', 'users', 'leads', 'priorities', 'paymenttypes', 'leadExist', 'leadStages', 'messages', 'leadMails', 'adminUser', 'ChangeOrder', 'yearEstimation', 'emailTemplateFolder', 'products', 'productCategories', 'marks', 'scheduling_task_users','leadId','subcontractors'));
        }//ends if.
        return view('admin.by_salesman', compact('emailTemplates', 'folders', 'userEmail', 'holidays', 'cogs_materials', 'costOfGoodSolds', 'proposalTemplates', 'appointmentUsers', 'categories', 'taskUsers', 'customers', 'teams', 'notificationList', 'stages', 'lead', 'appointments', 'appointmentCounts', 'photo', 'users', 'leads', 'priorities', 'paymenttypes', 'leadStages', 'adminUser', 'ChangeOrder', 'yearEstimation', 'emailTemplateFolder', 'products', 'productCategories','leadId','subcontractors'));
    }//end bySalesman function.

    public function getActivities($leadId, Request $request)
    {
        $notificationList = Notification::where('lead_id', $leadId)
            ->orderBy('id', 'desc')
            ->get();

//        if ($request->ajax()) {
//            return response()->json($notificationList);
//        }

        return view('includes.ajax.get_activities', compact('notificationList'));
    }


    public function viewAppointmentDetail(Request $request)
    {
        $appointments = Appointment::with('getAppointmentAttendee')->where('id', $request->id)->first();
        return (string)view('includes.ajax.appointment_show_modal', compact('appointments'));
    }//end function viewAppointmentDetail.

    public function viewProposalDetail(Request $request)
    {
        $proposal = Proposal::where('id', $request->id)->first();
        return (string)view('includes.ajax.proposal_show_modal', compact('proposal'));
    }//end function viewAppointmentDetail.

    public function viewMaterialDetail(Request $request)
    {
        $material = Material::where('id', $request->id)->first();
        return (string)view('includes.ajax.material_show_modal', compact('material'));
    }//end function viewAppointmentDetail.


//    public function updateStatusLead(Request $request, $id = null, $status = null){
//        if (Lead::whereid($id)->update(['lead_status' => $status, 'lead_status_date' => now()->format('Y-m-d')])) {
//            if (isset($status) && !empty($status)) {
//                Notification::create([
//                    'lead_id' => $id,
//                    'model' => 'Lead Status Update',
//                    'title' => $status,
//                    'time' => Carbon::now(),
//                ]);
//            }//ends if.
//            return back()->with(['type' => 'success', 'message' => 'lead status updated successfully']);
//        } else {
//            return back()->with(['type' => 'error', 'message' => 'something wents wrong']);
//        }//end if.
//    }//ends function updateStatusLead.

    public function updateStatusLead(Request $request, $id = null, $status = null)
    {
        $lead = Lead::find($id);
        if (!$lead) {
            return back()->with(['type' => 'error', 'message' => 'Lead not found']);
        }
        $updateData = [
            'lead_status' => $status,
            'lead_status_date' => now()->format('Y-m-d'),
        ];
        if ($status === 'won') {
            if ($lead->job_number) {
                $updateData['job_number'] = $lead->job_number;
            } else {
//                $leadYear = now()->format('Y');
//                $existingJobNumbers = Lead::whereYear('lead_status_date', $leadYear)
//                    ->where('lead_status', 'won')
//                    ->pluck('job_number')
//                    ->filter();
//                $usedNumbers = $existingJobNumbers->map(function ($jobNumber) {
//                    return (int)explode('-', $jobNumber)[1];
//                })->sort();
//                $nextCount = 1;
//                foreach ($usedNumbers as $usedNumber) {
//                    if ($usedNumber == $nextCount) {
//                        $nextCount++;
//                    } else {
//                        break;
//                    }
//                }
//                $updateData['job_number'] = now()->format('ymd') . '-' . str_pad($nextCount, 3, '0', STR_PAD_LEFT);
                $categoryFirstChar = $lead->category ? strtoupper(substr($lead->category->name, 0, 1)) : 'R';
                $yearEstimation = YearEstimation::whereStatus(1)->first();

                // Get current date parts
                $currentDate = now();
                $year = $currentDate->format('y'); // 25 for 2025
                $month = $currentDate->format('m'); // 09
                $day = $currentDate->format('d');   // 06

                // Get total leads count (including soft deleted)
                $totalLeadsCount = Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'won')->count() + 1;

                // Generate job number: R25-0906-270
                $updateData['job_number'] = $categoryFirstChar . $year . '-' . $month . $day . '-' . $totalLeadsCount;
            }
        } elseif (in_array($status, ['pending', 'lost'])) {
            $updateData['job_number'] = null;
        }
        $isUpdated = $lead->update($updateData);
        if ($isUpdated) {
            Notification::create([
                'lead_id' => $lead->id,
                'model' => 'Lead Status Updated',
                'title' => "Lead status updated to <b>{$status}</b> against the lead <b>{$lead->title}</b> by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return back()->with(['type' => 'success', 'message' => 'Lead status updated successfully']);
        }
        return back()->with(['type' => 'error', 'message' => 'Something went wrong while updating the lead']);
    }

    public function updateStatusLeadDate(Request $request){
        $lead = Lead::find($request->lead_id);
        if (!$lead) {
            return response()->json(['status' => 'error', 'message' => 'Lead not found']);
        }
        $updateData = [
            'lead_status_date' => $request->lead_status_date,
        ];
//        if ($lead->lead_status === 'won') {
//            $datePattern = Carbon::parse($request->lead_status_date)->format('ymd');
//            $leadYear = Carbon::parse($request->lead_status_date)->format('Y');
//            $existingJobNumbers = Lead::whereYear('lead_status_date', $leadYear)
//                ->where('lead_status', 'won')
//                ->pluck('job_number')
//                ->filter();
////            $usedNumbers = $existingJobNumbers->map(function ($jobNumber) {
////                return (int)explode('-', $jobNumber)[1];
////            });
//            $usedNumbers = $existingJobNumbers->map(function ($jobNumber) {
//                $parts = explode('-', $jobNumber);
//                $suffix = end($parts);
//
//                return is_numeric($suffix) ? (int)$suffix : null;
//            })->filter();
//            $nextCount = $usedNumbers->isEmpty() ? 1 : $usedNumbers->max() + 1;
//            $paddedCount = str_pad($nextCount, 3, '0', STR_PAD_LEFT);
//            $updateData['job_number'] = $datePattern . '-' . $paddedCount;
//        }
        if ($lead->update($updateData)) {
            Notification::create([
                'lead_id' => $lead->id,
                'model' => 'Lead Status Date Updated',
                'title' => "Lead status date updated against the lead <b>{$lead->title}</b> by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);
            return back()->with(['status' => 'success', 'message' => 'Lead status date updated successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
    }

    public function updateStatusChangeOrder(Request $request, $id = null, $status = null)
    {
        if (ChangeOrder::whereid($id)->update(['status' => $status])) {
            $ChangeOrder = ChangeOrder::whereid($id)->first();
            $Lead = Lead::whereid($ChangeOrder->lead_id)->first();
            $sumfinalValue = (float)$Lead->lead_price_with_change_order_price + (float)$ChangeOrder->total_amount;
            $subfinalValue = (float)$Lead->lead_price_with_change_order_price - (float)$ChangeOrder->total_amount;
            if ($status == 'approved') {
                $Lead->update(['lead_price_with_change_order_price' => $sumfinalValue]);
            } elseif ($status != 'approved') {
                if ($Lead->lead_price < $Lead->lead_price_with_change_order_price) {
                    $Lead->update(['lead_price_with_change_order_price' => $subfinalValue]);
                }
            }
//            if ($status == 'approved') {
//                $Lead->update(['lead_price_with_change_order_price' => $sumfinalValue]);
//            }
//            elseif ($status != 'approved') {
//                if ($Lead->lead_price < $Lead->lead_price_with_change_order_price) {
//                    $Lead->update(['lead_price' => $subfinalValue]);
//                }
//            }
            if (isset($status) && !empty($status)) {
                Notification::create([
                    'lead_id' => $id,
                    'model' => 'Change Order Status Updated',
                    'title' => 'Change order associated with the lead <b>' . @$ChangeOrder->getLead->title . '</b> of amount <b>$' . $ChangeOrder->total_amount . '</b> has been ' . ($ChangeOrder->status === 'approved' ? '<b>approved</b>' : '<b>rejected</b>'). 'by',
                    'icon'    => 'fa-regular fa-square-plus',
                    'time'    => $ChangeOrder->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            return back()->with(['type' => 'success', 'message' => 'Change Order status updated successfully']);
        } else {
            return back()->with(['type' => 'error', 'message' => 'something wents wrong']);
        }//end if.
    }//ends function updateStatusChangeOrder.

    public function changeInvoiceStatus(Request $request, $id = null, $status = null)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Invoice not found']);
        }
        $invoice->status = $status;
        if ($invoice->save()) {
            if (!empty($status)) {
                Notification::create([
                    'lead_id' => $invoice->lead_id,
                    'model'   => 'Invoice Status Update',
                    'title' => 'Invoice associated with the lead <b>' . @$invoice->getLead->title . '</b> of amount <b>$' . $invoice->total_amount . '</b> has been ' . ($invoice->status === 'approved' ? '<b>approved</b>' : '<b>rejected</b>'). 'by',
                    'time'    => now(),
                    'icon'    => 'fa-solid fa-exchange-alt',
                    'user_id' => auth()->user()->id,
                ]);
            }
            return redirect()->back()->with(['type' => 'success', 'message' => 'Invoice status updated successfully']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Something went wrong while updating the status']);
        }
    }


    public function viewReceivePaymentDetail(Request $request)
    {
        $receivepayment = ReceivePayment::where('id', $request->id)->first();
        return (string)view('includes.ajax.receive_payment_show_modal', compact('receivepayment'));
    }//end function viewAppointmentDetail.

    public function viewTaskDetail(Request $request)
    {
        $task = Task::where('id', $request->id)->first();
        return (string)view('includes.ajax.task_show_modal', compact('task'));
    }//end function viewAppointmentDetail.

    public function viewJobNoteDetail(Request $request)
    {
        $jobnote = JobNote::where('id', $request->id)->first();
        return (string)view('includes.ajax.view_job_note_modal', compact('jobnote'));
    }//end function viewJobNoteDetail.

    public function viewChangeOrderDetail(Request $request)
    {
        extract($request->all());
        $changeorder = ChangeOrder::findOrFail($id);
        return (string)view('includes.ajax.view_change_order_modal', compact('changeorder'));
    }//end function viewJobNoteDetail.

    public function viewInvoiceDetail(Request $request)
    {

        extract($request->all());
        $invoice = Invoice::with('getLead.customer')->findOrFail($id);
        return (string)view('includes.ajax.view_invoice_modal', compact('invoice'));
    }//end function viewJobNoteDetail.

    public function viewInvoiceBalanceSheetDetail(Request $request)
    {
        extract($request->all());
//        $invoice = Invoice::with('getInvoiceAttachments')->where('lead_id', $id)->where('status', 'approved')->get();
        $leads = Lead::with('getInvoice')->where('id', $id)->first();
        return (string)view('invoice.invoice.view_invoice_balance_sheet_modal', compact( 'leads'));
    }//end function viewJobNoteDetail.

    public function viewCOGSDetail(Request $request)
    {
        extract($request->all());
        $costOfGoodSold = CostOfGoodSold::with('cogsSheetsDetails')->where('lead_id', $id)->get();
        $leads = Lead::with('getChangeOrder')->where('id', $id)->first();
        $changeOrderAmount = $leads->getChangeOrder->where('status', 'approved')->sum('total_amount');
        return (string)view('costOfGoodSold.cost-of-good-sold.view_cost_of_good_sold', compact(
            'costOfGoodSold',
            'leads',
            'changeOrderAmount'
        ));
    }//end function viewJobNoteDetail.

    public function viewCOGSModalDetail(Request $request)
    {
        extract($request->all());
        $costOfGoodSold = CostOfGoodSold::with('cogsSheetsDetails')->where('id', $id)->first();
        $leads = Lead::where('id', $costOfGoodSold->lead_id)->first();
        return (string)view('costOfGoodSold.cost-of-good-sold.view_cogs_modal', compact('costOfGoodSold', 'leads'));
    }//end function viewJobNoteDetail.

    public function editCOGSModalDetail(Request $request, $id = null)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $costofgoodsold = CostOfGoodSold::with('cogsSheetsDetails')->findOrFail($id);//unaiz
        $cogs_materials = CogsMaterial::where('status', true)->get();
        return (string)view('costOfGoodSold.cost-of-good-sold.edit_cogs_modal', compact('costofgoodsold', 'cogs_materials', 'yearEstimation'));
    }//end function viewAppointmentDetail.

    public function deleteCOGS(Request $request, $id = null)
    {
        extract($request->all());
        $cogsDelete = CostOfGoodSold::find($id);
        if (!$cogsDelete) {
            return response()->json(['status' => false, 'message' => 'COGS not found']);
        }
        if ($cogsDelete->delete()) {
            Notification::create([
                'lead_id' => $cogsDelete->lead_id ?? null,
                'model' => 'Cogs Deleted',
                'title' => $cogsDelete->name ?? null,
                'time' => now(),
            ]);
            return response()->json(['status' => true, 'message' => 'COGS Deleted Successfully']);
        }
    }

    public function viewLeadMessage(Request $request)
    {
//        return $request->all();
        $message = Message::where('id', $request->message_id)->first();
        return (string)view('message/message.view_lead_message', compact('message'));
    }

    public function editLeadMessage(Request $request, $id = null)
    {
        extract($request->all());
        $message = Message::findOrFail($id);
        $leads = Lead::get();
        return (string)view('message/message.edit_lead_message', compact('message', 'leads'));
    }

    public function deleteLeadMessage(Request $request, $id = null)
    {
        extract($request->all());
        $message = Message::where('id', $id)->delete();
        if ($message) {
            return response()->json(['status' => true, 'message' => 'Message Deleted Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'something wents wrong']);
        }
    }

    public function viewLeadMail(Request $request, $id = null)
    {
        $leadMail = LeadMail::where('id', $request->leadMail_id)->first();
        return (string)view('leadMail.lead-mail.view_mail_modal', compact('leadMail'));
    }

    public function editLeadMail(Request $request)
    {
        extract($request->all());
        $leadMail = LeadMail::findOrFail($request->leadMail_id);
        $leads = Lead::get();
        return (string)view('leadMail.lead-mail.edit_mail_modal', compact('leadMail', 'leads'));
    }

    public function deleteLeadMail(Request $request, $id = null)
    {
        extract($request->all());
        $leadMail = LeadMail::where('id', $id)->delete();
        if ($leadMail) {
            return response()->json(['status' => true, 'message' => 'Lead Email Deleted Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'something wents wrong']);
        }//ends if.
    }

//    public function deleteLeadDocument(Request $request, $photo_id = null){
//        $photoAndDocument = PhotoAndDocumentAttachment::find($photo_id);
//        $leadId = $photoAndDocument->getPhoto->lead_id;
//        $lead = Lead::find($leadId);
//        if($photoAndDocument->delete()){
//        Notification::create([
//            'lead_id' =>  $lead->id,
//            'model'   => 'Attachment Deleted',
//            'title'   => 'Attachments deleted against the lead <b>' . $lead->title . '</b> by ',
//            'icon'    => 'fa-solid fa-trash',
//            'time'    => $lead->updated_at,
//            'user_id' => auth()->user()->id,
//        ]);
//        }
//        if ($photoAndDocument) {
//            return response()->json(['success' => true, 'message' => 'Lead Photo And Document Deleted Successfully']);
//        } else {
//            return response()->json(['success' => false, 'message' => 'Something went wrong']);
//        }//end if
//    }//ends deleteLeadDocument function.

    public function deleteLeadDocument(Request $request, $photo_id = null){
        $photoAndDocument = PhotoAndDocumentAttachment::find($photo_id);
        if (!$photoAndDocument) {
            return response()->json(['success' => false, 'message' => 'Photo not found']);
        }
        $leadId = $photoAndDocument->getPhoto->lead_id;
        $lead = Lead::find($leadId);
        $wasPrimary = $photoAndDocument->doc_primary == 1;
        // 1. Delete the photo from CompanyCam if it exists
        if ($photoAndDocument->company_camp_id && $photoAndDocument->company_camp_file_id) {
            $companyCamApiUrl = env('DELETE_LEAD_COMPANY_CAMP_PHOTO') . "/{$photoAndDocument->company_camp_file_id}";
            $companyCamApiToken = env('CLIENT_COMPANY_CAM_API_KEY');

            // Send DELETE request to CompanyCam API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $companyCamApiToken
            ])->delete($companyCamApiUrl);

            // Check if the photo was deleted successfully from CompanyCam
            if ($response->successful()) {
                Log::info("Image deleted from CompanyCam for file ID: {$photoAndDocument->company_camp_file_id}");
            } else {
                Log::error("Failed to delete image from CompanyCam: " . $response->body());
                return response()->json(['success' => false, 'message' => 'Failed to delete image from CompanyCam']);
            }
        }

        // 2. Delete the photo from the local database
        if ($photoAndDocument->delete()) {
            // Create a notification for the deletion event
            Notification::create([
                'lead_id' =>  $lead->id,
                'model'   => 'Attachment Deleted',
                'title'   => 'Attachments deleted against the lead <b>' . $lead->title . '</b> by ',
                'icon'    => 'fa-solid fa-trash',
                'time'    => $lead->updated_at,
                'user_id' => auth()->user()->id,
            ]);

            // If the deleted photo was primary, update the next photo as primary
            if ($wasPrimary) {
                // Find the first photo that is not deleted and set it as primary
                $nextPrimaryPhoto = PhotoAndDocumentAttachment::where('lead_id', $lead->id)
                    ->where('company_camp_id', '!=', null)  // Ensure it's associated with CompanyCam
                    ->where('id', '!=', $photo_id)  // Ensure it isn't the deleted photo
                    ->first();

                if ($nextPrimaryPhoto) {
                    // Update the next photo to be primary
                    $nextPrimaryPhoto->doc_primary = 1;
                    $nextPrimaryPhoto->save();
                    Log::info("Updated photo ID {$nextPrimaryPhoto->id} to primary for lead ID {$lead->id}");
                }
            }

            // Return success response
            return response()->json(['success' => true, 'message' => 'Lead Photo And Document Deleted Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function editReceivePaymentDetail(Request $request, $id = null)
    {
        extract($request->all());
        $receivepayment = ReceivePayment::findOrFail($id);
        $leads = Lead::get();
        $paymenttypes = PaymentType::get();
        $leadExist = Lead::findorfail($receivepayment->lead_id);
        return (string)view('includes.ajax.receive_payment_add_modal', compact('leads', 'paymenttypes', 'receivepayment', 'leadExist'));
    }//end function viewAppointmentDetail.

    public function editTaskModal(Request $request, $id = null)
    {
        extract($request->all());
        $task = Task::findOrFail($task_id);
        $leads = Lead::get();
        $priorities = Priority::where('status', 1)->get();
        $teams = Team::get();
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin')->where('name', '!=', 'user');
        })->get();
        return (string)view('includes.ajax.task_edit_modal', compact('leads', 'teams', 'priorities', 'users', 'task'));
    }//end function viewAppointmentDetail.

    public function deleteTask(Request $request, $id = null){
        extract($request->all());
        $task = Task::find($task_id);
        if (!$task) {
            return response()->json(['status' => false, 'message' => 'Task not found']);
        }
        $leadID = $task->assign_to_lead_id ?? null;
        if ($task->delete()) {
            Notification::create([
                'lead_id' => $leadID,
                'model' => 'Task Deleted',
                'title' => 'A task <b>' . $task->title . '</b> associated with the lead <b>' . $task->getLead->title . '</b> has been deleted by',
                'time' => $task->created_at,
                'icon' => 'fa-solid fa-trash',
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Task Deleted Successfully']);
        }
    }

    public function deleteReceivePayment(Request $request, $id = null)
    {
        extract($request->all());
        $receive_payment = ReceivePayment::find($id);
        if ($receive_payment) {
            $leadTitle = $receive_payment->getLead->title ?? 'Unknown Lead';
            $amount = $receive_payment->amount ?? $request->amount;
            $receive_payment->remaining_balance = (float)$receive_payment->remaining_balance - (float)$request->amount;
            Invoice::where('id', $receive_payment->invoice_id)->update([
                'payment_status' => null
            ]);
            $receive_payment->delete();
            Notification::create([
                'lead_id' => $receive_payment->lead_id,
                'model' => 'Receive Payment Deleted',
                'title' => 'A receive payment against the lead <b>' . $leadTitle . '</b> has been deleted with the amount of <b>' . $amount . '</b> by',
                'time' => now(),
                'icon' => 'fa-solid fa-trash',
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'ReceivePayment Deleted Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function deleteMaterial(Request $request, $id = null)
    {
        extract($request->all());
        $material = Material::find($id);
        if (!$material) {
            return response()->json(['status' => false, 'message' => 'Material not found']);
        }
        $leadID = $material->lead_id ?? null;
        $materialTitle = $material->name ?? null;
        if ($material->delete()) {
            Notification::create([
                'lead_id' => $leadID,
                'model'   => 'Material Deleted',
                'title'   => 'Material <b>' . $material->name . '</b> has been deleted for lead <b>' . $material->getLead->title . '</b> by',
                'icon'    => 'fas fa-industry',
                'time'    => $material->created_at,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Material Deleted Successfully']);
        }
    }

    public function deleteJobNote(Request $request, $id = null)
    {
        extract($request->all());
        $jobNote = JobNote::find($id);
        if (!$jobNote) {
            return response()->json(['status' => false, 'message' => 'Job Note not found']);
        }
        $leadID = $jobNote->lead_id ?? null;
        $jobNoteTitle = $jobNote->name ?? null;
        if ($jobNote->delete()) {
            Notification::create([
                'lead_id' => $leadID,
                'model' => 'Job Notes Deleted',
                'title'   => 'Jobnote has been deleted for lead <b>' . $jobNote->getLead->title . '</b> by',
                'icon'    => 'fa-regular fa-clipboard',
                'time'    => $jobNote->created_at,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Job Note Deleted Successfully']);
        }
    }

    public function deleteProposal(Request $request, $id = null)
    {
        extract($request->all());
        $proposal = Proposal::where('id', $id)->delete();
        if ($proposal) {
            return response()->json(['status' => true, 'message' => 'Proposal Deleted Successfully']);
        }
    }

    public function deleteOrderChange(Request $request, $id = null){
        extract($request->all());
        if (!$id) {
            return response()->json(['status' => false, 'message' => 'Change order ID is required']);
        }
        $changeOrder = ChangeOrder::find($id);
        if (!$changeOrder) {
            return response()->json(['status' => false, 'message' => 'Change order not found']);
        }
        $leadID = $changeOrder->lead_id;
        $lead = Lead::find($leadID);
        if ($lead) {
            $lead->lead_price_with_change_order_price -= $changeOrder->total_amount;
            $lead->save();
        }

        $title = $changeOrder->name ?? 'No Title';
        if ($changeOrder->delete()) {
            Notification::create([
                'lead_id' => $leadID,
                'model' => 'Change order Deleted',
                'title' => 'Change order with the amount <b>$' . $changeOrder->total_amount . '</b> has been deleted for the lead <b>' . $changeOrder->getLead->title . '</b>'. ' by',
                'icon'    => 'fa-regular fa-trash',
                'time'    => $changeOrder->created_at,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Change order deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Failed to delete Change order']);
    }


    public function editMaterialModal(Request $request, $id = null)
    {
        extract($request->all());
        $leads = Lead::get();
        $material = Material::findOrFail($id);
        return (string)view('includes.ajax.material_add_modal', compact('leads', 'material'));
    }//end function viewAppointmentDetail.

    public function editjobNoteModal(Request $request, $id = null)
    {
        extract($request->all());
        $jobnote = JobNote::findOrFail($id);
        $leads = Lead::get();
        return (string)view('includes.ajax.jobNote_add_modal', compact('leads', 'jobnote'));
    }//end function viewAppointmentDetail.

    public function editProposalModal(Request $request, $id = null)
    {
        extract($request->all());
        $proposal = Proposal::findOrFail($id);
        $leads = Lead::get();
        return (string)view('includes.ajax.proposal_add_modal', compact('leads', 'proposal'));
    }//end function viewAppointmentDetail.


    public function editChangeOrderModal(Request $request, $id = null)
    {
        extract($request->all());
        $task = Task::get();
        $changeorder = ChangeOrder::with('getChangeOrderAttachments')->findOrFail($changeOrder_id);
        $leads = Lead::get();
        $users = User::whereDoesntHave('roles', function ($q) {
            $q->whereIn('name', ['admin', 'user']);
        })->get();
        $categories = Category::get();
        return (string)view('includes.ajax.changeOrder_edit_modal', compact('task', 'changeorder', 'leads', 'categories', 'users'));
    }

    public function editInvoiceModal(Request $request, $id = null)
    {
        extract($request->all());
        $invoice = Invoice::with('getInvoiceAttachments')->findOrFail($invoice_id);
        $leads = Lead::get();
        $users = User::whereDoesntHave('roles', function ($q) {
            $q->whereIn('name', ['admin', 'user']);
        })->get();
        $categories = Category::get();
        return (string)view('includes.ajax.invoice_edit_modal', compact('invoice', 'leads', 'categories', 'users'));
    }

    public function editAppointmentModal(Request $request, $id = null)
    {

        extract($request->all());
        $appointment = Appointment::with('getAppointmentAttendee')->findOrFail($appointment_id);
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $teams = Team::get();
        $leads = Lead::get();
        $users = User::whereHas('roles', function($q){$q->whereIn('name',['user','staff']);})->get();
        $holidays = Holiday::with('getHoliday')->where('user_id', auth()->id())->where('status', 1)->get();
        return (string)view('includes.ajax.appointment_edit_modal', compact('holidays', 'appointment', 'customers', 'users', 'leads', 'teams'));
    }

    public function deleteAppointmentModal(Request $request, $id = null)
    {
        extract($request->all());
        $appointment = Appointment::find($appointment_id);
        if (!$appointment) {
            return response()->json(['status' => false, 'message' => 'Appointment not found']);
        }
        $leadID = $appointment->appointment_for_lead_id ?? null;
        $title = $appointment->title ?? null;
        if ($appointment->delete()) {
            Notification::create([
                'lead_id' => $leadID,
                'model' => 'Appointment Deleted',
                'title' => 'Appointment <b>' . $appointment->title . '</b> has been deleted for the lead <b>' . $appointment->getLead->title . '</b> by',
                'icon'    => 'fa-solid fa-trash',
                'time'    => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Appointment Deleted Successfully']);
        }
    }

    public function jobListings(Request $request, $duration_starts = null, $duration_ends = null, $category_id = null, $customer_id = null)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $query = Lead::with('customer')->where('lead_status', 'won');
        if (!empty($duration_starts) && !empty($duration_ends)) {
            $query->whereBetween('lead_date', [$duration_starts, $duration_ends]);
        }
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        if (!empty($customer_id)) {
            $query->where('customer_id', $customer_id);
        }
        if (!empty($customerType_id)) {
            $query->whereHas('customer', function ($q) use ($customerType_id) {
                $q->where('customer_type_id', $customerType_id);
            });
        }
        $leads = $query->get();

        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $categories = Category::wherestatus(1)->get();
        $customerTypes = CustomerType::get();
        return view('admin.job_listings', compact('yearEstimation', 'leads', 'customers', 'categories', 'customerTypes'));
    }//end job-listings function.


    public function getEmailTemplate($id)
    {
        $template = EmailTemplate::with('images')->find($id);
        if ($template) {
            $attachments = $template->images->map(function ($image) {
                return [
                    'filepath' => asset('website/' . $image->name) // Correct concatenation
                ];
            });
            return response()->json([
                'status' => 'success',
                'subject' => $template->subject,
                'id' => $template->id,
                'body' => $template->body,
                'attachments' => $attachments
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No email template found.'
            ], 404);
        }//endif.
    }

    public function getProposalTemplate($id = null)
    {
        if ($id === null) {
            return response()->json(['status' => 'error', 'message' => 'No ID provided.'], 400);
        }//ends if.
        $template = ProposalTemplate::with('images')->find($id);
        if ($template) {
            $attachments = $template->images->map(function ($image) {
                return ['filepath' => asset('website/' . $image->name)];
            });
            return response()->json(['attachments' => $attachments]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No email template found.'], 404);
        }//endif.
    }//ends getProposalTemplate function.

    public function yearlyReport(Request $request, $id){
//        $yearestimation  = YearEstimation::with('months')->findorfail($id);
//        $expectedGross   = isset($yearestimation->estimate_amount, $yearestimation->job_convertion_ratio) ? $yearestimation->estimate_amount * ($yearestimation->job_convertion_ratio / 100) : 0;
//        $producedYearly  = $yearestimation->estimate_amount ? $yearestimation->estimate_amount / $yearestimation->estimate_value : 0;
//        $producedWeekly  = $producedYearly ? $producedYearly / $yearestimation->extra_push : 0;
        $yearestimation = YearEstimation::with('months')->findOrFail($id);
        $expectedGross = isset($yearestimation->estimate_amount, $yearestimation->job_convertion_ratio) && $yearestimation->job_convertion_ratio != 0 ? $yearestimation->estimate_amount * ($yearestimation->job_convertion_ratio / 100) : 0;
        $amount = is_numeric($yearestimation->estimate_amount) ? (float)$yearestimation->estimate_amount : 0;
        $value = is_numeric($yearestimation->estimate_value) && $yearestimation->estimate_value != 0 ? (float)$yearestimation->estimate_value : 0;
        $producedYearly = $value != 0 ? $amount / $value : 0;
        $producedWeekly = $producedYearly && $yearestimation->extra_push != 0 ? $producedYearly / $yearestimation->extra_push : 0;
        $finalProductionEarning = Lead::with('getChangeOrder')
            ->whereYear('lead_status_date', $yearestimation->year)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->lead_status_date)->format('F');
            });
        $monthlyLeads = [
            "January"   => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "February"  => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "March"     => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "April"     => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "May"       => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "June"      => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "July"      => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "August"    => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "September" => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "October"   => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "November"  => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
            "December"  => ["count" => 0, "actualLeadscount" => 0, "total" => 0, "leads" => 0],
        ];
        foreach ($finalProductionEarning as $month => $leads) {
            $monthlyLeads[$month] = [
                // Count of 'won' leads
                'count' => $leads->where('lead_status', 'won')->count(),
                'actualLeadscount' => $leads->count(),
                // Correct total calculation:
                'total' => $leads->where('lead_status', 'won')->sum(function($lead) {
                    // Cast lead_price to float (will convert to 0 if null or non-numeric)
                    $leadPrice = (float)($lead->lead_price ?? 0);

                    // Sum approved change orders
                    $changeOrderSum = 0;
                    if ($lead->getChangeOrder) {
                        $changeOrderSum = (float)$lead->getChangeOrder
                            ->where('status', 'approved')
                            ->sum(function($order) {
                                return (float)($order->total_amount ?? 0);
                            });
                    }

                    return $leadPrice + $changeOrderSum;
                }),
                'leads' => $leads
            ];
        }
        $finalProductionEarn = 0;
        if (!empty($monthlyLeads)) {
            foreach ($monthlyLeads as $month => $data) {
                $approvedChangeOrdersTotal = 0;
                if (is_iterable($data['leads'])) {
                    foreach ($data['leads'] as $lead) {
                        if ($lead->lead_status == 'won' && $lead->getChangeOrder) {
                            $approvedChangeOrdersTotal += $lead->getChangeOrder->where('status', 'approved')->sum('total_amount');
                        }
                    }
                }
                $wonLeadsTotal = (float)collect($data['leads'])
                        ->where('lead_status', 'won')
                        ->sum(function($lead) {
                            return (float)($lead->lead_price ?? 0);
                        }) + (float)$approvedChangeOrdersTotal;
//                $monthlyLeads[$month]['total'] = $wonLeadsTotal + $approvedChangeOrdersTotal;
//                $finalProductionEarn += $monthlyLeads[$month]['total'];
                $finalProductionEarn += $wonLeadsTotal;
            }
        }
        $leadProductedYearly = $finalProductionEarn > 0 && $yearestimation->estimate_value != 0 ? $finalProductionEarn / $yearestimation->estimate_value : 1;
        $leadProductedWeekly = $leadProductedYearly > 0 && $yearestimation->extra_push != 0 ? $leadProductedYearly / $yearestimation->extra_push : 1;
        $ProductionExpectedGross = $finalProductionEarn > 0 && $yearestimation->job_convertion_ratio != 0 ? $finalProductionEarn * ($yearestimation->job_convertion_ratio / 100) : 1;
        return view('yearEstimation.year-estimation.yearly_report', compact(
            'yearestimation',
            'monthlyLeads',
            'expectedGross',
            'producedYearly',
            'ProductionExpectedGross',
            'producedWeekly',
            'leadProductedWeekly',
            'leadProductedYearly',
            'finalProductionEarn',
            'finalProductionEarning',
            'expectedGross'
        ));
    }//ends yearlyReport function.

    public function changeLeadDate(Request $request){
        extract($request->all());
        if (Lead::whereid($lead_id)->update(['lead_date' => $lead_date])) {
//            Notification::create([
//
//            ]);
            return back()->with(['type' => 'success', 'message' => 'Lead Date Updated Successfully']);
        } else {
            return back()->with(['type' => 'error', 'message' => 'something wents wrong']);
        }//end if.
    }//ends changeLeadDate function.

    public function bySalesManReport(Request $request, $duration_starts = null, $customerType_id = null, $duration_ends = null, $category_id = null, $representative_id = null)
    {
        extract($request->all());
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $lead = Lead::query();
        $totalLeadCount = $lead->whereYear('lead_status_date', $yearEstimation->year)->count();
        $query = $lead->where('lead_status', 'won');
        if (!empty($duration_starts) && !empty($duration_ends)) {
            $query->whereBetween('created_at', [$duration_starts, $duration_ends]);
        }
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        if (!empty($representative_id)) {
            $query->where('representative_id', $representative_id);
        }
        if (!empty($customerType_id)) {
            $query->whereHas('customer', function ($q) use ($customerType_id) {
                $q->where('customer_type_id', $customerType_id);
            });
        }

        $leads = $query->whereYear('lead_status_date', $yearEstimation->year)->get();
        $lostLead = Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'lost')->count();
        $leadIds = $leads->pluck('id');
        if ($leads->isNotEmpty()) {
            $appointment = Appointment::whereIn('appointment_for_lead_id', $leadIds)
                ->when(!empty($duration_starts) && !empty($duration_ends), function ($q) use ($duration_starts, $duration_ends) {

                    $q->whereBetween('created_at', [$duration_starts, $duration_ends]);
                })->get();
            $changeOrder = ChangeOrder::whereIn('lead_id', $leadIds)
                ->when(!empty($duration_starts) && !empty($duration_ends), function ($q) use ($duration_starts, $duration_ends) {
                    $q->whereBetween('created_at', [$duration_starts, $duration_ends]);
                })
                ->get();
        } else {
            $appointment = collect();
            $changeOrder = collect();
        }//end if.

        $closeRatio = $leads->count() > 0 ? $leads->where('lead_status', 'won')->count() / $leads->count() : 0;
        $netSale = $leads->count() > 0 ?
            $leads->where('lead_status', 'won')->sum(function($lead) {
                return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            }) / max(1, $leads->where('lead_status', 'won')->count()) : 0;

        $salesCommission = $leads->count() > 0 ?
            $leads->where('lead_status', 'won')->sum(function($lead) {
                return is_numeric($lead->sales_commission) ? (float)$lead->sales_commission : 0;
            }) / max(1, $leads->where('lead_status', 'won')->count()) : 0;
        $netSalesPerLead = $leads->count() > 0 ? $salesCommission + $netSale / $leads->where('lead_status', 'won')->count() : 0;
        $valuePerLead = $leads->count() > 0 ?
            $leads->where('lead_status', 'won')->sum(function($lead) {
                return is_numeric($lead->lead_price) ? (float)$lead->lead_price : 0;
            }) / max(1, $leads->where('lead_status', 'won')->count()) : 0;
//        $customers = User::whereHas('roles', function($q){$q->where('name','customer');})->get();
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', 'staff');
        })->get();
        $categories = Category::wherestatus(1)->get();
        $customerTypes = CustomerType::get();
        return view('admin.by_salesman_report', compact('lead', 'yearEstimation', 'leads', 'appointment', 'closeRatio', 'netSale', 'changeOrder', 'valuePerLead', 'staffs', 'categories', 'customerTypes', 'netSalesPerLead', 'lostLead', 'totalLeadCount'));
    }//end function bySalesManReport.

    public function companyPerformance()
    {
        return view('admin.company_performance');
    }//end company-performance function.

    public function profitLossAnalysis()
    {
        return view('admin.profit_loss_analysis');
    }//end profit_loss_analysis function.

    public function createLeads()
    {
        return view('admin.create_leads');
    }//end create_leads function.

    public function emailTemplating()
    {
        return view('admin.email_templating');
    }//end create_leads function.

    public function customerDetail()
    {
        return view('admin.customer_detail');
    }//end customer_detail function.

    public function createStaff()
    {
        return view('admin.create_staff');
    }//end customer_detail function.

    public function uploadAppointmentAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('appointment_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadAppointmentAttachment function.

    public function uploadTaskAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('task_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadTaskAttachment function.

    public function uploadProposalAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('proposal_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadTaskAttachment function.

    public function uploadEmailAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('email_attachment', $request->file);
            return $_FILES['file']['name'];
        }//end if.
        return $images;
    }//end uploadTaskAttachment function.

    public function uploadPhotoAndDocumentsAttachment(Request $request)
    {

        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('photo_and_documents_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadPhotoAndDocumentsAttachment function.

    public function uploadEstimateAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('estimate_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadEstimateAttachment function.

    public function removeAppointmentAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            AppointmentAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeAppointmentAttachment function.

    public function removeProposalAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            ProposalAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeAppointmentAttachment function.

    public function removeEstimateAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            EstimateAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeEstimateAttachment function.

    public function removeEmailAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            UserMailSendAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeAppointmentAttachment function.

    public function removeTaskAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            TaskAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeTaskAttachment function.

    public function removePhotoAndDocumentsAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            PhotoAndDocumentAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }//end if
    }//end removePhotoAndDocumentsAttachment function.

    public function leadDropdown(Request $request)
    {
        $id = $request->id;
        $getData = Lead::where('customer_id', $request->customer_id)->get();
        return (string)view('includes.ajax.get_dropdown_lead', compact('getData', 'id'));
    }//end function categoryDropdown

    public function logActivity()
    {
        if (auth()->user()->hasRole('user'))
            $logs = \App\Helpers\LogActivity::logActivityLists();
        else
            $logs = \App\Helpers\LogActivity::logActivityUsers();
        return view('admin.activitylogs.log_activity', compact('logs'));
    }//end function logActivity.

    public function deleteStream()
    {
        LogActivity::truncate();
        return redirect()->back()->with(['type' => 'success', 'msg' => 'Streams Deleted Successfully']);
    }//end deleteStream function.

    public function deleteLogs(Request $request, $id)
    {
        LogActivity::whereId($id)->delete();
        return redirect()->back()->with(['type' => 'success', 'title' => 'successful', 'message' => 'deleted log succesfully']);
    }//end deleteStream function.

    public function photoAndDocDocumentPrimaryImage(Request $request, $photo_id = null, $lead_id = null)
    {
        extract($request->all());
        PhotoAndDocumentAttachment::where('lead_id', $lead_id)->update(['doc_primary' => 0]);
        PhotoAndDocumentAttachment::where('id', $photo_id)->update(['doc_primary' => 1]);
        return response()->json(['success' => true, 'message' => 'Lead Photo And Document Primary Image Updated Successfully']);
    }//ends photoAndDocDocumentPrimaryImage function.

    public function editLeadJob(Request $request, $lead_id = null){
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $editLead = Lead::where('id', $lead_id)->findorfail($lead_id);
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $representatives = User::whereHas('roles', function ($q) {
            $q->where('name', 'staff');
        })->get();
        $categories = Category::wherestatus(1)->get();
        $roles = Role::get();
        return (string)view('lead.lead.AJAX.edit_lead', compact('editLead', 'customers', 'representatives', 'categories', 'roles', 'yearEstimation'));
    }//ends photoAndDocDocumentPrimaryImage function.


    public function editClientDetails(Request $request, $lead_id = null){
        $yearEstimation = YearEstimation::where('status', 1)->first();
        $editLead = Lead::where('id', $lead_id)->findorfail($lead_id);
        $customers = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $representatives = User::whereHas('roles', function ($q) {
            $q->where('name', 'staff');
        })->get();
        $categories = Category::wherestatus(1)->get();
        $roles = Role::get();
        return (string)view('lead.lead.AJAX.edit_client_details', compact('editLead', 'customers', 'representatives', 'categories', 'roles', 'yearEstimation'));
    }//ends photoAndDocDocumentPrimaryImage function.


//    public function getCustomerDetail(Request $request, $customer_id = null)
//    {
//        extract($request->all());
//        $customer = User::where('id', $customer_id)->first();
//        $customer->whereYear('created_at');
//        return response()->json([
//            'address' => $customer->profile->address,
//            'latitude' => $customer->profile->latitude,
//            'longitude' => $customer->profile->longitude,
//            'city' => $customer->profile->city,
//            'zip' => $customer->profile->zip,
//            'country' => $customer->profile->country,
//            'state' => $customer->profile->state,
//            'created_at' => $customer->created_at,
//            'lead_count' => $customer->customerLeads->count(),
//
//        ]);
//    }//ends photoAndDocDocumentPrimaryImage function.

    //OLD
//    public function getCustomerDetail(Request $request, $customer_id = null){
//        extract($request->all());
//        $customer = User::with('profile', 'customerLeads')->find($customer_id);
//        if (!$customer) {
//            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
//        }
//        $createdYear = $customer->created_at->format('Y');
//
//        $selectedYear = $year ?? now()->format('Y');
//        $leadsCount = Lead::withTrashed()->count() + 1;
//        $customerLeadCount = Lead::withTrashed()->where('customer_id', $customer_id)->count() + 1;
//
//        $leadsInYearCount = Lead::whereYear('lead_date', $year)->count();
//        return response()->json([
//            'address' => $customer->profile->address ?? '',
//            'latitude' => $customer->profile->latitude ?? '',
//            'longitude' => $customer->profile->longitude ?? '',
//            'city' => $customer->profile->city ?? '',
//            'zip' => $customer->profile->zip ?? '',
//            'country' => $customer->profile->country ?? '',
//            'state' => $customer->profile->state ?? '',
//            'created_at' => $customer->created_at,
//            'created_year' => $createdYear,
//            'lead_count' => $leadsInYearCount,
//            'total_lead_count' => $leadsCount,
//            'customer_lead_count' => $customerLeadCount,
//        ]);
//    }

    //OLD

    public function getCustomerDetail(Request $request, $customer_id = null)
    {
        extract($request->all());
        $customer = User::with('profile', 'customerLeads')->find($customer_id);
        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Customer not found'], 404);
        }

        $yearEstimation = YearEstimation::where('status', 1)->first();

        if ($yearEstimation) {
            $createdYear = substr($yearEstimation->year, -2); // jo year select hai table me, last 2 digits only
            $monthThisYear = now()->format('m');
            $date = now()->format('d');

            $leadsCount = Lead::whereYear('lead_status_date', $yearEstimation->year)
                    ->count() + 1;

            // return $leadsCount;

            $customerLeadCount = Lead::withTrashed()->where('customer_id', $customer_id)->count() + 1;

            $leadNumber = 'L' . $createdYear . '-' . $monthThisYear . $date . '-' . $leadsCount . '-' . $customerLeadCount;
        } else {
            $createdYear = now()->format('y');
            $monthThisYear = now()->format('m');
            $date = now()->format('d');
            $leadsCount = Lead::count() + 1;
            $customerLeadCount = Lead::withTrashed()->where('customer_id', $customer_id)->count() + 1;
            $leadNumber = 'L' . $createdYear . '-' . $monthThisYear . $date . '-' . $leadsCount . '-' . $customerLeadCount;
        }

        return response()->json([
            'address' => $customer->profile->address ?? '',
            'latitude' => $customer->profile->latitude ?? '',
            'longitude' => $customer->profile->longitude ?? '',
            'city' => $customer->profile->city ?? '',
            'zip' => $customer->profile->zip ?? '',
            'country' => $customer->profile->country ?? '',
            'state' => $customer->profile->state ?? '',
            'created_at' => $customer->created_at,
            'created_year' => $createdYear,
            'lead_count' => $leadsCount,
            'customer_lead_count' => $customerLeadCount,
            'lead_number' => $leadNumber,
        ]);
    }

    public function phoneAuthentication(Request $request)
    {
        $account_sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');
        $twilio_client = new TwilioClient($account_sid, $auth_token);
        $phoneNumber = $request->input('phone');
        $formattedPhoneNumber = '+1' . preg_replace('/\D/', '', $phoneNumber);
        $duplicatePhone = CustomerPhone::where('phone', $formattedPhoneNumber)->exists();
        if ($duplicatePhone) {
            return response()->json(['valid' => false, 'duplicate' => true, 'message' => 'This phone number is already in use.']);
            return response()->json(['valid' => false, 'duplicate' => true, 'message' => 'This phone number is already in use.']);
        }
        try {
            $lookup = $twilio_client->lookups->v1->phoneNumbers($formattedPhoneNumber)->fetch(["type" => "carrier"]);
            $isValid = !empty($lookup->carrier['type']);
            return response()->json(['valid' => $isValid]);
        } catch (\Exception $e) {
            return response()->json(['valid' => false, 'message' => 'Invalid or unauthentic phone number.']);
        }
    }

    public function emailSendChangeOrder(Request $request, $change_order_id = null)
    {
        extract($request->all());
        try {
            $changeorder = ChangeOrder::where('id', $change_order_id)->first();
            Mail::send('changeOrder.change-order.change_order_email', ['changeorder' => $changeorder], function ($message) use ($changeorder) {
                $message->from('development.aftab@gmail.com')->to($changeorder->getLead->customer->email)->cc('zahid.be.tafsol@gmail.com')->bcc('unaiz.tafsol@gmail.com')->subject('Change Order');
            });
            if ($changeorder) {
                return response()->json(['status' => true, 'message' => 'email sent Successfully']);
            }//END IF
        } catch (\Exception $e) {
            return $e->getMessage();
            die;
        }//end try catch
    }//ends emailSendChangeOrder function.

    public function emailSendInvoice(Request $request, $invoice_id = null)
    {
        extract($request->all());
        try {
            $invoice = Invoice::where('id', $invoice_id)->first();
            Mail::send('invoice.invoice.invoice_email', ['invoice' => $invoice], function ($message) use ($invoice) {
                $message->from('development.aftab@gmail.com')->to($invoice->getLead->customer->email)->cc('araib.be.tafsol@gmail.com')->bcc('unaiz.tafsol@gmail.com')->subject('Invoice');
            });
            if ($invoice) {
                return response()->json(['status' => true, 'message' => 'email sent Successfully']);
            }//END IF
        } catch (\Exception $e) {
            return $e->getMessage();
            die;
        }//end try catch
    }//ends emailSendInvoice function.

    public function emailSendReceivePayment(Request $request, $receive_payment_id = null)
    {
        extract($request->all());
        try {
            $receive_payment = ReceivePayment::where('id', $receive_payment_id)->first();
            Mail::send('receivePayment.receive-payment.receivePayment_email', ['receive_payment' => $receive_payment], function ($message) use ($receive_payment) {
                $message->from('development.aftab@gmail.com')->to($receive_payment->getLead->customer->email)->cc('araib.be.tafsol@gmail.com')->bcc('unaiz.tafsol@gmail.com')->subject('Receive Payment');
            });
            if ($receive_payment) {
                return response()->json(['status' => true, 'message' => 'email sent Successfully']);
            }//END IF
        } catch (\Exception $e) {
            return $e->getMessage();
            die;
        }//end try catch
    }//ends emailSendReceivePayment function.


//    public function dashboard(Request $request)
//    {
//        $yearEstimation  = YearEstimation::where('status',1)->orderBy('created_at', 'desc')->first();
//        $startsyear = YearEstimation::first()->year ?? 2024;
//        $lastYearEstimation = YearEstimation::latest('year')->first()->year ?? 2035;
//        if ($yearEstimation){
//            $leads = Lead::whereYear('lead_date', $yearEstimation->year)->get();
//        }else{
//            $leads = Lead::get();
//        }
//        if(!empty($leads) ) {
//            if (!auth()->user()->hasRole('user')){
//                $lead = $leads->where('representative_id', auth()->user()->id)->orwhere('customer_id', auth()->user()->id);
//            } else {
//                $lead = $leads;
//            }//end if.
//        }//ends if.
//        $groupedLeads    = $lead->groupBy('representative_id');
//        $leadsCount      = $groupedLeads->count();
//        $changeorder     = ChangeOrder::get();
//        $stages          = Stage::wherestatus(1)->get();
//        $announcements   = [];
//        if(auth()->user()->hasRole('user')) {
//            $announcements = Announcement::get();
//        } else {
//            $announcements = AssignAnnouncement::where('user_id',auth()->user()->id)->get()->pluck('announcement')->flatten();
//        }//end else if.
//        return view('dashboard.index', compact('groupedLeads','startsyear','lastYearEstimation', 'leadsCount', 'changeorder', 'yearEstimation', 'stages', 'lead', 'announcements'));
//    }//end function dashboard.

    public function dashboard(Request $request){
        $user = auth()->user();

        if ($user->hasRole('subcontractor')) {
            $userId = auth()->user()->id;
            $subcontractor = User::where('id', $userId)->whereHas('roles', function($q) {
                $q->where('name', 'subcontractor');
            })->first();
            $yearEstimation = YearEstimation::where('status',1)->first();
            $schedulingtask = SchedulingTask::with('getSchedulingUser')->where('subcontractor_id', $userId)->get();
            return view('dashboard.subContractorDashboard.index', compact('subcontractor','yearEstimation','schedulingtask'));
        }
        if ($user->hasRole('customer')) {
            $leads = Lead::where('customer_id', $user->id)->with('getAppointment', 'schedulingTask')->get();
            $referrals = CustomerReferral::where('customer_id', $user->id)->get();
            return view('dashboard.customerDashboard.customer-index', compact('leads', 'referrals'));
        }

        $yearEstimations = YearEstimation::orderBy('year', 'asc')->get();
        $yearEstimation = $yearEstimations->where('status', 1)->first();
        if (request('year') === 'all_year') {
            $startsyear = $yearEstimations->first()->year ?? now()->year; // Earliest available year
            $lastYearEstimation = $yearEstimations->last()->year ?? now()->year; // Latest available year
        } else {
            $startsyear = request('year') ?? ($yearEstimation->year ?? now()->year);
            $lastYearEstimation = $yearEstimation->latest('year')->first()->year ?? now()->year;
        }
        $year = $yearEstimation ? $yearEstimation->year : date('Y');
        $fromDate = $year ? "{$year}-01-01" : null;
        $toDate = $year ? "{$year}-12-31" : null;
        $query = Lead::query(); // Start with a query builder instance
        if ($yearEstimation) {
            $query->whereYear('lead_date', $yearEstimation->year);
        }//ends if.
        if (!$user->hasRole('user')) {
            $query->where(function ($query) use ($user) {
                $query->where('customer_id', $user->id)
                    ->orWhere('representative_id', $user->id);
            });
        }//ends if.
        $lead = Lead::get();
        $selectedYear = request('year');
        $successLead = Lead::where('lead_status', 'won')->whereYear('lead_status_date', $year)->get();
        $groupedLeads = $lead->groupBy('representative_id');
        $leadsCount = $groupedLeads->count();
        $stages = Stage::whereStatus(1)->get();
        // $announcements = [];
        // if (auth()->user()->hasRole('user')) {
        //     $announcements = Announcement::get();
        // } else {
        //     $announcements = AssignAnnouncement::where('user_id', auth()->user()->id)->get()->pluck('announcement')->flatten();
        // }//ends if.
        $notificationList = Notification::orderBy('id', 'Desc')->take(100)->get();
        // $changeOrder = ChangeOrder::get();
        return view('dashboard.index', compact('notificationList', 'year', 'groupedLeads', 'startsyear', 'lastYearEstimation', 'leadsCount', 'yearEstimation', 'stages', 'lead', 'fromDate', 'toDate', 'successLead', 'yearEstimations'));
    }


    public function statusChangeStages($id = null, $status = null)
    {
        if (Stage::where('id', $id)->update(['status' => $status])) {
            LeadStage::where('stage_id', $id)->update(['status' => $status]);
            return redirect('stage/stage')->with('flash_message', 'Status Updated!');
        }//endif.
        return response(view('403'), 403);
    }//end function statusChangeStages.

    public function statusChangeCampaign($id = null, $status = null)
    {
        if ($status == 1) {
            if (Campaign::where('id', $id)->update(['status' => $status])) {
                return redirect('campaign/campaign?campaign_type=active')->with('flash_message', 'Status Updated!');
            }//ends if.
        } else {
            if (Campaign::where('id', $id)->update(['status' => $status])) {
                return redirect('campaign/campaign?campaign_type=inactive')->with('flash_message', 'Status Updated!');
            }
        }//ends if...
        return response(view('403'), 403);
    }//end function statusChangeCampaign.


    public function statusChangeAppointment($id = null, $status = null)
    {
        $result = Appointment::statusChangeAppointment($id, $status);
        if ($result) {
            return back()->with('flash_message', 'Status Updated!');
        } else {
            return back()->with('error_message', 'Failed to update status.');
        }//end if.
    }//ends function statusChangeAppointment.


//    public function statusChangeAppointment($id = null, $status = null)
//    {
//        if (Appointment::where('id', $id)->update(['status' => $status])) {
//            return redirect('appointment/appointment')->with('flash_message', 'Status Updated!');
//        }//end if.
//        return response(view('403'), 403);
//    }//end function statusChangeAppointment.


    public function profileUpdate(Request $request){
        if (auth()->user()) {
            $data = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name ?? auth()->user()->first_name,
                'last_name' => $request->last_name ?? auth()->user()->last_name,
                'email' => $request->email ?? auth()->user()->email,
            ];
            if ($file = $request->file('pic_file')) {
                $extension = $file->extension() ?: 'png';
                $destinationPath = public_path() . '/storage/uploads/users/';
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                $image = $safeName;
            } else {
                $image = auth()->user()->profile->pic;
            }//end if
            if ($file = $request->file('company_logo')) {
                $extension = $file->extension() ?: 'png';
                $destinationPath = public_path() . '/storage/uploads/company/';
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                $companyImage = $safeName;
            } else {
                $companyImage = auth()->user()->profile->company_logo;
            }
            User::where('id', auth()->user()->id)->update($data);
            Profile::where('user_id', auth()->user()->id)->update([
                'address' => $request->address ?? auth()->user()->profile->address,
                'phone' => $request->phone ?? auth()->user()->profile->phone,
                'dob' => $request->dob ?? auth()->user()->profile->dob,
                'pic' => $image,
                'company_name' => $request->company_name ?? auth()->user()->profile->company_name,
                'company_email' => $request->company_email ?? auth()->user()->profile->company_email,
                'company_phone' => $request->company_phone ?? auth()->user()->profile->company_phone,
                'company_website' => $request->company_website ?? auth()->user()->profile->company_website,
                'company_license_number' => $request->company_license_number ?? auth()->user()->profile->company_license_number,
                'company_license' => $request->company_license ?? auth()->user()->profile->company_license,
                'company_address' => $request->company_address ?? auth()->user()->profile->company_address,
                'company_country' => $request->company_country ?? auth()->user()->profile->company_country,
                'company_state' => $request->company_state ?? auth()->user()->profile->company_state,
                'company_city' => $request->company_city ?? auth()->user()->profile->company_city,
                'company_postal_code' => $request->company_postal_code ?? auth()->user()->profile->company_postal_code,
                'company_longitude' => $request->company_longitude ?? auth()->user()->profile->company_longitude,
                'company_latitude' => $request->company_latitude ?? auth()->user()->profile->company_latitude,
                'company_logo' => $companyImage,
            ]);
            return back()->with('flash_message', 'Profile updated!');
        } else {
            return response(view('403'), 403);
        }//end if.
    }//end function profileUpdate.

    public function changeUserPassword(Request $request)
    {

        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            return redirect()->back()->with(['type' => 'success', 'msg' => "Ditt lösenord har uppdaterats", 'title' => 'Framgång']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'msg' => "Något gick fel", 'title' => 'förlåt']);
        }
    }//end function changeUserPassword.

    public function checkPasswordvalid(Request $request)
    {
        $password = $request->input('password');
        $user = User::findOrFail(auth()->user()->id);
        if (Hash::check(trim($password), $user->password)) {
            return response()->json(true);
        } else {
            return response()->json("Password does not match");
        }//ends if..
    }//end function checkPasswordvalid

    public function checkEmail(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return 'yes';
        } else {
            return 'no';
        } // End if.

    }//end checkEmail function.

    public function checkRole(Request $request)
    {
        if (Role::where('name', $request->roleName)->exists()) {
            return 'yes';
        } else {
            return 'no';
        }//end if.
    }//end checkEmail function.

    public function stagesUpdate(Request $request){
//        return $request->all();
        extract($request->all());
        $stagePosition = Stage::withTrashed()->findorfail($stage_id);
        $lead_stage = LeadStage::where('lead_id', $lead_id)->where('stage_id', $stage_id)->first();
        $lead_stage->update(['date' => $date]);
        $lead = Lead::findOrFail($lead_id);
        if ($lead->update(['stage_id' => $stage_id, 'stage_position' => $stagePosition->position])) {
            if (isset($stagePosition) && !empty($stagePosition)) {
                Notification::create([
                    'lead_id' => $lead_id,
                    'model'   => 'Stage Update',
                    'title'   => 'Lead stage updated to <b>' . $stagePosition->name . '</b> for the lead <b>' . $lead->title . '</b> by ',
                    'icon'    => 'fa-solid fa-layer-group',
                    'time'    => $stagePosition->created_at,
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if,
            return back()->with('flash_message', 'Stages updated successfully!');
        }//end if.
        return response(view('403'), 403);
    }//end function stagesUpdate

    public function getLogs(Request $request)
    {
        return $logs = Activity::get();
    }//end function getLogs.

    public function leadByStages(Request $request, $stage_id = null, $year=null){
        $user = auth()->user();
        $query = Lead::where('stage_id', $stage_id)
            ->when($year, function ($q) use ($year) {
                return $q->whereYear('lead_date', $year);
            });
        if (!$user->hasRole('user')) {
            $query->where(function ($q) use ($user) {
                $q->where('customer_id', $user->id)
                    ->orWhere('representative_id', $user->id);
            });
        }
        $leadByStages = $query->get();
        $stage = Stage::findorfail($stage_id);
        return view('admin.lead_by_stages', compact('leadByStages', 'stage'));
    }//end function leadByStages.

    public function mailConfiguration()
    {
        if (auth()->user()) {
            $usersMailboxConfigurationData = UsersMailboxConfiguration::where('user_id', Auth::id())->first();
            return view('usersMailboxConfiguration.users-mailbox-configuration.mail_configuration', compact('usersMailboxConfigurationData'));
        }//end if
        return abort('403', __('You are not authorized'));
    }//end mailConfiguration function.

    public function materialAssignToLead(Request $request)
    {
        $data = $request->all();
        if (!empty($data['lead_ids'])) {
            foreach ($data['lead_ids'] as $lead_id) {
                $material = Material::create([
                    'lead_id' => $lead_id,
                    'name' => $data['name'] ?? null,
                ]);
                if ($request->material_attachment != '') {
                    foreach (explode(',', $request->material_attachment) as $key => $value) {
                        MaterialAttachment::create([
                            'material_id' => $material->id,
                            'name' => $value,
                        ]);
                    }//end foreach.
                }//end foreach
            }//ends foreach.
        }//ends if.
        return back()->with('flash_message', 'Material created successfully!');
    }//ends function materialAssignToLead.

    public function annoucementAssignToUsers(Request $request)
    {
        $data = $request->all();
        if (!empty($data['user_ids'])) {
            $users = User::whereIn('id', $data['user_ids'])->get();
            $description = $data['description'] ?? '';
            foreach ($users as $user) {
                Mail::raw($description, function ($message) use ($user, $description) {
                    $message->from('development.aftab@gmail.com', 'LEADUP');
                    $message->to($user->email, $user->name);
                    $message->subject('Announcement For You');
                });
            }//end foreach
        }//end if.
        return back()->with('flash_message', 'Announcement sent successfully!');
    }//ends function annoucementAssignToUsers.

    public function annoucementAssignToStaff(Request $request)
    {
        $data = $request->all();
        $announcement = Announcement::create(['description' => $data['description'] ?? "",]);//ends announcement.
        $userIds = $data['user_ids'] ?? [];
        if (!empty($userIds)) {
            $storedTeamMembers = [];
            $teamUsers = UserTeam::whereIn('user_id', $userIds)->get();//get team members.
            foreach ($teamUsers as $teamUser) {
                AssignAnnouncement::create([
                    'announcement_id' => $announcement->id,
                    'user_id' => $teamUser->user_id,
                    'team_id' => $teamUser->team_id,
                ]);
                $storedTeamMembers[] = $teamUser->user_id;
            }//end foreach.
            $newUserIds = array_diff($userIds, $storedTeamMembers);//get new users.
            foreach ($newUserIds as $userId) {
                AssignAnnouncement::create([
                    'announcement_id' => $announcement->id,
                    'user_id' => $userId,
                    'team_id' => null,
                ]);
            }//end foreach.
        }//end if.
        return back()->with('flash_message', 'Announcement created successfully!');
    }//ends function annoucementAssignToUsers.

    public function taskAssignToLead(Request $request)
    {
        $data = $request->all();
        if (!empty($data['lead_ids'])) {
            foreach ($data['lead_ids'] as $lead_id) {
                $task = Task::create([
                    'title' => $data['title'] ?? '',
                    'priority_id' => $data['priority_id'] ?? null,
                    'due_date' => $data['due_date'] ?? null,
                    'assign_to_lead_id' => $lead_id ?? null,
                    'description' => $data['description'] ?? null,
                    'assign_to_team_id' => $data['assign_to_team_id'] ?? null,
                ]);
                if (!empty($data['assign_to_user_id'])) {
                    foreach ($data['assign_to_user_id'] as $user_id) {
                        TaskAssignUser::create([
                            'task_id' => $task->id,
                            'user_id' => $user_id,
                        ]);
                    }//end foreach
                }//endif.
                if (!empty($request->task_attachment)) {
                    foreach (explode(',', $request->task_attachment) as $attachment) {
                        TaskAttachment::create([
                            'task_id' => $task->id,
                            'name' => $attachment,
                        ]);
                    }//end foreach
                }//endif.
            }//end foreach
        }
        return back()->with('flash_message', 'Task created successfully!');
    }//end function taskAssignToLead.


    public function estimateProposalAssignToLead(Request $request)
    {
        $data = $request->all();
        if (!empty($data['lead_ids'])) {
            foreach ($data['lead_ids'] as $lead_id) {
                $lead = Estimate::create([
                    'lead_id' => $lead_id,
                ]);
                if ($request->estimate_attachment != '') {
                    foreach (explode(',', $request->estimate_attachment) as $key => $value) {
                        EstimateAttachment::create([
                            'estimate_id' => $lead->id,
                            'name' => $value
                        ]);
                    }//end foreach.
                }//end if.
            }//ends foreach.
        }//ends if.
        return back()->with('flash_message', 'Estimate created successfully!');
    }//ends function estimateProposalAssignToLead.

    public function jobNoteAssignToLead(Request $request)
    {
        $data = $request->all();
        if (!empty($data['lead_ids'])) {
            foreach ($data['lead_ids'] as $lead_id) {
                $job_note = JobNote::create([
                    'lead_id' => $lead_id,
                    'description' => $data['job_description'] ?? null,
                    'status' => 1,
                ]);
                if (!empty($data['job_note_attachment'])) {
                    foreach (explode(',', $data['job_note_attachment']) as $attachment) {
                        JobNoteAttachment::create([
                            'job_note_id' => $job_note->id,
                            'name' => $attachment,
                        ]);
                    }//end foreach
                }//endif.
            }//end foreach
        }//ends if.
        return back()->with('flash_message', 'Job note created successfully!');
    }//ends function jobNoteAssignToLead.

    public function messageAssignToLead(Request $request)
    {
        try {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_AUTH_TOKEN');
            $twilio_number = env('TWILIO_NUMBER');
            $twilio_client = new TwilioClient($account_sid, $auth_token);
            $message = strip_tags($request->message);
            $lead = Lead::find($request->lead_id);
            if ($lead) {
                $customerPhone = @$lead->customer->customerPhonePrimary->phone ?? null;
                if ($customerPhone) {
                    $to = $customerPhone;
                    try {

                        //old works starts from here

                        $result = $twilio_client->messages->create($to, [
                            'from' => $twilio_number,
                            'body' => $message,
                        ]);
                        // Store MessageSid with the lead or in a session to correlate the reply
                        // Store in the database (create a relationship or store a field in the Message table)
                        Message::create([
                            'lead_id' => $request->lead_id,
                            'message' => $request->message,
                            'twilio_message_sid' => $result->sid??'', // Store the Message SID
                            'send_to' => $to??'', // Store the conversation SID
                        ]);
                        Notification::create([
                            'lead_id' => $request->lead_id,
                            'model'   => 'Message Sent',
                            'title'   => 'Message sent against the lead <b>' . $lead->title . '</b> to the customer <b>' . $lead->customer->name . '</b> by',
                            'icon'    => 'fa-solid fa-envelope',
                            'time'    => now(),
                            'user_id' => auth()->user()->id,
                        ]);
                    } catch (\Twilio\Exceptions\RestException $e) {
                        Log::error("Twilio Error: " . $e->getMessage());
                    }
                } else {
                    Log::error("Customer phone not found for lead ID: " . $request->lead_id);
                }
            } else {
                Log::error("Lead not found for ID: " . $request->lead_id);
            }
        } catch (Exception $e) {
            Log::error("General Error: " . $e->getMessage());
            return $e->getMessage();
        }

        return back()->with('flash_message', 'Message sent successfully!');
    }


    public function incomingMessages(Request $request) {
        try {

            $messageSid = $request->input('MessageSid');
            $from = $request->input('From');
            $to = $request->input('To');
            $body = $request->input('Body');
            $conversation = Message::where('send_to',$from)->latest()->first();
            $leadRecord = Lead::where('id', $conversation->lead_id)->first();
            Message::create([
                'twilio_message_sid' => $messageSid,
                'send_to' => $to??null,
                'reply_from' => $from,
                'message' => $body,
                'message_type' => 'incoming',
                'lead_id'=>$conversation->lead_id??null
            ]);
            Notification::create([
                'lead_id' => $conversation->lead_id??null,
                'model'   => 'Message Received',
                'title'   => 'New message received against the lead <b>' . $leadRecord->title,
                'icon'    => 'fa-solid fa-envelope',
                'time'    => now(),
                'user_id' => $leadRecord->customer->id??null,
            ]);

        }catch (\Exception $e){
            Log::error("Error in incomingMessages function: " . $e->getMessage());
            return response('Internal Server Error', 500); // Internal Server Error if something goes wrong
        }
    }//end incomingMessages function.



    public function incomingMessagesError(Request $request) {
        try {

            Log::error("Error in incomingMessages function: " . json_encode($request->all()));
        }catch (\Exception $e){
            Log::error("Error in incomingMessages function: " . $e->getMessage());
        }
    }//end incomingMessages function.




    public function mailConfigurationStore(Request $request)
    {
        extract($request->all());
        if ($test_connection_hidden != 'false') {
            $config = [
                'host' => "$mail_host",
                'port' => 993,
                'encryption' => "$encryption",
                'validate_cert' => true,
                'username' => "$mail_address",
                'password' => "$password",
                'protocol' => "$protocol",
            ];
            $clientManager = new ClientManager();
            $client = $clientManager->make($config);
            try {
                $client->connect();
                $request['test_connection_hidden'] = false;
                UsersMailboxConfiguration::updateOrCreate(['user_id' => Auth::id()], [
                    'user_id' => Auth::id(),
                    'mail_host' => $mail_host,
                    'mail_port' => $port,
                    'mail_encryption_type' => $encryption,
                    'mail_username' => $mail_address,
                    'password' => $password,
                    'mail_protocol' => $protocol,
                    'status' => 1
                ]);
                return redirect()->back()->withInput($request->all())->with(['type' => 'success', 'message' => 'Connection Successful and Configuration stored.']);
            } catch (\Exception $e) {
                return redirect()->back()->withInput($request->all())->with(['type' => 'error', 'error_message' => ucwords($e->getMessage())]);
            }//end if else.
        }
        return abort('403', __('You are not authorized'));
    }//end mailConfigurationStore function.

    public function deleteEmails(Request $request)
    {
        extract($request->all());
        $url = $request->input('url');
        if ($url == 'userMailSend/user-mail-send?email_slug=inbox') {
            return UserMailSend::whereIn('id', $ids)->delete();
        } elseif ($url == 'userMailSend/user-mail-send?email_slug=sent') {
            return UsersMailboxesSent::whereIn('id', $ids)->delete();
        } elseif ($url == 'userMailSend/user-mail-send?email_slug=trash') {
            return UsersMailboxesSent::withTrashed()->whereIn('id', $ids)->forceDelete();
        } else {
            return 0;
        }//end if else.
    }//end deleteEmails function.

    public function deleteEmailTemplate(Request $request)
    {
        extract($request->all());
        $deleted = EmailTemplate::whereIn('id', $ids)->delete();
        if ($deleted) {
            return response()->json(['status' => true, 'message' => 'Email Template  Deleted Successfully']);
        }
    }//end deleteEmailTemplate function.


    public function deleteInboxEmails(Request $request, $ids)
    {
        extract($request->all());

        $url = $request->input('url');
        if ($url == 'userMailSend/user-mail-send?email_slug=inbox') {
            return UserMailSend::findOrFail($ids)->delete();
        } elseif ($url == 'userMailSend/user-mail-send?email_slug=sent') {
            return UsersMailboxesSent::findOrFail($ids)->delete();
        } elseif ($url == 'userMailSend/user-mail-send?email_slug=trash') {
            return UsersMailboxesSent::withTrashed()->findOrFail($ids)->forceDelete();
        } else {
            return 0;
        }//end if else.
    }//end deleteEmails function.


    public function deleteTrashEmails(Request $request)
    {
        extract($request->all());
        return UsersMailboxesSent::whereIn('id', $ids)->forceDelete();
    }//end deleteTrashEmails function.

    public function EmailSend(Request $request)
    {
//        return $request->all();
        if (!auth()->check()) {
            return abort(403, __('You are not authorized'));
        }
        try {
            $requestData = $request->all();
            $userData = UsersMailboxConfiguration::where('user_id', Auth::id())->firstOrFail();
            $emailTemplate = EmailTemplate::where('id', $requestData['template_id'])->first();
            $recipients = User::whereIn('id', $requestData['user_ids'] ?? [])->get();
            if ($recipients->isEmpty()) {
                return redirect()->back()->with(['type' => 'warning', 'message' => 'No recipients found.']);
            }//end if.
            $attachments = [];
            if ($emailTemplate) {
                foreach ($emailTemplate->images as $fileAttachment) {
                    $attachments[] = public_path('website/' . $fileAttachment->name);
                }
            } else {
                if ($mailAttachments = $request->file('mail_attachment')) {
                    if ($mailAttachments && is_array($mailAttachments)) {
                        foreach ($mailAttachments as $file) {
                            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('emails_attachment'), $filename);
                            $filePath = 'emails_attachment/' . $filename;
                            $fileAttachment = public_path($filePath);
                            $attachmentsDB[] = $filePath; // Add file path to $attachmentsDB
                            $attachments[] = $fileAttachment;
                        }//end foreach.
                    }//end if.
                }//end if
            }//end else if.
            foreach ($recipients as $user) {
                $emailDetails = [
                    'from' => $userData->mail_username,//ends from.
                    'to' => $user->email,//ends to.
                    'subject' => $emailTemplate ? $emailTemplate->subject : $request->subject,//ends subject.
                    'body' => $emailTemplate ? strip_tags($emailTemplate->body) : strip_tags($request->message),//ends body.
                    'cc' => $request->email_cc ?? 'null',//ends cc.
                    'bcc' => $request->email_bcc ?? ' null',//ends bcc.
                    'attachments' => $attachments //ends attachments.
                ];
                SendEmailJob::dispatch($emailDetails, Auth::id());//ends dispatch.
            }//end if.
            return redirect()->back()->with(['type' => 'success', 'message' => 'Emails have been sent successfully.']);
        } catch (\Exception $e) {
            return $e->getMessage();
            die;
            return redirect()->back()->with(['type' => 'error', 'message' => 'Unable to send email, check your email configurations.']);
        }
    }//ends function EmailSend.


    public function sendEmailToUsers(Request $request)
    {
        if (!auth()->user()) {
            return abort(403, __('You are not authorized'));
        }
        try {
            $mailMessage = $request->description;
            $userData = UsersMailboxConfiguration::where('user_id', Auth::id())->firstOrFail();
            $attachments = [];
            $mailAttachments = $request->mail_attachments;
            if ($mailAttachments && is_array($mailAttachments)) {
                foreach ($mailAttachments as $file) {
                    $attachmentUrl = asset('website') . '/' . $file;
                    if (!in_array($attachmentUrl, $attachments)) {
                        $attachments[] = $attachmentUrl;
                    }
                }
            }
            $user_ids = array_filter($request->user_ids, function ($value) {
                return !is_null($value);
            });
            $userEmails = User::whereIn('id', $user_ids)->get();
            $templateMessage = $mailMessage;
            foreach ($userEmails as $index => $email) {
                $mailMessage = $templateMessage;
                $placeholders = [
                    '%{customer_name}%&nbsp;',
                    '%{email}%&nbsp;&nbsp;',
                    '%{company}%',
                    // '%{date}%' (Uncomment if needed)
                ];
                $replacements = [
                    ($email->name ?? 'ABC') . ',',
                    ($email->email ?? 'N/A'),
                    ($email->company ?? 'N/A'),
                    // date('Y-m-d') (Uncomment if needed)
                ];
                $mailMessage = str_replace($placeholders, $replacements, $mailMessage);
                Mail::raw($mailMessage, function ($message) use ($email, $attachments, $userData, $request) {
                    foreach ($attachments as $attachment) {
                        $message->attach($attachment);
                    }
                    $message->from($userData->mail_username, 'LEAD UP')
                        ->to($email->email)
                        ->subject($request->subject);
                });
            }
            foreach ($userEmails as $userEmail) {
                UsersMailboxesSent::create([
                    'user_id' => Auth::user()->id,
                    'configuration_email' => $userData->mail_username,
                    'to' => $userEmail,
                    'from' => $userData->mail_username,
                    'message' => $mailMessage,
                    'mail_attachment' => json_encode(array_map('basename', $attachments)),
                    'subject' => $request->subject
                ]);
            }
            return back()->with('flash_message', 'Email sent successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

//    public function addEmailToLead(Request $request){
//        try {
////            return $request->all();
//            $mailMessage = strip_tags(html_entity_decode($request->message));
//            $attachments = [];
//            $attachmentsDB = [];
//            $mailAttachments = $request->file('mail_attachment');
//            if ($mailAttachments && is_array($mailAttachments)) {
//                foreach ($mailAttachments as $file) {
//                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//                    $file->move(public_path('emails_attachment'), $filename);
//                    $filePath = 'emails_attachment/' . $filename;
//                    $fileAttachment = public_path($filePath);
//                    $attachmentsDB[] = $filePath; // Add file path to $attachmentsDB
//                    $attachments[] = $fileAttachment;
//                }//end foreach.
//            }//emd if.
//            $userEmail = Lead::where('id', $request->lead_id)->first();//ends user.
//            Mail::raw($mailMessage, function ($message) use ($request, $userEmail, $attachments) {
//                foreach ($attachments as $attachment) {
//                    $message->attach($attachment);//
//                }//end if.
//                $message->from(env('MAIL_USERNAME'))
//                    ->to($userEmail->customer->email)
//                    ->cc($userEmail->representative->email)
//                    ->subject($request->subject);
//            });
//            LeadMail::create([
//                'lead_id' => $request->lead_id,
//                'from' => env('MAIL_USERNAME'),
//                'message' => $mailMessage,
//                'mail_attachment' => json_encode($attachmentsDB),
//                'subject' => $request->subject,
//            ]);
//            if (isset($userEmail) && !empty($userEmail)) {
//                Notification::create([
//                    'lead_id' => $userEmail->id,
//                    'model'   => 'Email Created',
//                    'title'   => 'Email with subject <b>' . $request->subject . '</b> has been created by .',
//                    'icon'    => 'fa-solid fa-envelope',
//                    'time'    => $userEmail->created_at,
//                    'user_id' => auth()->user()->id,
//                ]);
//            }//ends if.
//            return back()->with('flash_message', 'Send Email Successfully!');
//        } catch (\Exception $e) {
//            return back()->with(['title' => 'Fail', 'message' => 'Something went wrong', 'type' => 'error']);
//        }//end trycatch
//    }//ends function addEmailToLead.
    public function addEmailToLead(Request $request){
        extract($request->all());
        try {
            $mailMessage = strip_tags(html_entity_decode($request->message));
            $attachments = [];
            $mailAttachments = $request->mail_attachments;
            if ($mailAttachments && is_array($mailAttachments)) {
                foreach ($mailAttachments as $file) {
                    $attachmentUrl = asset('website') . '/' . $file;
                    if (!in_array($attachmentUrl, $attachments)) {
                        $attachments[] = $attachmentUrl;
                    }
                }
            }
            $userEmail = Lead::where('id', $request->lead_id)->first();
            if (!$userEmail) {
                return back()->with(['message' => 'Lead not found.', 'type' => 'error']);
            }
            $placeholders = [
                '%{customer_name}%',
                '%{name}%',
                '%{email}%',
                '%{company_id}%',
                '%{address}%',
                '%{category_id}%',
                '%{representative_id}%',
                '%{title}%',
                '%{customer_type_id}%',
                '%{contact}%',
                '%{number}%',
                '%{salesman_id}%',
                '%{referral_source_id}%',
                '%{user_id}%',
                '%{city}%',
                '%{state}%',
                '%{country}%',
                '%{zip}%',
                '%{phone}%',
                '%{lead_price}%',
                '%{lead_date}%',
                '%{minimum_days}%',
                '%{maximum_days}%',
                '%{other_information}%',
                '%{claim_number}%',
                '%{policy_number}%',
                '%{phone_insurance}%',
                '%{fax_number}%',
                '%{email_insurance}%',
                '%{adjust_name_insurance}%',
                '%{adjust_phone_insurance}%',
                '%{adjust_email_insurance}%',
                '%{contract_signed_date}%',
                '%{date_loss_insurance}%',
                '%{claim_filled_date}%',
            ];
            $replacements = [
                ($userEmail->customer->name ?? 'ABC'),
                ($userEmail->customer->name ?? 'ABC'),
                ($userEmail->customer->email ?? 'N/A'),
                ($userEmail->customer->company ?? 'N/A'),
                ($userEmail->customer->profile->address ?? 'N/A'),
                ($userEmail->category->name ?? 'N/A'),
                ($userEmail->representative->name ?? 'N/A'),
                ($userEmail->title ?? 'N/A'),
                ($userEmail->customer->customerType->name ?? 'N/A'),
                ($userEmail->customer->customerPhones->first()->phone ?? 'N/A'),
                ($userEmail->customer->customerPhones->first()->phone ?? 'N/A'),
                ($userEmail->category->salesman_id ?? 'N/A'),
                ($userEmail->category->referral_source_id ?? 'N/A'),
                ($userEmail->customer->name ?? 'N/A'),
                ($userEmail->customer->profile->city ?? 'N/A'),
                ($userEmail->customer->profile->state ?? 'N/A'),
                ($userEmail->customer->profile->country ?? 'N/A'),
                ($userEmail->customer->profile->zip ?? 'N/A'),
                ($userEmail->customer->customerPhones->first()->phone ?? 'N/A'),
                ($userEmail->lead_price ?? 'N/A'),
                ($userEmail->lead_date ?? 'N/A'),
                ($userEmail->minimum_days ?? 'N/A'),
                ($userEmail->maximum_days ?? 'N/A'),
                ($userEmail->other_information ?? 'N/A'),
                ($userEmail->claim_number ?? 'N/A'),
                ($userEmail->policy_number ?? 'N/A'),
                ($userEmail->phone_insurance ?? 'N/A'),
                ($userEmail->fax_number ?? 'N/A'),
                ($userEmail->email_insurance ?? 'N/A'),
                ($userEmail->adjust_name_insurance ?? 'N/A'),
                ($userEmail->adjust_phone_insurance ?? 'N/A'),
                ($userEmail->adjust_email_insurance ?? 'N/A'),
                ($userEmail->contract_signed_date ?? 'N/A'),
                ($userEmail->date_loss_insurance ?? 'N/A'),
                ($userEmail->claim_filled_date ?? 'N/A'),
            ];
            $mailMessage = str_replace($placeholders, $replacements, $mailMessage);
            Mail::raw($mailMessage, function ($message) use ($request, $userEmail, $attachments) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
                $message->from(env('MAIL_USERNAME'))
                    ->to($userEmail->customer->email)
                    ->cc($userEmail->representative->email)
                    ->subject($request->subject);
            });
            LeadMail::create([
                'lead_id' => $request->lead_id,
                'from' => env('MAIL_USERNAME'),
                'message' => $mailMessage,
                'mail_attachment' => json_encode($attachments),
                'subject' => $request->subject,
            ]);
            Notification::create([
                'lead_id' => $userEmail->id,
                'model' => 'Email Created',
                'title' => 'Email with subject <b>' . $request->subject . '</b> has been created.',
                'icon' => 'fa-solid fa-envelope',
                'time' => now(),
                'user_id' => auth()->user()->id,
            ]);
            return back()->with('flash_message', 'Send Email Successfully!');
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return back()->with(['title' => 'Fail', 'message' => 'Something went wrong: ' . $e->getMessage(), 'type' => 'error']);
        }
    }

    public function updateStageDate(Request $request, $id = null)
    {
        $leadStage = LeadStage::findOrFail($request->id);
        $yearEstimation = YearEstimation::where('status', 1)->first();
        return (string)view('includes.ajax.date_update_modal', compact('leadStage', 'yearEstimation'));
    }

    public function updateLeadStatusDate(Request $request, $id = null){
        $lead = Lead::findOrFail($request->id);
        $yearEstimation = YearEstimation::where('status', 1)->first();
        return (string)view('includes.ajax.lead_update_status_date_modal', compact('lead', 'yearEstimation'));
    }

//    public function updateStageDateModal(Request $request, $id=null){
//        $leadStage = LeadStage::findOrFail($request->id);
//        $date = Carbon::parse($request->input('date'))->format('Y-m-d');
//        $leadStage->update([
//            'date' => $date,
//        ]);
//        return back()->with('flash_message', 'Date Changed Successfully!');
//    }

//    public function updateLeadPrice(Request $request)
//    {
//        extract($request->all());
//        if ($lead = Lead::whereid($lead_id)->update(['tax_type' => $tax_type ?? "", 'lead_amount' => $lead_amount ?? '', 'lead_price' => $lead_price ?? "", 'tax' => $tax ?? "", 'lead_price_with_change_order_price' => $lead_price ?? ""])) {
//            if (isset($lead_id) && !empty($lead_id)) {
//                Notification::create([
//                    'lead_id' => $lead->id,
//                    'model' => 'Lead Price Updated',
//                    'title' => "Lead price updated against the lead <b>{$lead->title}</b> by",
//                    'icon' => "fa fa-refresh",
//                    'time' => Carbon::now(),
//                    'user_id' => auth()->user()->id,
//                ]);
//            }//ends if.
//            return back()->with('flash_message', 'Price updated successfully!');
//        }//end if.
//        return response(view('403'), 403);
//    }//end function updateLeadPrice.
    public function updateLeadPrice(Request $request)
    {
        extract($request->all());

        // Ensure the lead exists before updating
        $lead = Lead::find($lead_id);

        if (!$lead) {
            return response()->json(['status' => 'error', 'message' => 'Lead not found'], 404);
        }

        // Update the lead fields
        $isUpdated = $lead->update([
            'tax_type' => $tax_type ?? "",
            'lead_amount' => $lead_amount ?? '',
            'lead_price' => $lead_price ?? "",
            'tax' => $tax ?? "",
            'lead_price_with_change_order_price' => $lead_price ?? "",
        ]);

        $formatted_price = number_format($lead_price, 2);

        if ($isUpdated) {
            // Create a notification if the lead ID is valid
            Notification::create([
                'lead_id' => $lead->id,
                'model' => 'Lead Price Updated',
                'title' => "Lead price updated with amount <b>{$formatted_price}</b> against the lead <b>{$lead->title}</b> by",
                'icon' => "fa fa-refresh",
                'time' => Carbon::now(),
                'user_id' => auth()->user()->id,
            ]);

            return back()->with('flash_message', 'Price updated successfully!');
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to update lead price'], 500);
    }


    public function uploadJobAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('job_note_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadJobAttachment function.

    public function removeJobAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            JobNoteAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeJobAttachment function.

    public function uploadProposalTemplateAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('proposal_template_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadJobAttachment function.


    public function removeProposalTemplateAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            ProposalTemplateAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeJobAttachment function.


    public function uploadEmailTemplateAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('email_template_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadJobAttachment function.


    public function removeEmailTemplateAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            EmailTemplateAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeJobAttachment function.

    public function uploadMaterialAttachment(Request $request)
    {
        $images = "";
        if ($request->hasFile('file')) {
            return $this->storeImage('material_attachment', $request->file);
            return $_FILES['file']['name'];
        }
        return $images;
    }//end uploadMaterialAttachment function.

    public function removeMaterialAttachment(Request $request)
    {
        if ($request->id == 0) {
            return ($this->deleteImage($request->image_name));
        } else {
            MaterialAttachment::where('id', $request->id)->delete();
            return ($this->deleteImage($request->image_name));
        }
    }//end removeMaterialAttachment function.

    public function statusChangeJobnote($id = null, $status = null)
    {
        if (JobNote::where('id', $id)->update(['status' => $status])) {
            return redirect('jobNote/job-note')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangeJobnote.

    public function statusChangePaymentType($id = null, $status = null)
    {
        if (PaymentType::where('id', $id)->update(['status' => $status])) {
            return redirect('paymentType/payment-type')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangePaymentType.

    public function statusChangeMark($id = null, $status = null)
    {
        if (Mark::where('id', $id)->update(['status' => $status])) {
            return redirect('mark/mark')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangeMark.

    public function statusChangeCategory($id = null, $status = null)
    {
        if (Category::where('id', $id)->update(['status' => $status])) {
            return redirect('category/category')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangeCategory.

    public function statusChangeReferralSource($id = null, $status = null)
    {
        if (ReferralSource::where('id', $id)->update(['status' => $status])) {
            return redirect('referralSource/referral-source')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangeReferralSource.

    public function statusChangePriority($id = null, $status = null)
    {
        if (Priority::where('id', $id)->update(['status' => $status])) {
            return redirect('priority/priority')->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function statusChangePriority.

    public function updatePositions(Request $request)
    {
        $positions = $request->input('positions');
        foreach ($positions as $index => $stageId) {
            $stage = Stage::find($stageId);
            if ($stage) {
                $stage->position = $index + 1;
                $stage->save();
                LeadStage::where('stage_id', $stageId)->update(['position' => $index + 1]);
            }//ends if....
        }//ends foreach...
        return response()->json(['message' => 'Positions updated successfully']);
    }//end function updatePositions.

    public function updateLeadPositions(Request $request)
    {
        $positions = $request->input('positions');
        foreach ($positions as $index => $leadId) {
            $lead = Lead::find($leadId);
            if ($lead) {
                $lead->position = $index + 1;
                $lead->save();
//                LeadStage::where('stage_id', $stageId)->update( [ 'position' => $index + 1 ]);
            }//ends if....
        }//ends foreach...
        return response()->json(['message' => 'Positions updated successfully']);
    }//end function updatePositions.

    public function reportingForStages(Request $request)
    {
        $stages = Stage::where('status', 1)->get();
        return view('admin.reporting_for_stages', compact('stages'));
    }//end function reportingForStages.

    public function months(Request $request)
    {
        $stages = $request->stage_id ?? "0";
        $months = [];
        $startMonth = 1; //January is represented by month number 1
        for ($i = 0; $i < 12; $i++) {
            $month = ($startMonth + $i - 1) % 12 + 1;
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $months[] = $monthName;
        }//end for.
        return view('admin.reporting_months', compact('months', 'stages'));
    }//end function months

//    public function monthlySalesReport(Request $request){
//        $stage_ids = $request->input('stage_id', []);
//        $months = $request->input('month', []);
//        $query = Lead::query();
////        return $query->get();
//        $user = auth()->user();
//        if (!empty($stage_ids)) {
//            $query->whereIn('stage_id', $stage_ids);
//        }
//        if (!empty($months)) {
//            $query->where('lead_status', 'won');
//            $query->where(function ($query) use ($months) {
//                foreach ($months as $month) {
//                    $query->orWhereMonth('lead_status_date', '=', $month);
//                }
//            });
//        }
//        if (!$user->hasRole('user')) {
//            $query->where(function ($query) use ($user) {
//                $query->where(function ($query) use ($user) {
//                    $query->where('customer_id', $user->id)
//                        ->orWhere('representative_id', $user->id);
//                });
//            });
//        }//ends if...
//        $leads = $query->get();
//        $monthNames = $leads->map(function ($lead) {
//            return Carbon::parse($lead->lead_status_date)->format('F');
//        })->unique();
//        $leadYear = $leads->isNotEmpty() ? Carbon::parse($leads->first()->lead_status_date)->year : Carbon::now()->year;
//        return $yearEstimations = YearEstimation::with(['months' => function ($query) use ($monthNames) {
//            $query->whereIn('name', $monthNames);
//        }])->where('year', '=', $leadYear)->get();
//        $totalLeadPricePerMonth = [];
//        foreach ($yearEstimations as $estimation) {
//            foreach ($estimation->months as $month) {
//                $totalLeadPricePerMonth[$month->name] = 0;
//            }//emd foreach...
//        }//ends foreach...
//        foreach ($leads as $lead) {
//            $monthName = Carbon::parse($lead->lead_status_date)->format('F');
//            if (isset($totalLeadPricePerMonth[$monthName])) {
//                $totalLeadPricePerMonth[$monthName] += $lead->lead_price + $lead->getChangeOrder->where('status', 'approved')->sum('total_amount');
//            }//ends if...
//        }//ends foreach...
//        $goalAchievementPercentages = [];
//        foreach ($yearEstimations as $estimation) {
//            foreach ($estimation->months as $month) {
//                if (isset($totalLeadPricePerMonth[$month->name])) {
//                    $goalAchievementPercentages[$month->name] = $totalLeadPricePerMonth[$month->name] / max($month->amount, 1) * 100;
//                }//end  if...
//            }//ends foreach...
//        }//ends foreach...
//        $customerCount = $leads->whereNotNull('customer_id')->groupBy('customer_id')->pluck('customer.name')->unique()->count();
//        $groupedLeads = $leads->groupBy('stage_id');
//        $sortedMonths = $monthNames->sort()->values()->all();
//        return view('admin.monthly_sales_report', compact('leads', 'sortedMonths', 'totalLeadPricePerMonth', 'customerCount', 'goalAchievementPercentages', 'yearEstimations', 'groupedLeads'));
//    }//ends function monthlySalesReport.
    public function monthlySalesReport(Request $request)
    {
        $yearEstimation = YearEstimation::whereStatus('1')->first();
        $stage_ids = $request->input('stage_id', []);
        $months = $request->input('month', []);
        $query = Lead::query();
        $user = auth()->user();
        // Apply stage filters if provided
        if (!empty($stage_ids)) {
            $query->whereIn('stage_id', $stage_ids);
        }

        // Apply month filters if provided
        if (!empty($months)) {
            $query->where('lead_status', 'won')->whereYear('lead_status_date', $yearEstimation->year);
            // Wrap the months check in an OR condition
            $query->where(function ($query) use ($months) {
                foreach ($months as $month) {
                    $query->orWhereMonth('lead_status_date', '=', $month);  // This will check for each provided month
                }
            });
        }

        // Apply user role check to further filter
        if (!$user->hasRole('user')) {
            $query->where(function ($query) use ($user) {
                $query->where(function ($query) use ($user) {
                    $query->where('customer_id', $user->id)
                        ->orWhere('representative_id', $user->id);
                });
            });
        }

        // Get the leads based on the final query
        $leads = $query->get();

        // Process month names
        $monthNames = $leads->map(function ($lead) {
            return Carbon::parse($lead->lead_status_date)->format('F');
        })->unique();

        // Determine the lead year
        $leadYear = $leads->isNotEmpty() ? Carbon::parse($leads->first()->lead_status_date)->year : Carbon::now()->year;

        // Retrieve year estimations
        $yearEstimations = YearEstimation::with(['months' => function ($query) use ($monthNames) {
            $query->whereIn('name', $monthNames);
        }])->where('year', '=', $leadYear)->get();

        // Calculate total lead price per month
        $totalLeadPricePerMonth = [];
        foreach ($yearEstimations as $estimation) {
            foreach ($estimation->months as $month) {
                $totalLeadPricePerMonth[$month->name] = 0;
            }
        }

        foreach ($leads as $lead) {
            $monthName = Carbon::parse($lead->lead_status_date)->format('F');
            if (isset($totalLeadPricePerMonth[$monthName])) {
                $totalLeadPricePerMonth[$monthName] += (float) ($lead->lead_price ?? 0) + (float) ($lead->getChangeOrder->where('status', 'approved')->sum('total_amount') ?? 0);
            }
        }

        // Calculate goal achievement percentages
        $goalAchievementPercentages = [];
        foreach ($yearEstimations as $estimation) {
            foreach ($estimation->months as $month) {
                if (isset($totalLeadPricePerMonth[$month->name])) {
                    $goalAchievementPercentages[$month->name] = $totalLeadPricePerMonth[$month->name] / max($month->amount, 1) * 100;
                }
            }
        }

        // Group leads by customer
        $customerCount = $leads->whereNotNull('customer_id')->groupBy('customer_id')->pluck('customer.name')->unique()->count();

        // Group leads by stage
        $groupedLeads = $leads->groupBy('stage_id');

        // Sort months
        $sortedMonths = $monthNames->sort()->values()->all();

        return view('admin.monthly_sales_report', compact('leads', 'sortedMonths', 'totalLeadPricePerMonth', 'customerCount', 'goalAchievementPercentages', 'yearEstimations', 'groupedLeads'));
    }



    public function signature()
    {
        return view('changeOrder.change-order.create');
    }//end function signature.

    public function signatureStore(Request $request)
    {
        $mouseSignature = $request->input('mouseSignature');
        $keyboardSignature = $request->input('keyboardSignature');
        return redirect('/signature')->with('success', 'Signatures saved successfully.');
    }//end function signatureStore.

    public function fetchAddress($lead_id){
        $lead = Lead::find($lead_id);
        if (!$lead) {
            return response()->json(['error' => 'Lead not found'], 404);
        }
        return response()->json([
            'title' => $lead->title,
            'address' => $lead->address,
            'customer_name' => $lead->customer->name ?? "",
            'customer_id' => $lead->customer_id ?? "",
            'representative_id' => $lead->representative_id,
            //'address' => $lead->customer->profile->address,
            'state' => $lead->customer->profile->state ?? "",
            'city' => $lead->customer->profile->city ?? "",
            'zip' => $lead->customer->profile->zip ?? "",
            'upload_signature' => $lead->customer->profile->upload_signature ?? "",
        ]);
    }//end function fetchAddress.

    public function fetchData($lead_id)
    {
        $lead = Lead::find($lead_id);
        if (!$lead) {
            return response()->json(['error' => 'Lead not found'], 404);
        }
        return response()->json(['address' => $lead->address, 'customer_id' => $lead->customer->name, 'lead_price' => $lead->lead_price, 'tax' => $lead->tax ?? "0",]);
    }//end function fetchData.

    public function getCustomerData($customer_id)
    {
        $customer = User::find($customer_id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        return response()->json(['address' => $customer->profile->address]);
    }

//    public function storeCampaign(Request $request){
////        return $request->all();
//        $data = $request->all();
//        $latestCampaignDetailId = 0;
//        if ($request->campaign_id != 0) {
//            $campaign = Campaign::findOrFail($request->campaign_id);
//            $campaignData = [
//                'name' => $data['name'] ?? null,
//                'stage_id' => $data['stage_id'] ?? null,
//                'status' => $data['status'] ?? null,
//                'play_or_resume' => $data['play_or_resume'] ?? null,
//                'created_by' => auth()->id(),
//            ];
//            $campaignData = array_filter($campaignData);
//            $campaign->update($campaignData);
//        } else {
//            $campaignData = [
//                'name' => $data['name'] ?? null,
//                'stage_id' => $data['stage_id'] ?? null,
//                'status' => $data['status'] ?? null,
//            ];
//            $campaignData = array_filter($campaignData);
//            $campaign = Campaign::create($campaignData);
//        }
//        if (isset($data['campaign']) && is_array($data['campaign'])) {
//            foreach ($data['campaign'] as $camp) {
//                for ($i = 0; $i < count($camp['time']); $i++) {
//                    if (!empty($camp['time'][$i] ?? null)) {
//                        $campaignDetailData = [
//                            'campaign_id' => $campaign->id,
//                            'day' => $camp['days'][$i] ?? null,
//                            'time' => $camp['time'][$i] ?? null,
//                            'message_type' => $camp['message_type'][$i] ?? null,
//                            'subject' => $camp['subject'][$i] ?? null,
//                            'message' => $camp['message'][$i] ?? null,
//                            'email_template_id' => $camp['email_template_id'][$i] ?? null,
//                            'timestamp' => $camp['timestamp'][$i] ?? null,
//                        ];
//                        $campaignDetailData = array_filter($campaignDetailData);
//                        $campaignDetail = CampaignDetail::updateOrCreate(
//                            ['timestamp' => $campaignDetailData['timestamp']],
//                            $campaignDetailData
//                        );
//                        if (isset($camp['mail_attachment'][$i])) {
//                            $campaignAttachmentData = [
//                                'campaign_detail_id' => $campaignDetail->id,
//                                'name' => $camp['mail_attachment'][$i] ?? null,
//                            ];
//                            $campaignAttachment = CampaignAttachment::updateOrCreate(
//                                ['campaign_detail_id' => $campaignDetail->id],
//                                $campaignAttachmentData
//                            );
//                        }
//                        $latestCampaignDetailId = max($latestCampaignDetailId, $campaignDetail->id);
//                    }
//                }
//            }
//        }
//        return [
//            'is_valid' => true,
//            'campaign_id' => $campaign->id,
//            'campaignDetail_id' => $latestCampaignDetailId,
//        ];
//    }
    public function storeCampaign(Request $request)
    {
        $data = $request->all();
        $latestCampaignDetailId = 0;

        // Check if campaign exists or create a new one
        if ($request->campaign_id != 0) {
            $campaign = Campaign::findOrFail($request->campaign_id);
            $campaignData = [
                'name' => $data['name'] ?? null,
                'stage_id' => $data['stage_id'] ?? null,
                'status' => $data['status'] ?? null,
                'play_or_resume' => $data['play_or_resume'] ?? null,
                'created_by' => auth()->id(),
            ];
            $campaignData = array_filter($campaignData);
            $campaign->update($campaignData);
        } else {
            $campaignData = [
                'name' => $data['name'] ?? null,
                'stage_id' => $data['stage_id'] ?? null,
                'status' => $data['status'] ?? null,
            ];
            $campaignData = array_filter($campaignData);
            $campaign = Campaign::create($campaignData);
        }

        // Process campaign details
        if (isset($data['campaign']) && is_array($data['campaign'])) {
            foreach ($data['campaign'] as $camp) {
                for ($i = 0; $i < count($camp['time']); $i++) {
                    if (!empty($camp['time'][$i] ?? null)) {
                        // Prepare campaign detail data
                        $campaignDetailData = [
                            'campaign_id' => $campaign->id,
                            'day' => $camp['days'][$i] ?? null,
                            'time' => $camp['time'][$i] ?? null,
                            'message_type' => $camp['message_type'][$i] ?? null,
                            'subject' => $camp['subject'][$i] ?? null,
                            'message' => $camp['message'][$i] ?? null,
                            'email_template_id' => $camp['email_template_id'][$i] ?? null,
                            'timestamp' => $camp['timestamp'][$i] ?? null,
                        ];
                        $campaignDetailData = array_filter($campaignDetailData);

                        // Create or update campaign detail
                        $campaignDetail = CampaignDetail::updateOrCreate(
                            ['timestamp' => $campaignDetailData['timestamp']],
                            $campaignDetailData
                        );

                        $latestCampaignDetailId = max($latestCampaignDetailId, $campaignDetail->id);

                        // Handle attachments for the current reminder
                        if (isset($camp['reminders'][$i + 1]['mail_attachment']) &&
                            is_array($camp['reminders'][$i + 1]['mail_attachment'])) {
                            foreach ($camp['reminders'][$i + 1]['mail_attachment'] as $attachment) {
                                if (!empty($attachment)) {
                                    CampaignAttachment::updateOrCreate([
                                        'campaign_detail_id' => $campaignDetail->id,
                                        'name' => $attachment,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
        return [
            'is_valid' => true,
            'campaign_id' => $campaign->id,
            'campaignDetail_id' => $latestCampaignDetailId,
        ];
    }

    public function updateCampaign(Request $request){
//        return $request->all();
        $data = $request->all();
        $latestCampaignDetailId = 0;
        if ($request->campaign_id != 0) {
            $campaign = Campaign::findOrFail($request->campaign_id);
            $campaignData = [
                'name' => $data['name'] ?? null,
                'stage_id' => $data['stage_id'] ?? null,
                'status' => $data['status'] ?? null,
                'play_or_resume' => $data['play_or_resume'] ?? null,
            ];
            $campaignData = array_filter($campaignData);
            $campaign->update($campaignData);
            if (isset($data['campaign']) && is_array($data['campaign'])) {
                foreach ($data['campaign'] as $camp) {
                    for ($i = 0; $i < count($camp['time']); $i++) {
                        if (!empty($camp['time'][$i] ?? null)) {
                            $campaignDetailData = [
                                'campaign_id' => $campaign->id,
                                'day' => $camp['days'][$i] ?? null,
                                'time' => $camp['time'][$i] ?? null,
                                'message_type' => $camp['message_type'][$i] ?? null,
                                'subject' => $camp['subject'][$i] ?? null,
                                'message' => $camp['message'][$i] ?? null,
                                'timestamp' => $camp['timestamp'][$i] ?? null,
                            ];
                            $campaignDetailData = array_filter($campaignDetailData);
                            $campaignDetail = CampaignDetail::updateOrCreate(
                                ['timestamp' => $campaignDetailData['timestamp']], $campaignDetailData);
                            $latestCampaignDetailId = max($latestCampaignDetailId, $campaignDetail->id);
                            if (isset($camp['reminders'][$i + 1]['mail_attachment']) &&
                                is_array($camp['reminders'][$i + 1]['mail_attachment'])) {
                                foreach ($camp['reminders'][$i + 1]['mail_attachment'] as $attachment) {
                                    if (!empty($attachment)) {
                                        CampaignAttachment::updateOrCreate([
                                            'campaign_detail_id' => $campaignDetail->id,
                                            'name' => $attachment,
                                        ]);
                                    }
                                }
                            }

                        }
                    }
                }
            }
        } else {
            $campaignData = [
                'name' => $data['name'] ?? null,
                'stage_id' => $data['stage_id'] ?? null,
                'status' => $data['status'] ?? null,
            ];
            $campaignData = array_filter($campaignData);
            $campaign = Campaign::create($campaignData);
            if (isset($data['campaign']) && is_array($data['campaign'])) {
                foreach ($data['campaign'] as $camp) {
                    for ($i = 0; $i < count($camp['time']); $i++) {
                        if (!empty($camp['time'][$i] ?? null)) {
                            $campaignDetailData = [
                                'campaign_id' => $campaign->id,
                                'day' => $camp['days'][$i] ?? null,
                                'time' => $camp['time'][$i] ?? null,
                                'message_type' => $camp['message_type'][$i] ?? null,
                                'subject' => $camp['subject'][$i] ?? null,
                                'message' => $camp['message'][$i] ?? null,
                                'timestamp' => $camp['timestamp'][$i] ?? null,
                            ];
                            $campaignDetailData = array_filter($campaignDetailData);
                            $campaignDetail = CampaignDetail::create($campaignDetailData);
                            $latestCampaignDetailId = max($latestCampaignDetailId, $campaignDetail->id);

                            CampaignAttachment::where('campaign_detail_id', $campaignDetail->id)->delete();
                            if (isset($camp['reminders'][$i + 1]['mail_attachment']) &&
                                is_array($camp['reminders'][$i + 1]['mail_attachment'])) {
                                foreach ($camp['reminders'][$i + 1]['mail_attachment'] as $attachment) {
                                    if (!empty($attachment)) {
                                        CampaignAttachment::updateOrCreate([
                                            'campaign_detail_id' => $campaignDetail->id,
                                            'name' => $attachment,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return ['is_valid' => true, 'campaign_id' => $campaign->id, 'campaignDetail_id' => $latestCampaignDetailId,];
    }//end function updateCampaign.

    public function updateCampaignPlayOrResume(Request $request)
    {
        $campaignId = $request->input('campaign_id');
        $playOrResumeValue = $request->input('play_or_resume');
        $campaign = Campaign::find($campaignId);
        if (!$campaign) {
            return response()->json(['message' => 'Campaign not found'], 404);
        }
        $campaign->update(['play_or_resume' => $playOrResumeValue]);
        return response()->json(['play_or_resume' => $playOrResumeValue]);
    }//end function updateCampaignPlayOrResume.

    public function deleteCampaign($id)
    {
        $campaignDetail = CampaignDetail::findOrFail($id);
        $campaignDetail->delete();
        return response()->json(['message' => 'Campaign detail deleted successfully']);
    }//end function deleteCampaign.

    public function deleteCampaignDetail($id)
    {
        $campaignDetail = CampaignDetail::find($id);
        if (!$campaignDetail) {
            return response()->json(['error' => 'Campaign detail not found for ID: ' . $id], 404);
        }
        $campaignDetail->delete();
        return response()->json(['message' => 'Campaign detail deleted successfully']);
    }//end function deleteCampaignDetail.

    public function campaign(Request $request)
    {
        $campaign = Campaign::with('getStages')->where('status', 'draft')->latest()->first();
        $stages = Stage::where('status', 1)->get();
        $campaignDetail = CampaignDetail::get();
        $emailTemplates = EmailTemplate::get();
        $emailTemplateFolder = EmailTemplateFolder::whereStatus('1')->get();
        return view('admin.campaign', compact('campaign', 'stages', 'campaignDetail', 'emailTemplates', 'emailTemplateFolder'));
    }//ends function campaign.

    public function getCampaignEmailTemplate($id)
    {
        $emailTemplate = EmailTemplate::with('images')->find($id);
        if ($emailTemplate) {
            $images = $emailTemplate->images->map(function ($image) {
                return [
                    'name' => $image->name,
                    'url' => asset('website/' . $image->name)
                ];
            });
            return response()->json([
                'subject' => $emailTemplate->subject,
                'note' => strip_tags($emailTemplate->body),
                'images' => $images,
            ]);
        } else {
            return response()->json(['error' => 'Template not found'], 404);
        }
    }

    public function viewChangeOrderPdf()
    {
        return view('view_change_order_pdf');
    }//end function viewChangeOrderPdf.

    public function fetchEmails()
    {
        // Gmail IMAP configuration
        $config = [
            'host' => 'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ];
        // Connect to the mailbox
        $clientManager = new ClientManager();
        $client = $clientManager->make($config);
        $client->connect();
        // Get the INBOX folder
        $folder = $client->getFolder('INBOX');
        //Get all unseen emails in the INBOX folder
        $emails = $folder->query()->unseen()->get();
//      $emails = $folder->query()->seen()->get();
        //Process each email
        foreach ($emails as $email) {
            // Access email details
            $subject = $email->getSubject();
            $from = $email->getFrom()[0]->mailbox . '@' . $email->getFrom()[0]->host;
            $to = $email->getTo()[0]->mailbox . '@' . $email->getTo()[0]->host;
            $body = $email->getHTMLBody(); //HTML body
            $bodyPlain = $email->getTextBody(); // Plain text body
            // Process the email data as per your requirements
            // ...
        }

        //Disconnect from the mailbox
        $client->disconnect();
        // Return a response or perform any further actions
    }//end function fetchEmails.

//    public function campaignCron(){
//        $campaigns = Campaign::with('getCampaignDetailMessage')->wherestatus(1)->where('play_or_resume', 1)->get();
//        foreach ($campaigns as $campaign) {
//            foreach ($campaign->getCampaignDetailMessage as $campaignDetail) {
//                $currentDay = Carbon::parse($campaignDetail->created_at)->diffInDays(now()) + $campaignDetail->day;
//                $currentTime = Carbon::now()->format('H:i');
//                if ($currentDay == $campaignDetail->day && $currentTime === $campaignDetail->time) {
//                    $messageType = $campaignDetail->message_type;
//                    if ($messageType === 'email') {
//                        try {
//                            $leads = Lead::where('stage_id', $campaign->stage_id)->get();
//                            $subject = $campaignDetail->subject;
//                            $message = $campaignDetail->message;
//                            foreach ($leads as $lead) {
//                                $user = User::find($lead->customer_id);
//                                if ($user) {
//                                    $to = $user->email;
//                                    Mail::raw($message, function ($emailMessage) use ($to, $subject) {
//                                        $emailMessage->to($to)->subject($subject);
//                                    });
//                                }//ends if.
//                            }//ends foreach.
//                            return true;
//                        } catch (\Exception $e) {
//                            return false;
//                        }//ends tryCatch.
//                    } elseif ($messageType === 'phone') {
//                        try {
//                            $account_sid = env('TWILIO_SID');
//                            $auth_token = env('TWILIO_AUTH_TOKEN');
//                            $twilio_number = env('TWILIO_NUMBER');
////                            $twilio_number = "+18446580060";
//                            $twilio_client = new TwilioClient($account_sid, $auth_token);
//                            $leads = Lead::where('stage_id', $campaign->stage_id)->get();
//                            $message = $campaignDetail->message;
//                            foreach ($leads as $lead) {
//                                $customerPhones = CustomerPhone::where('customer_id', $lead->customer_id)->get();
//                                if ($customerPhones) {
//                                    foreach ($customerPhones as $customerPhone) {
//                                        $to = '+1' . $customerPhone->phone;
//                                        try {
//                                            $result = $twilio_client->messages->create($to, [
//                                                'from' => $twilio_number,
//                                                'body' => $message,
//                                            ]);
//                                        } catch (\Twilio\Exceptions\RestException $e) {
//                                            error_log("Twilio Error: " . $e->getMessage());
//                                        }//end tryCatch.
//                                    }//ends foreach.
//                                }//ends if.
//                            }//end foreach.
//                        } catch (Exception $e) {
//                            return $e->getMessage();
//                        }//ends tryCatch.
//                    }//else if
//                }//end if
//            }//end foreach
//        }//end foreach
//    }//end function campaignCrone.

    public function campaignCron()
    {
        $campaigns = Campaign::with('getCampaignDetailMessage')->whereStatus(1)->where('play_or_resume', 1)->get();

        foreach ($campaigns as $campaign) {
            foreach ($campaign->getCampaignDetailMessage as $campaignDetail) {
                $currentDay = Carbon::parse($campaignDetail->created_at)->diffInDays(now()) + $campaignDetail->day;
                $currentTime = Carbon::now()->format('H:i');

                // Match the current day and time for this campaign detail
                if ($currentDay == $campaignDetail->day && $currentTime === $campaignDetail->time) {
                    $messageType = $campaignDetail->message_type;

                    if ($messageType === 'email') {
                        try {
                            $leads = Lead::where('stage_id', $campaign->stage_id)->get();
                            $subject = $campaignDetail->subject;
                            $message = $campaignDetail->message;
                            $emailsSent = [];
                            $attachments = [];
                            if (!empty($campaignDetail->email_template_id)) {
                                $templateAttachments = EmailTemplate::find($campaignDetail->email_template_id)->images;
                                foreach ($templateAttachments as $image) {
                                    $filePath = public_path('website/' . $image->name);
                                    if (file_exists($filePath)) {
                                        $attachments[] = $filePath;
                                    }
                                }
                            }
                            $manualAttachments = $campaignDetail->campaignAttachment;
                            foreach ($manualAttachments as $attachment) {
                                $filePath = public_path('website/' . $attachment->name);
                                if (file_exists($filePath)) {
                                    $attachments[] = $filePath;
                                }
                            }

                            foreach ($leads as $lead) {
                                $user = User::find($lead->customer_id);

                                if ($user) {
                                    // Prepare placeholders and personalized content
                                    $placeholders = [
                                        '%{customer_name}%',
                                        '%{name}%',
                                        '%{email}%',
                                        '%{company}%',
                                    ];
                                    $replacements = [
                                        ($user->name ?? 'ABC'),
                                        ($user->name ?? 'ABC'),
                                        ($user->email ?? 'N/A'),
                                        ($user->company ?? 'N/A'),
                                    ];

                                    $personalizedMessage = str_replace($placeholders, $replacements, $message);
                                    $to = $user->email;

                                    if (!empty($to)) {
                                        // Send email
                                        Mail::send([], [], function ($emailMessage) use ($to, $subject, $personalizedMessage, $attachments) {
                                            $emailMessage
                                                ->to($to)
                                                ->subject($subject)
                                                ->setBody($personalizedMessage, 'text/html');

                                            // Attach all collected attachments
                                            foreach ($attachments as $filePath) {
                                                $emailMessage->attach($filePath, [
                                                    'as' => basename($filePath),
                                                    'mime' => mime_content_type($filePath),
                                                ]);
                                            }
                                        });

                                        // Log sent email
                                        $emailsSent[] = $to;
                                    } else {
                                        error_log("User has no email address. Lead ID: {$lead->id}");
                                    }
                                } else {
                                    error_log("User not found for Lead ID: {$lead->id}");
                                }
                            }

                            // Log the emails that were sent for this campaign detail
                            \Log::info('Emails sent for campaign detail ID: ' . $campaignDetail->id . ' - Emails: ' . implode(', ', $emailsSent));
                        } catch (\Exception $e) {
                            // Log error for email sending failure
                            error_log("Email sending failed for campaign detail ID: " . $campaignDetail->id . " - Error: " . $e->getMessage());
                        }
                    }
                }
            }
        }
    }



    public function emailView($id)
    {
        $email = UsersMailboxesSent::withTrashed()->find($id);
        return view('admin.email_view', compact('email'));
    }//end function emailView.

    public function truncateActivityLogCroneJob()
    {
        $logs = LogActivity::orderBy('created_at', 'asc')->take(50)->get();
        foreach ($logs as $log) {
            $log->delete();
        }
    }//end function truncateActivityLogCroneJob.

    public function notification()
    {
        $notificationList = PlatformNotification::orderBy('id', 'desc')->get();
        $notificationTypes = [
            'category' => Category::class,
            'appointment' => Appointment::class,
            'lead' => Lead::class,
            'user' => User::class,
            'announcement' => Announcement::class,
            'changeOrder' => ChangeOrder::class,
            'jobNote' => JobNote::class,
            'invoice' => Invoice::class,
            'task' => Task::class,
            'stage' => Stage::class,
            'receivePayment' => ReceivePayment::class,
            'campaign' => Campaign::class,
            'team' => Team::class,
            'photoAndDocument' => PhotoAndDocument::class,
            'proposal' => Proposal::class,
            'mark' => Mark::class,
            'material' => Material::class,
            'emailTemplate' => EmailTemplate::class,
            'proposalTemplate' => ProposalTemplate::class,
            'priority' => Priority::class,
        ];
        $notifications = [];
        foreach ($notificationTypes as $notificationType => $model) {
            $latestNotifications = $model::latest()->get();
            $existingNotifications = PlatformNotification::withTrashed()
                ->where('model', $notificationType)
                ->pluck('title')
                ->toArray();
            foreach ($latestNotifications as $notification) {
                if ($notificationType == 'user') {
                    $user_id = User::latest()->first()->id;
                } else {
                    $user_id = $notification->user_id ?: $notification->representative_id ?: (
                    ($notification->lead_id && $lead = Lead::find($notification->lead_id)) ? $lead->representative_id : null) ?: (
                    ($notification->assign_to_lead_id && $lead = Lead::find($notification->assign_to_lead_id)) ? $lead->representative_id : null) ?: (
                    ($notification->appointment_for_lead_id && $lead = Lead::find($notification->appointment_for_lead_id)) ? $lead->representative_id : null);
                }
                $lead_id = $notification->lead_id ?: $notification->assign_to_lead_id ?: $notification->appointment_for_lead_id ?: null;
                $title = $notification->title ?: $notification->name ?: null;
                $created_by = $notification->created_by ?: null;
                if (!in_array($title, $existingNotifications)) {
                    $notificationData = [
                        'title' => $title,
                        'model' => $notificationType,
                        'user_id' => $user_id,
                        'lead_id' => $lead_id,
                        'created_by' => $created_by,
                    ];
                    // Check if the notification already exists (including soft-deleted)
                    $existingNotification = PlatformNotification::withTrashed()
                        ->where('model', $notificationType)
                        ->where('title', $title)
                        ->first();
                    if ($existingNotification) {
                        // Restore the soft-deleted notification
                        $existingNotification->restore();
                    } else {
                        // Create a new notification
                        PlatformNotification::create($notificationData);
                    }
                    // Update the existingNotifications array
                    $existingNotifications[] = $title;
                }
            }
        }
        return view('admin.notification', compact('notifications', 'notificationList'));
    }//end function notification.

    public function deleteNotification($id = null)
    {
        $notificationDelete = PlatformNotification::find($id);
        $notificationDelete->delete();
        $unseenNotificationsCount = \App\PlatformNotification::where('status', 'unseen')->count();
        return response()->json(['status' => 'success', 'unseenCount' => $unseenNotificationsCount]);
    }//end function deleteNotification.

    public function notificationDeleteMultiple(Request $request)
    {
        $notificationIDs = $request->ids;
        if ($notificationIDs) {
            PlatformNotification::whereIn('id', $notificationIDs)->delete();
//            return  'success';
            $unseenNotificationsCount = \App\PlatformNotification::where('status', 'unseen')->count();
            return response()->json(['status' => 'success', 'unseenCount' => $unseenNotificationsCount]);
        } else {
            return response()->json(['success' => false, 'message' => 'Notification not found']);
        }
        return response()->json(['type' => 'error', 'message' => 'Notification ID is not provided.']);
    }//end function notificationDeleteMultiple

    public function stageMultipleDelete(Request $request)
    {
        $stageIDs = $request->ids;
        if ($stageIDs) {
            Stage::whereIn('id', $stageIDs)->delete();
            LeadStage::whereIn('stage_id', $stageIDs)->delete();
            return response()->json(['success' => true, 'message' => 'Stage deleted succesfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Stage not found']);
        }
    }//ends function stageMultipleDelete.

    public function staffMultipleDelete(Request $request)
    {
        $staffIDs = $request->ids;
        if ($staffIDs) {
            User::whereIn('id', $staffIDs)->delete();
            return 'success';
        } else {
            return response()->json(['success' => false, 'message' => 'Staff not found']);
        }//ends if.
        return response()->json(['type' => 'error', 'message' => 'Staff ID is not provided.']);
    }//end function staffMultipleDelete

    public function customerMultipleDelete(Request $request)
    {
        $staffIDs = $request->ids;
        if ($staffIDs) {
            User::whereIn('id', $staffIDs)->delete();
            return 'success';
        } else {
            return response()->json(['success' => false, 'message' => 'Staff not found']);
        }
        return response()->json(['type' => 'error', 'message' => 'Staff ID is not provided.']);
    }//end function staffMultipleDelete

    public function leadMultipleDelete(Request $request)
    {
        $leadIDs = $request->ids;
        if ($leadIDs) {
            Lead::whereIn('id', $leadIDs)->delete();
            return 'success';
        } else {
            return response()->json(['success' => false, 'message' => 'lead not found']);
        }
        return response()->json(['type' => 'error', 'message' => 'lead ID is not provided.']);
    }//end function staffMultipleDelete

    public function statusChangeNotification(Request $request, $id = null)
    {
//        PlatformNotification::where('status', 'unseen')->update(['status' => 'seen']);
        Notification::where('status', 'unseen')->update(['status' => 'seen']);
//        return back()->with('flash_message', 'Status Updated!');
    }//end function statusChangeNotification.

    public function autocompleteSearchData(Request $request)
    {
        $query = $request->input('query');
        $leads = [];
        $leadCount = 0;
        if (!empty($query)) {
            $leads = Lead::where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('customer_id', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('lead_number', 'LIKE', "%{$query}%")
                    ->orWhere('project_price', 'LIKE', "%{$query}%")
                    ->orWhere('minimum_days', 'LIKE', "%{$query}%")
                    ->orWhere('maximum_days', 'LIKE', "%{$query}%")
                    ->orWhere('duration_minutes', 'LIKE', "%{$query}%")
                    ->orWhere('address', 'LIKE', "%{$query}%")
                    ->orWhere('contact_person', 'LIKE', "%{$query}%")
                    ->orWhere('other_information', 'LIKE', "%{$query}%")
                    ->orWhere('tax_type', 'LIKE', "%{$query}%")
                    ->orWhere('lead_amount', 'LIKE', "%{$query}%")
                    ->orWhere('tax', 'LIKE', "%{$query}%")
                    ->orWhere('lead_price', 'LIKE', "%{$query}%")
                    ->orWhere('status', 'LIKE', "%{$query}%");
            })
                // Add customer name search
                ->orWhereHas('customer', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->get();
            $leadCount = $leads->count();
        }
        $html = view('lead.lead.search_dynamic_data', compact('leads', 'leadCount'))->render();
        return response()->json(['html' => $html]);
    }//ends function autocompleteSearchData.

    public function categoryStatus(Request $request, $id = null, $status = null)
    {
        if (Category::where('id', $id)->update(['status' => $status])) {
            return back()->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function categoryStatus.

    public function materialStatus(Request $request, $id = null, $status = null)
    {
        if (Material::where('id', $id)->update(['status' => $status])) {
            return back()->with('flash_message', 'Status Updated!');
        }//end if.
        return response(view('403'), 403);
    }//end function materialStatus.

    public function editStatusYearEsstimation(Request $request)
    {
        $id = $request->input('id');
        YearEstimation::query()->update(['status' => 0]);
        $updated = YearEstimation::where('id', $id)->update(['status' => 1]);
        if ($updated) {
            return response()->json(['message' => 'Status Updated!']);
        }//ends if.
    }//ends function editStatusYearEsstimation.

    public function storeCompanyCamProject(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.companycam.com/v2/projects', [
            'body' => '{"name":"New Lead Project","address":{"street_address_1":"tafsol technologies b-11 gulshan block 5","street_address_2":"123 Main St","city":"karachi","state":"Sindh","postal_code":"74600","country":"PK"}}',
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer Opu2_zB-bFdCvNf-uwfKtDmagUoDUDux10W1D0vjRzs',
                'content-type' => 'application/json',
            ],
        ]);
        echo $response->getBody();
    }//end function storeCompanyCamProject.

    public function storePhotoAndDoc()
    {
        $client = new \GuzzleHttp\Client();
        $timestamp = Carbon::now()->format('YmdHis');
        $response = $client->request('POST', 'https://api.companycam.com/v2/projects/61516663/photos', [
            'body' => '{"photo":{"uri":"https://www.lead-up.net/images/l/e/a/d/u/leadupdigital-screen091220bluebutt-a6220dca.jpeg","captured_at":' . $timestamp . '}}',
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
                'content-type' => 'application/json',
            ],
        ]);
        return $response->getBody();
    }

    public function getCompanyCamProjectList()
    {
        $url = 'https://api.companycam.com/v2/projects/';
        $token = 'Opu2_zB-bFdCvNf-uwfKtDmagUoDUDux10W1D0vjRzs';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $token,
        ]);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);
        echo $response;
    }

//    public function costOfLead(Request $request){
//        if(auth()->user()->hasRole('user')){
//        $lead = Lead::get();
//        }
//        else{
//            $lead = Lead::where('representative_id', auth()->id())->get();
//        }
//        $advertisement   = Advertisement::get();
//        if(auth()->user()->hasRole('user')){
//        $appointment     = Appointment::get();
//        } else{
//            $appointment = Appointment::whereHas('lead', function($query){
//                $query->where('representative_id', auth()->id());
//        })->get();
//        }
//        $currentYear = YearEstimation::where('status', 1)->first()->year ?? Carbon::now()->year;
//        $yearEstimations = YearEstimation::with('months')->where('year', $currentYear)->where('status', 1)->get();
//        return view('advertisement.advertisement.cost_of_lead', compact('yearEstimations', 'lead', 'appointment', 'advertisement', 'currentYear'));
//    }

    public function costOfLead(Request $request)
    {
        try {
            $user = auth()->user();
            $years = YearEstimation::get();
            $currentYear = $years->where('status', 1)->first()->year ?? Carbon::now()->year;
            $yearEstimations = YearEstimation::with('months')->where('year', $currentYear)->where('status', 1)->get();
            $leads = $user->hasRole('user') ? Lead::whereYear('lead_date', $currentYear)->get() : Lead::where('representative_id', $user->id)->whereYear('lead_date', $currentYear)->get();
            $advertisements = Advertisement::get();
            $appointments = $user->hasRole('user') ? Appointment::whereYear('created_at', $currentYear)->get() : Appointment::whereHas('lead', function ($query) use ($user) {
                $query->where('representative_id', $user->id);
            })->whereYear('created_at', $currentYear)->get();
            $leadWonCount = $leads->where('lead_status', 'won')->count();
            $appointmentCount = $appointments->where('status', 1)->count();
            $actualAppointmentClosingRate = $appointmentCount != 0 ? ($leadWonCount / $appointmentCount) * 100 : 0;
            $advertisementYearlyBudget = $advertisements->where('year', $currentYear)->sum('monthly_budget');
            $costPerAppointment = $appointmentCount != 0 ? $advertisementYearlyBudget / $appointmentCount : 0;
            $costPerJob = $leadWonCount != 0 ? $advertisementYearlyBudget / $leadWonCount : 0;
            $averageJobPrice = $leadWonCount != 0 ? $leads->where('lead_status', 'won')->sum('lead_price') / $leadWonCount : 0;
            return view('advertisement.advertisement.cost_of_lead', compact('years',
                'yearEstimations', 'leads', 'appointments', 'advertisements', 'currentYear',
                'leadWonCount', 'appointmentCount', 'actualAppointmentClosingRate',
                'advertisementYearlyBudget', 'costPerAppointment', 'costPerJob', 'averageJobPrice'
            ));
        } catch (\Exception $e) {
            return back()->with('flash_message', $e->getMessage());
        }//ends tryCatch.
    }//ends function costOfLead.

    public function yearlyAdvertisingReport(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $selectedYear = $request->input('year', $currentYear);
        $years = YearEstimation::get();
        $advertisements = Advertisement::with('monthlyAdvertisement')->where('year', $selectedYear)->get();
        $yearly_budget = $advertisements->sum('monthly_budget');
        return view('advertisement.advertisement.yearly_advertising_report', compact('years', 'advertisements', 'currentYear', 'yearly_budget', 'selectedYear'));
    }

    public function getSchedulingTask(Request $request)
    {
        extract($request->all());
        $task_id = $task_id;
        $task = SchedulingTask::with('getSchedulingUser')->find($task_id);
        return response()->json(['taskData' => $task]);
    }

    public function updateSchedulingTask(Request $request)
    {
        extract($request->all());
        $scheduling_task = SchedulingTask::findOrFail($task_id);
        $scheduling_task->update([
            'name' => $name,
            'lead_id' => $lead_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'color_id' => $color_id,
            'team_id' => $team_id,
            'description' => $description,
            'subcontractor_id' => $subcontractor_id,
        ]);
        SchedulingTaskUser::where('scheduling_task_id', $task_id)->delete();
        foreach ($user_id as $value) {
            SchedulingTaskUser::create([
                'scheduling_task_id' => $task_id,
                'user_id' => $value,
            ]);
        }
        return response()->json(['message' => 'Task updated successfully']);
    }

    public function roofEstimationCalculator(Request $request, $lead_id = null)
    {
        $lead = Lead::with('roofEstimateCalculator.roofEstimateCalculatorpreferred')->find($lead_id);
//        $skylights = ProductPriceSkylight::get();
        $products = Product::get();
        $calculatorSizes = CalculatorSize::where('status', 1)->get();
        $roofBase = CalculatorBaseValue::first();
        $formData = $roofBase && $roofBase->roof ? json_decode($roofBase->roof, true) : null;
        return view('lead.lead.roof_estimate.roof_estimation_calculator_measurement', compact('lead','calculatorSizes', 'formData', 'products'));
    }//ends function.

    public function leadDetail(Request $request, $lead_id = null)
    {
        $lead = Lead::find($lead_id);
        return response()->json(['lead' => $lead]);
    }
    public function getLeadsDetail(Request $request){
        $leadIds = explode(',', $request->input('lead_id'));
        $leads = Lead::whereIn('id', $leadIds)->get();
        $leadDetails = $leads->map(function($lead) {
            $totalPrice = $lead->lead_price + $lead->getChangeOrder()->where('status', 'approved')->sum('total_amount');
            return [
                'title' => $lead->title,
                'lead_price' => $lead->lead_price,
                'total_price' => $totalPrice,
            ];
        });
        return response()->json([
            'leads' => $leadDetails,
        ]);
    }
    public function roofEstimationCalculatorScreen(Request $request, $lead_id = null, $roof_estimate_calculator_id = null, $slug = null)
    {
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $lead_id)->where('id', $roof_estimate_calculator_id)->first();
        $roofBase = CalculatorBaseValue::first();
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
//        $skylight_price = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylight_price')->first()->value;
        $lead = Lead::find($lead_id);
        $skyLightQuantity = $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $roof_estimate_calculator_id)->sum('quantity');
        $skyLightPrice = $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $roof_estimate_calculator_id)->sum('price');
        if ($slug == 'preferred') {
            $roofBaseValues = CalculatorBaseValue::first();
            return view('lead.lead.roof_estimate.roof_estimation_calculator_prefer', compact(
                'roofEstimateCalculator', 'lead', 'roofBase', 'skyLightPrice', 'skyLightQuantity',
                'additional_layer',
                'additional_layer_price_per_sq',
                'stepCharge',
                'stepChargePricePerSq',
                'chimneySize',
                'chimneySizePricePerSq',
                'plywood',
                'plywoodPricePerSq',
                'roofBaseValues',
            ));
        } elseif ($slug == 'system') {
            $roofBaseValuesSystem = CalculatorBaseValue::first();
            return view('lead.lead.roof_estimate.roof_estimation_calculator_system', compact(
                'roofEstimateCalculator', 'lead',
                'additional_layer',
                'additional_layer_price_per_sq',
                'stepCharge',
                'stepChargePricePerSq',
                'chimneySize',
                'chimneySizePricePerSq',
                'plywood',
                'plywoodPricePerSq',
                'roofBaseValuesSystem'
            ));
        } elseif ($slug == 'gutters') {
            $roofBaseValuesGutter = CalculatorBaseValue::first();
            return view('lead.lead.roof_estimate.roof_estimation_calculator_gutter', compact(
                'roofEstimateCalculator', 'lead',
                'additional_layer',
                'additional_layer_price_per_sq',
                'stepCharge',
                'stepChargePricePerSq',
                'chimneySize',
                'chimneySizePricePerSq',
                'plywood',
                'plywoodPricePerSq',
                'roofBaseValuesGutter',
//                'skylight_price'
            ));
        } elseif ($slug == 'under_fifteen_sq') {
            $roofBaseValuesUnder = CalculatorBaseValue::first();
            return view('lead.lead.roof_estimate.roof_estimation_calculator_under_fifteen_sq', compact(
                'roofEstimateCalculator', 'lead',
                'additional_layer',
                'additional_layer_price_per_sq',
                'stepCharge',
                'stepChargePricePerSq',
                'chimneySize',
                'chimneySizePricePerSq',
                'plywood',
                'plywoodPricePerSq',
                'roofBaseValuesUnder',

            ));
        } elseif ($slug == 'flat_roof') {
            $roofBaseValuesFlat = CalculatorBaseValue::first();
            return view('lead.lead.roof_estimate.roof_estimation_calculator_flat_roof', compact(
                'roofEstimateCalculator', 'lead',
                'additional_layer',
                'additional_layer_price_per_sq',
                'stepCharge',
                'stepChargePricePerSq',
                'chimneySize',
                'chimneySizePricePerSq',
                'plywood',
                'plywoodPricePerSq',
                'roofBaseValuesFlat',

            ));
        }//ends if...
    }//ends function roofEstimationCalculatorPrefer.

    public function testing(Request $request){
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

        return 'company cam';

        $imageUrl = 'https://img.freepik.com/premium-photo/white-modern-house-with-black-metal-roof-modern-metal-roof-house-exterior_667565-1078.jpg?w=996';
        $imageData = file_get_contents($imageUrl);
        if ($imageData === false) {
            return response()->json(['error' => 'Failed to download the image from URL'], 404);
        }
        $image = imagecreatefromstring($imageData);
        if ($image === false) {
            return response()->json(['error' => 'Failed to create image from the URL'], 404);
        }
        $width = imagesx($image);
        $height = imagesy($image);
        $colorCounter = [];
        $minRed = 40;
        $maxRed = 80;
        $minGreen = 100;
        $maxGreen = 160;
        $minBlue = 80;
        $maxBlue = 130;
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $red = ($rgb >> 16) & 0xFF;
                $green = ($rgb >> 8) & 0xFF;
                $blue = $rgb & 0xFF;
                if ($red >= $minRed && $red <= $maxRed && $green >= $minGreen && $green <= $maxGreen && $blue >= $minBlue && $blue <= $maxBlue) {
                    $colorKey = "$red,$green,$blue";
                    if (!isset($colorCounter[$colorKey])) {
                        $colorCounter[$colorKey] = 0;
                    }
                    $colorCounter[$colorKey]++;
                }
            }
        }
        arsort($colorCounter);
        $dominantColorKey = key($colorCounter);
        list($dominantRed, $dominantGreen, $dominantBlue) = explode(',', $dominantColorKey);
        $hexColor = sprintf("#%02x%02x%02x", $dominantRed, $dominantGreen, $dominantBlue);
        imagedestroy($image);
        return response()->json(['dominant_color' => $hexColor]);
        die;

        $account_sid = "AC0190cfbd8b9584b91b40274036    215caf";
        $auth_token = "62b25eb18af8e635d01f1c4cafa377d0";
        $twilio_number = "+12404716049";
        $twilio_client = new TwilioClient($account_sid, $auth_token);
        $message = $message = "Hello world developer testing....";;
        $to = '+923162446744';
        $to = '+16464800412';
        try {
            $result = $twilio_client->messages->create($to, [
                'from' => $twilio_number,
                'body' => $message,
            ]);
        } catch (\Twilio\Exceptions\RestException $e) {
            return $e->getMessage();
        }
    }//ends function testing.

    public function sidingEstimationCalculator(Request $request, $lead_id = null)
    {
        $lead = Lead::with('sidingEstimateCalculator')->find($lead_id);
        $sidingBase = CalculatorBaseValue::first();
        $sidingBaseValues = $sidingBase && $sidingBase->siding_replacement ? json_decode($sidingBase->siding_replacement, true) : null;
        $formData = $sidingBase && $sidingBase->siding ? json_decode($sidingBase->siding, true) : null;
        return view('lead.lead.siding_estimate.siding_estimation_calculator_measurement', compact('lead', 'formData', 'sidingBaseValues'));
    }

    public function chimneyEstimationCalculator(Request $request, $lead_id = null)
    {
        $lead = Lead::with('chimneyEstimateCalculator')->find($lead_id);
        $chimneyBase = CalculatorBaseValue::first();
//        if(isset($lead->chimneyEstimateCalculator->base_value_id) && $lead->chimneyEstimateCalculator->base_value_id  != null){
//            $chimneyBase = CalculatorBaseValue::findOrFail($lead->chimneyEstimateCalculator->base_value_id);
//        }else{
//            $chimneyBase = CalculatorBaseValue::latest()->first();
//        }
        $formData = $chimneyBase && $chimneyBase->chimney ? json_decode($chimneyBase->chimney, true) : null;
        return view('lead.lead.chimney_estimate.chimney_estimation_calculator_measurement', compact('lead', 'formData', 'chimneyBase'));
    }

    public function sidingEstimationCalculatorScreen(Request $request, $lead_id = null, $siding_estimate_calculator_id = null, $slug = null)
    {
        $sidingEstimateCalculator = SidingEstimateCalculator::with('storeSidingEstimateCalculatorGutter')->where('lead_id', $lead_id)->where('id', $siding_estimate_calculator_id)->first();
        if (!$sidingEstimateCalculator) {
            return redirect()->back()->with('error', 'Siding Estimate Calculator not found.');
        }
        $lead = Lead::find($lead_id);
        if ($slug == 'replacement') {
            $sideBase = CalculatorBaseValue::first();
            $sidingLabels = $sidingEstimateCalculator->sidingEstimateCalculatorLabels;
            $sidingReplacementDoors = $sidingLabels->where('section', 'doors')->first()->value;
            $sidingReplacementWindows = $sidingLabels->where('section', 'windows')->first()->value;
            $sidingReplacementLayers = $sidingLabels->where('section', 'layers')->first()->value;
            $sidingReplacementShatters = $sidingLabels->where('section', 'shatter')->first()->value;
            $sidingReplacementPlywood = $sidingLabels->where('section', 'plywood')->first()->value;
            $replacementWindowsDoors = $sidingReplacementDoors + $sidingReplacementWindows;
            $sidingReplacementSq = $sidingEstimateCalculator->eave_rakes_total_percent;
            $sidingReplacementSoffitTotalSum = $sidingEstimateCalculator->soffit_total_sum;
            $sidingReplacementAdditionalLayers = $sidingReplacementLayers * $sidingReplacementSq;

            $azeck = 0;
            $aluminum = 0;

            if ($sidingEstimateCalculator->soffit == 'azeck') {
                $azeck = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
            } else if ($sidingEstimateCalculator->soffit == 'aluminum') {
                $aluminum = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
            }
            $sidingBaseValuesReplacement = CalculatorBaseValue::first();

            return view('lead.lead.siding_estimate.siding_estimation_calculator_replacement', compact(
                'sideBase', 'sidingEstimateCalculator', 'lead', 'replacementWindowsDoors', 'sidingReplacementLayers', 'sidingReplacementSq',
                'sidingReplacementAdditionalLayers', 'sidingReplacementSoffitTotalSum', 'sidingReplacementShatters', 'sidingReplacementPlywood',
                'azeck', 'aluminum','sidingBaseValuesReplacement'
            ));
        } elseif ($slug == 'gutters') {
            $storeSideEstimateCalculatorGutter = $sidingEstimateCalculator;
            $sidingBaseValuesGutter = CalculatorBaseValue::first();
//              return $storeSideEstimateCalculatorGutter->storeSidingEstimateCalculatorGutter->gutter_sub_total;
            return view('lead.lead.siding_estimate.siding_estimation_calculator_gutter', compact(
                'sidingEstimateCalculator', 'lead', 'storeSideEstimateCalculatorGutter','sidingBaseValuesGutter'
            ));

        } elseif ($slug == 'over_existing') {
            $sidingExistingsq = $sidingEstimateCalculator->eave_rakes_total_percent;
            $sidingLabels = $sidingEstimateCalculator->sidingEstimateCalculatorLabels;
            $sidingExistingDoors = $sidingLabels->where('section', 'doors')->first()->value;
            $sidingExistingWindows = $sidingLabels->where('section', 'windows')->first()->value;
            $sidingExistingLayers = $sidingLabels->where('section', 'layers')->first()->value;
            $sidingExistingShatters = $sidingLabels->where('section', 'shatter')->first()->value;
            $sidingExistingPlywood = $sidingLabels->where('section', 'plywood')->first()->value;
            $existingWindowsDoors = $sidingExistingDoors + $sidingExistingWindows;
//            $sidingExistingSoffitTotalSum = $sidingEstimateCalculator->soffit_porch_percent;
            $sidingExistingSoffitTotalSum = $sidingEstimateCalculator->soffit_total_sum;
            $sidingExistingAdditionalLayers = $sidingExistingLayers * $sidingExistingSq;

            $azeck = 0;
            $aluminum = 0;

            if ($sidingEstimateCalculator->soffit == 'azeck') {
                $azeck = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
            } else if ($sidingEstimateCalculator->soffit == 'aluminum') {
                $aluminum = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
            }
            $sidingBaseValuesOver = CalculatorBaseValue::first();
            return view('lead.lead.siding_estimate.siding_estimation_calculator_over_existing', compact(
                'sidingEstimateCalculator', 'lead', 'sidingExistingSq', 'sidingExistingLayers', 'existingWindowsDoors',
                'sidingExistingAdditionalLayers', 'sidingExistingSoffitTotalSum', 'sidingExistingShatters', 'sidingExistingPlywood', 'azeck', 'aluminum','sidingBaseValuesOver'
            ));
        }//ends if...
    }

    public function chimneyEstimationCalculatorScreen(Request $request, $lead_id = null, $chimney_estimate_calculator_id = null, $slug = null){
        $chimneyEstimateCalculator = ChimneyEstimateCalculator::where('lead_id', $lead_id)->where('id', $chimney_estimate_calculator_id)->first();
        $recommendedPrice = isset($chimneyEstimateCalculator->storeChimney->recommended_price) ? $chimneyEstimateCalculator->storeChimney->recommended_price : null;
        if (!$chimneyEstimateCalculator) {
            return redirect()->back()->with('error', 'Siding Estimate Calculator not found.');
        }
        $lead = Lead::find($lead_id);
        if ($slug == 'chimney') {
            $chimneyLabels = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels;
            $totalBricks = $chimneyEstimateCalculator->total_bricks_rows;
            $chimneyStoriesLabels = $chimneyLabels->where('section', 'stories')->first()->value;
            $chimneyPitchLabels = $chimneyLabels->where('section', 'pitch')->first()->value;
            $chimneyDificutLabels = $chimneyLabels->where('section', 'dificut')->first()->value;
            $chimneyCapLabels = $chimneyLabels->where('section', 'chimney_cap_one')->first()->value;
//            $chimneyCapLabeltwo = $chimneyLabels->where('section', 'chimney_cap_two')->first()->value;
//            $miscellaneous = $chimneyLabels->where('section', 'miscellaneous')->first()->value;
            $chimneyBaseValues = CalculatorBaseValue::first();
            return view('lead.lead.chimney_estimate.chimney_estimation_calculator_chimney', compact(
                'chimneyEstimateCalculator', 'lead', 'totalBricks', 'miscellaneous',
                'chimneyStoriesLabels', 'chimneyPitchLabels', 'chimneyDificutLabels', 'chimneyCapLabels','chimneyBaseValues'));
        } elseif ($slug == 'liner') {
            $chimneyHomeStyle = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value;
//            $miscellaneous = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'miscellaneous')->first()->value;
            $chimneyBaseValuesLiner = CalculatorBaseValue::first();
            return view('lead.lead.chimney_estimate.chimney_estimation_calculator_liner', compact(
                'chimneyEstimateCalculator', 'lead', 'chimneyHomeStyle','chimneyBaseValuesLiner'));
        }//ends if...
    }

//    public function chimneyEstimationCalculator(Request $request, $lead_id = null){
////        $lead = Lead::with('chimneyEstimateCalculator')->find($lead_id);
//        $lead= Lead::find($lead_id);
//        return view('lead.lead.chimney_estimate.chimney_estimation_calculator_measurement',compact('lead'));
//    }
    public function productPricingEstimationCalculator(Request $request, $lead_id = null)
    {
        $lead = Lead::with('productPricingEstimateCalculator')->find($lead_id);
        $calculatorSizes = CalculatorSize::get();
        $skylights = ProductPriceSkylight::get();
//        $lead= Lead::find($lead_id);
        return view('lead.lead.product_pricing_estimate.product_pricing_estimate_calculator_measurement', compact('lead', 'calculatorSizes', 'skylights'));
    }

    public function productPricingEstimationCalculatorScreen(Request $request, $lead_id = null, $product_pricing_calculator_id = null, $slug = null)
    {
        $productPricingEstimateCalculator = ProductPricingEstimateCalculator::where('lead_id', $lead_id)->where('id', $product_pricing_calculator_id)->first();
        $productPriceList = ProductPricingPriceList::where('product_pricing_calculator_id', $productPricingEstimateCalculator->id)->first();
        $productPricePdf = ProductPricePdfMeasurement::where('product_pricing_calculator_id', $productPricingEstimateCalculator->id)->first();
        $skylights = ProductPriceSkylight::where('product_price_calculator_id', $productPricingEstimateCalculator->id)->get();
        if (!$productPricingEstimateCalculator) {
            return redirect()->back()->with('error', 'Product Pricing Estimate Calculator not found.');
        }
        $lead = Lead::find($lead_id);
        if ($slug == 'material_list') {
            $productPricingEaveRakes = $productPricingEstimateCalculator->productPricingEstimateCalculatorEaveRakes;
            $productMaterialList = $productPricingEstimateCalculator->productPricingEstimateCalculatorMaterialList->first();
            $productPricingEaveSum = $productPricingEaveRakes->sum('eave');
            $productPricingRakeSum = $productPricingEaveRakes->sum('rakes');
            $eaveRakesSumAll = $productPricingEaveSum + $productPricingRakeSum;
            $materiaListshingleItems = $eaveRakesSumAll * 2;
            $materiaListRhinRoof = $eaveRakesSumAll * 4;
            $materiaListMfmRoof = $eaveRakesSumAll * 6;
            $productPricingLabels = $productPricingEstimateCalculator->productPricingEstimateCalculatorLabels;
            $eaveRakesTotalPercent = $productPricingEstimateCalculator->eave_rakes_total_percent;
            $eaveRakesTotalPercentBundle = $eaveRakesTotalPercent * 3;
//            $productPricingSizeOneLabels = $productPricingLabels->where('section', 'size_one')->first()->value;
//            $productPricingSizeTwoLabels = $productPricingLabels->where('section', 'size_two')->first()->value;
            $productPricingPlywoodLabels = $productPricingLabels->where('section', 'plywood')->first()->value;
            $productPricingChimneySizeLabels = $productPricingLabels->where('section', 'chimney_sizes')->first()->value;
            $productPricingBathroomVentLabels = $productPricingLabels->where('section', 'bathroom_vent')->first()->value;
            $productPricingPipeBootsLabels = $productPricingLabels->where('section', 'pipe_boots')->first()->value;
//            $productPricingSizeThreeLabels = $productPricingLabels->where('section', 'size_three')->first()->value;
//            $productPricingSizeFourLabels = $productPricingLabels->where('section', 'size_four')->first()->value;
            $skyLights = ['sky_light_one', 'sky_light_two', 'sky_light_three', 'sky_light_four', 'sky_light_five'];
            $skyLightSum = $productPricingLabels->whereIn('section', $skyLights)->sum('value');
            //            ****************************************************
            $materialListCorningProedgeBundle = $productPricingEaveSum / 30;
            $materialListCorningVenstureBundle = $productPricingEaveSum / 4;
            $materialListCorningPlusBundle = $materiaListshingleItems / 90;
            $materialListRhinRoofBundle = $materiaListRhinRoof / 60;
            $materialListMfmBundle = $materiaListMfmRoof / 67;
            $materlistCorningPrarmorBundle = $eaveRakesTotalPercent / 14;
            $materlistCoilNailBundle = $eaveRakesTotalPercent / 15;
            $materlistAcmDripBundle = $materiaListshingleItems / 10;
//            **********************************************
            $productMaterial = StoreProductPricingMaterialList::with('productMaterialSection')->where('product_pricing_calculator_id', $productPricingEstimateCalculator->id)->get();
            return view('lead.lead.product_pricing_estimate.product_pricing_estimate_calculator_material_list', compact('productMaterial',
                'productPricingEstimateCalculator', 'lead', 'eaveRakesTotalPercent', 'productPricingPlywoodLabels', 'productPricingChimneySizeLabels', 'productPricingBathroomVentLabels',
                'productPricingPipeBootsLabels', 'eaveRakesTotalPercentBundle', 'skylights',
                'productPricingEaveSum', 'materiaListshingleItems', 'materiaListRhinRoof', 'materiaListMfmRoof', 'materialListCorningProedgeBundle',
                'materialListCorningVenstureBundle', 'materialListCorningPlusBundle', 'materialListRhinRoofBundle', 'materialListMfmBundle',
                'materlistCorningPrarmorBundle', 'materlistCoilNailBundle', 'materlistAcmDripBundle', 'productMaterialList', 'skyLightSum'
            ));
        } elseif ($slug == 'price_list') {
            $productPricingMaterialList = $productPricingEstimateCalculator->productPricingEstimateCalculatorMaterialList;
//            return $a = $productPricingMaterialList->where('name', 'owens_corning')->first()->quantity;
            $productPricingPriceList = $productPricingEstimateCalculator->with('productPricingEstimateCalculatorPriceList.productPricingPriceList')->first();
            return view('lead.lead.product_pricing_estimate.product_pricing_estimate_calculator_price_list', compact(
                'productPricingEstimateCalculator', 'lead', 'productPricingMaterialList', 'productPriceList', 'productPricingPriceList'));
        } elseif ($slug == 'pdf_measurement') {
            $pdfMeasurement = $productPricingEstimateCalculator->with('productPricingPdfMeasurement.productPricePdfTotal', 'productPricingPdfMeasurement.productPriceAreaPitch')->find($product_pricing_calculator_id);
            return view('lead.lead.product_pricing_estimate.product_pricing_estimate_calculator_pdf_measurement', compact(
                'productPricingEstimateCalculator', 'lead', 'productPricePdf', 'pdfMeasurement'));
        } elseif ($slug == 'pdf_material_list') {
            $measurementLabels = isset($productPricingEstimateCalculator->productPricingEstimateCalculatorLabels) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorLabels : null;
            $pdfMeasurementValues = isset($productPricingEstimateCalculator->productPricingPdfMeasurement) ? $productPricingEstimateCalculator->productPricingPdfMeasurement->first() : null;
            $owensCorningTrudefinition = (isset($pdfMeasurementValues->productPricePdfTotal) && $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total roof area')->first()) ? $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total roof area')->first()->value / 100 : null;
            $owensCorningProedgeHipRidge = (isset($pdfMeasurementValues->productPricePdfTotal) && $pdfMeasurementValues->productPricePdfTotal->where('name', 'Hips + ridges')->first()) ? $pdfMeasurementValues->productPricePdfTotal->where('name', 'Hips + ridges')->first()->value : null;
            $owensCorningVentsure = (isset($pdfMeasurementValues->productPricePdfTotal) && $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total ridges')->first()) ? $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total ridges')->first()->value : null;
            $owensCorningPlus = (isset($pdfMeasurementValues->productPricePdfTotal) && $pdfMeasurementValues->productPricePdfTotal->where('name', 'Eaves + rakes')->first()) ? $pdfMeasurementValues->productPricePdfTotal->where('name', 'Eaves + rakes')->first()->value : null;
            $pdfMeasurementotalPitch = (isset($pdfMeasurementValues->productPricePdfTotal) && $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total pitched area')->first()) ? $pdfMeasurementValues->productPricePdfTotal->where('name', 'Total pitched area')->first()->value : null;
            $rhinoroof = $owensCorningPlus * 2;
            $mfmRoof = $owensCorningPlus * 3;
            $owensCorningProarmor = $pdfMeasurementotalPitch - $rhinoroof;
            $coilNail = $pdfMeasurementotalPitch / 1000;
            $lifeTimeUltraPipe = $measurementLabels->where('section', 'sizes')->first()->value;
            $lifeTimeUltraPipeBundle = $measurementLabels->where('section', 'pipe_boots')->first()->value;
            $leadFlashing = $measurementLabels->where('section', 'chimney_sizes')->first()->value;
            $plywood = $measurementLabels->where('section', 'plywood')->first()->value;
            $skylight_one = $measurementLabels->where('section', 'size_three')->first()->value ?? "0";
            $SkyLight_two = $measurementLabels->where('section', 'size_four')->first()->value ?? "0";
            $lifeTimeBathDryer = $measurementLabels->where('section', 'bathroom_vent')->first()->value;
            $skyLights = ['sky_light_one', 'sky_light_two', 'sky_light_three', 'sky_light_four', 'sky_light_five'];
            $skyLightSum = $measurementLabels->whereIn('section', $skyLights)->sum('value');
            return view('lead.lead.product_pricing_estimate.product_pricing_calculator_pdf_material_list', compact(
                'productPricingEstimateCalculator', 'lead', 'owensCorningTrudefinition', 'owensCorningProedgeHipRidge',
                'owensCorningVentsure', 'owensCorningPlus', 'rhinoroof', 'mfmRoof', 'owensCorningProarmor', 'coilNail', 'lifeTimeUltraPipe',
                'lifeTimeUltraPipeBundle', 'leadFlashing', 'plywood', 'skylight_one', 'SkyLight_two', 'lifeTimeBathDryer', 'skyLightSum', 'productPricePdf'));
        } elseif ($slug == 'products') {
            $product = Product::get();
            $productCategories = ProductCategory::get();
            return view('lead.lead.product_pricing_estimate.products', compact('product', 'productCategories'));
        }
    }

    public function UpdateLeadProgressStatus(Request $request, $lead_id = null){
        extract($request->all());
        $lead = Lead::find($lead_id);
        if (!$lead) {
            return back()->with('error_message', 'Lead not found!');
        }
        $lead->update(['progress_status' => $progress_status]);
        Notification::create([
            'lead_id' => $lead_id,
            'model' => 'Lead Updated to Progress Board',
            'title' => "Lead updated on progress board against the lead <b>{$lead->title}</b> by",
            'icon' => "fa fa-refresh",
            'time' => Carbon::now(),
            'user_id' => auth()->user()->id,
        ]);
        return back()->with('flash_message', 'Progress Status Updated!');
    }
    public function customizeProposals($id)
    {
        $proposals = ProposalTemplate::where('proposal_type', $id)->orderBy('order_index', 'asc')->get();
        $leads = Lead::get();
        $variables = EmailTemplateVariable::whereIn('email_variable_type_id', [1, 5])->whereStatus('1')->get();
        $proposalTypes = ProposalType::get();
        $proposalTypeName = ProposalType::find($id);
        if (!$proposalTypeName) {
            abort(404, "Proposal Type not found");
        }
//        return view('admin.customize_proposals', compact('proposals', 'leads', 'variables', 'id', 'proposalTypes' , 'proposalTypeName'));
        return view('admin.customize_proposals_new', compact('proposals', 'leads', 'variables', 'id', 'proposalTypes' , 'proposalTypeName'));
    }
    public function customizeProposalsNew($id)
    {
        $proposals = ProposalTemplate::where('proposal_type', $id)->orderBy('order_index', 'asc')->get();
        $leads = Lead::get();
        $variables = EmailTemplateVariable::whereIn('email_variable_type_id', [1, 5])->whereStatus('1')->get();
        $proposalTypes = ProposalType::get();
        $proposalTypeName = ProposalType::find($id);
        if (!$proposalTypeName) {
            abort(404, "Proposal Type not found");
        }
        return view('admin.customize_proposals_new', compact('proposals', 'leads', 'variables', 'id', 'proposalTypes' , 'proposalTypeName'));
    }
    public function proposalGenerator(){
        $proposalTypes = ProposalType::get();
        return view('admin.proposal_generator', compact('proposalTypes' ));
    }//end proposalGenerator function.

//    public function customizeProposalsEdit($id){
//        return $proposals = ProposalTemplate::find($id);
//        return $proposals;
//    }
    public function customizeProposalsEdit(Request $request, $id) {
        $lead = Lead::find($request->lead_id);
        $proposals = ProposalTemplate::find($id);
        if (!$proposals) {
            return response()->json(['error' => 'Proposal not found'], 404);
        }
        $htmlContent = '';
        if ($proposals->description) {
            $htmlFilePath = public_path('website/proposal_template/' . $proposals->description);
            if (file_exists($htmlFilePath)) {
                $htmlContent = file_get_contents($htmlFilePath);
            } else {
                $htmlContent = '<p>Template file not found.</p>';
            }
        }

        return response()->json([
            'proposals' => $proposals,
            'description' => $htmlContent,
            'variables' => [
                'customer_name' => $lead->customer->name ?? '',
                'first_name' => $lead->customer->first_name ?? '',
                'customer_id' => isset($lead->customer ) ? 'R' . $lead->customer->created_at->format('yymmdd') : '',
                'email' => $lead->customer->email ?? '',
                'contact' => isset($lead->customer) ? $lead->customer->customerPhones->first()->phone : '',
                'address' => $lead->customer->profile->address ?? '',
                'title' => $lead->title ??'',
                'category_id' => $lead->category->name ??'',
                'lead_price' => $lead->lead_price_with_change_order_price??0,
                'name' => $lead->representative->name??'',
                'number' => $lead->job_number??'',
                'roof_prefered_recommended_price' => $lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price ??'',
                'roof_system_recommended_price' => $lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price ??'',
                'roof_under_15_sq_recommended_price' => $lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price ??'',
                'roof_flat_area_recommended_price' => $lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price ??'',
                'roof_gutter_recommended_price' => $lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price ??'',
                'roof_gutter_recommended_price2' => $lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two ??'',
                'siding_replacement_recommended_price' => $lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price ??'',
                'siding_over_existing_recommended_price' => $lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price ??'',
                'siding_gutter_recommended_price' => $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price ??'',
                'siding_gutter_recommended_price2' => $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two ??'',
                'chimney_chimney_recommended_price' => $lead->chimneyEstimateCalculator->storeChimney->recommended_price ??'',
                'chimney_liner_recommended_price' => $lead->chimneyEstimateCalculator->storeLiner->recommended_price ??'',
            ]
        ]);
    }
//    public function customizeSignatureProposals($id){
//        $leadOProposals = Proposal::find($id);
//        return "$leadOProposals";
//    }

    public function customizeProposalsDuplicate($id)
    {
        try {
            // Find the original proposal
            $proposal = ProposalTemplate::findOrFail($id);
            $newProposal = $proposal->replicate();

            // Base name without repeated " (Copy)"
            $baseName = $proposal->name . ' (Copy)';
            $suffix = 1;  // Start from 1
            $newName = $baseName . ' ' . $suffix;

            // Ensure the name is unique
            while (ProposalTemplate::where('name', $newName)->exists()) {
                $suffix++;  // Increment the suffix until a unique name is found
                $newName = $baseName . ' ' . $suffix;  // Update the name with the new suffix
            }

            $newProposal->name = $newName;
            $newProposal->order_index = ProposalTemplate::max('order_index') + 1;
            // Handle `screen_shot` if it exists (uncommented for actual use)
//            if ($proposal->screen_shot) {
//                if (preg_match('/<img.*src="([^"]+)"/', $proposal->screen_shot, $matches)) {
//                    $imagePath = $matches[1];
//                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
//                        $newProposal->screen_shot = $imagePath;
//                    } else {
//                        \Log::warning("Invalid image URL for screen_shot: {$imagePath}");
//                        $newProposal->screen_shot = null;
//                    }
//                } elseif (Storage::exists('website/' . $proposal->screen_shot)) {
//                    $extension = pathinfo($proposal->screen_shot, PATHINFO_EXTENSION);
//                    $newFilePath = 'proposals/' . uniqid() . '.' . $extension;
//                    Storage::copy('website/' . $proposal->screen_shot, 'website/' . $newFilePath);
//                    $newProposal->screen_shot = $newFilePath;
//                } else {
//                    \Log::warning("File not found for screen_shot: website/{$proposal->screen_shot}");
//                    $newProposal->screen_shot = null;
//                }
//            }
//
//            // Handle `preview_image_screenshoot` if it exists
//            if ($proposal->preview_image_screenshoot && Storage::exists('website/' . $proposal->preview_image_screenshoot)) {
//                $extension = pathinfo($proposal->preview_image_screenshoot, PATHINFO_EXTENSION);
//                $newPreviewPath = 'proposals/' . uniqid() . '.' . $extension;
//                Storage::copy('website/' . $proposal->preview_image_screenshoot, 'website/' . $newPreviewPath);
//                $newProposal->preview_image_screenshoot = $newPreviewPath;
//            }

            // Set creation and update timestamps
            $newProposal->created_at = now();
            $newProposal->updated_at = now();

            // Save the new proposal
            $newProposal->save();

            // Return success response with new proposal details
            return response()->json([
                'success' => true,
                'proposal' => [
                    'id' => $newProposal->id,
                    'name' => $newProposal->name,
                    'description' => $newProposal->description,
                    'page_template' => $newProposal->page_template,
                    'screen_shot' => $newProposal->screen_shot,
                    'preview_image_screenshoot' => $newProposal->preview_image_screenshoot,
                    'proposal_type' => $newProposal->proposal_type,
                    'order_index' => $newProposal->order_index
                ]
            ]);
        } catch (\Exception $e) {
            // Log the error and return failure response
            \Log::error("Failed to duplicate proposal ID: {$id}, Error: {$e->getMessage()}");
            return response()->json([
                'success' => false,
                'message' => 'Failed to duplicate proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function customizeSignatureProposals($id){
        $proposals = Proposal::find($id);
        if (!$proposals) {
            return response()->json(['error' => 'Proposal not found'], 404);
        }
        $filename = $proposals->description;
        $filePath = public_path('website/' . $filename);
        $content = null;
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
        }

        $fileName = $proposals->customer_description;
        $filePath = public_path('website/customer_proposal_response/' . $fileName);
        $customerDescription = null;
        if (file_exists($filePath)) {
            $customerDescription = file_get_contents($filePath);
        }
        return response()->json([
            'proposals' => $proposals,
            'description' => $content,
            'customer_description' => $customerDescription,
        ]);
    }
    public function userDraftProposals($id){
        $proposals = Proposal::find($id);
        if (!$proposals) {
            return response()->json(['error' => 'Proposal not found'], 404);
        }
        $filename = $proposals->description;
        $filePath = public_path('website/' . $filename);
        $content = null;
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
        }
        $fileName = $proposals->description;
        $filePath = public_path('website/' . $fileName);
        $customerDraftDescription = null;
        if (file_exists($filePath)) {
            $customerDraftDescription = file_get_contents($filePath);
        }
        return response()->json([
            'proposals' => $proposals,
            'description' => $content,
            'customer_description' => $customerDraftDescription,
        ]);
    }
    public function photosForCustomProposal(Request $request)
    {
        $lead = Lead::find($request->id);
        $photos = PhotoAndDocumentAttachment::where('lead_id', $request->id)->get();
        return (string)view('admin.custom_proposal_photos_modal', compact('lead', 'photos'));
    }//ends function jobInsuranceForLead.

    public function uploadProposalImage(Request  $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:102400' // Adjust the validation as needed
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $this->storeImage('proposal_images', $image);

            // Return the image path to the frontend
            return response()->json([
                'success' => true,
                'imagePath' => asset('website/' . $imagePath) // You can use asset() to generate a URL to the file
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded.']);

    }
    public function uploadProposalScreenShot(Request $request)
    {
        $request->validate([
            'image' => 'required|string' // Expecting Base64 string
        ]);

        // Decode the Base64 string
        $imageData = $request->input('image');
        $imageData = str_replace('data:image/webp;base64,', '', $imageData); // Handle WebP
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        if ($imageBinary === false) {
            return response()->json(['success' => false, 'message' => 'Invalid image data.']);
        }

        // Generate unique filename
        $fileName = 'proposal_' . time().rand(11,99) . '.webp';

        // Define the storage path
        $filePath = 'proposal_images_screenshot/' . $fileName;

        // Save the image to the storage (public folder)
        Storage::disk('website')->put($filePath, $imageBinary);

        return response()->json([
            'success' => true,
            'imagePath' => $filePath
        ]);
    }


    public function storeCustomizeProposals(Request $request){
        extract($request->all());
//        return $request->all();
        // Save description as .html file
        $htmlFilename = uniqid() . '.html';
        $htmlFilePath = public_path('website/proposal_template/' . $htmlFilename);
        if (!file_exists(dirname($htmlFilePath))) {
            mkdir(dirname($htmlFilePath), 0755, true);
        }
        file_put_contents($htmlFilePath, $description);
//        $maxOrderIndex = ProposalTemplate::where('proposal_type', $request->proposal_type)->max('order_index');
//        $orderIndex = $maxOrderIndex ? $maxOrderIndex + 1 : 1;
        $orderIndex = $request->order_index ?? (ProposalTemplate::where('proposal_type', $request->proposal_type)->max('order_index') + 1);
        ProposalTemplate::updateOrCreate(
            ['id' => $request->proposal_id],
            [
                'name' => $name ?? null,
                'description' => $htmlFilename,
                'page_template' => $page_template,
                'screen_shot' => $screen_shot,
                'preview_image_screenshoot' => $preview_image_screenshoot,
                'proposal_type' => $request->proposal_type,
                'order_index' => $orderIndex,
            ]
        );
        return back()->with('flash_message', 'Proposal Updated or Created!');
    }

//    public function getPhotoCompanyCamp(Request $request)
//    {
//        $leads = Lead::with('getphotoandDocument.getDocuments')->whereNotNull('company_camp_id')->get();
//        foreach ($leads as $lead) {
//            if ($lead->relationLoaded('getphotoandDocument') && $lead->getphotoandDocument->count() > 0) {
//                try {
//                    $client = new \GuzzleHttp\Client();
//                    $response = $client->request('GET', env('STORE_LEAD_COMPANY_CAMP') . '/' . $lead->company_camp_id . '/photos', [
//                        'headers' => [
//                            'accept' => 'application/json',
//                            'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
//                            'content-type' => 'application/json',
//                        ],
//                    ]);
//                    $responseData = json_decode($response->getBody()->getContents(), true);
//                    foreach ($responseData as $photo) {
//                        $originalImageUrl = collect($photo['uris'])->firstWhere('type', 'original')['url'] ?? null;
//                        if ($originalImageUrl && !PhotoAndDocumentAttachment::where('company_camp_file_id', $photo['id'])->exists() ) {
//                            $fileName = basename(parse_url($originalImageUrl, PHP_URL_PATH));
//                            $photoContents = file_get_contents($originalImageUrl);
//                            if ($photoContents === false) {
//                                continue;
//                            }//ends if.
//                            $saveResult = Storage::disk('leads')->put($fileName, $photoContents);
//                            if ($saveResult === false) {
//                                continue;
//                            }//ends if.
//                            $localFilePath = Storage::disk('leads')->path($fileName);
//                            $doc = PhotoAndDocument::firstOrCreate([
//                                'lead_id' => $lead->id,
//                                'company_camp_id' => $lead->company_camp_id,
//                                'created_by' => $lead->created_by,
//                            ]);
//                            PhotoAndDocumentAttachment::create([
//                                'document_id' => $doc->id,
//                                'name' => 'photo_and_documents_attachment/'.$fileName,
//                                'file_name' => $fileName,
//                                'doc_primary' => 0,
//                                'company_camp_id' => $lead->company_camp_id,
//                                'company_camp_file_id' => $photo['id'],
//                                'lead_id' => $lead->id,
//                            ]);
//                        }//ends if.
//                    }//ends foreach.
////                    return "true";
//                } catch (\Exception $e) {
//                    return redirect()->back()->with('error', 'Error occurred while processing the request: ' . $e->getMessage());
//                }//ends try catch.
//            }//ends if.
//        }//ends foreach.
//    }//ends function getPhotoCompanyCamp.
    // web.php (Routes)
// FolderController.php

//    public function getPhotoCompanyCamp(Request $request)
//    {
//        $leads = Lead::with('getphotoandDocument.getDocuments')->whereNotNull('company_camp_id')->get();
//        foreach ($leads as $lead) {
//            if ($lead->relationLoaded('getphotoandDocument') && $lead->getphotoandDocument->count() > 0) {
//                try {
//                    $client = new \GuzzleHttp\Client();
//                    $response = $client->request('GET', env('STORE_LEAD_COMPANY_CAMP') . '/' . $lead->company_camp_id . '/photos', [
//                        'headers' => [
//                            'accept' => 'application/json',
//                            'authorization' => 'Bearer ' . env('CLIENT_COMPANY_CAM_API_KEY'),
//                            'content-type' => 'application/json',
//                        ],
//                    ]);
//
//                    $responseData = json_decode($response->getBody()->getContents(), true);
//                    $existingPhotos = PhotoAndDocumentAttachment::where('lead_id', $lead->id)->pluck('company_camp_file_id')->toArray();
//
//                    foreach ($responseData as $photo) {
//                        // Attempt to retrieve image URL from 'original_annotation' or 'original'
//                        $webAnnotationUrl = collect($photo['uris'])->firstWhere('type', 'original_annotation')['url'] ?? null;
//                        $originalImageUrl = collect($photo['uris'])->firstWhere('type', 'original')['url'] ?? null;
//                        $imageUrl = $webAnnotationUrl ?: $originalImageUrl;
//
//                        if (!$imageUrl) {
//                            \Log::warning("No valid image URL found for photo ID: {$photo['id']}.");
//                            continue;
//                        }
//
//                        // Generate a unique file name based on the lead and photo ID
//                        $fileName = $lead->id . '_' . $photo['id'] . '_' . basename(parse_url($imageUrl, PHP_URL_PATH));
//                        $photoExists = in_array($photo['id'], $existingPhotos);
//
//                        try {
//                            // Check if the image already exists locally
//                            if ($photoExists) {
//                                // If it exists, skip download and update the file if necessary
//                                $attachment = PhotoAndDocumentAttachment::where('company_camp_file_id', $photo['id'])->first();
//                                $storedPath = Storage::disk('leads')->path($attachment->file_name);
//
//                                // Check if the file has been modified and update it
//                                $photoContents = file_get_contents($imageUrl);
//                                if ($photoContents === false) {
//                                    \Log::error("Failed to retrieve image contents from URL: $imageUrl");
//                                    continue;
//                                }
//
//                                if (!file_exists($storedPath) || md5_file($storedPath) !== md5($photoContents)) {
//                                    // If the file is outdated or missing, update it
//                                    if (file_exists($storedPath)) {
//                                        Storage::disk('leads')->delete($attachment->file_name);
//                                    }
//                                    Storage::disk('leads')->put($fileName, $photoContents);
//                                    $attachment->update([
//                                        'name' => 'photo_and_documents_attachment/' . $fileName,
//                                        'file_name' => $fileName,
//                                    ]);
//                                    \Log::info("Updated photo for lead ID {$lead->id}, photo ID {$photo['id']} with new contents.");
//                                } else {
//                                    \Log::info("Photo for lead ID {$lead->id}, photo ID {$photo['id']} already exists and is up-to-date.");
//                                }
//                            } else {
//                                // If the photo doesn't exist in the local database, fetch it and save
//                                $photoContents = file_get_contents($imageUrl);
//                                if ($photoContents === false) {
//                                    \Log::error("Failed to retrieve image contents from URL: $imageUrl");
//                                    continue;
//                                }
//
//                                // Save the new photo locally
//                                Storage::disk('leads')->put($fileName, $photoContents);
//                                $doc = PhotoAndDocument::firstOrCreate([
//                                    'lead_id' => $lead->id,
//                                    'company_camp_id' => $lead->company_camp_id,
//                                    'created_by' => $lead->created_by,
//                                ]);
//
//                                // Attach the new photo to the lead
//                                PhotoAndDocumentAttachment::create([
//                                    'document_id' => $doc->id,
//                                    'name' => 'photo_and_documents_attachment/' . $fileName,
//                                    'file_name' => $fileName,
//                                    'doc_primary' => 0,
//                                    'company_camp_id' => $lead->company_camp_id,
//                                    'company_camp_file_id' => $photo['id'],
//                                    'lead_id' => $lead->id,
//                                ]);
//                                \Log::info("Saved new photo for lead ID {$lead->id}, photo ID {$photo['id']}.");
//                            }
//                        } catch (\Exception $e) {
//                            \Log::error("Error processing photo ID {$photo['id']} for lead ID {$lead->id}: " . $e->getMessage());
//                        }
//                    }
//                } catch (\Exception $e) {
//                    \Log::error('Error fetching photos for lead ID ' . $lead->id . ': ' . $e->getMessage());
//                }
//            }
//        }
//
//        return response()->json(['status' => 'success', 'message' => 'Images processed successfully']);
//    }

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
                    $existingPhotos = PhotoAndDocumentAttachment::where('lead_id', $lead->id)->pluck('company_camp_file_id')->toArray();

                    // Get a list of company cam photo ids that are currently available
                    $companyCamPhotoIds = collect($responseData)->pluck('id')->toArray();

                    // 1. Delete photos from the local system that are no longer available in CompanyCam
                    $photosToDelete = array_diff($existingPhotos, $companyCamPhotoIds);  // Find photos that are not in the response

                    foreach ($photosToDelete as $photoId) {
                        // Find the attachment in the local database
                        $attachmentToDelete = PhotoAndDocumentAttachment::where('company_camp_file_id', $photoId)->first();
                        if ($attachmentToDelete) {
                            // Delete the associated file from storage
                            Storage::disk('leads')->delete($attachmentToDelete->file_name);

                            // Delete the attachment from the database
                            $attachmentToDelete->delete();
                            \Log::info("Deleted photo for lead ID {$lead->id}, photo ID {$photoId} from the local database.");
                        }
                    }

                    // 2. Process the photos from CompanyCam and either update or save them locally
                    foreach ($responseData as $photo) {
                        // Attempt to retrieve image URL from 'original_annotation' or 'original'
                        $webAnnotationUrl = collect($photo['uris'])->firstWhere('type', 'original_annotation')['url'] ?? null;
                        $originalImageUrl = collect($photo['uris'])->firstWhere('type', 'original')['url'] ?? null;
                        $imageUrl = $webAnnotationUrl ?: $originalImageUrl;

                        if (!$imageUrl) {
                            \Log::warning("No valid image URL found for photo ID: {$photo['id']}.");
                            continue;
                        }

                        // Generate a unique file name based on the lead and photo ID
                        $fileName = $lead->id . '_' . $photo['id'] . '_' . basename(parse_url($imageUrl, PHP_URL_PATH));
                        $photoExists = in_array($photo['id'], $existingPhotos);

                        try {
                            // Check if the image already exists locally
                            if ($photoExists) {
                                // If it exists, skip download and update the file if necessary
                                $attachment = PhotoAndDocumentAttachment::where('company_camp_file_id', $photo['id'])->first();
                                $storedPath = Storage::disk('leads')->path($attachment->file_name);

                                // Check if the file has been modified and update it
                                $photoContents = file_get_contents($imageUrl);
                                if ($photoContents === false) {
                                    \Log::error("Failed to retrieve image contents from URL: $imageUrl");
                                    continue;
                                }

                                if (!file_exists($storedPath) || md5_file($storedPath) !== md5($photoContents)) {
                                    // If the file is outdated or missing, update it
                                    if (file_exists($storedPath)) {
                                        Storage::disk('leads')->delete($attachment->file_name);
                                    }
                                    Storage::disk('leads')->put($fileName, $photoContents);
                                    $attachment->update([
                                        'name' => 'photo_and_documents_attachment/' . $fileName,
                                        'file_name' => $fileName,
                                    ]);
                                    \Log::info("Updated photo for lead ID {$lead->id}, photo ID {$photo['id']} with new contents.");
                                } else {
                                    \Log::info("Photo for lead ID {$lead->id}, photo ID {$photo['id']} already exists and is up-to-date.");
                                }
                            } else {
                                // If the photo doesn't exist in the local database, fetch it and save
                                $photoContents = file_get_contents($imageUrl);
                                if ($photoContents === false) {
                                    \Log::error("Failed to retrieve image contents from URL: $imageUrl");
                                    continue;
                                }

                                // Save the new photo locally
                                Storage::disk('leads')->put($fileName, $photoContents);
                                $doc = PhotoAndDocument::firstOrCreate([
                                    'lead_id' => $lead->id,
                                    'company_camp_id' => $lead->company_camp_id,
                                    'created_by' => $lead->created_by,
                                ]);

                                // Attach the new photo to the lead
                                PhotoAndDocumentAttachment::create([
                                    'document_id' => $doc->id,
                                    'name' => 'photo_and_documents_attachment/' . $fileName,
                                    'file_name' => $fileName,
                                    'doc_primary' => 0,
                                    'company_camp_id' => $lead->company_camp_id,
                                    'company_camp_file_id' => $photo['id'],
                                    'lead_id' => $lead->id,
                                ]);
                                \Log::info("Saved new photo for lead ID {$lead->id}, photo ID {$photo['id']}.");
                            }
                        } catch (\Exception $e) {
                            \Log::error("Error processing photo ID {$photo['id']} for lead ID {$lead->id}: " . $e->getMessage());
                        }
                    }

                } catch (\Exception $e) {
                    \Log::error('Error fetching photos for lead ID ' . $lead->id . ': ' . $e->getMessage());
                }
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Images processed successfully']);
    }

    public function createFolder(Request $request)
    {
        $parentFolder = $request->input('parent_folder', '');
        $folderName = $request->input('name');
        $folderPath = 'documents/' . $parentFolder . '/' . $folderName;
        Storage::makeDirectory($folderPath);
        return response()->json(['folder_path' => $folderPath]);
    }

    public function contents(Request $request)
    {
        $folder = $request->input('folder', 'documents');
        $folders = Storage::directories($folder);
        $files = Storage::files($folder);
        $folderList = [];
        foreach ($folders as $folderPath) {
            $folderList[] = ['path' => $folderPath, 'name' => basename($folderPath)];
        }
        $fileList = [];
        foreach ($files as $filePath) {
            $fileList[] = ['name' => basename($filePath)];
        }
        return response()->json(['folders' => $folderList, 'files' => $fileList]);
    }

// FileController.php
    public function uploadFolder(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $folder = $request->input('folder', 'documents');
            $fileName = $file->getClientOriginalName();
            $file->storeAs($folder, $fileName);
            return response()->json(['file_name' => $fileName]);
        }
        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function deleteFile(Request $request)
    {
        extract($request->all());
        $fileDelete = FolderManagementAttachment::find($file_id);
        if (!$fileDelete) {
            return response()->json(['status' => false, 'message' => 'File not found']);
        }
        if ($fileDelete->delete()) {
            Notification::create([
                'lead_id' => $fileDelete->folderManagment->lead_id ?? null,
                'model' => 'File Deleted',
                'title' => 'File deleted against the lead <b>' . $fileDelete->folderManagment->getLead->title . '</b> by',
                'icon' => 'fa-regular fa-trash',
                'time' => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'File Deleted Successfully']);
        }
    }

    public function deleteFolder(Request $request){
        extract($request->all());
        $folderDelete = FolderManagement::find($folder_id);
        if (!$folderDelete) {
            return response()->json(['status' => false, 'message' => 'Folder not found']);
        }
        if ($folderDelete->delete()) {
            Notification::create([
                'lead_id' => $folderDelete->lead_id ?? null,
                'model' => 'Folder Deleted',
                'title' => 'Folder deleted against the lead <b>' . $folderDelete->getLead->title . '</b> by',
                'icon' => 'fa-regular fa-trash',
                'time' => now(),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['status' => true, 'message' => 'Folder Deleted Successfully']);
        }
    }
    public function leadCustomProposal($lead_id = null)
    {
        $leads = Lead::get();
        $proposals = ProposalTemplate::get();
        return view('proposal.proposal.custom_proposal', compact('leads', 'proposals' ));
    }//ends function leadCustomProposal.

    public function storeLeadCustomProposalScreen(Request $request){
        return $request->all();
        return view('proposal.proposal.custom_proposal_screen');
    }//ends function leadCustomProposalScreen.

    public function customerViewProposal($id)
    {
        $proposals = Proposal::find($id);
        if (!$proposals) {
            return redirect()->back()->withErrors('Proposal not found.');
        }
        $lead = $proposals->getLead;
        if (!$lead || !$lead->customer) {
            return redirect()->back()->withErrors('No associated customer found for this proposal.');
        }
        $customerEmail = $lead->customer->email;
        if (auth()->check() && $customerEmail !== auth()->user()->email) {
            return redirect()->back()->withErrors('You are not authorized to view this proposal.');
        }
        if ($proposals->created_at->diffInDays(now()) > 30) {
            return redirect()->back()->withErrors('This proposal has expired.');
        }
        return view('proposal.proposal.customer_view_proposal', compact('proposals'));
    }

//    public function subContractorViewProposal($id){
//        $proposals = ProposalTemplate::find($id);
//        $subContractorProposal = SubContractorProposal::where('proposal_template_id', $id)->first();
//        $placeholders = [
//            '%{customer_name}%', '%{name}%', '%{email}%', '%{company_id}%', '%{address}%', '%{category_id}%',
//            '%{representative_id}%', '%{title}%', '%{customer_type_id}%', '%{contact}%', '%{number}%', '%{salesman_id}%',
//            '%{referral_source_id}%', '%{user_id}%', '%{city}%', '%{state}%', '%{country}%', '%{zip}%', '%{phone}%',
//            '%{lead_price}%', '%{lead_date}%', '%{minimum_days}%', '%{maximum_days}%', '%{other_information}%',
//            '%{claim_number}%', '%{policy_number}%', '%{phone_insurance}%', '%{fax_number}%', '%{email_insurance}%',
//            '%{adjust_name_insurance}%', '%{adjust_phone_insurance}%', '%{adjust_email_insurance}%', '%{contract_signed_date}%',
//            '%{date_loss_insurance}%', '%{claim_filled_date}%'
//        ];
//
//        $replacements = [
//            ($lead->customer->name ?? 'ABC'),
//            ($lead->customer->name ?? 'ABC'),
//            ($lead->customer->email ?? 'N/A'),
//            ($lead->customer->company ?? 'N/A'),
//            ($lead->customer->profile->address ?? 'N/A'),
//            ($lead->category->name ?? 'N/A'),
//            ($lead->representative->name ?? 'N/A'),
//            ($lead->title ?? 'N/A'),
//            ($lead->customer->customerType->name ?? 'N/A'),
////                ($lead->customer->customerPhones->phone ?? 'N/A'),
//            ($lead->category->salesman_id ?? 'N/A'),
//            ($lead->category->referral_source_id ?? 'N/A'),
//            ($lead->customer->name ?? 'N/A'),
//            ($lead->customer->profile->city ?? 'N/A'),
//            ($lead->customer->profile->state ?? 'N/A'),
//            ($lead->customer->profile->country ?? 'N/A'),
//            ($lead->customer->profile->zip ?? 'N/A'),
//            ($lead->lead_price ?? 'N/A'),
//            ($lead->lead_date ?? 'N/A'),
//            ($lead->minimum_days ?? 'N/A'),
//            ($lead->maximum_days ?? 'N/A'),
//            ($lead->other_information ?? 'N/A'),
//            ($lead->claim_number ?? 'N/A'),
//            ($lead->policy_number ?? 'N/A'),
//            ($lead->phone_insurance ?? 'N/A'),
//            ($lead->fax_number ?? 'N/A'),
//            ($lead->email_insurance ?? 'N/A'),
//            ($lead->adjust_name_insurance ?? 'N/A'),
//            ($lead->adjust_phone_insurance ?? 'N/A'),
//            ($lead->adjust_email_insurance ?? 'N/A'),
//            ($lead->contract_signed_date ?? 'N/A'),
//            ($lead->date_loss_insurance ?? 'N/A'),
//            ($lead->claim_filled_date ?? 'N/A')
//        ];
//        $filePath = public_path('website/proposal_template/' . $proposals->description);
//        $content = file_exists($filePath) ? file_get_contents($filePath) : '<p>File not found.</p>';
//        $finalContent = str_replace($placeholders, $replacements, $content);
//        if (!$proposals) {
//            return redirect()->back()->withErrors('Proposal not found.');
//        }
//        return view('proposal.proposal.subcontractor_view_proposal', compact('proposals', 'subContractorProposal'));
//    }
    public function subContractorViewProposal($id, $lead_id)
    {
        $proposals = ProposalTemplate::find($id);
        $subContractorProposal = SubContractorProposal::where('proposal_template_id', $id)->where('lead_id', $lead_id)->first();

        if (!$proposals) {
            return redirect()->back()->withErrors('Proposal not found.');
        }

        if (!$subContractorProposal) {
            return redirect()->back()->withErrors('Subcontractor proposal not found.');
        }

        $lead = Lead::find($subContractorProposal->lead_id);
        if (!$lead) {
            return redirect()->back()->withErrors('No associated lead found for this proposal.');
        }

        // Check if the proposal has expired (older than 30 days)
        if ($subContractorProposal->created_at->diffInDays(now()) > 30) {
            return redirect()->back()->withErrors('This proposal has expired.');
        }

        $placeholders = [
            '%{job_number}%',
            '%{customer_name}%',
            '%{name}%',
            '%{email}%',
            '%{company_id}%',
            '%{address}%',
            '%{category_id}%',
            '%{representative_id}%',
            '%{title}%',
            '%{customer_type_id}%',
            '%{number}%',
            '%{salesman_id}%',
            '%{referral_source_id}%',
            '%{user_id}%',
            '%{city}%',
            '%{state}%',
            '%{country}%',
            '%{zip}%',
            '%{lead_price}%',
            '%{lead_date}%',
            '%{minimum_days}%',
            '%{maximum_days}%',
            '%{other_information}%',
            '%{claim_number}%',
            '%{policy_number}%',
            '%{phone_insurance}%',
            '%{fax_number}%',
            '%{email_insurance}%',
            '%{adjust_name_insurance}%',
            '%{adjust_phone_insurance}%',
            '%{adjust_email_insurance}%',
            '%{contract_signed_date}%',
            '%{date_loss_insurance}%',
            '%{claim_filled_date}%',
        ];

        $replacements = [
            ($lead->job_number ?? 'N/A'),
            ($lead->customer->name ?? 'ABC'),
            ($lead->title ?? 'ABC'),
            ($lead->customer->email ?? 'N/A'),
            ($lead->customer->company ?? 'N/A'),
            ($lead->customer->profile->address ?? 'N/A'),
            ($lead->category->name ?? 'N/A'),
            ($lead->representative->name ?? 'N/A'),
            ($lead->title ?? 'N/A'),
            ($lead->customer->customerType->name ?? 'N/A'),
            ($lead->category->salesman_id ?? 'N/A'),
            ($lead->category->referral_source_id ?? 'N/A'),
            ($lead->customer->name ?? 'N/A'),
            ($lead->customer->profile->city ?? 'N/A'),
            ($lead->customer->profile->state ?? 'N/A'),
            ($lead->customer->profile->country ?? 'N/A'),
            ($lead->customer->profile->zip ?? 'N/A'),
            ($lead->lead_price ?? 'N/A'),
            ($lead->lead_date ?? 'N/A'),
            ($lead->minimum_days ?? 'N/A'),
            ($lead->maximum_days ?? 'N/A'),
            ($lead->other_information ?? 'N/A'),
            ($lead->claim_number ?? 'N/A'),
            ($lead->policy_number ?? 'N/A'),
            ($lead->phone_insurance ?? 'N/A'),
            ($lead->fax_number ?? 'N/A'),
            ($lead->email_insurance ?? 'N/A'),
            ($lead->adjust_name_insurance ?? 'N/A'),
            ($lead->adjust_phone_insurance ?? 'N/A'),
            ($lead->adjust_email_insurance ?? 'N/A'),
            ($lead->contract_signed_date ?? 'N/A'),
            ($lead->date_loss_insurance ?? 'N/A'),
            ($lead->claim_filled_date ?? 'N/A'),
        ];

        $filePath = public_path('website/' . $subContractorProposal->description);
        $content = file_exists($filePath) ? file_get_contents($filePath) : '<p>File not found.</p>';
        $finalContent = str_replace($placeholders, $replacements, $content);

        return view('proposal.proposal.subcontractor_view_proposal', [
            'proposals' => $proposals,
            'subContractorProposal' => $subContractorProposal,
            'finalContent' => $finalContent
        ]);
    }

    public function storeCustomerProposalSignature(Request $request){
        extract($request->all());
        $signatureData = json_decode($request->signatureData, true);
        if (!$signatureData || !is_array($signatureData)) {
            return back()->with('error', 'Invalid signature data.');
        }
        $savedSignatures = [];
        foreach ($signatureData as $signature) {
            if (!isset($signature['id']) || !isset($signature['image'])) {
                continue; // Skip invalid entries
            }
            $signatureId = $signature['id'];
            $img = $signature['image'];
            if (!preg_match('/^data:image\/(\w+);base64,/', $img, $matches)) {
                continue; // Skip invalid images
            }
            $extension = $matches[1];
            $image = substr($img, strpos($img, ',') + 1);
            $image = base64_decode($image);
            if ($image === false) {
                continue; // Skip invalid images
            }
            $imageName = Str::random(10) . '.' . $extension;
            $signaturePath = "customer_proposal_signature/" . $imageName;
            Storage::put("public/" . $signaturePath, $image);
            $savedSignatures[] = [
                'id' => $signatureId,
                'path' => $signaturePath,
            ];
        }
        $htmlFilename = uniqid() . '.html';
        $htmlFilePath = public_path('website/customer_proposal_response/' . $htmlFilename);
        if (!file_exists(dirname($htmlFilePath))) {
            mkdir(dirname($htmlFilePath), 0755, true);
        }
        file_put_contents($htmlFilePath, $request->description);
        $proposal = Proposal::find($request->proposal_id);
        if (!$proposal) {
            return back()->with('error', 'Proposal not found.');
        }
        $proposal->update([
            'signature' => json_encode($savedSignatures), // Save multiple signatures
            'customer_description' => $htmlFilename, // Save HTML file name
        ]);
        $stage = Stage::where('contract', 1)->first();
        $lead_stage = LeadStage::where('lead_id', $request->lead_id)->where('stage_id', $stage->id)->first();
        $lead_stage->update(['date' => now()]);
        $lead = Lead::findOrFail($request->lead_id);
        $lead->update(['stage_id' => $stage->id, 'stage_position' => $lead_stage->position]);
        return auth()->check()
            ? redirect('/dashboard')->with('flash_message', 'Signature saved successfully')
            : redirect('/login')->with('flash_message', 'Signature saved successfully');

    }

    public function storesubContractorProposalSignature(Request $request){
//        return $request->all();
        try {
            extract($request->all());
            $signatureData = json_decode($request->signatureData, true);
            if (!$signatureData || !is_array($signatureData)) {
                return back()->with('error', 'Invalid signature data.');
            }
            $savedSignatures = [];
            foreach ($signatureData as $signature) {
                if (!isset($signature['id']) || !isset($signature['image'])) {
                    continue; // Skip invalid entries
                }
                $signatureId = $signature['id'];
                $img = $signature['image'];
                if (!preg_match('/^data:image\/(\w+);base64,/', $img, $matches)) {
                    continue; // Skip invalid images
                }
                $extension = $matches[1];
                $image = substr($img, strpos($img, ',') + 1);
                $image = base64_decode($image);
                if ($image === false) {
                    continue;
                }
                $imageName = Str::random(10) . '.' . $extension;
                $signaturePath = "subcontractor_proposal_signature/" . $imageName;
                Storage::put("public/" . $signaturePath, $image);
                $savedSignatures[] = [
                    'id' => $signatureId,
                    'path' => $signaturePath,
                ];
            }
            $htmlFilename = uniqid() . '.html';
            $htmlFilePath = public_path('website/subcontractor_proposal_response/' . $htmlFilename);
            if (!file_exists(dirname($htmlFilePath))) {
                mkdir(dirname($htmlFilePath), 0755, true);
            }
            file_put_contents($htmlFilePath, $request->description);
            $proposal = SubContractorProposal::where('proposal_template_id', $proposal_template_id)->where('lead_id', $lead_id)->where('sub_contractor_id', $sub_contractor_id)->first();
            if (!$proposal) {
                return back()->with('error', 'Proposal not found.');
            }
            $proposal->update([
                'signature' => json_encode($savedSignatures),
                'description' => $htmlFilename,
                'status' => 'signed',
                'job_status' => 'active'
            ]);
            return auth()->check()
                ? redirect('/dashboard')->with('flash_message', 'Signature saved successfully')
                : redirect('/login')->with('flash_message', 'Signature saved successfully');
        } catch (\Exception $e) {
            // Catch any exception and log it
            \Log::error('Error in storesubContractorProposalSignature: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the signature: ' . $e->getMessage());
        }
    }
    public function viewProposalPdf($filename){
        $htmlPath = public_path("website/customer_proposal_response/{$filename}");
        if (!is_file($htmlPath)) {
            abort(404, 'File not found');
        }
        $htmlContent = file_get_contents($htmlPath);

        // Get proposal and signatures
        $proposal = Proposal::where('customer_description', $filename)->first();
        if (!$proposal) {
            abort(404, 'Proposal not found');
        }

        $signatures = json_decode($proposal->signature, true) ?? [];

        // Convert image paths to absolute URLs for proper rendering
        $htmlContent = preg_replace_callback('/<img\s+[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', function ($matches) {
            $src = $matches[1];
            return filter_var($src, FILTER_VALIDATE_URL) ? $matches[0] : str_replace($src, asset($src), $matches[0]);
        }, $htmlContent);
        // Ensure each page div has a page break
        $htmlContent = str_replace('class="proposal-page"', 'class="proposal-page" style="page-break-after: always;"', $htmlContent);

        // ✅ Insert Signatures at Correct Data-ID Locations
        foreach ($signatures as $sig) {
            if (!isset($sig['id']) || !isset($sig['path'])) {
                continue; // Skip if id or path is missing
            }

            $signatureTag = '<img src="' . asset("storage/" . $sig['path']) . '"
                 style="width: 100%; height: 100%; object-fit: contain;">';
            $htmlContent = preg_replace(
                '/(<div\s+[^>]*data-id=[\'"]' . preg_quote($sig['id'], '/') . '[\'"][^>]*>)(.*?)(<\/div>)/i',
                '$1$2' . $signatureTag . '$3',
                $htmlContent
            );
        }

        // Wrap content inside a basic HTML structure
        $finalHtml = '<html><head><style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        img { max-width: 100%; height: auto; }
        .clear-signature-btn{display: none;}
        .proposal-page { height: 1115px; max-width: 900px; position: relative; }
        .signature-box {
            width: 440px !important;
    height: 200px;
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
}
        .table-container { width: 860px; }
    </style></head><body>' . $htmlContent . '</body></html>';

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadHTML($finalHtml)->setPaper([0, 0, 900, 1115], 'portrait');
        return $pdf->stream('proposal.pdf');
    }


    public function viewSubContractorPdf($id, $lead_id)
    {
//        $proposal = SubContractorProposal::with('getProposal')
//            ->where('proposal_template_id', $id)
//            ->where('lead_id', $lead_id)
//            ->first();

        $proposal = SubContractorProposal::where('proposal_template_id', $id)->where('lead_id', $lead_id)->first();

//        $proposal = $proposal->getProposal;


        if (!$proposal) {
            abort(404, 'Proposal not found');
        }

        $filename = basename(trim($proposal->description));

        $htmlPath = public_path("website/{$proposal->description}");

        // ✅ Check that the path is a valid file, not a directory
        if (!is_file($htmlPath)) {
            abort(404, 'Invalid file path');
        }

        $htmlContent = file_get_contents($htmlPath);
        $signatures = json_decode($proposal->signature, true) ?? [];

        $htmlContent = preg_replace_callback('/<img\s+[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', function ($matches) {
            $src = $matches[1];
            return filter_var($src, FILTER_VALIDATE_URL)
                ? $matches[0]
                : str_replace($src, asset($src), $matches[0]);
        }, $htmlContent);

        $htmlContent = str_replace(
            'class="proposal-page"',
            'class="proposal-page" style="page-break-after: always;"',
            $htmlContent
        );

        foreach ($signatures as $sig) {
            if (isset($sig['id'], $sig['path'])) {
                $signatureTag = '<img src="' . asset("storage/" . $sig['path']) . '" style="width: 100%; height: 100%; object-fit: contain;">';
                $htmlContent = preg_replace(
                    '/(<div\s+[^>]*data-id=[\'"]' . preg_quote($sig['id'], '/') . '[\'"][^>]*>)(.*?)(<\/div>)/i',
                    '$1' . $signatureTag . '$3',
                    $htmlContent
                );
            }
        }

        $finalHtml = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 14px; }
                img { max-width: 100%; height: auto; }
                .clear-signature-btn { display: none; }
                .proposal-page { height: 1115px; max-width: 900px; position: relative; }
                .signature-box {
                    width: 440px !important;
                    height: 200px;
                    border: 1px solid #000;
                    padding: 10px;
                    text-align: center;
                }
                .table-container { width: 860px; }
            </style>
        </head>
        <body>' . $htmlContent . '</body>
        </html>';

        $pdf = Pdf::loadHTML($finalHtml)->setPaper([0, 0, 900, 1115], 'portrait');

        // Check for download mode
        if (request()->query('download') == '1') {
            $pdf = Pdf::loadHTML($finalHtml)->setPaper([0, 0, 900, 1115], 'portrait');
            return $pdf->download('proposal.pdf');
        } else {
            return response($finalHtml, 200)
                ->header('Content-Type', 'text/html');
        }

    }

    public function viewJoblPdf($filename){
        $htmlPath = public_path("website/subcontractor_proposal_response/{$filename}");
        if (!is_file($htmlPath)) {
            abort(404, 'File not found');
        }
        $htmlContent = file_get_contents($htmlPath);

        // Get proposal and signatures
        $proposal = SubContractorProposal::where('description', $filename)->first();
        if (!$proposal) {
            abort(404, 'Proposal not found');
        }


        $signatures = json_decode($proposal->signature, true) ?? [];

        // Convert image paths to absolute URLs for proper rendering
        $htmlContent = preg_replace_callback('/<img\s+[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', function ($matches) {
            $src = $matches[1];
            return filter_var($src, FILTER_VALIDATE_URL) ? $matches[0] : str_replace($src, asset($src), $matches[0]);
        }, $htmlContent);
        // Ensure each page div has a page break
        $htmlContent = str_replace('class="proposal-page"', 'class="proposal-page" style="page-break-after: always;"', $htmlContent);
        // ✅ Insert Signatures at Correct Data-ID Locations
        foreach ($signatures as $sig) {
            if (!isset($sig['id']) || !isset($sig['path'])) {
                continue; // Skip if id or path is missing
            }

            $signatureTag = '<img src="' . asset("storage/" . $sig['path']) . '"
                 style="width: 100%; height: 100%; object-fit: contain;">';
            $htmlContent = preg_replace(
                '/(<div\s+[^>]*data-id=[\'"]' . preg_quote($sig['id'], '/') . '[\'"][^>]*>)(.*?)(<\/div>)/i',
                '$1$2' . $signatureTag . '$3',
                $htmlContent
            );
        }

        // Wrap content inside a basic HTML structure
        $finalHtml = '<html><head><style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        img { max-width: 100%; height: auto; }
        .clear-signature-btn{display: none;}
        .proposal-page { height: 1115px; max-width: 900px; position: relative; }
        .signature-box {
            width: 440px !important;
    height: 200px;
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
}
        .table-container { width: 860px; }
    </style></head><body>' . $htmlContent . '</body></html>';

        // Generate PDF using DOMPDF
        $pdf = Pdf::loadHTML($finalHtml)->setPaper([0, 0, 900, 1115], 'portrait');
        return $pdf->stream('proposal.pdf');
    }


//    public function viewProposalPdf(Request $request, $filename)
//    {
//        // Basic filename validation (optional but recommended)
//        if (!preg_match('/^[\w\-\.]+$/', $filename)) {
//            abort(400, 'Invalid filename');
//        }
//
//        // Determine type
//        $isSubContractor = $request->has('show');
//        $folder = $isSubContractor ? 'subcontractor_proposal_response' : 'customer_proposal_response';
//        $htmlPath = public_path("website/{$folder}/{$filename}");
////return $htmlPath;
//
//        // Fetch proposal model
//        $proposal = $isSubContractor
//            ? SubContractorProposal::where('description', $filename)->first()
//            : Proposal::where('customer_description', $filename)->first();
//
////        return $proposal;
//        if (!is_file($htmlPath)) {
//            abort(404, 'File not found');
//        }
//
//            if (!$proposal) {
//                abort(404, 'Proposal not found');
//            }
//
//        $htmlContent = file_get_contents($htmlPath);
//        return $htmlContent;
//
//            $signatures = json_decode($proposal->signature, true) ?? [];
//
//        // Convert image paths to absolute URLs
//            $htmlContent = preg_replace_callback('/<img\s+[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', function ($matches) {
//                $src = $matches[1];
//                return filter_var($src, FILTER_VALIDATE_URL) ? $matches[0] : str_replace($src, asset($src), $matches[0]);
//            }, $htmlContent);
//
//        // Ensure page breaks
//            $htmlContent = str_replace('class="proposal-page"', 'class="proposal-page" style="page-break-after: always;"', $htmlContent);
//
//        // Insert Signatures
//            foreach ($signatures as $sig) {
//            if (!isset($sig['id'], $sig['path'])) continue;
//
//                $signatureTag = '<img src="' . asset("storage/" . $sig['path']) . '" style="width: 100%; height: 100%; object-fit: contain;">';
//
//                $htmlContent = preg_replace(
//                    '/(<div\s+[^>]*data-id=[\'"]' . preg_quote($sig['id'], '/') . '[\'"][^>]*>)(.*?)(<\/div>)/i',
//                    '$1$2' . $signatureTag . '$3',
//                    $htmlContent
//                );
//            }
//
//        // Wrap in HTML structure
//            $finalHtml = '<html><head><style>
//            body { font-family: Arial, sans-serif; font-size: 14px; }
//            img { max-width: 100%; height: auto; }
//            .clear-signature-btn { display: none; }
//            .proposal-page { height: 1115px; max-width: 900px; position: relative; }
//            .signature-box {
//                width: 440px !important;
//                height: 200px;
//                border: 1px solid #000;
//                padding: 10px;
//                text-align: center;
//            }
//            .table-container { width: 860px; }
//        </style></head><body>' . $htmlContent . '</body></html>';
//
//        // Generate PDF
//
//        $pdf = \PDF::loadHTML($finalHtml)->setPaper([0, 0, 900, 1115], 'portrait');
//
//        return $pdf->stream('proposal.pdf');
//    }

//    public function changeHolidayStatus($id=null,$status = null){
//        Holiday::where('id',$id)->update(['status'=>$status]);
//        return redirect()->with(['message'=>'Status updated successfully','icon'=>'success','title'=>'Done.']);
//    }
    public function changeHolidayStatus($id = null, $status = null){
        try {
            $holiday = Holiday::whereid($id)->update(['status' => $status]);
            return redirect()->back()->with(['message' => 'Status updated successfully', 'title' => 'Done', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'title' => 'Try Again', 'type' => 'info']);
        }
    }

    public function changeMarkStatus($id = null, $status = null)
    {
        try {
            $mark = Mark::whereid($id)->update(['status' => $status]);
            return redirect()->back()->with(['message' => 'Status Updated Succesfully', 'title', 'Done', 'icon' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'title', 'Try Again', 'icon' => 'info']);
        }
    }

    public function changeCalculatorStatus($id = null, $status = null)
    {
        try {
            $calculator = CalculatorSize::whereid($id)->update(['status' => $status]);
            return redirect()->back()->with(['message' => 'Status Updated Successfully', 'icon' => 'success', 'title' => 'Done']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'icon' => 'info', 'title' => 'Try Again']);
        }
    }

    public function changeCompanyContactStatus($id = null, $insurance_status = null)
    {
        try {
            $companyContact = CompanyContact::whereid($id)->update(['insurance_status' => $insurance_status]);
            return redirect()->back()->with(['message' => 'Status Updated Successfully', 'icon' => 'success', 'title' => 'Done.']);
        } catch (Exception $e) {
            return response()->json(['success' => false . $e->getMessage()]);
        }
    }

    public function changeStaffStatus($id = null, $status = null)
    {
        try {
            $staff = User::whereid($id)->update(['status' => $status]);
            return redirect()->back()->with(['message' => 'Status Updated Successfully', 'icon' => 'success', 'title' => 'Done']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong', 'icon' => 'info', 'title' => 'Try Again']);
        }
    }

    public function viewEstimation($id){
        $yearEstimation = YearEstimation::find($id);
        $finance = FinanceSheet::with(['grossIncome', 'grossCogs', 'grossExpense', 'totalOhExpense'])->where('year_estimation_id', $id)->first();
        $categories = Category::where('status', 1)->get();
        $cogsMaterials = CogsMaterial::where('status', 1)->get();
        $lead = Lead::with('getChangeOrder')->whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'won')->get();
        $totalGrossIncome = Lead::whereYear('lead_status_date', $yearEstimation->year)
            ->where('lead_status', 'won')
            ->whereHas('category')
            ->with(['getChangeOrder' => function($query) {
                $query->where('status', 'approved');
            }])
            ->get()
            ->sum(function($lead) {
                return (float)$lead->lead_price + (float)$lead->getChangeOrder->sum('total_amount');
            });
        $advertisementBudget = Advertisement::where('year', $yearEstimation->year)->sum('monthly_budget');
        $cogs = CostOfGoodSold::whereYear('cogs_date', $yearEstimation->year)->with('cogsSheetsDetails')->get();
        $filteredCogs = $cogs->filter(function ($cog) {
            return $cog->lead && $cog->lead->lead_status == 'won'; // Only keep cogs with won leads
        });
        $expense = ['payroll', 'owner_pay', 'merchant_fee', 'employee_training', 'advertising_marketing', 'bank_charges', 'dues_subscription', 'insurance', 'legal', 'office_computer', 'rent_lease', 'taxes', 'travel', 'utilities', 'vehicle'];
        $grossExpense = isset($finance->grossExpense) ? $finance->grossExpense->sum(fn($item) => collect($expense)->sum(fn($col) => $item[$col] ?? 0)) : 0;
        $totalIncome =  (isset($finance->grossIncome) ? $finance->grossIncome->sum('value') - $finance->grossCogs->sum('value') : 0)  - $grossExpense;
        return view('yearEstimation.year-estimation.view_estimation', compact('advertisementBudget', 'yearEstimation', 'cogs', 'totalGrossIncome', 'lead', 'finance', 'categories', 'cogsMaterials', 'totalIncome', 'filteredCogs'));
    }//ends yearlyReport function.

    public function createNewYearEstimate($id){
        $yearEstimation = YearEstimation::find($id);
        $finance = FinanceSheet::with(['grossIncome', 'grossCogs', 'grossExpense'])->where('year_estimation_id', $id)->first();
        $categories = Category::where('status', 1)->get();
        $cogsMaterials = CogsMaterial::where('status', 1)->get();
        return view('yearEstimation.year-estimation.create_new_year_estimate', compact('categories', 'cogsMaterials', 'yearEstimation', 'finance'));
    }
    public function storeFinanceOh(Request $request)
    {
        extract($request->all());
        foreach($expense as $name => $item)
            FinanceOhExpense::updateOrCreate([
                'finance_sheet_id' => $finance_sheet_id,
            ],
                [
                    'finance_sheet_id' => $finance_sheet_id,
                    'name' => $name,
                    'value' => $item['value'],
                ]);
        return back();
    }

//    public function stopCheckOutSessions(){
//        $today = Carbon::today();
//        $sessions = UserCheckIn::whereNull('check_out')
//            ->whereDate('check_in', '<', $today)
//            ->get();
//        foreach ($sessions as $session) {
//            // Manually parse check_in if it's still a string
//            $checkInTime = is_string($session->check_in) ? Carbon::parse($session->check_in) : $session->check_in;
//            $checkOutTime = Carbon::now();
//            $totalHoursDecimal = $checkInTime->diffInHours($checkOutTime) + ($checkInTime->diffInMinutes($checkOutTime) % 60) / 60;
//            $hours = floor($totalHoursDecimal);
//            $decimalMinutes = ($totalHoursDecimal - $hours) * 60;
//            $minutes = floor($decimalMinutes);
//            $seconds = floor(($decimalMinutes - $minutes) * 60);
//            $totalHoursFormatted = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
//            $session->update([
//                'check_out' => $checkOutTime,
//                'total_hours' => $totalHoursFormatted,
//            ]);
//            \Log::info('Session automatically stopped for user ' . $session->user_id);
//        }
//    }

//    public function storeCustomizeProposals(Request $request)
//    {
//        $proposalId = $request->proposal_id;
//        $name = $request->name;
//        $chunkIndex = $request->resumableChunkNumber; // Current chunk index
//        $totalChunks = $request->resumableTotalChunks; // Total number of chunks
//        $originalFileName = "proposal_" . uniqid() . ".html"; // Unique filename for final HTML
//
//        // ✅ Chunk storage folder
//        $chunkFolderPath = storage_path("app/proposal_chunks/");
//        if (!file_exists($chunkFolderPath)) {
//            mkdir($chunkFolderPath, 0755, true);
//        }
//
//        // ✅ Save the uploaded chunk
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//
//            if ($file->isValid()) {
//                // Save chunk as a temporary file
//                $chunkPath = $chunkFolderPath . "{$chunkIndex}.part";
//                file_put_contents($chunkPath, file_get_contents($file));
//
//                // ✅ If this is the last chunk, merge all chunks
//                if ($chunkIndex + 1 == $totalChunks) {
//                    $finalFilePath = public_path("website/proposal_template/{$originalFileName}");
//
//                    // Merge chunks
//                    $finalFile = fopen($finalFilePath, 'w');
//                    for ($i = 0; $i < $totalChunks; $i++) {
//                        $chunkPath = $chunkFolderPath . "{$i}.part";
//                        fwrite($finalFile, file_get_contents($chunkPath));
//                        unlink($chunkPath); // Delete chunk after merging
//                    }
//                    fclose($finalFile);
//                    rmdir($chunkFolderPath); // Delete temp folder
//
//                    // ✅ Save the final file in the database
//                    if ($proposalId) {
//                        $proposal = ProposalTemplate::find($proposalId);
//                        if ($proposal) {
//                            $proposal->update([
//                                'name' => $name ?? $proposal->name,
//                                'description' => $originalFileName,
//                            ]);
//                        }
//                    } else {
//                        $proposal = ProposalTemplate::create([
//                            'name' => $name,
//                            'description' => $originalFileName,
//                        ]);
//                    }
//
//                    return response()->json([
//                        'status' => true,
//                        'message' => 'Proposal Uploaded Successfully!',
//                        'file_path' => $originalFileName,
//                        'proposal_id' => $proposal->id,
//                    ]);
//                }
//
//                return response()->json([
//                    'status' => true,
//                    'message' => "Chunk {$chunkIndex} received",
//                ]);
//            }
//        }
//
//        return response()->json(['status' => false, 'message' => 'Invalid file upload.']);
//    }
    public function adminCheckInListing(){
        $staff = User::whereHas('roles', function($q){$q->where('name', 'user');})->orderBy('id', 'desc')->get();
//        $checkIns = auth()->user()->userCheckIn()->orderBy('date', 'desc')->get();
//        $groupedData = $checkIns->groupBy('date');
        return view('admin.admin_checkin_listing', compact( 'staff'));
    }
    public function getCalculatorPrice(Request $request){
        $size = Product::find($request->id);
        return response()->json($size);
    }
    public function selectEmailTemplate(Request $request){
        $emailTemplate = EmailTemplate::where('email_template_folder_id', $request->id)->get();
        return response()->json([
            'success' => true,
            'template' => $emailTemplate
        ]);
    }
    public function getCalendarTypes(){
        return view('admin.calendar_types');
    }
    public function storeCalendarTypes(Request $request){
        CommonSetting::where('id', 1)->update(['calendar' => $request->calendar_type]);
        return back()->with('flash_message', 'Calendar type updated successfully!');
    }
    public function updateStageAutomation(Request $request) {
        $stage = Stage::where('id', $request->contractId)
            ->orWhere('id', $request->financeId)
            ->first();
        if ($stage) {
            if ($request->has('contract')) {
                $stage->contract = $request->contract;
                Stage::where('contract', $request->contract)
                    ->where('id', '!=', $stage->id)
                    ->update(['contract' => 0]);
            }
            if ($request->has('finance')) {
                $stage->finance = $request->finance;

                Stage::where('finance', $request->finance)
                    ->where('id', '!=', $stage->id)
                    ->update(['finance' => 0]);
            }
            $stage->save();
            return response()->json(['success' => true, 'message' => 'Stage updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Stage not found']);
    }
    public function validateFinanceStageBeforeAdd(Request $request){
//        return $request->all();
        $stage = Stage::where('finance', 1)->first();
        if ($stage) {
            $lead = Lead::where('id', $request->id)->first();
            $leadStage = Stage::find($lead->stage_id);
//            if ($lead && $lead->stage_id >= $stage->id) {
//                return response()->json(['success' => true]);
//            }
            if ($leadStage && $leadStage->position >= $stage->position) {
                return response()->json(['success' => true]);
            }
//            if ($lead && $lead->stage_id == $stage->id) {
//                return response()->json(['success' => true]);
//            }
            return response()->json(['success' => false, 'message' => 'Please proceed to the valid stage ' . $stage->name??""]);
        } else {
            return response()->json(['success' => false, 'message' => 'No stage found with finance = 1'], 404);
        }
    }
    public function duplicateMaterialName(Request $request){
        $material = Product::where('sub_category', $request->name)->first();
        if ($material) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function getChimneyContentChimney(Request $request){
        $chimneyEstimateCalculator = ChimneyEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->chimney_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $chimneyLabels = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels;
        $totalBricks = $chimneyEstimateCalculator->total_bricks_rows;
        $chimneyStoriesLabels = $chimneyLabels->where('section', 'stories')->first()->value;
        $chimneyPitchLabels = $chimneyLabels->where('section', 'pitch')->first()->value;
        $chimneyDificutLabels = $chimneyLabels->where('section', 'dificut')->first()->value;
        $chimneyCapLabels = $chimneyLabels->where('section', 'chimney_cap_one')->first()->value;
        $chimneyCapLabeltwo = $chimneyLabels->where('section', 'chimney_cap_two')->first()->value;
//        $miscellaneous = $chimneyLabels->where('section', 'miscellaneous')->first()->value;
        $chimneyBaseValues = CalculatorBaseValue::first();
        $chimneyDataChimney = json_decode($chimneyBaseValues->chimney_chimney, true);
//        if(isset($lead->chimneyEstimateCalculator->base_value_id) && $lead->chimneyEstimateCalculator->base_value_id  != null){
//            $chimneyBaseValues = CalculatorBaseValue::findOrFail($lead->chimneyEstimateCalculator->base_value_id);
//        }else{
//            $chimneyBaseValues = CalculatorBaseValue::latest()->first();
//        }
        return (string)view('lead.lead.chimney_estimate.chimney_estimation_calculator_chimney', compact(
            'chimneyEstimateCalculator', 'lead', 'totalBricks',
            'chimneyStoriesLabels', 'chimneyPitchLabels', 'chimneyDificutLabels', 'chimneyCapLabels',
            'chimneyCapLabeltwo', 'chimneyBaseValues','chimneyDataChimney'));
    }
    public function getChimneyContentLiner(Request $request){
        $chimneyEstimateCalculator = ChimneyEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->chimney_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $chimneyHomeStyle = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value;
//        $miscellaneous = $chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'miscellaneous')->first()->value;
        $chimneyBaseValuesLiner = CalculatorBaseValue::first();
        $chimneyDataLiner = json_decode($chimneyBaseValuesLiner->chimney_liner, true);
//        if(isset($lead->chimneyEstimateCalculator->base_value_id) && $lead->chimneyEstimateCalculator->base_value_id  != null){
//            $chimneyBaseValuesLiner = CalculatorBaseValue::findOrFail($lead->chimneyEstimateCalculator->base_value_id);
//        }else{
//            $chimneyBaseValuesLiner = CalculatorBaseValue::latest()->first();
//        }
        return (string)view('lead.lead.chimney_estimate.chimney_estimation_calculator_liner',  compact(
            'chimneyEstimateCalculator', 'lead', 'chimneyHomeStyle', 'chimneyBaseValuesLiner','chimneyDataLiner'));
    }
    public function getSidingContentReplacement(Request $request){
        $sidingEstimateCalculator = SidingEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->siding_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $sideBase = CalculatorBaseValue::first();
        $sidingLabels = $sidingEstimateCalculator->sidingEstimateCalculatorLabels;
        $sidingReplacementDoors = $sidingLabels->where('section', 'doors')->first()->value;
        $sidingReplacementWindows = $sidingLabels->where('section', 'windows')->first()->value;
        $sidingReplacementLayers = $sidingLabels->where('section', 'layers')->first()->value;
        $sidingReplacementShatters = $sidingLabels->where('section', 'shatter')->first()->value;
        $sidingReplacementPlywood = $sidingLabels->where('section', 'plywood')->first()->value;
        $replacementWindowsDoors = $sidingReplacementDoors + $sidingReplacementWindows;
        $sidingReplacementSq = $sidingEstimateCalculator->eave_rakes_total_percent;
        $sidingReplacementSoffitTotalSum = $sidingEstimateCalculator->soffit_total_sum;
        $sidingReplacementAdditionalLayers = $sidingReplacementLayers * $sidingReplacementSq;

        $azeck = 0;
        $aluminum = 0;

        if ($sidingEstimateCalculator->soffit == 'azeck') {
            $azeck = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
        } else if ($sidingEstimateCalculator->soffit == 'aluminum') {
            $aluminum = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
        }
        $sidingBaseValuesReplacement = CalculatorBaseValue::first();
        $sideDataReplacement = json_decode($sidingBaseValuesReplacement->siding_replacement, true);
        return (string)view('lead.lead.siding_estimate.siding_estimation_calculator_replacement', compact(
            'sidingEstimateCalculator', 'lead', 'sideBase', 'sidingLabels', 'sidingReplacementDoors',
            'sidingReplacementWindows', 'sidingReplacementLayers', 'sidingReplacementShatters', 'sidingReplacementPlywood',
            'replacementWindowsDoors', 'sidingReplacementSq', 'sidingReplacementSoffitTotalSum', 'sidingReplacementAdditionalLayers',
            'azeck', 'aluminum','sidingBaseValuesReplacement','sideDataReplacement'
        ));
    }
    public function getSidingContentOverExisting(Request $request){
        $sidingEstimateCalculator = SidingEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->side_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $sidingExistingsq = $sidingEstimateCalculator->eave_rakes_total_percent;
        $sidingLabels = $sidingEstimateCalculator->sidingEstimateCalculatorLabels;
        $sidingExistingDoors = $sidingLabels->where('section', 'doors')->first()->value;
        $sidingExistingWindows = $sidingLabels->where('section', 'windows')->first()->value;
        $sidingExistingLayers = $sidingLabels->where('section', 'layers')->first()->value;
        $sidingExistingShatters = $sidingLabels->where('section', 'shatter')->first()->value;
        $sidingExistingPlywood = $sidingLabels->where('section', 'plywood')->first()->value;
        $existingWindowsDoors = $sidingExistingDoors + $sidingExistingWindows;
        $sidingExistingSq = $sidingEstimateCalculator->eave_rakes_total_percent;
        $sidingExistingSoffitTotalSum = $sidingEstimateCalculator->soffit_total_sum;
        $sidingExistingAdditionalLayers = $sidingExistingLayers * $sidingExistingSq;

        $azeck = 0;
        $aluminum = 0;

        if ($sidingEstimateCalculator->soffit == 'azeck') {
            $azeck = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
        } else if ($sidingEstimateCalculator->soffit == 'aluminum') {
            $aluminum = $sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes;
        }
        $sidingBaseValuesOver = CalculatorBaseValue::first();
        $sideDataOver = json_decode($sidingBaseValuesOver->siding_over_existing, true);
        return (string)view('lead.lead.siding_estimate.siding_estimation_calculator_over_existing', compact(
            'sidingEstimateCalculator',
            'sidingExistingsq', 'sidingLabels', 'sidingExistingDoors', 'sidingExistingWindows',
            'sidingExistingLayers', 'sidingExistingShatters', 'sidingExistingPlywood', 'existingWindowsDoors', 'sidingExistingSq',
            'sidingExistingSoffitTotalSum', 'sidingExistingAdditionalLayers', 'azeck', 'aluminum','sidingBaseValuesOver','sideDataOver'
        ));
    }
    public function getSidingContentGutter(Request $request){
        $sidingEstimateCalculator = SidingEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->siding_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $storeSideEstimateCalculatorGutter = $sidingEstimateCalculator;
        $sidingBaseValuesGutter = CalculatorBaseValue::first();
        $sideDataGutter = json_decode($sidingBaseValuesGutter->siding_gutter, true);

        return (string)view('lead.lead.siding_estimate.siding_estimation_calculator_gutter', compact('sidingEstimateCalculator', 'lead', 'storeSideEstimateCalculatorGutter', 'sidingBaseValuesGutter','sideDataGutter'));
    }
    public function getRoofContentPreferred(Request $request){
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->roof_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $roofBase = CalculatorBaseValue::first();
        $roofDataPrefer = json_decode($roofBase->roof_prefer, true);
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
        $skyLightQuantity = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('quantity')
            : 0;
        $skyLightPrice = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('price')
            : 0;
        $roofBaseValuesPrefer = CalculatorBaseValue::first();
        return (string)view('lead.lead.roof_estimate.roof_estimation_calculator_prefer', compact(
            'roofEstimateCalculator', 'lead', 'roofBase', 'additional_layer', 'additional_layer_price_per_sq',
            'stepCharge', 'stepChargePricePerSq', 'chimneySize', 'chimneySizePricePerSq', 'plywood', 'plywoodPricePerSq', 'skyLightQuantity', 'skyLightPrice','roofBaseValuesPrefer','roofDataPrefer'
        ));
    }
    public function getRoofContentSystem(Request $request)
    {
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->roof_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $roofBase = CalculatorBaseValue::first();
        $roofDataSystem = json_decode($roofBase->roof_system, true);
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
        $skyLightQuantity = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('quantity')
            : 0;
        $skyLightPrice = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('price')
            : 0;
        $roofBaseValuesSystem = CalculatorBaseValue::first();
        return (string)view('lead.lead.roof_estimate.roof_estimation_calculator_system', compact(
            'roofEstimateCalculator', 'lead', 'roofBase', 'additional_layer', 'additional_layer_price_per_sq',
            'stepCharge', 'stepChargePricePerSq', 'chimneySize', 'chimneySizePricePerSq', 'plywood', 'plywoodPricePerSq', 'skyLightQuantity', 'skyLightPrice','roofBaseValuesSystem','roofDataSystem'
        ));
    }
    public function getRoofContentUnderSq(Request $request)
    {
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->roof_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $roofBase = CalculatorBaseValue::first();
        $roofDataUnder = json_decode($roofBase->roof_under_sq, true);
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
        $skyLightQuantity = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('quantity')
            : 0;
        $skyLightPrice = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('price')
            : 0;
        $roofBaseValuesUnder = CalculatorBaseValue::first();
        return (string)view('lead.lead.roof_estimate.roof_estimation_calculator_under_fifteen_sq', compact(
            'roofEstimateCalculator', 'lead', 'roofBase', 'additional_layer', 'additional_layer_price_per_sq',
            'stepCharge', 'stepChargePricePerSq', 'chimneySize', 'chimneySizePricePerSq', 'plywood', 'plywoodPricePerSq', 'skyLightQuantity', 'skyLightPrice','roofBaseValuesUnder','roofDataUnder'
        ));
    }
    public function getRoofContentGutter(Request $request){
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->roof_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $roofBase = CalculatorBaseValue::first();
        $roofDataGutter = json_decode($roofBase->roof_gutter, true);
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
        $skyLightQuantity = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('quantity')
            : 0;
        $skyLightPrice = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('price')
            : 0;
        $roofBaseValuesGutter = CalculatorBaseValue::first();
        return (string)view('lead.lead.roof_estimate.roof_estimation_calculator_gutter', compact(
            'roofEstimateCalculator', 'lead', 'roofBase', 'additional_layer', 'additional_layer_price_per_sq',
            'stepCharge', 'stepChargePricePerSq', 'chimneySize', 'chimneySizePricePerSq', 'plywood', 'plywoodPricePerSq', 'skyLightQuantity', 'skyLightPrice','roofBaseValuesGutter','roofDataGutter'
        ));
    }
    public function getRoofContentFlatRoof(Request $request){
        $roofEstimateCalculator = RoofEstimateCalculator::where('lead_id', $request->lead_id)->where('id', $request->roof_estimate_calculator_id)->first();
        $lead = Lead::find($request->lead_id);
        $roofBase = CalculatorBaseValue::first();
        $roofDataFlat = json_decode($roofBase->roof_flat_roof, true);
        if (!$roofEstimateCalculator) {
            return redirect()->back()->with('error', 'Roof Estimate Calculator not found.');
        }
        $additional_layer = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'layers')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $additional_layer_price_per_sq = $additional_layer * 2;
        $stepCharge = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'pitch')->first()->value * ($roofEstimateCalculator->total_sq ?? 1);
        $stepChargePricePerSq = $stepCharge * 4;
        $chimneySize = (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'chimney_sizes')->first()->value : 0) +
            (isset($roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value) ? $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'skylights')->first()->value : 0);
        $chimneySizePricePerSq = $chimneySize * 100;
        $plywood = $roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'plywood')->first()->value;
        $plywoodPricePerSq = $plywood * 33;
        $skyLightQuantity = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('quantity')
            : 0;
        $skyLightPrice = isset($roofEstimateCalculator->roofEstimateCalculatorSkylight)
            ? $roofEstimateCalculator->roofEstimateCalculatorSkylight->where('roof_estimate_calculator_id', $request->roof_estimate_calculator_id)->sum('price')
            : 0;
        $roofBaseValuesFlat = CalculatorBaseValue::first();
        return (string)view('lead.lead.roof_estimate.roof_estimation_calculator_flat_roof', compact(
            'roofEstimateCalculator', 'lead', 'roofBase', 'additional_layer', 'additional_layer_price_per_sq',
            'stepCharge', 'stepChargePricePerSq', 'chimneySize', 'chimneySizePricePerSq', 'plywood', 'plywoodPricePerSq', 'skyLightQuantity', 'skyLightPrice','roofBaseValuesFlat','roofDataFlat'
        ));
    }
    public function storeDefaultSettingProduct(Request $request){
        $product = Product::find($request->productId);
        if($request->default_category != null){
            $product->update([
                'status' => 1,
                'default_category' => json_encode($request->default_category),
            ]);
        }else{
            $product->update([
                'status' => 0,
                'default_category' => null
            ]);
        }
        return redirect()->back()->with('flash_message', 'Product Update');


    }

    public function importLeadsPage(Request $request){
        return view('admin.import-leads');
    }

    public function importLeads(Request $request)
    {
        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $header = null;
        $data = [];

        if (($handle = fopen($path, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

//        return $data;

        foreach ($data as $row) {
            DB::transaction(function () use ($row) {
                $email = $row['Email Address'] ?? null;
                $user = User::withTrashed()->where('email', $email)->first();
                if ($user === null) {
                    $user = User::create([
                        'name' => trim(($row['First Name'] ?? '') . ' ' . ($row['Last Name'] ?? '')),
                        'first_name' => $row['First Name'] ?? '',
                        'last_name' => $row['Last Name'] ?? '',
                        'email' => $row['Email Address'] ?? '',
                        'password' => '$2y$10$fZPw2DJF7VSO6hKMu3DD9u.9bAcVeGJc0favnLS3h1kGomfZYu6e6',
                        'status' => '1',
                        'salesman_id' => $row['Relationship Manager'] ?? null,
                        'customer_type_id' => '1',
                        'created_by' => '2',
                        'referral_source_id' => $row['Referred By'] ?? '',
                        'created_at' => $this->parseDateCreatedAt($row['Job Record Since'] ?? null),
                    ]);

                    Profile::create([
                        'user_id' => $user->id,
                        'address' => $row['Customer Address'] ?? '',
                        'city' => $row['City'] ?? '',
                        'state' => $row['State'] ?? '',
                        'zip' => $row['Zip'] ?? '',
                        'latitude' => $row['Latitude'] ?? null,
                        'longitude' => $row['Longitude'] ?? null,
                        'phone' => $row['Phone Number'] ?? '',
                    ]);

                    $role = Role::find(6);
                    $user->assignRole($role->name);
                } elseif ($user->deleted_at !== null) {
                    $user->update(['email' => $email . '.' . time()]);
                }

                $stage = Stage::where('id', $row['Stage'])->first();
                $lead = Lead::create([
                    'lead_date' => $this->parseDate($row['Job Record Since'])??'',
                    'lead_status' => $row['Lead Status']??'',
                    'lead_status_date' => $this->parseDate($row['Lead Status Date'])??'',
                    'job_number' => $row['Job Number'] ?? null,
                    'title' => $row['Lead Name Main']??'',
                    'customer_id' => $user->id,
                    'representative_id' => $row['Representative Name']??'',
                    'category_id' => $row['Job Category']??'',
                    'lead_number' => $row['Lead Number']??'',
                    'address' => $row['Job Contact Full Address']??'',
                    'latitude' => $row['Job Latitude']??'',
                    'longitude' => $row['Job Longitude']??'',
                    'state' => $row['Job State']??'',
                    'postal_code' => $row['Job Zip']??'',
                    'city' => $row['Job City']??"",
                    'stage_id' => $row['Stage']??'',
                    'stage_position' => $stage->position??'',
                    'lead_amount' => $this->parseMoney($row['Lead Price'])??'',
                    'lead_price' => $this->parseMoney($row['Lead Price'])??'',
                    'created_by' => '2'??'',
                    'company_id' => $row['Insurance Category'],
                    'date_loss_insurance' => $row['Insurance Date of Loss'],
                ]);

                $allStages = Stage::get();
                foreach($allStages as $data) {
                    LeadStage::create([
                        'lead_id' => $lead->id,
                        'stage_id' => $data->id,
                        'position' => $data->position,
                        'date' => now()->format('Y-m-d'),
                        'status' => $data->status,
                    ]);
                }

                $changOrder = ChangeOrder::create([
                    'lead_id' => $lead->id??'',
                    'customer_id' => $lead->customer->id??'',
                    'address' => $lead->address??'',
                    'due_date' => '2021-01-01'??'',
                    'change_order_unique_id' => rand(100000, 999999),
                    'sub_total' => $this->parseMoney($row['Change Orders'])??'',
                    'total_tax' => '0.00'??'',
                    'total_amount' => $this->parseMoney($row['Change Orders'])??'',
                    'representative_id' => $lead->representative_id??'',
                    'created_by' => '2'??'',
                    'status' => 'approved'??''
                ]);

                ChangeOrderAttachment::create([
                    'change_order_id' => $changOrder->id??'',
                    'activity_name' => $row['Activity Name']??'',
                    'category_id' => $row['Category']??'',
                    'quantity' => $row['Quantity']??'',
                    'rate' => $row['Rate']??'',
                    'amount' => $this->parseMoney($row['Change Orders'])??'',
                    'tax' => '0.00'??'',
                ]);


                $invoice = Invoice::create(
                    [
                        'lead_id' => $lead->id,
                        'customer_id' => $user->id,
                        'invoice_unique_id' => substr($lead->category->name ?? 'X', 0, 1) .
                            $lead->created_at->format('y') . '-' .
                            rand(100000, 999999) . '-' .
                            ($user->customerLeads->count() ?? 1),
                        'address' => $lead->address,
                        'due_date' => '2021-01-01',
                        'sub_total' => $this->parseMoney($row['Invoice'] ?? 0),
                        'total_tax' => '0.00',
                        'total_amount' => $this->parseMoney($row['Invoice'] ?? 0),
                        'created_by' => '2',
                        'status' => 'pending'
                    ]
                );

                InvoiceAttachment::create(
                    [
                        'invoice_id' => $invoice->id ?? '',
                        'amount' => $this->parseMoney($row['Invoice']) ?? '',
                        'rate' => $this->parseMoney($row['Invoice']) ?? '',
                        'category_id' => '1',
                        'quantity' => '1',
                        'tax' => '0.00' ?? '',
                    ]);

                Credit::create(
                    [
                        'lead_id' => $lead->id,
                        'invoice_id' => $invoice->id ?? null,
                        'amount' => $this->parseMoney($row['Credits'] ?? 0),
                        'date' => '2021-01-01',
                    ]
                );


                Refund::create(
                    [
                        'lead_id' => $lead->id,
                        'invoice_id' => $invoice->id ?? null,
                        'payment_type_id' => '3',
                        'amount' => $this->parseMoney($row['Amount Owed Refund Adjusted'] ?? 0),
                        'date' => '2021-01-01',
                    ]
                );


                ReceivePayment::create(
                    [
                        'lead_id' => $lead->id,
                        'invoice_id' => $invoice->id ?? null,
                        'payment_type' => '3',
                        'amount' => $this->parseMoney($row['Payment Received'] ?? 0),
                        'created_by' => '2',
                        'date' => '2021-01-01',
                    ]
                );

            });


        }//end foreach
        return back()->with('success', 'Lead record imported successfully!');
    }

    protected function parseDateCreatedAt($date)
    {
        if (empty($date) || $date === '########') {
            return null;
        }

        try {
            return Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d'). ' ' . now()->format('H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function parseDate($date)
    {
        if (empty($date) || $date === '########') {
            return null;
        }

        try {
            return Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function parseMoney($value)
    {
        if (empty($value) || $value === '$0.00') {
            return 0;
        }

        // Remove dollar signs and commas
        $value = str_replace(['$', ','], '', $value);

        return (float)$value;
    }

    public function leadAnalysis(){
//        $years = Lead::selectRaw('YEAR(lead_date) as year')
//            ->groupBy('year')
//            ->orderBy('year', 'desc')
//            ->pluck('year');
//
//        $result = [];
//
//        foreach ($years as $year) {
//            $yearData = [
//                'total' => Lead::whereYear('lead_date', $year)->count(),
//                'referrals' => [],
//                'cities' => []
//            ];
//
//            $referrals = Lead::with('customer.referralSource')
//                ->whereYear('lead_date', $year)
//                ->get()
//                ->groupBy(fn($lead) => $lead->customer->referralSource->name ?? 'Unknown Source')
//                ->map->count();
//
//            $cities = Lead::whereYear('lead_date', $year)
//                ->selectRaw('
//                CASE
//                    WHEN city IS NULL OR city = "" THEN "Unknown City"
//                    ELSE city
//                END as city,
//                COUNT(*) as count
//            ')
//                ->groupBy(
//                    DB::raw('CASE
//                    WHEN city IS NULL OR city = "" THEN "Unknown City"
//                    ELSE city
//                END')
//                )
//                ->orderBy('count', 'desc')
//                ->get()
//                ->mapWithKeys(fn($item) => [$item->city => $item->count]);
//
//            $yearData['referrals'] = $referrals;
//            $yearData['cities'] = $cities;
//
//            $result[$year] = $yearData;
//        }
//
//        return $result;
        $years = Lead::selectRaw('YEAR(lead_date) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        $result = [];

        foreach ($years as $year) {
            $goal = YearEstimation::where('year', $year)->first();
            $achieved = Lead::where('lead_status', 'won')->whereYear('lead_status_date', $year)->get();
            $yearData = [
                'goal' => isset($goal->estimate_amount) ? (float)$goal->estimate_amount : 'No Goal Set',
                'achieved' => (
                    $achieved->filter(function($item) {
                        return is_numeric($item->lead_price) && $item->lead_price !== '';  // Only numeric values or non-empty strings
                    })->sum(function($item) {
                        return floatval($item->lead_price); // Sum valid numeric lead prices
                    }) +
                    $achieved->flatMap->getChangeOrder->filter(function($item) {
                        return is_numeric($item->total_amount) && $item->total_amount !== '';  // Only numeric values or non-empty strings
                    })->sum(function($item) {
                        return floatval($item->total_amount); // Sum valid numeric total_amount values
                    })
                ),
                'total_leads' => Lead::whereYear('lead_date', $year)->count(),
                'total_jobs' => Lead::whereYear('lead_status_date', $year)->where('lead_status', 'won')->count(),
                'months' => [],
                'referrals' => [],
                'cities' => []
            ];

            $months = Lead::selectRaw('MONTH(lead_status_date) as month')
                ->whereYear('lead_date', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('month');


            foreach ($months as $month) {
                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                $monthAchieved = Lead::where('lead_status', 'won')->whereYear('lead_status_date', $year)->whereMonth('lead_status_date', $month)->get();
                $monthEstimate = 0;
                $monthEstimatePercentage = 0;
                if ($goal && $goal->months) {
                    $monthData = $goal->months
                        ->where('name', $monthName)
                        ->first();
                    $monthEstimate = $monthData ? (float)$monthData->amount : 0;
                    $monthEstimatePercentage = $monthData ? (float)$monthData->percentage : 0;
                }

                $achievedRevenue = (
                    // Sum of lead_price, ensuring each value is numeric
                    $monthAchieved->sum(function($item) {
                        return is_numeric($item->lead_price) ? (float)$item->lead_price : 0;
                    }) +
                    // Sum of total_amount from ChangeOrders, ensuring each value is numeric
                    $monthAchieved->flatMap->getChangeOrder->sum(function($item) {
                        return is_numeric($item->total_amount) ? (float)$item->total_amount : 0;
                    })
                );
                $achievedPercentage = ($monthEstimate > 0)
                    ? ($achievedRevenue / $monthEstimate) * 100
                    : 0;

                $monthData = [
                    'leads' => Lead::whereYear('lead_date', $year)
                        ->whereMonth('lead_date', $month)
                        ->with([
                            'category:id,name',
                            'getChangeOrder:id,total_amount,lead_id',
                            'representative.staffPosition', // For commission
                            'costOfGoodSolds.cogsSheetsDetails' // For COGS
                        ])
                        ->select([
                            'id',
                            'title',
                            'lead_status',
                            'lead_date',
                            'lead_price',
                            'category_id',
                            'representative_id'
                        ])
                        ->get()
                        ->map(function ($lead) {
                            // Cast all values to float to avoid non-numeric errors
                            $leadPrice = (float)($lead->lead_price ?? 0);
                            $totalChangeOrders = (float)$lead->getChangeOrder->sum('total_amount');
                            $totalCOGS = (float)$lead->costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost');

                            // Safely get commission rate (default 0 if invalid)
                            $commissionRate = 0;
                            if ($lead->representative && $lead->representative->staffPosition) {
                                try {
                                    $compensation = json_decode($lead->representative->staffPosition->compensation_record, true);
                                    $commissionRate = (float)($compensation['commission']['rate'] ?? 0);
                                } catch (\Exception $e) {
                                    \Log::error("Invalid compensation_record for lead {$lead->id}: " . $e->getMessage());
                                }
                            }

                            // Calculate commission amount
                            $commissionAmount = $leadPrice * ($commissionRate / 100);

                            // Calculate Net Profit (Revenue - COGS - Commission)
                            $netProfit = ($leadPrice + $totalChangeOrders) - $totalCOGS - $commissionAmount;

                            // Calculate Total Revenue (Lead Price + Change Orders, min=1 to avoid division by zero)
                            $totalRevenue = max($leadPrice + $totalChangeOrders, 1);

                            // Calculate Net Profit Percentage
                            $netProfitPercentage = ($netProfit / $totalRevenue) * 100;

                            return [
                                'id' => $lead->id,
                                'title' => $lead->title,
                                'lead_status' => $lead->lead_status,
                                'lead_date' => $lead->lead_date,
                                'lead_price' => $leadPrice,
                                'category_name' => $lead->category->name ?? null,
                                'change_orders_total' => $totalChangeOrders,
                                'total_cogs' => $totalCOGS,
                                'commission_rate' => $commissionRate,
                                'commission_amount' => $commissionAmount,
                                'net_profit' => $netProfit,
                                'net_profit_percentage' => $netProfitPercentage, // <-- The percentage you need
                                'change_orders' => $lead->getChangeOrder,
                                'cost_of_good_solds' => $lead->costOfGoodSolds,
                            ];
                        }),
                    'month_lead_count ' => Lead::whereYear('lead_date', $year)
                        ->whereMonth('lead_date', $month)
                        ->count(),
                    'month_job_count ' => Lead::whereYear('lead_status_date', $year)
                        ->whereMonth('lead_status_date', $month)
                        ->where('lead_status','won')
                        ->count(),
                    'estimated_percentage' => (float)$monthEstimatePercentage . '%',
                    'achieved_percentage' => round($achievedPercentage, 2) . '%',
                    'estimate_revenue' => (float)$monthEstimate,
                    'achieved_revenue' => (
                        $monthAchieved->sum(function($item) {
                            // Ensure each lead_price is numeric
                            return is_numeric($item->lead_price) ? (float)$item->lead_price : 0;
                        }) +
                        $monthAchieved->flatMap->getChangeOrder->sum(function($item) {
                            // Ensure each total_amount is numeric
                            return is_numeric($item->total_amount) ? (float)$item->total_amount : 0;
                        })
                    ),
                    'referrals' => [],
                    'cities' => []
                ];

                $monthReferrals = Lead::with('customer.referralSource')
                    ->whereYear('lead_status_date', $year)
                    ->whereMonth('lead_status_date', $month)
                    ->where('lead_status', 'won')
                    ->get()
                    ->groupBy(fn($lead) => $lead->customer->referralSource->name ?? 'Unknown Source')
                    ->map->count();

                $monthCities = Lead::whereYear('lead_status_date', $year)
                    ->whereMonth('lead_status_date', $month)
                    ->where('lead_status', 'won')
                    ->selectRaw('
                CASE
                    WHEN city IS NULL OR city = "" THEN "Unknown City"
                    ELSE city
                END as city,
                COUNT(*) as count
            ')
                    ->groupBy(
                        DB::raw('CASE
                    WHEN city IS NULL OR city = "" THEN "Unknown City"
                    ELSE city
                END')
                    )
                    ->orderBy('count', 'desc')
                    ->get()
                    ->mapWithKeys(fn($item) => [$item->city => $item->count]);

                $monthData['referrals'] = $monthReferrals;
                $monthData['cities'] = $monthCities;

                $yearData['months'][$monthName] = $monthData;
            }

            $referrals = Lead::with('customer.referralSource')
                ->whereYear('lead_status_date', $year)
                ->where('lead_status','won')
                ->get()
                ->groupBy(fn($lead) => $lead->customer->referralSource->name ?? 'Unknown Source')
                ->map->count();

            $cities = Lead::whereYear('lead_status_date', $year)->where('lead_status', 'won')
                ->selectRaw('
            CASE
                WHEN city IS NULL OR city = "" THEN "Unknown City"
                ELSE city
            END as city,
            COUNT(*) as count
        ')
                ->groupBy(
                    DB::raw('CASE
                WHEN city IS NULL OR city = "" THEN "Unknown City"
                ELSE city
            END')
                )
                ->orderBy('count', 'desc')
                ->get()
                ->mapWithKeys(fn($item) => [$item->city => $item->count]);

            $yearData['referrals'] = $referrals;
            $yearData['cities'] = $cities;

            $result[$year] = $yearData;
        }

        return $result;
    }

    public function exportLeadAnalyticsToCsv()
    {
        $analyticsData = $this->leadAnalysis();

        $fileName = 'lead_analytics_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return new StreamedResponse(function() use ($analyticsData) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Year', 'Total Leads', 'Referral Sources', 'Cities']);

            foreach ($analyticsData as $year => $data) {
                fputcsv($handle, [
                    $year,
                    $data['total'],
                    json_encode($data['referrals']),
                    json_encode($data['cities'])
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function marketingSpendOptimization()
    {
        return view('aiTools.marketing-spend-optimization');
    }
    public function expensePredictionLeads()
    {

        return view('aiTools.expense-prediction-leads');
    }
    public function dashboardInsights()
    {

        return view('aiTools.dashboard-insights');
    }
    public function aiYearEstimation()
    {

        return view('aiTools.year_estimation');
    }
    public function aiJobTypeEarningsAnalysis()
    {

        return view('aiTools.job_type_earnings_analysis');
    }
    public function aiYearEstimationGoalAnalysis(Request $request)
    {
        $request->validate([
            'enteryourGoal' => 'required|numeric|min:1',
        ]);
        $goal = $request->input('enteryourGoal');

        $htmlContent = view('aiTools.ajax.ai_goal_analysis', compact('goal'))->render();

        return response()->json([
            'success' => true,
            'html' => $htmlContent,
            'message' => 'Goal analysis generated successfully!'
        ]);
    }


    public function getCalculatorData(Request $request){
        $leadId = $request->lead_id;
        $calculator = $request->type;
        $calculator_type = $request->calculator_type;

        if($calculator_type == 'roof'){
            if($calculator == 'prefered'){
                $data = RoofEstimateCalculator::where('lead_id',$leadId)->with('roofEstimateCalculatorpreferred')->latest()->first();
                return response()->json([
                    'recommended_price' => $data->roofEstimateCalculatorpreferred->recommended_price,
                    'project_cost' => $data->roofEstimateCalculatorpreferred->project_cost,
                    'directory_cost' => $data->roofEstimateCalculatorpreferred->directory_cost,
                    'net_profit' => $data->roofEstimateCalculatorpreferred->net_profit
                ]);
            }
            elseif($calculator == 'system'){
                $data = RoofEstimateCalculator::where('lead_id',$leadId)->with('roofEstimateCalculatorSystem')->latest()->first();
                return response()->json([
                    'recommended_price' => $data->roofEstimateCalculatorSystem->recommended_price,
                    'project_cost' => $data->roofEstimateCalculatorSystem->project_cost,
                    'directory_cost' => $data->roofEstimateCalculatorSystem->directory_cost,
                    'net_profit' => $data->roofEstimateCalculatorSystem->net_profit
                ]);
            }
            elseif($calculator == 'under_15'){
                $data = RoofEstimateCalculator::where('lead_id',$leadId)->with('roofEstimateCalculatorUnderFifteen')->latest()->first();
                return response()->json([
                    'recommended_price' => $data->roofEstimateCalculatorUnderFifteen->recommended_price,
                    'project_cost' => $data->roofEstimateCalculatorUnderFifteen->project_cost,
                    'directory_cost' => $data->roofEstimateCalculatorUnderFifteen->directory_cost,
                    'net_profit' => $data->roofEstimateCalculatorUnderFifteen->net_profit
                ]);
            }
            elseif($calculator == 'flat_roof'){
                $data = RoofEstimateCalculator::where('lead_id',$leadId)->with('roofEstimateCalculatorFlatRoof')->latest()->first();
                return response()->json([
                    'recommended_price' => $data->roofEstimateCalculatorFlatRoof->recommended_price,
                    'project_cost' => $data->roofEstimateCalculatorFlatRoof->project_cost,
                    'directory_cost' => $data->roofEstimateCalculatorFlatRoof->directory_cost,
                    'net_profit' => $data->roofEstimateCalculatorFlatRoof->net_profit
                ]);
            }
        }


    }

    public function chatBot($roomId){
        $sessionId = $roomId;
        $messages = ChatBotMessage::where('chat_bot_room_id', $roomId)
            ->orderBy('id', 'asc')
            ->get();
        $rooms = ChatBotRoom::get();
        return view('aiTools.chatbot', compact('sessionId', 'messages', 'rooms'));
    }

    public function storeUserMessage(Request $request){
        ChatBotMessage::create([
            'chat_bot_room_id' => $request->chat_bot_room_id,
            'sender' => $request->sender,
            'message'=> $request->message
        ]);
    }

    public function storeAiMessage(Request $request){
        ChatBotMessage::create([
            'chat_bot_room_id' => $request->chat_bot_room_id,
            'sender' => $request->sender,
            'message'=> $request->message
        ]);
    }

    public function updateUserStatus(Request $request, $id)
    {
        $item = User::find($id);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        $item->status = $request->status;
        $item->save();

        return response()->json(['success' => true]);
    }

    public function sendInvoices(Request $request)
    {
        try {
            $record = Lead::findOrFail($request->id);
            Mail::send('admin.invoices', ['record' => $record], function ($message) use ($record) {
                $message->to($record->customer->email)->subject('Invoices');
            });
            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendInvoiceSingle(Request $request)
    {
        try {
            $invoice = Invoice::findOrFail($request->id);
            $emailSubject = $request->subject ?? 'Invoice';
            $emailMessage = $request->message;
            Mail::send('admin.invoice_single', ['invoice' => $invoice, 'customMessage' => $emailMessage], function ($message) use ($invoice, $emailSubject) {
                $message->to($invoice->getLead->customer->email)->subject($emailSubject);
            });
            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function sendCumulativeInvoice(Request $request)
    {
        try {
            $lead = Lead::findOrFail($request->id);
            Mail::send('admin.invoices_cumulative', ['lead' => $lead], function ($message) use ($lead) {
                $message->to($lead->customer->email)->subject('Cumulative Invoices');
            });
            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function sendBalanceSheet(Request $request)
    {
        try {
            $leads = Lead::findOrFail($request->id);
            Mail::send('admin.invoices_balance_sheet', ['leads' => $leads], function ($message) use ($leads) {
                $message->to($leads->customer->email)->subject('Balance Sheet');
            });
            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendCogsDetail(Request $request)
    {
            extract($request->all());
        try {
            $costOfGoodSold = CostOfGoodSold::with('cogsSheetsDetails')->where('lead_id', $id)->get();
            $leads = Lead::with('getChangeOrder')->where('id', $id)->first();
            $changeOrderAmount = $leads->getChangeOrder->where('status', 'approved')->sum('total_amount');
            Mail::send('admin.invoices_cogs_detail', ['leads' => $leads, 'costOfGoodSold' => $costOfGoodSold, 'changeOrderAmount' => $changeOrderAmount], function ($message) use ($leads) {
                $message->to($leads->customer->email)->subject('Cost Of Goods Sold');
            });
            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function supportChat(){
        $users = User::whereHas('chatMessages', function($query) {
            $query->where('sender_type', 'customer');
        })
            ->get()
            ->each(function($user) {
                // Replace chatMessages with filtered conversation
                $user->setRelation('chat_messages',
                    ChatMessage::where(function($query) use ($user) {
                        // Customer's messages
                        $query->where('sender_id', $user->id)
                            ->where('sender_type', 'customer');
                    })
                        ->orWhere(function($query) use ($user) {
                            // Admin replies to this customer
                            $query->where('reply_to', $user->id)
                                ->where('sender_type', 'admin');
                        })
                        ->orderBy('created_at', 'asc')
                        ->get()
                );
            });
        return view('admin.support_chat', compact('users'));
    }
    public function leadChat(){
        $leads = Lead::has('chatMessages')
            ->with(['chatMessages' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->get();
        return view('admin.lead_chat', compact('leads'));
    }
    public function referrals(){
        $referrals = CustomerReferral::get();
        return view('admin.referrals', compact('referrals'));
    }

    public function viewAllInvoiceDetail(Request $request){
        $lead = Lead::findOrFail($request->id);
        return (string) view('admin.all_invoices', compact('lead'));
    }

}//enc class.
