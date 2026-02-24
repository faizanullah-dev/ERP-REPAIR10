<?php

namespace App\Http\Controllers\Appointment;

use App\AppointmentAttachment;
use App\AppointmentAttendee;
use App\Category;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Appointment;
use App\LeadMail;
use App\Message;
use App\Notification;
use App\Team;
use App\User;
use App\Lead;
use App\YearEstimation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client as TwilioClient;

class AppointmentController extends Controller
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
        $model = str_slug('appointment', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            $perPage = 2500;
            $appointmentQuery = Appointment::query();
            if(!empty($keyword)){
                $appointmentQuery->where(function ($query) use ($keyword) {
                    $query->where('customer_id', 'LIKE', "%$keyword%")
                        ->orWhere('title', 'LIKE', "%$keyword%")
                        ->orWhere('appointment_for_lead_id', 'LIKE', "%$keyword%")
                        ->orWhere('attendees_user_id', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%")
                        ->orWhere('location', 'LIKE', "%$keyword%")
                        ->orWhere('additional_recipients', 'LIKE', "%$keyword%")
                        ->orWhere('attachment', 'LIKE', "%$keyword%")
                        ->orWhere('date_time_to', 'LIKE', "%$keyword%")
                        ->orWhere('date_time_from', 'LIKE', "%$keyword%")
                        ->orWhere('status', 'LIKE', "%$keyword%");
                });
            }else {
                $yearEstimation = YearEstimation::where('status', 1)->first();
                if (!auth()->user()->hasRole('user')) {
                    $appointmentQuery->orderBy('id', 'DESC')->whereHas('getLead', function ($query) {
                        $query->where('representative_id', auth()->user()->id)
                            ->orWhere('customer_id', auth()->user()->id);
                    });
                }else{
                    if (in_array($request->appointment_type, ['pending', 'won', 'lost'])) {
                        $appointmentQuery->whereYear('date_time_from', $yearEstimation->year)->with('lead')->orderBy('id', 'DESC')->whereHas('lead', function ($query) use ($request) {
                            $query->where('lead_status', $request->appointment_type);
                        });
                    }
                }
            }
            $appointment = $appointmentQuery->whereYear('date_time_from', $yearEstimation->year)->paginate($perPage);
            return view('appointment.appointment.index', compact('appointment', 'yearEstimation'));
        }
        return response(view('403'), 403);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request){
        extract($request->all());
        $yearEstimation = YearEstimation::where('status',1)->first();
        $model = str_slug('appointment','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $customers = User::whereHas('roles', function($q){$q->where('name','customer');})->get();
            $appointmentUsers = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
            $leads = Lead::get();
            $teams = Team::get();
            $holidays = Holiday::with('getHoliday')->where('user_id',auth()->id())->where('status',1)->get();
            if(!empty($lead_id)){
                $leadExist=Lead::findOrfail($lead_id);
                return view('appointment.appointment.create',compact('yearEstimation','appointmentUsers','holidays', 'leads', 'customers','leadExist', 'teams'));
            }
            return view('appointment.appointment.create',compact('yearEstimation','customers','holidays','appointmentUsers','leads', 'teams'));
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
        // return $request->all();
        $model = str_slug('appointment', '-');
        if(auth()->user()->permissions()->where('name', '=', 'add-'.$model)->first() != null) {
            extract($request->all());

            $date_time_from = Carbon::createFromFormat('m-d-y h:i A', $date_time_from)->format('Y-m-d H:i:s');
            $date_time_to = Carbon::createFromFormat('m-d-y h:i A', $date_time_to)->format('Y-m-d H:i:s');

            // Create the appointment record
            $appointment = Appointment::create([
                'customer_id'               => $customer_id ?? "",
                'title'                     => $title ?? "",
                'appointment_for_lead_id'   => $appointment_for_lead_id ?? "",
                'description'               => $description ?? "",
                'location'                  => $location ?? "",
                'team_id'                   => $assign_to_team_id ?? "",
//                'additional_recipients'     => $additional_recipients??"",
                'date_time_to'              => $date_time_to ?? "",
                'date_time_from'            => $date_time_from ?? "",
                'status'                    => $status ?? "",
                'created_by'                => auth()->id(),
            ]);
            if (isset($attendees_user_id)) {
                foreach ($attendees_user_id as $key => $value) {
                    AppointmentAttendee::create([
                        'appointment_id' => $appointment->id,
                        'attendees_id'   => $value,
                    ]);
                }//endforeach
            }//end if.
            if ($request->appointment_attachment != '') {
                foreach (explode(',', $request->appointment_attachment) as $key => $value) {
                    AppointmentAttachment::create([
                        'appointment_id' => $appointment->id,
                        'name'           => $value
                    ]);
                }//end foreach.
                }
            if (isset($appointment) && !empty($appointment)) {
                Notification::create([
                    'lead_id' => $appointment->appointment_for_lead_id,
                    'model'   => 'Appointment Created',
                    'title'   => 'Appointment <b>' . @$appointment->title . '</b> has been created for the lead <b>' . @$appointment->getLead->title . '</b> by',
                    'icon'    => 'fa-solid fa-check-circle',
                    'time'    => now(),
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Appointment added!');
            } elseif ($appointment->getLead->lead_status == 'pending') {
                return redirect('appointment/appointment?appointment_type=pending')->with('flash_message', 'Appointment added!');
            } elseif ($appointment->getLead->lead_status == 'won') {
                return redirect('appointment/appointment?appointment_type=won')->with('flash_message', 'Appointment added!');
            } elseif ($appointment->getLead->lead_status == 'lost') {
                return redirect('appointment/appointment?appointment_type=lost')->with('flash_message', 'Appointment added!');
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
        $model = str_slug('appointment','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $appointment = Appointment::findOrFail($id);
            return view('appointment.appointment.show', compact('appointment'));
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
        $model = str_slug('appointment','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $appointment = Appointment::with('getAppointmentAttendee')->findOrFail($id);
            $customers = User::whereHas('roles', function($q){$q->where('name','customer');})->get();
            $leads = Lead::get();
            $teams = Team::get();
            $appointmentUsers = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
            $holidays = Holiday::with('getHoliday')->where('user_id',auth()->id())->where('status',1)->get();
            return view('appointment.appointment.edit', compact('appointment','customers','appointmentUsers','leads','holidays', 'teams'));
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
        $model = str_slug('appointment', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {

            $requestData = $request->all();
            $appointment = Appointment::findOrFail($id);
            extract($requestData);

            $date_time_from = isset($date_time_from) ? Carbon::createFromFormat('m-d-Y h:i A', $date_time_from)->format('Y-m-d H:i:s') : null;
            $date_time_to = isset($date_time_to) ? Carbon::createFromFormat('m-d-Y h:i A', $date_time_to)->format('Y-m-d H:i:s') : null;

            Appointment::where('id', $appointment->id)->update([
                'customer_id'               => $customer_id ?? "",
                'title'                     => $title ?? "",
                'appointment_for_lead_id'   => $appointment_for_lead_id ?? "",
                'description'               => $description ?? "",
                'location'                  => $location ?? "",
                'team_id'                   => $assign_to_team_id ?? "",
//                'additional_recipients'     => $additional_recipients??"",
                'date_time_to'              => $date_time_to ?? "",
                'date_time_from'            => $date_time_from ?? "",
                'status'                    => $status ?? "",
            ]);

            if (isset($appointment) && !empty($appointment)) {
                Notification::create([
                    'lead_id' => $appointment->appointment_for_lead_id,
                    'model'   => 'Appointment Update',
                    'title'   => 'Appointment <b>' . $appointment->title . '</b> has been updated for the lead <b>' . $appointment->getLead->title . '</b> by',
                    'icon'    => 'fa-solid fa-check-circle',
                    'time'    => now(),
                    'user_id' => auth()->user()->id,
                ]);
            }//ends if.

            if (isset($attendees_user_id)) {
                foreach ($attendees_user_id as $key => $value) {
                    AppointmentAttendee::where('appointment_id', $id)
                        ->where('attendees_id', $value)
                        ->updateOrCreate([
                            'appointment_id' => $appointment->id,
                            'attendees_id'   => $value,
                        ]);
                }//endforeach
                AppointmentAttendee::where('appointment_id',$id)->whereNotIn('attendees_id',$attendees_user_id)->delete();
            }//end if.

            if ($request->appointment_attachment != '') {
                foreach (explode(',', $request->appointment_attachment) as $key => $value) {
                    AppointmentAttachment::where('appointment_id', $id)
                        ->where('name', $value)
                        ->updateOrCreate([
                            'appointment_id' => $appointment->id,
                            'name'           => $value
                        ]);
                }//end foreach.
                }
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Appointment updated!');
            } else {
                return redirect('appointment/appointment')->with('flash_message', 'Appointment updated!');
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
        $model = str_slug('appointment','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Appointment::destroy($id);

            return redirect('appointment/appointment')->with('flash_message', 'Appointment deleted!');
        }
        return response(view('403'), 403);

    }

    public function calendarAppointmentView(Request $request)
    {
        $yearEstimation = YearEstimation::where('status',1)->first();
        $customers = User::whereHas('roles', function($q){$q->where('name','customer');})->get();
        $categories = Category::where('status', 1)->get();
        $appointmentUsers = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user');})->get();
        $holidays = Holiday::with('getHoliday')->where('user_id',auth()->id())->where('status',1)->get();
        $leads = Lead::get();
        if (!auth()->user()->hasRole('user')) {
            $appointment = Appointment::with('lead')
                ->orderBy('id', 'DESC')
                ->whereHas('getLead', function ($query) {
                    $query->where('representative_id', auth()->user()->id)
                        ->orWhere('customer_id', auth()->user()->id);
                })
                ->get();
        } else {
            $appointment = Appointment::with('lead')->orderBy('id', 'DESC');
            if ($request->appointment_calender_type == 'pending') {
                $appointment->whereHas('lead', function ($query) {
                    $query->where('lead_status', 'pending');
                });
            } elseif ($request->appointment_calender_type == 'won') {
                $appointment->whereHas('lead', function ($query) {
                    $query->where('lead_status', 'won');
                });
            } elseif ($request->appointment_calender_type == 'lost') {
                $appointment->whereHas('lead', function ($query) {
                    $query->where('lead_status', 'lost');
                });
            }
            if($request->appointment_filter == 'yes') {
                $appointment->when($request->filled('user_id'), function ($query) use ($request) {
                    $query->whereIn('customer_id', $request->user_id);
                })->when($request->filled('category_id'), function ($query) use ($request) {
                    $query->whereHas('lead', function ($query) use ($request) {
                        $query->where('category_id', $request->category_id);
                    });
                });
            }
            $appointment = $appointment->get();
        }
        return view('appointment.appointment.calendar.calendar', compact('yearEstimation','appointment', 'customers', 'categories', 'appointmentUsers', 'leads', 'holidays'));
    }//ends function calendarAppointmentView.

    public function reportTable(Request $request){
        $years = YearEstimation::orderBy('id', 'Desc')->get();
        $leadStatuses = ['won', 'lost', 'pending'];
        $weekData = [];
        $leadsCount = 0;
        $wonLeadsCount = 0;
        $lostLeadsCount = 0;
        $pendingLeadsCount = 0;
        $appointmentMonthlyCount = [];
        $leadMonthlyCount = [];
        $year = $request->input('year') ?? $years->where('status', 1)->first()->year;
        $totalWeeks = Carbon::create($year, 12, 31)->weeksInYear();
        $now = $year ? Carbon::create($year) : Carbon::now();
        for ($week = 1; $week <= $totalWeeks; $week++) {
            if ($week === 1) {
                $startDate = Carbon::createFromDate($year, 1, 1)->startOfWeek();
            } else {
                $startDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
            }
            $endDate = Carbon::now()->setISODate($year, $week)->endOfWeek();
            if ($week === $totalWeeks && $endDate->lt(Carbon::create($year, 12, 31))) {
                $endDate = Carbon::create($year, 12, 31)->endOfDay();
            }
            if ($endDate->year != $now->year) {
                $endDate = $now->endOfYear();
            } elseif ($startDate->year != $now->year){
                $startDate = $now->startOfYear();
            }
            $leadCounts = [];
            foreach ($leadStatuses as $status) {
                if(!auth()->user()->hasRole('user')){
                    $count = Lead::whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status) ->where(function ($query) {
                        $query->where('customer_id', auth()->user()->id)
                            ->orWhere('representative_id', auth()->user()->id);
                    })
                        ->count();
                }else{
                    $count = Lead::whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status)->count();
                }
//                $count = Lead::whereBetween('lead_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status)->count();
                $leadCounts[$status] = $count;
                switch ($status) {
                    case 'won':
                        $wonLeadsCount += $count;
                        break;
                    case 'lost':
                        $lostLeadsCount += $count;
                        break;
                    case 'pending':
                        $pendingLeadsCount += $count;
                        break;
                }
            }
            $leadsCount += array_sum($leadCounts);
            if (!auth()->user()->hasRole('user')){
                $appointment = Appointment::whereHas('getLead', function ($query) {
                    $query->where('representative_id', auth()->user()->id)
                        ->orWhere('customer_id', auth()->user()->id);
                })->get();
                $appointmentCount = $appointment->filter(fn($appointment) => substr($appointment->created_at, 0, 4) == $year)->count();
                $appointmentInactiveCount = $appointment->filter(fn($appointment) => $appointment->created_at->format('Y') == $year)->where('status', 0)->count();
                $appointmentsWeeklyCount = $appointment->whereBetween('created_at', [$startDate->format('Y-m-d'), $endDate])->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $appointmentsWeeklyCount2 = $appointment->whereBetween('created_at', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->count();
                $inactiveAppointmentsWeeklyCount = $appointment->whereBetween('created_at', [$startDate->format('Y-m-d'), $endDate])->where('status', '0')->count();
                $count2 = Lead::whereBetween('lead_date', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->where('lead_status', 'won')->count();
            }else{
                $appointment = Appointment::get();
                $appointmentCount = $appointment->filter(fn($appointment) => substr($appointment->date_time_from, 0, 4) == $year)->count();
//                $appointmentInactiveCount = $appointment->filter(fn($appointment) => $appointment->date_time_from->format('Y') == $year)->where('status', 0)->count();
                $appointmentInactiveCount = $appointment->filter(function ($appointment) use ($year) {
                    return \Carbon\Carbon::parse($appointment->date_time_from)->format('Y') == $year
                        && $appointment->status == 0;
                })->count();
                $appointmentsWeeklyCount = $appointment->whereBetween('date_time_from', [$startDate->format('Y-m-d'), $endDate])->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $appointmentsWeeklyCount2 = $appointment->whereBetween('date_time_from', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->count();
                $inactiveAppointmentsWeeklyCount = $appointment->whereBetween('date_time_from', [$startDate->format('Y-m-d'), $endDate])->where('status', '0')->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $count2 = Lead::whereBetween('lead_date', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->where('lead_status', 'won')->count();
            }
            $monthKey = $startDate->month;
            if (!isset($appointmentMonthlyCount[$monthKey])) {
                $appointmentMonthlyCount[$monthKey] = 0;
                $appointmentMonthlyCount_two = 0;
            }
            $appointmentMonthlyCount[$monthKey] = $appointmentsWeeklyCount2;
            if (!isset($leadMonthlyCount[$monthKey])) {
                $leadMonthlyCount[$monthKey] = 0;
                $leadMonthlyCount_two = 0;
            }
            $leadMonthlyCount[$monthKey] = $count2;
            $start_Date = Carbon::parse($startDate->format('Y-m-d'));
            $end_Date = Carbon::parse($endDate->format('Y-m-d'));
            $endOfMonthStartDate = $startDate->copy()->endOfMonth();
            $endOfMonthEndDate = $endDate->copy()->endOfMonth();
            $hello = '';
            if ($endOfMonthStartDate->startOfDay()->equalTo($start_Date->startOfDay()) || $endOfMonthStartDate->between($start_Date, $end_Date) || $endOfMonthEndDate->between($start_Date, $end_Date) || $endOfMonthEndDate->startOfDay()->equalTo($end_Date->startOfDay())) {
                $appointmentMonthlyCount_two = end($appointmentMonthlyCount);
            }
            if ($endOfMonthStartDate->startOfDay()->equalTo($start_Date->startOfDay()) || $endOfMonthStartDate->between($start_Date, $end_Date) || $endOfMonthEndDate->between($start_Date, $end_Date) || $endOfMonthEndDate->startOfDay()->equalTo($end_Date->startOfDay())) {
                $leadMonthlyCount_two = end($leadMonthlyCount);
            }
            $weekData[] = [
                'endOfMonthStartDate'=>$endOfMonthStartDate,
                'week' => $week,
                'dateRange' => $startDate->format('M d') . ' - ' . $endDate->format('M d'),
                'leadCounts' => $leadCounts,
                'appointmentsWeeklyCount' => $appointmentsWeeklyCount,
                'inactiveAppointmentsWeeklyCount' => $inactiveAppointmentsWeeklyCount,
                'appointmentsMonthlyCount' => ($appointmentMonthlyCount_two),
                'leadMonthlyCount' => ($leadMonthlyCount_two),
            ];
        }
        // return $weekData;
        return view('appointment.appointment.calendar.report_table', compact(
            'weekData',
            'leadsCount',
            'wonLeadsCount',
            'lostLeadsCount',
            'pendingLeadsCount',
            'appointmentCount',
            'inactiveAppointmentsWeeklyCount',
            'appointmentsWeeklyCount',
            'appointmentInactiveCount',
            'years',
            'year'
        ));
    }
    public function salesWeekly(Request $request)
    {
        $years = YearEstimation::orderBY('id', 'Desc')->get();
        $weeklyData = [];
        $monthlyTotalLeadPrice = [];
        $monthlyTotalLeadWonPrice = [];
        $leadSubstractLeadWon = [];
//        $year = $request->input('year') ?? Carbon::now()->year;
        $year = $request->input('year') ?? $years->where('status', 1)->first()->year;
        $now = $year ? Carbon::create($year) : Carbon::now();
        $totalWeeks = Carbon::create($year, 12, 31)->weeksInYear();
        for ($month = 1; $month <= 12; $month++) {
            $monthlyTotalLeadPrice[$month] = 0;
            $monthlyTotalLeadWonPrice[$month] = 0;
            $leadSubstractLeadWon[$month] = 0;
        }
        for ($week = 1; $week <= $totalWeeks; $week++) {
            if ($week === 1) {
                $startDate = Carbon::createFromDate($year, 1, 1)->startOfWeek();
            } else {
                $startDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
            }

            $endDate = Carbon::now()->setISODate($year, $week)->endOfWeek();

            if ($week === $totalWeeks && $endDate->lt(Carbon::create($year, 12, 31))) {
                $endDate = Carbon::create($year, 12, 31)->endOfDay();
            }

            if ($endDate->year != $now->year) {

                $endDate = $now->endOfYear();
            } elseif ($startDate->year != $now->year) {

                $startDate = $now->startOfYear();
            }
            if(!auth()->user()->hasRole('user')) {
                $leads = Lead::where('representative_id', auth()->user()->id)->orWhere('customer_id', auth()->user()->id)->get();
            }else{
                $leads = Lead::get();
            }

            $yearLeadCount = $leads->filter(function ($lead) use ($year) {
                return substr($lead->lead_status_date, 0, 4) == $year;
            })->count();
            $yearlyleadprice  = $leads->filter(function($lead) use ($year) {
                return substr($lead->lead_status_date, 0, 4) == $year && isset($lead->lead_price);
            })->sum('lead_price');
            $formattedyearlyleadprice = number_format($yearlyleadprice, 2, '.', ',');
            $leadCount = $leads->whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->count();
            $totalLeadPrice = $leads->whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->whereNotNull('lead_price')
                ->sum('lead_price');
            $endOfMonthStartDate = $startDate->copy()->startOfMonth();
            $endOfMonthEndDate = $startDate->copy()->endOfMonth();
            $totalLeadPrice2 = $leads->whereBetween('lead_status_date', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])
                ->whereNotNull('lead_price')
                ->sum('lead_price');

            $formattedTotalLeadPrice = number_format($totalLeadPrice, 2, '.', ',');
            $WonLeadCount = $leads->filter(function($lead) use ($year) {
                return substr($lead->lead_status_date, 0, 4) == $year && $lead->lead_status == 'won';
            })->count();
            $changeOrderTotalAmount = $leads->filter(function ($lead) use ($year) {
                return substr($lead->lead_status_date, 0, 4) == $year && $lead->lead_status == 'won';
            })->sum(function ($lead) {
                return $lead->getChangeOrder->where('status', 'approved')->sum('total_amount');
            });
            $WonLeadPriceSum = $leads->filter(function($lead) use ($year) {
                return substr($lead->lead_status_date, 0, 4) == $year && $lead->lead_status == 'won';
            })->sum('lead_price');
            $formattedWonLeadPriceSum = number_format($WonLeadPriceSum + $changeOrderTotalAmount, 2, '.', ',');
            $totalWonLeadPriceCount = $leads->whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->whereNotNull('lead_price')
                ->where('lead_status', 'won')
                ->count();
            $changeOrderTotalPrice = $leads
                ->whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]) // Match the date range
                ->where('lead_status', 'won') // Match the status
                ->sum(function ($lead) {
                    // Sum up approved ChangeOrders for each lead
                    return $lead->getChangeOrder
                        ->where('status', 'approved')
                        ->sum('total_amount');
                });
            $totalWonLeadPrice = $leads->whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->whereNotNull('lead_price')
                ->where('lead_status', 'won')
                ->sum('lead_price');
            $endOfMonthStartDate2 = $startDate->copy()->startOfMonth();
            $endOfMonthEndDate2 = $startDate->copy()->endOfMonth();
            $totalWonLeadPrice2 = $leads->whereBetween('lead_status_date', [$endOfMonthStartDate2->format('Y-m-d'), $endOfMonthEndDate2->format('Y-m-d')])
                ->whereNotNull('lead_price')
                ->where('lead_status', 'won')
                ->sum('lead_price');
            $changeOrderTotalPrice2 = $leads
                ->whereBetween('lead_status_date', [$endOfMonthStartDate2->format('Y-m-d'), $endOfMonthEndDate2->format('Y-m-d')]) // Match the date range
                ->where('lead_status', 'won') // Match the status
                ->sum(function ($lead) {
                    // Sum up approved ChangeOrders for each lead
                    return $lead->getChangeOrder
                        ->where('status', 'approved')
                        ->sum('total_amount');
                });
            $formattedTotalWonLeadPrice = number_format($totalWonLeadPrice + $changeOrderTotalPrice, 2, '.', ',');
            $monthlyIndex = $startDate->month;
            $monthlyTotalLeadPrice[$monthlyIndex] = $totalLeadPrice2;
            $monthlyTotalLeadWonPrice[$monthlyIndex] = $totalWonLeadPrice2 + $changeOrderTotalPrice2;
            $leadSubstractLeadWon[$monthlyIndex] += $totalLeadPrice - $totalWonLeadPrice;
            $weeklyData[] = [
                'week' => $week,
                'startDate' => $startDate->format('M d'),
                'endDate' => $endDate->format('M d'),
                'leadCount' => $leadCount,
                'formattedTotalLeadPrice' => $formattedTotalLeadPrice,
                'totalWonLeadPriceCount' => $totalWonLeadPriceCount,
                'formattedTotalWonLeadPrice' => $formattedTotalWonLeadPrice,
                'totalLeadPrice' => $totalLeadPrice,
                'totalWonLeadPrice' => $totalWonLeadPrice,
            ];
        }
        $totalMonthlyLeadPrice = array_sum($monthlyTotalLeadPrice);
        $totalMonthlyLeadWonPrice = array_sum($monthlyTotalLeadWonPrice);
        $totalMonthlyLeadPriceDifference = $totalMonthlyLeadPrice - $totalMonthlyLeadWonPrice;
        $totalMonthlyLeadPriceDifferenceFormatted = number_format($totalMonthlyLeadPriceDifference, 2, '.', ',');
        $monthlyTotalLeadPriceFormatted = array_map(function ($price) {
            return number_format($price, 2, '.', ',');
        }, $monthlyTotalLeadPrice);
        $monthlyTotalLeadWonPriceFormatted = array_map(function ($price) {
            return number_format($price, 2, '.', ',');
        }, $monthlyTotalLeadWonPrice);
        $leadSubstractLeadWonFormatted = array_map(function ($price) {
            return number_format($price, 2, '.', ',');
        }, $leadSubstractLeadWon);
        $totalMonthlyLeadPriceFormatted = number_format($totalMonthlyLeadPrice, 2, '.', ',');
//        return $weeklyData;
        return view('appointment.appointment.calendar.sales_weekly', compact('year', 'years', 'weeklyData','yearLeadCount','formattedyearlyleadprice','WonLeadCount','formattedWonLeadPriceSum','monthlyTotalLeadPriceFormatted','monthlyTotalLeadWonPriceFormatted','totalMonthlyLeadPriceFormatted','totalMonthlyLeadPriceDifferenceFormatted','leadSubstractLeadWonFormatted'));
    }
    public function getCalendarCsv(Request $request){
        $years = YearEstimation::orderBy('id', 'Desc')->get();
        $yearEstimation = YearEstimation::with('months')->where('status', 1)->first();
        if(!auth()->user()->hasRole('user')) {
            $appointments = Appointment::whereHas('getLead', function ($query) {
                $query->where('representative_id', auth()->user()->id)
                    ->orWhere('customer_id', auth()->user()->id);
            })->get();
//            $year = $request->input('year') ?? $years->where('status', 1)->first()->year;
            $year = $request->input('year') ?? $years->where('status', 1)->first()->year;
            $appointmentCounts = $appointments->filter(fn($a) => $a->created_at->year == $year)->groupBy(fn($a) => $a->created_at->format('Y-m-d'))->map->count();
        }else{
            $appointments = Appointment::get();
            $year = $request->input('year') ?? $years->where('status', 1)->first()->year;
//           $appointmentCounts = $appointments->filter(fn($a) => $a->created_at->year == $year)->groupBy(fn($a) => $a->created_at->format('Y-m-d'))->map->count();
            $appointmentCounts = $appointments
                ->filter(fn($a) => $a->date_time_from && \Carbon\Carbon::parse($a->date_time_from)->year == $year)
                ->groupBy(fn($a) => \Carbon\Carbon::parse($a->date_time_from)->format('Y-m-d'))
                ->map->count();
        }
        $holidays = Holiday::with('getHoliday')->where('status', 1)->where('user_id', auth()->id())->get();
        $month = Carbon::now()->format('Y-m');
        $totalAppointments = $appointmentCounts->count($month);
        return view('appointment.appointment.calendar.customcalendar', compact('years', 'appointmentCounts', 'totalAppointments', 'month', 'yearEstimation', 'holidays'));
    }
    public function reportTableFirst(Request $request)
    {
        $years = YearEstimation::get();
        $leadStatuses = ['won', 'lost', 'pending'];
        $weekData = [];
        $leadsCount = 0;
        $wonLeadsCount = 0;
        $lostLeadsCount = 0;
        $pendingLeadsCount = 0;
        $appointmentMonthlyCount = [];
        $leadMonthlyCount = [];
//        $currentYear = YearEstimation::where('status',1)->first()->year ?? Carbon::now()->year;
        $year = $request->input('year') ?? Carbon::now()->year;
        $totalWeeks = Carbon::create($year, 12, 31)->weeksInYear();
        $now = $year ? Carbon::create($year) : Carbon::now();
        $yearEstimation = $years->where('status', 1)->first()->year;
        for ($week = 1; $week <= $totalWeeks; $week++) {
            if ($week === 1) {
                $startDate = Carbon::createFromDate($year, 1, 1)->startOfWeek();
            } else {
                $startDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
            }
            $endDate = Carbon::now()->setISODate($year, $week)->endOfWeek();
            if ($week === $totalWeeks && $endDate->lt(Carbon::create($year, 12, 31))) {
                $endDate = Carbon::create($year, 12, 31)->endOfDay();
            }
            if ($endDate->year != $now->year) {
                $endDate = $now->endOfYear();
            } elseif ($startDate->year != $now->year) {
                $startDate = $now->startOfYear();
            }
            $leadCounts = [];
            foreach ($leadStatuses as $status) {
                if(!auth()->user()->hasRole('user')){
                    $count = Lead::whereBetween('lead_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status) ->where(function ($query) {
                        $query->where('customer_id', auth()->user()->id)
                            ->orWhere('representative_id', auth()->user()->id);
                    })
                        ->count();
                }else{
                    $count = Lead::whereBetween('lead_status_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status)->count();
                }
//                $count = Lead::whereBetween('lead_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->where('lead_status', $status)->count();
                $leadCounts[$status] = $count;
                switch ($status) {
                    case 'won':
                        $wonLeadsCount += $count;
                        break;
                    case 'lost':
                        $lostLeadsCount += $count;
                        break;
                    case 'pending':
                        $pendingLeadsCount += $count;
                        break;
                }
            }
            $leadsCount += array_sum($leadCounts);
            if (!auth()->user()->hasRole('user')){
                $appointment = Appointment::whereHas('getLead', function ($query) {
                    $query->where('representative_id', auth()->user()->id)
                        ->orWhere('customer_id', auth()->user()->id);
                })->get();
                $appointmentCount = $appointment->filter(fn($appointment) => substr($appointment->created_at, 0, 4) == $year)->count();
                $appointmentInactiveCount = $appointment->filter(fn($appointment) => $appointment->created_at->format('Y') == $year)->where('status', 0)->count();
                $appointmentsWeeklyCount = $appointment->whereBetween('created_at', [$startDate->format('Y-m-d'), $endDate])->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $appointmentsWeeklyCount2 = $appointment->whereBetween('created_at', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->count();
                $inactiveAppointmentsWeeklyCount = $appointment->whereBetween('created_at', [$startDate->format('Y-m-d'), $endDate])->where('status', '0')->count();
                $count2 = Lead::whereBetween('lead_date', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->where('lead_status', 'won')->count();
            }else{
                $appointment = Appointment::groupBy('appointment_for_lead_id')->orderBy('id', 'asc')->get();
//               return $appointment = Appointment::get();
                $appointmentCount = $appointment->filter(fn($appointment) => substr($appointment->date_time_from, 0, 4) == $year)->count();
//                $appointmentInactiveCount = $appointment->filter(fn($appointment) => $appointment->date_time_from->format('Y') == $year)->where('status', 0)->count();
                $appointmentInactiveCount = $appointment->filter(function ($appointment) use ($year) {
                    return \Carbon\Carbon::parse($appointment->date_time_from)->format('Y') == $year
                        && $appointment->status == 0;
                })->count();
                $appointmentsWeeklyCount = $appointment->whereBetween('date_time_from', [$startDate->format('Y-m-d'), $endDate])->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $appointmentsWeeklyCount2 = $appointment->whereBetween('date_time_from', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->count();
                $inactiveAppointmentsWeeklyCount = $appointment->whereBetween('date_time_from', [$startDate->format('Y-m-d'), $endDate])->where('status', '0')->count();
                $endOfMonthStartDate = $startDate->copy()->startOfMonth();
                $endOfMonthEndDate = $startDate->copy()->endOfMonth();
                $count2 = Lead::whereBetween('lead_date', [$endOfMonthStartDate->format('Y-m-d'), $endOfMonthEndDate->format('Y-m-d')])->where('lead_status', 'won')->count();
            }
            $monthKey = $startDate->month;
            if (!isset($appointmentMonthlyCount[$monthKey])) {
                $appointmentMonthlyCount[$monthKey] = 0;
                $appointmentMonthlyCount_two = 0;
            }
            $appointmentMonthlyCount[$monthKey] = $appointmentsWeeklyCount2;
            if (!isset($leadMonthlyCount[$monthKey])) {
                $leadMonthlyCount[$monthKey] = 0;
                $leadMonthlyCount_two = 0;
            }
            $leadMonthlyCount[$monthKey] = $count2;
            $start_Date = Carbon::parse($startDate->format('Y-m-d'));
            $end_Date = Carbon::parse($endDate->format('Y-m-d'));
            $endOfMonthStartDate = $startDate->copy()->endOfMonth();
            $endOfMonthEndDate = $endDate->copy()->endOfMonth();
            $hello = '';
            if ($endOfMonthStartDate->startOfDay()->equalTo($start_Date->startOfDay()) || $endOfMonthStartDate->between($start_Date, $end_Date) || $endOfMonthEndDate->between($start_Date, $end_Date) || $endOfMonthEndDate->startOfDay()->equalTo($end_Date->startOfDay())) {
                $appointmentMonthlyCount_two = end($appointmentMonthlyCount);
            }
            if ($endOfMonthStartDate->startOfDay()->equalTo($start_Date->startOfDay()) || $endOfMonthStartDate->between($start_Date, $end_Date) || $endOfMonthEndDate->between($start_Date, $end_Date) || $endOfMonthEndDate->startOfDay()->equalTo($end_Date->startOfDay())) {
                $leadMonthlyCount_two = end($leadMonthlyCount);
            }
            $weekData[] = [
                'endOfMonthStartDate'=>$endOfMonthStartDate,
                'week' => $week,
                'dateRange' => $startDate->format('M d') . ' - ' . $endDate->format('M d'),
                'leadCounts' => $leadCounts,
                'appointmentsWeeklyCount' => $appointmentsWeeklyCount,
                'inactiveAppointmentsWeeklyCount' => $inactiveAppointmentsWeeklyCount,
                'appointmentsMonthlyCount' => ($appointmentMonthlyCount_two),
                'leadMonthlyCount' => ($leadMonthlyCount_two),
            ];
        }

        // return $weekData;
        return view('appointment.appointment.calendar.report_table_first', compact(
            'weekData',
            'leadsCount',
            'wonLeadsCount',
            'lostLeadsCount',
            'pendingLeadsCount',
            'appointmentCount',
            'inactiveAppointmentsWeeklyCount',
            'appointmentsWeeklyCount',
            'appointmentInactiveCount',
            'years',
            'yearEstimation'
        ));
    }
    public function updateDateAppointment(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:appointments,id',
            'start' => 'required',
            'end' => 'required',
        ]);

        $appointment = Appointment::findOrFail($validated['id']);
        $appointment->date_time_to = $validated['end'];
        $appointment->date_time_from = $validated['start'];
        $appointment->save();

        return response()->json(['success' => true]);
    }
    public function deleteAppointment(Request $request)
    {
        $model = str_slug('appointment', '-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            $id = $request->input('task_id');
            if (Appointment::destroy($id)) {
                return response()->json(['status' => true, 'message' => 'Appointment deleted successfully.']);
            }
            return response()->json(['status' => false, 'message' => 'Deletion failed.']);
        }
        return response(view('403'), 403);
    }

    public function appointmentReminderEmail(Request $request){
        $appointment = Appointment::where('id', $request->appointment_id)->first();
        $emailContent = "This email is regarding to your appointment reminder \n\nAppointment Details\n\n" .
            "Title: " . $appointment->title . "\n" .
            "From Date: " . $appointment->date_time_from . "\n" .
            "To Date: " . $appointment->date_time_to . "\n" .
            "Location: " . $appointment->location . "\n" .
            "Description: " . $appointment->description . "\n" .
            "Status: " . $appointment->completion_status ;

        LeadMail::create([
            'lead_id' => $request->lead_id,
            'from' => env('MAIL_USERNAME'),
            'message' => 'Appointment Reminder Email Notification',
            'mail_attachment' => '',
            'subject' => 'Appointment reminder for: ' . $appointment->title,
        ]);

        Mail::raw($emailContent, function($message) use ($appointment) {
            $message->to($appointment->getCustomer->email)
                ->subject('Appointment reminder for: ' . $appointment->title);
        });

        return response()->json(['success' => true]);
    }

    public function appointmentComplete(Request $request){
        Appointment::where('id', $request->appointment_id)->update([
            'completion_status' => 'complete'
        ]);
    }

    public function appointmentSms(Request $request)
    {
        try {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_AUTH_TOKEN');
            $twilio_number = env('TWILIO_NUMBER');
            $twilio_client = new TwilioClient($account_sid, $auth_token);
            $appointment = Appointment::find($request->appointment_id);
            $messageText = 'Appointment - Reminder for the appointment ' . $appointment->title;
            $message = strip_tags($messageText);
            if ($appointment) {
                $customerPhone = @$appointment->getCustomer->customerPhonePrimary->phone ?? null;
                if ($customerPhone) {
                    $to = $customerPhone;
                    try {
                        $result = $twilio_client->messages->create($to, [
                            'from' => $twilio_number,
                            'body' => $message,
                        ]);
                        // Store MessageSid with the lead or in a session to correlate the reply
                        // Store in the database (create a relationship or store a field in the Message table)
                        Message::create([
                            'lead_id' => $appointment->appointment_for_lead_id,
                            'message' => $messageText,
                            'twilio_message_sid' => $result->sid??'', // Store the Message SID
                        ]);
                        Notification::create([
                            'lead_id' => $appointment->appointment_for_lead_id,
                            'model'   => 'Message Sent',
                            'title'   => 'Message sent against the appointment <b>' . $appointment->title . '</b> to the customer <b>' . $appointment->getCustomer->name . '</b> by',
                            'icon'    => 'fa-solid fa-envelope',
                            'time'    => now(),
                            'user_id' => auth()->user()->id,
                        ]);
                    } catch (\Twilio\Exceptions\RestException $e) {
                        Log::error("Twilio Error: " . $e->getMessage());
                    }
                } else {
                    Log::error("Customer phone not found for lead ID: " . $request->appointment_id);
                }
            } else {
                Log::error("Lead not found for ID: " . $request->appointment_id);
            }
        } catch (Exception $e) {
            Log::error("General Error: " . $e->getMessage());
            return $e->getMessage();
        }

        return response()->json('success');
    }

}
