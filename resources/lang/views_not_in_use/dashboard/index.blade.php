@extends('layouts.master')
@push('css')
    <style>
        .info-box .info-count {
            margin-top: 0px !important;
        }
    </style>
@endpush

@section('content')
@if(auth()->user()->hasRole('admin'))
<div class="row m-0">

    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i
                        class="mdi mdi-checkbox-marked-circle-outline"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">154</h3>
                <p class="info-text font-12">Bookings</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Target<span class="label label-rounded label-success">300</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i class="mdi mdi-comment-text-outline"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">68</h3>
                <p class="info-text font-12">Complaints</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Total Pending<span class="label label-rounded label-danger">154</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i class="mdi mdi-coin"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">&#36;9475</h3>
                <p class="info-text font-12">Earning</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">March : <span class="text-blue font-semibold">&#36;514578</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box b-r-0">
        <div class="media">
            <div class="media-left p-r-5">
                <div id="earning" class="e" data-percent="60">
                    <div id="pending" class="p" data-percent="55"></div>
                    <div id="booking" class="b" data-percent="50"></div>
                </div>
            </div>
            <div class="media-body">
                <h2 class="text-blue font-22 m-t-0">Report</h2>
                <ul class="p-0 m-b-20">
                    <li><i class="fa fa-circle m-r-5 text-primary"></i>60% Earnings</li>
                    <li><i class="fa fa-circle m-r-5 text-primary"></i>55% Pending</li>
                    <li><i class="fa fa-circle m-r-5 text-info"></i>50% Bookings</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="white-box stat-widget">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <h4 class="box-title">Statistics</h4>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <select class="custom-select">
                            <option selected value="0">Feb 04 - Mar 03</option>
                            <option value="1">Mar 04 - Apr 03</option>
                            <option value="2">Apr 04 - May 03</option>
                            <option value="3">May 04 - Jun 03</option>
                        </select>
                        <ul class="list-inline">
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success"></i>New Sales
                                </h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Existing
                                    Sales</h6>
                            </li>
                        </ul>
                    </div>
                    <div class="stat chart-pos"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="white-box">
                <h4 class="box-title">Task Progress</h4>
                <div class="task-widget t-a-c">
                    <div class="task-chart" id="sparklinedashdb"></div>
                    <div class="task-content font-16 t-a-c">
                        <div class="col-sm-6 b-r">
                            Urgent Tasks
                            <h1 class="text-primary">05 <span class="font-16 text-muted">Tasks</span></h1>
                        </div>
                        <div class="col-sm-6">
                            Normal Tasks
                            <h1 class="text-primary">03 <span class="font-16 text-muted">Tasks</span></h1>
                        </div>
                    </div>
                    <div class="task-assign font-16">
                        Assigned To
                        <ul class="list-inline">
                            <li class="p-l-0">
                                <img src="{{asset('plugins/images/users/1.png')}}" alt="user" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Steave">
                            </li>
                            <li>
                                <img src="{{asset('plugins/images/users/2.png')}}" alt="user" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Steave">
                            </li>
                            <li>
                                <img src="{{asset('plugins/images/users/3.png')}}" alt="user" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Steave">
                            </li>
                            <li class="p-r-0">
                                <a href="javascript:void(0);" class="btn btn-success font-16">3+</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="white-box bg-primary color-box">
                <h1 class="text-white font-light">&#36;6547 <span class="font-14">Revenue</span></h1>
                <div class="ct-revenue chart-pos"></div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="white-box bg-success color-box">
                <h1 class="text-white font-light m-b-0">5247</h1>
                <span class="hr-line"></span>
                <p class="cb-text">current visits</p>
                <h6 class="text-white font-semibold">+25% <span class="font-light">Last Week</span></h6>
                <div class="chart">
                    <div class="ct-visit chart-pos"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="white-box bg-danger color-box">
                <h1 class="text-white font-light m-b-0">25%</h1>
                <span class="hr-line"></span>
                <p class="cb-text">Finished Tasks</p>
                <h6 class="text-white font-semibold">+15% <span class="font-light">Last Week</span></h6>
                <div class="chart">
                    <input class="knob" data-min="0" data-max="100" data-bgColor="#f86b4a" data-fgColor="#ffffff"
                        data-displayInput=false data-width="96" data-height="96" data-thickness=".1" value="25"
                        readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box user-table">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="box-title">Table Format/User Data</h4>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline">
                            <li>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i
                                        class="fa fa-commenting" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                        <select class="custom-select">
                            <option selected>Sort by</option>
                            <option value="1">Name</option>
                            <option value="2">Location</option>
                            <option value="3">Type</option>
                            <option value="4">Role</option>
                            <option value="5">Action</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox checkbox-info">
                                        <input id="c1" type="checkbox">
                                        <label for="c1"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <input id="c2" type="checkbox">
                                        <label for="c2"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="text-link">Daniel Kristeen</a></td>
                                <td>Texas, US</td>
                                <td>Posts 564</td>
                                <td><span class="label label-success">Admin</span></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="1">Modulator</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staff</option>
                                        <option value="4">User</option>
                                        <option value="5">General</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <input id="c3" type="checkbox">
                                        <label for="c3"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="text-link">Hanna Gover</a></td>
                                <td>Los Angeles, US</td>
                                <td>Posts 451</td>
                                <td><span class="label label-info">Staff</span></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="1">Modulator</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staff</option>
                                        <option value="4">User</option>
                                        <option value="5">General</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <input id="c4" type="checkbox">
                                        <label for="c4"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="text-link">Jeffery Brown</a></td>
                                <td>Houston, US</td>
                                <td>Posts 978</td>
                                <td><span class="label label-danger">User</span></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="1">Modulator</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staff</option>
                                        <option value="4">User</option>
                                        <option value="5">General</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <input id="c5" type="checkbox">
                                        <label for="c5"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="text-link">Elliot Dugteren</a></td>
                                <td>San Antonio, US</td>
                                <td>Posts 34</td>
                                <td><span class="label label-warning">General</span></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="1">Modulator</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staff</option>
                                        <option value="4">User</option>
                                        <option value="5">General</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-info">
                                        <input id="c6" type="checkbox">
                                        <label for="c6"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="text-link">Sergio Milardovich</a></td>
                                <td>Jacksonville, US</td>
                                <td>Posts 31</td>
                                <td><span class="label label-primary">Partial</span></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="1">Modulator</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staff</option>
                                        <option value="4">User</option>
                                        <option value="5">General</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination">
                    <li class="disabled"><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
                <a href="javascript:void(0);" class="btn btn-success pull-right m-t-10 font-20">+</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="white-box">
                <div class="task-widget2">
                    <div class="task-image">
                        <img src="{{asset('plugins/images/task.jpg')}}" alt="task" class="img-responsive">
                        <div class="task-image-overlay"></div>
                        <div class="task-detail">
                            <h2 class="font-light text-white m-b-0">07 April</h2>
                            <h4 class="font-normal text-white m-t-5">Your tasks for today</h4>
                        </div>
                        <div class="task-add-btn">
                            <a href="javascript:void(0);" class="btn btn-success">+</a>
                        </div>
                    </div>
                    <div class="task-total">
                        <p class="font-16 m-b-0"><strong>5</strong> Tasks for <a href="javascript:void(0);"
                                class="text-link">Jon Doe</a>
                        </p>
                    </div>
                    <div class="task-list">
                        <ul class="list-group">
                            <li class="list-group-item bl-info">
                                <div class="checkbox checkbox-success">
                                    <input id="c7" type="checkbox">
                                    <label for="c7">
                                        <span class="font-16">Create invoice for customers and email each customers.</span>
                                    </label>
                                    <h6 class="p-l-30 font-bold">05:00 PM</h6>
                                </div>
                            </li>
                            <li class="list-group-item bl-warning">
                                <div class="checkbox checkbox-success">
                                    <input id="c8" type="checkbox" checked>
                                    <label for="c8">
                                        <span class="font-16">Send payment of <strong>&#36;500 invoised</strong> on 23
                                            May to <a href="javascript:void(0);" class="text-link">Daniel Kristeen</a>
                                            via paypal.</span>
                                    </label>
                                    <h6 class="p-l-30 font-bold">03:00 PM</h6>
                                </div>
                            </li>
                            <li class="list-group-item bl-danger">
                                <div class="checkbox checkbox-success">
                                    <input id="c9" type="checkbox">
                                    <label for="c9">
                                        <span class="font-16">It is a long established fact that a reader will be
                                            distracted by the readable.</span>
                                    </label>
                                    <h6 class="p-l-30 font-bold">04:45 PM</h6>
                                </div>
                            </li>
                            <li class="list-group-item bl-success">
                                <div class="checkbox checkbox-success">
                                    <input id="c10" type="checkbox">
                                    <label for="c10">
                                        <span class="font-16">It is a long established fact that a reader will be
                                            distracted by the readable.</span>
                                    </label>
                                    <h6 class="p-l-30 font-bold">05:30 PM</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="task-loadmore">
                        <a href="javascript:void(0);" class="btn btn-default btn-outline btn-rounded">Load
                            More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="white-box chat-widget">
                <a href="javascript:void(0);" class="pull-right"><i class="icon-settings"></i></a>
                <h4 class="box-title">Chat</h4>
                <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">
                    <li>
                        <div class="chat-image"><img alt="male" src="{{asset('plugins/images/users/hanna.jpg')}}"></div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <p><span class="font-semibold">Hanna Gover</span> Hey Daniel, This is just a
                                    sample chat. </p>
                            </div>
                            <span>2 Min ago</span>
                        </div>
                    </li>
                    <li class="odd">
                        <div class="chat-body">
                            <div class="chat-text">
                                <p> buddy </p>
                            </div>
                            <span>2 Min ago</span>
                        </div>
                    </li>
                    <li>
                        <div class="chat-image"><img alt="male" src="{{asset('plugins/images/users/hanna.jpg')}}"></div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <p><span class="font-semibold">Hanna Gover</span> Bye now. </p>
                            </div>
                            <span>1 Min ago</span>
                        </div>
                    </li>
                    <li class="odd">
                        <div class="chat-body">
                            <div class="chat-text">
                                <p> We have been busy all the day to make your website proposal and finally came
                                    with the super excited offer. </p>
                            </div>
                            <span>5 Sec ago</span>
                        </div>
                    </li>
                </ul>
                <div class="chat-send">
                    <input type="text" class="form-control" placeholder="Write your message">
                    <i class="fa fa-camera"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== Right-Sidebar ===== -->
    {{--@include('layouts.partials.right-sidebar')--}}
    <!-- ===== Right-Sidebar-End ===== -->
</div>
@else
<!-- <div class="container-fluid"> -->
<div class="col-md-12">
    <div class="inner_section_timeline">
            <div class="timelines">
                    @forelse($stages->sortBy('position') as $key => $value)
                            <div class="single_timeline   checked " data-index="{{ ++$key }}">
                                <style>
                                    .timelines .single_timeline.checked[data-index="{{$key}}"] .timeline_title:after { background-color: {{$value->colour_id}} }
                                    .timelines .single_timeline.checked[data-index="{{$key}}"] .timeline_bar:before {  background-color: {{$value->colour_id}}; border-color: {{$value->colour_id}} }
                                </style>
                                    <a href="{{route('lead_by_stages')}}/{{$value->id}}">
                                        <div class="timeline_title" style="background-color: {{$value->colour_id}}">
                                            <span>{{$value->name??""}}</span>
                                        </div>
                                    </a>
                                <div class="timeline_bar" style="background-color: {{$value->colour_id}}"></div>
                                <div class="timeline_date">
                                    <span class="completed_timeline">
                                            {!! $value->stageCount??"" !!}
                                    </span>
                                </div>
                                <div class="timeline_date">
                                    <span class="completed_timeline">
                                           $ {!! $value->LeadPrice??"" !!}
                                    </span>
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
    </div>
</div>
<section class="number_cards_announcement px-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="number_cards_section">
                    <div class="number_card card1 card_bg_img">
                        <p class="p-22">Total Leads</p>
                        <h1 class="number">{{$lead->count()??"00"}}</h1>
                    </div>
                    <div class="number_card card2 card_bg_img">
                        <p class="p-22">Total Staff</p>
                        <h1 class="number">{{ $staff = \App\User::whereHas('roles', function($q){$q->where('name','staff');})->count()??"00" }}</h1>
                    </div>
                    <div class="number_card card3 card_bg_img">
                        <p class="p-22">Unconverted Leads</p>
                        <h1 class="number">{{$unconvertedLead->stageCount??"00"}} </h1>
                    </div>
                    <div class="number_card card4 card_bg_img">
                        <p class="p-22">Sale Rep</p>
                        <h1 class="number">{{ $staff = \App\User::whereHas('roles', function($q){$q->where('name','salesmen');})->count()??"00" }}</h1>
                    </div>
                    <div class="number_card card5 card_bg_img">
                        <p class="p-22">Success Leads</p>
                        <h1 class="number">{{ $convertedLead->stageCount??"00" }}</h1>
                    </div>
                    <div class="number_card card6 card_bg_img">
                        <p class="p-22">This Year Target</p>
                        <h1 class="number green-text">{{$yearEstimation->estimate_amount??"00"}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="announcement_box">
                    <div class="card-headerr">
                        <h5>Announcement</h5>
                        <i class="fa fa-info-circle"></i>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="form-check checkbox_line">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <p class="p-14">Focus on tasks that have to be done, without missing any details.</p>
                            </label>
                        </div>
                        <div class="form-check checkbox_line">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <p class="p-14">Focus on tasks that have to be done, without missing any details.</p>
                            </label>
                        </div>
                        <div class="form-check checkbox_line">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <p class="p-14">Focus on tasks that have to be done, without missing any details.</p>
                            </label>
                        </div>
                        <div class="form-check checkbox_line">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <p class="p-14">Focus on tasks that have to be done, without missing any details.</p>
                            </label>
                        </div>
                        <div class="form-check checkbox_line">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <p class="p-14">Focus on tasks that have to be done, without missing any details.</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALENDAR SECTION -->
<section class="calendar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                    <div class="card-headerr calendar_sec_heading">
                        <h4>Divide #</h4>
                    </div>
                    <div class="card-body calendar_wrapper">
                        <div class="row calendar_row">
                                @forelse($yearEstimation->months as $key => $value)
                                    <div class="col-md-2">
                                        <div class="single_calendar_box">
                                            <div class="calendar_month" style="background-image: {{asset('website')}}'/images/calendar.png';">
                                                <p>{{date('F', mktime(0, 0, 0, ++$key, 10))}}</p>
                                            </div>
                                            <div class="calendar_content">
                                                <p>
                                                <span class="green-text">{{$value->percentage??""}}%</span>
                                                    <span>|</span>
                                                <span class="green-text">${{$value->amount??""}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @for($i=1; $i<=12; $i++)
                                        <div class="col-md-2">
                                            <div class="single_calendar_box">
                                                <div class="calendar_month" style="background-image: {{asset('website')}}'/images/calendar.png';">
                                                    <p>{{date('F', mktime(0, 0, 0, $i, 10))}}</p>
                                                </div>
                                                <div class="calendar_content">
                                                    <p>
                                                        <span class="green-text">10%</span>
                                                        <span>|</span>
                                                        <span class="green-text">$500</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GRAPHS SECTION -->
<section class="graphs px-5">
    <div class="container=fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                    <div class="card-headerr">
                        <h4>Yearly Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="white-box">
                            <div id="morris-area-chart"
                                style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                    height="342" version="1.1" width="672" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative; left: -0.5px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                        2.1.2</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="94.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647"
                                        y="315.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                        </tspan>
                                    </text><text x="546.7703763264492" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                        </tspan>
                                    </text><text x="446.5407526528982" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="346.31112897934736" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                        </tspan>
                                    </text><text x="245.80690359710178" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="145.5772799235509" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                        </tspan>
                                    </text><text x="45.34765625" y="315.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text>
                                    <path fill="#11d3f2" stroke="none"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#00bbd9"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="256.6666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="182.53333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="228.86666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="238.13333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="136.20000000000002" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="205.7" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="647" cy="71.33333333333334" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <path fill="#f8c77a" stroke="none"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#ffb136"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="228.86666666666667" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="247.4" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="346.31112897934736" cy="117.66666666666669" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="164" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="546.7703763264492" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="164" r="3" fill="#ffb136" stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <path fill="#5c32c7" stroke="none"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#4a23ad"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="284.4666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="238.13333333333333" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="117.66666666666669" r="3" fill="#4a23ad" stroke="#4a23ad"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 574px; top: 66px; display: none;">
                                    <div class="morris-hover-row-label">2016</div>
                                    <div class="morris-hover-point" style="color: #00bbd9">
                                        iPhone:
                                        250
                                    </div>
                                    <div class="morris-hover-point" style="color: #ffb136">
                                        iPad:
                                        150
                                    </div>
                                    <div class="morris-hover-point" style="color: #4a23ad">
                                        iPod Touch:
                                        200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                    <div class="card-headerr">
                    <h4>Leads Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="white-box">
                            <div id="morris-area-chart"
                                style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                    height="342" version="1.1" width="672" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative; left: -0.5px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                        2.1.2</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="94.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647"
                                        y="315.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                        </tspan>
                                    </text><text x="546.7703763264492" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                        </tspan>
                                    </text><text x="446.5407526528982" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="346.31112897934736" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                        </tspan>
                                    </text><text x="245.80690359710178" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="145.5772799235509" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                        </tspan>
                                    </text><text x="45.34765625" y="315.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text>
                                    <path fill="#11d3f2" stroke="none"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#00bbd9"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="256.6666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="182.53333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="228.86666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="238.13333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="136.20000000000002" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="205.7" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="647" cy="71.33333333333334" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <path fill="#f8c77a" stroke="none"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#ffb136"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="228.86666666666667" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="247.4" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="346.31112897934736" cy="117.66666666666669" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="164" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="546.7703763264492" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="164" r="3" fill="#ffb136" stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <path fill="#5c32c7" stroke="none"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#4a23ad"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="284.4666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="238.13333333333333" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="117.66666666666669" r="3" fill="#4a23ad" stroke="#4a23ad"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 574px; top: 66px; display: none;">
                                    <div class="morris-hover-row-label">2016</div>
                                    <div class="morris-hover-point" style="color: #00bbd9">
                                        iPhone:
                                        250
                                    </div>
                                    <div class="morris-hover-point" style="color: #ffb136">
                                        iPad:
                                        150
                                    </div>
                                    <div class="morris-hover-point" style="color: #4a23ad">
                                        iPod Touch:
                                        200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                    <div class="card-headerr">
                    <h4>Monthly Earning Percentage</h4>
                    </div>
                    <div class="card-body">
                        <div class="white-box">
                            <div id="morris-area-chart"
                                style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                    height="342" version="1.1" width="672" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative; left: -0.5px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                        2.1.2</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="94.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647"
                                        y="315.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                        </tspan>
                                    </text><text x="546.7703763264492" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                        </tspan>
                                    </text><text x="446.5407526528982" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="346.31112897934736" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                        </tspan>
                                    </text><text x="245.80690359710178" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="145.5772799235509" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                        </tspan>
                                    </text><text x="45.34765625" y="315.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text>
                                    <path fill="#11d3f2" stroke="none"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#00bbd9"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="256.6666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="182.53333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="228.86666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="238.13333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="136.20000000000002" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="205.7" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="647" cy="71.33333333333334" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <path fill="#f8c77a" stroke="none"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#ffb136"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="228.86666666666667" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="247.4" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="346.31112897934736" cy="117.66666666666669" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="164" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="546.7703763264492" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="164" r="3" fill="#ffb136" stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <path fill="#5c32c7" stroke="none"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#4a23ad"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="284.4666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="238.13333333333333" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="117.66666666666669" r="3" fill="#4a23ad" stroke="#4a23ad"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 574px; top: 66px; display: none;">
                                    <div class="morris-hover-row-label">2016</div>
                                    <div class="morris-hover-point" style="color: #00bbd9">
                                        iPhone:
                                        250
                                    </div>
                                    <div class="morris-hover-point" style="color: #ffb136">
                                        iPad:
                                        150
                                    </div>
                                    <div class="morris-hover-point" style="color: #4a23ad">
                                        iPod Touch:
                                        200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                    <div class="card-headerr">
                    <h4>Leads Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="white-box">
                            <div id="morris-area-chart"
                                style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                    height="342" version="1.1" width="672" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    style="overflow: hidden; position: relative; left: -0.5px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                        2.1.2</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                        x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="94.5" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.5H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                        x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan>
                                    </text>
                                    <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H647" stroke-width="0.5"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647"
                                        y="315.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                        stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                        </tspan>
                                    </text><text x="546.7703763264492" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                        </tspan>
                                    </text><text x="446.5407526528982" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                        </tspan>
                                    </text><text x="346.31112897934736" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                        </tspan>
                                    </text><text x="245.80690359710178" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                        </tspan>
                                    </text><text x="145.5772799235509" y="315.5" text-anchor="middle"
                                        font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                        </tspan>
                                    </text><text x="45.34765625" y="315.5" text-anchor="middle" font-family="sans-serif"
                                        font-size="12px" stroke="none" fill="#888888"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                        font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                        <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                        </tspan>
                                    </text>
                                    <path fill="#11d3f2" stroke="none"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#00bbd9"
                                        d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="256.6666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="182.53333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="228.86666666666667" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="238.13333333333333" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="136.20000000000002" r="3" fill="#00bbd9"
                                        stroke="#00bbd9" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="205.7" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="647" cy="71.33333333333334" r="3" fill="#00bbd9" stroke="#00bbd9"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <path fill="#f8c77a" stroke="none"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#ffb136"
                                        d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="228.86666666666667" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="247.4" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="346.31112897934736" cy="117.66666666666669" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="164" r="3" fill="#ffb136" stroke="#ffb136"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                    <circle cx="546.7703763264492" cy="210.33333333333334" r="3" fill="#ffb136"
                                        stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="164" r="3" fill="#ffb136" stroke="#ffb136" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <path fill="#5c32c7" stroke="none"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669L647,303L45.34765625,303Z"
                                        fill-opacity="0"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                    <path fill="none" stroke="#4a23ad"
                                        d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    <circle cx="45.34765625" cy="284.4666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="145.5772799235509" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="245.80690359710178" cy="238.13333333333333" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="346.31112897934736" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="446.5407526528982" cy="173.26666666666668" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="546.7703763264492" cy="228.86666666666667" r="3" fill="#4a23ad"
                                        stroke="#4a23ad" stroke-width="1"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                    <circle cx="647" cy="117.66666666666669" r="3" fill="#4a23ad" stroke="#4a23ad"
                                        stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                    </circle>
                                </svg>
                                <div class="morris-hover morris-default-style"
                                    style="left: 574px; top: 66px; display: none;">
                                    <div class="morris-hover-row-label">2016</div>
                                    <div class="morris-hover-point" style="color: #00bbd9">
                                        iPhone:
                                        250
                                    </div>
                                    <div class="morris-hover-point" style="color: #ffb136">
                                        iPad:
                                        150
                                    </div>
                                    <div class="morris-hover-point" style="color: #4a23ad">
                                        iPod Touch:
                                        200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- </div> -->
@endif

@endsection

@push('js')
<script src="{{asset('js/db1.js')}}"></script>

@endpush