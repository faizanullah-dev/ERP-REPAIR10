@extends('layouts.master')

@push('css')

<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">

@endpush

@section('content')
<section class="target_table pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-headerr bg-white">
                        <h5>Sales Performance Report</h5>
                    </div>
                    <div class="hr-line mt-2"></div>
                    <div class="report_tabs">
                        <ul>
                            <li class="borderRadius"><a href="">Jobs Won</a></li>
                            <li class="borderRadius"><a href="">Performance(#)</a></li>
                            <li class="borderRadius"><a href="">By Salesman</a></li>
                            <li class="borderRadius"><a href="">Summary</a></li>
                            <li class="borderRadius"><a href="">Job Listing(#)</a></li>
                        </ul>
                    </div>

                    <div class="col-md-12 mt-5 mb-5">
                        <div class="steps">
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Lead</p>
                                    <div class="dot"></div>
                                </div>
                                <div class="progress-line">
                                    
                                </div>
                            </div>
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Parma Boot Small Repairs</p>
                                </div>
                                <div class="progress-line">

                                </div>
                            </div>
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Bad Lead</p>
                                </div>
                                <div class="progress-line">

                                </div>
                            </div>
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Insurance Pending Estimate</p>
                                </div>
                                <div class="progress-line">

                                </div>
                            </div>
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Needs Estimate</p>
                                </div>
                                <div class="progress-line">

                                </div>
                            </div>
                            <div class="progress_box">
                                <div class="single_box">
                                    <p>Estimate Sent</p>
                                </div>
                                <div class="progress-line">

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card">
                                <div class="top_section">
                                    <h5>Customer Detail</h5>
                                    <div class="appointment_input">
                                        <input type="date">
                                    </div>
                                </div>
                                <div class="block">
                                    <p><span><i class="fa fa-map"></i></span> 220 Crest Terrace, Fairfield, Ct, 06825
                                    </p>
                                    <p><span><i class="fa fa-phone"></i></span> (203) 216-3385</p>
                                    <p><span><i class="fa fa-envelope"></i></span> jmcmanusjrdmd@gmail.com</p>
                                    <button class="button border-0 borderRadius green_btn mt-3">Add Files</button>
                                </div>
                            </div>

                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card">

                                <div class="block">
                                    <h5>Other</h5>
                                    <p>Referred by: James Hardie</p>
                                    <p>Call Center Rep: Lisa Ortiz</p>
                                </div>
                            </div>
                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card">

                                <div class="block">
                                    <h5>Job Contact Person</h5>
                                    <p><span><i class="fa fa-envelope"></i></span> Same as customer</p>
                                </div>
                            </div>
                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card">

                                <div class="block">
                                    <h5>Billing Details</h5>
                                    <p><span><i class="fa fa-envelope"></i></span> Same as customer</p>
                                    <p><span><i class="fa fa-map"></i></span> 220 Crest Terrace, Fairfield, Ct, 06825
                                    </p>
                                    <p><span><i class="fa fa-phone"></i></span> (203) 216-3385</p>
                                    <p><span><i class="fa fa-envelope"></i></span> jmcmanusjrdmd@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card announcement">
                                <div class="card-headerr">
                                    <h5>Announcement</h5>
                                    <a href="#" class="borderRadius border-0 button green_btn">View All</a>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="form-check checkbox_line">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p class="p-14">Focus on tasks that have to be done, without missing any
                                                details.</p>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox_line">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p class="p-14">Focus on tasks that have to be done, without missing any
                                                details.</p>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox_line">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p class="p-14">Focus on tasks that have to be done, without missing any
                                                details.</p>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox_line">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p class="p-14">Focus on tasks that have to be done, without missing any
                                                details.</p>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox_line">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p class="p-14">Focus on tasks that have to be done, without missing any
                                                details.</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 mt-5 borderRadius20 box-shadow-card recent_photo">
                                <div class="card-headerr">
                                    <h5>Recent Photo & Document</h5>
                                    <a href="#" class="borderRadius border-0 button green_btn">View All</a>
                                    <hr>
                                </div>
                                <div class="profile_pic_box mt-5">
                                    <div class="profile_photo">
                                        <img src="{{asset('website')}}/images/image.png" alt="">
                                    </div>
                                    <div class="upload_btn">
                                        <button class="btn button green_btn clr_textarea_fields border-0 borderRadius p-18">Upload
                                            Photo</button>
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

@endsection