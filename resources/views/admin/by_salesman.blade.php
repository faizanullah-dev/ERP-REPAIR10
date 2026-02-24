@extends('layouts.master')
@push('css')
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    <style>
        body .lead_inner_sec .card .lead-finance li { min-width: 16.6%; }
        .financeDescription ~ .ck .ck-content { min-height: 100px; }
        .financeModal .finance-invoice:is(.select2-container) .select2-arrow, #addReceivePaymentModal .receive-invoice:is(.select2-container) .select2-arrow { border: 0; background: transparent; }
        .financeModal .finance-invoice:is(.select2-container), #addReceivePaymentModal .receive-invoice:is(.select2-container) { min-height: 44px; background: #f5f5f5; padding: 10px 15px 7px; border: 1px solid #c2c2c2; border-radius: 8px !important; }

        @media print {
            /* Hide the modal close button, print button, and other non-printable elements */
            .close, #printBtn, #send-invoices {
                display: none;
            }

            /* Optionally adjust styles for printing */
            .modal-content {
                width: 100%;
                padding: 0;
            }

            /* Add any other custom styles for print */
        }
    </style>
@endpush
@section('content')
    <section class="lead_inner_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card_box job_title_box">
                        <h4>{{$lead->title??""}}  <span>({{$appointmentCounts??"0"}} Appointment)</span> </h4>
                        <div class="dropdown add_btn_drpdown">
                            <button type="button" class="btn blue_btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                @if(auth()->user()->can('view-lead'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-usd"></i>Job Price</a>
                                @endif
                                @if(auth()->user()->can('view-task'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addTaskModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-tasks"></i>Task</a>
                                @endif
                                @if(auth()->user()->can('view-jobnote'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addJobNoteModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-list-ul"></i>Job Note</a>
                                @endif
                                @if(auth()->user()->can('view-usermailsend'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addEmailModalBtn" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-envelope"></i>Email</a>
                                @endif
                                @if(auth()->user()->can('view-appointment'))
                                    @if(auth()->user()->hasRole('customer'))
                                        <a class="dropdown-item add_appointment_modal" data-bs-toggle="modal" data-bs-target="#addAppointmentModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-calendar"></i>Appointment</a>
                                    @else
                                        <a class="dropdown-item add_appointment_modal" data-bs-toggle="modal" data-bs-target="#addAppointmentModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-calendar"></i>Appointment</a>
                                    @endif
                                @endif
                                @if(auth()->user()->can('view-schedulingtask'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#assignSchedulingTask" xhref="{{url('schedulingTask/scheduling-task?lead_id=' . $lead->id)}}">
                                        <i class="fa fa-fw fa-calendar-plus"></i>Scheduling Job
                                    </a>
                                @endif
                                @if(auth()->user()->can('view-estimate'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addEstimateModal">
                                        <i ng-if="menu.icon" class="fa fa-calculator"></i>Estimate
                                    </a>
                                @endif
                                @if(auth()->user()->can('view-proposal'))
                                    <a class="dropdown-item" href="{{ route('lead_custom_proposal', ['lead_id' => $lead->id]) }}"><i ng-if="menu.icon" class="fa fa-credit-card"></i>Form/Proposal</a>
                                @endif
{{--                                @if(auth()->user()->can('view-invoice'))--}}
{{--                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addInvoiceModalBtn" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-file-text-o"></i>Invoice(s)</a>--}}
{{--                                @endif--}}
                                @if(auth()->user()->can('view-lead'))
                                    <div class="dropdown dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#" id="calculatorDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-fw fa-tasks"></i>Calculator</a>
                                        <ul class="dropdown-menu" aria-labelledby="calculatorDropdown">
                                            @if(auth()->user()->can('view-roofestimatecalculator'))
                                                <li>
                                                    <a class="dropdown-item" href="{{url('roof_estimation_calculator')}}/{{$lead->id}}"><i class="fa fa-fw fa-file-text-o"></i> Roof Estimate Calculator</a>
                                                </li>
                                            @endif
                                            @if(auth()->user()->can('view-sidingestimatecalculator'))
                                                <li>
                                                    <a class="dropdown-item" href="{{url('siding_estimation_calculator')}}/{{$lead->id}}"><i class="fa fa-fw fa-file-text-o"></i> Siding Estimate Calculator</a>
                                                </li>
                                            @endif
                                            @if(auth()->user()->can('view-chimneyestimatecalculator'))
                                                <li>
                                                    <a class="dropdown-item" href="{{url('chimney_estimation_calculator')}}/{{$lead->id}}"><i class="fa fa-fw fa-file-text-o"></i> Chimney Estimate Calculator</a>
                                                </li>
                                            @endif
                                            @if(auth()->user()->can('view-productpricingestimatecalculator'))
                                                <li>
                                                    <a class="dropdown-item" href="{{url('product_pricing_calculator')}}/{{$lead->id}}"><i class="fa fa-fw fa-file-text-o"></i> Product Pricing Estimate Calculator</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @if(auth()->user()->can('view-photoanddocument'))
                                    @php
                                        $control = App\ControlPanel::where('module', 'Company Cam')->first();
                                    @endphp
                                        @if ($control && $control->status === 'active')
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addLeadPhotoDocumentModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-file-image-o"></i>Company Cam File</a>
                                        @endif
                                @endif
                                @if(auth()->user()->can('view-followupcallnote'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addFollowUpNoteModal"><i ng-if="menu.icon" class="fa fa-fw fa-list-ul"></i>Follow-up Notes</a>
                                @endif
                                @if(auth()->user()->can('view-material'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addMaterialModal" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-calendar"></i>Material</a>
                                @endif
                                {{--@if(auth()->user()->can('view-materialdeliverydate'))--}}
                                {{--<a class="dropdown-item" href="{{url('materialDeliveryDate/material-delivery-date/create')}}"><i ng-if="menu.icon" class="fa fa-fw fa-calendar"></i>Material Delivery Date</a>--}}
                                {{--@endif--}}
                                @if(auth()->user()->can('view-lead'))
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModalProgressBoard" href="#"><i ng-if="menu.icon" class="fa fa-fw fa-tasks"></i>To Progress Board</a>
                                @endif
                                @if(auth()->user()->can('view-lead'))
                                    <a class="dropdown-item" href="{{url('material_listing/'. $lead->id)}}"><i ng-if="menu.icon" class="fa fa-fw fa-calendar"></i>Material Listing</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card_box status_box @if($lead->lead_status == 'new') new active @endif">
                        <a href="{{url('update_status_lead')}}/{{$lead->id}}/new" ><h6>New</h6></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card_box status_box @if($lead->lead_status == 'pending') pending active @endif">
                        <a href="{{url('update_status_lead')}}/{{$lead->id}}/pending" ><h6>Pending</h6></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card_box status_box @if($lead->lead_status == 'won') won active @endif">
                        <a href="{{url('update_status_lead')}}/{{$lead->id}}/won" ><h6>Won</h6></a>
                        @if(in_array($lead->lead_status, ['won']))
                            <span>{{ \Carbon\Carbon::parse($lead->lead_status_date)->format('F d Y') ?? "" }}<button type="button" class="btn lead_update_status" data-leadStatus-id="{{ $lead->id ?? "" }}"><i class="fa-solid fa-pen"></i></button></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card_box status_box @if($lead->lead_status == 'lost') lost active @endif">
                        <a href="{{url('update_status_lead')}}/{{$lead->id}}/lost" ><h6>Lost</h6></a>
                        @if(in_array($lead->lead_status, ['lost']))
                            <span>{{ \Carbon\Carbon::parse($lead->lead_status_date)->format('F d Y') ?? "" }}<button type="button" class="btn lead_update_status" data-leadStatus-id="{{ $lead->id ?? "" }}"><i class="fa-solid fa-pen"></i></button></span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card_box">
                        <h6>Job Price</h6>
                        <h4 class="green_text get_lead_price" data-lead-price="{{ number_format((float)($lead->lead_price?? 0.00),2) }}">${{ number_format((float)($lead->lead_price?? 0.00),2) }} </h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card_box">
                        <h6>Change Order Price</h6>
                        {{--                        <h4 class="green_text">${{ number_format($ChangeOrder ?? '0.00') }} </h4>--}}
                        <h4 class="green_text">${{ number_format((float)($ChangeOrder ?? 0.00), 2) }} </h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card_box">
                        <h6>Total Job Price</h6>
                        <h4 class="green_text total_lead_price">
                            ${{ number_format((float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0), 2) }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="inner_section_timeline">
                        <form action="{{route('stages_update')}}" method="GET" id="stage_form" class="stage_form" enctype="multipart/form-data">
                            @csrf
                            <div class="timelines">
                                @if(count($lead->stages) > 0)
                                    @php
                                        // Get the current stage ID of the lead
                                        $currentStageId = $lead->stage_id;
                                        // Find the position of the current stage in the lead's stages
                                        $currentStagePosition = $lead->stages->firstWhere('stage_id', $currentStageId)->stage->position ?? 0;
                                    @endphp
                                    @forelse($lead->stages->sortBy('stage.position') as $key => $value)
                                        {{--                                        <div class="single_timeline @if($value->stage->position <= $lead->stage_position) checked @endif" data-index="{{ $value->stage->position }}">--}}
                                        {{--                                        <div class="single_timeline @if(isset($value->stage) && $value->stage && $value->stage->position <= $lead->stage_position)  checked @endif" data-index="{{ $value->stage->position }}">--}}
                                        <div class="single_timeline @if(isset($value->stage) && $value->stage && $value->stage->position <= $currentStagePosition)  checked @endif" data-index="{{ $value->stage->position }}">
                                            <input class="single_timeline_radio" id="timeline_{{ $value->stage->position }}" value="{{ $value->stage->id }}" type="checkbox" name="stage_id">
                                            <input type="hidden" name="lead_id" id="lead_id" value="{{ $lead->id }}">
                                            <input type="hidden" name="date" value="{{ \Carbon\Carbon::now() }}">
                                            <style>
                                                .timelines .single_timeline.checked[data-index="{{ $value->stage->position }}"] .timeline_title:after { @if($value->stage->position <= $lead->stage_position)  background-color: {{ $value->stage->colour_id }} @endif}
                                                .timelines .single_timeline.checked[data-index="{{ $value->stage->position }}"] .timeline_bar:before { @if($value->stage->position <= $lead->stage_position)  background-color: {{ $value->stage->colour_id }}; border-color: {{ $value->stage->colour_id }} @endif   }
                                            </style>
                                            @php
                                                $dateUpdated = \Carbon\Carbon::parse($value->date);
                                                $date = \Carbon\Carbon::now();
                                                $formattedDate = $date->format('F j Y');
                                                $formatted = $dateUpdated->format('F j Y');
                                            @endphp

                                            <div class="timeline_title" style="@if($value->stage->position <= $lead->stage_position) background-color: {{ $value->stage->colour_id }} @endif">
                                                <h6>{{ $value->stage->name ?? "" }}  @if($value->stage->position <= $lead->stage_position)<i class="fa-solid fa-check"></i>@endif</h6>
                                                @if($value->stage->position <= $lead->stage_position)
                                                    <span >
                                                        {{ $formatted ?? "" }}
                                                        <button type="button" class="btn dateUpdate" data-leadStage-id="{{ $value->id }}"><i class="fa-solid fa-pen"></i></button>
                                                    </span>
                                                @else
                                                    <span class="dated">{{ $formattedDate ?? "" }}</span>
                                                @endif
                                            </div>
                                            <div class="timeline_bar" style="@if($value->stage->position <= $lead->stage_position) background-color: {{ $value->stage->colour_id }} @endif"></div>
                                        </div>
                                    @empty
                                        <span class="text-center">No Stage Available</span>
                                    @endforelse
                                @else
                                    <span class="text-center">No Stage Available</span>
                                @endif
                            </div>
                            <input id="timeline_submit_btn" class="btn timeline_submit_btn" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card details_box">
                        <div class="card_box_top">
                            <div class="card_box_heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#clientDetails" data-toggle="tab">Client Details</a></li>
                                    <li><a href="#jobDetails" data-toggle="tab">Job Details</a></li>
                                </ul>
                                <div class="edit-buttons">
                                    {{--                                    <button type="button" class="btn btn_icon edit-client-details client_details_btn" data-lead-id="{{$lead->id}}"><i class="fa-solid fa-pen-to-square"></i></button>--}}
                                    <button type="button" class="btn btn_icon edit-job-details job_details_btn" lead-id="{{$lead->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card_box_content ">
                            <div class="tab-content">
                                <div id="clientDetails" class="tab-pane fade in active">
                                    <div class="client_details_content">
                                        @if(isset($lead) && $lead->customer)
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa-solid fa-user"></i>
                                                    <h6>{{$lead->customer->name??"Not Available"}}</h6>
                                                </div>
                                            </div>
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <h6>
                                                        @php $addr = $lead->customer->profile->address ?? null; @endphp
                                                        {{ $addr ?? 'Not Available' }}
                                                    </h6>
                                                </div>
                                                <div class="client_details_right">
                                                    @if($addr)
                                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($addr) }}" target="_blank" rel="noopener" class="ms-2" title="Open in Google Maps">
                                                            <i class="fa-solid fa-map-location-dot" style="cursor:pointer"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($lead->customer) && $lead->customer->customerPhones)
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <h6>
                                                        @forelse($lead->customer->customerPhones as $item)
                                                            {{ $item->phone ?? "Not Available" }}
                                                        @empty
                                                            Not Available
                                                        @endforelse
                                                    </h6>
                                                </div>
                                                <div class="client_details_right">
                                                    @php
                                                        $phone = optional($lead->customer->customerPhones->first())->phone;
                                                    @endphp

                                                    @if($phone)
                                                        <buttton class="btn" data-bs-toggle="modal" data-bs-target="#addMessageModalBtn"><i class="fa-solid fa-message"></i></buttton>
                                                        <button type="button" class="btn call_tab"><i class="fa-solid fa-phone "></i></button>
                                                    @else
                                                        <a href="javascript:void(0);" class="disabled"><i class="fa-solid fa-message"></i></a>
                                                        <a href="javascript:void(0);" class="disabled"><i class="fa-solid fa-phone"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($lead->customer) && $lead->customer->email)
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    <h6>{{$lead->customer->email??"Not Available"}}</h6>
                                                </div>
                                                <div class="client_details_right">
                                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#addEmailModalBtn"><i class="fa-solid fa-envelope"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($lead->customer) && $lead->customer->company)
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa-solid fa-building"></i>
                                                    <h6>{{$lead->customer->company??"Not Available"}}</h6>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($lead->customer) && $lead->customer->customer_note)
                                            <div class="client_details_row">
                                                <div class="client_details_left">
                                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                                    <h6>{{$lead->customer->customer_note??"Not Available"}}</h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="jobDetails" class="tab-pane fade">
                                    @if(auth()->user()->can('view-lead'))
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <th>Stage:</th>
                                                    <td>{!! $lead->getStage->name??"Not Available" !!}</td>
                                                </tr>
                                                <tr>
                                                    <th>Job Name:</th>
                                                    <td class="get">{{$lead->title??"Not Available"}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Job Description:</th>
                                                    <td>{!!  $lead->description??"Not Available"!!}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer:</th>
                                                    <td>@if(isset($lead->customer) && $lead->customer->name)  {!!  $lead->customer->name??"Not Available" !!} @endif</td>
                                                </tr>
                                                <tr>
                                                    <th>Job Id:</th>
                                                    <td>{!! $lead->lead_number??"Not Available" !!}</td>
                                                </tr>
                                                @php
                                                    $dateString = $lead->lead_date;
                                                    $dateObject = new DateTime($dateString);
                                                    $formattedDate = $dateObject->format('F - d - Y');
                                                @endphp
                                                <tr>
                                                    <th>Job Starts Date:</th>
                                                    <td>
                                                        {!! $formattedDate??"Not Available" !!}
                                                        <a href="javascript:void(0)"  data-toggle="modal" data-target="#job_detail_start_date_modal" class="btn btn_icon lead_job_detail_modal">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Representative:</th>
                                                    <td>{{$lead->representative->name??"Not Available"}} </td>
                                                </tr>
                                                <tr>
                                                    <th>Category:</th>
                                                    <td>{{$lead->category->name??"Not Available"}} </td>
                                                </tr>
                                                <tr>
                                                    <th>Minimum Days:</th>
                                                    <td>{{$lead->minimum_days??"Not Available"}} Days</td>
                                                </tr>
                                                <tr>
                                                    <th>Maximum Days:</th>
                                                    <td>{!! $lead->maximum_days??"Not Available" !!} Days</td>
                                                </tr>
                                                <tr>
                                                    <th>Job Address:</th>
                                                    <td>{!! $lead->address??"Not Available" !!}</td>
                                                </tr>
                                                <tr>
                                                    <th>Contact Person:</th>
                                                    <td>{!! $lead->contact_person??"Not Available" !!}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!auth()->user()->hasRole('customer'))
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card_box_top">
                                <div class="card_box_heading">
                                    <h6>Activities</h6>
                                </div>
                            </div>
                            <div class="card_box_content">
                                <div class="activities get_activities">
                                    @if($notificationList->count() > 0)
                                        @foreach($notificationList as $notification)
                                            <div class="message-center" data-status="unseen" data-notification-id="{{ $notification->id }}" >
                                                <div class="message_icon_parent">
                                                    <div class="message_icon_container">
                                                        <i class="{{ $notification->icon ??'' }}"></i>
                                                    </div>
                                                </div>
                                                <div class="mail-content">
                                                    <div class="message_heading_time">
                                                        <h6>{{ $notification->model }}</h6>
                                                        <span class="green_text">{{ $notification->created_at->format('l, h:i A M-d-Y') }}</span>
                                                    </div>
                                                    <p class="mail-desc">{!! $notification->title !!} {{ $notification->user->name??"" }}.</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="card">
                        <div class="card_box_top">
                            <div class="card_box_heading">
                                <h6>Communication</h6>
                            </div>

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#email" data-toggle="tab">Email</a>  <button type="button" class="btn btn_icon add_email_modal_btn" data-bs-toggle="modal" data-bs-target="#addEmailModalBtn"><i class="fa-solid fa-plus"></i></button></li>
                                <li><a href="#text" data-toggle="tab">Text</a>  <button type="button" class="btn btn_icon" data-bs-toggle="modal" data-bs-target="#addMessageModalBtn"><i class="fa-solid fa-plus"></i></button></li>
                                <li><a href="#calls" data-toggle="tab" id="callsTab">Calls</a></li>
                                <li><a href="#notes" data-toggle="tab">Notes</a>  <button type="button" class="btn btn_icon add_job_note_modal_btn" data-toggle="modal" data-target="#addJobNoteModal"><i class="fa-solid fa-plus"></i></button></li>
                            </ul>
                        </div>
                        <div class="card_box_content table_saleman_scroll ">
                            <div class="tab-content">
                                <div id="email" class="tab-pane fade in active">
                                    @if(!auth()->user()->hasRole('customer'))
                                        <div class="inner_section_last_email ">
                                            <div class="table-responsive">
                                                <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                                    <thead>
                                                    <tr>
                                                        {{--                                                        <th>Lead</th>--}}
                                                        {{--                                                        <th>Subject</th>--}}
                                                        <th>Message</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    <tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($leadMails as $leadMail)
                                                        <tr>
                                                            {{--                                                            <th>{{$leadMail->getLead->title??""}}</th>--}}
                                                            {{--                                                            <td>{!! strip_tags($leadMail->subject??"") !!}</td>--}}
                                                            <td>{!! strip_tags($leadMail->message??"") !!}</td>
                                                            <td>{!! strip_tags($leadMail->created_at->format('m-d-Y')??"") !!}</td>
                                                            <td class="view_more_parent">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn  dropdown-toggle" id="material_drop" data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="material_drop">
                                                                        <a type="button"
                                                                           class="btn view_lead_mail_modal_btn"
                                                                           view-leadMail-id="{{$leadMail->id}}">
                                                                            View
                                                                        </a>
                                                                        <a type="button"
                                                                           class="btn delete_lead_mail_modal_btn"
                                                                           delete-leadMail-id="{{$leadMail->id}}">
                                                                            Delete
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">No Data Available
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div id="text" class="tab-pane fade">
                                    @if(!auth()->user()->hasRole('customer'))
                                        <div class="inner_section_last_messages ">
                                            <div class="table-responsive">
                                                <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                                    <thead>
                                                    <tr>
                                                        <th>Message</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                    <tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($messages as $message)
                                                        <tr>
                                                            <td>{!! strip_tags($message->message??"Not Available") !!}</td>
                                                            <td>{{ $message->created_at->format('m-d-Y') }}</td>
                                                            <td>{{ $message->created_at->format('h A') }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3">No Data Available
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div id="calls" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                            <thead>
                                            <tr>
                                                <th>Number</th>
                                                <th>Note</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Duration</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="callsTableBody">
                                            @forelse($lead->call as $value)
                                                <tr id="call-{{ $value->id }}">
                                                    <td>{{ $value->phone ?? "Not Available" }}</td>
                                                    <td>{{ $value->notes ?? "Not Available" }}</td>
                                                    <td>{{ date('h:i A', strtotime($value->time)) ?? "Not Available" }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($value->date ?? '')->format('m-d-Y') ?? 'Not Available' }}
                                                    </td>
                                                    <td>{{ $value->duration ?? "Not Available" }}</td>
                                                    <td class="view_more_parent">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn  dropdown-toggle" id="call_drop" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="call_drop">
                                                                <a type="button" class="btn edit_call_btn" call-id="{{$value->id}}">
                                                                    Edit
                                                                </a>
                                                                <a type="button" class="btn delete_call_btn" call-id="{{$value->id}}">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No Call Found!</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="notes" class="tab-pane fade">
                                    @if(!auth()->user()->hasRole('customer'))
                                        @if(auth()->user()->can('view-jobnote'))
                                            <div class="inner_section_last_messages">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                                        <thead>
                                                        <tr>
                                                            <th >Date</th>
                                                            <th>Description</th>
                                                            <th  >Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse($lead->getJobNotes()->orderBy('id', 'desc')->get() as $jobnoteItem)
                                                            <tr>
                                                                <td >{{ $jobnoteItem->created_at->format('m/d/Y') }}</td>
                                                                <td>{!! substr(strip_tags($jobnoteItem->description),0,100).'...' !!}</td>
                                                                <td class="view_more_parent">
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn dropdown-toggle" id="jobs_drop_{{$jobnoteItem->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fa-solid fa-ellipsis"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="jobs_drop_{{$jobnoteItem->id}}">
                                                                            <a type="button" class="btn dropdown-item jobNote_modal_btn" jobNote-id="{{$jobnoteItem->id}}">View</a>
                                                                            <a type="button" class="btn dropdown-item edit_job_note_modal_btn" jobNote-id="{{$jobnoteItem->id}}">Edit</a>
                                                                            <a type="button" class="btn dropdown-item delete_jobNote_modal_btn" jobNote-id="{{$jobnoteItem->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3">No Data Available</td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card documents_card documents_card_extra_scrolling">
                        <div class="card_box_top">
                            <div class="card_box_heading">
                                <h6>Documents</h6>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#contract" data-toggle="tab">Contracts <span>1</span><button type="button" class="btn btn_icon" data-bs-toggle="modal" data-bs-target="#addLeadProposal"><i class="fa-solid fa-plus"></i></button></a></li>
                                <li><a href="#estimates" data-toggle="tab">Estimates <span>1</span></a></li>
                                <li><a href="#permit" data-toggle="tab">Permits <span>{{ $lead->getFolderManagement->where('type', 'permit')->count() }}</span> <button type="button" class="btn btn_icon" data-bs-toggle="modal" data-bs-target="#addLeadPermit"><i class="fa-solid fa-plus"></i></button></a></li>
                                <li><a href="#warranties" data-toggle="tab">Warranties <span>{{ $lead->getFolderManagement->where('type', 'warranties')->count() }}</span><button type="button" class="btn btn_icon" data-bs-toggle="modal" data-bs-target="#addLeadWarranties"><i class="fa-solid fa-plus"></i></button></a></li>
                            </ul>
                        </div>
                        <div class="card_box_content">
                            <div class="tab-content">
                                <div id="contract" class="tab-pane fade in active">
                                    <div class="folder-items">
                                        @foreach($lead->getProposal->whereNotNull('signature') as $value)
                                            {{--                                            {{$value->signature}}--}}
                                            {{--                                            <div class="file-item">--}}
                                            {{--                                                <a href="{{ asset('website/proposal_screenshoot/' . ($value->getProposalTemplates->screen_shot ?? '')) }}"--}}
                                            {{--                                                   data-fancybox="gallery"--}}
                                            {{--                                                   data-caption="Proposal Screenshot">--}}
                                            {{--                                                    <img src="{{ asset('website/proposal_screenshoot/' . ($value->getProposalTemplates->screen_shot ?? '')) }}"--}}
                                            {{--                                                         alt="Proposal Screenshot"--}}
                                            {{--                                                         class="img-fluid">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="file-item test">--}}
                                            {{--                                                <a href="{{ asset('website/' . ($value->getProposalTemplates->screen_shot ?? '')) }}" data-fancybox="gallery" data-caption="Proposal Screenshot">--}}
                                            {{--                                                    <img src="{{ asset('website/' . ($value->getProposalTemplates->screen_shot ?? '')) }}" alt="Proposal Screenshot" class="img-fluid">--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </div>--}}

                                            <div class="file-item">
                                                {{--                                                {{$value->customer_description}}--}}
                                                <a href="https://docs.google.com/gview?url={{ route('viewProposalPdf', ['filename' => $value->customer_description]) }}&embedded=true"
                                                   data-fancybox="gallery"
                                                   data-type="iframe"
                                                   data-caption="Proposal PDF">
                                                    {{--                                                    <img src="{{ asset('website/' . ($value->getProposalTemplates->screen_shot ?? '')) }}" alt="Proposal Screenshot" class="img-fluid">--}}
                                                    <img src="{{ asset('website/images/pdf.png') }}" alt="PDF File" class="file-icon">
                                                    <span>View Proposal</span>
                                                </a>

                                                {{-- Download PDF --}}
                                                <a href="{{ route('viewProposalPdf', ['filename' => $value->customer_description]) }}" download class="download-btn" title="Download as PDF">
                                                    <i class="fas fa-download"></i>
                                                </a>

                                            </div>
                                        @endforeach

                                        @foreach($lead->getFolderManagement->where('type', 'proposal') as $value)
                                            @foreach($value->files as $file)
                                                @php
                                                    $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                @endphp
                                                <div class="file-item text-center">
                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <!-- Image Preview -->
                                                        <a href="{{ asset('website/lead_inner_proposal/' . $file->name) }}"
                                                           data-fancybox="gallery"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/lead_inner_proposal/' . $file->name) }}" alt="Proposal" class="img-fluid">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif($extension == 'pdf')
                                                        <!-- PDF Preview -->
                                                        <a href="https://docs.google.com/gview?url={{ asset('website/lead_inner_proposal/' . $file->name) }}&embedded=true"
                                                           data-fancybox="gallery"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/pdf.png') }}"
                                                                 alt="PDF File"
                                                                 class="file-icon">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                        <!-- Word/Excel Preview (inside Fancybox iframe) -->
                                                        <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/lead_inner_proposal/' . $file->name) }}"
                                                           data-fancybox="gallery"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/' . ($extension == 'doc' || $extension == 'docx' ? 'Word-Logo.png' : 'xlsx.png')) }}"
                                                                 alt="{{ ucfirst($extension) }} File"
                                                                 class="file-icon">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @else
                                                        <!-- Default File Icon -->
                                                        <a href="{{ asset('website/proposal/' . $file->name) }}" target="_blank">
                                                            <img src="{{ asset('website/images/files_icon.png') }}" alt="File" class="file-icon">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn remove-file-btn delete_proposal" data-proposal-id="{{ $value->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <div id="estimates" class="tab-pane fade">
                                    <div class="row calculators_card">
                                        <div class="col-md-6">
                                            <a href="{{url('roof_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                                <h6>Roof Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                                <h6 class="green_text"><span class="custom_black_color">Preference:</span>{{ number_format($lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">System:</span>{{ number_format($lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Under 15 sq:</span>{{ number_format($lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Gutter:</span>({{ number_format($lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price ?? 0, 2) }}) ( {{ number_format(@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two ?? 0, 2) }} )</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Flat Roof:</span>{{ number_format($lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price ?? 0, 2) }}</h6>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{url('siding_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                                <h6>Siding Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                                <h6 class="green_text"><span class="custom_black_color">Replacement:</span>{{ number_format($lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Over Existing:</span>{{ number_format($lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Gutter:</span>({{ number_format($lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price ?? 0, 2) }})</h6>

                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{url('chimney_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                                <h6>Chimney Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                                <h6 class="green_text"><span class="custom_black_color">Chimney:</span>{{ number_format($lead->chimneyEstimateCalculator->storeChimney->recommended_price ?? 0, 2) }}</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Liner:</span>{{ number_format($lead->chimneyEstimateCalculator->storeLiner->recommended_price ?? 0, 2) }}</h6>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{url('product_pricing_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                                <h6>Product Pricing Calculator<i class="fa-solid fa-arrow-up"></i></h6>
                                                <h6 class="green_text"><span class="custom_black_color">Material List:</span>95.00</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Price List:</span>95.00</h6>
                                                <h6 class="green_text"><span class="custom_black_color">Pdf Measurement:</span>95.00</h6>
                                                {{--                                                <h6 class="green_text"><span class="custom_black_color">Pdf Material List:</span>95</h6>--}}
                                                {{--                                                <h6 class="green_text"><span class="custom_black_color">Products:</span>95</h6>--}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="permit" class="tab-pane fade">
                                    <div class="folder-items">
                                        @foreach($lead->getFolderManagement->where('type', 'permit') as $value)
                                            @foreach($value->files as $file)
                                                @php
                                                    $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                @endphp
                                                <div class="file-item text-center">
                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="{{ asset('website/permits/' . $file->name) }}"
                                                           data-fancybox="gallery-permit"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/permits/' . $file->name) }}" alt="Permit Image" class="img-fluid">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif($extension == 'pdf')
                                                        <a href="https://docs.google.com/gview?url={{ asset('website/permits/' . $file->name) }}&embedded=true"
                                                           data-fancybox="gallery-permit"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/pdf.png') }}" alt="PDF File" class="file-icon">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                        <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/permits/' . $file->name) }}"
                                                           data-fancybox="gallery-permit"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/' . ($extension == 'doc' || $extension == 'docx' ? 'Word-Logo.png' : 'xlsx.png')) }}"
                                                                 alt="{{ ucfirst($extension) }} File"
                                                                 class="file-icon">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('website/permits/' . $file->name) }}" target="_blank">
                                                            <img src="{{ asset('website/images/files_icon.png') }}" alt="File" class="file-icon">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn remove-file-btn delete_permit" data-permit-id="{{ $value->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div id="warranties" class="tab-pane fade">
                                    <div class="folder-items">
                                        @foreach($lead->getFolderManagement->where('type', 'warranties') as $value)
                                            @foreach($value->files as $file)
                                                @php
                                                    $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                @endphp
                                                <div class="file-item text-center">
                                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="{{ asset('website/warranty/' . $file->name) }}"
                                                           data-fancybox="gallery-warranty"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/warranty/' . $file->name) }}" alt="Warranty Image" class="img-fluid">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif($extension == 'pdf')
                                                        <a href="https://docs.google.com/gview?url={{ asset('website/warranty/' . $file->name) }}&embedded=true"
                                                           data-fancybox="gallery-warranty"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/pdf.png') }}" alt="PDF File" class="file-icon">
                                                            <span class="d-flex">{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                        <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/warranty/' . $file->name) }}"
                                                           data-fancybox="gallery-warranty"
                                                           data-type="iframe"
                                                           data-caption="{{ $value->title ?? '' }}">
                                                            <img src="{{ asset('website/images/' . ($extension == 'doc' || $extension == 'docx' ? 'Word-Logo.png' : 'xlsx.png')) }}"
                                                                 alt="{{ ucfirst($extension) }} File"
                                                                 class="file-icon">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('website/warranty/' . $file->name) }}" target="_blank">
                                                            <img src="{{ asset('website/images/files_icon.png') }}" alt="File" class="file-icon">
                                                            <span>{{ $value->title ?? "" }}</span>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn remove-file-btn delete_warranty" data-permit-id="{{ $value->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card_box_top">
                            <div class="card_box_heading">
                                <h6>Finances</h6>
                            </div>
                            <ul class="nav nav-tabs lead-finance">

                                <li class="active black_icon_li">
                                    <a href="#changeOrder" data-toggle="tab">Change Orders</a>
                                    <div>
                                    <button type="button" class="btn btn_icon add_change_order_modal_btn" data-finance-modal="change-order"><i class="fa-solid fa-plus"></i></button>
                                        <div class="black_icon">
                                            <button class="view_all_invoices_modal" title="All Invoices"  data-bs-toggle="modal" data-bs-target="#allInvoicesModal" type="button">
                                                <i class="fa-solid fa-file-zipper"></i>
                                            </button>

                                        </div>
                                    </div>
                                </li>

                                <li class="black_icon_li">
                                    <a href="#invoices" data-toggle="tab">Invoices</a>
                                    <div>
                                        <button type="button" class="btn btn_icon add_invoice_modal_btn" data-finance-modal="invoice">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <div class="black_icon">
                                            <button class="view_cumulative_invoice_modal_btn" title="Cumalative Invoices" cumulative-id="{{ $lead->id }}" type="button">
                                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                            </button>

                                        </div>
                                    </div>
                                </li>
                                <li class="black_icon_li">
                                    <a href="#receivables" data-toggle="tab">Receivables</a>
                                    <div>
                                        <button type="button" class="btn btn_icon add_receive_payment_modal_btn" data-finance-modal="receivable"><i class="fa-solid fa-plus"></i></button>
                                        <div class="black_icon">
                                            <button class="view_invoice_balance_sheet_modal_btn" title="Balance Sheet" invoice-id="{{ $lead->id }}" type="button"><i class="fa-solid fa-scale-balanced"></i></button>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="#credit" data-toggle="tab">Credits</a>
                                    <button type="button" class="btn btn_icon add_credit_modal_btn" data-finance-modal="credit">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </li>
                                <li>
                                    <a href="#refund" data-toggle="tab">Refunds</a>
                                    <button type="button" class="btn btn_icon add_refund_modal_btn" data-finance-modal="refund"><i class="fa-solid fa-plus"></i></button>
                                </li>

                                <li class="black_icon_li">
                                    <a href="#cogs" data-toggle="tab">COGS</a>
                                    <button type="button" class="btn btn_icon add_cogs_modal_btn" data-finance-modal="cogs"><i class="fa-solid fa-plus"></i></button>
                                    <div class="black_icon">
                                        <button class="btn view_COGS_modal_btn" cogs-id="{{ $lead->id }}" type="button" title="View COGS">
                                            {{--<img src="{{ asset('website/images/setting_eye.png') }}" alt="" class="img-fluid">--}}
                                            <i class="fa-solid fa-gears"></i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card_box_content table_saleman_scroll">
                            <div class="tab-content">
                                <div id="changeOrder" class="tab-pane fade in active">
                                    <div class="table-responsive">
                                        <table class="table table-borderless scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class">
                                            <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Due Date</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            <tr>
                                            </thead>
                                            <tbody>
                                            @forelse($lead->getChangeOrder as $changeorderItem)
                                                <tr>
                                                    <td>{{$changeorderItem->customer->name??""}}</td>
                                                    <td>{{ $changeorderItem->address}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($changeorderItem->due_date)->format('m/d/y') ?? 'N/A' }}</td>
                                                    <td>{{ $changeorderItem->total_amount}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            {{--                                                            <button class="btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                            {{--                                                                                <span class="--}}
                                                            {{--                                                                                    @if($changeorderItem->status == 'pending')--}}
                                                            {{--                                                                                        text-warning--}}
                                                            {{--                                                                                    @elseif($changeorderItem->status == 'approved')--}}
                                                            {{--                                                                                        text-success--}}
                                                            {{--                                                                                    @elseif($changeorderItem->status == 'rejected')--}}
                                                            {{--                                                                                        text-danger--}}
                                                            {{--                                                                                    @endif--}}
                                                            {{--                                                                                        ">--}}
                                                            {{--                                                                                    {{ ucfirst($changeorderItem->status) }}--}}
                                                            {{--                                                                                </span>--}}
                                                            {{--                                                            </button>--}}
                                                            @if($changeorderItem->status == 'pending')
                                                                <button class="btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <span class="
                                                                                    @if($changeorderItem->status == 'pending')
                                                                                        text-warning
                                                                                    @elseif($changeorderItem->status == 'approved')
                                                                                        text-success
                                                                                    @elseif($changeorderItem->status == 'rejected')
                                                                                        text-danger
                                                                                    @endif
                                                                                        ">
                                                                                    {{ ucfirst($changeorderItem->status) }}
                                                                                </span>
                                                                </button>
                                                            @else
                                                                <button class="btn" type="button" >
                                                                <span class="
                                                                        @if($changeorderItem->status == 'approved')
            text-success
        @elseif($changeorderItem->status == 'rejected')
            text-danger
        @endif
    ">
        {{ ucfirst($changeorderItem->status) }}
    </span>
                                                                </button>
                                                            @endif

                                                            <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                                @if($changeorderItem->status == 'pending')
                                                                    <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/approved') }}', 'Are you sure you want to approve this change order? Once approved, no further changes can be made.')">Approved</a>
                                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/rejected') }}', 'Are you sure you want to reject this change order? Once rejected, no further changes can be made.')">Rejected</a>
                                                                @elseif($changeorderItem->status == 'approved')
                                                                    {{--                                                                                <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/pending') }}', 'Are you sure you want to pending this change order?')">Pending</a>--}}
                                                                    {{--                                                                                <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/rejected') }}', 'Are you sure you want to reject this change order?')">Rejected</a>--}}
                                                                @elseif($changeorderItem->status == 'rejected')
                                                                    {{--                                                                                <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/pending') }}', 'Are you sure you want to pending this change order?')">Pending</a>--}}
                                                                    {{--                                                                                <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/approved') }}', 'Are you sure you want to approve this change order?')">Approved</a>--}}
                                                                @else
                                                                    <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/pending') }}', 'Are you sure you want to pending this change order?')">Pending</a>
                                                                    <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/approved') }}', 'Are you sure you want to approve this change order?  Once approved, no further changes can be made.')">Approved</a>
                                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmAction('{{ url('update_status_change_order/' . $changeorderItem->id . '/rejected') }}', 'Are you sure you want to reject this change order?  Once rejected, no further changes can be made.')">Rejected</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="view_more_parent  ">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn  dropdown-toggle" id="changeOrder_drop" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="changeOrder_drop">
                                                                <a type="button"  class="btn view_change_order_modal_btn"  changeOrder-id="{{$changeorderItem->id}}">
                                                                    View
                                                                </a>
                                                                <a type="button" class="btn edit_change_order_modal_btn" changeOrder-id="{{$changeorderItem->id}}">
                                                                    Edit
                                                                </a>
                                                                <a type="button" class="btn delete_change_order_modal_btn" changeOrder-id="{{$changeorderItem->id}}">
                                                                    Delete
                                                                </a>
                                                                <a type="button" class="btn email_change_order_modal_btn" changeOrder-id="{{$changeorderItem->id}}">
                                                                    Email
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No Data Available </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="receivables" class="tab-pane fade">
                                    @if(auth()->user()->can('view-receivepayment'))
                                        {{--<button type="button" class="btn btn-green view_invoice_balance_sheet_modal_btn" invoice-id="{{ $lead->id }}">View Balance Sheet</button>--}}
                                        <div class="table-responsive">
                                            <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class table-borderless">

                                                <thead>
                                                <tr>
                                                    <th > Payment Type </th>
                                                    <th> Reference Number </th>
                                                    <th> Invoice </th>
                                                    <th> Amount </th>
                                                    <th> Remaining Amount </th>
                                                    <th> Created At </th>
                                                    <th> Action </th>
                                                <tr>
                                                </thead>
                                                <tbody>
                                                @forelse($lead->getReceivePayments as $receivepaymentItem)
                                                    <tr>
                                                        <td>{{$receivepaymentItem->getPaymenttype->name??""}}</td>
                                                        <td> {{ $receivepaymentItem->Reference_number ??'' }} </td>
                                                        <td>
                                                            Date: {{ isset($receivepaymentItem->invoice) && $receivepaymentItem->invoice ? \Carbon\Carbon::parse($receivepaymentItem->invoice->due_date)->format('m/d/y') : '' }}
                                                            - Amount: {{ $receivepaymentItem->invoice->total_amount ?? '' }}
                                                        </td>
                                                        <td>{{ number_format((float)$receivepaymentItem->amount ?? 0, 2) }}</td>
                                                        <td>{{ number_format((float)$receivepaymentItem->remaining_balance??'-', 2) }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($receivepaymentItem->date)->format('M d Y') }}</td>
                                                        <td class="view_more_parent  " >
                                                            <div class="dropdown">
                                                                <button type="button" class="btn  dropdown-toggle" id="payment_drop" data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="payment_drop">
                                                                    <a type="button" class="btn  dropdown-item view_receive_payment_modal_btn"
                                                                       receivePayment-id="{{$receivepaymentItem->id}}" data-toggle="modal" data-target="#receivePaymentModal">
                                                                        View
                                                                    </a>
                                                                    <a type="button" class="btn dropdown-item receive_payment_edit_modal_btn"
                                                                       receivePayment-id="{{$receivepaymentItem->id}}">Edit
                                                                    </a>
                                                                    <a type="button" class="btn dropdown-item receive_payment_delete_modal_btn"
                                                                       receivePayment-id="{{$receivepaymentItem->id}}">Delete</a>
                                                                    <a type="button" class="btn dropdown-item email_send_receive_payment"
                                                                       receivePayment-id="{{$receivepaymentItem->id}}">Add Email
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">No Data Available
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                                <div id="credit" class="tab-pane fade">
                                    {{--                                    <h5>Credit</h5>--}}
                                    <div class="table-responsive">
                                        <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class table-borderless">
                                            <thead>
                                            <tr>
                                                <th> Credit Amount </th>
                                                <th> Date </th>
                                                <th> Description </th>
                                                <th> Action </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($lead->getCredit as $credit)
                                                <tr>
                                                    <td>{{ number_format((float)$credit->amount ?? 0, 2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($credit->date)->format('m/d/y') ?? '' }}</td>
                                                    <td>{!! substr(strip_tags($credit->description),0,100).'...' !!}</td>
                                                    <td class="view_more_parent  ">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn  dropdown-toggle" id="payment_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="payment_drop">
                                                                <a type="button" class="btn  dropdown-item view_credit_modal_btn" data-credit-id="{{ $credit->id }}" data-toggle="modal" data-target="#creditShowModal">View</a>
                                                                <a type="button" class="btn dropdown-item edit_credit_modal_btn" edit-credit-id="{{ $credit->id }}">Edit</a>
                                                                <a type="button" class="btn dropdown-item delete_credit" delete-credit-id="{{ $credit->id??"" }}">Delete</a>
                                                                <a type="button" class="btn dropdown-item email_send_receive_payment" receivepayment-id="11">Add Email</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No Data Found</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="refund" class="tab-pane fade">
                                    {{--                                    <h5>Refund</h5>--}}
                                    <div class="table-responsive">
                                        <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class table-borderless">
                                            <thead>
                                            <tr>
                                                <th> Payment Type </th>
                                                <th> Amount </th>
                                                <th> Date </th>
                                                <th> Description </th>
                                                <th> Action </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($lead->getRefund as $value)
                                                <tr>
                                                    <td>{{ $value->paymentType->name??"" }}</td>
                                                    <td>{{ number_format((float)$value->amount ?? 0, 2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($value->date)->format('m/d/y') ?? '' }}</td>
                                                    <td>{!! substr(strip_tags($value->description),0,100).'...' !!}</td>

                                                    <td class="view_more_parent ">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn  dropdown-toggle" id="payment_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="payment_drop">
                                                                <a type="button" class="btn  dropdown-item view_refund_modal_btn" data-refund-id="{{ $value->id }}" data-toggle="modal" data-target="#refundShowModal">
                                                                    View
                                                                </a>
                                                                <a type="button" class="btn dropdown-item edit_refund_modal_btn" edit-refund-id="{{ $value->id }}">Edit
                                                                </a>
                                                                <a type="button" class="btn dropdown-item delete_refund" delete-refund-id="{{ $value->id??"" }}">Delete</a>
                                                                <a type="button" class="btn dropdown-item email_send_receive_payment" receivepayment-id="11">Add Email
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No Data Found</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="invoices" class="tab-pane fade">
                                    <div class="table-responsive">
                                        <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class  table-borderless">

                                            <thead>
                                            <tr>
                                                <th >Customer Name</th>
                                                <th>Address</th>
                                                <th>Due Dates</th>
                                                <th>Total Amount</th>
                                                {{--<th>Description</th>--}}
                                                <th>Status</th>
                                                <th>Action</th>
                                            <tr>
                                            </thead>
                                            <tbody>
                                            @forelse($lead->getInvoice as $invoiceItem)
                                                <tr>
                                                    <td>{{$invoiceItem->getCustomer->name??$invoiceItem->customer_id??""}}</td>
                                                    <td>{{ $invoiceItem->address}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($invoiceItem->due_date)->format('m/d/Y') }}</td>

                                                    <td>{{ $invoiceItem->total_amount}}</td>
                                                    {{--                                                                <td>{!! substr($invoiceItem->description,0,50).'...' !!}</td>--}}
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <span class="
                                                                                    @if($invoiceItem->status == 'pending')
                                                                                        text-warning
                                                                                    @elseif($invoiceItem->status == 'approved')
                                                                                        text-success
                                                                                    @elseif($invoiceItem->status == 'rejected')
                                                                                        text-danger
                                                                                    @endif
                                                                                ">
                                                                                    {{ ucfirst($invoiceItem->status) }}
                                                                                </span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                                @if($invoiceItem->status == 'pending')
                                                                    <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoiceItem->id . '/approved') }}','You are approving this transaction. Do you want to continue?', '{{ $invoiceItem->id }}', '{{ $invoiceItem->total_amount }}', 'approved')">Approved</a>
                                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoiceItem->id . '/rejected') }}','Are you sure you want to reject this invoice? Once rejected, no further changes can be made.', '{{ $invoiceItem->id }}','{{ $invoiceItem->total_amount }}','rejected')">Rejected</a>
                                                                @elseif($invoiceItem->status == 'approved')
                                                                    <!-- Approved actions (if needed) -->
                                                                @elseif($invoiceItem->status == 'rejected')
                                                                    <!-- Rejected actions (if needed) -->
                                                                @else
                                                                    <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoiceItem->id . '/pending') }}', 'Are you sure you want to pending this invoice?', '{{ $invoiceItem->id }}','{{ $invoiceItem->total_amount }}', 'pending')">Pending</a>
                                                                    <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoiceItem->id . '/approved') }}', 'You are approving this transaction. Do you want to continue?','{{ $invoiceItem->id }}','{{ $invoiceItem->total_amount }}','approved')">Approved</a>
                                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoiceItem->id . '/rejected') }}', 'Are you sure you want to reject this invoice? Once rejected, no further changes can be made.','{{ $invoiceItem->id }}','{{ $invoiceItem->total_amount }}','rejected')">Rejected</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="view_more_parent">
                                                        <div class="dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn  dropdown-toggle" id="changeOrder_drop" data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="changeOrder_drop">
                                                                    <a type="button"  class="btn view_invoice_modal_btn"  invoice-id="{{$invoiceItem->id}}">
                                                                        View
                                                                    </a>
                                                                    @if($invoiceItem->status == 'approved')

                                                                    @else
                                                                        <a type="button" class="btn edit_invoice_modal_btn" invoice-id="{{$invoiceItem->id}}">
                                                                            Edit
                                                                        </a>
                                                                    @endif
                                                                    <a type="button" class="btn delete_invoice_modal_btn" invoice-id="{{$invoiceItem->id}}">
                                                                        Delete
                                                                    </a>
                                                                    <a type="button" class="btn email_invoice_modal_btn" invoice-id="{{$invoiceItem->id}}">
                                                                        Email
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No Data Available
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="cogs" class="tab-pane fade">
                                    @if(!auth()->user()->hasRole('customer'))
                                        @if(auth()->user()->can('view-costofgoodsold'))
                                            {{--<button type="button" class="btn btn-green view_COGS_modal_btn " cogs-id="{{$lead->id}}">View COGS</button>--}}
                                            <div class="table-responsive">
                                                <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th>Lead Name</th>
                                                        <th>COGS Type</th>
                                                        <th>Name</th>
                                                        <th>Created AT</th>
                                                        <th>Total Cost</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($costOfGoodSolds as $key => $cogsItem)
                                                        <tr>
                                                            <td>{{ $cogsItem->lead->title ?? '' }}</td>
                                                            <td>{{ $cogsItem->cogsSheetsDetails->first()->cogsMaterial->name ?? '' }}</td>
                                                            <td>{{ $cogsItem->cogsSheetsDetails->first()->name ?? '' }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($cogsItem->cogs_date)->format('m/d/y') ?? '' }}</td>
                                                            <td>{{ number_format($cogsItem->cogsSheetsDetails->sum('total_cost'), 2) }}</td>
                                                            <td class="view_more_parent">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn dropdown-toggle" id="proposal_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="proposal_drop">
                                                                        <a type="button" class="btn view_cogs_modal_detail" cogs-id="{{ $cogsItem->id }}">
                                                                            View
                                                                        </a>
                                                                        <a type="button" class="btn edit_cogs_modal_btn" data-toggle="modal" data-target="#edit_cogs_modal" cogs-id="{{ $cogsItem->id }}">
                                                                            Edit
                                                                        </a>
                                                                        <a type="button" class="btn delete_cogs_modal_btn" cogs-id="{{ $cogsItem->id }}" data-toggle="modal" data-target="#delete">
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">No Data Available</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card_box_top">
                            <div class="card_box_heading">
                                <h6>Measurements/Calculators</h6>
                            </div>
                        </div>
                        <div class="card_box_content">
                            <div class="row calculators_card">
                                <div class="col-md-6">
                                    <a href="{{url('roof_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                        <h6>Roof Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                        <h6 class="green_text">{{ number_format($lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price ?? 0, 2) }}</h6>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('siding_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                        <h6>Siding Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                        <h6 class="green_text">{{ number_format($lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price ?? 0, 2) }}</h6>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('chimney_estimation_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                        <h6>Chimney Calculator <i class="fa-solid fa-arrow-up"></i></h6>
                                        <h6 class="green_text">{{ number_format($lead->chimneyEstimateCalculator->storeChimney->recommended_price ?? 0, 2) }}</h6>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('product_pricing_calculator')}}/{{$lead->id}}" class="calculators_card_box">
                                        <h6>Product Pricing Calculator  <i class="fa-solid fa-arrow-up"></i></h6>
                                        <h6 class="green_text">95.00</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->can('view-receivepayment'))
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card_box_top">
                                <div class="card_box_heading">
                                    <h6>Company Cam Documents</h6>
                                </div>
                            </div>
                            <div class="card_box_content">
                                <div class="tab-content">
                                    <div id="changeOrder" class="tab-pane fade in active">
                                        <div class="table-responsive">
                                            <div class="files_wrapper">
                                                <div class="row">
                                                    @if(isset($lead) && $lead->getphotoandDocument)
                                                        @forelse($lead->getphotoandDocument as $key => $photoDocuments)
                                                            @foreach($photoDocuments->getDocuments as $photoDocumentItem)
                                                                <div class="col-md-4">
                                                                    <div class="file_wrapper">

                                                                        <input type="radio" name="doc_primary" doc-id="{{$photoDocuments->id}}" photo-id="{{$photoDocumentItem->id}}" id="doc_primary{{$photoDocumentItem->id}}" @if($photoDocumentItem->doc_primary == 1) checked @endif  class="radio_btn_photoanddoc" >
                                                                        <label class="radio_btn_photoanddoc_lable" for="doc_primary{{$photoDocumentItem->id}}"> <i class="fas fa-key"></i> </label>
                                                                        <button type="button" class="btn-close delete_btn_photoanddoc" aria-label="Close" photo-id="{{$photoDocumentItem->id}}"> <i class="fa-solid fa-xmark"></i> </button>
                                                                        <a href="{{asset('website')}}/{{$photoDocumentItem->name}}" target="_blank">
                                                                            <div class="file">
                                                                                @if(isset($photoDocumentItem->name) &&in_array(array_reverse(explode('.',$photoDocumentItem->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']))
                                                                                    <img src="{{asset('website')}}/{{$photoDocumentItem->name}}">
                                                                                @elseif(isset($photoDocumentItem->name) && in_array(array_reverse(explode('.',$photoDocumentItem->name))[0],['pdf']))
                                                                                    <img src="{{ asset('/website/images').'/pdf.png' }}">
                                                                                @elseif(isset($photoDocumentItem->name) && in_array(array_reverse(explode('.',$photoDocumentItem->name))[0],['doc','docx','txt']))
                                                                                    <img src="{{ asset('/website/images').'/Word-Logo.png' }}">
                                                                                @else
                                                                                    <img src="{{ asset('/website/images').'/image.png' }}">
                                                                                @endif
                                                                                <span> View/Download </span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @empty
                                                            <div class="heading_btn_wrapper">
                                                                <div class="main_heading">
                                                                    <h5>Not Available</h5>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    @else
                                                        <div class="heading_btn_wrapper">
                                                            <div class="main_heading">
                                                                <h5>Not Available</h5>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card_box_top">
                                <div class="card_box_heading">
                                    <h6>Financial</h6>
                                </div>
                            </div>
                            <div class="card_box_content">
                                <div class="row financial_card">
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Revenue</h6>
                                            <h6 class="green_text">
                                                ${{ number_format( (float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0), 2) }}
                                            </h6>
                                            <h6>100.00%</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Change Order</h6>
                                            <h6 class="green_text">${{ number_format((float)($ChangeOrder ?? 0.00), 2) }}</h6>
                                            <h6>100.00%</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Open Invoices</h6>
                                            <h6 class="green_text">
                                                <h6 class="green_text">
                                                    ${{ number_format(((float)($lead->lead_price ?? 0)) + ((float)($ChangeOrder ?? 0)) - ((float)(optional($lead->getReceivePayments)->sum('amount') ?? 0)), 2) }}
                                                </h6>
                                            </h6>
                                            <h6>
                                                {{
    number_format(
        (
            (
                ((float)($lead->lead_price ?? 0) +
                ((float)($ChangeOrder ?? 0)) -
                ((float)(optional($lead->getReceivePayments)->sum('amount') ?? 0))
            ) /
            (
                ((float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0)) == 0
                ? 1
                : ((float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0))
            )
        ) * 100),
        2
    )
}}%


                                            </h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Payment</h6>
                                            <h6 class="green_text">
                                                ${{ number_format((float)(optional($lead->getReceivePayments)->sum('amount') ?? 0), 2) }}
                                            </h6>
                                            <h6>
                                                {{
                                                    number_format(
                                                        (
                                                            ((float)(optional($lead->getReceivePayments)->sum('amount') ?? 0) /
                                                            max(1,
                                                                ((float)($lead->lead_price ?? 0) +
                                                                ((float)($ChangeOrder ?? 0))
                                                            )
                                                        ) * 100)),
                                                        2
                                                    )
                                                }}%
                                            </h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Refund</h6>
                                            <h6 class="green_text">${{ number_format($lead->getRefund->sum('amount') ?? 0, 2) }}</h6>
                                            <h6>100.00%</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Credits</h6>
                                            <h6 class="green_text">${{ number_format($lead->getCredit->sum('amount') ?? 0, 2) }}</h6>
                                            <h6>100.00%</h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>COGS</h6>
                                            <h6 class="green_text">${{number_format($costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost')??0, 2) }}</h6>
                                            <h6>
                                                {{
                                                    number_format(
                                                        (
                                                            ((float)(optional($costOfGoodSolds)->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0) /
                                                            max(1,
                                                                ((float)($lead->lead_price ?? 0) +
                                                                ((float)($ChangeOrder ?? 0))
                                                            )
                                                        ) * 100)),
                                                        2
                                                    )
                                                }}%
                                            </h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Sales/Job Supervisor - Staff</h6>
                                            @if(
                                                isset($lead->representative->staffPosition) && 
                                                $lead->representative->staffPosition->compensation_record
                                            )
                                                @php
                                                    $compensation = json_decode(
                                                        $lead->representative->staffPosition->compensation_record,
                                                        true // Return as associative array
                                                    );
                                                @endphp

                                                @if(isset($compensation['commission']['rate']))
                                                    <h6 class="green_text" id="sales_amount">
                                                        ${{ number_format((float)$lead->lead_price * ($compensation['commission']['rate'] / 100), 2) }}
                                                    </h6>
                                                    <h6>{{ number_format($compensation['commission']['rate'], 2)}}%</h6>
                                                @else
                                                    <h6 class="green_text">0.00</h6>
                                                    <h6>0.00%</h6>
                                                @endif
                                            @else
                                                <h6 class="green_text">0.00</h6>
                                                <h6>0.00%</h6>
                                            @endif
                                            <h6 class="green_text" id="totalEarningsDisplay"></h6>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#!" class="financial_card_box">
                                            <h6>Net Profit</h6>
                                            <h6 class="green_text" id="net_profit_amount">
                                            @if(
                                                isset($lead->representative->staffPosition) && 
                                                $lead->representative->staffPosition->compensation_record
                                            )
                                            @php
                                                    $compensation = json_decode(
                                                        $lead->representative->staffPosition->compensation_record,
                                                        true // Return as associative array
                                                    );
                                                @endphp
                                            @endif    
                                            ${{ number_format(
                                                ((float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0)) 
                                                - (float)($costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0)
                                                - (((float)($lead->lead_price ?? 0)) * ((float)($compensation['commission']['rate'] ?? 0) / 100)),
                                                2
                                            ) }}
                                            </h6>
                                            <h6 id="finalPercentage">
                                                <input type="hidden" id="leadPriceAmount" value="{{ (float)($lead->lead_price ?? 0) }}">
                                                <input type="hidden" id="changeOrderAmount" value="{{ (float)($ChangeOrder ?? 0) }}">
                                                <input type="hidden" id="costAmount" value="{{ (float)($costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0) }}">
                                                <input type="hidden" id="commissionAmount" value="{{ (float)($lead->lead_price ?? 0) * ((float)($compensation['commission']['rate'] ?? 0) / 100) }}"></h6>

{{--                                            {{ number_format(--}}
{{--                                                ((--}}
{{--                                                    ((float)($lead->lead_price ?? 0) + (float)($ChangeOrder ?? 0)) --}}
{{--                                                    - (float)($costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0) --}}
{{--                                                    - ((float)($lead->lead_price ?? 0) * ((float)($compensation['commission']['rate'] ?? 0) / 100)--}}
{{--                                                ) --}}
{{--                                            ) / max((float)($lead->lead_price ?? 0) + ((float)($ChangeOrder ?? 0)), 1)) * 100, 2)}}--}}
{{--                                            %--}}
                                        </a>
                                    </div>
                                    @if($lead->getCommission->isNotEmpty())
                                        <div class="mt-3">
                                            <h6 class="mb-2">Associated Staff Earnings</h6>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Staff</th>
                                                    <th>Tasks</th>
                                                    <th>Total Time Worked</th>
                                                    <th>Total Earnings</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    // Group commissions by date and then by user_id
                                                    $groupedCommissions = $lead->getCommission->groupBy(function($commission) {
                                                        return $commission->created_at->format('Y-m-d') . '_' . $commission->user_id;
                                                    });
                                                @endphp

                                                @foreach($groupedCommissions as $key => $commissions)
                                                    @php
                                                        $totalSeconds = 0;
                                                        $totalEarnings = 0;
                                                        $taskNames = [];
                                                        $staffName = '';
                                                        $date = '';

                                                        foreach($commissions as $commission) {
                                                            // Get staff finance info
                                                            $staffFinance = json_decode($commission->getUser->staffPosition, true) ?? [];
                                                            $compensation = json_decode($staffFinance['compensation_record'] ?? '[]', true);
                                                            $hourly = $compensation['hourly'] ?? [];
                                                            $pay = $hourly['pay'] ?? 0;

                                                            // Convert time to seconds
                                                            $timeParts = explode(':', $commission->time ?? '00:00:00');
                                                            $hours = (int)$timeParts[0];
                                                            $minutes = (int)$timeParts[1];
                                                            $seconds = (int)$timeParts[2];

                                                            $timeInSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
                                                            $totalSeconds += $timeInSeconds;

                                                            // Calculate earnings
                                                            $totalHours = $hours + ($minutes / 60) + ($seconds / 3600);
                                                            $earnings = $totalHours * (float)$pay;
                                                            $totalEarnings += $earnings;

                                                            // Collect task names and staff info
                                                            $taskNames[] = $commission->getSchedule->name ?? '';
                                                            $staffName = $commission->getUser->name ?? '';
                                                            $date = $commission->created_at->format('m-d-Y');
                                                        }

                                                        // Convert total seconds back to HH:MM:SS
                                                        $totalHours = floor($totalSeconds / 3600);
                                                        $totalMinutes = floor(($totalSeconds % 3600) / 60);
                                                        $totalSecs = $totalSeconds % 60;
                                                        $totalTimeFormatted = sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSecs);

                                                        // Get unique task names
                                                        $taskNames = array_unique($taskNames);
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $date }}</td>
                                                        <td>{{ $staffName }}</td>
                                                        <td>{{ implode(', ', $taskNames) }}</td>
                                                        <td>{{ $totalTimeFormatted }}</td>
                                                        <td class="earning">${{ number_format($totalEarnings, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card_box_top">
                                <div class="card_box_heading">
                                    <h6>Financial Summary</h6>
                                    <select class="form-control" id="calculator-type">
                                        <option selected disabled>Select Calculator Type</option>
                                        <option value="prefered" data-lead-id="{{ $lead->id }}" data-estimate-calculator-type="roof">Preferred</option>
                                        <option value="system" data-lead-id="{{ $lead->id }}" data-estimate-calculator-type="roof">System</option>
                                        <option value="under_15" data-lead-id="{{ $lead->id }}" data-estimate-calculator-type="roof">Under 15 SQ</option>
                                        <option value="flat_roof" data-lead-id="{{ $lead->id }}" data-estimate-calculator-type="roof">Flat Roof</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card_box_content">
                                <div class="chart-container">
                                    <canvas id="financialChart" ></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card view_lead_document_card documents_card">
                            <div class="card_box_top">
                                <div class="card_box_heading">
                                    <h6>Documents <button class="btn btn_icon" id="create-folder-btn"><i class="fa-solid fa-plus"></i></button></h6>
                                </div>
                            </div>
                            <div class="card_box_content">
                                <div class="documents_box">
                                    <div id="folder-form" class="form_inputs_group show_hide_document" style="display: none;">
                                        <input type="text" id="title" class="form-control" placeholder="Enter Folder Name">
                                        <button type="button" class="btn btn-green" id="submit-folder">Create Folder</button>
                                    </div>
                                    <div class="documents-tabs">
                                        <ul class="nav nav-tabs" id="folderTabs">
                                            @foreach($lead->getFolderManagement->whereNull('type') as $folder)
                                                <li class="{{ $loop->first ? 'active' : '' }}">
                                                    <a href="#folder-{{ $folder['id'] }}" data-toggle="tab">{{ $folder['title'] }}<span>{{ $folder->files->count() }}</span></a>
                                                    <button type="button" class="btn remove-file-btn delete_folder" data-folder-id="{{ $folder['id'] }}"> <i class="fa-solid fa-trash"></i> </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="folderTabContent">
                                            @foreach($lead->getFolderManagement->whereNull('type') as $folder)
                                                <div class="tab-pane fade {{ $loop->first ? 'in active' : '' }}" id="folder-{{ $folder['id'] }}" role="tabpanel">
                                                    <div class="folder-items">
                                                        @if($folder->files->isNotEmpty())
                                                            @foreach($folder->files as $file)
                                                                <div class="file-item">
                                                                    <a href="{{ asset('website/leadsDocuments/' . $folder['title'] . '/' . $file['name']) }}"
                                                                       data-fancybox="gallery-{{ $folder['id'] }}"
                                                                       data-caption="{{ $file['name'] }}">
                                                                        <img src="{{ asset('website/leadsDocuments/' . $folder['title'] . '/' . $file['name']) }}"
                                                                             alt="file image" class="img-fluid">
                                                                    </a>
                                                                    <button type="button" class="btn remove-file-btn delete_file" data-file-id="{{ $file['id'] }}">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            {{--                                                        <p>No files available in this folder.</p>--}}
                                                        @endif
                                                        <div class="file-item file-upload-form">
                                                            <label for="upload-file-input-{{ $folder['id'] }}" class="upload-btn"><i class="fa fa-plus"></i></label>
                                                            <input type="file" class="form-control upload-file-input" multiple style="display: none;" id="upload-file-input-{{ $folder['id'] }}">
                                                            <input type="hidden" class="folder_id" value="{{ $folder['id'] }}" name="folder_id">
                                                            {{--                                                    <button class="btn btn-green submit-file" >Convert & Upload</button>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{--                                <div class="document-list" id="document-list">--}}
                                    {{--                                    <div class="card-link" onclick="window.location.href='{{ url('product_pricing_calculator/'. $lead->id) }}';">Product Pricing Calculator</div>--}}
                                    {{--                                </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card measurements_all_wrap">
                            <div class="card_box_heading">
                                <h6>Measurements</h6>
                            </div>
                            <div class="measurements_wrapper_heading">
                                <h6 class="green_text"><span class="custom_black_color">Roof Area:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Siding Area:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Gutters:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Downspouts:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Windows:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Doors:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Chimney:</span>15309.55</h6>
                                <h6 class="green_text"><span class="custom_black_color">Solar Panels:</span>15309.55</h6>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <div id="addCreditModal" class="modal fade financeModal" tabindex="-1" aria-labelledby="addCreditModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCredit">Add Credits</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="credit_form" action="{{ url('/credit/credit') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('credit.credit.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addRefundModal" class="modal fade financeModal" tabindex="-1" aria-labelledby="addRefundModal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRefund">Add Refunds</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="credit_form" action="{{ url('/refund/refund') }}" accept-charset="UTF-8" class="form-horizontal add_refunds_form" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('refund.refund.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmPaymentModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg rounded-3">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title fw-bold">Confirm Payment</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="POST" action="{{ url('/receivePayment/receive-payment') }}" accept-charset="UTF-8"
                          class="form-horizontal" id="confirm_payment_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="lead_id" id="lead_id" value="{{$lead->id??''}}">
                        <input type="hidden" name="invoice_id" id="receive_invoice_id">
                        <input type="hidden" name="amount" id="invoice_amount">
                        <input type="hidden" name="action_type" id="action_type">
                        {{--                        <input type="hidden" name="date" id="current_date">--}}
                        <div class="form-group">
                            <label for="payment_type" class="control-label">{{ 'Payment Type' }} *</label>
                            <select class="select2-receive form-control clr_input_fields select2" name="payment_type" id="payment_type" required>
                                <option value="" selected disabled>Select Payment Type</option>
                                @foreach($paymenttypes as $paymenttype)
                                    <option value="{{$paymenttype->id}}" @if(isset($receivepayment) && $paymenttype->id == $receivepayment->payment_type) selected @endif>{{ $paymenttype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">{{ 'Date' }} *</label>
                            <input type="date" name="date" class="form-control" value="{{ $yearEstimation->year . '-01-01' }}"  required>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill confirm_payment_form">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="job_detail_start_date_modal" class="modal fade job_detail_start_date_modal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="get" action="{{route('change_lead_date')}}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Job Starts Date</h5>
                        {{--<button type="button" class="close close_message_view" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                        {{--</button>--}}
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Job_starts_date"> Start Date</label>
                                    <input type="date" name="lead_date" id="Job_starts_date" value="{{$lead->lead_date??''}}" class="form-control">
                                    <input type="hidden" name="lead_id" id="lead_id" value="{{$lead->id??''}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-green" value="Submit" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="phoneMessageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="close close_message_view" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" action="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message"> Message Created At:</label>
                                <input name="email_message" id="message_created_at" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message"> Message Time:</label>
                                <input name="email_message" id="message_time" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message"> Message:</label>
                                <textarea name="email_message" id="phone_message" rows="5" class="form-control"
                                          readonly></textarea>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_message_view" data-bs-dismiss="modal" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="messageModal" class="modal fade aligned_modal  aligned_modal2" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Email Content</h5>
                    <button type="button" class="close close_view" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" action="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="campaign_name">Campaign Name:</label>
                                <input type="text" name="campaign_name" class="form-control" id="campaign_name"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_email">User Email:</label>
                                <input type="email" name="user_email" class="form-control" id="user_email" readonly>
                            </div>
                        </div>

                        <!-- Email Subject and Type -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_subject">Email Subject:</label>
                                <input type="text" name="email_subject" class="form-control" id="email_subject"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message_type">Message Type:</label>
                                <input type="text" name="message_type" class="form-control" id="message_type" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message">Email Message:</label>
                                <textarea name="email_message" id="email_message" rows="5" class="form-control"
                                          readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message"> Email Created At:</label>
                                <input name="email_message" id="email_created_at" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_message"> Email Time:</label>
                                <input name="email_message" id="email_time" class="form-control" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_view" data-bs-dismiss="modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="appointmentModal" class="main_modal modal aligned_modal" role="dialog" ></div>
    <div id="taskModal" class="main_modal modal fade" role="dialog" ></div>
    <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Job Price</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body" id="myModal">
                    <form action="{{route('update_lead_price')}}" method="POST" id="my_lead_price_form" novalidate>
                        @csrf
                        <input name="lead_id" value="{{ $lead->id }}" type="hidden">
                        <div class="mb-3 px-5">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tax_type" id="taxableRadio"
                                           value="taxable" checked>
                                    <label class="form-check-label" for="taxableRadio">Taxable</label>
                                </div>
                                <div class="form-check form-check-inline px-5">
                                    <input class="form-check-input" type="radio" name="tax_type" id="tax_exemptRadio"
                                           value="tax_exempt">
                                    <label class="form-check-label" for="tax_exemptRadio">Tax Exempt</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" id="radio_amount">
                            <label for="taxable" class="form-label">Amount:</label>
                            {{--                            <input type="number" step="0.01" class="form-control amount" id="lead_amount" value="{{ $lead->lead_amount ?? '' }}" name="lead_amount" placeholder="Enter taxable" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">--}}
                            <input type="text" class="form-control amount"
                                   id="lead_amount" value="{{ number_format((float)$lead->lead_amount ?? 0, 2) }}"
                                   name="lead_amount" placeholder="Enter taxable"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/^(\d*\.?\d*).*$/g, '$1')">


                        </div>
                        <div class="mb-3" id="radio_tax">
                            <label for="tax" class="form-label">Tax (in percentage):<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="tax" id="lead_tax"
                                   placeholder="Enter tax percentage" value="{{$lead->tax??""}}" required>
                        </div>
                        <div class="mb-3" id="input_total_amount">
                            <label for="lead_price" class="form-label">Total Amount:</label>
                            <input name="lead_price" type="number" class="form-control"  id="lead_total_amount"
                                   value="{{$lead->lead_price??""}}">
                        </div>
                        <div class="modal-footer mt-4 pt-4 pb-0">
                            {{--<button type="button" class="d-flex justify-content-center save btn secondary_btn" data-bs-dismiss="modal">Close</button>--}}
                            <button id="submitBtn" class="d-flex justify-content-center save btn btn-green save_job_price_form" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Progress Board Modal  -->
    </div>
    <div id="exampleModalProgressBoard" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabels" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabels">To Progress Board</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body" id="myModalProgressBoard">
                    <form action="{{route('update_lead_progress_status')}}" method="POST" id="my_lead_progress_board_form">
                        @csrf
                        <input name="lead_id" value="{{ $lead->id }}" type="hidden">
                        <div class="mb-3 px-5">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="progress_status" id="taxableRadio" value="1"  {{ isset($lead->progress_status) && $lead->progress_status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="taxableRadio">Yes</label>
                                </div>
                                <div class="form-check form-check-inline px-5">
                                    <input class="form-check-input" type="radio" name="progress_status" id="tax_exemptRadio" value="0"  {{ isset($lead->progress_status) && $lead->progress_status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tax_exemptRadio">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer pt-4">
                            {{--<button type="button" class="d-flex justify-content-center save btn secondary_btn" data-bs-dismiss="modal">Close</button>--}}
                            <button id="submitBtn" class="d-flex justify-content-center save btn btn-green" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addLeadPhotoDocumentModal" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Lead Photo Document</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/photoAndDocument/photo-and-document') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="document-form-add-photo-document">
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('photoAndDocument.photo-and-document.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addFollowUpNoteModal" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Follow Up Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="followupcallnoteForm" action="{{ url('/followUpCallNote/follow-up-call-note') }}" accept-charset="UTF-8"
                          class="form-horizontal " enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include ('followUpCallNote.follow-up-call-note.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addEstimateModal" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Create New Estimate</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/estimate/estimate') }}" accept-charset="UTF-8"
                          class="form-horizontal new_estimate_modal_wrap" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}

                        @include ('estimate.estimate.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignSchedulingTask" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-block:auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Assign Scheduling Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/schedulingTask/scheduling-task') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" id="schedule_job_form">
                        {{ csrf_field() }}
                        <input type="hidden" name="start_date" class="startDates" id="startDate">
                        <div class="form-group">
                            <label for="taskName">Lead:<span style="color:red">*</span></label>

                            <select class="form-control  attendees_user_id assign_lead_readonly" data-placeholder="Select Lead"  id="" name="lead_id" required >
        @if(!empty($leadExist))
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                                    @endforeach
                                @else
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" @if(isset($scheduling_task) && $lead->id == $scheduling_task->lead_id) selected @endif>{{$lead->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Assign User: <span style="color:red">*</span></label>
                            <select class="form-control  custom_modal_select2 attendees_user_id" data-placeholder="Select Assign User" multiple id="" name="user_id[]" required>
                                @foreach($scheduling_task_users as $user)
                                    <option value="{{$user->id}}" >{{$user->name??""}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Assign Team:</label>
                            <select class="form-control custom_modal_select2" data-placeholder="Select Assign Team" multiple id="team_id" name="team_id">
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}" >{{$team->name??""}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Task Name:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="taskName" name="name" required>
                        </div>
                        <input type="hidden" class="form-control" id="color_id" name="color_id">
                        <div class="form-group">
                            <label for="taskName">Assign Subcontractor:</label>
                            <select class="form-control custom_modal_select2" data-placeholder="Select Assign Subcontractor" multiple id="assign_sub_contractor" name="subcontractor_id">
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{$subcontractor->id}}" >{{$subcontractor->name??""}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskDate">Start Date:</label>
                            <input type="date" class="form-control startDates" id="startDate" name="start_date" value="{{ $yearEstimation->year . '-' . date('m-d') }}">
                        </div>

                        {{--                        <div class="form-group">--}}
{{--                            <label for="taskDate">Start Date:</label>--}}
{{--                            <input type="date" class="form-control startDates" id="startDate" name="start_date" value="{{ $yearEstimation->year . '-07-01'??''}}">--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="taskDate">End Date:</label>
                            <input type="date" class="form-control" id="taskDate" name="end_date" value="{{$yearEstimation->year . '-' . date('m-d')}}">
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Task Description:</label>
                            <textarea class="form-control" id="taskDescription" rows="3" name="description"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <div class="d-flex justify-content-center ">
                                <button type="submit" class="btn d-block mx-auto btn-green">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
{{--    <div id="assignSchedulingTask" class="main_modal modal aligned_modal" role="dialog">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="">Assign Scheduling Task</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form method="POST" action="{{ url('/schedulingTask/scheduling-task') }}" accept-charset="UTF-8"--}}
{{--                          class="form-horizontal" enctype="multipart/form-data" id="schedule_job_form">--}}
{{--                        {{ csrf_field() }}--}}
{{--                        <input type="hidden" name="start_date" class="startDates" id="startDate">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskName">Lead:</label>--}}
{{--                            <select class="form-control clr_input_fields select2" id="attendees_lead_id" name="lead_id" required>--}}
{{--                                @if(!empty($leadExist))--}}
{{--                                    @foreach($leads as $lead)--}}
{{--                                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                @else--}}
{{--                                    <option selected disabled>--Select Lead--</option>--}}
{{--                                    @foreach($leads as $lead)--}}
{{--                                        <option value="{{$lead->id}}" @if(isset($scheduling_task) && $lead->id == $scheduling_task->lead_id) selected @endif>{{$lead->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskName">Assign User:</label>--}}
{{--                            <select multiple class="form-control assign_scheduling_select_modal" id="attendees_user_id" name="user_id[]" required>--}}
{{--                                @foreach($scheduling_task_users as $user)--}}
{{--                                    <option value="{{$user->id}}" >{{$user->name??""}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskName">Assign Team:</label>--}}
{{--                            <select class="form-control clr_input_fields select2" id="team_id" name="team_id">--}}
{{--                                <option selected disabled>--Select Team--</option>--}}
{{--                                @foreach($teams as $team)--}}
{{--                                    <option value="{{$team->id}}" >{{$team->name??""}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskName">Task Name:</label>--}}
{{--                            <input type="text" class="form-control" id="taskName" name="name">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskName">Select Color:</label>--}}
{{--                            <input type="color" class="form-control" name="color_id">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="taskDate">Start Date:</label>--}}
{{--                            <input type="date" class="form-control startDates" id="startDate" name="start_date" value="{{ $yearEstimation->year . '-01-01'??''}}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskDate">End Date:</label>--}}
{{--                            <input type="date" class="form-control" id="taskDate" name="end_date" value="{{$yearEstimation->year . '-01-01'??''}}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="taskDescription">Task Description:</label>--}}
{{--                            <textarea class="form-control" id="taskDescription" rows="3" name="description"></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-0">--}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <button type="submit" class="btn btn-green">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id="addLeadProposal" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""> Add Contract </h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('store_proposal') }}" accept-charset="UTF-8" class="form-horizontal add_contract_form" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $leadId }}">
                        <input type="hidden" name="type" value="proposal">
                        <div class="mb-3">
                            <label for="proposalName" class="form-label">Name:<span class="text-danger">*</span></label>
                            <input name="title" type="text" id="proposalName" class="form-control" placeholder="Enter name" required>
                        </div>
                        <div class="mb-4">
                            <label for="proposalFile" class="form-label">File:<span class="text-danger">*</span></label>
                            <input name="file" type="file" class="form-control" id="proposalFile" required>
                        </div>
                        <button id="submitBtn" class="d-block mx-auto save btn btn-green add_contract_submit_btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="addLeadPermit" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Permits</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('folderManagement/folder-management') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="document-form" novalidate>
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $leadId }}">
                        <input type="hidden" name="type" value="permit">
                        <div class="mb-3" id="input_total_amount">
                            <label for="permitName" class="form-label">Name:<span class="text-danger">*</span></label>
                            <input name="title" type="text" id="permitName" class="form-control" placeholder="Enter name " required>
                        </div>
                        <div class="mb-4">
                            <label for="permitFile" class="form-label">File:<span class="text-danger">*</span></label>
                            <input name="file" type="file" class="form-control" id="permitFile" required>
                        </div>
                        <button id="submitBtn" class="d-block mx-auto save btn btn-green add_permits_submit_btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addLeadWarranties" class="main_modal modal aligned_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Warranties</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('store_warranties') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="document-form-warrienties" novalidate>
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $leadId }}">
                        <input type="hidden" name="type" value="warranties">
                        <div class="mb-3" id="warrantyName">
                            <label for="warrantyName" class="form-label">Name:<span class="text-danger">*</span></label>
                            <input name="title" type="text" id="warrantyName" class="form-control" placeholder="Enter name" required>
                        </div>
                        <div class="mb-4">
                            <label for="warrantyFile" class="form-label">File:<span class="text-danger">*</span></label>
                            <input name="file" type="file" class="form-control" id="warrantyFile" required>
                        </div>
                        <button id="submitBtn" class="d-block mx-auto save btn btn-green add_warranties_submit_btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addMessageModalBtn" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Message</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/message_assign_to_lead') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="messagevalidatesss">
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        <div class="mb-3" id="radio_amount">
                            {{--<label for="taxable" class="form-label">Lead</label>--}}
                            <input type="hidden" name="lead_id" value="{{$leadId}}">
                        </div>
                        <div class="mb-4">

                            <textarea class="form-control add_message_text_wrap" rows="5" name="message" placeholder="Enter Message here..." ></textarea>
                            {{--<textarea id="message_description" class="form-control" name="message" rows="4" required placeholder="Your message here"></textarea>--}}
                        </div>
                        <div class="d-flex justify-content-center save">
                            <button type="submit" class="btn btn-green add_task_modal_btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addEmailModalBtn" class="modal fade"  tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Add Emails</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailvalidate" method="POST" id="email_form" action="{{route('add_email_to_lead')}}" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('template_folder_id') ? 'has-error' : ''}}">
                                    <label for="emailTemplateSelect" class="form-label input_labels">Select Email Folder <span class="text-danger">*</span></label>
                                    <select name="template_folder_id" class="form-control  custom_modal_select2 template_folder" required data-placeholder="Select a Template Folder">
                                        <option value=""></option>
                                        @foreach($emailTemplateFolder as $value)
                                            <option value="{{ $value->id }}" email-template="{{ $value->id }}">{{ $value->name??"" }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('template_folder_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer-name" class="form-label input_labels p-18">Select Email Template </label>
                                    <input type="hidden" name="lead_id" value="{{$leadId}}">
                                    <select class="form-control  custom_modal_select2  email_template select_email_modal_global" id="emailTemplateSelect" name="email_template_id" data-placeholder="Select Email Template">
                                        <option value=""></option>
                                        @foreach($emailTemplates as $emailTemplate)
                                            <option value="{{ $emailTemplate->id }}">{{ $emailTemplate->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="form-label input_labels">Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control subject_mail" placeholder="Enter Subject" id="subject" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group attachments_emial {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Attachments' }}</label>
                                    <div action="#" id="attachmentDropzone" class="dropzone">
                                        <div id="imageContainer" class="image_show_email_fetch"></div>
                                        <div class="fallback">
                                            <input name="images" class="attach_img" id="images" type="file" multiple accept="image/*"  />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_description" class="control-label">{{ 'Description' }}</label>
                                    <textarea class="form-control subject_description" name="message" id="email_description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-green  add_task_modal_email_btn" type="submit">Submit <!--<i class="fa-solid fa-check"></i>--></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addCOGSModal" class="main_modal modal fade aligned_modal" role="dialog" >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCOGS">Add COGS</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <form method="POST" action="{{ url('/costOfGoodSold/cost-of-good-sold') }}" accept-charset="UTF-8"
                      class="form-horizontal" enctype="multipart/form-data" id="cogs_create_form" novalidate>
                    {{ csrf_field() }}
                    <input name="view_lead" value="1" type="hidden">
                    <input name="lead_id" value="{{$leadId}}" type="hidden">
                    @include ('costOfGoodSold.cost-of-good-sold.form')
                </form>
            </div>
        </div>
    </div>
    <div id="viewProposalModal" class="modal fade"  tabindex="-1" aria-labelledby="viewProposalModal" aria-hidden="true" ></div>
    <div id="editProposalModal" class="modal fade"  tabindex="-1" aria-labelledby="editProposalModal" aria-hidden="true" ></div>
    <div id="appointmentModal" class="main_modal modal aligned_modal" role="dialog" ></div>
    <div id="materialModal" class="main_modal modal aligned_modal" role="dialog" ></div>
    <div id="viewReceivePaymentModal"  class="modal fade" tabindex="-1" aria-labelledby="viewReceivePaymentModal" aria-hidden="true" ></div>
    <div id="editReceivePayment" class="main_modal modal aligned_modal" role="dialog" ></div>
    <div id="addReceivePaymentModal" class="main_modal modal aligned_modal" role="dialog" >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Receive Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/receivePayment/receive-payment') }}" id="payment-form" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('receivePayment.receive-payment.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addMaterialModal" class="main_modal modal aligned_modal" role="dialog" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Material</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('/materialListing/material-listing')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="material-form" novalidate>
                        {{ csrf_field() }}
                        <div class="row">
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="customer-name" class="form-label input_labels p-18">Select Lead</label>--}}
{{--                                    <select class="form-control clr_input_fields select2 select_disabled_assign_lead" name="lead_id">--}}
{{--                                        <option value="" selected>None</option>--}}
{{--                                        @if(!empty($leadExist))--}}
{{--                                            @foreach($leads as $lead)--}}
{{--                                                <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            @foreach($leads as $lead)--}}
{{--                                                <option value="{{$lead->id}}" @if(isset($invoice)  && $lead->id == $invoice->lead_id) selected @endif >{{$lead->title}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <input type="hidden" name="lead_id" value="{{$leadId}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer-name" class="form-label input_labels p-18">Select Product</label>
                                    <select class="form-control custom_modal_select2 " name="material_id" id="lead_material-select" data-placeholder="Select an Option">
                                        <option value="" selected>None</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->sub_category??"" }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            {{--                            Hidden Fields--}}
                            <div class="col-md-12" id="other-material-fields" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer-name" class="form-label input_labels p-18">Select Product Category*</label>
                                        <select class="form-control" name="product_category_id" id="lead_material-select">
                                            <option value="" selected>None</option>
                                            @foreach($productCategories as $productCategory)
                                                <option value="{{ $productCategory->id }}">{{ $productCategory->name??"" }}</option>
                                            @endforeach
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="material-name" class="form-label input_labels p-18">Material Name*</label>
                                    <input type="text" class="form-control" name="material_name" id="lead_material-name">
                                </div>
                                <div id="material_error"></div>
                                <div class="form-group">
                                    <label for="material-price" class="form-label input_labels p-18">Material Price*</label>
                                    <input type="number" step="0.01" class="form-control" name="material_price" id="lead_material-price">
                                </div>
                            </div>
                            {{--                            Hidden Fields--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="quantity" class="form-label input_labels">Quantity <span class="text-danger">*</span></label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" id="quantity" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer-name" class="form-label input_labels p-18">Status</label>
                                    <select class="form-control custom_modal_select2 materialStatusDrop" name="status" required>
                                        <option value="" disabled selected>None</option>
                                        <option value="added">Added</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="leftover">Leftover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 materialDeliveryDateField d-none">
                                <div class="form-group ">
                                    <label for="material_delivery_date" class="col-md-6 control-label">Material Delivery Date</label>
                                    <input class="form-control" name="material_delivery_date" type="date" id="material_delivery_date" value="{{now()->format('Y-m-d')}}">

                                </div>
                            </div>
                            {{--<div class="col-md-6">--}}
                            {{--<div class="">--}}
                            {{--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-12">
                                <button class="btn btn-green d-block material_submit_btn add_material_submit_btn mx-auto" type="submit">Submit <!--<i class="fa-solid fa-check"></i>--></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="editMaterialModal"  class="modal fade" tabindex="-1" aria-labelledby="editMaterialModal" aria-hidden="true" ></div>
    <div id="jobNoteModal" class="main_modal modal aligned_modal" role="dialog"></div>
    <div id="editJobNoteModal" class="modal fade" tabindex="-1" aria-labelledby="editJobNoteModal" aria-hidden="true" ></div>
    <div id="addJobNoteModal" class="modal fade" class="modal fade" tabindex="-1" aria-labelledby="addJobNoteModal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Add Job Note</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/jobNote/job-note') }}" accept-charset="UTF-8"
                          class="form-horizontal "  id="JobNote-form" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('jobNote.job-note.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="editTaskModal" class="modal fade" tabindex="-1" aria-labelledby="editTaskModal" aria-hidden="true" ></div>
    <div id="edit_cogs_modal" class="modal fade" tabindex="-1" aria-labelledby="edit_cogs_modal" aria-hidden="true" ></div>
    <div id="editChangeOrderModal" class="modal fade" tabindex="-1" aria-labelledby="editChangeOrderModal" aria-hidden="true" ></div>
    <div id="editInvoiceModal" class="modal fade" tabindex="-1" aria-labelledby="editInvoiceModal" aria-hidden="true" ></div>
    <div id="viewTaskModal" class="modal fade" tabindex="-1" aria-labelledby="viewTaskModal" aria-hidden="true" ></div>
    <div id="addChangeOrderModalBtn" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered my-0">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Change Orders</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="changeorder-form" action="{{ url('/changeOrder/change-order') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('changeOrder.change-order.form')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="viewChangeOrderModal" class="modal fade" tabindex="-1" aria-labelledby="viewChangeOrderModal" aria-hidden="true" ></div>
    <div id="addInvoiceModalBtn" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('invoice/invoice') }}" accept-charset="UTF-8" class="form-horizontal" id="invoice_form" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('invoice.invoice.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="cumulativeInvoices" class="modal fade" tabindex="-1" aria-labelledby="cumulativeInvoices" aria-hidden="true" ></div>
    <div id="viewInvoiceModal" class="modal fade" tabindex="-1" aria-labelledby="viewInvoiceModal" aria-hidden="true" ></div>
    <div id="viewInvoiceBalanceSheetModal" class="modal fade" tabindex="-1" aria-labelledby="viewInvoiceBalanceSheetModal" aria-hidden="true" ></div>
    <div id="viewCOGSModal" class="modal fade" tabindex="-1" aria-labelledby="viewCOGSModal" aria-hidden="true" ></div>
    <div id="viewCogsModalDetail" class="modal fade" tabindex="-1" aria-labelledby="viewCogsModalDetail" aria-hidden="true" ></div>
    <div id="addTaskModal" class="modal fade" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="task-form" action="{{ url('/task/task') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('task.task.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="addAppointmentModal" class="modal fade" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered my-0">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/appointment/appointment') }}" accept-charset="UTF-8"
                          class="form-horizontal MyAppointment" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}
                        <input name="view_lead" value="1" type="hidden">
                        @include ('appointment.appointment.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="editAppointmentModal" class="modal fade" tabindex="-1" aria-labelledby="editAppointmentModal" aria-hidden="true"  ></div>
    <div id="changeDateModal" class="modal fade" tabindex="-1" aria-labelledby="changeDateModal" aria-hidden="true" ></div>
    <div id="updateLeadStatusModal" class="modal fade"tabindex="-1" aria-labelledby="updateLeadStatusModal" aria-hidden="true" ></div>
    <div id="viewLeadMessageModal" class="modal fade"  tabindex="-1" aria-labelledby="viewLeadMessageModal" aria-hidden="true" ></div>
    <div id="viewLeadMailModal" class="modal fade" tabindex="-1" aria-labelledby="viewLeadMailModal" aria-hidden="true" ></div>
    <div id="editLeadMailModal" class="modal fade" tabindex="-1" aria-labelledby="editLeadMailModal" aria-hidden="true" ></div>
    <div id="editLeadMessageModal" class="modal fade" tabindex="-1" aria-labelledby="editLeadMessageModal" aria-hidden="true" ></div>
    <div id="editJobModal" class="modal fade" tabindex="-1" aria-labelledby="editJobModal" aria-hidden="true" ></div>
    <div id="editCallModal" class="modal fade" tabindex="-1" aria-labelledby="editCallModal" aria-hidden="true" ></div>
    <div id="editClientModal" class="modal fade" tabindex="-1" aria-labelledby="editClientModal" aria-hidden="true" ></div>
    <div id="editRefundModal" class="modal fade" tabindex="-1" aria-labelledby="editRefundModal" aria-hidden="true" ></div>
    <div id="refundShowModal"  class="modal fade" tabindex="-1" aria-labelledby="refundShowModal" aria-hidden="true" ></div>
    <div id="creditShowModal"  class="modal fade" tabindex="-1" aria-labelledby="creditShowModal" aria-hidden="true" ></div>
    <div id="editCreditModal" class="modal fade" tabindex="-1" aria-labelledby="editCreditModal" aria-hidden="true" ></div>






{{--    All Invoices Modal--}}
    <div id="allInvoicesModal" class="modal fade" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >All Invoices</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-remove"></i> </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice_modal_logo">
                                    <img src="{{asset('website/images/logo.png')}}"  class="img-fluid" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>{{$leadExist->title??""}}</h4>
                                <p><b>Address:</b> {{$leadExist->address??"Not Available"}}</p>
                                <p><b>ZIP Code:</b> {{$leadExist->postal_code??"Not Available"}}</p>
                                <p><b>Contact Person:</b> {{$leadExist->contact_person??"Not Available"}}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Contact Information:</h4>
                                <p><b>Customer Name:</b> {{$leadExist->customer->name??""}}</p>
                                <p><b>Address:</b> {{$leadExist->customer->profile->address??"Not Available"}}</p>
                                <p><b>ZIP Code:</b> {{$leadExist->customer->profile->zip??"Not Available"}}</p>
                                <p><b>Phone:</b> {{$leadExist->customer->customerPhonePrimary->phone??"Not Available"}}</p>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="row custom_row_gap">
                            <div class="col-md-3 custom_space">
                                <p><b>Lead No:</b> {{$leadExist->lead_number??""}}</p>
                            </div>
                            <div class="col-md-3 custom_space">
                                <p><b>Lead Starts:</b> {{\Carbon\Carbon::parse($lead->lead_status_date)->format('m-d-Y') ?? ""}}</p>
                            </div>
                            <div class="col-md-3 custom_space">
                                <p><b>Lead Price:</b> ${{ number_format((float)$leadExist->lead_price, 2) }}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="edit_action_btns hide_print">
                                <button type="button" class="btn action_btn" id="printBtn">
                                    <i class="fa-solid fa-file-zipper"></i> Print
                                </button>
                                <button type="button" class="btn action_btn" id="send-invoices" data-lead-id="{{$leadExist->id}}">
                                    <i class="fa-solid fa-envelope"></i>Send Email
                                </button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>S#No</th>
                                        <th>Invoice Number</th>
                                        <th>Date</th>
                                        <th>Invoice Amount</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leadExist->getInvoice as $invoices)
                                    <tr>
                                        <td><input class="form-control" type="text" value="{{$loop->iteration}}" required readonly></td>
                                        <td><input class="form-control" type="text" value="{{$invoices->invoice_unique_id??''}}" required readonly></td>
                                        <td><input class="form-control" type="text" value="{{\Carbon\Carbon::parse($invoices->due_date)->format('m-d-Y') ?? ''}}" readonly></td>
                                        <td><input class="form-control" type="text" value="{{$invoices->total_amount??'0.00'}}" readonly></td>
                                        <td><input class="form-control" type="text" value="{{$invoices->status??''}}" readonly></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                            <span class="d-flex justify-content-end col-md-12">Invoice Total: $
                                                <span id="">{{$leadExist->getInvoice->sum(fn($invoice) => floatval($invoice->total_amount))}}</span>
                                            </span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{--  <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('googleAPI')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    @php
        $leadPrice = (float)($lead->lead_price ?? 0);
        $changeOrder = (float)($ChangeOrder ?? 0);
        $total = $leadPrice + $changeOrder;
    @endphp



    <script>
        // Store chart instance globally
        let financialChartInstance = null;

        // Initialize chart on page load
        window.onload = function () {
            initChart();
        };

        function initChart() {
            const canvas = document.getElementById('financialChart');

            // Set fixed dimensions
            canvas.height = 300;
            canvas.style.height = '300px';
            const containerWidth = canvas.parentElement.clientWidth;
            canvas.width = containerWidth;
            canvas.style.width = '100%';

            const ctx = canvas.getContext('2d');

            // Get current values with fallback
            let priceText = $('.total_lead_price').text() || '0';
            let numericValue = parseFloat(priceText.replace(/[^0-9.-]+/g, '')) || 0;
            var netProfitAmount = parseFloat($('#net_profit_amount').text().replace('$', '').replace(',', '')) || 0;
            var salesAmount = parseFloat($('#sales_amount').text().replace('$', '').replace(',', '')) || 0;

            const labels = ['Revenue', 'COGS', 'Sales/ Job Supervisor', 'Net Profit'];
            const values = [
                numericValue,
                {{ $costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0 }},
                salesAmount,
                netProfitAmount,
            ];
            const backgroundColors = ['#74C911', '#4285f4', '#ea4335', '#fbbc04'];
            const borderColors = ['#74C911', '#4285f4', '#ea4335', '#fbbc04'];

            // Destroy existing chart if it exists
            if (financialChartInstance) {
                financialChartInstance.destroy();
            }

            // Create new chart
            financialChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '',
                        data: values,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, index) {
                                        return {
                                            text: label,
                                            fillStyle: backgroundColors[index],
                                            strokeStyle: borderColors[index],
                                            lineWidth: 1
                                        };
                                    });
                                },
                                boxWidth: 12,
                                boxHeight: 12
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return '$' + tooltipItem.raw.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: numericValue,
                            ticks: {
                                stepSize: 1000,
                                callback: function(val) {
                                    return '$' + val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                }
                            },
                            grid: {
                                display: true,
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { autoSkip: false },
                            barPercentage: 0.2,
                            categoryPercentage: 0.3
                        }
                    }
                }
            });
        }

        // Handle dropdown change
        $('#calculator-type').change(function() {
            let selected = $(this).find(':selected');
            $.ajax({
                url: '{{ url("get_calculator_data") }}',
                type: 'GET',
                data: {
                    calculator_type: selected.data('estimate-calculator-type'),
                    type: selected.val(),
                    lead_id: selected.data('lead-id')
                },
                success: function(response) {
                    updateChartWithComparison(response);
                },
                error: function() {
                    console.log('Failed to fetch comparison data');
                }
            });
        });

        // Update chart with comparison data
        function updateChartWithComparison(data) {
            const canvas = document.getElementById('financialChart');
            const ctx = canvas.getContext('2d');

            // Get current values with fallback
            let priceText = $('.total_lead_price').text() || '0';
            let numericValue = parseFloat(priceText.replace(/[^0-9.-]+/g, '')) || 0;
            var netProfitAmount = parseFloat($('#net_profit_amount').text().replace('$', '').replace(',', '')) || 0;
            var salesAmount = parseFloat($('#sales_amount').text().replace('$', '').replace(',', '')) || 0;

            // Get comparison values from AJAX response with fallback
            const recommendedPrice = parseFloat(data.recommended_price) || 0;
            const projectCost = parseFloat(data.project_cost) || 0;
            const directoryCost = parseFloat(data.directory_cost) || 0;
            const netProfit = parseFloat(data.net_profit) || 0;

            const labels = ['Revenue', 'COGS', 'Sales/ Job Supervisor', 'Net Profit'];
            const currentValues = [
                numericValue,
                {{ $costOfGoodSolds->flatMap->cogsSheetsDetails->sum('total_cost') ?? 0 }},
                salesAmount,
                netProfitAmount,
            ];
            const comparisonValues = [
                recommendedPrice,
                projectCost,
                directoryCost,
                netProfit
            ];

            // Destroy existing chart
            if (financialChartInstance) {
                financialChartInstance.destroy();
            }

            // Create comparison chart
            financialChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Production',
                            data: currentValues,
                            backgroundColor: ['#74C91180', '#4285f480', '#ea433580', '#fbbc0480'],
                            borderColor: ['#74C911', '#4285f4', '#ea4335', '#fbbc04'],
                            borderWidth: 1
                        },
                        {
                            label: 'Estimation',
                            data: comparisonValues,
                            backgroundColor: ['#74C911', '#4285f4', '#ea4335', '#fbbc04'],
                            borderColor: ['#74C911', '#4285f4', '#ea4335', '#fbbc04'],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return '$' + tooltipItem.raw.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: Math.max(numericValue, recommendedPrice),
                            ticks: {
                                stepSize: 1000,
                                callback: val => '$' + val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            },
                            grid: {
                                display: true,
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { autoSkip: false }
                        }
                    }
                }
            });
        }
    </script>
    {{--    <script>--}}
    {{--        //Credit JS--}}
    {{--        $(document).ready(function(){--}}
    {{--            if (typeof ClassicEditor !== "undefined") {--}}
    {{--                $('.financeDescription').each(function() {--}}
    {{--                    ClassicEditor.create(this)--}}
    {{--                        .then(newEditor => {})--}}
    {{--                        .catch(error => {--}}
    {{--                            console.error(error);--}}
    {{--                        });--}}
    {{--                });--}}
    {{--            } else {--}}
    {{--                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}
    <script type="text/javascript">
        $(document).on("change", ".materialStatusDrop", function(){
            let val = $(this).val();
            if(val == 'delivered'){
                $('.materialDeliveryDateField').removeClass('d-none');
            } else {
                $('.materialDeliveryDateField').addClass('d-none');
            }
        });

        // $(document).ready(function () {
            $(document).on('click', '.call_tab', function () {
                var now = new Date();
                var time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
                var date = now.toISOString().split('T')[0];
                var lead_id = {{ $leadId }};
                let newCall = {
                    lead_id: lead_id,
                    phone: "2819374192",
                    notes: "Dummy text",
                    time: time,
                    date: date,
                    duration: "1:59s",
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    url: "{{ url('call/call') }}",
                    type: "POST",
                    data: newCall,
                    success: function (response) {
                        if (response.call) {
                            $("#callsTableBody").prepend(`
                        <tr id="call-${response.call.id}">
                            <td>${response.call.phone}</td>
                            <td>${response.call.notes}</td>
                            <td>${response.call.time}</td>
                            <td>${response.call.date}</td>
                            <td>${response.call.duration}</td>
                            <td class="view_more_parent">
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" id="changeOrder_drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="changeOrder_drop">
                                        <a type="button" class="btn edit_call_btn" call-id="${response.call.id}">
                                            Edit
                                        </a>
                                        <a type="button" class="btn delete_call_btn" call-id="${response.call.id}">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        `);
                            Swal.fire({
                                icon: 'success',
                                title: 'Call Added',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Invalid response format',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: error,
                        });
                    }
                });
            });
            $(document).on('click', '.edit_call_btn', function (e) {
                cancelPendingRequest();
                var call_id = $(this).attr('call-id');
                $.ajax({
                    url: "{{route('edit_call_modal')}}",
                    type: 'Get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "call_id":call_id,
                    },
                    success: function (result) {
                        $('#editCallModal').html(result);
                        $('#editCallModal').modal('show');
                        // console.log(result)
                    },
                    error: function (e) {
                        console.log(e.status);
                    }
                });
            });

            $(document).on('click', '.delete_call_btn', function (event) {
                var call_id = $(this).attr('call-id');
                event.preventDefault();
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This Call?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_call') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'call_id': call_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'Call has been deleted.', 'success')
                                            .then(function() {
                                                // Reload the page after a delay
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Call deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
        // });

        $(document).on('click','.add_appointment_modal',function() {
            var id = 0;
            var customer_id = $("#customer_id").val();
            leadDropdown(customer_id,id)
        });

        function leadDropdown(customer_id,id){
            $.ajax({
                url: '{{route('lead_dropdown')}}',
                type: 'GET',
                data:{
                    'id': id,
                    'customer_id': customer_id
                },
                success: function(result) {
                    $('#appointment_for_lead_id').html(result);
                },
                error:function(e){
//                alert(e.status);
                    console.log(e.status);
                }
            });
        }

        $(window).on("load", function () {
            function adjustCardBoxContentHeight() {
                $(".lead_inner_sec .card").each(function () {
                    var card = $(this);
                    var cardBoxTop = card.find(".card_box_top");
                    var cardBoxContent = card.find(".card_box_content");
                    if (cardBoxTop.length === 0 || cardBoxContent.length === 0) return;
                    var remainingHeight = card.outerHeight() - cardBoxTop.outerHeight();
                    cardBoxContent.css("height", remainingHeight + "px");
                    if (cardBoxContent[0].scrollHeight > cardBoxContent.innerHeight()) {
                        cardBoxContent.addClass("active");
                    } else {
                        cardBoxContent.removeClass("active");
                    }
                });
            }
            setTimeout(adjustCardBoxContentHeight, 100);
            $('.lead_inner_sec .card .card_box_top .card_box_heading .nav li a[data-toggle="tab"]').on('shown.bs.tab', function () {
                adjustCardBoxContentHeight();
            });
            $(window).resize(adjustCardBoxContentHeight);
        });
        function loadActivities() {
            var leadId = window.location.pathname.split('/').pop();

            $.ajax({
                url: '/get_activities/' + leadId,
                type: 'GET',
                success: function(response) {
                    var htmlContent = '';
                    // $.each(response, function(index, notification) {
                    //     htmlContent += '<div class="message-center">';
                    //     htmlContent += '<div class="message_icon_parent"><i class="' + notification.icon + '"></i></div>';
                    //     htmlContent += '<div class="mail-content">';
                    //     htmlContent += '<div class="message_heading_time"><h6>' + notification.model + '</h6>';
                    //     htmlContent += '<span class="time">' + notification.created_at + '</span></div>';
                    //     htmlContent += '<span class="mail-desc">' + notification.title + '</span></div>';
                    //     htmlContent += '</div>';
                    // });

                    $('.get_activities').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading activities:", error);
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.dropdown-menu .dropdown-toggle').forEach(function (dropdownToggleEl) {
                dropdownToggleEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    let dropdown = new bootstrap.Dropdown(dropdownToggleEl);
                    dropdown.show();
                });
            });
        });
        {{--Paymentmodal--}}
        $(document).ready(function () {
            $("#confirm_payment_form").validate({
                rules: {
                    payment_type: {
                        required: true
                    }
                },
                messages: {
                    payment_type: {
                        required: "Please select a payment type."
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
            $('#confirmPaymentModal').on('hidden.bs.modal', function () {
                $("#confirm_payment_form")[0].reset();
                $("#confirm_payment_form").validate().resetForm();
            });
        });
        {{--Paymentmodal--}}
        $(document).ready(function () {
            var attachmentDropzone = [];
            Dropzone.autoDiscover = false;

            $("#attachmentDropzone").dropzone({
                url: "{{route('upload_email_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                removedfile: function (file) {
                    var image_name = $(file._removeLink).attr('image_name');
                    var id = $(file._removeLink).attr('id');

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);

                    // Check if the image name is already in the array before removing
                    if (attachmentDropzone.includes(image_name)) {
                        attachmentDropzone = jQuery.grep(attachmentDropzone, function (value) {
                            return value != image_name;
                        });

                        // Update hidden input
                        $('#email_attachments').val(attachmentDropzone.join(','));
                    }

                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_email_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");

                    // Ensure response isn't already in the array before adding
                    if (!attachmentDropzone.includes(response)) {
                        attachmentDropzone.push(response);
                        const hiddenInput = $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'mail_attachments[]') // Use an array name to handle multiple files
                            .val(response);
                        $('#attachmentDropzone').append(hiddenInput);
                        $('#email_attachments').val(attachmentDropzone.join(','));
                        $(file._removeLink).attr('image_name', response);
                    }
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {
                    dropzone = this;
                    // Custom error handling when file limit exceeded
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                }
            });
        });

        $(document).on('change', '.email_template', function() {
            var templateId = $(this).val();
            $('#attachmentDropzone .dz-preview').remove();
            $('#imageContainer').empty();
            $.ajax({
                url: '/getCampaignEmailTemplate/' + templateId,
                type: 'GET',
                success: function(response) {
                    $('.subject_mail').val(response.subject);
                    // $('.subject_description').val(response.note);
                    if (editor) {
                        editor.setData(response.note);
                    } else {
                        ClassicEditor.create(document.querySelector('#email_description'))
                            .then(newEditor => {
                                editor = newEditor;
                                editor.setData(response.note);
                            })
                            .catch(error => console.error(error));
                    }
                    // Clear the image container
                    $('#imageContainer').empty();
                    if (response.images.length > 0) {
                        response.images.forEach(function(image) {
                            var img = $('<img>', {
                                src: image.url,
                                height: 100,
                                width: 100,
                                alt: 'Image for ' + image.name
                            });
                            $('#attachmentDropzone').append(`<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                                            <div class="dz-image">
                                                <img data-dz-thumbnail="" alt="laptop.png" src="`+image.url+`">
                                            </div>
                                            <div class="dz-details">
<!--                                                <div class="dz-size">-->
<!--                                                    <span data-dz-size="">-->
<!--                                                        <strong>0.4</strong> MB</span>-->
<!--                                                </div>-->
                                                <div class="dz-filename">
                                                    <span data-dz-name="">`+image.name+`</span>
                                                </div>
                                            </div>
                                            <div class="dz-progress">
                                                <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
                                            </div>
                                            <div class="dz-error-message"><span data-dz-errormessage=""></span>
                                            </div>  <div class="dz-success-mark">
                                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Check</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>  <div class="dz-error-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>
                                            </div>
                                            <input type="hidden" name="mail_attachments[]" value="`+image.name+`">
<!--                                            <a class="dz-remove" href="javascript:undefined;" data-dz-remove="" image_name="`+image.name+`">Remove file</a>-->
                                        </div>`);

                            // $('#imageContainer').append(img);
                        });
                    } else {
                        $('#imageContainer').append('<p>No images available for this template.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(document).on('click', '#create-folder-btn', function () {
            console.log('clicked'); // for debugging
            $('#folder-form').toggle();
        });

        $(document).ready(function() {
            var currentFolder = '';
            var folderHistory = [];
            loadFolderContents('');

            // $('#upload-file-btn').click(function() {
            //     $('#file-upload-form').toggle();
            // });
            $(document).on('click', '#submit-folder', function () {
            var folderName = $('#title').val().trim(); // Trim to remove unnecessary spaces

            if (folderName === '') {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please enter a folder name.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            $.ajax({
                url: '{{ route("folder_create") }}',
                method: 'POST',
                data: {
                    lead_id: '{{ $leadId }}',
                    title: folderName,
                    parent_folder: currentFolder,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var folderId = response.folder_id;
                    $('.documents-tabs .nav li').removeClass('active');
                    $('.documents-tabs .tab-content .tab-pane').removeClass('active in');
                    $('.documents-tabs .nav').prepend(`
                <li class="active">
                    <a href="#folder-${folderId}" data-toggle="tab">${folderName}</a>
                </li>
            `);

                    $('.documents-tabs .tab-content').append(`
                <div class="tab-pane fade in active" id="folder-${folderId}">
<div class="folder-items">


                        <div class="file-item file-upload-form">
                            <label for="upload-file-input-${folderId}" class="upload-btn"><i class="fa fa-plus"></i></label>
                            <input type="file" class="form-control upload-file-input" id="upload-file-input-${folderId}" multiple style="display: none;">
                            <input type="hidden" class="folder_id" value="${folderId}" name="folder_id">
                        </div>
                    </div>
</div>
`);

                    $('a[href="#folder-' + folderId + '"]').tab('show');

                    $('#folder-form').hide();
                    $('#title').val('');

                    Swal.fire({
                        title: 'Success!',
                        text: 'Folder has been created successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    loadActivities();
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error creating folder: ' + xhr.responseText,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
            $(document).on('change', '.upload-file-input', function() {
                var lead_id = {{ $lead->id }};
                var fileData = $(this).closest('.file-upload-form').find('.upload-file-input')[0].files[0];
                var formData = new FormData();
                var folderId = $(this).closest('.file-upload-form').find('.folder_id').val();
                if (!currentFolder && !folderId) {
                    alert('Current folder is not set.');
                    return;
                }
                formData.append('file', fileData);
                formData.append('folder_id', folderId);
                formData.append('lead_id', lead_id);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '{{ route("file_upload") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response)
                        Swal.fire({
                            title: 'Success!',
                            text: 'File uploaded successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        var baseUrl = '{{ asset('website/') }}';
                        var fileUrl = `${baseUrl}/${response.folder_path}/${response.file_name}`;

                        $('.documents-tabs .tab-content .tab-pane.active').find('.folder-items').prepend(`
        <div class="file-item">
            <a href="${fileUrl}" data-fancybox="gallery-${folderId}" class="fancybox">
                <img src="${fileUrl}" width="100">
            </a>
            <button type="button" class="btn remove-file-btn delete_file" data-file-id="${response.id}"> <i class="fa-solid fa-trash"></i> </button>
        </div>
    `);

                        $('.upload-file-input').val('');

                        // $("[data-fancybox]").fancybox();

                        loadActivities();
                    },
                    error: function(xhr) {
                        alert('Error uploading file: ' + xhr.responseText);
                    }
                });
            });
            $(document).on('click', '.folder', function() {
                var folderId = $(this).attr('data-folder-id');
                var folderPath = $(this).data('folder');
                $('#folder-id').val(folderId);
                folderHistory.push(currentFolder);
                currentFolder = folderPath;
                loadFolderContents(folderId);
                $('#back-btn').show();
                updateFolderPath();
                $('.creation_box').show();
                $('#folder-form').hide();
                $('#create-folder-btn').hide();
            });
            $('#back-btn').on('click', function() {
                // if (folderHistory.length > 0) {
                //     currentFolder = folderHistory.pop();
                //     loadFolderContents($('#folder-id').val());
                //     if (folderHistory.length === 0) {
                //         $('#back-btn').hide();
                //     }
                //     updateFolderPath();
                // }
                updateFolderPath();
                $('.creation_box , #file-upload-form').hide();
                $('.document-list').html()
                loadFolderContents('');
                $('#create-folder-btn').show();

            });
            function loadFolderContents(folderId) {
                var leadID = '{{ $lead->id }}';
                // $('.documents-tabs .tab-content .tab-pane.active').html('<p>Loading...</p>');  // Display loading message

                $.ajax({
                    url: '{{ url("folder/contents") }}/' + leadID,
                    method: 'GET',
                    data: {
                        folder_id: folderId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Clear the existing content
                        $(`#folder-${folderId}`).empty();

                        // Create folder inner container for contents
                        var folderInner = $('<div class="folder_inner"></div>').appendTo(`#folder-${folderId}`);

                        // Append folders within the current folder
                        response.folders.forEach(function(folder) {
                            folderInner.append(`
                    <div class="folder card-link" data-folder-id="${folder.id}" data-folder="${folder.path}">
                        <i class="fa-solid fa-folder fa-fw"></i>
                        <h6>${folder.title}</h6>
                        <button type="button" class="btn remove-folder-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `);
                        });
                        // Append files within the current folder
                        var baseUrl = '{{ asset('website/') }}';
                        response.files.forEach(function(file) {
                            folderInner.append(`
                    <div class="folder_inner_box">
                        <img src="${baseUrl}/${response.currentFolder}/${file.title}" >
                        <button type="button" class="btn remove-file-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `);
                        });

                        // Optional: Hide loading message once content is loaded
                        $(`#folder-${folderId}`).find('p').remove();

                        // Show folder content in the respective tab
                        $(`#folder-${folderId}`).show();
                    },
                    error: function(xhr) {
                        console.log('Error loading folder contents: ' + xhr.responseText);
                    },
                    complete: function() {
                        // You can add additional logic here if necessary
                    }
                });
            }
            function updateFolderPath() {
                var displayPath = currentFolder === '' ? '/' : '' + currentFolder;
                $('#current-folder-path').text(displayPath);
            }
            function loadInitialContents() {
                loadFolderContents('');
            }
            $(document).on('click', '.delete_folder', function (event) {
                var folder_id = $(this).attr('data-folder-id');
                event.preventDefault();
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This Folder?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_folder') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'folder_id': folder_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'Folder has been deleted.', 'success')
                                            .then(function() {
                                                // Reload the page after a delay
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Folder deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
            $(document).on('click', '.delete_file', function (event) {
                var file_id = $(this).attr('data-file-id');
                event.preventDefault();

                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This File?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_file') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'file_id': file_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'File has been deleted.', 'success')
                                            .then(function() {
                                                // Reload the page after a delay
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'File deletion failed.', 'error');
                                    }
                                },

                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }

                showConfirmationDialog();
            });
            $(document).on('click', '.delete_proposal', function (event) {
                var proposal_id = $(this).attr('data-proposal-id');
                event.preventDefault();
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This Proposal?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_proposal') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'proposal_id': proposal_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'Proposal has been deleted.', 'success')
                                            .then(function() {
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Proposal deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
            $(document).on('click', '.delete_permit', function (event) {
                var permit_id = $(this).attr('data-permit-id');
                event.preventDefault();
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This Permit?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_permit') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'permit_id': permit_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'Permit has been deleted.', 'success')
                                            .then(function() {
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Permit deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
            $(document).on('click', '.delete_warranty', function (event) {
                var warranty_id = $(this).attr('data-warranty-id');
                event.preventDefault();
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete This Warranty?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_warranty') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'warranty_id': warranty_id
                                },
                                success: function (result) {
                                    if (result.status === true) {
                                        Swal.fire('Deleted!', 'Warranty has been deleted.', 'success')
                                            .then(function() {
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 1000);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Warranty deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
        });
        // $(document).ready(function() {
        //     $.validator.addMethod("noSpace", function(value, element) {
        //         return value.trim().length !== 0;
        //     }, "Spaces are not allowed.");
        //     let editor;
        //     if (typeof ClassicEditor !== "undefined") {
        //         ClassicEditor
        //             .create(document.querySelector('#message_description'))
        //             .then(newEditor => {
        //                 editor = newEditor;
        //             })
        //             .catch(error => {
        //                 console.error(error);
        //             });
        //     } else {
        //         console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
        //     }
        //     $.validator.addMethod("messageDescription", function(value, element) {
        //         if (editor) {
        //             var editorContent = editor.getData().trim();
        //             return editorContent.length !== 0;
        //         }
        //         return false;
        //     }, "Description is required.");
        //
        //     $('#messagevalidate').validate({
        //         ignore: [],
        //         rules: {
        //             message: {
        //                 messageDescription: true
        //             }
        //         },
        //         messages: {
        //             message: {
        //                 messageDescription: "Message field is required"
        //             }
        //         },
        //         submitHandler: function(form) {
        //             form.submit();
        //         }
        //     });
        // });
        // $(document).ready(function () {
        //     CKEDITOR.replace('email_description');
        // });
        $(document).on('click', '.dateUpdate', function (e) {
            var leadStageId = $(this).attr('data-leadStage-id');
            $.ajax({
                url: "{{ route('update_stage_date') }}",
                type: 'get',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': leadStageId
                },
                success: function (result) {
                    $('#changeDateModal').html(result);
                    $('#changeDateModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.lead_update_status', function (e) {
            var leadId = $(this).attr('data-leadstatus-id');
            $.ajax({
                url: "{{ route('update_lead_status_date') }}",
                type: 'get',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': leadId
                },
                success: function (result) {
                    $('#updateLeadStatusModal').html(result);
                    $('#updateLeadStatusModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.task_view_modal_btn', function (e) {
            var id = $(this).attr('task-id');
            $.ajax({
                url: "{{route('view_task_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#viewTaskModal').html(result);
                    $('#viewTaskModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click','.modal button.close', function(){
            // $('.modal-backdrop').remove();
            // $(this).closest('.modal').removeClass('show');
            // $('body').removeClass('modal-open');
            // $('body').removeAttr('style');
            $(this).closest('.modal').modal('hide');
        });
        $(document).on('click', '.task_edit_modal_btn', function (e) {
            var task_id = $(this).attr('task-id');
            $.ajax({
                url: "{{route('edit_task_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "task_id":task_id,
                },

                success: function (result) {

                    $('#editTaskModal').html(result);
                    $('#editTaskModal').modal('show');

                    $(".assign_to_user_id").select2();

                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.edit_cogs_modal_btn', function (e) {
            var id = $(this).attr('cogs-id');
            var lead_id = {{ $leadExist->id??"" }};
            cancelPendingRequest();
            showLoadingSwal();
            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{route('edit_cogs_modal')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id,
                            },
                            success: function (result) {
                                $('#edit_cogs_modal').html(result);
                                $('#edit_cogs_modal').modal('show');
                                hideLoadingSwal();
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal();
                }
            });
        });

        $(document).on('click', '.attendees_modal_btn', function (e) {
            var id = $(this).attr('appointment-id');
            $.ajax({
                url: "{{route('view_appointment_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#appointmentModal').html(result);
                    $('#appointmentModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.jobNote_modal_btn', function (e) {
            var id = $(this).attr('jobNote-id');
            $.ajax({
                url: "{{route('view_jobNote_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#jobNoteModal').html(result);
                    $('#jobNoteModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_proposal_modal_btn', function (e) {
            var id = $(this).attr('proposal-id');
            $.ajax({
                url: "{{route('view_proposal_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#viewProposalModal').html(result);
                    $('#viewProposalModal').modal('show');

                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.material_modal_btn', function (e) {
            var id = $(this).attr('material-id');
            $.ajax({
                url: "{{route('view_material_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#materialModal').html(result);
                    $('#materialModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_receive_payment_modal_btn', function (e) {
            var id = $(this).attr('receivePayment-id');
            $.ajax({
                url: "{{route('view_receive_payment_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function (result) {
                    $('#viewReceivePaymentModal').html(result);
                    $('#viewReceivePaymentModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        {{--$(document).on('click', '.receive_payment_edit_modal_btn', function (e) {--}}
        {{--    var id = $(this).attr('receivePayment-id');--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('edit_receive_payment_detail')}}",--}}
        {{--        type: 'post',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "id":id,--}}
        {{--        },--}}
        {{--        success: function (result) {--}}
        {{--            $('#editReceivePayment').html(result);--}}
        {{--            $('#editReceivePayment').modal('show');--}}
        {{--            $(".select2-payment").select2();--}}
        {{--            $(".select2-receive").select2();--}}


        {{--            // console.log(result)--}}
        {{--        },--}}
        {{--        error: function (e) {--}}
        {{--            console.log(e.status);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).on('click', '.receive_payment_edit_modal_btn', function (e) {
            var id = $(this).attr('receivePayment-id');
            var lead_id = {{ $leadExist->id??"" }};
            cancelPendingRequest();
            showLoadingSwal();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{route('edit_receive_payment_detail')}}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id,
                            },
                            success: function (result) {
                                $('#editReceivePayment').html(result);
                                $('#editReceivePayment').modal('show');
                                $(".select2-payment").select2();
                                $(".select2-receive").select2();
                                hideLoadingSwal();
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal();
                }
            });
        });

        $(document).on('click', '.receive_payment_delete_modal_btn', function (event) {
            var id = $(this).attr('receivePayment-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete This Receive Payment?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_receive_payment') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Receive Payment has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Receive Payment deletion failed.', 'error');
                                }
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.email_send_receive_payment', function (e) {
            var receivePayment_id = $(this).attr('receivePayment-id');
            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are you sure want to send email?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, sent it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('email_send_receive_payment') }}/" + receivePayment_id,
                            type: 'get',//
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Send Email!', 'Email has been sent.', 'success');
                                    // Swal.fire('Send Email!', 'Email has been sent.', 'success')
                                    //     .then(function() {
                                    //         setTimeout(function() {
                                    //             location.reload();
                                    //         }, 1000);
                                    //     });
                                } else {
                                    Swal.fire('Error!', 'email sent failed.', 'error');
                                }//end if.
                            },
                        });
                    }
                });
            }
            showConfirmationDialog();
        });
        $(document).on('click', '.delete_lead_mail_modal_btn', function (event) {
            var id = $(this).attr('delete-leadMail-id');
            event.preventDefault();
            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Lead Email?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_lead_mail') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Lead Email has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Lead Email deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        $(document).on('click', '.delete_message_modal_btn', function (event) {
            var id = $(this).attr('delete-message-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Lead Message?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_lead_message') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Lead Message has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Lead Message deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
            showConfirmationDialog();
        });
        $(document).on('click', '.delete_invoice_modal_btn', function (event) {
            var invoice_id = $(this).attr('invoice-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete This Invoice?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_invoice') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'invoice_id': invoice_id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Invoice has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Invoice deletion failed.', 'error');
                                }
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.task_delete_modal_btn', function (event) {
            var task_id = $(this).attr('task-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Task?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_task') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'task_id': task_id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Task has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Task deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        $(document).on('click', '.edit_material_modal_btn', function (e) {
            var id = $(this).attr('material-id');
            $.ajax({
                url: "{{route('edit_material_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editMaterialModal').html(result);
                    $('#editMaterialModal').modal('show');
                    $(".select2-material").select2();
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.delete_material_modal_btn', function (event) {
            var id = $(this).attr('material-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Material?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_material') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Material has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Material deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        $(document).on('click', '.edit_job_note_modal_btn', function (e) {
            var id = $(this).attr('jobNote-id');
            $.ajax({
                url: "{{route('edit_jobNote_modal')}}",
                'id':id,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editJobNoteModal').html(result);
                    $('#editJobNoteModal').modal('show');
                    $(".assign_to_lead_id").select2();
                    $(".clr_input_status").select2();

                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.delete_jobNote_modal_btn', function (event) {
            var id = $(this).attr('jobNote-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The jobNote?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_jobNote') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'jobNote has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'jobNote deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        $(document).on('click', '.edit_proposal_modal_btn', function (e) {
            var id = $(this).attr('proposal-id');
            $.ajax({
                url: "{{route('edit_proposal_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editProposalModal').html(result);
                    $('#editProposalModal').modal('show');
                    $(".clr_input_proposal").select2();
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.delete_proposal_modal_btn', function (event) {
            var id = $(this).attr('proposal-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Proposal?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_proposal') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Proposal has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Proposal deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        {{--$(document).on('click', '.edit_change_order_modal_btn', function (e) {--}}
        {{--    var changeOrder_id = $(this).attr('changeOrder-id');--}}
        {{--    cancelPendingRequest();--}}
        {{--    showLoadingSwal(); // Show loading Swal--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('edit_change_order_modal')}}",--}}
        {{--        type: 'post',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "changeOrder_id":changeOrder_id,--}}
        {{--        },--}}
        {{--        success: function (result) {--}}
        {{--            $('#editChangeOrderModal').html(result);--}}
        {{--            $('#editChangeOrderModal').modal('show');--}}
        {{--            hideLoadingSwal(); // Hide loading Swal--}}
        {{--        },--}}
        {{--        error: function (e) {--}}
        {{--            console.log(e.status);--}}
        {{--            hideLoadingSwal(); // Hide loading Swal--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).on('click', '.edit_change_order_modal_btn', function (e) {
            var changeOrder_id = $(this).attr('changeOrder-id');
            var id = {{ $leadExist->id??"" }}; // Get the lead ID
            cancelPendingRequest();
            showLoadingSwal(); // Show loading Swal

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{ route('edit_change_order_modal') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "changeOrder_id": changeOrder_id,
                            },
                            success: function(result) {
                                $('#editChangeOrderModal').html(result);
                                $('#editChangeOrderModal').modal('show');
                                $('.edit_change_order_select_modal').select2({
                                    placeholder: "Select Lead",
                                    allowClear: true,
                                    dropdownParent: $('#editChangeOrderModal') // Ensure dropdown appears inside the modal
                                });
                                hideLoadingSwal(); // Hide loading Swal
                            },
                            error: function(e) {
                                console.log(e.status);
                                hideLoadingSwal(); // Hide loading Swal
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal(); // Hide loading Swal
                }
            });
        });

        {{--$(document).on('click', '.edit_invoice_modal_btn', function (e) {--}}
        {{--    var invoice_id = $(this).attr('invoice-id');--}}
        {{--    cancelPendingRequest();--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('edit_invoice_modal')}}",--}}
        {{--        type: 'post',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "invoice_id":invoice_id,--}}
        {{--        },--}}
        {{--        success: function (result) {--}}
        {{--            $('#editInvoiceModal').html(result);--}}
        {{--            $('#editInvoiceModal').modal('show');;--}}
        {{--            // console.log(result)--}}
        {{--        },--}}
        {{--        error: function (e) {--}}
        {{--            console.log(e.status);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).on('click', '.edit_invoice_modal_btn', function (e) {
            var invoice_id = $(this).attr('invoice-id');
            var id = {{ $leadExist->id??"" }}; // Get the lead ID
            cancelPendingRequest();
            showLoadingSwal(); // Show loading Swal

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{ route('edit_invoice_modal') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "invoice_id": invoice_id,
                            },
                            success: function(result) {
                                $('#editInvoiceModal').html(result);
                                $('#editInvoiceModal').modal('show');
                                hideLoadingSwal(); // Hide loading Swal
                            },
                            error: function(e) {
                                console.log(e.status);
                                hideLoadingSwal(); // Hide loading Swal
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal(); // Hide loading Swal
                }
            });
        });

        $(document).on('click', '.email_change_order_modal_btn', function (e) {
            var changeOrder_id = $(this).attr('changeOrder-id');
            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are you sure want to send email?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, sent it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('email_send_change_order') }}/" + changeOrder_id,
                            type: 'get',//
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Send Email!', 'Email has been sent.', 'success');
                                    // Swal.fire('Send Email!', 'Email has been sent.', 'success')
                                    //     .then(function() {
                                    //         setTimeout(function() {
                                    //             location.reload();
                                    //         }, 1000);
                                    //     });
                                } else {
                                    Swal.fire('Error!', 'email sent failed.', 'error');
                                }//end if.
                            },
                        });
                    }
                });
            }
            showConfirmationDialog();
        });
        $(document).on('click', '.view_change_order_modal_btn', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('changeOrder-id');
            $.ajax({
                url: "{{route('view_change_order_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (result) {
                    $('#viewChangeOrderModal').html(result);
                    $('#viewChangeOrderModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_invoice_modal_btn', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('invoice-id');
            $.ajax({
                url: "{{route('view_invoice_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (result) {
                    $('#viewInvoiceModal').html(result);
                    $('#viewInvoiceModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.email_invoice_modal_btn', function (e) {
            var invoice_id = $(this).attr('invoice-id');
            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are you sure want to send email?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, sent it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('email_send_invoice') }}/" + invoice_id,
                            type: 'get',//
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Send Email!', 'Email has been sent.', 'success');
                                    // Swal.fire('Send Email!', 'Email has been sent.', 'success')
                                    //     .then(function() {
                                    //         setTimeout(function() {
                                    //             location.reload();
                                    //         }, 1000);
                                    //     });
                                } else {
                                    Swal.fire('Error!', 'email sent failed.', 'error');
                                }//end if.
                            },
                        });
                    }
                });
            }
            showConfirmationDialog();
        });
        $(document).on('click', '.view_invoice_balance_sheet_modal_btn', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('invoice-id');
            $.ajax({
                url: "{{route('view_invoice_balance_sheet_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (result) {
                    $('#viewInvoiceBalanceSheetModal').html(result);
                    $('#viewInvoiceBalanceSheetModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_COGS_modal_btn', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('cogs-id');
            $.ajax({
                url: "{{route('view_cogs_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (result) {
                    $('#viewCOGSModal').html(result);
                    $('#viewCOGSModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_cogs_modal_detail', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('cogs-id');
            $.ajax({
                url: "{{route('view_cogs_modal_detail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (result) {
                    $('#viewCogsModalDetail').html(result);
                    $('#viewCogsModalDetail').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.delete_cogs_modal_btn', function (event) {
            var id = $(this).attr('cogs-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The COGS?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_cogs') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'COGS has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'COGS deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.view_lead_mail_modal_btn', function (e) {
            cancelPendingRequest();
            var leadMail_id = $(this).attr('view-leadMail-id');
            $.ajax({
                url: "{{route('view_lead_mail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "leadMail_id":leadMail_id,
                },
                success: function (result) {
                    $('#viewLeadMailModal').html(result);
                    $('#viewLeadMailModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.edit_lead_mail_modal_btn', function (e) {
            cancelPendingRequest();
            var leadMail_id = $(this).attr('edit-leadMail-id');
            $.ajax({
                url: "{{route('edit_lead_mail')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "leadMail_id":leadMail_id,
                },
                success: function (result) {
                    $('#editLeadMailModal').html(result);
                    $('#editLeadMailModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_lead_message_modal_btn', function (e) {
            cancelPendingRequest();
            var message_id = $(this).attr('message-id');
            $.ajax({
                url: "{{route('view_lead_message')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "message_id":message_id,
                },
                success: function (result) {
                    $('#viewLeadMessageModal').html(result);
                    $('#viewLeadMessageModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.job_details_btn', function (e) {
            cancelPendingRequest();
            var id = $(this).attr('lead-id');
            $.ajax({
                url: "{{route('edit_lead_job')}}/" + id,
                type: 'GET',
                success: function (result){
                    $('#editJobModal').html(result);
                    $('#editJobModal').modal('show');
                    ClassicEditor
                        .create(document.querySelector('#job_description'))
                        .catch(error => {
                            console.error(error);
                        });
                    function formatCurrency(value) {
                        value = value.replace(/,/g, '');
                        var parts = value.split('.');
                        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        return parts.join('.');
                    }
                    $('#lead_price').on('input', function() {
                        $(this).val(formatCurrency($(this).val()));
                    });
                    initializeGooglePlacesAutocomplete();
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.client_details_btn', function (e) {
            var id = $(this).data('lead-id');
            $.ajax({
                url: "{{route('edit_client_details')}}/" + id,
                type: 'GET',
                success: function (result){
                    $('#editClientModal').html(result);
                    $('#editClientModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });

        function initializeGooglePlacesAutocomplete() {
            var places = new google.maps.places.Autocomplete(document.getElementById('edit_lead_address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var latitude  = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#edit_latitude').val(latitude);
                $('#edit_longitude').val(longitude);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': new google.maps.LatLng(latitude, longitude) }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK && results[0]) {
                        var address = results[0].formatted_address;
                    }
                }); //end geocode
            });
        }//end if.
        $(document).on('click', '.edit_appointment_modal_btn', function (e) {
            cancelPendingRequest();
            var appointment_id = $(this).attr('edit-appointment-id');
            $.ajax({
                url: "{{route('edit_appointment_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "appointment_id":appointment_id,
                },
                success: function (result) {
                    $('#editAppointmentModal').html(result);
                    $('#editAppointmentModal').modal('show');
                    $('.clr_input_appointment').select2();
                    $('.clr_input_attendees').select2();
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.appointment_delete_modal_btn', function (event) {
            var appointment_id = $(this).attr('delete-appointment-id');
            event.preventDefault();

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Appointment?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_appointment_modal') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'appointment_id': appointment_id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Appointment has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Appointment deletion failed.', 'error');
                                }
                            },

                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }

            showConfirmationDialog();
        });
        {{--$(document).on('click', '.delete_change_order_modal_btn', function (event) {--}}
        {{--    var id = $(this).attr('changeOrder-id');--}}
        {{--    event.preventDefault();--}}

        {{--    function showConfirmationDialog() {--}}
        {{--        Swal.fire({--}}
        {{--            title: 'Are You Sure You Want To Delete The changeOrder?',--}}
        {{--            icon: 'warning',--}}
        {{--            showCancelButton: true,--}}
        {{--            confirmButtonColor: '#3085d6',--}}
        {{--            cancelButtonColor: '#d33',--}}
        {{--            confirmButtonText: 'Yes, delete it!'--}}
        {{--        }).then(function(result) {--}}
        {{--            if (result.isConfirmed) {--}}
        {{--                $.ajax({--}}
        {{--                    url: "{{ route('delete_order_change') }}",--}}
        {{--                    type: 'post',--}}
        {{--                    data: {--}}
        {{--                        "_token": "{{ csrf_token() }}",--}}
        {{--                        'id': id--}}
        {{--                    },--}}
        {{--                    success: function (result) {--}}
        {{--                        if (result.status === true) {--}}
        {{--                            Swal.fire('Deleted!', 'changeOrder has been deleted.', 'success')--}}
        {{--                                .then(function() {--}}
        {{--                                    // Reload the page after a delay--}}
        {{--                                    setTimeout(function() {--}}
        {{--                                        location.reload();--}}
        {{--                                    }, 1000);--}}
        {{--                                });--}}
        {{--                        } else {--}}
        {{--                            Swal.fire('Error!', 'changeOrder deletion failed.', 'error');--}}
        {{--                        }--}}
        {{--                    },--}}

        {{--                    error: function (e) {--}}
        {{--                        console.log(e.status);--}}
        {{--                    }--}}
        {{--                });--}}
        {{--            }--}}
        {{--        });--}}
        {{--    }--}}

        {{--    showConfirmationDialog();--}}
        {{--});--}}
        $(document).on('click', '.delete_change_order_modal_btn', function (event) {
            var id = $(this).attr('changeOrder-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete The Change Order?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_order_change') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Change Order has been deleted.', 'success')
                                        .then(function() {
                                            // Reload the page after a delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Change Order deletion failed.', 'error');
                                }
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        function toggleMessage(element) {
            var $contentDiv = $(element).parent();
            var $dots = $contentDiv.find(".dots");
            var $moreText = $contentDiv.find(".more");
            var $btnText = $(element);

            if ($dots.css("display") === "none") {
                $dots.css("display", "inline");
                $btnText.html("See More");
                $moreText.css("display", "none");
            } else {
                $dots.css("display", "none");
                $btnText.html("See Less");
                $moreText.css("display", "inline");
            }
        }
        $(document).on('click', '.view_phone_message_modal_btn', function (e) {
            var compaign_id = $(this).attr('message-id');
            var message_created = $(this).attr('message-created-at');
            var message_time = $(this).attr('message-time');
            var phone_message = $(this).attr('messge-phone');
            $('#message_created_at').val(message_created);
            $('#phone_message').val(phone_message);
            $('#message_time').val(message_time);
            $('#phoneMessageModal').show();
        });
        $(document).on('click', '.close_message_view', function (e) {
            $('#phoneMessageModal').hide();
        });
        $(document).on('click', '.close_view', function (e) {
            $('#messageModal').hide();
        });
        const chatBubbles = document.querySelectorAll('.chat-bubble');
        chatBubbles.forEach(chatBubble => {
            chatBubble.addEventListener('click', () => {
                chatBubbles.forEach(otherBubble => {
                    otherBubble.classList.remove('active');
                });
                chatBubble.classList.add('active');
            });
        });
        const Bubbledots = document.querySelectorAll('.Bubbledot');
        if(Bubbledots[0] !=undefined){

            Bubbledots[0].classList.add('active'); // set first dot as active by default

            chatBubbles.forEach((chatBubble, index) => {
                chatBubble.addEventListener('click', () => {
                    Bubbledots.forEach(otherDot => {
                        otherDot.classList.remove('active');
                    });
                    Bubbledots[index].classList.add('active');
                });
            });

        }
        if($('input[name="dates"]') != undefined) {

            // $('input[name="dates"]').daterangepicker();
            $('.single_timeline_radio').click(function () {
                $(".single_timeline").css('pointer-events','none');
                $(".single_timeline").removeClass("checked");
                let index = $(this).closest(".single_timeline").attr('data-index');
                $('.single_timeline').each(function (i, obj) {
                    let key = $(this).attr('data-index');
                    if (parseInt(index) >= parseInt(key)) {
                        $(this).addClass("checked")
                    }
                });
            });

        }
        jQuery('.inner_section_timeline #stage_form .single_timeline_radio').click(function () {
            jQuery('#timeline_submit_btn').click();
        });
        $("#tax_exemptRadio").change(function () {
            if ($(this).is(":checked")) {
                $("#radio_amount").hide();
                $("#radio_tax").hide();
            }
        });
        $("#taxableRadio").change(function () {
            if ($(this).is(":checked")) {
                $("#radio_amount").show();
                $("#radio_tax").show();
                $("#input_total_amount").show();
            }
        });
        function calculateTotal() {
            var priceType = $('input[name="tax_type"]:checked').val();
            var totalAmount = parseFloat($('#lead_amount').val()) || 0;
            var taxPercentage = parseFloat($('#lead_tax').val()) || 0;
            if (priceType === 'tax_exempt') {
                var total = parseFloat($('#lead_total_amount').val()) || 0;
                totalAmount = total / (1 + (taxPercentage / 100));
            }
            //$('#lead_total_amount').val((totalAmount * (1 + (taxPercentage / 100))).toFixed(2));
            var finalAmount = totalAmount * (1 + (taxPercentage / 100));
            $('#lead_total_amount').val(finalAmount);
        }
        $('#lead_amount, #lead_tax, input[name="tax_type"]').on('input change', calculateTotal);
        $(document).ready(function () {
            $("#taxable").on("input", function () {
                this.value = this.value.replace(/\D/g, ''); // Remove non-digit characters
            })
            $("#my_lead_price_form").validate({
                rules: {
                    lead_price: {
                        required: true,
                    },
                    tax: {
                        required: true,
                        min: 1,
                        max: 100,
                    },
                },
                messages: {
                    lead_price: {
                        required: "This field is required",
                    },
                    tax: {
                        required: "This field is required",
                        min: "Tax must be at least 1",
                        max: "Tax cannot exceed 100",
                    },
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            var closeButton = document.querySelector('.close');
            closeButton.addEventListener('click', function () {
                var modal = document.querySelector('.aligned_modal ');
                modal.style.display = 'none';
            });
        });
        $(document).ready(function () {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function () {
                var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" /> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount <= 4) {
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
                }
                phone_count++;
            });
            $(".input_fields_wrap_right").on('click', '.remove_button', function () {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1) {
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });
        $(document).on('click', '.delete_btn_photoanddoc', function() {
            var photo_id = $(this).attr('photo-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure want to delete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{url('delete_lead_document')}}/' + photo_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            if(response.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text:  'Lead Document has been Deleted.',
                                    icon:  'success',
                                    timer: 2000,
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            Swal.fire('Error!', 'Request failed: ' + errorMessage, 'error');
                        }
                    });
                }
            });
        });
        $(document).on('click', '.radio_btn_photoanddoc', function() {
            var photo_id = $(this).attr('photo-id');
            var doc_id = $(this).attr('doc-id');
            var lead_id = {{ $lead->id }};
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you want to set this image as the primary image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, want it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{url('photo_and_doc_document_primary_image')}}/' + photo_id + '/' + lead_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            if(response.success) {
                                Swal.fire({
                                    title: 'Updated!',
                                    text: 'Lead Photo And Document Primary Image Updated Successfully',
                                    icon: 'success',
                                    timer: 2000,
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            Swal.fire('Error!', 'Request failed: ' + errorMessage, 'error');
                        }
                    });
                }
            });
        });
        // $(document).ready(function() {
        //     $.validator.addMethod("noSpace", function(value, element) {
        //         return value.trim().length !== 0; // Check if the trimmed value is not an empty string
        //     }, "Spaces are not allowed.");
        //     $('#payment-form').validate({
        //         rules: {
        //             Reference_number: {
        //                 required: true,
        //                 noSpace: true
        //             },
        //             amount: {
        //                 required: true,
        //                 noSpace: true
        //             },
        //             date: {
        //                 required: true,
        //                 noSpace: true
        //             },
        //             lead_id: {
        //                 required: true,
        //                 noSpace: true
        //             },
        //             payment_type: {
        //                 required: true,
        //                 noSpace: true
        //             }
        //         },
        //         messages: {
        //             Reference_number: {
        //                 required: "Please enter Reference Number.",
        //                 noSpace: "Spaces are not allowed."
        //             },
        //             amount: {
        //                 required: "Please enter Amount.",
        //                 noSpace: "Spaces are not allowed."
        //             },
        //             date: {
        //                 required: "Please enter date.",
        //                 noSpace: "Spaces are not allowed."
        //             },
        //             lead_id: {
        //                 required: "Please select Lead first.",
        //                 noSpace: "Spaces are not allowed."
        //             },
        //             payment_type: {
        //                 required: "Please select payment type first.",
        //                 noSpace: "Spaces are not allowed."
        //             }
        //         },
        //         submitHandler: function(form) {
        //             form.submit();
        //         }
        //     });
        // });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#email_description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            // $.validator.addMethod("ckrequired", function(value, element) {
            //     if (editor) {
            //         var editorContent = editor.getData().trim();
            //         return editorContent.length !== 0;
            //     }
            //     return false;
            // }, "Description is required.");




        });

        $(document).on('click', '.add_task_modal_email_btn', function (e) {
            e.preventDefault();
            if ($('#email_form').valid()) {
                $('#email_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        $(document).on('click', '.edit-product', function (){
            var form = $(this).closest('form');
            var productContainer = form.find('.products_container');
            var productRowHTML = productContainer.find('.edit-product-item').first().clone();
            var newIndex = productContainer.find('.edit-product-item').length;
            productRowHTML.attr('data-index', newIndex);
            productRowHTML.find('input, select').each(function () {
                var element = $(this);
                var name = element.attr('name');
                if (name){
                    var newName = name.replace(/\[\d+\]/, '[' + newIndex + ']');
                    element.attr('name', newName);
                }
                var id = element.attr('id');
                if (id){
                    var newId = id.replace(/\d+/, newIndex);
                    element.attr('id', newId);
                }
            });

            productRowHTML.find('.edit-hidden-checkbox').val('0');
            productRowHTML.find('input').not(':checkbox').val('');
            productRowHTML.find('input[type="checkbox"]').prop('checked', false);
            productContainer.find('.clone_products').append(productRowHTML);
        });
        function confirmAction(url, message) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
        function confirmPaymentAction(url, message, invoiceId, amount, actionType) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Action Type:', actionType); // Debugging action type
                    $('#receive_invoice_id').val(invoiceId);
                    $('#invoice_amount').val(amount);
                    const today = new Date();
                    const formattedDate = today.toISOString().split('T')[0];
                    $('#current_date').val(formattedDate);

                    if (actionType === 'approved') {
                        console.log('Opening modal...');
                        $('#confirmPaymentModal').modal('show');
                        $('#action_type').val('approved');
                    } else {
                        console.log('Redirecting to:', url);
                        window.location.href = url;
                    }
                }
            });
        }
        $(document).on('change', '.email_template', function() {
            var templateId = $(this).val();
            cancelPendingRequest();
            $.ajax({
                url: '/getCampaignEmailTemplate/' + templateId,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('.subject_mail').val(response.subject);
                    // if (CKEDITOR.instances.mailDescription) {
                    //     CKEDITOR.instances.mailDescription.setData(response.note);
                    // }
                    $('#imageContainer').empty();
                    if (response.images.length > 0) {
                        response.images.forEach(function(image) {
                            var img = $('<img>', {
                                src: image.url,
                                height: 100,
                                width: 100,
                                alt: 'Image for ' + image.name
                            });
                            $('#imageContainer').append(img);
                        });
                    } else {
                        $('#imageContainer').append('<p>No images available for this template.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).ready(function () {
            function toggleEditButtons() {
                let activeTab = $('.details_box .nav-tabs li.active a').attr('href');
                if (activeTab === '#clientDetails') {
                    $('.edit-client-details').show();
                    $('.edit-job-details').hide();
                } else if (activeTab === '#jobDetails') {
                    $('.edit-client-details').hide();
                    $('.edit-job-details').show();
                }
            }
            toggleEditButtons();
            $('.details_box .nav-tabs a').on('shown.bs.tab', function () {
                toggleEditButtons();
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind("[data-fancybox]", {
                iframe: {
                    preload: false,
                    width: "90%",
                    height: "600px"
                },
                pdf: {
                    viewer: "https://mozilla.github.io/pdf.js/web/viewer.html?file="
                }
            });
        });
        $(document).ready(function() {
            $('.template_folder').on('change', function() {
                var id = $(this).find('option:selected').attr('email-template');
                $.ajax({
                    url: "{{ route('select_email_template') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#emailTemplateSelect').empty();
                            $('#emailTemplateSelect').append('<option value="" selected>None</option>');
                            $.each(response.template, function(index, template) {
                                $('#emailTemplateSelect').append(
                                    '<option value="' + template.id + '">' + template.title + '</option>'
                                );
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', textStatus, errorThrown);
                    }
                });
            });
        });

        $(document).on("click", ".add_change_order_modal_btn, .add_invoice_modal_btn, .add_receive_payment_modal_btn, .add_cogs_modal_btn, .add_credit_modal_btn, .add_refund_modal_btn", function(e){
            var financeModal = $(this).attr('data-finance-modal');
            var id = {{ $leadExist->id??"" }}
            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data:{
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        if (financeModal == 'change-order') {
                            $("#addChangeOrderModalBtn").modal('show');
                        } else if (financeModal == 'invoice') {
                         $("#addInvoiceModalBtn").modal('show');
                            $('#addInvoiceModalBtn').on('shown.bs.modal', function () {
                                var getLeadPrice = "{{ $leadExist->lead_price  ?? '' }}";
                                $('#addInvoiceModalBtn table tbody tr:first-child input[name="rate[]"]').val(getLeadPrice);
                                var getActivityName = "{{ $leadExist->title ?? '' }}";
                                $('#addInvoiceModalBtn table tbody tr:first-child input[name="activity_name[]"]').val(getActivityName);
                                console.log('getLeadPrice test', getLeadPrice);
                                console.log('getActivityName test', getActivityName);
                            });
                        } else if (financeModal == 'receivable') {
                            $("#addReceivePaymentModal").modal('show');
                        } else if (financeModal == 'credit') {
                            $("#addCreditModal").modal('show');
                        } else if (financeModal == 'refund') {
                            $("#addRefundModal").modal('show');
                        } else if (financeModal == 'cogs') {
                            $("#addCOGSModal").modal('show');
                        }
                    } else {
                        $("#addChangeOrderModalBtn").modal('hide');
                        $("#addInvoiceModalBtn").modal('hide');
                        $("#addReceivePaymentModal").modal('hide');
                        $("#addCOGSModal").modal('hide');
                        $("#addCreditModal").modal('hide');
                        $("#addRefundModal").modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });
        });

        $(document).on('click', '.view_refund_modal_btn', function (e) {
            var id = $(this).attr('data-refund-id');
            $.ajax({
                url: "{{route('view_refund_modal')}}",
                type: 'GET',
                data: {
                    {{--"_token": "{{ csrf_token() }}",--}}
                    'id': id
                },
                success: function (result) {
                    $('#refundShowModal').html(result);
                    $('#refundShowModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.view_credit_modal_btn', function (e) {
            var id = $(this).attr('data-credit-id');
            $.ajax({
                url: "{{route('view_credit_modal')}}",
                type: 'GET',
                data: {
                    'id': id
                },
                success: function (result) {
                    $('#creditShowModal').html(result);
                    $('#creditShowModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        {{--$(document).on('click', '.edit_credit_modal_btn', function (e) {--}}
        {{--    var id = $(this).attr('edit-credit-id');--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('edit_credit_modal')}}",--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            'id': id--}}
        {{--        },--}}
        {{--        success: function (result) {--}}
        {{--            $('#editCreditModal').html(result);--}}
        {{--            $('#editCreditModal').modal('show');--}}
        {{--        },--}}
        {{--        error: function (e) {--}}
        {{--            console.log(e.status);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        $(document).on('click', '.edit_credit_modal_btn', function (e) {
            var id = $(this).attr('edit-credit-id');
            var lead_id = {{ $leadExist->id??"" }};
            cancelPendingRequest();
            showLoadingSwal();
            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{route('edit_credit_modal')}}",
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                $('#editCreditModal').html(result);
                                $('#editCreditModal').modal('show');
                                hideLoadingSwal();
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal();
                }
            });
        });

        $(document).on('click', '.delete_credit', function (event) {
            var credit_id = $(this).attr('delete-credit-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete This Credit?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_credit') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'credit_id': credit_id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Credit has been deleted.', 'success')
                                        .then(function() {
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Credit deletion failed.', 'error');
                                }
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.edit_refund_modal_btn', function (e) {
            var id = $(this).attr('edit-refund-id');
            var lead_id = {{ $leadExist->id??"" }};
            cancelPendingRequest();
            showLoadingSwal();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        $.ajax({
                            url: "{{route('edit_refund_modal')}}",
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function (result) {
                                $('#editRefundModal').html(result);
                                $('#editRefundModal').modal('show');
                                hideLoadingSwal();
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                    hideLoadingSwal();
                }
            });
        });

        $(document).on('click', '.delete_refund', function (event) {
            var refund_id = $(this).attr('delete-refund-id');
            var lead_id = {{ $leadId ?? "" }};
            event.preventDefault();

            $.ajax({
                url: "{{ route('verify_stage_finance') }}",
                type: 'GET',
                data: {
                    id: lead_id
                },
                success: function(response) {
                    if (response.success) {
                        // Stage is valid, show confirmation dialog
                        showConfirmationDialog();
                    } else {
                        // Stage is not valid
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Stage',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while validating the stage.'
                    });
                }
            });

            function showConfirmationDialog() {
                Swal.fire({
                    title: 'Are You Sure You Want To Delete This Refund?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete_refund') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'refund_id': refund_id
                            },
                            success: function (result) {
                                if (result.status === true) {
                                    Swal.fire('Deleted!', 'Refund has been deleted.', 'success')
                                        .then(function() {
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });
                                } else {
                                    Swal.fire('Error!', 'Refund deletion failed.', 'error');
                                }
                            },
                            error: function (e) {
                                console.log(e.status);
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.view_cumulative_invoice_modal_btn', function (e) {
            var id = $(this).attr('cumulative-id');
            $.ajax({
                url: "{{route('cumulative_invoice')}}",
                type: 'GET',
                data: {
                    'id': id
                },
                success: function (result) {
                    $('#cumulativeInvoices').html(result);
                    $('#cumulativeInvoices').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#lead_material-select').change(function() {
                if ($(this).val() === 'other') {
                    $('#other-material-fields').show();
                    $('#lead_material-name, #lead_material-price')
                        .prop('required', true)
                        .prop('disabled', false); // Enable fields
                } else {
                    $('#other-material-fields').hide();
                    $('#lead_material-name, #lead_material-price')
                        .prop('required', false)
                        .prop('disabled', true) // Disable fields
                        .val(''); // Clear values
                }
            }).trigger('change'); // Initialize on page load
        });
        $(document).ready(function(){

            $('#lead_material-name').on('keyup', function() {
                var name = $('#lead_material-name').val();
                $.ajax({
                    url: "{{ route('duplicate_material_name') }}",
                    type: 'GET',
                    data: {
                        'name': name
                    },
                    success: function (result) {
                        if(result.success) {
                            $('#material_error').html('<div class="alert alert-danger">Duplicate material name found.</div>');
                            $('#lead_material-name').addClass('is-invalid');
                            $('.material_submit_btn').prop('disabled', true);
                        } else {
                            $('#material_error').html('');
                            $('#lead_material-name').removeClass('is-invalid');
                            $('.material_submit_btn').prop('disabled', false);
                        }
                    },
                    error: function (e) {
                        console.log(e.status);
                    }
                });
            });

        });
    </script>

    <script>
        $(document).on("click", "#sidebar ul > li", function(){
            let _this = $(this);
            let ul = $(_this).closest('ul');
            let id = $(ul).attr('id');

            const removeHashInterval = setInterval(() => {
                if (window.location.hash) {
                    const newUrl = window.location.href.split('#')[0];
                    history.replaceState(null, '', newUrl);
                } else {
                    clearInterval(removeHashInterval);
                }
            });

            function orderList(_this){
                $(_this).toggleClass('active');
                $(_this).find('> ul').toggleClass('in');
                if($(_this).hasClass('active')){
                    $(_this).find('> a').attr('aria-expanded','true');
                    $(_this).find('> ul').attr('aria-expanded','true');
                } else {
                    $(_this).find('ul').removeClass('in');
                    $(_this).find('> ul').removeAttr('aria-expanded');
                    $(_this).find('> a').attr('aria-expanded','false');
                }

                if($(_this).find('> ul').hasClass('in')){
                    $(_this).find('> a').attr('aria-expanded','true');
                } else {
                    $(_this).find('> a').attr('aria-expanded','false');
                }
            }

            function orderListParent(_this){
                $(_this).closest('li').toggleClass('active');

                // if(!$(_this).closest('ul').closest('li').hasClass('active')) {
                //     $(_this).find('a').attr('aria-expanded', 'false');
                // }
                //console.log($(_this).closest('ul').closest('li'))
            }

            $(_this).find('a').on('click', function(){
                let url = $(this).attr('href');
                window.location.href = url;
            });

            if($(ul).hasClass('submenu') && $(ul).hasClass('collapse')){
                orderList(_this);
                orderListParent(_this);
            }

            if(id == 'side-menu'){
                orderList(_this);
            } else {
                return false;
            }
        });


    </script>
    <script>
        $(document).ready(function () {
            ['#taskDescription', '#taskDescriptionEdit'].forEach(selector => {
                ClassicEditor.create(document.querySelector(selector)).catch(console.error);
            });
        });
        $(document).on('click', '.appointment_modal_btn', function (e) {
            e.preventDefault();

            // This will trigger jQuery Validation properly
            $('.MyAppointment').submit();
        });
        $(document).on('click', '.new_estimate_modal_btn', function (e) {
            e.preventDefault();

            // This will trigger jQuery Validation properly
            $('.new_estimate_modal_wrap').submit();
        });


        $(document).ready(function () {
            ClassicEditor
                .create(document.querySelector('.add_message_text_wrap'))
                .then(editor => {
                    // Remove required attribute from the original textarea

                    // Handle form submission validation
                    const form = document.querySelector('#messagevalidatesss'); // Adjust selector as needed
                    form.addEventListener('submit', function(e) {
                        const data = editor.getData();
                        if (!data.trim()) {
                            e.preventDefault();
                            alert('Message is required');
                            editor.focus();
                            return false;
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
        // Add noSpace method if needed
        $.validator.addMethod("noSpace", function(value, element) {
            return this.optional(element) || value.indexOf(" ") < 0;
        }, "No spaces allowed.");
        // Validate form
        $('#task-form').validate({
            ignore: [],
            rules: {
                title: {
                    required: true,
                    noSpace: true
                },
                'assign_to_user_id[]': {
                    required: true,
                    minlength: 1  // at least one user must be selected
                },
                priority_id: {
                    required: true
                },
                assign_to_lead_id: {
                    required: true
                },
                // assign_to_team_id: {
                //     required: true
                // },
                // description: {
                //     taskDescription: true
                // }
            },
            messages: {
                title: {
                    required: "Please enter Title.",
                    noSpace: "Spaces are not allowed."
                },
                'assign_to_user_id[]': {
                    required: "Please select at least one user.",
                    minlength: "Please select at least one user."
                },
                priority_id: {
                    required: "Please select Priority First."
                },
                assign_to_lead_id: {
                    required: "Please Assign Lead."
                },
                // assign_to_team_id: {
                //     required: "Please Assign Team."
                // },
                // description: {
                //     taskDescription: "Message field is required"
                // }
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    // Place error after the Select2 container
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },

            // highlight: function(element) {
            //     if ($(element).hasClass('select2-hidden-accessible')) {
            //         $(element).next('.select2-container').addClass('is-invalid'); // bootstrap example
            //     } else {
            //         $(element).addClass('is-invalid');
            //     }
            // },
            // unhighlight: function(element) {
            //     if ($(element).hasClass('select2-hidden-accessible')) {
            //         $(element).next('.select2-container').removeClass('is-invalid');
            //     } else {
            //         $(element).removeClass('is-invalid');
            //     }
            // },

            submitHandler: function(form) {
                form.submit();
            }
        });
        $('.emailvalidate').validate({
            ignore: [],
            rules: {
                template_folder_id: {
                    required: true
                },
                subject: {
                    required: true,
                    noSpace: true
                },
                // message: {
                //     required: true
                // }
            },
            messages: {
                template_folder_id: {
                    required: "Please select an email folder."
                },
                subject: {
                    required: "Please enter subject.",
                    noSpace: "Spaces are not allowed."
                },
                // message: {
                //     required: "Please enter message."
                // }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container')); // place after Select2
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $.validator.addMethod("dateAfter", function (value, element, params) {
            var fromDate = $(params).val();
            return !fromDate || new Date(value) >= new Date(fromDate);
        }, 'End date must be after start date.');

        $('.MyAppointment').validate({
            ignore: [],
            rules: {
                customer_id: {
                    required: true
                },
                title: {
                    required: true,
                    noSpace: true
                },
                // location: {
                //     required: true
                // },
                date_time_to: {
                    required: true,
                    dateAfter: '#date_time_from'  // Custom rule for comparing dates
                },
                date_time_from: {
                    required: true
                },
                appointment_for_lead_id: {
                    required: true
                },
                'attendees_user_id[]': {
                    required: true
                },
                'taskName':{
                  required:true
                },
                'attendees_lead_id[]': {
                    required: true
                }
            },
            messages: {
                customer_id: {
                    required: "Please select Customer First."
                },
                title: {
                    required: "Please enter Title.",
                    noSpace: "Spaces are not allowed."
                },
                // location: {
                //     required: "Please add Address"
                // },
                date_time_to: {
                    required: "Please select date to",
                    dateAfter: "End date must be greater than or equal to start date."
                },
                date_time_from: {
                    required: "Please select date from"
                },
                appointment_for_lead_id: {
                    required: "Please select for"
                },
                taskName: {
                    required: "Please Enter Task Name"
                },
                'attendees_user_id[]': {
                    required: "Please select Attendees"
                },
                'attendees_lead_id[]': {
                    required: "Please select Attendees Lead"
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container')); // place after Select2
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var appointment_for_lead_id = $('.appointment_for_lead_id').val();
                if (appointment_for_lead_id === 'no_data_found' || appointment_for_lead_id === '0') {
                    Swal.fire({
                        title: "Lead Not Found",
                        html: "Please Choose Different Customer",
                        icon: "warning",
                        timer: 5000,
                        buttons: false
                    });
                } else {
                    form.submit();
                }
            }
        });

        $('.new_estimate_modal_wrap').validate({
            ignore: [], // Important to not ignore hidden fields (like Select2)
            rules: {
                lead_id: {
                    required: true
                }
                // Add more rules here if needed
            },
            messages: {
                lead_id: {
                    required: "Please select a lead"
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                const dropzoneInstance = Dropzone.forElement("#estimatedropzone");

                if (dropzoneInstance.files.length === 0) {
                    Swal.fire({
                        title: "Missing Attachment",
                        html: "Please upload at least one photo or document.",
                        icon: "warning",
                        timer: 3000
                    });
                    return false;
                }

                form.submit();
            }
        });
        $("#invoice_form").validate({
            ignore: [],
            rules: {
                lead_id: "required",
                address: "required",
                activity_name: {
                    required: true,
                    noSpace: true
                },

            },
            messages: {
                lead_id: {
                    required: "Please enter your Lead ID",
                },
                address: {
                    required: "Please enter your Address",
                },
                activity_name: {
                    required: "Activity name is required.",
                    noSpace: "Activity name is required."
                },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        // $(document).on('click', '.add_invoice_modal_btn', function (e) {
        //     e.preventDefault();
        //
        //     // This will trigger jQuery Validation properly
        //     $('#invoice_form').submit();
        // });

        // Submit form from modal
        // material submit form
        $(document).on('click', '.add_material_submit_btn', function (e) {
            e.preventDefault();
            if ($('#material-form').valid()) {
                $('#material-form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        // contract submit form
        $(document).on('click', '.add_contract_submit_btn', function (e) {
            e.preventDefault();
            if ($('.add_contract_form').valid()) {
                $('.add_contract_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        // permits Submit form
        $(document).on('click', '.add_permits_submit_btn', function (e) {
            e.preventDefault();
            if ($('#document-form').valid()) {
                $('#document-form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        // warranties Submit Form
        $(document).on('click', '.add_warranties_submit_btn', function (e) {
            e.preventDefault();
            if ($('#document-form-warrienties').valid()) {
                $('#document-form-warrienties').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        $(document).on('click', '.save_job_price_form', function (e) {
            e.preventDefault();
            if ($('#my_lead_price_form').valid()) {
                $('#my_lead_price_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        $(".select_disabled_assign_lead").prop("disabled", true);
        $(".select_disabled_customer").prop("disabled", true);



    </script>


    <script>

        function validateReceivable() {
            let isChecked = false;
            let isAmountFilled = false;
            $(".order-checkbox").each(function() {
                if ($(this).is(":checked")) {
                    isChecked = true;
                    const paidAmount = $(this).closest('.invoice_container').find('.paid_amount').val();
                    if (paidAmount && parseFloat(paidAmount) > 0) {
                        isAmountFilled = true;
                        $('.invoice_limit_error').hide();
                    }
                }
            });
            if (!isChecked) {
                $('.invoice_limit_error').show();
                return false;
            }
            if (!isAmountFilled) {
                $('.invoice_limit_error').hide();
                return false;
            }
            return true;
        }
        $("#payment-form").on("submit", function(e) {
            if (!validateReceivable()) {
                e.preventDefault();
            }
        });
        // Assign lead Select replace with  readonly Input
        $(window).on('load', function () {
            $('.modal').on('shown.bs.modal', function () {
                var modal = $(this);
                var selectElement = modal.find('.assign_lead_readonly');
                if (selectElement.is('select')) {
                    var selectedOption = selectElement.find('option:selected');
                    var selectedOptionVal = selectedOption.val();
                    var inputName = selectElement.attr('name');
                    var input = $('<input>').attr('type', 'hidden')
                        .attr('name', inputName)
                        .val(selectedOptionVal);
                    modal.find('input[name="' + inputName + '"]').remove();
                    selectElement.removeAttr('name');
                    selectElement.css('pointer-events', 'none');
                    modal.find('form').append(input);
                    selectElement.removeClass('custom_modal_select2');
                }
            });
        });


    </script>

    <script>
        $(document).on('click', '#send-invoices', function (){
           var lead = $(this).data('lead-id');
            $.ajax({
                url: "{{ url('send_invoices') }}",
                type: 'GET',
                data: {
                    'id': lead
                },
                success: function (result) {
                    if(result.message == 'success'){
                        Swal.fire("Email Delivered Successfully");
                    }else{
                        Swal.fire("Email Delivery Failed");
                    }
                },
                error: function (e) {
                }
            });
        });

        document.getElementById('printBtn').addEventListener('click', function () {
            // Create a hidden iframe
            var iframe = document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.width = '0px';
            iframe.style.height = '0px';
            iframe.style.border = 'none';
            iframe.style.visibility = 'hidden';

            document.body.appendChild(iframe);

            // Get iframe document
            var iframeDoc = iframe.contentWindow.document;

            // Get modal content
            var modalElement = document.getElementById('allInvoicesModal');

            // Clone modal content and remove scripts
            var modalClone = modalElement.cloneNode(true);
            var scripts = modalClone.querySelectorAll('script');
            scripts.forEach(function(script) {
                script.parentNode.removeChild(script);
            });

            // Remove hide_print elements
            var hidePrint = modalClone.querySelectorAll('.hide_print');
            hidePrint.forEach(function(element) {
                element.parentNode.removeChild(element);
            });

            // Work with iframe's existing document structure
            var head = iframeDoc.head;
            var body = iframeDoc.body;

            // Add title
            var title = iframeDoc.createElement('title');
            title.textContent = 'Invoices';
            head.appendChild(title);

            // Add Bootstrap CSS
            var link = iframeDoc.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
            head.appendChild(link);

            // Add custom styles
            var style = iframeDoc.createElement('style');
            style.textContent = `
        body { margin: 20px; padding: 20px; }
        .hide_print { display: none !important; }
        .modal { display: block !important; position: static !important; }
        .modal-dialog { margin: 0 !important; max-width: 100% !important; }
    `;
            head.appendChild(style);

            // Add content to body
            body.innerHTML = modalClone.innerHTML;

            // Flag to track if print was already triggered
            var printTriggered = false;

            // Wait for CSS to load then print
            link.onload = function() {
                if (!printTriggered) {
                    printTriggered = true;
                    setTimeout(function() {
                        iframe.contentWindow.focus();
                        iframe.contentWindow.print();

                        // Clean up
                        setTimeout(function() {
                            if (iframe.parentNode) {
                                document.body.removeChild(iframe);
                            }
                        }, 500);
                    }, 300);
                }
            };
        });
    </script>

    <script>
        $(document).on('click', '#send-cumulative', function (){
            var lead = $(this).data('lead-id');
            $.ajax({
                url: "{{ url('send_cumulative_invoice') }}",
                type: 'GET',
                data: {
                    'id': lead
                },
                success: function (result) {
                    if(result.message == 'success'){
                        Swal.fire("Email Delivered Successfully");
                    }else{
                        Swal.fire("Email Delivery Failed");
                    }
                },
                error: function (e) {
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#confirmSendEmail', function (){
            var subject = $('#emailSubject').val();
            var message = $('#emailMessage').val();

            if(!subject || !message) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Fields',
                    text: 'Please fill in both subject and message'
                });
                return;
            }

            $(this).prop('disabled', true).text('Sending...');

            $.ajax({
                url: "{{ url('send_invoice_single') }}",
                type: 'POST',
                data: {
                    'id': selectedInvoiceId,
                    'subject': subject,
                    'message': message,
                    '_token': '{{ csrf_token() }}'
                },
                success: function (result) {
                    $('#emailContentModal').modal('hide');
                    $('#viewInvoiceModal').modal('hide');
                    $('#confirmSendEmail').prop('disabled', false).text('Send Email');

                    if(result.message == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Delivered Successfully'
                        });
                        $('#emailContentForm')[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email Delivery Failed'
                        });
                    }
                },
                error: function (e) {
                    $('#emailContentModal').modal('hide');
                    $('#confirmSendEmail').prop('disabled', false).text('Send Email');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!'
                    });
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#send-cogs-detail', function (){
            var lead = $(this).data('lead-id');
            $.ajax({
                url: "{{ url('send_cogs_detail') }}",
                type: 'GET',
                data: {
                    'id': lead
                },
                success: function (result) {
                    if(result.message == 'success'){
                        Swal.fire("Email Delivered Successfully");
                    }else{
                        Swal.fire("Email Delivery Failed");
                    }
                },
                error: function (e) {
                }
            });
        });

    </script>

    <script>
        $(document).on('click', '#send-balance-sheet', function (){
            var lead = $(this).data('lead-id');
            $.ajax({
                url: "{{ url('send_balance_sheet') }}",
                type: 'GET',
                data: {
                    'id': lead
                },
                success: function (result) {
                    if(result.message == 'success'){
                        Swal.fire("Email Delivered Successfully");
                    }else{
                        Swal.fire("Email Delivery Failed");
                    }
                },
                error: function (e) {
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let total = 0;

            $('.earning').each(function() {
                let text = $(this).text().replace(/[^0-9.-]+/g, "");
                let value = parseFloat(text);
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#totalEarningsDisplay').text('Total Staff Earnings: $' + total.toFixed(2));
            let netAmount = $('#net_profit_amount').text().replace(/[^0-9.-]+/g, "");
            let netAmountParsed = parseFloat(netAmount) - total;
            let finalAmount = netAmountParsed.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            $('#net_profit_amount').text('$' + finalAmount);

            let leadPrice = parseFloat($('#leadPriceAmount').val()) || 0;
            let changeOrder = parseFloat($('#changeOrderAmount').val()) || 0;
            let cost = parseFloat($('#costAmount').val()) || 0;
            let commission = parseFloat($('#commissionAmount').val()) || 0;

            // Calculate final percentage with staff earnings subtracted
            let numerator = (leadPrice + changeOrder) - cost - commission - total;
            let denominator = Math.max(leadPrice + changeOrder, 1);

            let finalPercentage = (numerator / denominator) * 100;

            // Show it
            $('#finalPercentage').text(finalPercentage.toFixed(2) + '%');
        });
    </script>

@endpush
