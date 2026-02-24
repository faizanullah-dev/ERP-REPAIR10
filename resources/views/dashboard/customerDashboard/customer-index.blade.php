@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.19/main.min.css" rel="stylesheet" />
    <style>
        .custom_row_gap{row-gap: 20px}
        .measurement_button{
            width: 155px;
            margin-left: auto;
            margin-bottom: 10px;
        }
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1050; /* Above Bootstrap navbars/modals */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Modal box */
        .custom-modal-content {
            position: relative;
            margin: 5% auto;
            width: 90%;
            max-width: 600px;
            height: 80%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Close button */
        .custom-close {
            position: absolute;
            top: 10px;
            right: 20px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            z-index: 2;
        }

        .custom-close:hover {
            color: #000;
        }

        /* iframe */
        .custom-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

    </style>
@endpush

@section('content')
    <section class="customer_dashboard_section leads_user_index_sec ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="customer_activities_tabs">
                        <ul class="nav nav-tabs activities_payment_tab" id="activities_payment_tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="customer-activities-tab" data-bs-toggle="tab" data-bs-target="#customer-activities" type="button" role="tab" aria-selected="true">
                                    Activities
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customer-photos-tab" data-bs-toggle="tab" data-bs-target="#customer-photos" type="button" role="tab" aria-selected="false">
                                    Photos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customer-referrals-tab" data-bs-toggle="tab" data-bs-target="#customer-referrals" type="button" role="tab" aria-selected="false">
                                    Referrals
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="customer-payments-tab" data-bs-toggle="tab" data-bs-target="#customer-payments" type="button" role="tab" aria-selected="false">
                                    Payments
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="activitiesPaymentTabContent">
                            <div class="tab-pane fade active show" id="customer-activities" role="tabpanel">
                                <div class="activities_container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="custom_cards">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <h6>Total Leads</h6>
                                                            <h2>{{$leads->count()}}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <h6>Total Jobs</h6>
                                                            <h2>{{$leads->where('lead_status','won')->count()}}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <h6>Total Balance</h6>
                                                            <h2>$
                                                                {{ number_format(
                                                                    ((float)($leads->sum('lead_price') ?? 0) + (float)($leads->flatMap->getChangeOrder->where('status','approved')->sum('total_amount') ?? 0))
                                                                    - ($leads->flatMap->getReceivePayments->sum('amount') ?? 0),
                                                                    2
                                                                ) }}
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="recent_activities white-box">
                                                <h4>Recent Activities</h4>

                                                <div class="activities_card_listing">
                                                    @foreach($leads->flatMap->notifications->sortByDesc('created_at') as $notification)
                                                        <div class="activities_card_body">
                                                            <div class="message_icon_container">
                                                                <i class="{{ $notification->icon ??'' }}"></i>
                                                            </div>
                                                            <div class="activities_text">
                                                                <div class="activities_text_date_time">
                                                                    <h6>{{ $notification->model }}</h6>
                                                                    <p>{{ $notification->created_at->format('l, h:i A M-d-Y') }}</p>
                                                                </div>
                                                                <p>{!! $notification->title !!} {{ $notification->user->name??"" }}.</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id='calendar'></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class=" white-box">
                                                <div class="customer_profile">
                                                    <div class="">
                                                        <div class="customer_image">
                                                            @if(auth()->user()->profile->pic == null)
                                                                <img src="{{asset('storage/uploads/users/no_avatar.jpg')}}" alt="user-img">
                                                            @else
                                                                <img src="{{asset('storage/uploads/users/'.auth()->user()->profile->pic)}}" alt="user-img">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <span class="customer_data">
                                                        <h6>{{auth()->user()->name??''}}</h6>
                                                        <span class="contact">
                                                            <i class="fa-solid fa-phone"></i>
                                                            <a href="javascript:void(0)" class="phone-link">{{auth()->user()->customerPhonePrimary->phone??'Not Available'}}</a>
                                                        </span>
                                                         <span class="contact">
                                                            <i class="fa-solid fa-envelope"></i>
                                                            <a href="javascript:void(0)" class="email-link">{{auth()->user()->email??''}}</a>
                                                         </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="view_photos white-box">
                                                <h4>Photos</h4>
                                                <div class="search_photos">
                                                    <form>
                                                        <div class="txt_field">
                                                            <input type="search" class="form-control" placeholder="Search">
                                                        </div>
                                                        <button type="submit" class="btn btn-green"><i class="fa-solid fa-search"></i></button>
                                                    </form>
                                                    <div class="photos_gallery" id="photos_gallery">
                                                        <div id="loader" style="display: none;">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="activities_faqs white-box">
                                                <h4>FAQs</h4>
                                                <div class="search_photos">
{{--                                                    <form method="POST" action="{{url('send_support_message')}}">--}}
{{--                                                        <input type="hidden" name="sender_id" id="sender-id" value="{{auth()->user()->id??''}}">--}}
{{--                                                        <input type="hidden" name="sender_type" id="sender-type" value="customer">--}}
{{--                                                        <div class="txt_field">--}}
{{--                                                            <input type="text" class="form-control" id="support-message" name="message" placeholder="Ask any question">--}}
{{--                                                        </div>--}}
{{--                                                        <button type="button" class="btn btn-green" id="send-support-message"><i class="fa-solid fa-paper-plane"></i></button>--}}
{{--                                                    </form>--}}
                                                    <div class="accordion" id="faqAccordion">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq1">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse1">
                                                                    How can I request a quote for a construction project?
                                                                </button>
                                                            </h2>
                                                            <div id="faqcollapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    You can request a quote by filling out our contact form or reaching out through our inquiry number. We’ll connect you with a suitable contractor.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq2">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse2">
                                                                    What types of construction projects do you handle?
                                                                </button>
                                                            </h2>
                                                            <div id="faqcollapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    We handle residential, commercial, industrial, and renovation projects of all sizes.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq3">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse3">
                                                                    Do you offer residential and commercial construction services?
                                                                </button>
                                                            </h2>
                                                            <div id="faqcollapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    Yes, we offer both residential and commercial construction services tailored to your needs.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq4">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse4">
                                                                    How do I know if a lead is verified or genuine?
                                                                </button>
                                                            </h2>
                                                            <div id="faqcollapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    All leads are verified through a multi-step screening process before being listed or shared with you.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="faq5">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse5">
                                                                    Are your construction leads exclusive or shared with others?
                                                                </button>
                                                            </h2>
                                                            <div id="faqcollapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                                                <div class="accordion-body">
                                                                    We offer both exclusive and shared leads. You can choose your preference while subscribing.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Add more FAQs similarly -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="customer-photos" role="tabpanel">
                                <div class="customer_photos_container white-box">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="company_cam-tab" data-bs-toggle="tab" data-bs-target="#company_cam-tab-pane" type="button" role="tab" aria-controls="company_cam-tab-pane" aria-selected="true">Company CAM</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="all_photos-tab" data-bs-toggle="tab" data-bs-target="#all_photos-tab-pane" type="button" role="tab" aria-controls="all_photos-tab-pane" aria-selected="false">All Photos</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="company_cam-tab-pane" role="tabpanel" aria-labelledby="company_cam-tab" tabindex="0">
                                            <div class="filter_heading">
                                                <div class="sort_entries">
                                                    {{--                                                    <span>Show</span>--}}
                                                    {{--                                                    <select name="" id="entriesPerPageDocumentsCompany">--}}
                                                    {{--                                                        <option value="10">10</option>--}}
                                                    {{--                                                        <option value="8">8</option>--}}
                                                    {{--                                                        <option value="6">6</option>--}}
                                                    {{--                                                        <option value="4">4</option>--}}
                                                    {{--                                                        <option value="2">2</option>--}}
                                                    {{--                                                        <option value="1">1</option>--}}
                                                    {{--                                                    </select>--}}
                                                    {{--                                                    <span>entries</span>--}}
                                                </div>
                                                <div class="search_measurements">
                                                    <label>
                                                        <input type="search"
                                                               id="searchInputCompany"
                                                               placeholder="Search In Company CAM"
                                                               autocomplete="off">
                                                        <div class="search_icon">
                                                            <i class="fa fa-search"></i>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row custom_row_gap">
                                                @foreach($leads->flatMap->getphotoandDocument as $photo)
                                                    @foreach($photo->getDocuments as $doc)
                                                        <div class="col-md-3">
                                                            <div class="photo_container">
                                                                <div class="image_div">
                                                                    <img src="{{ asset('website') }}/{{$doc->name??''}}" alt="Photo">
                                                                </div>
                                                                <p class="p-16">{{$photo->getlead->title??''}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="all_photos-tab-pane" role="tabpanel" aria-labelledby="all_photos-tab" tabindex="0">
                                            <div class="filter_heading">
                                                <div class="sort_entries">
                                                    {{--                                                    <span>Show</span>--}}
                                                    {{--                                                    <select name="" id="entriesPerPageDocumentsAll">--}}
                                                    {{--                                                        <option value="10">10</option>--}}
                                                    {{--                                                        <option value="8">8</option>--}}
                                                    {{--                                                        <option value="6">6</option>--}}
                                                    {{--                                                        <option value="4">4</option>--}}
                                                    {{--                                                        <option value="2">2</option>--}}
                                                    {{--                                                        <option value="1">1</option>--}}
                                                    {{--                                                    </select>--}}
                                                    {{--                                                    <span>entries</span>--}}
                                                </div>
                                                <div class="search_measurements">
                                                    <label>
                                                        <input type="search"
                                                               id="searchInputAll"
                                                               placeholder="Search In Photos"
                                                               autocomplete="off">
                                                        <div class="search_icon">
                                                            <i class="fa fa-search"></i>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row custom_row_gap">
                                                @foreach($leads->flatMap->getphotoandDocument as $photo)
                                                    @foreach($photo->getDocuments as $doc)
                                                        <div class="col-md-3">
                                                            <div class="photo_container">
                                                                <div class="image_div">
                                                                    <img src="{{ asset('website') }}/{{$doc->name??''}}" alt="Photo">
                                                                </div>
                                                                <p class="p-16">{{$photo->getlead->title??''}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                                @foreach($leads->flatMap->getFolderManagement as $pictures)
                                                    @foreach($pictures->files as $picture)
                                                        @php
                                                            $fileExtension = pathinfo($picture['name'], PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if(in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg']))
                                                            <div class="col-md-3">
                                                                <div class="photo_container">
                                                                    <div class="image_div">
                                                                        <img src="{{ asset('website/leadsDocuments/' . $pictures['title'] . '/' . $picture['name']) }}" alt="Photo">
                                                                    </div>
                                                                    <p class="p-16">{{$pictures->getlead->title??''}}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="customer-referrals" role="tabpanel">
                                <div class="customer_referrals">
                                    <div class="referral_form white-box">
                                        <form method="POST" action="{{url('customerReferral/customer-referral')}}">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{auth()->user()->id}}">
                                            <h4>Referral</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">First Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field custom_phone_number">
                                                        <label class="form-label input_labels">Phone <span class="text-danger">*</span></label>
                                                        <input type="tel" class="form-control phoneInput phone" name="phone" placeholder="( ___ ) ___-____ " required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Address <span class="text-danger">*</span></label>
                                                        <input type="text" id="autocompleteaddress" class="form-control" name="address" placeholder="Enter Address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">City</label>
                                                        <input type="text" class="form-control" name="city" placeholder="Enter City">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">State</label>
                                                        <input type="text" class="form-control" name="state" placeholder="Enter State">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Zip</label>
                                                        <input type="number" min="0" class="form-control" name="zip" placeholder="Enter Zip">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Country</label>
                                                        <input type="text" class="form-control" name="country" placeholder="Enter Country">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text_field">
                                                        <label class="form-label input_labels">Note</label>
                                                        <textarea class="form-control" placeholder="Write a note here" name="note" rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="send_btn">
                                                        <button type="submit" class="btn green_btn">Send <i class="fa-solid fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="referral_table white-box">
                                        <div class="table_head">
                                            <h4>Recent Referrals</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Commission</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($referrals as $referral)
                                                    <tr>
                                                        <td>{{$referral->first_name??''}} {{$referral->last_name??''}}</td>
                                                        <td>{{$referral->phone??''}}</td>
                                                        <td>{{$referral->email}}</td>
                                                        <td>
                                                            <div class="status_btn">
                                                                @if($referral->status == 'added')
                                                                    <badge class="badge badge-success">
                                                                        Added
                                                                    </badge>
                                                                @else
                                                                    <badge class="badge badge-warning">
                                                                        Pending
                                                                    </badge>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="customer-payments" role="tabpanel">
                                <div class="customer_payments">
                                    <div class="custom_cards">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h6>Total Job Price</h6>
                                                    <h2>${{ number_format((float)($leads->sum('lead_price') ?? 0) + (float)($leads->flatMap->getChangeOrder->where('status','approved')->sum('total_amount') ?? 0), 2) }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h6>Total Paid Amount</h6>
                                                    <h2>${{number_format($leads->flatMap->getReceivePayments->sum('amount'), 2)}}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h6>Total Commission</h6>
                                                    <h2>-</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="customer_payment_container white-box">
                                        <div class="table_head">
                                            <h4>All Projects</h4>
                                        </div>
                                        <div class="filter_heading">
                                            <div class="sort_entries">
                                                {{--                                                <span>Show</span>--}}
                                                {{--                                                <select name="" id="" >--}}
                                                {{--                                                    <option value="10">10</option>--}}
                                                {{--                                                    <option value="8">8</option>--}}
                                                {{--                                                    <option value="6">6</option>--}}
                                                {{--                                                    <option value="4">4</option>--}}
                                                {{--                                                    <option value="2">2</option>--}}
                                                {{--                                                    <option value="1">1</option>--}}
                                                {{--                                                </select>--}}
                                                {{--                                                <span>entries</span>--}}
                                            </div>
                                            <div class="search_measurements">
                                                <form onsubmit="return false;">
                                                    <label>
                                                        <input type="search" class="" placeholder="Search by title" id="leadSearchInput">
                                                        <div class="search_icon">
                                                            <i class="fa fa-search"></i>
                                                        </div>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="custom_payment_accordion">
                                            @foreach($leads as $lead)
                                                <div class="accordion lead-accordion-item" id="accordionExample" data-lead-title="{{strtolower($lead->title??'Title Not Available')}}">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}">
                                                                {{$lead->title??'Title Not Available'}}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="payments_cards">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="card">
                                                                                <h6>Total Job Price</h6>
                                                                                <h2>${{ number_format((float)($lead->lead_price ?? 0) + (float)($lead->getChangeOrder->where('status','approved')->sum('total_amount') ?? 0), 2) }}</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="card">
                                                                                <h6>Amount Paid</h6>
                                                                                <h2>${{number_format($lead->getReceivePayments->sum('amount'), 2)}}</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="card">
                                                                                <h6>Amount Remaining</h6>
                                                                                <h2 class="remaining_amount">${{ number_format(
                                                                                ((float)($lead->lead_price ?? 0) + (float)($lead->getChangeOrder->where('status','approved')->sum('total_amount') ?? 0))
                                                                                - ($lead->getReceivePayments->sum('amount') ?? 0),
                                                                                2
                                                                            ) }}</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="payment_btn">
                                                                                <button type="button" class="btn green_btn chat_show_hide_wrapper" data-lead-id="{{ $lead->id }}" ><i class="fa-solid fa-comment"></i> Chat</button>
                                                                                <a href="{{url('lead_measurement')}}/{{$lead->id}}" class="btn measurement_button">View Measurements</a>
                                                                                @if($lead->getInvoice->isNotEmpty())
                                                                                <button type="button" class="btn green_btn paymentbtn">Make a Payment <i class="fa-solid fa-dollar"></i></button>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="table_head">
                                                                    <h4>Payment History</h4>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table" id="">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>
                                                                                    <button class="view_all_invoices_btn" title="Cumulative Invoices" type="button" data-lead-id="{{$lead->id}}">
                                                                                        <i class="fa-solid fa-file-zipper"></i>
                                                                                    </button>
                                                                                Invoice Number</th>
                                                                            <th>Price</th>
                                                                            <th>Status</th>
                                                                            <th>Due Date</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($lead->getInvoice as $invoice)
                                                                            <tr>
                                                                                <td>{{$invoice->invoice_unique_id??''}}</td>
                                                                                <td>${{number_format($invoice->total_amount ?? 0, 2)}}</td>
                                                                                <td>
                                                                                    <div class="status_btn">
                                                                                        @if($invoice->status == 'pending')
                                                                                            <badge class="badge badge-warning">
                                                                                                Pending
                                                                                            </badge>
                                                                                        @elseif($invoice->status == 'approved')
                                                                                            <badge class="badge badge-success">
                                                                                                Approved
                                                                                            </badge>
                                                                                        @elseif($invoice->status == 'rejected')
                                                                                            <badge class="badge badge-danger">
                                                                                                Rejected
                                                                                            </badge>
                                                                                        @endif
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('m-d-Y') }}</td>
                                                                                <td>
                                                                                    <div class="pdf_download">
                                                                                        <a href="javascript:void(0)" class="view_invoice_modal_btn" invoice-id="{{$invoice->id}}">
                                                                                            <i class="fa-solid fa-file"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="customer_leads_chat_w_two" style="display: none;"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Scheduling Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body scheduling-modal-body">
                </div>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="custom-close">&times;</span>
            <iframe id="paymentIframe" class="custom-iframe" src="" frameborder="0"></iframe>
        </div>
    </div>

    <div id="viewInvoiceModal" class="modal fade" tabindex="-1" aria-labelledby="viewInvoiceModal" aria-hidden="true" ></div>
    <div id="viewAllInvoiceModal" class="modal fade" tabindex="-1" aria-labelledby="viewAllInvoiceModal" aria-hidden="true" ></div>

@endsection
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,geometry&key={{env('googleAPI')}}" async defer></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



    <script>
        window.onload = function() {
            function activateTab(hash) {
                if (!hash) {
                    hash = window.location.hash;
                }
                console.log('hash', hash);
                if (hash) {
                    var $targetLink = null;
                    // Iterate through all tab buttons
                    $('.customer_dashboard_section  .nav-link[data-bs-toggle="tab"]').each(function() {
                        if ('#' + $(this).attr('id') === hash) {
                            $targetLink = $(this);
                            return false;
                        }
                    });
                    if ($targetLink && $targetLink.length) {
                        var tab = new bootstrap.Tab($targetLink[0]);
                        tab.show();
                        var html = $targetLink.html();
                        console.log('targetLink HTML:', html);
                    } else {
                        console.log('No button found with id="' + hash + '"');
                    }
                }
            }
            activateTab();
        };


        $('.chat_show_hide_wrapper').on('click', function () {
            const leadId = $(this).data('lead-id');
            const $chatBox = $('.customer_leads_chat_w_two');
            $chatBox.html('<div class="text-center py-4">Loading chat...</div>').show();
            $.ajax({
                url: '{{url("get_lead_chat")}}',
                method: 'GET',
                data: { lead_id: leadId },
                success: function(response) {
                    $chatBox.html(response);
                    const $messages = $chatBox.find('.chat-messages');
                    // $messages.scrollTop($messages[0].scrollHeight);
                },
                error: function() {
                    $chatBox.html('<div class="text-center py-4">Error loading chat</div>');
                }
            });
        });

        $(document).ready(function() {
            initAutocomplete(); // Manually initialize the autocomplete function
        });

        let autocomplete;

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocompleteaddress'),
                {
                    types: ['geocode', 'establishment'],
                }
            );

            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            const place = autocomplete.getPlace();

            if (place.address_components) {
                place.address_components.forEach(function(component) {
                    const componentType = component.types[0];
                    switch (componentType) {
                        case 'locality':
                            document.getElementsByName('city')[0].value = component.long_name;
                            break;
                        case 'administrative_area_level_1':
                            document.getElementsByName('state')[0].value = component.short_name;
                            break;
                        case 'postal_code':
                            document.getElementsByName('zip')[0].value = component.long_name;
                            break;
                        case 'country':
                            document.getElementsByName('country')[0].value = component.long_name;
                            break;
                    }
                });
            }
        }
    </script>

    <script>
        $(function () {
            $('#myTable').DataTable({
                'lengthChange': false,
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1], /* 1st one, start by the right */
                }]
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function attachSearch(tabId, searchId) {
                const search = document.getElementById(searchId);
                const containers = document.querySelectorAll(`#${tabId} .row > .col-md-3`);
                search.addEventListener('input', function() {
                    const term = this.value.toLowerCase();
                    containers.forEach(container => {
                        const title = container.querySelector('p.p-16').textContent.toLowerCase();
                        container.style.display = title.includes(term) ? '' : 'none';
                    });
                });
            }
            attachSearch('company_cam-tab-pane', 'searchInputCompany');
            attachSearch('all_photos-tab-pane', 'searchInputAll');
        });
    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error('Calendar element not found');
                return;
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                firstDay: @if(App\CommonSetting::first()->calendar == 1) 1
                @elseif(App\CommonSetting::first()->calendar == 2) 1
                @elseif(App\CommonSetting::first()->calendar == 3) 0 @endif,
                hiddenDays: @if(App\CommonSetting::first()->calendar == 2) [0, 6] @else [] @endif,
                timeZone: @if(App\CommonSetting::first()->calendar == 3) 'local' @else 'UTC' @endif,
                headerToolbar: {
                    left: 'title',
                    center: '',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,prev,next,today'
                },
                titleFormat: { year: 'numeric', month: 'long' },
                dayHeaderFormat: { weekday: 'long' },
                editable: false,
                eventLimit: 5,
                views: {
                    month: {
                        showNonCurrentDates: false,
                        fixedWeekCount: false
                    }
                },
                events: [
                        @foreach ($leads as $data)
                        @if ($data->getAppointment && $data->getAppointment->isNotEmpty())
                        @foreach ($data->getAppointment as $appointment)
                        @php
                            $startDate = \Carbon\Carbon::parse($appointment->date_time_from);
                            $endDate = \Carbon\Carbon::parse($appointment->date_time_to);
                            if ($endDate->lt($startDate)) {
                                $endDate = $startDate->copy()->addHour();
                            }
                            $startFormatted = $startDate->format('Y-m-d H:i');
                            $endFormatted = $endDate->format('Y-m-d H:i');
                        @endphp
                    {
                        id: '{{ $appointment->id }}',
                        title: '{{ addslashes($appointment->title ?? 'N/A') }}',
                        start: '{{ $startFormatted }}',
                        end: '{{ $endFormatted }}',
                        type: 'Appointment',
                        location: '{{ $appointment->location ?? 'N/A' }}',
                        status: '{{ $appointment->status == 1 ? 'Active' : 'Inactive' }}',
                        attendees: [
                            @foreach($appointment->getAppointmentAttendee as $key => $item)
                                '{{ $item->AttendeesDetail->name ?? 'N/A' }}'{{ $loop->last ? '' : ',' }}
                                    @endforeach
                        ].join(','),
                        description: '{!! json_encode($appointment->description ?? '') !!}',
                        images: [
                            @foreach($appointment->images as $key => $item)
                                '{{ $item->name ?? '' }}'{{ $loop->last ? '' : ',' }}
                                    @endforeach
                        ],
                        color: '{{ $appointment->getAppointmentAttendee[0]->AttendeesDetail->profile->colour_id ?? '' }}',
                        customerName: '{{ $appointment->customer->name ?? 'N/A' }}',
                        leadName: '{{ $appointment->lead->title ?? 'N/A' }}',
                        leadId: '{{ $appointment->lead->id ?? '' }}',
                        jobTitle: '{{ $appointment->customer->profile->job_title ?? 'N/A' }}',
                        completion_status: '{{ $appointment->completion_status ?? '' }}',
                        appointment_for_lead_id: '{{ $appointment->appointment_for_lead_id ?? '' }}'
                    },
                        @endforeach
                        @endif
                        @if ($data->schedulingTask && $data->schedulingTask->isNotEmpty())
                        @foreach ($data->schedulingTask as $task)
                    {
                        id: '{{ $task->id }}',
                        title: '{{ addslashes($task->name ?? 'N/A') }}',
                        start: '{{ \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') }}',
                        end: '{{ \Carbon\Carbon::parse($task->end_date)->format('Y-m-d') }}',
                        type: 'Task',
                        description: '{!! json_encode($task->description ?? '') !!}',
                        color: '{{ $task->color_id ?? '' }}',
                        lead: '{{ $task->getLead->title ?? 'N/A' }}',
                        leadId: '{{ $task->getLead->id ?? '' }}',
                        users: [
                            @foreach ($task->getSchedulingUser as $key => $item)
                                '{{ $item->getSchedulingUser->name ?? 'N/A' }}'{{ $loop->last ? '' : ',' }}
                                    @endforeach
                        ].join(','),
                        team: '{{ $task->getTeam->name ?? 'N/A' }}',
                        address: '{{ $task->getLead->address ?? 'N/A' }}'
                    },
                    @endforeach
                    @endif
                    @endforeach
                ],
                eventDidMount: function(info) {
                    try {
                        if (info.event.extendedProps.completion_status === 'complete' && info.event.extendedProps.type === 'Appointment') {
                            var tickIcon = document.createElement('i');
                            const eventContent = info.el.querySelector('.fc-event-main') || info.el.querySelector('.fc-content') || info.el;
                            if (eventContent) {
                                eventContent.prepend(tickIcon);
                            } else {
                                console.warn('Event content element not found for event:', info.event.title);
                            }
                        }

                        // Handle white background events
                        if (/^#ffffff$|^rgb\s*$$ \s*255\s*,\s*255\s*,\s*255\s* $$$|^rgba\s*$$ \s*255\s*,\s*255\s*,\s*255\s*,\s*1\s* $$$|^hsla\s*$$ \s*0\s*,\s*0\s*,\s*100\s*,\s*1\s* $$$/.test(info.event.backgroundColor)) {
                            info.el.style.borderColor = 'black';
                            info.el.classList.add('white-bg-event');
                        }

                        var startTime = moment(info.event.start).format('h:mm A');
                        var eventTimeEl = info.el.querySelector('.fc-event-time');
                        var eventTitleEl = info.el.querySelector('.fc-event-title');
                        var eventDotEl = info.el.querySelector('.fc-daygrid-event-dot');

                        if (eventDotEl) {
                            eventDotEl.style.display = 'none'; // Directly hide the dot element
                        }
                        if (eventTimeEl) {
                            eventTimeEl.textContent = startTime;
                            eventTimeEl.style.backgroundColor = info.event.backgroundColor;
                            if (info.event.backgroundColor === '#ffffff') {
                                eventTimeEl.style.color = '#000000';
                            } else if(info.event.backgroundColor === '#000000') {
                                eventTitleEl.style.color = '#ffffff';
                            }
                        }
                        if (eventTitleEl) {
                            eventTitleEl.style.backgroundColor = info.event.backgroundColor;
                            if (info.event.backgroundColor === '#ffffff') {
                                eventTitleEl.style.color = '#000000'; // Black text for white background
                            } else if(info.event.backgroundColor === '#000000') {
                                eventTitleEl.style.color = '#ffffff'; // Black text for white background
                            }
                        }
                    } catch (error) {
                        console.error('Error in eventDidMount:', error);
                    }
                },
                eventClick: function(info) {
                    try {
                        var event = info.event;
                        var decodedDescription = event.extendedProps.description ? JSON.parse(event.extendedProps.description) : '';
                        var modalBody = '';

                        if (event.extendedProps.type === 'Appointment') {
                            modalBody = `
                <div class="staff_calendar_modal_content">
                    <div class="row">
                        <div class="col-md-6"><p><label>Title:</label> <input type="text" class="form-control" value="${event.title || 'N/A'}" readonly></p></div>
                        <div class="col-md-6"><p><label>Lead Attendees:</label> <input type="text" class="form-control" value="${event.extendedProps.attendees || 'N/A'}" readonly></p></div>
                        <div class="col-md-6"><p><label>Status:</label> <span class="badge badge-success pending pric_span">${event.extendedProps.status || 'N/A'}</span></p></div>
                        <div class="col-md-6"><p><label>Location:</label> <input type="text" class="form-control" value="${event.extendedProps.location || 'N/A'}" readonly></p></div>
                        <div class="col-md-12"><p><label>Description:</label> <textarea class="form-control" rows="5" readonly>${decodedDescription || ''}</textarea></p></div>
                        <div class="col-md-12"><p><label>Images:</label></p>
                            <div class="event-images">
                                ${event.extendedProps.images.length > 0 ?
                                event.extendedProps.images.map(image => `
                                    <div class="event-image">
                                        <a href="{{ asset('website') }}/${image}" target="_blank">
                                            <div class="file">
                                                <div class="image"><img src="{{ asset('website') }}/${image}"></div>
                                                <div class="download_btn">View/Download</div>
                                            </div>
                                        </a>
                                    </div>`).join('') : 'Not Available'}
                            </div>
                        </div>

                        <div class="col-md-6"><p>Start: ${moment(event.start).format('MMMM DD, YYYY h:mm A')}</p></div>
                        ${event.end ? `<div class="col-md-6"><p>End: ${moment(event.end).format('MMMM DD, YYYY h:mm A')}</p></div>` : ''}
                    </div>
                </div>`;
                        } else {
                            modalBody = `
                <div class="row">
                    <div class="col-md-6"><p><label>Lead:</label> <input type="text" class="form-control" value="${event.extendedProps.lead || 'N/A'}" readonly></p></div>
                    <div class="col-md-6"><p><label>Task:</label> <input type="text" class="form-control" value="${event.title || 'N/A'}" readonly></p></div>
                    <div class="col-md-6"><p><label>Assign User:</label> <input type="text" class="form-control" value="${event.extendedProps.users || 'N/A'}" readonly></p></div>
                    <div class="col-md-6"><p><label>Assign Team:</label> <input type="text" class="form-control" value="${event.extendedProps.team || 'N/A'}" readonly></p></div>
                    <div class="col-md-6"><p><label>Start Date:</label> <input type="text" class="form-control" value="${moment(event.start).format('MM-DD-YYYY')}" readonly></p></div>
                    <div class="col-md-6"><p><label>End Date:</label> <input type="text" class="form-control" value="${moment(event.end).format('MM-DD-YYYY')}" readonly></p></div>
                    <div class="col-md-12"><p><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>${decodedDescription || ''}</textarea></p></div>
                </div>`;
                        }

                        // Update the static modal's content
                        var modal = document.getElementById('eventModal');
                        if (!modal) {
                            console.error('Modal with ID "eventModal" not found in the DOM');
                            return;
                        }

                        var modalTitle = modal.querySelector('#eventModalLabel');
                        var modalBodyElement = modal.querySelector('.scheduling-modal-body');

                        if (modalTitle && modalBodyElement) {
                            modalTitle.textContent = event.title || 'N/A';
                            modalBodyElement.innerHTML = modalBody;
                            $(modal).modal('show');
                        } else {
                            console.error('Modal title or body element not found in eventModal');
                        }
                    } catch (error) {
                        console.error('Error in eventClick:', error);
                    }
                },

                eventsSet: function() {
                    const title = document.querySelector('.fc-toolbar-title');
                    if (title) {
                        // Get the current month and year from FullCalendar's view
                        const calendarApi = this; // 'this' refers to the FullCalendar instance
                        const currentViewTitle = calendarApi.view.title; // e.g., "October 2025"

                        // Set the title with the current month and year only
                        title.innerHTML = `Calendar <span class="calendar-title">${currentViewTitle}</span> <img src="{{ asset('website/images/arrow-up-right.svg') }}" alt="Arrow">`;

                        // Add CSS class for styling
                        title.classList.add('custom-calendar-title');
                    }
                }

            });

            calendar.render();
        });
    </script>

    <script>
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

        $(document).on('click', '.view_all_invoices_btn', function (e) {
            var id = $(this).data('lead-id');
            $.ajax({
                url: "{{route('view_all_invoice_detail')}}",
                type: 'get',
                data: {
                    'id': id,
                },
                success: function (result) {
                    $('#viewAllInvoiceModal').html(result);
                    $('#viewAllInvoiceModal').modal('show');
                    // console.log(result)
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>

    <script>
        document.getElementById('leadSearchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const accordionItems = document.querySelectorAll('.lead-accordion-item');

            accordionItems.forEach(item => {
                const title = item.getAttribute('data-lead-title');

                if (title.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        $('.phone').mask('(000) 000-0000');
    </script>

    <script>
        $('.phoneInput').on('blur', function() {
            const inputElement = $(this);
            const phoneNumber = inputElement.val();
            if (phoneNumber) {
                $.ajax({
                    url: '{{ url('phone_authentication') }}',
                    method: 'POST',
                    data: JSON.stringify({
                        "_token": "{{ csrf_token() }}",
                        phone: phoneNumber
                    }),
                    contentType: 'application/json',
                    success: function(data) {
                        const messageDiv = inputElement.closest('.custom_phone_number').next('.phoneValidationMessage');
                        if (data.duplicate) {
                            messageDiv.text("This phone number is already in use.");
                            messageDiv.css("color", "red");
                        } else if (data.valid) {
                            messageDiv.text("Phone number is authentic.");
                            messageDiv.css("color", "green");
                        } else {
                            messageDiv.text(data.message || "Phone number is not authentic or invalid.");
                            messageDiv.css("color", "red");
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        const messageDiv = inputElement.closest('.custom_phone_number').next('.phoneValidationMessage');
                        messageDiv.text("An error occurred while validating the phone number.").css("color", "red");
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#loader').show();
            $.ajax({
                url: '{{url("get_cam_photos")}}',
                method: 'GET',
                success: function(response) {
                    var responseData = JSON.parse(response.response);

                    responseData.forEach(function(item) {
                        var imageUrl = '';

                        item.uris.forEach(function(uriObj) {
                            if (uriObj.type === 'original') {
                                imageUrl = uriObj.uri;
                            }
                        });

                        if (imageUrl) {
                            $('#photos_gallery').append(`
                        <div class="custom_images">
                            <img src="${imageUrl}" alt="Image">
                        </div>
                    `);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        });


    </script>

    <script>
        $(document).on('click', '#send-support-message', function (e) {
            var message = $('#support-message').val();
            var senderId = $('#sender-id').val();
            var senderType = $('#sender-type').val();
            $.ajax({
                url: "{{url('send_support_message')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'message': message,
                    'sender_id': senderId,
                    'sender_type': senderType,
                },
                success: function (result) {
                    Swal.fire('Your message has submitted. We will reach you shortly.');
                },
                error: function (e) {
                    Swal.fire('Something went wrong. Please try in a moment.');
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.paymentbtn').forEach(function(button) {
            button.addEventListener('click', function () {
                const modal = document.getElementById('paymentModal');
                const iframe = document.getElementById('paymentIframe');

                iframe.src = "https://secure.bluepay.com/interfaces/shpf?SHPF_FORM_ID=mobilecap02D&SHPF_ACCOUNT_ID=100924469609&SHPF_TPS_DEF=SHPF%5FFORM%5FID%20SHPF%5FACCOUNT%5FID%20DBA%20TAMPER%5FPROOF%5FSEAL%20AMEX%5FIMAGE%20DISCOVER%5FIMAGE%20TPS%5FDEF%20TPS%5FHASH%5FTYPE%20SHPF%5FTPS%5FDEF%20CUSTOM%5FHTML%20SHPF%5FTPS%5FHASH%5FTYPE%20CAPTCHA%5FREQUIRED&SHPF_TPS_HASH_TYPE=HMAC%5FSHA512&SHPF_TPS=6fd63289ef78f349d294a800d4ffc900737fc97791e3b2bab5d5b646de1b5df412e1cf85ced14875dd3f5c75874bde822462bfed6a697451ef5f6374e7b46344&MODE=LIVE&TRANSACTION_TYPE=SALE&DBA=MJT%20Roofing&AMOUNT=&TAMPER_PROOF_SEAL=891626534501ed626264397c148e736d8237107223f2ccb006f993398c33b83b43867f7f088cf97e8b39e00b1c7684102112f3d21e53c71d6b2feb606403e17c&CUSTOM_ID=&CUSTOM_ID2=&REBILLING=0&REB_CYCLES=&REB_AMOUNT=&REB_EXPR=&REB_FIRST_DATE=&AMEX_IMAGE=amex%2Egif&DISCOVER_IMAGE=discvr%2Egif&REDIRECT_URL=https%3A%2F%2Fsecure%2Ebluepay%2Ecom%2Finterfaces%2Fshpf%3FSHPF%5FFORM%5FID%3Dmobileresult01%26SHPF%5FACCOUNT%5FID%3D100924469609%26SHPF%5FTPS%5FDEF%3DSHPF%255FACCOUNT%255FID%2520SHPF%255FFORM%255FID%2520RETURN%255FURL%2520DBA%2520AMEX%255FIMAGE%2520DISCOVER%255FIMAGE%2520SHPF%255FTPS%255FDEF%2520SHPF%255FTPS%255FHASH%255FTYPE%26SHPF%5FTPS%5FHASH%5FTYPE%3DHMAC%255FSHA512%26SHPF%5FTPS%3Dd52132ad1bd12e924ecdb3aed54089d72912d5c76007c46b61bc8d7e0a97bc0821c77937ad3c5727e8236f4c7387d642b05f8adc69cb63d0a915ed596b8929c4%26RETURN%5FURL%3D%26DBA%3DMJT%2520Roofing%26AMEX%5FIMAGE%3Damex%252Egif%26DISCOVER%5FIMAGE%3Ddiscvr%252Egif&TPS_DEF=MERCHANT%20APPROVED%5FURL%20DECLINED%5FURL%20MISSING%5FURL%20MODE%20TRANSACTION%5FTYPE%20TPS%5FDEF%20TPS%5FHASH%5FTYPE%20CAPTCHA%5FREQUIRED&TPS_HASH_TYPE=HMAC%5FSHA512&CUSTOM_HTML=&CARD_TYPES=vi%2Dmc%2Ddi%2Dam&CAPTCHA_REQUIRED=1";

                modal.style.display = 'block';
            });
        });

        document.querySelector('.custom-close').addEventListener('click', function () {
            const modal = document.getElementById('paymentModal');
            const iframe = document.getElementById('paymentIframe');
            iframe.src = "";
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            const modal = document.getElementById('paymentModal');
            if (event.target === modal) {
                document.getElementById('paymentIframe').src = "";
                modal.style.display = "none";
            }
        });
    </script>
@endpush
