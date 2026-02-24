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
                    <h5 class="mb-5">Email</h5>
                    <!-- <a href="" class="button create_btn borderRadius">Edit</a>
                    <i class="fa fa-info-circle"></i> -->
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card email_links borderRadius20 box-shadow-card border-0">
                                <div class="card-body">
                                <div class="message_btn mb-3">
                                    <a href="" class="button borderRadius border-0">New Message  <span><i class="fa fa-paper-plane-o" aria-hidden="true"></i></span> </a>
                                </div>
                                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 mt-5 align-items-center align-items-sm-start" id="menu">
                                    <li class="nav-item active-link">
                                        <a href="#" class="nav-link align-middle px-0">
                                        <i class="fa fa-home" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Inbox</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link align-middle px-0">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Sent</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link align-middle px-0">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Drafts</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link align-middle px-0">
                                        <i class="fa fa-trash" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Trash</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link align-middle px-0">
                                        <i class="fa fa-trash" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Junk</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inbox_section">
                                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                                    <div class="card-headerr">
                                        <div class="inbox_with_icon">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <h4 class="mb-0">Inbox</h4>
                                        </div>
                                        <div class="right_menu">
                                            <a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <!-- <a href="#"> -->
                                            <div class="dropdown">
                                                <button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">View</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                            <!-- </a> -->
                                        </div>
                                    </div>
                                    <div class="hr-line mt-2"></div>
                                    <div class="card-body">
                                        <div class="primary_general_tabs">

                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="#button1" class="nav-link" >Primary</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#button2" class="nav-link" >General</a>
                                            </li>
                                            </ul>

                                            <div class="myTabContent tab-content">
                                                <div id="button1" class="buttonContent">
                                                <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                </div>
                                                <div id="button2" class="buttonContent">
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-primary-tab" data-bs-toggle="pill" data-bs-target="#pills-primary" type="button" role="tab" aria-controls="pills-primary" aria-selected="true">Primary</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-general-tab" data-bs-toggle="pill" data-bs-target="#pills-general" type="button" role="tab" aria-controls="pills-general" aria-selected="false">General</button>
                                            </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                PRIMARY TAB ICON
                                                <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab">
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                </div>
                                                GENERAL TAB ICON
                                                <div class="tab-pane fade" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                    <div class="single_msg">
                                                        <p class="p-16 msg_title">Craft Work</p>
                                                        <p class="p-12">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private</p>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content_column">
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
                                            <a href=""><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                            <a href=""><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3>5 (more) things I wish I knew when I started photography</h3>
                                        <p class="p-16 fontweight-bold" >We at Wasai LLC respect the privacy of your personal information</p>
                                        <div class="image_box borderRadius mt-3 mb-3">
                                            <img src="{{asset('website')}}/images/hhh.webp" alt="">
                                        </div>
                                        <h3>Originality in Photography</h3>
                                        <p class="p-16">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private. As the owner and operator of loremipsum.io (the "Website") hereafter referred to in this Privacy Policy.</p>

                                        <p class="p-16">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private.</p>
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