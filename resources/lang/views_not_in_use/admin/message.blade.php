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
                    <a href="" class="button create_btn borderRadius">Edit</a>
                    <i class="fa fa-info-circle"></i>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card message_chat_column borderRadius20 box-shadow-card border-0">
                                <div class="card-body">
                                    <div class="message_btn mb-3">
                                        <a href="" class="button borderRadius border-0">New Message</a>
                                    </div>
                                    <div class="message_options_box mt-5">
                                        <div class="message_option">
                                            <div class="msg_option_icon">
                                                <img src="{{asset('website')}}/images/msg-opt1.png" alt="">
                                            </div>
                                            <span class="notification_number">5</span>
                                        </div>
                                        <div class="message_option">
                                            <div class="msg_option_icon">
                                                <img src="{{asset('website')}}/images/msg-opt2.png" alt="">
                                            </div>
                                            <span class="notification_number">8</span>
                                        </div>
                                        <div class="message_option">
                                            <div class="msg_option_icon">
                                                <img src="{{asset('website')}}/images/msg-opt3.png" alt="">
                                            </div>
                                            <span class="notification_number">36</span>
                                        </div>
                                        <div class="message_option">
                                            <div class="msg_option_icon">
                                                <img src="{{asset('website')}}/images/msg-opt4.png" alt="">
                                            </div>
                                            <span class="notification_number">2</span>
                                        </div>
                                    </div>
                                    <div class="side_msgs_list mt-4">
                                        <div class="single_msg_box mb-2">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="msg_info">
                                                <p class="msg_title p-18">Harvey Roberts</p>
                                                <p class="msg_description p-14">Can someone help me with this?</p>
                                            </div>
                                            <span class="time">09:47 AM</span>
                                        </div>
                                        <div class="single_msg_box mb-2">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="msg_info">
                                                <p class="msg_title p-18">Harvey Roberts</p>
                                                <p class="msg_description p-14">Can someone help me with this?</p>
                                            </div>
                                            <span class="time">09:47 AM</span>
                                        </div>
                                        <div class="single_msg_box mb-2">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="msg_info">
                                                <p class="msg_title p-18">Harvey Roberts</p>
                                                <p class="msg_description p-14">Can someone help me with this?</p>
                                            </div>
                                            <span class="time">09:47 AM</span>
                                        </div>
                                        <div class="single_msg_box mb-2">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="msg_info">
                                                <p class="msg_title p-18">Harvey Roberts</p>
                                                <p class="msg_description p-14">Can someone help me with this?</p>
                                            </div>
                                            <span class="time">09:47 AM</span>
                                        </div>
                                        <div class="single_msg_box mb-2">
                                            <div class="profile_img avatar">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <div class="msg_info">
                                                <p class="msg_title p-18">Harvey Roberts</p>
                                                <p class="msg_description p-14">Can someone help me with this?</p>
                                            </div>
                                            <span class="time">09:47 AM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content_column">
                                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                                    <div class="card-headerr">
                                        <div class="message_box_header">
                                            <div class="user_img">
                                                <img src="{{asset('website')}}/images/avatar.png" alt="">
                                            </div>
                                            <h2>Nicholas Amazon</h2>
                                            <p class="p-18">Lorem Ipsum</p>
                                            <p class="mt-3 p-16">This is the very beginning of your conversation with Nicholas Amazon</p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    <section class="chat">
                                        <!-- <div class="header-chat">
                                        <i class="icon fa fa-user-o" aria-hidden="true"></i>
                                        <p class="name">Megan Leib</p>
                                        <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                                        </div> -->
                                        <div class="messages-chat mb-5">
                                        <div class="message">
                                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                            <div class="online"></div>
                                            </div>
                                            <p class="text"> Lorem ipsum dolor sit, amet consectetur dolor sit</p>
                                        </div>
                                        <div class="message text-only">
                                            <p class="text"> Lorem ipsum dolor sit, amet consectetur.</p>
                                        </div>
                                        <p class="time"> 14h58</p>
                                        <div class="message text-only">
                                            <div class="response">
                                            <p class="text"> Lorem ipsum dolor sit, amet consectetur. 😃</p>
                                            </div>
                                        </div>
                                        <div class="message text-only">
                                            <div class="response">
                                            <p class="text"> Lorem ipsum dolor sit</p>
                                            </div>
                                        </div>
                                        <p class="response-time time"> 15h04</p>
                                        <div class="message">
                                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                            <div class="online"></div>
                                            </div>
                                            <p class="text"> Lorem ipsum dolor sit 😳</p>
                                        </div>
                                        <p class="time"> 15h09</p>
                                        </div>
                                        <div class="footer-chat mt-5">
                                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                                        <input type="text" class="write-message" placeholder="Type your message here"></input>
                                        <i class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>
                                        </div>
                                    </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="inbox_section">
                                <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                                    <div class="card-headerrr">
                                        <div class="user_top_info d-flex align-items-center w-100">
                                            <span>#329</span>
                                            <p class="mb-0 text-end ml-auto p-14">Created 23 March,2022</p>
                                        </div>
                                        <div class="user_info mt-3">
                                            <div class="user_img_name">
                                                <div class="user_img">
                                                    <img src="{{asset('website')}}/images/avatar.png" alt="">
                                                </div>
                                                <h5 class="">Nicholas Amazon</h5>
                                            </div>
                                            <div class="view_more_btn mt-5">
                                                <a href="" class="green_btn p-12 borderRadius">View more info</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line mt-5 mb-3"></div>
                                    <div class="card-body">
                                        <div class="contact_info_box">
                                            <div class="single_contact_info mb-2">
                                                <div class="info_icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="contact_info_detail">
                                                <p class="p-16 info_title">Email</p>
                                                <p class="p-16 info_detail">abc@company.com</p>
                                                </div>
                                            </div>
                                            <div class="single_contact_info mb-2">
                                                <div class="info_icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="contact_info_detail">
                                                <p class="p-16 info_title">Phone</p>
                                                <p class="p-16 info_detail">+1 (401) 573-8397</p>
                                                </div>
                                            </div>
                                            <div class="single_contact_info mb-2">
                                                <div class="info_icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                                <div class="contact_info_detail">
                                                <p class="p-16 info_title">Address</p>
                                                <p class="p-16 info_detail">225 Cherry Street #24 Brooklyn. NY</p>
                                                </div>
                                            </div>
                                            <div class="single_contact_info mb-2">
                                                <div class="info_icon">
                                                    <i class="fa fa-clock"></i>
                                                </div>
                                                <div class="contact_info_detail">
                                                <p class="p-16 info_title">Timezone</p>
                                                <p class="p-16 info_detail">Brooklyn, NY, USA (GMT-4)</p>
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
    </div>
</section>
@endsection