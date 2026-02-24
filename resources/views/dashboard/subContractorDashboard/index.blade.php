@extends('layouts.new-master')

@push('css')
    <link href='{{ asset('plugins/components/fullcalendar/fullcalendar.css') }}' rel='stylesheet'>
@endpush

@section('content')
    <section class="dashboard_sec">
        <div class="container-fluid">
            <div class="row">
                @php
                    $boxes = [
                        ['Active Jobs:', $schedulingtask->where('job_status', 'active')->count(),'active_jobs_box', 'active-iocn.svg'],
                        ['Completed Jobs:', $schedulingtask->where('job_status', 'complete')->count(), 'completed_jobs_box', 'completed-iocn.svg'],
                        ['Upcoming Work Orders:', $subcontractor->subContractorProposal->where("status", "required")->count(), 'upcoming_work_box', 'upcoming-iocn.svg'],
                        ['Signed Work Orders:', $subcontractor->subContractorProposal->where("status", "signed")->count(), 'signed_Work_box', 'signed-iocn.svg']
                    ];
                @endphp
                @foreach($boxes as [$title, $count, $class, $background])
                    <div class="col-md-3">
                        <div class="card info-box {{ $class }}" style="background-image: url('{{ asset("website/images/$background") }}'); background-size: 75px 75px; background-repeat: no-repeat; background-position: right;">
                            <div class="card-header" >
                                <h6>{{ $title }}</h6>
                            </div>
                            <div class="card-body">
                                <h4>{{ $count }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-2  col-md-3">
                                <div class="lead-jobs-calendar">
                                    <h5>Scheduled Tasks</h5>
                                    <div class="scheduled_task_list">
                                        @if(isset($schedulingtask))
                                            @foreach($schedulingtask as $task)
                                                <div class="scheduled_task_list_box" style="background-color: {{ $task->getLead->category->color_id??'' }};">
                                                   <span > {{ $task->getLead->title ?? '' }} - {{ $task->getLead->category->name ?? '' }} </span>
                                                </div>

                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10  col-md-9 ">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#calendar1"><i class="fa-solid fa-circle"></i></a></li>
                                    <li><a data-toggle="tab" href="#calendar2"><i class="fa-solid fa-minus"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="calendar1" class="tab-pane fade in active">
                                        <div id="calendar-view-one"></div>
                                    </div>
                                    <div id="calendar2" class="tab-pane fade">
                                        <div id="calendar-view-two"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Scheduling Task Details</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body scheduling-modal-body">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src='{{ asset('plugins/components/moment/moment.js') }}'></script>
    <script src='{{ asset('plugins/components/fullcalendar/fullcalendar.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('#calendar-view-one').fullCalendar({
                events: [
                        @foreach ($schedulingtask as $task)
                    {
                        title: '{{ $task->getLead->customer->last_name ?? '' }} - {{ $task->getLead->category->name ?? '' }}',
                        eventID: '{{ $task->id ?? '' }}',
                        {{--start: '{{ $task->start_date }}',--}}
                                {{--end: '{{ $task->end_date }}',--}}
                        backgroundColor: '{{ $task->color_id }}',
                        borderColor: '{{ $task->color_id }}',
                        textColor: '#FFF',
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
                        start: '{{ $task->start_date ?? '' }}',
                        end: '{{ $task->end_date ?? '' }}',
                        description: {!! json_encode($task->description) !!},
                        address: '{{ $task->getLead->address ?? '' }}',
                        tooltip: `Address: {{ $task->getLead->customer->profile->address ?? "N/A" }}<br> Details: {{ $task->getLead->category->name ?? "N/A" }}<br> Note: {!! strip_tags($task->getLead->description??"") !!}`
                    },
                    @endforeach
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventRender: function(event, element) {
                    element.css({
                        backgroundColor: 'transparent',
                        // border: 'none',
                        borderRadius: 0,
                        color: 'rgba(74, 74, 74, 1)'
                    });
                    element.find('.fc-title').prepend(
                        `<span class="fc-event-dot" style="background-color:${event.backgroundColor}; width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; vertical-align: middle;"></span>`
                    );
                    element.attr('title', event.tooltip);
                    element.tooltip({
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true

                    });
                },
                eventClick: function(event) {
                    console.log(event);

                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    const decodedDescription = tempDiv.textContent || tempDiv.innerText || '';

                    const startDate = event.start ? moment(event.start).format('MM-DD-YYYY') : 'N/A';
                    const endDate = event.end ? moment(event.end).format('MM-DD-YYYY') : startDate;



                    $('.scheduling-modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-6"><div class="form-group"><label>Lead:</label> <input type="text" class="form-control" value="' + event.lead + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Task:</label> <input type="text" class="form-control" value="' + event.name + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign User:</label> <input type="text" class="form-control" value="' + event.users + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign Team:</label> <input type="text" class="form-control" value="' + event.team + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Start Date:</label> <input type="text" class="form-control" value="' + startDate + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>End Date:</label> <input type="text" class="form-control" value="' + endDate + '" readonly></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>' + decodedDescription + '</textarea></div></div>'+
                        '</div>'
                    );

                    {{--$('.scheduling-modal-body').append(--}}
                    {{--    '<a href="' + '{{ url('view_lead') }}/' + event.leadId + '" type="button" class="green_btn submit_btn large_green_btn create_btn">View Lead</a>'--}}
                    {{--);--}}
                    $('#eventModal').modal('show');
                }

            });

            $('#calendar-view-two').fullCalendar({
                events: [
                        @foreach ($schedulingtask as $task)
                    {
                        title: '{{ $task->getLead->customer->last_name ?? '' }} - {{ $task->getLead->category->name ?? '' }}',
                        eventID: '{{ $task->id ?? '' }}',
                        {{--start: '{{ $task->start_date }}',--}}
                                {{--end: '{{ $task->end_date }}',--}}
                        backgroundColor: '{{ $task->color_id }}',
                        borderColor: '{{ $task->color_id }}',
                        textColor: '#FFF',
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
                        start: moment('{{ $task->start_date ?? '' }}').format('YYYY-MM-DD'),
                        end: moment('{{ $task->end_date ?? '' }}').format('YYYY-MM-DD'),
                        description: {!! json_encode($task->description) !!},
                        address: '{{ $task->getLead->address ?? '' }}',
                        tooltip: `Address: {{ $task->getLead->customer->profile->address ?? "N/A" }}<br> Details: {{ $task->getLead->category->name ?? "N/A" }}<br> Note: {!! strip_tags($task->getLead->description??"") !!}`
                    },
                    @endforeach
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,

                eventRender: function(event, element) {
                    element.css({
                        backgroundColor: event.color,
                        border: 'none',
                        borderRadius: 0
                    });
                    element.attr('title', event.tooltip);
                    element.tooltip({
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true

                    });
                },
                eventClick: function(event) {
                    console.log(event);

                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    const decodedDescription = tempDiv.textContent || tempDiv.innerText || '';

                    const startDate = event.start ? moment(event.start).format('YYYY-MM-DD') : 'N/A';
                    const endDate = event.end ? moment(event.end).format('YYYY-MM-DD') : startDate; // <- Fix here

                    $('.scheduling-modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-6"><div class="form-group"><label>Lead:</label> <input type="text" class="form-control" value="' + event.lead + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Task:</label> <input type="text" class="form-control" value="' + event.name + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign User:</label> <input type="text" class="form-control" value="' + event.users + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign Team:</label> <input type="text" class="form-control" value="' + event.team + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Start Date:</label> <input type="text" class="form-control" value="' + startDate + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>End Date:</label> <input type="text" class="form-control" value="' + endDate + '" readonly></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>' + decodedDescription + '</textarea></div></div>'+
                        '</div>'
                    );
                    {{--$('.scheduling-modal-body').append(--}}
                    {{--    '<a href="' + '{{ url('view_lead') }}/' + event.leadId + '" type="button" class="green_btn submit_btn large_green_btn create_btn">View Lead</a>'--}}
                    {{--);--}}
                    $('#eventModal').modal('show');
                }
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $('#calendar-view-one, #calendar-view-two').each(function () {
                    $(this).fullCalendar('render');
                });
            });
        });
    </script>
@endpush

