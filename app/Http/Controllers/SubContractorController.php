<?php

namespace App\Http\Controllers;
use App\EmailTemplate;
use App\Lead;
use App\Profile;
use App\ProposalTemplate;
use App\SchedulingTask;
use App\SubContractorReceiveable;
use App\User;
use App\SubContractorInvoice;
use App\PaymentType;
use App\YearEstimation;
use App\Trade;
use Illuminate\Http\Request;

class SubContractorController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.subContractorDashboard.index');
    }
    public function insuranceInfo()
    {
        $userId = auth()->user()->id;
        $subcontractor = User::where('id', $userId)->whereHas('roles', function($q) {
            $q->where('name', 'subcontractor');
        })->first();
        return view('dashboard.subContractorDashboard.insurance_info', compact('subcontractor'));
    }

    public function workOrders($status)
    {
        $userId = auth()->user()->id;
        $subcontractor = User::where('id', $userId)->whereHas('roles', function($q) {$q->where('name', 'subcontractor');})->first();
        if ($status === 'signed') {
            $filterStatus = 'signed';
        } elseif ($status === 'upcoming') {
            $filterStatus = 'required';
        } else {
            $filterStatus = null;
        }
        return view('dashboard.subContractorDashboard.work_orders', compact('subcontractor', 'status', 'filterStatus'));
    }
    public function job($status)
    {
        $jobStatus = $status;
        $userId = auth()->user()->id;
        $subcontractor = User::where('id', $userId)
            ->whereHas('roles', fn($q) => $q->where('name', 'subcontractor'))
            ->firstOrFail();

        $statusMap = [
            'complete' => 'complete',
            'active' => 'active',
        ];

        if (!array_key_exists($status, $statusMap)) {
            abort(404, 'Invalid status parameter');
        }

        $dbStatus = $statusMap[$status];

        $jobs = $subcontractor->subContractorJobs()
            ->where('job_status', $dbStatus)
            ->latest()
            ->get();



        return view('dashboard.subContractorDashboard.jobs', compact('jobs', 'jobStatus'));
    }

    public function workOrdersUpcoming()
    {
        return view('dashboard.subContractorDashboard.work_orders_upcoming');
    }
    public function workOrdersSigned()
    {
        return view('dashboard.subContractorDashboard.work_orders_signed');
    }
    public function jobs()
    {
        return view('dashboard.subContractorDashboard.jobs');
    }
    public function jobsDetails($id)
    {
        $userId = auth()->user()->id;
        $subcontractor = User::where('id', $userId)->whereHas('roles', fn($q) => $q->where('name', 'subcontractor'))->firstOrFail();
        $jobLead = SchedulingTask::where('subcontractor_id', $userId)->where('id', $id)->first();
        if (!$jobLead) {
            abort(404, 'Not Found');
        }
        $jobLeads = SchedulingTask::where('subcontractor_id', $userId)->get();
        $jobsQuery = $subcontractor->subContractorJobs()->latest();
        $jobDetails = $jobsQuery->where('id', $id)->first();
        $invoices = SubContractorInvoice::where('subcontractor_id', $userId)->where('job_id', $id)->get();
        $receivable = SubContractorInvoice::where('subcontractor_id', $userId)->where('job_id', $id)->with('getReceivable.getInvoice')->get();
        $paymenttypes = PaymentType::whereStatus('1')->orderBy('id', 'desc')->get();
        $yearEstimation = YearEstimation::where('status', 1)->orderBy('id', 'desc')->first();
        $approvedInvoices = SubContractorInvoice::where('subcontractor_id', $userId)->where('status', 'Approved')->get();
        $schedulingtask = SchedulingTask::with('getSchedulingUser')->where('subcontractor_id', $userId)->where('id', $id)->get();
        return view('dashboard.subContractorDashboard.jobs_details', compact('jobDetails', 'subcontractor', 'jobLeads', 'invoices', 'approvedInvoices', 'paymenttypes', 'yearEstimation', 'schedulingtask', 'receivable'));
    }

    public function finance()
    {
        $id = auth()->user()->id;
        $subcontractor = User::where('id', $id)->whereHas('roles', function($q) {
            $q->where('name', 'subcontractor');
        })->first();
        $jobLeads = SchedulingTask::where('subcontractor_id', $id)->get();
        $invoices = SubContractorInvoice::where('subcontractor_id', $id)->get();
        $receivable = SubContractorInvoice::where('subcontractor_id', $id)->get();
        $paymenttypes = PaymentType::whereStatus('1')->orderBy('id', 'desc')->get();
        $yearEstimation = YearEstimation::where('status', 1)->orderBy('id', 'desc')->first();

        if($subcontractor) {
            return view('dashboard.subContractorDashboard.finance', compact('subcontractor', 'jobLeads', 'invoices','paymenttypes','yearEstimation','receivable'));
        }
        else{
            abort(404);
        }
    }

    public function markJobComplete(Request $request){
        SchedulingTask::where('id', $request->id)->update(['job_status' => 'complete']);
        return redirect()->back()->with('flash_message', 'Job Status Updated');
    }
    public function profile() {
        $allTrades = Trade::get();
        $subcontractor = User::where('id', auth()->id())
            ->whereHas('roles', function($q) {
                $q->where('name', 'subcontractor');
            })->first();

        if (!$subcontractor) {
            abort(403, 'Unauthorized access.');
        }

        return view('dashboard.subContractorDashboard.profile', compact('subcontractor','allTrades'));
    }

    public function updateProfile(Request $request){
        User::where('id', auth()->user()->id)->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);
        if($request->password){
            User::where('id', auth()->user()->id)->update([
                'password' => bcrypt($request->password)
            ]);
        }
        Profile::where('user_id', auth()->user()->id)->update([
            'title' => $request->title,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('flash_message', 'Information Updated');
    }

}
