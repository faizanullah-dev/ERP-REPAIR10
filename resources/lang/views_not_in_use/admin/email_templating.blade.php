@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="target_table pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-headerr">
                    <h5>Email</h5>
                    <!-- <a href="" class="button create_btn borderRadius">Edit</a>
                    <i class="fa fa-info-circle"></i> -->
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card email_links borderRadius20 box-shadow-card border-0">
                                <div class="email_template_list">
                                    <div class="email_temp_box">
                                        <p class="p-16">Launch Day</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="email_temp_box">
                                        <p class="p-16">Day 2</p>
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="content_column email_template_view">
                                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                                    <div class="card-headerr">
                                        <div class="user-profile-box">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="user_info">
                                                <p class="p-20">Jenny.J</p>
                                                <p class="p-12">Jenny.James@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="right_icon_box">
                                            <a href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <a href="">Star</a>
                                            <a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="single_email_template_view mt-3">
                                            <div class="email_template_view_header">
                                                <p class="p-16"><span class="msg_icon"><i class="fa fa-envelope"></i></span> Send email at </p>
                                                <input type="time" value="01:30" class="time_box">
                                            </div>
                                            <div class="subject_note">
                                            <div class="mb-3">
                                                <label for="subject" class="form-label input_labels p-18">Subject</label>
                                                <input type="text" class="form-control clr_input_fields borderRadius" id="subject" aria-describedby="subjectHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="call-center" class="form-label input_labels p-18">Customer Note</label>
                                                <textarea class="form-control borderRadius clr_textarea_fields" placeholder="Enter note..." id="exampleFormControlTextarea1" rows="7"></textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="single_email_template_view mt-3">
                                            <div class="email_template_view_header">
                                                <p class="p-16"><span class="msg_icon"><i class="fa fa-envelope"></i></span> Send email at </p>
                                                <input type="time" value="01:30" class="time_box">
                                            </div>
                                            <div class="subject_note">
                                            <div class="mb-3">
                                                <label for="subject" class="form-label input_labels p-18">Subject</label>
                                                <input type="text" class="form-control clr_input_fields borderRadius" id="subject" aria-describedby="subjectHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="call-center" class="form-label input_labels p-18">Customer Note</label>
                                                <textarea class="form-control borderRadius clr_textarea_fields" placeholder="Enter note..." id="exampleFormControlTextarea1" rows="7"></textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="new_message_btn">
                                            <button class="green_btn borderRadius border-0 mt-5">Add New Message</button>
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
</section>
@endsection