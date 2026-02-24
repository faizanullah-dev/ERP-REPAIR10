@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box lead_lead_page my_lead_parent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box-header">
                                <div class="white-box-header-left">
                                    <h3 class="box-title">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead ') }}</h3>
                                </div>
                                <div class="white-box-header-right">
                                    @can('add-'.str_slug('Lead'))
                                        <a class="btn blue_btn " href="{{ url('/lead/lead/create') }}">  Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }} <i class="icon-plus"></i> </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="logoBtn_drop_wrapper">
                                <div class="logobtn_left_box button_logo">
                                    @can('delete-'.str_slug('Lead'))
                                        <button type="button" class="btn green_btn delete_inbox_email" data-notification-id="" id="btn-delete-multiple" data-toggle="tooltip" data-placement="top" title="Delete" > <i class="fa-solid fa-trash"></i> </button>
                                    @endcan
                                    @can('view-usersmailboxconfiguration')
                                        <button type="button" class="btn green_btn add_job_note_modal_btn" data-toggle="tooltip" data-placement="top" title="Emails" > <i class="fa-solid fa-envelope"></i> </button>
                                    @endcan
                                    @can('add-'.str_slug('Task'))
                                        <button type="button" class="btn green_btn add_task_modal_btn" data-toggle="tooltip" data-placement="top" title="Add Task" > <i class="fa-solid fa-list-check"></i> </button>
                                    @endcan
                                    @can('add-'.str_slug('JobNote'))
                                        <button type="button" class="btn green_btn add_jobnote_btn" data-toggle="tooltip" data-placement="top" title="Job Note" > <i class="fa-solid fa-file-lines"></i> </button>
                                    @endcan

                                </div>

                                <div class="logobtn_right_box customer_right_logo_btn">
                                    <button type="button" class="btn green_btn  exportToExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Export to Excel">
                                        <i class="fa-solid fa-file-excel"></i>
                                    </button>
                                    <div class="view_type_box" >
                                        <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" class="btn green_btn {{ Request::is('lead_card_view') ? 'active' : '' }}"><img class="img-fluid" src="{{ asset('/website/images').'/cards-blank.svg' }} " ></a>
                                        <a href="{{ url('lead/lead') }}" class="btn green_btn {{ Request::is('lead/lead') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></a>
                                        <a href="{{ url('map_view_lead') }}" class="btn green_btn {{ Request::is('map_view_lead') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i></a>
                                        <a href="{{ url('calender_task_view') }}" class="btn green_btn {{ Request::is('calender_task_view') ? 'active' : '' }}"><i class="fa-solid fa-calendar"></i></a>
                                    </div>
                                    <div class="lead_archive_btn">
                                        @if(request('lead_card_view_status') == 'archive')
                                            <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" title="View Unarchive">
                                                <button type="button" class="btn green_btn">View Unarchive <i class="fa fa-archive" aria-hidden="true"></i></button>
                                            </a>
                                        @elseif(request('lead_card_view') == '')
                                            <a href="{{ url('lead_card_view?lead_card_view_status=archive') }}" title="View Archive">
                                                <button type="button" class="btn green_btn">View Archive <i class="fa fa-archive" aria-hidden="true"></i></button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <diV class="form-group">
                                    <input type="text" class="search-input form-control" placeholder="Search By Lead Name" >
                                </diV>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form method="get" action="{{url('lead_card_view')}}" id="filter-form">
                                <div class=" filter_inputs_btns_wrapper form-group">
                                    <input type="hidden" name="lead_filter" value="yes">
                                    <div class="filter_inputs_parent">
                                        <label for="Select Category" class="form-label input_labels p-18">Select Category </label>
                                        <select class="form-control  select2 select_category_initialize" data-placeholder="Select Category" id="categoryFilter" name="category_id" >
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        if (request()->get('duration_starts') && request()->get('duration_ends')) {
                                            $yearEstimation = (object) [
                                                'year' => request()->get('duration_starts')
                                            ];
                                            $durationEnds = request()->get('duration_ends');
                                        } else {
                                            $durationEnds = now()->endOfYear()->format('Y-m-d');
                                        }
                                    @endphp
                                    <div class="filter_inputs_parent">
                                        <label for="duration_starts" class="form-label input_labels p-18">To </label>
                                        <input class="form-control clr_input_fields "  name="duration_starts" value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" type="date" id="duration_starts"  placeholder="Enter duration_starts"  >
                                    </div>
                                    <div class="filter_inputs_parent">
                                        <label for="duration_ends" class="form-label input_labels p-18">From </label>
                                        <input class="form-control clr_input_fields " name="duration_ends" type="date" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}"  placeholder="duration_ends to_date"  >
                                    </div>
                                    <div class="filter_inputs_parent filter_btns_parent">
                                        <div class="reset_apply_btn">
                                            <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                            <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row user-view-head">
                    <div class="col-md-3">
                        <div class="item-card-view">
                            <h4>New</h4>
                            <ul>
                                <li> {{ $leadCount->where('lead_status', 'new')->count() }} </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item-card-view">
                            <h4>Won</h4>
                            <ul>
                                <li> {{ $leadCount->where('lead_status', 'won')->count() }} </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item-card-view">
                            <h4> Pending </h4>
                            <ul>
                                <li> {{ $leadCount->where('lead_status', 'pending')->count() }} </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item-card-view">
                            <h4>Lost</h4>
                            <ul>
                                <li> {{ $leadCount->where('lead_status', 'lost')->count() }} </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row lead-card-view">
                    @if($lead->count() > 0)
                        @foreach($lead as $item)
                            <div class="col-md-4">
                                <div class="item-card-view">
                                    <div class="lead-card-top">
                                        <div class="custom_checkbox">
                                            <input class="noti_check noti_checks" type="checkbox" id="cardCheckbox{{ $item->id }}" data-leadCheck-id="{{ $item->id }}" data-user-id="{{ $item->customer_id }}">
                                            <label for="cardCheckbox{{ $item->id }}"></label>
                                        </div>
                                        <div class="image-status">
                                            <div class="image-count">
                                                @php
                                                    $totalDocuments = 0;
                                                        foreach ($item->getphotoandDocument as $photoAndDocument) {
                                                            $totalDocuments += count($photoAndDocument->getDocuments);
                                                        }
                                                    $displayed = 0;
                                                @endphp
                                                @if($totalDocuments == 0)
                                                    @if($item->lead_icon != null)
                                                        <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                            <img src="{{ asset('website').'/'.$item->lead_icon??'' }} " >
                                                        </a>
                                                    @else
                                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                        <img src="{{ asset('/website/images').'/by_default_two.png' }} " >
                                                    </a>
                                                    @endif
                                                @else
                                                    @foreach ($item->getphotoandDocument as $photoAndDocument)
                                                        @foreach($photoAndDocument->getDocuments->where('doc_primary',1) as $document)
                                                            @if($displayed < 1)
                                                                @php
                                                                    $fileExtension = strtolower(array_reverse(explode('.', $document->name))[0]);
                                                                @endphp
                                                                @if(isset($document->name) && in_array($fileExtension, ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif','webp', 'x-shockwave-flash']))
                                                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                                        <img src="{{ asset('website') }}/{{$document->name}}" >
                                                                    </a>
                                                                @elseif(isset($document->name) && $fileExtension == 'pdf')
                                                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                                        <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                                    </a>
                                                                @elseif(isset($document->name) && in_array($fileExtension, ['doc', 'docx', 'txt']))
                                                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                                        <img src="{{ asset('/website/images').'/Word-Logo.png' }}" >
                                                                    </a>
                                                                @else
                                                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                                        <img src="{{ asset('/website/images').'/user_profile.png' }} " >
                                                                    </a>
                                                                @endif
                                                                @php $displayed++; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endforeach


                                                    @if($totalDocuments > 1)
                                                        <span class="count"> +{{ $totalDocuments - $displayed }} </span>
                                                    @endif
                                                @endif
                                            </div>
                                            @if($item->lead_status == 'won')
                                                <span class='badge won'>WON</span>
                                            @elseif($item->lead_status == 'lost')
                                                <span class='badge lost'>LOST</span>
                                            @elseif($item->lead_status == 'pending')
                                                <span class='badge pending'>PENDING</span>
                                            @else
                                                <span class='badge badge-info'>NEW</span>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                        <h4> {{ $item->title??"Not Available" }}
                                            @if($item->getProposal->isNotEmpty() && !is_null($item->getProposal->sortByDesc('created_at')->first()->signature))
                                                <i class="proposal_signed_flag fa fa-flag" data-toggle="tooltip" data-placement="top" title="Proposal Signed"></i>
                                            @endif
                                        </h4>
                                    </a>
                                    <ul>
                                        <li class="customer"> <b>Customer: </b> {{ $item->customer->name??"Not Available" }} </li>
                                        {{--                                        <li class="customer"> <b>Customer Number: </b> R{{ $item->customer->created_at->format('ymd')??"Not Available" }} </li>--}}
                                        <li class="customer">
                                            @if (!empty($item->customer) && !empty($item->customer->created_at))
                                                <b>Customer Number: </b> {{$item->customer->profile->customer_number ?? 'R'.$item->customer->created_at->format('mdY') ?? "Not Available"}}
                                            @else
                                                <b>Customer Number: </b> Not Available
                                            @endif
                                        </li>

                                        <li class="representative"> <b>Representative: </b> {{ $item->representative->name??"Not Available" }} </li>
                                        <li class="category"> <b>Category: </b> {{ str_limit($item->category->name??"Not Available",10) }} </li>
                                        <li class="lead-no">
                                            @if (!empty($item->lead_number))
                                                @if (preg_match('/[a-zA-Z]/', $item->lead_number))
                                                    <b>Lead Number: </b> {{ $item->lead_number }}
                                                @else
                                                    <b>Lead Number: </b> {{ strtoupper($item->category->name[0]??'L') }}{{ $item->lead_number }}
                                                @endif
                                            @else
                                                <b>Lead Number: </b> Not Available
                                            @endif
                                        </li>
                                        <li class="interaction"><b>Last Activity:</b>
                                            @if($latestCommunication = $item->notifications->last())
                                                {{ $latestCommunication->model }}
                                            @else
                                                No interaction available
                                            @endif
                                        </li>
                                        @php
                                            $dateString = $item->lead_date;
                                            $dateObject = new DateTime($dateString);
                                            $formattedDate = $dateObject->format('F - d- Y');
                                            $statusDate = $item->lead_status_date;
//                                            $statusObject = new DateTime($statusDate);
//                                            $formattedStatusDate = $statusDate->format('Y - F - d');
                                        @endphp

                                        <li class="JobStartsDate:">
                                            <b>Job Starts Date: </b> {!! $formattedDate??"Not Available" !!}
                                            <a href="javascript:void(0)"  data-toggle="modal" data-target="#job_detail_start_date_modal" data-job-id="{{ $item->id }}" data-initial-date="{{ $item->lead_date }}"><i class="fa fa-pencil"></i></a>
                                        </li>
                                        <li class="lead-no">
                                            @if (!empty($item->job_number))
                                                @if (preg_match('/[a-zA-Z]/', $item->job_number))
                                                    <b>Job Number: </b> {{ $item->job_number }}
                                                @else
                                                    <b>Job Number: </b> {{ strtoupper($item->category->name[0]??'J') }}{{ $item->job_number }}
                                                @endif
                                            @else
                                                <b>Job Number: </b> Not Available
                                            @endif
                                        </li>
                                        <li class="JobStartsDate:">
                                            <b>Job Status Date: </b> {!! \Carbon\Carbon::parse($item->lead_status_date ?? '')->format('m-d-Y') ?? "Not Available" !!}
                                        </li>
                                        <li class="address"> <b>Address: </b> {{ substr($item->address,0,37),'...' }} </li>
                                        <li class="action">
                                            @can('view-'.str_slug('Lead'))
                                                <a href="{{ url('view_lead/' . $item->id) }}" title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}" class="btn btn_icon blue_btn">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                            @can('delete-'.str_slug('Lead'))
                                                <form method="POST"  action="{{ url('/lead/lead' . '/' . $item->id) }}" accept-charset="UTF-8"  class="delete-form">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="btn btn_icon gray_btn"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}"
                                                            onclick="showDeleteConfirmation(this)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                            <a class="btn btn_icon job_insurance_for_lead gray_btn" lead-id="{{$item->id}}" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-house-damage"></i></a>
                                            <a class="btn btn_icon float-right lead_check {{ $item->archive_status == 'archive' ? 'btn-success' : 'btn-warning' }}" id="archive_btn" href="{{ route('status_change_lead_card_view', [$item->id, $item->archive_status == 'archive' ? 'unarchive' : 'archive']) }}" role="button" aria-controls="offcanvasExample" title="{{ $item->archive_status == 'archive' ? 'Archive' : 'Unarchive' }}"><i class="fas fa-archive"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <p class="text-center">No data found.</p>
                        </div>
                    @endif

                </div>
                <div class="pagination-wrapper">
                    {!! $lead->appends([
                           'search' => request('search'),
                           'lead_card_view_status' => request('lead_card_view_status'),
                           'lead_type' => request('lead_type'),
                           'lead_filter' => request('lead_filter'),
                           'category_id' => request('category_id'),
                           'duration_starts' => request('duration_starts'),
                           'duration_ends' => request('duration_ends')
                       ])->render() !!}
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="addEmails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailvalidate" method="get" id="email_form" action="{{route('send_email_to_users')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailTemplateSelect" class="form-label input_labels">Select Email Folder <span class="text-danger">*</span></label>
                                        <select class="form-control borderRadius custom_modal_select2 template_folder" data-placeholder="Select Email Folder" required>
                                            <option value=""></option>
                                            @foreach($emailTemplateFolder as $value)
                                                <option value="{{ $value->id }}" email-template="{{ $value->id }}">{{ $value->name??"" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailTemplateSelect" class="form-label input_labels">Select Email Template <span class="text-danger">*</span></label>
                                        <select class="form-control borderRadius custom_modal_select2 email_template" data-placeholder="Select Email Template" id="emailTemplateSelect" name="email_template_id" required>
                                            <option value=""></option>
                                            @foreach($emailTemplates as $value)
                                                <option value="{{ $value->id }}">{{ $value->title??"" }}</option>
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
                                    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                        <label for="images" class="control-label">{{ 'Attachments' }} <span class="text-danger">*</span></label>
                                        <div action="#" id="addEmailsDropzone" class="dropzone">
                                            <div class="fallback">
                                                <input name="images" id="" type="file" multiple accept="image/*" required />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="imageContainer"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mailDescription" class="input_labels control-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control subject_description" rows="5" name="description" id="mail_description" required></textarea>
                                    </div>
                                </div>
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="submit_btn_modal">
                                        <button class="btn green_btn borderRadius add_task_modal_btn_two" type="submit">Submit <i class="fa-solid fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal taskvalidate" method="get" id="task_form" action="{{route('task_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <section class="task_form">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                                <label for="title" class="col-md-4 control-label">{{ 'Title' }} <span class="text-danger">*</span></label>
                                                <input class="form-control" placeholder="Enter title" name="title" type="text" id="title" value="{{ $task->title??''}}" required>
                                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                                <div class="form-check form-check-inline required_error custom_radio_button">
                                                    <label for="priority_id" class="control-label w-100">{{ 'Priority' }} <span class="text-danger">*</span></label>
                                                    @foreach($priorities as $key => $priority)
                                                        <input class="form-check-input" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif>
                                                        <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group cust_form_div {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                                <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }} <span class="text-danger">*</span></label>
                                                <select class="form-control custom_modal_select2 js-example-basic-multiple" data-placeholder="Select Assign To User" multiple="multiple"  name="assign_to_user_id[]" id="assign_to_user_id" required>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
                                                <label for="due_date" class="col-md-4 control-label">{{ 'Due Date' }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="due_date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" id="due_date" value="{{ $task->due_date??''}}" required>
                                                {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
                                                <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Team ' }} <span class="text-danger">*</span></label>
                                                <select required class="form-control custom_modal_select2 js-example-basic-single" data-placeholder="Select Assign To Team" name="assign_to_team_id" id="assign_to_team_id">
                                                    <option value="" selected ></option>
                                                    @foreach($teams as $team)

                                                        <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                                <label for="images" class="control-label">{{ 'Images' }} <span class="text-danger">*</span></label>
                                                <div action="#" id="taskDropzone" class="dropzone validtedropzone">
                                                    <div class="fallback">
                                                        <input name="images" id="images" type="file" multiple accept="image/*" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="task_attachment" id="task_attachment">

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group error_positioned_parent_modal {{ $errors->has('description') ? 'has-error' : ''}}">
                                                <label for="description" class="col-md-12 control-label" >{{ 'Description' }} <span class="text-danger">*</span></label>
                                                <textarea required   class="form-control" rows="5" name="description" type="textarea" id="task_description" >{{  $task->description ?? '' }}</textarea>
                                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group  ">
                                                <div class="d-flex justify-content-center ">
                                                    <button class="btn green_btn   " type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="jobNote" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Job Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal jobvalidate" method="get" id="job_note_form" action="{{route('job_note_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                        <label for="images" class="control-label">{{ 'Images' }} </label>
                                        <div action="#" id="jobNotedropzone" class="dropzone brpzone_padBottom">
                                            <div class="fallback">
                                                <input name="images" id="images" type="file" multiple accept="image/*" required />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="job_note_attachment" id="job_note_attachment">

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group error_positioned_parent_modal {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="job_description" class="col-md-12 control-label">{{ 'Description' }} </label>
                                        <textarea class="form-control" rows="5" name="job_description" id="job_description">{!! $task->description??''!!}</textarea>
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center ">
                                            <input class="btn green_btn  " type="submit" value="{{ $submitButtonText??'Create' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="estimateProposal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Estimate Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal estimatevalidate" method="get" id="estimate_proposal_form" action="{{route('estimate_proposal_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Photo And Documents' }} <span class="text-danger">*</span></label>
                                    <div action="#" id="estimatedropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="estimate_attachment" id="estimate_attachment">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class=" d-flex justify-content-center ">
                                        <input class="btn green_btn  " type="submit" value="Create">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addMaterial" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal materialvalidate" method="post" id="add_material_form" action="{{route('material_assign_to_lead')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="col-md-4 control-label">{{ 'Name' }} <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" type="text" id="name" value="{{ $material->name??''}}" required>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Documents' }} <span class="text-danger">*</span></label>
                                    <div action="#"  id="materialdropzoneee" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="material_attachment" id="material_attachment">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class=" d-flex justify-content-center ">
                                        <input class="btn green_btn  " type="submit" value="{{ $submitButtonText??'Create' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal job_detail_start_date_modal" id="job_detail_start_date_modal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="get" action="{{route('change_lead_date')}}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Job Starts Date</h5>
                        <button type="button" class="close close_message_view" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Job_starts_date"> Start Date</label>
                                    <input type="date" name="lead_date" id="Job_starts_date" value="" class="form-control">
                                    <input type="hidden" name="lead_id" id="lead_id" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn green_btn " value="Submit" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"></div>

@endsection
@push('js')

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <!-- Include DataTables Buttons JavaScript -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <!-- Your additional styles or scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.search-input').on('keyup', function () {
                var searchValue = $(this).val().toLowerCase();
                $('.lead-card-view .item-card-view').each(function () {
                    var cardText = $(this).find('a').text().toLowerCase();
                    if (cardText.includes(searchValue)) {
                        $(this).closest('.col-md-4').show();
                    } else {
                        $(this).closest('.col-md-4').hide();
                    }
                });
            });
        });
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible:not(.image)' // Exclude columns with class 'exclude-columns'
                        }
                    }
                ]
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

        $(document).ready(function () {
            // ['#job_description', '#mail_description', '#task_description'].forEach(selector => {
            //     ClassicEditor.create(document.querySelector(selector)).catch(console.error);
            // });
            let editors = {};
            ['#job_description', '#mail_description', '#task_description'].forEach(selector => {
                ClassicEditor.create(document.querySelector(selector))
                    .then(editor => {
                        editors[selector] = editor; // Store the editor instance
                    })
                    .catch(console.error);
            });
            $(document).on('change', '.email_template', function() {
                var templateId = $(this).val();
                $('#addEmailsDropzone').html('')
                $.ajax({
                    url: '/getCampaignEmailTemplate/' + templateId,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('.subject_mail').val(response.subject);
                        // $('.subject_description').val(response.note);
                        if (editors['#mail_description']) {
                            editors['#mail_description'].setData(response.note); // Set the data for CKEditor 5
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
                                $('#addEmailsDropzone').append(`<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
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
                                                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Check</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>  <div class="dz-error-mark">    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>
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
        });

        // $(document).ready(function () {
        //     CKEDITOR.replace('task_description');
        // });
        $(document).ready(function () {
            var sum = 0;
            var material_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#materialdropzoneee").dropzone({
                url: "{{route('upload_material_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    material_attachment_arr = jQuery.grep(material_attachment_arr, function (value) {
                        return value != image_name;
                    });
                    $('#material_attachment_arr').val(material_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_material_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#material_attachment').val();

                            // Split the value into an array using ","
                            var attachmentArray = currentAttachmentValue.split(',');

                            // Remove the specified image_name from the array
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }

                            // Join the array back into a string using ","
                            var newAttachmentValue = attachmentArray.join(',');

                            // Set the updated value to material_attachment
                            $('#material_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    material_attachment_arr.push(response);
                    $('#material_attachment').val(material_attachment_arr);
                    $(file._removeLink).attr('image_name', response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });

        $(document).ready(function () {
            var sum = 0;
            var estimate_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#estimatedropzone").dropzone({
                url: "{{route('upload_estimate_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation:  "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function(file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if(id == 'undefined'){
                        id = 0;
                    }
                    console.log(image_name);
                    estimate_attachment_arr = jQuery.grep(estimate_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_estimate_attachment') }}",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#estimate_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#estimate_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    estimate_attachment_arr.push(response);
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    $(file._removeLink).attr('image_name',response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function() {  // start of getting existing images
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function(file){
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!","ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });
        $(document).ready(function () {
            var sum = 0;
            var task_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#taskDropzone").dropzone({
                url: "{{route('upload_task_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    task_attachment_arr = jQuery.grep(task_attachment_arr, function (value) {
                        return value != image_name;
                    });
                    $('#task_attachment').val(task_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_task_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#task_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#task_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    task_attachment_arr.push(response);
                    $('#task_attachment').val(task_attachment_arr);
                    $(file._removeLink).attr('image_name', response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });

        $(document).ready(function () {
            $('#notify_check').change(function () {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });
        $(document).ready(function () {
            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })
        // $(function () {
        //     $('#myTable').DataTable({
        //         'aoColumnDefs': [{
        //             'bSortable': false,
        //             'aTargets': [-1] /* 1st one, start by the right */
        //         }]
        //     });
        //
        // });
        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;

            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one lead to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });
        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Lead?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedLeads();
                }
            });
        }
        function deleteSelectedLeads() {
            var selectedLeadIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedLeadIDs.push($(this).attr('data-leadCheck-id'));
            });

            $.ajax({
                url: "{{ route('lead_multiple_delete') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedLeadIDs
                },

                success: function(response) {
                    selectedLeadIDs.forEach(function (id) {
                        $('.noti_checks[data-leadCheck-id="' + id + '"]').closest('.lead_check').remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Leads Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    window.location.reload()
                    console.log('Delete IDS:', selectedLeadIDs);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }
        $(document).on('click','.add_job_note_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-user-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmails').modal('show');
            }
        })
        $(document).on('click','.add_material_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#add_material_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addMaterial').modal('show');
            }
        })

        $(document).on('click','.add_task_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#task_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addTaskModal').modal('show');
            }
        })
        $(document).on('click','.add_jobnote_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#job_note_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#jobNote').modal('show');

            }
        })

        $(document).on('click','.add_estimate_proposal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#estimate_proposal_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#estimateProposal').modal('show');
            }
        })

        $(document).ready(function () {
            var sum = 0;
            var job_note_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#jobNotedropzone").dropzone({
                url: "{{route('upload_job_note_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation:  "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function(file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if(id == 'undefined'){
                        id = 0;
                    }
                    console.log(image_name);
                    job_note_attachment_arr = jQuery.grep(job_note_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#job_note_attachment').val(job_note_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_job_note_attachment') }}",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#job_note_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#job_note_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    job_note_attachment_arr.push(response);
                    $('#job_note_attachment').val(job_note_attachment_arr);
                    $(file._removeLink).attr('image_name',response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function() {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function(file){
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!","ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });

        });
        $(document).ready(function () {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function () {
                var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
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

        $(document).ready(function () {
            $('#categoryFilter').change(function() {
                if ($(this).val()) {
                    let today = new Date().toISOString().split('T')[0];
                    let currentYear = {{ $yearEstimation->year }};
                    let startDate = `${currentYear}-01-01`;
                    $('#duration_starts').val(startDate);
                    $('#duration_ends').val(today);
                }
            });
            $("#filter-form").validate({
                rules: {
                    duration_starts: {
                        required: true
                    },

                    description: {
                        required: true
                    },
                    // category_id: {
                    //     required: true
                    // }
                },
                messages: {
                    duration_starts: {
                        required: "Please select the start date"
                    },
                    duration_ends: {
                        required: "Please select the end date"
                    },
                    // category_id: {
                    //     required: "Please select a category"
                    // }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".mb-3").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");
            // Initialize your existing Dropzone
            // var myDropzone = Dropzone.forElement(".dropzone");
            // // Add event listener for the addedfile event
            // myDropzone.on("addedfile", function(file) {
            //     // Validate the file type (photo or document)
            //     var isPhoto = file.type.startsWith('image/');
            //     var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');
            //
            //     if (!(isPhoto || isDocument)) {
            //         // If the file is neither a photo nor a document, reject it
            //         myDropzone.removeFile(file);
            //         alert("Invalid file type. Please upload a valid photo or document.");
            //     }
            // });

            $('.materialvalidate').validate({
                rules: {
                    name: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter Name.",
                        noSpace: "Spaces are not allowed."
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#material_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop!='') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }

                }
            });
            // Initialize jQuery Validation
            $('.estimatevalidate').validate({
                submitHandler: function(form) {
                    var drop = $('#estimate_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop != '') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }
                }
            });
        });
        $(document).ready(function() {
            var myDropzone = Dropzone.forElement(".brpzone_padBottom");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                if (!(isPhoto || isDocument)) {
                    // If the file is neither a photo nor a document, reject it
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo or document.");
                }
            });

            $('.jobvalidate').validate({
                ignore: [],
                rules: {
                    job_description: {
                        ckrequired: true
                    }
                },
                messages: {
                    job_description: {
                        ckrequired: "Description field is required"
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#job_note_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop!='') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }

                }
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $('.emailvalidate').validate({
                ignore: [],
                rules: {
                    subject: {
                        required: true,
                        noSpace: true
                    },
                    // 'mail_attachment[]': {
                    //     required: true
                    // },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    subject: {
                        required: "Please enter subject.",
                        noSpace: "Spaces are not allowed."
                    },
                    // 'mail_attachment[]': {
                    //     required: "Please attachment first."
                    // },
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");
            var myDropzone = Dropzone.forElement(".validtedropzone");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                if (!(isPhoto || isDocument)) {
                    // If the file is neither a photo nor a document, reject it
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo or document.");
                }
            });

           // Minimal fix - just update your existing submitHandler
$('.taskvalidate').on('submit', function(e) {
        e.preventDefault(); // Stop the default submission
        
        // Sync CKEditor content first
        if (typeof CKEDITOR !== 'undefined') {
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
        
        // Small delay to ensure sync is complete, then trigger validation
        setTimeout(function() {
            $('.taskvalidate').validate().form(); // Manually trigger validation
            
            // If validation passes, submit the form
            if ($('.taskvalidate').valid()) {
                var drop = $('#task_attachment').val();
                if (drop != '') {
                    $('.taskvalidate')[0].submit(); // Submit the actual form
                } else {
                    swal.fire("Please upload a file.");
                }
            }
        }, 0);
        
        return false;
    });
});

// Your original validation setup (remove submitHandler)
$('.taskvalidate').validate({
    ignore: [],
    rules: {
        title: {
            required: true,
            noSpace: true
        },
        'assign_to_user_id[]': {
            required: true
        },
        priority_id: {
            required: true
        },
        assign_to_lead_id: {
            required: true
        },
        assign_to_team_id: {
            required: true
        },
        description: {
            required: true
        }
    },
    messages: {
        title: {
            required: "Please enter Title.",
            noSpace: "Spaces are not allowed."
        },
        'assign_to_user_id[]': {
            required: "Please Assign First."
        },
        priority_id: {
            required: "Please select Priority First."
        },
        assign_to_lead_id: {
            required: "Please Assign Lead."
        },
        assign_to_team_id: {
            required: "Please Assign Team."
        },
        description: {
            required: "Description field is required"
        }
    }
        });

        $(document).on('click','.job_insurance_for_lead',function (e) {
            e.preventDefault();
            var lead_id = $(this).attr('lead-id');
            $.ajax({
                type: 'get',
                url: "{{ url('job_insurance_for_lead') }}/" + lead_id,
                success:function(result){
                    $('#offcanvasExample').html(result);
                    $('#offcanvasExample').offcanvas('show');
                }//end of success.
            });//ends ajax.
        })//ends on click.

        $('#job_detail_start_date_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var jobId = button.data('job-id'); // Extract job ID from data-* attributes
            var initialDate = button.data('initial-date'); // Extract initial date from data-* attributes
            var modal = $(this);

            // Set the job ID and initial date in the modal form
            modal.find('#lead_id').val(jobId);
            modal.find('#Job_starts_date').val(initialDate);
        });

        $(document).on('click', '#archive_btn', function (event) {
            event.preventDefault();
            var archiveLink = $(this).attr('href');
            var archiveStatus = "{{ isset($item->archive_status) ? $item->archive_status : '' }}";
            var title, text;

            if (archiveStatus == 'archive') {
                title = "Are you sure?";
                text = "You want to archive this lead";
            } else if (archiveStatus == 'unarchive') {
                title = "Are you sure?";
                text = "You want to unarchive this lead";
            } else {
                // Handle the case when archiveStatus is not set or contains no data
                title = "Are you sure?";
                text = "You want to perform this action on this lead";
            }
            Swal.fire({
                title: title,
                text: text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "OK",
                cancelButtonText: "Cancel"
            }).then((willArchive) => {
                if (willArchive.isConfirmed) {
                    window.location.href = archiveLink;
                }
            });
        });

        $(document).ready(function () {
            var attachmentDropzone = [];
            Dropzone.autoDiscover = false;
            $("#addEmailsDropzone").dropzone({
                url: "{{route('upload_email_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                maxFiles: 5,
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    attachmentDropzone = jQuery.grep(attachmentDropzone, function (value) {
                        return value != image_name;
                    });
                    $('#email_attachment').val(attachmentDropzone);
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
                    attachmentDropzone.push(response);
                    const hiddenInput = $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'mail_attachments[]') // Use an array name to handle multiple files
                        .val(response);
                    $('#addEmailsDropzone').append(hiddenInput);
                    $('#email_attachments').val(attachmentDropzone.join(','));
                    $(file._removeLink).attr('image_name', response);
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.exportToExcel', function () {
                $('.preloader').fadeIn();
                $('body').css('overflow-y', 'hidden');

                $.ajax({
                    url: "{{ url('leads/export') }}",
                    method: 'GET',
                    data: {
                        search: '{{ request()->search }}',
                        lead_filter: '{{ request()->lead_filter }}',
                        category_id: '{{ request()->category_id }}',
                        duration_starts: '{{ request()->duration_starts }}',
                        duration_ends: '{{ request()->duration_ends }}',
                        lead_type: '{{ request()->lead_type }}',
                        lead_card_view_status: '{{ request()->lead_card_view_status }}'
                    },
                    success: function (data) {
                        const leads = data.map(lead => ({
                            'Title': lead.title || 'Not Available',
                            'Customer': lead.customer?.name || 'Not Available',
                            'Customer Number': lead.customer?.created_at ? 'R' + new Date(lead.customer.created_at).toISOString().slice(2, 10).replace(/-/g, '') : 'Not Available',
                            'Representative': lead.representative?.name || 'Not Available',
                            'Category': lead.category?.name || 'Not Available',
                            'Lead Number': lead.lead_number && lead.category?.name ? lead.category.name[0].toUpperCase() + lead.lead_number : 'Not Available',
                            'Last Activity': lead.notifications?.length > 0 ? lead.notifications[lead.notifications.length - 1].model : 'No interaction available',
                            'Job Starts Date': lead.lead_date ? new Date(lead.lead_date).toISOString().slice(0, 10).replace(/-/g, ' - ') : 'Not Available',
                            'Job Number': lead.job_number && lead.category?.name ? lead.category.name[0].toUpperCase() + lead.job_number : 'Not Available',
                            'Job Status Date': lead.lead_status_date || 'Not Available',
                            'Address': lead.customer?.profile?.address || 'Not Available',
                            'City': lead.customer?.profile?.city || 'Not Available',
                            'State': lead.customer?.profile?.state || 'Not Available',
                            'Zipcode': lead.customer?.profile?.zip || 'Not Available',
                            'Lead Status': lead.lead_status || 'Not Available',
                            'Job Price': `$${Number(parseFloat(lead.lead_price || 0) + parseFloat(lead.ChangeOrder || 0)).toFixed(2)}`
                        }));

                        // Define headers
                        const headers = [
                            'Title', 'Customer', 'Customer Number', 'Representative', 'Category',
                            'Lead Number', 'Last Activity', 'Job Starts Date', 'Job Number',
                            'Job Status Date', 'Address', 'City', 'State', 'Zipcode',
                            'Lead Status', 'Job Price'
                        ];

                        // Create worksheet from leads data
                        const ws = XLSX.utils.json_to_sheet(leads, { header: headers });

                        // Create workbook and append worksheet
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Leads');

                        // Export to Excel
                        XLSX.writeFile(wb, 'leads_export.xlsx');
                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching lead data:', { status, error, xhr });
                        const errorMessage = xhr.responseJSON?.message || 'Failed to export leads. Please try again.';
                        alert(errorMessage);
                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    }
                });
            });
        });

    </script>
@endpush

