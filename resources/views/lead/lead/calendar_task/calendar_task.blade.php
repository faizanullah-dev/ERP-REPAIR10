@extends('layouts.master')
@push('css')
    <link href="{{ asset('plugins/components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
    <style>
        .filter_inputs_btns_wrapper .filter_btns_parent { display: flex; align-items: end; }
        .calender .calender_wrapper .fc-view-container table thead.fc-head .fc-row.fc-widget-header table thead tr th{padding:10px;}
        .calender .calender_wrapper {max-height: calc(100vh - 288px);padding-right: 6px;overflow-y: auto;scrollbar-width: auto;scrollbar-color: auto;}
        .calender_wrapper .fc-view-container .fc-body .fc-row{height: fit-content !important;min-height: 90px;}
    </style>
@endpush
@section('content')


    <div class="row white-box calendar_section">
        <div class="col-md-12">
            <div class="white-box-header">
                <div class="white-box-header-left">
                    <h3 class="box-title"> Calendar </h3>
                </div>
                <div class="white-box-header-right">
                </div>
            </div>
        </div>
{{--        <div class="col-md-12">--}}
{{--            <div class="logoBtn_drop_wrapper">--}}
{{--                <div class="dropdown">--}}
{{--                    <button type="button" class="btn button_drop  dropdown-toggle green_btn borderRadius "    id="viwDropButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" > <i class="fa fa-eye"></i> </button>--}}
{{--                    <div class="dropdown-menu" aria-labelledby="viwDropButton">--}}
{{--                        <div class=" " >--}}
{{--                            <a href="{{url('map_view_lead')}}" class="btn border_btns borderRadius">Map View</a>--}}
{{--                        </div>--}}
{{--                        --}}{{--                        <div class=" " >--}}
{{--                        --}}{{--                            <a href="{{url('calender_task_view')}}" class="btn border_btns borderRadius">Calender View</a>--}}
{{--                        --}}{{--                        </div>--}}
{{--                        <div class=" " >--}}
{{--                            <a href="{{url('lead_card_view')}}" class="btn border_btns borderRadius">Card View</a>--}}
{{--                        </div>--}}
{{--                        <div class="">--}}
{{--                            <a href="{{url('lead/lead')}}" class="btn border_btns borderRadius">List View</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12">
            <div class="logoBtn_drop_wrapper">
                <div class="logobtn_left_box button_logo">

                </div>
                <div class="logobtn_right_box">
                    <div class="view_type_box" >
                        <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" class="btn green_btn {{ Request::is('lead_card_view') ? 'active' : '' }}"><img class="img-fluid" src="{{ asset('/website/images').'/cards-blank.svg' }} " ></a>
                        <a href="{{ url('lead/lead') }}" class="btn green_btn {{ Request::is('lead/lead') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></a>
                        <a href="{{ url('map_view_lead') }}" class="btn green_btn {{ Request::is('map_view_lead') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i></a>
                        <a href="{{ url('calender_task_view') }}" class="btn green_btn {{ Request::is('calender_task_view') ? 'active' : '' }}"><i class="fa-solid fa-calendar"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form method="get" action="{{url('calender_task_view')}}" id="filter-form">
                <div class="form-group filter_inputs_btns_wrapper ">
                    <input type="hidden" name="lead_filter" value="yes">
                    <div class=" filter_inputs_parent">
                        <label for="Select Category" class="form-label input_labels p-18">Select Category</label>
                        <select class="form-control select_category_initialize" data-placeholder="Select Category" id="categoryFilter" name="category_id" >
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter_inputs_parent">
                        <label for="duration_starts" class="form-label input_labels p-18">To </label>
                        <input class="form-control clr_input_fields "  name="duration_starts" value="{{ request()->get('duration_starts') ?? ($yearEstimation->year . '-01-01') }}" type="date" id="duration_starts" required placeholder="Enter duration_starts"  >
                    </div>
                    <div class="filter_inputs_parent">
                        <label for="duration_ends" class="form-label input_labels p-18">From </label>
                        <input class="form-control clr_input_fields " name="duration_ends" type="date" value="{{ request()->get('duration_ends') ?? ($yearEstimation->year . '-12-31') }}" id="duration_ends" required placeholder="duration_ends to_date"  >
                    </div>
                    <div class="  filter_inputs_parent filter_btns_parent">
                        <div class="reset_apply_btn">
                            <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                            <a href="{{ url('calender_task_view') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section class="calender">
        <div class="white-box  position-relative  ">
{{--            <a class="btn green_btn text-white" href="{{ url('lead/lead') }}"><i class="icon-plus"></i> View List</a>--}}
{{--            <div class="clearfix"></div>--}}
{{--            <br>--}}
            <div class="container-fluid d-block ">
                <div class="row  ">
                    <div class="col-md-12  ">
                        <div class="inner">
                            <div id="calendar" class="calender_wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--   starts  Modal  --}}
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    {{--end modal--}}
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="task-modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('plugins/components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/components/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.select_category_initialize').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
            });

            var selectedYear = @json($yearEstimation->year);
            var currentMonth = new Date().getMonth() + 1;
            var currentMonthFormatted = currentMonth < 10 ? '0' + currentMonth : currentMonth;
            var defaultDate = selectedYear + '-' + currentMonthFormatted + '-01';
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
                    right: 'month,basicWeek,agendaDay',
                },
                defaultView: 'month',
                defaultDate: defaultDate,
                dayMaxEvents: 1,
                views: {
                    month: {
                        showNonCurrentDates: false,
                        fixedWeekCount: false
                    }
                },
                events: [
                        @if(isset($lead) && count($lead) > 0)
                        @foreach($lead as $item)
                    {
                        id: '{{ @$item->id??"" }}',
                        title: '{{ @$item->representative->name ??"" }}/{{ @$item->category->name ??"" }}/{{ @$item->title ??"" }}',
                        lead: '{{@$item->title??''}}',
                        stage: '{{@$item->getStage->name??'No Stage Found'}}',
                        customer: '{{@$item->customer->name??''}}',
                        category: '{{@$item->category->name??''}}',
                        job_id: '{{@$item->lead_number??''}}',
                        job_address: '{{@$item->address??''}}',
                        contact_person: '{{@$item->contact_person??''}}',
                        start: '{{ @$item->lead_date ??''}}',
{{--                        start: '{{ $item->created_at ??''}}',--}}
                        description: {!! json_encode(@$item->description) !!},
                        images: [
                            @foreach($item->getphotoandDocument as $attachment)
                                    @foreach($attachment->getDocuments as $document)
                                '{{ $document->name }}'@if (!$loop->parent->last || !$loop->last), @endif
                            @endforeach
                            @endforeach
                        ].join(','),
                    }@if(!$loop->last),@endif
                    @endforeach
                    @endif
                    @if(isset($task) && count($task) > 0)
                    @if(isset($lead) && count($lead) > 0),@endif
                        @foreach($task as $item)
                    {
                        title: '{{$item->title??''}}',
                        start: '{{ $item->created_at??'' }}',
                        priority: '{{$item->getPriority->name??''}}',
                        assigned_team: '{{$item->team->name??''}}',
                        description: {!! json_encode($item->description) !!},
                        color: 'blue',
                        task: true,
                        images: [
                            @foreach($item->images as $attachment)
                                '{{ $attachment->name }}'@if (!$loop->parent->last || !$loop->last), @endif
                            @endforeach
                        ].join(','),
                    }@if(!$loop->last),@endif
                    @endforeach
                    @endif
                ],

                eventClick: function (event, jsEvent, view) {
                    if (event.task !== undefined) {
                        // Task modal
                        $('#taskModalLabel').text('Task Detail: ' + event.title);
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = event.description;
                        var decodedDescription = tempDiv.textContent || tempDiv.innerText || '';
                        $('.task-modal-body').html(
                                {{--                        '<a href="{{ url('view_lead/' . $item->id) }}" type="button" class="green_btn  w-100 submit_btn large_green_btn create_btn">View Lead</a>' +--}}
                            '<p><label>Task:</label> <input type="text" name="subject" class="form-control" value="' + event.title + '" readonly></p>' +
                            '<p><label>Priority:</label> <input type="text" name="subject" class="form-control" value="' + event.priority + '" readonly></p>' +
                            '<p><label>Assign Team:</label> <input type="text" name="subject" class="form-control" value="' + event.assigned_team + '" readonly></p>' +
                            '<p><label>Lead Description:</label> <textarea class="form-control" rows="5" name="message" readonly>' + decodedDescription + '</textarea></p>' +
                            '<p> <label>Images:</label></p>',
                        );
                        if (event.images) {
                            var imagesHtml = event.images.split(',').map(function (imageName) {
                                if (!imageName) return '';
                                var baseUrl = "{{ asset('website') }}/";
                                var fileExtension = imageName.split('.').pop().toLowerCase();
                                var imagePath = baseUrl + imageName.trim();
                                var thumbnailPath = '';
                                if (['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif'].includes(fileExtension)) {
                                    thumbnailPath = imagePath;
                                } else if (fileExtension === 'pdf') {
                                    thumbnailPath = "{{ asset('/website/images') }}/pdf.png";
                                } else if (['doc', 'docx'].includes(fileExtension)) {
                                    thumbnailPath = "{{ asset('/website/images') }}/Word-Logo.png";
                                } else {
                                    thumbnailPath = "{{ asset('/website/images') }}/image.png";
                                }
                                return '<div class="col-md-4">' +
                                    '<a href="' + imagePath + '" target="_blank">' +
                                    '<div class="file">' +
                                    '<img src="' + thumbnailPath + '" >' +
                                    '<span> View/Download </span>' +
                                    '</div>' +
                                    '</a>' +
                                    '</div>';
                            }).join('');
                        }
                        if (!imagesHtml) {
                            imagesHtml =
                                '<div class="heading_btn_wrapper">' +
                                '<div class="main_heading">' +
                                '<h5>Not Available</h5>' +
                                '</div>' +
                                '</div>';
                        }
                        $('.task-modal-body').append(
                            '<div class="event-images">' + imagesHtml + '</div>'
                        );
                        $('#taskModal').modal('show');
                    } else {
                        {{--// Lead modal--}}
                        $('#eventModalLabel').text('Lead Detail: ' + event.title);
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = event.description;
                        var decodedDescription = tempDiv.textContent || tempDiv.innerText || '';
                        $('.modal-body').html(
                            '<p><label>Lead:</label> <input type="text" name="subject" class="form-control" value="' + event.lead + '" readonly></p>' +
                            '<p><label>Stage:</label> <input type="text" name="subject" class="form-control" value="' + event.stage + '" readonly></p>' +
                            '<p><label>Customer:</label> <input type="text" name="subject" class="form-control" value="' + event.customer + '" readonly></p>' +
                            '<p><label>Category:</label> <input type="text" name="subject" class="form-control" value="' + event.category + '" readonly></p>' +
                            '<p><label>Lead Start Date:</label> <input type="text" class="form-control" value="' + moment(event.start).format('MMMM DD, YYYY') + '" readonly></p>' +
                            '<p><label>Job Id:</label> <input type="text" name="subject" class="form-control" value="' + event.job_id + '" readonly></p>' +
                            '<p><label>Contact Person:</label> <input type="text" class="form-control" value="' + event.contact_person + '" readonly></p>' +
                            '<p><label>Job Address:</label> <input type="text" name="subject" class="form-control" value="' + event.job_address + '" readonly></p>' +
                            '<p><label>Lead Description:</label> <textarea class="form-control" rows="5" name="message" readonly>' + decodedDescription + '</textarea></p>' +
                            '<p> <label>Images:</label></p>',
                        );
                        if (event.images) {
                            var imagesHtml = event.images.split(',').map(function (imageName) {
                                if (!imageName) return '';
                                var baseUrl = "{{ asset('website') }}/";
                                var fileExtension = imageName.split('.').pop().toLowerCase();
                                var imagePath = baseUrl + imageName.trim();
                                var thumbnailPath = '';
                                if (['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif'].includes(fileExtension)) {
                                    thumbnailPath = imagePath;
                                } else if (fileExtension === 'pdf') {
                                    thumbnailPath = "{{ asset('/website/images') }}/pdf.png";
                                } else if (['doc', 'docx'].includes(fileExtension)) {
                                    thumbnailPath = "{{ asset('/website/images') }}/Word-Logo.png";
                                } else {
                                    thumbnailPath = "{{ asset('/website/images') }}/image.png";
                                }
                                return '<div class="col-md-4">' +
                                    '<a href="' + imagePath + '" target="_blank">' +
                                    '<div class="file">' +
                                    '<img src="' + thumbnailPath + '" >' +
                                    '<span> View/Download </span>' +
                                    '</div>' +
                                    '</a>' +
                                    '</div>';
                            }).join('');
                        }
                        if (!imagesHtml) {
                            imagesHtml =
                                '<div class="heading_btn_wrapper">' +
                                '<div class="main_heading">' +
                                '<h5>Not Available</h5>' +
                                '</div>' +
                                '</div>';
                        }
                        $('.modal-body').append(
                                {{--'<div class="event-images">' + imagesHtml + '</div> <a href="{{ url('view_lead/' . $item->id) }}" type="button" class="green_btn   submit_btn large_green_btn create_btn">View Lead</a>'--}}
                                {{--    '<div class="event-images">' + imagesHtml + '</div> <a href="{{ url('view_lead')/+ event.lead.id+ }}" type="button" class="green_btn   submit_btn large_green_btn create_btn">View Lead</a>'--}}
                                    '<div class="event-images">' + imagesHtml + '</div> <a href="' + '{{ url('view_lead') }}/' + event.id + '" type="button" class="btn green_btn submit_btn large_green_btn create_btn">View Lead</a>'
                        );
                        $('#eventModal').modal('show');
                    }
                }

        });
            {{--$(document).ready(function() {--}}
            {{--    var durationStarts = '{{ $_GET['duration_starts'] ??'' }}';--}}
            {{--    var durationEnds = '{{ $_GET['duration_ends'] ?? ''}}';--}}
            {{--    var defaultDate = new Date().toISOString().slice(0, 10);--}}

            {{--    if (durationStarts === '' && durationEnds === '') {--}}
            {{--        $('.fc-center').text(defaultDate);--}}
            {{--    }--}}
            {{--    else--}}
            {{--    $('.fc-center').text('From ' + durationStarts + ' to ' + durationEnds);--}}
            {{--});--}}

        });
    </script>
@endpush
