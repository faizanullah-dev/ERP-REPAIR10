@extends('layouts.master')
@push('css')
    <link href="{{ asset('plugins/components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

    <style>
        .filter_inputs_btns_wrapper .filter_btns_parent { display: flex; align-items: end; }
        .lead-jobs-calendar .lead-jobs li { padding: 5px; font-size: 13px; line-height: 1.2; }
        .lead-jobs-calendar .lead-jobs { overflow-y: scroll; max-height: calc(50vh - 170px); }

        body .page-wrapper { padding-bottom: 0; }
        #lead-full-calendar { max-height: calc(100vh - 288px); }
        #lead-full-calendar:has(.fc-agendaDay-view) { overflow-y: hidden; }
        #lead-full-calendar .fc-view-container .fc-body .fc-row {height: fit-content !important;min-height: 90px;}
        #lead-full-calendar .fc-view-container table tbody.fc-body .fc-row .fc-content-skeleton table { height: auto; }
        #lead-full-calendar:has(.fc-agendaDay-view) .fc-widget-content .fc-scroller { max-height: calc(100vh - 480px); }
        #lead-full-calendar .fc-view-container table thead.fc-head .fc-row.fc-widget-header table thead tr th { padding-block: 15px; line-height: normal; }

        .page-wrapper .modal .modal-dialog .modal-content .modal-body form .green_btn[type="submit"] { line-height: 1; }
        .page-wrapper .modal-dialog .modal-content .modal-header .close { right: 0; top: -5px; margin: 0; width: auto; padding: 0; height: auto; }
    </style>
@endpush

@section('content')
    <div class="row white-box calendar_section">
        <div class="col-md-12 ps-0 px-0">
            <div class="calendar_fields d-flex flex-wrap align-items-end justify-content-between">
                <h3 class="ps-0 box-title"> Production Calendar </h3>
                <form method="get" action="{{ url('schedulingTask/scheduling-task') }}" style="width:calc(100% - 440px);" id="filter-form">
                    <div class="filter_inputs_btns_wrapper form-group">
                        <input type="hidden" name="scheduling_filter" value="yes">
                        <div class="filter_inputs_parent">
                            <label for="Select Category" class="form-label input_labels ">Category</label>
                            <select class="form-control  select2" id="userFilter" name="user_id[]">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" style="background-color: {{ $category->color_id??'' }}; color: white;">
                                        {{ $category->name ?? "" }} - {{ $categoryCounts[$category->id] ?? 0 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter_inputs_parent">
                            <label for="Select User" class="form-label input_labels ">Select User</label>
                            <select class="form-control  select2" data-placeholder="Select User" id="userFilter" name="user_id[]" multiple>
                                @foreach($scheduling_task_users as $user)
                                    <option value="{{$user->id}}" {{ (in_array($user->id, (array) request('user_id'))) ? 'selected' : '' }}>
                                        {{$user->name ?? ""}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter_inputs_parent">
                            <label for="Select Category" class="form-label input_labels ">Select Category</label>
                            <select class="form-control  select2" data-placeholder="Select Category" id="categoryFilter" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ (request('category_id') == $category->id) ? 'selected' : '' }}>
                                        {{$category->name ?? ""}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter_inputs_parent filter_btns_parent">
                            <div class="reset_apply_btn">
                                <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                <a href="{{ url('schedulingTask/scheduling-task') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                            </div>
                        </div>
                    </div>
                </form>
                <a type="button" class="btn blue_btn  add_schedule_modal_btn" data-bs-toggle="modal" data-bs-target="#taskModal" style="background: #2C3146;">Add Schedule Job<i class="icon-plus"></i></a>
            </div>
        </div>
    </div>
    <section class="calender">
        <div class="white-box  position-relative">
            <div class="clearfix"></div>
            <div class="container-fluid d-block">
                <div class="row  ">
                    <div class="col-md-2">

                        <div class="lead-jobs-calendar">
                            <label for="Select Category" class="form-label input_labels ">Schedule Jobs</label>
                            <ul id="schedule-job" class="lead-jobs ps-0">
                                @if(isset($upcomingleads))
                                    @foreach($upcomingleads as $schedule)
                                        {{--                                    @if(isset($lead->schedulingTask) && $lead->schedulingTask->isNotEmpty())--}}
                                        <li data-id="{{ $schedule->getLead->id }}" data-bg="{{ $schedule->getLead->category->color_id??'' }}" style="background-color: {{ $schedule->getLead->category->color_id??'' }}; color: white;">
                                            {{ $schedule->getLead->title ?? "" }} | {{ $schedule->getLead->category->name ?? "" }}
                                        </li>
                                        {{--                                    @endif--}}
                                    @endforeach
                                @endif
                            </ul>


                            <label for="Select Category" class="form-label input_labels ">Un Schedule Jobs</label>
                            <ul id="unschedule-job" class="lead-jobs ps-0">
                                @foreach($leads->where('lead_status', 'won') as $lead)
                                    @if(isset($lead->schedulingTask) && $lead->schedulingTask->isEmpty())
                                        <li data-id="{{ $lead->id }}" data-bgcolor="{{ $lead->category->color_id??'' }}" style="background-color: {{ $lead->category->color_id??'' }}; color: white;">
                                            {{ $lead->title ?? "" }} | {{ $lead->category->name ?? "" }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>


                        {{--                        <div>--}}
                        {{--                            <div class="filter_inputs_parent">--}}
                        {{--                                <label for="Select Category" class="form-label input_labels ">Jobs</label>--}}
                        {{--                                <select class="form-control clr_input_fields " id="userFilter" name="user_id[]">--}}
                        {{--                                    @foreach($leads as $lead)--}}
                        {{--                                        @if(isset($lead->schedulingTask) && $lead->schedulingTask->isNotEmpty())--}}
                        {{--                                            <option value="{{ $lead->id }}" style="background-color: {{ $lead->category->color_id }}; color: white;">--}}
                        {{--                                                {{ $lead->title ?? "" }} | {{ $lead->category->name ?? "" }}--}}
                        {{--                                            </option>--}}
                        {{--                                        @endif--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div>--}}
                        {{--                            <div class="filter_inputs_parent">--}}
                        {{--                                <label for="Select Category" class="form-label input_labels ">Un Schedule Jobs</label>--}}
                        {{--                                <select class="form-control clr_input_fields " id="userFilter" name="user_id[]">--}}
                        {{--                                    @foreach($leads as $lead)--}}
                        {{--                                        @if(isset($lead->schedulingTask) && $lead->schedulingTask->isEmpty())--}}
                        {{--                                            <option value="{{ $lead->id }}" style="background-color: {{ $lead->category->color_id }}; color: white;">--}}
                        {{--                                                {{ $lead->title ?? "" }} | {{ $lead->category->name ?? "" }}--}}
                        {{--                                            </option>--}}
                        {{--                                        @endif--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}


                    </div>
                    <div class="col-md-10">
                        <div class="inner full_calendar" id="lead-full-calendar">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--   starts  Modal  --}}
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
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
                            <select class="form-control custom_modal_select2 attendees_user_id" data-placeholder="Select Lead" multiple id="" name="lead_id" required>
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
                            <label for="taskName">Assign User:<span style="color:red">*</span> </label>
                            <select class="form-control  custom_modal_select2 " data-placeholder="Select Assign User" multiple id="" name="user_id[]" required>
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
                            <input type="text" class="form-control" id="taskName" name="name">
                        </div>
{{--                        <input type="hidden" class="form-control" id="color_id" name="color_id">--}}
                        <div class="form-group">
                            <label for="taskName">Assign Subcontractor:</label>
                            <select class="form-control custom_modal_select2" data-placeholder="Select Assign Subcontractor" multiple id="subcontractor_id" name="subcontractor_id">
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{$subcontractor->id}}" >{{$subcontractor->name??""}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskDate">Start Date:</label>
                            <input type="date" class="form-control startDates" id="startDate" name="start_date" value="{{ $yearEstimation->year . '-' . now()->format('m-d') }}">

                        </div>
                        <div class="form-group">
                            <label for="taskDate">End Date:</label>
                            <input type="date" class="form-control" id="taskDate" name="end_date" value="{{$yearEstimation->year . '-'.now()->format('m-d')}}">
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
    {{--end modal--}}
    {{--   starts  Modal  --}}
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Scheduling Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body scheduling-modal-body ">
                </div>

            </div>
        </div>
    </div>
    {{--end modal--}}
    {{--   starts  Modal  --}}
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Edit Scheduling Task</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="update_scheduling_task">
                        <input type="hidden" name="id" id="scheduling_task_id">
                        <div class="form-group">
                            <label for="taskName">Assign User:</label>
                            <select class="form-control  custom_modal_select2  attendees_user_id_edit" data-placeholder="Select Assign User" multiple name="user_id[]" required id="">
                                @foreach($scheduling_task_users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="taskName">Assign Team:</label>
                            <select class="form-control  edit_team_id custom_modal_select2" data-placeholder="Select Assign Team" multiple name="team_id">
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Task Name:</label>
                            <input type="text" class="form-control" id="taskNameEdit" name="name" >
                        </div> <div class="form-group">
                            <label for="taskName">Lead:</label>
                            <select class="form-control custom_modal_select2 edit_lead_id" data-placeholder="Select Lead" multiple name="lead_id" required id="">
                                @foreach($leads as $lead)
                                    <option value="{{$lead->id}}">{{$lead->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Assign Subcontractor:</label>
                            <select class="form-control custom_modal_select2  assigned_subcontractor" data-placeholder="Select Assign Subcontractor" multiple name="subcontractor_id">
                                @foreach($subcontractors as $subcontractor)
                                    <option value="{{$subcontractor->id}}">{{$subcontractor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskDate">Start Date:</label>
                            <input type="date" class="form-control startDates" id="taskStartDateEdit" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="taskDate">End Date:</label>
                            <input type="date" class="form-control" id="taskEndDateEdit" name="end_date" >
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Task Description:</label>
                            <textarea class="form-control" id="taskDescriptionEdit" rows="3" name="description"></textarea>
                        </div>
                        <div class="form-group  ">
                            <div class="d-flex justify-content-center ">
                                <button type="submit" class="btn d-block mx-auto btn-green">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--end modal--}}

@endsection
@push('js')
    <script src="{{ asset('plugins/components/calendar/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('plugins/components/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/components/calendar/dist/fullcalendar.min.js') }}"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <script>

        $(document).ready(function () {
            ['#taskDescription', '#taskDescriptionEdit'].forEach(selector => {
                ClassicEditor.create(document.querySelector(selector)).catch(console.error);
            });
        });

        $(document).ready(function() {
            $('#schedule_job_form').validate({
                ignore: [],
                rules: {
                    lead_id: {
                        required: true,
                    },
                    'user_id[]': {
                        required: true,
                        minlength: 1,
                    },
                    name: {
                        required: true,
                    },
                    color_id: {
                        required: true,
                    },
                    starting_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                        // dateAfter: '#startDate'
                    },
                    // description: {
                    //     required: true,
                    // },
                },
                messages: {
                    lead_id: {
                        required: "Please enter lead",
                    },
                    'user_id[]': {
                        required: "Please select  user",
                    },
                    name: {
                        required: "Please enter name",
                    },
                    color_id: {
                        required: "Please select color",
                    },
                    starting_date: {
                        required: "Please enter start date",
                    },
                    end_date: {
                        required: "Please enter end date",
                        // dateAfter: "The end date must be after the start date.",
                    },
                    // description: {
                    //     required: "Please enter description",
                    // },
                },
                errorPlacement: function(error, element) {
                    error.insertBefore(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
            // $.validator.addMethod('dateAfter', function(value, element, param) {
            //     const endDate = moment(value);
            //     const startDate = moment($(param).val());
            //     return this.optional(element) || endDate.isAfter(startDate);
            // }, 'The end date must be after the start date.');

        });
        $(document).ready(function() {
            ignore = [];
            $('#update_scheduling_task').validate({
                rules: {
                    lead_id: {
                        required: true,
                    },
                    'user_id[]': {
                        required: true,
                        minlength: 1,
                    },
                    name: {
                        required: true,
                        minlegnth: 12,
                    },
                    color_id: {
                        required: true,
                    },
                    starting_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    lead_id: {
                        required: "Please enter lead",
                    },
                    'user_id[]': {
                        required: "Please select  user",
                    },
                    name: {
                        required: "Please enter name",
                    },
                    color_id: {
                        required: "Please select color",
                    },
                    starting_date: {
                        required: "Please enter start date",
                    },
                    end_date: {
                        required: "Please enter end date",
                    },
                    description: {
                        required: "Please enter description",
                    },
                },
                errorPlacement: function(error, element) {
                    error.insertBefore(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
        $(document).ready(function() {
            var selectedYear = @json($yearEstimation->year);
            var currentMonth = new Date().getMonth() + 1;
            var currentMonthFormatted = currentMonth < 10 ? '0' + currentMonth : currentMonth;

            $('#calendar').fullCalendar({
                @if(App\CommonSetting::first()->calendar == 1)
                firstDay: 1,
                @elseif(App\CommonSetting::first()->calendar == 2)
                hiddenDays: [0, 6],
                @elseif(App\CommonSetting::first()->calendar == 3)
                firstDay: 0,
                @endif
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,agendaDay,printPdfBtn',
                },
                editable: true,
                eventLimit: 5,
                views: {
                    month: {
                        showNonCurrentDates: false,
                        fixedWeekCount: false
                    }
                },
                viewRender: function(view, element) {
                    setTimeout(function() {
                        var totalPrice = 0;

                        // Get the visible month and year from the view's title (e.g., "December 2023")
                        var viewTitle = view.title; // "December 2023"
                        var [monthNameFromTitle, yearFromTitle] = viewTitle.split(" ");
                        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        var fullMonthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                        // Find short month name (e.g., "Dec" from "December")
                        var currentMonthIndex = fullMonthNames.indexOf(monthNameFromTitle);
                        var currentMonthShortName = monthNames[currentMonthIndex];
                        var calendarYear = parseInt(yearFromTitle);

                        console.log('Formatted Current Month:', currentMonthShortName);
                        console.log('Formatted Current Year:', calendarYear);

                        // Loop through all events to calculate total price for the current view's month and year
                        @foreach ($schedulingtask as $task)
                        var eventStartDate = new Date('{{ $task->start_date }}');
                        eventStartDate.setHours(0, 0, 0, 0);

                        var testMonth = eventStartDate.getMonth(); // 0-based
                        var testYear = eventStartDate.getFullYear();
                        var eventMonthName = monthNames[testMonth];
                        if (eventMonthName === currentMonthShortName && testYear === calendarYear) {
                            var leadPrice = parseFloat('{{ optional($task->getLead)->lead_price ?? 0 }}');
                            console.log('leadPrice:', leadPrice);

                            var changeOrderTotal = 0;
                            @if($task->getLead && $task->getLead->getChangeOrder)
                                    @foreach ($task->getLead->getChangeOrder->where('status', 'approved') as $changeOrder)
                                changeOrderTotal += parseFloat('{{ $changeOrder->total_amount ?? 0 }}');
                            console.log('changeOrderTotal', changeOrderTotal);
                            @endforeach
                                    @endif
                                totalPrice += leadPrice + changeOrderTotal;
                            console.log('totalPrice after adding leadPrice and changeOrderTotal:', totalPrice);
                        }
                        @endforeach

                        var formattedPrice = "$" + totalPrice.toFixed(2);
                        console.log('formattedPrice:', formattedPrice);

                        if (!$('.fc-price').length) {
                            $('.fc-center').append('<span>--</span> <h2 class="fc-price" >' + formattedPrice + '</h2>');
                        } else {
                            $('.fc-price').text(formattedPrice);
                        }
                    }, 10);
                },
                eventRender: function(event, element, view) {
                    var taskID = event.eventID;
                    var deleteIcon = $('<i class="fa fa-trash text-light px-2 delete-icon"></i>').attr('delete-task-id', taskID);
                    var editIcon = $('<i class="fa fa-edit edit-icon edit-task-icon text-light px-2"></i>').attr('data-task-id', taskID);
                    var mapLink = 'https://www.google.com/maps?q=' + encodeURIComponent(event.address);
                    var viewLeadLink = '{{ url('view_lead') }}/' + event.leadId;
                    const assetPath = "{{ asset('website/images/map.png') }}";

                    // Extract data for tooltip
                    var titleParts = event.title ? event.title.split(' - ') : ['N/A', 'N/A']; // Split title to get name and category
                    var fullName = titleParts[0] || 'N/A'; // First part is the name
                    var category = titleParts[1] || 'N/A'; // Second part is the category
                    var address = event.address || 'N/A'; // Use event.address

                    // Define tooltip content
                    var tooltipContent = `Name: ${fullName}\nAddress: ${address}\nCategory: ${category}`;
                    element.attr('title', tooltipContent);
                    element.tooltip({
                        container: 'body',
                        placement: 'top',
                        trigger: 'hover'
                    });

                    // // Existing additional info box
                    // var additionalDiv = $('<div class="additional-info-box" style="margin-top:5px;">' +
                    //     '<a class="custom_lead_anchor" href="' + mapLink + '" target="_blank">' +
                    //     '<img class="img" src="' + assetPath + '" alt="icon png" style="width: 20px; height: 20px;">' +
                    //     '</a>' +
                    //     '<a href="' + viewLeadLink + '" type="button" class="custom_lead_btn" style="margin-left:5px;">View Lead</a>' +
                    //     '</div>');
                    //
                    // element.prepend(additionalDiv);
                    // additionalDiv.find('a').on('click', function(event) {
                    //     event.stopPropagation(); // Prevent the modal from opening when clicking the link
                    // });

                    // Edit icon handler
                    editIcon.on('click', function(event) {
                        event.stopPropagation();
                        var task_id = $(this).attr('data-task-id');
                        $.ajax({
                            url: "{{ url('get_task_scheduling_id') }}",
                            type: 'GET',
                            data: { task_id: task_id },
                            beforeSend: function() {
                                // Show the loader before the request starts
                                $('#loading').show().css('opacity','1');
                                $('body').addClass('preload');

                            },
                            success: function(data) {
                                $('#scheduling_task_id').val(data.taskData.id);
                                $('#taskLeadEdit').val(data.taskData.lead_id);
                                $('#taskNameEdit').val(data.taskData.name);
                                $('#taskStartDateEdit').val(data.taskData.start_date);
                                $('#taskEndDateEdit').val(data.taskData.end_date);
                                $('#taskDescriptionEdit').val(data.taskData.description);
                                $('#taskColorEdit').val(data.taskData.color_id);
                                var selectedTeamId = data.taskData.team_id;
                                var selectedLeadId = data.taskData.lead_id;
                                var selectedSubcontractorId = data.taskData.subcontractor_id;
                                var selectedUserIds = data.taskData.get_scheduling_user.map(user => user.user_id);
                                if (selectedUserIds && selectedUserIds.length > 0) {
                                    $('.attendees_user_id_edit option').each(function() {
                                        var userId = $(this).val();
                                        $(this).prop('selected', selectedUserIds.includes(userId));
                                    });
                                }
                                if (selectedSubcontractorId) {
                                    $('.assigned_subcontractor').val(selectedSubcontractorId).trigger('change');
                                }
                                if (selectedLeadId) {
                                    $('.edit_lead_id option').each(function() {
                                        var leadId = $(this).val();
                                        $(this).prop('selected', leadId == selectedLeadId);
                                    });
                                }
                                if (selectedTeamId) {
                                    $('.edit_team_id').val(selectedTeamId).trigger('change');
                                }


                                // if (selectedTeamId) {
                                //     $('.edit_team_id option').each(function() {
                                //         var teamId = $(this).val();
                                //         $(this).prop('selected', teamId == selectedTeamId);
                                //     });
                                // }
                                $('.attendees_user_id_edit, .edit_lead_id').trigger('change');
                                var originalStartDate = data.taskData.start_date;
                                var formattedStartDate = moment(originalStartDate).format('YYYY-MM-DD');
                                $('#taskStartDateEdit').prop('min', formattedStartDate);
                                $('#taskEndDateEdit').prop('min', formattedStartDate);
                                $('#taskStartDateEdit').on('change', function() {
                                    $('#taskEndDateEdit').prop('min', $(this).val());
                                });
                                $('#taskEndDateEdit').prop('min', $('#taskStartDateEdit').val());
                                $('#editTaskModal').modal('show');
                            },
                            complete: function() {
                                // Hide the loader after the request is complete (whether it was successful or not)
                                $('#loading').hide();
                                $('body').removeClass('preload');

                            },
                        });
                    });
                    deleteIcon.on('click', function(event) {
                        event.stopPropagation();
                        var task_id = $(this).attr('delete-task-id');
                        Swal.fire({
                            title: 'Are You Sure You Want To Delete The Scheduling Task?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ url('delete_task_scheduling') }}",
                                    type: 'POST',
                                    data: { _token: '{{ csrf_token() }}', task_id: task_id },
                                    success: function(response) {
                                        if (response.status === true) {
                                            Swal.fire('Deleted!', 'Scheduling Task has been deleted.', 'success').then(function() {
                                                setTimeout(function() { location.reload(); }, 1000);
                                            });
                                        } else {
                                            Swal.fire('Error!', 'Scheduling task deletion failed.', 'error');
                                        }
                                    },
                                    error: function() {
                                        Swal.fire('Error!', 'There was an error while deleting the task.', 'error');
                                    }
                                });
                            }
                        });
                    });

                    element.find('.fc-content').append(editIcon).append(deleteIcon);
                },
                defaultView: 'month',
                defaultDate: selectedYear + '-' + currentMonthFormatted + '-01',
                events: [
                        @foreach ($schedulingtask as $task)
                    {
                        eventID: '{{ $task->id ?? '' }}',
                        color: '{{ $task->color_id ?? '' }}',
                        {{--title: '@foreach ($task->getSchedulingUser as $key => $item){{ $item->getSchedulingUser->name ?? '' }}/@endforeach{!! $task->name ?? '' !!}/',--}}
                        title: '{{ $task->getLead->customer->last_name ?? '' }} - {{ $task->getLead->category->name ?? '' }}',
                        name: '{{ $task->name ?? '' }}',
                        leadId: '{{ $task->getLead->id ?? '' }}',
                        lead: '{{ $task->getLead->title ?? '' }}',
                        leadPrice: '{{ optional($task->getLead)->lead_price ?? 0  }}',
                        users: [
                            @foreach ($task->getSchedulingUser as $key => $item)
                                '{{ $item->getSchedulingUser->name ?? '' }}',
                            @endforeach
                        ],
                        team: '{{ $task->getTeam->name ?? '' }}',
                        {{--start: '{{ $task->start_date ?? '' }}',--}}
                                {{--end: '{{ $task->end_date ? date('Y-m-d', strtotime($task->end_date . ' +1 day')) : '' }}',--}}
                        start: moment('{{ $task->start_date ?? '' }}').format('YYYY-MM-DD'),
                        end: moment('{{ $task->end_date ?? '' }}').format('YYYY-MM-DD'),
                        description: {!! json_encode($task->description) !!},
                        address: '{{ $task->getLead->address ?? '' }}',
                    },
                    @endforeach
                ],
                dayClick: function(date) {
                    const selectedDate = date.format('YYYY-MM-DD');
                    console.log("Selected date:", selectedDate);
                    $('#taskModal').modal('show');
                    $('.startDates').val(selectedDate);
                    $('.startDates').attr('min', selectedDate);
                    $('#taskDate').val(selectedDate);
                    $('#taskDate').attr('min', selectedDate);
                    $('.endDates').attr('min', selectedDate);
                    $('.endDates').on('change', function () {
                        const endDate = $(this).val();
                        const startDate = $('.startDates').val();
                        if (new Date(endDate) < new Date(startDate)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Date',
                                text: 'End date cannot be earlier than the start date.',
                                confirmButtonText: 'OK',
                                showCloseButton: true,
                                timer: 5000,
                                timerProgressBar: true,
                            });
                            $(this).val('');
                        }
                    });
                },
                eventClick: function(event) {
                    console.log(event);
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    var decodedDescription = tempDiv.textContent || tempDiv.innerText || '';
                    $('.scheduling-modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-6"><div class="form-group"><p><label>Lead:</label> <input type="text" class="form-control" value="' + event.lead + '" readonly></p></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><p><label>Task:</label> <input type="text" class="form-control" value="' + event.name + '" readonly></p></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><p><label>Assign User:</label> <input type="text" class="form-control" value="' + event.users + '" readonly></p></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><p><label>Assign Team:</label> <input type="text" class="form-control" value="' + event.team + '" readonly></p></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><p><label>Start Date :</label> <input type="text" class="form-control" value="' + moment(event.start).format('MM-DD-YYYY') + '" readonly></p></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><p><label>End Date:</label> <input type="text" class="form-control" value="' + moment(event.end).format('MM-DD-YYYY') + '" readonly></p></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><p><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>' + decodedDescription + '</textarea></p></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><a href="{{ url('view_lead') }}/' + event.leadId + '" type="button" class="btn d-block mx-auto btn-green">View Lead</a></div></div>' +
                        '</div>'
                    );



                    $('#eventModal').modal('show');
                },
                eventDrop: function(event, delta, revertFunc) {
                    $.ajax({
                        url: "{{ route('update_date_scheduling_task') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            task_id: event.eventID,
                            start_date: event.start.format('YYYY-MM-DD'),
                            end_date: event.end ? event.end.format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD'),
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('Success', 'Task dates updated successfully.', 'success');
                            } else {
                                Swal.fire('Error', 'Failed to update task dates.', 'error');
                                revertFunc();
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An unexpected error occurred.', 'error');
                            revertFunc();
                        }
                    });
                },
                eventResize: function(event, delta, revertFunc) {
                    $.ajax({
                        url: "{{ route('update_date_scheduling_task') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            task_id: event.eventID,
                            start_date: event.start.format('YYYY-MM-DD'),
                            end_date: event.end ? event.end.format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD'),
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('Success', 'Task resized successfully.', 'success');
                            } else {
                                Swal.fire('Error', 'Failed to resize task.', 'error');
                                revertFunc();
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An unexpected error occurred.', 'error');
                            revertFunc();
                        }
                    });
                },
                eventAfterAllRender: function () {
                    if ($('#exportPrintBtn').length === 0) {
                        $('.fc .fc-toolbar .fc-right').append(
                            '<button id="exportPrintBtn" class="btn green_btn ml-2">Print Pdf</button>'
                        );
                    }
                }
            });

            $(document).on('click', '#exportPrintBtn', function() {
                exportPrintPdf();
            });

            function exportPrintPdf() {
                // Check dependencies
                if (!window.jspdf || !moment || !$('#calendar').fullCalendar) {
                    console.error('Required dependencies (jsPDF, Moment.js, or FullCalendar) are missing.');
                    return;
                }

                // Initialize jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Add the header title - Centered
                const pageWidth = doc.internal.pageSize.width;
                const text = 'Production Calendar All Appointments';
                const textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                const xPosition = (pageWidth - textWidth) / 2; // Center the text
                doc.setFontSize(16);
                doc.setFont('helvetica', 'normal');
                doc.text(text, xPosition, 20);

                // Get all events from the calendar
                const events = $('#calendar').fullCalendar('clientEvents');

                // If no events, add a message and save
                if (!events || events.length === 0) {
                    doc.setFontSize(12);
                    doc.text('No events to display.', 10, 30);
                    doc.save(`production_calendar_appointments_${moment().format('MMMM_D_YYYY_hh_mm_A')}.pdf`);
                    return;
                }

                // Prepare table data
                const tableData = events.map(event => [
                    event.lead || 'N/A',
                    event.name || 'N/A',
                    event.users || 'N/A',
                    event.team || 'N/A',
                    event.start && event.start.isValid() ? event.start.format('MMMM D, YYYY hh:mm A') : 'N/A',
                    event.end && event.end.isValid() ? event.end.format('MMMM D, YYYY hh:mm A') : 'N/A',
                ]);

                // Use autoTable if available
                if (typeof doc.autoTable === 'function') {
                    doc.autoTable({
                        head: [['Lead', 'Task', 'Assign Users', 'Assign Team', 'Start Date', 'End Date']],
                        body: tableData,
                        startY: 30,
                        theme: 'grid',
                        styles: {
                            fontSize: 10,
                            cellPadding: 2,
                            overflow: 'linebreak',
                            valign: 'middle',
                            halign: 'left',
                        },
                        columnStyles: {
                            0: { cellWidth: 'auto' },
                            1: { cellWidth: 'auto' },
                            2: { cellWidth: 'auto' },
                            3: { cellWidth: 'auto' },
                            4: { cellWidth: 'auto' },
                            5: { cellWidth: 'auto' },
                        },
                        headStyles: {
                            fillColor: [116, 201, 17],
                            textColor: [255, 255, 255],
                        },
                        didDrawCell: (data) => {
                            // This ensures text wraps properly
                            if (data.cell.section === 'body') {
                                data.cell.text = data.cell.raw;
                            }
                        }
                    });
                } else {
                    // Fallback: Manual table rendering with line breaks
                    let yPos = 30;
                    doc.setFontSize(10);

                    // Table header
                    doc.setFillColor(116, 201, 17);
                    doc.rect(10, yPos - 8, 190, 10, 'F');
                    doc.setTextColor(255, 255, 255);
                    const headers = ['Lead', 'Task', 'Assign Users', 'Assign Team', 'Start Date', 'End Date'];
                    const columnWidths = [30, 30, 30, 30, 30, 30];
                    const xPositions = [10, 40, 70, 100, 130, 160];

                    headers.forEach((header, index) => {
                        doc.text(header, xPositions[index], yPos);
                    });

                    yPos += 10;
                    doc.setTextColor(0, 0, 0);

                    // Table rows with line wrapping
                    tableData.forEach(row => {
                        let maxLines = 1;

                        // First pass: calculate how many lines each cell needs
                        const cellLines = row.map((cell, index) => {
                            const text = String(cell);
                            const textWidth = doc.getStringUnitWidth(text) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                            const lines = Math.ceil(textWidth / columnWidths[index]) || 1;
                            return lines;
                        });

                        maxLines = Math.max(...cellLines);

                        // Second pass: draw each cell with proper line breaks
                        for (let line = 0; line < maxLines; line++) {
                            row.forEach((cell, index) => {
                                const text = String(cell);
                                const textLines = doc.splitTextToSize(text, columnWidths[index]);
                                if (textLines[line]) {
                                    doc.text(textLines[line], xPositions[index], yPos + (line * 5));
                                }
                            });
                        }

                        yPos += (maxLines * 5) + 5;

                        // Add new page if needed (accounting for A4 height ~297mm)
                        if (yPos > 270) {
                            doc.addPage();
                            yPos = 10;
                        }
                    });
                }

                // Save the PDF
                doc.save(`production_calendar_appointments_${moment().format('MMMM_D_YYYY_hh_mm_A')}.pdf`);
            }
        });



        $('#update_scheduling_task').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var task_id = $('#scheduling_task_id').val();
            $.ajax({
                url: "{{ url('update_task_scheduling') }}",
                type: 'POST',
                data: formData + '&_token={{ csrf_token() }}' + '&task_id=' + task_id,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#editTaskModal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                    setTimeout(function() {
                        location.reload();
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            let modal = $('#taskModal');
            jobDraggable();
            function jobDraggable(){
                $("#unschedule-job li").draggable({
                    helper: "clone",
                    revert: "invalid"
                });

                $(".fc-day, .fc-daygrid-day").droppable({
                    accept: "#unschedule-job li",
                    drop: function (event, ui) {
                        let jobName = ui.helper.text().trim();
                        let jobID = ui.helper.data('id');
                        let date = $(this).attr("data-date");
                        let bgColor = ui.helper.attr('data-bgcolor') || ui.helper.data('bgcolor');

                        if (date) {
                            $(modal).find('#taskDate').val(date);
                            $(modal).find('.startDates').val(date);
                            $(modal).find('.attendees_user_id').val(jobID).trigger('change');
                            $(modal).find('[name="color_id"]').val(bgColor);

                            //var nextDate = new Date(date);
                            //nextDate.setDate(nextDate.getDate() + 7);
                            //$('#taskModal #taskDate').val(nextDate.toISOString().slice(0, 10));

                            var taskModal = new bootstrap.Modal(document.getElementById('taskModal'));
                            taskModal.show();
                        }
                    }
                });
            }

            $(document).on('click', '#calendar .fc-toolbar button', function () {
                jobDraggable();
            });

            $('.fc-today-button').hover(function(){
                jobDraggable();
            });
        });
    </script>

    <script>
        $('select[name="lead_id"]').on('change', function() {
            var selectedLeadId = $(this).val();
            $.ajax({
                url: '{{url("get-lead-details")}}',
                method: 'GET',
                data: {
                    lead_id: selectedLeadId
                },
                success: function(response) {
                    $('#color_id').val(response.category.color_id);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching lead details:', error);
                }
            });
        });
    </script>
@endpush
