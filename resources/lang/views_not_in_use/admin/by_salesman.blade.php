@extends('layouts.master')

@push('css')

<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endpush

@section('content')

    <section class="sales_performance_tabs_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="job_title">
                        <h2>{{$lead->title??""}}</h2>
                        <span>({{$appointmentCounts??"0"}} Appointment)</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="inner_section_sales_performance_tabs px-3 py-3 borderRadius20 cards_padding mt-5">
                        <div class="main_heading">
                            <h5>Sales Performance Report</h5>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Jobs Won</a></li>
                            <li><a data-toggle="tab" href="#menu1">Performance (#)</a></li>
                            <li><a data-toggle="tab" href="#menu2">By Salesman</a></li>
                            <li><a data-toggle="tab" href="#menu2">Summary</a></li>
                            <li><a data-toggle="tab" href="#menu2">Job Listing (#)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sales_performance_tabs_content_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="tab-content">
                        <div id="home" class="tab-pane active in">
                            <div class="customer_details_activities cards_padding mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="inner_section_timeline">
                                            <form action="{{route('stages_update')}}" method="GET" id="stage_form" class="stage_form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="timelines">
                                                    @forelse($stages->sortBy('position') as /*$key =>*/ $value)
                                                        <div class="single_timeline  @if($loop->iteration < $lead->stage_position) checked @endif" data-index="{{ $loop->iteration }}">
                                                            <input class="single_timeline_radio" id="timeline_{{$loop->iteration}}"  value="{{ $value->id}}"  type="checkbox" name="stage_id">
                                                            <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                            <style>
                                                                .timelines .single_timeline.checked[data-index="{{$loop->iteration}}"] .timeline_title:after {@if($loop->iteration <= $lead->stage_position) background-color: {{$value->colour_id}} @endif}
                                                                .timelines .single_timeline.checked[data-index="{{$loop->iteration}}"] .timeline_bar:before {@if($loop->iteration <= $lead->stage_position) background-color: {{$value->colour_id}}; border-color: {{$value->colour_id}} @endif}
                                                            </style>
                                                            <div class="timeline_title" style="@if($loop->iteration <= $lead->stage_position) background-color: {{$value->colour_id}} @endif">
                                                                <span>{{$value->name??""}}</span>
                                                            </div>
                                                            <div class="timeline_bar" style="@if($loop->iteration <= $lead->stage_position) background-color: {{$value->colour_id}} @endif"></div>
                                                            <div class="timeline_date">
                                                                @php
                                                                    @$dateUpdated = \Carbon\Carbon::parse($lead->updated_at);
                                                                    @$date = \Carbon\Carbon::now();
                                                                    @$formattedDate = $date->format('j F Y'); //"2 April 2023"
                                                                    @$formatted = $dateUpdated->format('j F Y'); //"2 April 2023"
                                                                @endphp
                                                                <span class="completed_timeline">Completed</span>
                                                                <span class="completed_timeline">{{$formatted??""}}</span>
                                                                <span class="dated">{{$formattedDate??""}}</span>
                                                            </div>
                                                        </div>

                                                    @empty
                                                        <?php for($i=1; $i <= 30; $i++) { ?>
                                                        <div class="single_timeline" data-index="{{ $i }}">
                                                            <input class="single_timeline_radio" id="timeline_<?php echo $i ?>" type="checkbox" name="">
                                                            <div class="timeline_title">
                                                                <span>Lead</span>
                                                            </div>
                                                            <div class="timeline_bar"></div>
                                                            <div class="timeline_date">
                                                                <span class="completed_timeline">Completed</span>
                                                                <span class="dated">09/07/2022</span>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    @endforelse
                                                </div>


                                                <input id="timeline_submit_btn" class="btn timeline_submit_btn" type="submit" value="Submit">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <div class="inner_section_job_contact card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                            <div class="main_heading">
                                                <h5>Job Price</h5>
                                            </div>
                                            <button type="button" class="btn green_btn w-25" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                Job Price
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Job Price</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="myModal">
                                                            <form action="{{route('update_lead_price')}}" method="POST" id="my_lead_price_form">
                                                                @csrf
                                                                <input name="lead_id" value="{{ $lead->id }}" type="hidden">
                                                                <div class="mb-3 px-5">
                                                                    <div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="tax_type" id="taxableRadio" value="taxable" checked>
                                                                            <label class="form-check-label" for="taxableRadio">Taxable</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline px-5">
                                                                            <input class="form-check-input" type="radio" name="tax_type" id="tax_exemptRadio" value="tax_exempt">
                                                                            <label class="form-check-label" for="tax_exemptRadio">Tax Exempt</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3" id="taxableInputDiv">
                                                                    <label for="taxable" class="form-label">Amount:</label>
                                                                    <input type="number" class="form-control" id="taxable" value="{{$lead->lead_price??""}}" name="lead_price" placeholder="Enter taxable">
                                                                </div>
                                                                <div class="mb-3" id="taxInputDiv">
                                                                    <label for="tax" class="form-label">Tax (in percentage):</label>
                                                                    <input type="number" class="form-control" name="tax" id="tax" placeholder="Enter tax percentage" value="{{$lead->tax??""}}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="lead_price" class="form-label">Total Amount:</label>
                                                                    <input name="lead_price" type="number" class="form-control"  id="lead_price" value="{{$lead->lead_price??""}}" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button id="submitBtn" class="btn btn-primary" type="submit">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner_section_customer_details card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                                            <div class="main_heading">
                                                <h5>Customer Details</h5>
                                            </div>
                                            <div class="sub_heading">
                                                <h6>Lead Information</h6>
                                            </div>
                                            <div class="customer_details">
                                                <div class="map">
                                                    <div class="icon">
                                                        <a href="#!">
                                                            <img src="{{asset('website')}}/images/location_icon.png" alt="location_icon">
                                                            @if(isset($lead) && $lead->customer->profile->address) {{$lead->customer->profile->address??""}}, {{$lead->customer->profile->city??""}}, {{$lead->customer->profile->state??""}}, {{$lead->customer->profile->country??""}}, {{$lead->customer->profile->zip??""}}. @else Not Available @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="phone">
                                                    <div class="icon">
                                                        @if(isset($lead) && $lead->customer->profile->phone)
                                                            <a href="tel:{{$lead->customer->profile->phone??""}}">
                                                                <img src="{{asset('website')}}/images/phone_icon.png" alt="location_icon">
                                                                CELL {{$lead->customer->profile->phone??"Not Available"}}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="email">
                                                    <div class="icon">
                                                        @if(isset($lead) && $lead->customer->profile->email)
                                                            <a href="{{$lead->customer->email??""}}">
                                                                <img src="{{asset('website')}}/images/email_icon.png" alt="location_icon">
                                                                {{$lead->customer->email??"Not Available"}}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="add_flags_btn">--}}
                                            {{--<a class="btn green_btn borderRadius" href="javascript:void(0)">--}}
                                            {{--+ Add Flags--}}
                                            {{--</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 activities_col">
                                        <div  class="inner_section_activities card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                                            <div class="heading_btn_wrapper">
                                                <div class="main_heading">
                                                    <h5>Activities</h5>
                                                </div>
                                                <div class="view_all_btn">
                                                    <a class="btn green_btn borderRadius" href="{{url('logActivity')}}">View All</a>
                                                </div>
                                            </div>
                                            <div class="activities">
                                                @forelse($logs as $key => $log)
                                                    {{--@php--}}
                                                    {{--@$url_parts = explode('/', $log->url);--}}
                                                    {{--@$value_after_slash = $url_parts[5];--}}
                                                    {{--@$url_parts = explode('/', $log->url);--}}
                                                    {{--@$last_segment = end($url_parts);--}}
                                                    {{--@endphp--}}
                                                    {{--@if($value_after_slash == 'logActivity' || $value_after_slash == 'delete_logs' || $value_after_slash == 'delete_stream' || $last_segment == 'delete_stream' || is_numeric($last_segment)) @continue @endif--}}
                                                    <div class="activity">
                                                        {{--<div class="custom_checkbox">--}}
                                                        {{--<input id="activity_{{$key}}" type="checkbox" onClick="toggle(this)" name="" id="">--}}
                                                        {{--<label class="custom_check" for="activity_{{$key}}">@if($log->user->name == 'User') Admin @else {{ $log->user->name??"" }} @endif visits  @if($last_segment == 'public') home page @else {{ $value_after_slash??"" }} @endif sections</label>--}}
                                                        {{--</div>--}}
                                                        <div class="activity_box">
                                                            <a href="{{route('delete_logs')}}/{{ $log->id??"" }}" class="btn activity_delect_btn"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                                            <span>@if($log->log_name == 'User') Admin  @else {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $log->log_name) }} @endif {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', $log->description) }}</span>
                                                            {{--<span>@if($log->user->name == 'User') Admin @else {{ $log->user->name??"" }} @endif visits  @if($last_segment == 'public') home page @else {{ $last_segment??"" }} @endif sections</span>--}}
                                                            {{--<span> Admin  visits   {{ $value_after_slash??"" }}  sections</span>--}}
                                                            {{--<span>{{$log->url??""}}</span>--}}
                                                        </div>
                                                    </div>
                                                @empty
                                                    {{--<?php for ($i=1; $i <=6; $i++){ ?>--}}
                                                    {{--<div class="activity">--}}
                                                    {{--<div class="custom_checkbox">--}}
                                                    {{--<input id="activity_<?php echo $i ?>" type="checkbox" onClick="toggle(this)" name="" id="">--}}
                                                    {{--<label class="custom_check" for="activity_<?php echo $i ?>">Focus on tasks that have to be done, without missing any details.</label>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<?php } ?>--}}
                                                    <div class="activity">
                                                        <div class="custom_checkbox">
                                                            <label class="custom_check">No Activities Found</label>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="other_info_sec cards_padding mt-5 pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <ul class="nav nav-pills m-b-30 ">
                                                    <li class="active"><a href="#navpills-1" data-toggle="tab" aria-expanded="false">Other Information
                                                        </a>
                                                    </li>
                                                    <li class=""><a href="#navpills-2" data-toggle="tab" aria-expanded="false">Task</a></li>
                                                </ul>
                                                <div class="tab-content br-n pn">
                                                    <div id="navpills-1" class="tab-pane active">
                                                        <div class="inner_section_col_left">
                                                            <div class="row m-0">
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_other_info card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                                                                        <div class="main_heading">
                                                                            <h5>Other Information </h5>
                                                                        </div>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-borderless">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th>Representative by:</th>
                                                                                    <td>{{$lead->representative->name??"Not Available"}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Lead Category:</th>
                                                                                    <td>{{$lead->category->name??"Not Available"}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Other Information:</th>
                                                                                    <td>{!! $lead->other_information??"Not Available" !!}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Duration Days:</th>
                                                                                    <td>{{$lead->duration_days??"Not Available"}} Days</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Duration Hours:</th>
                                                                                    <td>{{$lead->duration_hours??"Not Available"}} Hours</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Duration Minutes:</th>
                                                                                    <td>{{$lead->duration_minutes??"Not Available"}} Minutes</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Job Description:</th>
                                                                                    <td>{!! $lead->description??"Not Available" !!}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Job Address:</th>
                                                                                    <td>{!! $lead->address??"Not Available" !!}</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_job_contact card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                                                        <div class="main_heading">
                                                                            <h5>Job Contact Person</h5>
                                                                        </div>
                                                                        <div class="txt_content">
                                                                            <p class="p-16"><i class="fa-solid fa-user"></i>{{$lead->contact_person??"Not Available"}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_job_contact card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                                                        <div class="main_heading">
                                                                            <h5>Billing Details</h5>
                                                                        </div>
                                                                        <div class="txt_content">
                                                                            <p class="p-16"><i class="fa-solid fa-user"></i>@if(isset($lead) && $lead->customer->name) {{$lead->customer->name??"Not Available"}} @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-location-dot"></i> @if(isset($lead) && $lead->customer->profile->address) {{$lead->customer->profile->address??""}}, {{$lead->customer->profile->city??""}}, {{$lead->customer->profile->state??""}}, {{$lead->customer->profile->country??""}}, {{$lead->customer->profile->zip??""}}. @else Not Available @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-phone"></i> CELL @if(isset($lead) && $lead->customer->profile->phone) {{$lead->customer->profile->phone??"Not Available"}} @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-envelope"></i> @if(isset($lead) && $lead->customer->email) {{$lead->customer->email??"Not Available"}} @endif</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="navpills-2" class="tab-pane">
                                                        <div class="inner_section_col_left">
                                                            <div class="row m-0">
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_other_info card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                                                                        <div class="heading_btn_wrapper">
                                                                        <div class="main_heading">
                                                                                <h5>Tasks</h5>
                                                                        </div>
                                                                            <div class="d-flex justify-content-end ">
                                                                                <a href="{{ url('task/task/create')  }}" class="btn green_btn borderRadius">Add Task</a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="table-responsive">
                                                                            <table class="table table-borderless">
                                                                                <tbody>
                                                                                <thead>
                                                                                <tr>
                                                                                    <th style="width: 20%;">Task Title: </th>
                                                                                    <td>High Priority</td>
                                                                                    <td>Due Date</td>
                                                                                    <td>Created At</td>
                                                                                    <td>Action</td>
                                                                                <tr>
                                                                                </thead>
                                                                                      @forelse($lead->getTasks as $key => $task)
                                                                                            <tr>
                                                                                                <th style="width: 20%;">{{$task->title??""}}</th>
                                                                                                <td>@if($task->high_priority == 'yes') yes @else no @endif</td>
                                                                                                <td>{{$task->due_date? date('d M Y', strtotime($task->due_date)) : 'Not Avalible' }} </td>
                                                                                                <td>{{$task->created_at? date('d M Y', strtotime($task->created_at)) : 'Not Avalible' }}</td>
                                                                                                <td>
                                                                                                    <button type="button" class="btn green_btn borderRadius task_modal_btn"  task-id="{{$task->id}}" data-toggle="modal" data-target="#taskModal">View</button>
                                                                                                </td>
                                                                                            </tr>
                                                                                      @empty
                                                                                            <tr><td colspan="3">No Data Available</td></tr>
                                                                                      @endforelse
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_job_contact card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                                                        <div class="main_heading">
                                                                            <h5>Job Contact Person</h5>
                                                                        </div>
                                                                        <div class="txt_content">
                                                                            <p class="p-16"><i class="fa-solid fa-user"></i>{{$lead->contact_person??"Not Available"}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="inner_section_job_contact card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                                                        <div class="main_heading">
                                                                            <h5>Billing Details</h5>
                                                                        </div>
                                                                        <div class="txt_content">
                                                                            <p class="p-16"><i class="fa-solid fa-user"></i>@if(isset($lead) && $lead->customer->name) {{$lead->customer->name??"Not Available"}} @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-location-dot"></i> @if(isset($lead) && $lead->customer->profile->address) {{$lead->customer->profile->address??""}}, {{$lead->customer->profile->city??""}}, {{$lead->customer->profile->state??""}}, {{$lead->customer->profile->country??""}}, {{$lead->customer->profile->zip??""}}. @else Not Available @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-phone"></i> CELL @if(isset($lead) && $lead->customer->profile->phone) {{$lead->customer->profile->phone??"Not Available"}} @endif</p>
                                                                            <p class="p-16"><i class="fa-solid fa-envelope"></i> @if(isset($lead) && $lead->customer->email) {{$lead->customer->email??"Not Available"}} @endif</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="inner_section_col_right">
                                            <div class="row m-0">
                                                <div class="col-md-12 p-0">
                                                    <div class="inner_section_recent_photo card border-0 px-3 py-3 borderRadius20 box-shadow-card">

                                                        <div class="heading_btn_wrapper">
                                                            <div class="main_heading">
                                                                <h5>Leads Photo & Document</h5>
                                                            </div>
                                                            <div class="view_all_btn">
                                                                <a href="{{ url('photoAndDocument/photo-and-document/create')  }}" class="btn green_btn borderRadius">Add Photo and Documents</a>
                                                            </div>
                                                        </div>
                                                        <div class="files_wrapper">
                                                            <div class="row">
                                                           @if(isset($lead) && $lead->getphotoandDocument)
                                                                @forelse($lead->getphotoandDocument as $key => $photoDocuments)
                                                                      @foreach($photoDocuments->getDocuments  as $photoDocument)
                                                                        <div class="col-md-4">
                                                                            <a href="{{asset('website')}}/{{$photoDocument->name}}" target="_blank">
                                                                                <div class="file">
                                                                                    {{--<img id="file1" src="{{asset('website')}}/images/files_icon.png" alt="">--}}
                                                                                    {{--<input type="file" name="" id="recent_doc_1" oninput="file1.src=window.URL.createObjectURL(this.files[0])">--}}
                                                                                    @if(isset($photoDocument->name) && in_array(array_reverse(explode('.',$photoDocument->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                                                        <img src="{{asset('website')}}/{{$photoDocument->name}}">
                                                                                    @elseif(isset($photoDocument->name) && in_array(array_reverse(explode('.',$photoDocument->name))[0],['pdf']) )
                                                                                        <img src="{{ asset('/website/images').'/pdf.png' }}">
                                                                                    @elseif(isset($photoDocument->name) && in_array(array_reverse(explode('.',$photoDocument->name))[0],['doc','docx','txt']))
                                                                                        <img src="{{ asset('/website/images').'/Word-Logo.png' }}">
                                                                                    @else
                                                                                        <img src="{{ asset('/website/images').'/image.png' }}">
                                                                                    @endif
                                                                                    <span> View/Download </span>
                                                                                </div>
                                                                            </a>
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
                                                            {{--<div class="col-md-4">--}}
                                                            {{--<div class="file">--}}
                                                            {{--<img id="file2" src="{{asset('website')}}/images/files_icon.png" alt="">--}}
                                                            {{--<input type="file" name="" id="recent_doc_2" oninput="file2.src=window.URL.createObjectURL(this.files[0])">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            <!-- <div class="col-md-4 btn_col">
                                                                <div class="upload_btn">
                                                                    <a id="recent_photo_upload_more" class="btn green_btn borderRadius" href="javascript:void(0)">Upload New File</a>
                                                                </div>
                                                            </div> -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 p-0">
                                                    <div
                                                            class="inner_section_last_messages card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">

                                                        <div class="heading_btn_wrapper">
                                                            <div class="main_heading">
                                                                <h5>Last Messages</h5>
                                                            </div>
                                                            <div class="view_all_btn">
                                                                <a class="btn green_btn borderRadius"
                                                                   href="javascript:void(0)">View All</a>
                                                            </div>
                                                        </div>

                                                        <div class="messages">
                                                            <div class="message">
                                                                <div class="msg_date">
                                                                    <span>03/07/2022</span>
                                                                </div>
                                                                <div class="msg_content_time_wrapper">
                                                                    <div class="msg_content">
                                                                        <p>Focus on tasks that have to be done, without
                                                                            missing any details.</p>
                                                                    </div>
                                                                    <div class="msg_time">
                                                                        <p>09:25 Am</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="message">
                                                                <div class="msg_date">
                                                                    <span>03/07/2022</span>
                                                                </div>
                                                                <div class="msg_content_time_wrapper">
                                                                    <div class="msg_content">
                                                                        <p>Focus on tasks that have to be done, without
                                                                            missing any details.</p>
                                                                    </div>
                                                                    <div class="msg_time">
                                                                        <p>09:25 Am</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="message">
                                                                <div class="msg_date">
                                                                    <span>03/07/2022</span>
                                                                </div>
                                                                <div class="msg_content_time_wrapper">
                                                                    <div class="msg_content">
                                                                        <p>Focus on tasks that have to be done, without
                                                                            missing any details.</p>
                                                                    </div>
                                                                    <div class="msg_time">
                                                                        <p>09:25 Am</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="message">
                                                                <div class="msg_date">
                                                                    <span>03/07/2022</span>
                                                                </div>
                                                                <div class="msg_content_time_wrapper">
                                                                    <div class="msg_content">
                                                                        <p>Focus on tasks that have to be done, without
                                                                            missing any details.</p>
                                                                    </div>
                                                                    <div class="msg_time">
                                                                        <p>09:25 Am</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="last_email_sec cards_padding mt-5 pt-0">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="inner_section_other_info card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5">
                                            <div class="heading_btn_wrapper">
                                            <div class="main_heading">
                                                <h5>Appointments</h5>
                                            </div>
                                                <div class="d-flex justify-content-end ">
                                                    <a href="{{ url('appointment/appointment/create')  }}" class="btn green_btn borderRadius">Add Appointment</a>
                                                </div>
                                            </div>



                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 20%;">Appointment Title: </th>
                                                            <td>Customer</td>
                                                            <td>Lead Name</td>
                                                            <td>Location</td>
                                                            <td>Appointment Start</td>
                                                            <td>Appointment End</td>
                                                            <td>Status</td>
                                                            <td>Action</td>
                                                        <tr>
                                                    </thead>
                                                    @forelse($appointments as $key => $appointment)
                                                        <tr>
                                                            <th style="width: 20%;">{{$appointment->title??""}}</th>
                                                            <td>{{$appointment->getCustomer->name??""}}</td>
                                                            <td>{{$appointment->getLead->title??""}}</td>
                                                            <td>{{$appointment->location??""}}</td>

                                                            <td>Time :{{ $appointment->date_time_from ? date('h:i A', strtotime($appointment->date_time_from)) : 'Not Available' }} <br> Date: {{ $appointment->date_time_from ? date('d M Y', strtotime($appointment->date_time_from)) : 'Not Available' }} </td>
                                                            <td>Time :{{ $appointment->date_time_to ? date('h:i A', strtotime($appointment->date_time_to)) : 'Not Available' }} <br> Date: {{ $appointment->date_time_to ? date('d M Y', strtotime($appointment->date_time_to)) : 'Not Available' }} </td>
                                                            <td>
                                                                @if($appointment->status == 1 )
                                                                    <P class="badge badge-success">Active</P>
                                                                @else
                                                                    <P class="badge badge-warning">Inactive</P>
                                                                @endif
                                                            </td>
                                                            <td><button type="button" class="btn green_btn borderRadius attendees_modal_btn" appointment-id="{{$appointment->id}}" data-toggle="modal" data-target="#appointmentModal">View</button></td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <th style="width: 20%;">Not Available</th>
                                                            <td>Not Available</td>
                                                            <td>Not Available</td>
                                                            <td>Not Available</td>
                                                            <td>Not Available</td>
                                                            <td>Not Available</td>
                                                            <td>Not Available</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 p-0">
                                        <div class="inner_section_last_email border-0 px-3 py-3 mt-5">
                                            <div class="heading_btn_wrapper">
                                                <div class="main_heading">
                                                    <h5>Last Email</h5>
                                                </div>
                                                <div class="view_all_btn">
                                                    <a class="btn green_btn borderRadius" href="javascript:void(0)">View All</a>
                                                </div>
                                            </div>
                                            <div class="emails">
                                                <div class="email borderRadius20 box-shadow-card">
                                                    <div class="user_image">
                                                        <img src="{{asset('website')}}/images/user_profile.png"
                                                             alt="profile_default_img">
                                                    </div>
                                                    <div class="user_name_email_wrapper">
                                                        <div class="user_name">
                                                            <p>
                                                                Jenny.J
                                                            </p>
                                                        </div>
                                                        <div class="user_email">
                                                            <p>Jenny.James@gmail.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_subject">
                                                        <div class="title">
                                                            <p>Subject</p>
                                                        </div>
                                                        <div class="subject_content">
                                                            <p>Lorem Epsum</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_content">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the
                                                            industry's standard dummy text ever since the 1500s <a
                                                                    href="javascript:void(0)">See More</a> </p>
                                                    </div>
                                                    <div class="email_date_time_wrapper">
                                                        <div class="date">
                                                            <p>03/07/2022</p>
                                                        </div>
                                                        <div class="email_time">
                                                            <p>09:25 Am</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="email borderRadius20 box-shadow-card">
                                                    <div class="user_image">
                                                        <img src="{{asset('website')}}/images/user_profile.png" alt="profile_default_img">
                                                    </div>
                                                    <div class="user_name_email_wrapper">
                                                        <div class="user_name">
                                                            <p>
                                                                Jenny.J
                                                            </p>
                                                        </div>
                                                        <div class="user_email">
                                                            <p>Jenny.James@gmail.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_subject">
                                                        <div class="title">
                                                            <p>Subject</p>
                                                        </div>
                                                        <div class="subject_content">
                                                            <p>Lorem Epsum</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_content">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the
                                                            industry's standard dummy text ever since the 1500s <a
                                                                    href="javascript:void(0)">See More</a> </p>
                                                    </div>
                                                    <div class="email_date_time_wrapper">
                                                        <div class="date">
                                                            <p>03/07/2022</p>
                                                        </div>
                                                        <div class="email_time">
                                                            <p>09:25 Am</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="email borderRadius20 box-shadow-card">
                                                    <div class="user_image">
                                                        <img src="{{asset('website')}}/images/user_profile.png"
                                                             alt="profile_default_img">
                                                    </div>
                                                    <div class="user_name_email_wrapper">
                                                        <div class="user_name">
                                                            <p>
                                                                Jenny.J
                                                            </p>
                                                        </div>
                                                        <div class="user_email">
                                                            <p>Jenny.James@gmail.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_subject">
                                                        <div class="title">
                                                            <p>Subject</p>
                                                        </div>
                                                        <div class="subject_content">
                                                            <p>Lorem Epsum</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_content">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the
                                                            industry's standard dummy text ever since the 1500s <a
                                                                    href="javascript:void(0)">See More</a> </p>
                                                    </div>
                                                    <div class="email_date_time_wrapper">
                                                        <div class="date">
                                                            <p>03/07/2022</p>
                                                        </div>
                                                        <div class="email_time">
                                                            <p>09:25 Am</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="email borderRadius20 box-shadow-card">
                                                    <div class="user_image">
                                                        <img src="{{asset('website')}}/images/user_profile.png"
                                                             alt="profile_default_img">
                                                    </div>
                                                    <div class="user_name_email_wrapper">
                                                        <div class="user_name">
                                                            <p>
                                                                Jenny.J
                                                            </p>
                                                        </div>
                                                        <div class="user_email">
                                                            <p>Jenny.James@gmail.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_subject">
                                                        <div class="title">
                                                            <p>Subject</p>
                                                        </div>
                                                        <div class="subject_content">
                                                            <p>Lorem Epsum</p>
                                                        </div>
                                                    </div>
                                                    <div class="email_content">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the
                                                            industry's standard dummy text ever since the 1500s <a
                                                                    href="javascript:void(0)">See More</a> </p>
                                                    </div>
                                                    <div class="email_date_time_wrapper">
                                                        <div class="date">
                                                            <p>03/07/2022</p>
                                                        </div>
                                                        <div class="email_time">
                                                            <p>09:25 Am</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane">
                            <div class="inner_section_jobs_won_tab cards_padding mt-5">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="inner_section_line_chart">
                                            <ul class="list-inline text-right">
                                                <li>
                                                    <h5><i class="fa fa-circle text-info m-r-5"></i>iPhone</h5>
                                                </li>
                                                <li>
                                                    <h5><i class="fa fa-circle text-warning m-r-5"></i>iPad</h5>
                                                </li>
                                                <li>
                                                    <h5><i class="fa fa-circle text-purple m-r-5"></i>iPod</h5>
                                                </li>
                                            </ul>
                                            <div id="morris-area-chart"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="inner_section_jobs_won_filter cards_padding mt-5 card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="txt_field">
                                                            <label for="">Duration Type</label>
                                                            <input class="form-control" type="text" name="job_created_date" id="" placeholder="Job Created Date" readonly>
                                                        </div>
                                                        <div class="txt_field">
                                                            <label for="">Select Duration</label>
                                                            <input class="form-control" type="text" name="dates" id="" placeholder="Job Created Date" readonly>
                                                        </div>

                                                        <div class="txt_field">
                                                            <label for="">User</label>
                                                            <select class="form-control" name="" id="">
                                                                <option value="0">Select User</option>
                                                                <option value="0">User 1</option>
                                                                <option value="0">User 2</option>
                                                                <option value="0">User 3</option>
                                                            </select>
                                                        </div>

                                                        <div class="txt_field">
                                                            <label for="">Divisions</label>
                                                            <select class="form-control" name="" id="">
                                                                <option value="0">Select Divisions</option>
                                                                <option value="0">Divisions 1</option>
                                                                <option value="0">Divisions 2</option>
                                                                <option value="0">Divisions 3</option>
                                                            </select>
                                                        </div>

                                                        <div class="txt_field">
                                                            <label for="">Customer Type</label>
                                                            <select class="form-control" name="" id="">
                                                                <option value="0">Select Divisions</option>
                                                                <option value="0">Divisions 1</option>
                                                                <option value="0">Divisions 2</option>
                                                                <option value="0">Divisions 3</option>
                                                            </select>
                                                        </div>
                                                        <div class="txt_field">
                                                            <label for="">Customer Type</label>
                                                            <input class="form-control" type="text" name="" id="" placeholder="Select Divisions" readonly>
                                                        </div>
                                                        <div class="txt_field">
                                                            <label for="">Duration Type</label>
                                                            <input class="form-control" type="text" name="job_created_date" id="" placeholder="Job Created Date" readonly>
                                                        </div>
                                                        <div class="txt_field">
                                                            <label for="">Duration Type</label>
                                                            <input class="form-control" type="text" name="job_created_date" id="" placeholder="Job Created Date" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal -->
    {{--<div class="modal fade" id="attendees_modal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">--}}

    {{--</div>--}}

    {{--<div class="modal fade" id="attendees_modal" aria-hidden="true" aria-labelledby="attendees_modalLabel" tabindex="-1">--}}

    {{--</div>--}}
    <!-- Button trigger modal -->

    <!-- Modal -->

    <!-- Trigger the modal with a button -->

    <!-- Modal -->
    <div id="appointmentModal" class="main_modal modal fade" role="dialog">
    </div>

    <div id="taskModal" class="main_modal modal fade" role="dialog">
    </div>

@endsection


@push('js')

<script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
<script src="{{asset('js/morris-data.js')}}"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
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

    Bubbledots[0].classList.add('active'); // set first dot as active by default

    chatBubbles.forEach((chatBubble, index) => {
        chatBubble.addEventListener('click', () => {
        Bubbledots.forEach(otherDot => {
        otherDot.classList.remove('active');
    });
    Bubbledots[index].classList.add('active');
    });
    });
</script>

<script>
    $('input[name="dates"]').daterangepicker();
</script>

<script>
    $('.single_timeline_radio').click(function(){
        $(".single_timeline").removeClass("checked");
        let index = $(this).closest(".single_timeline").attr('data-index');
        $('.single_timeline').each(function(i, obj) {
            let key = $(this).attr('data-index');
            if(parseInt(index)>=parseInt(key)){
                $(this).addClass("checked")
            }
        });
    });
</script>

<script>
    jQuery('.inner_section_timeline #stage_form .single_timeline_radio').click(function(){
        jQuery('#timeline_submit_btn').click();
    });

//        $(".attendees_modal_btn").click(function(){
//            $("#appointmentModal").modal('show');
//        });
    $(document).on('click','.attendees_modal_btn',function(e){
        var id = $(this).attr('appointment-id');
        $.ajax({
            url: "{{route('view_appointment_detail')}}",
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            success: function(result) {
                $('#appointmentModal').html(result);
                $('#appointmentModal').modal('show');
                console.log(result)
            },
            error:function(e){
                console.log(e.status);
            }
        });
    });

    $(document).on('click','.task_modal_btn',function(e){
        var id = $(this).attr('task-id');
        $.ajax({
            url: "{{route('view_task_detail')}}",
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            success: function(result) {
                $('#taskModal').html(result);
                $('#taskModal').show();
                console.log(result)
            },
            error:function(e){
                console.log(e.status);
            }
        });
    });

</script>
<script>
    $("#tax_exemptRadio").change(function() {
        if ($(this).is(":checked")) {
            // Hide tax input field
            $("#taxInputDiv").hide();
            $("#tax").val('')
            $("#taxableInputDiv").hide();
            $("#taxable").val('');

        }
    });
    $("#taxableRadio").change(function() {
        if ($(this).is(":checked")) {
            // Hide tax input field
            $("#taxableInputDiv").show();
            $("#taxInputDiv").show();
            $("#lead_price").show();
        }
    });

    function calculateTotal() {
        var priceType = document.querySelector('input[name="tax_type"]:checked').value;
        var taxable = 0;
        var tax = 0;

        if (priceType === 'taxable') {
            taxable = parseFloat(document.getElementById('taxable').value);
            tax = parseFloat(document.getElementById('tax').value) || 0;
        } else {
            var total = parseFloat(document.getElementById('lead_price').value) || 0;
            var taxableBeforeTax = total / (1 + (tax / 100));
            taxable = taxableBeforeTax.toFixed(2);
            tax = (total - taxable).toFixed(2);
        }

        var total = taxable + (taxable * (tax / 100));
        document.getElementById('lead_price').value = total.toFixed(2);
    }

    var taxableRadio = document.getElementById('taxableRadio');
    var taxableInputDiv = document.getElementById('taxableInputDiv');
    var tax_exemptRadio = document.getElementById('tax_exemptRadio');
    var taxInputDiv = document.getElementById('taxInputDiv');

    taxableRadio.addEventListener('click', function() {
        taxableInputDiv.style.display = 'block';
        taxInputDiv.style.display = 'none';
    });

    // add event listeners to input fields to trigger calculation function
    var taxableInput = document.getElementById('taxable');
    var taxInput = document.getElementById('tax');
    var leadPriceInput = document.getElementById('lead_price');

    taxableInput.addEventListener('input', calculateTotal);
    taxInput.addEventListener('input', calculateTotal);
    leadPriceInput.addEventListener('input', calculateTotal);
//    tax_exempt

    $(document).ready(function() {
        $("#my_lead_price_form").validate({
            rules: {
                lead_price: {
                    required: true,
                },
            },
            messages: {
                lead_price: {
                    required: "This field is required",
                },
            }
        });
    });



</script>
@endpush