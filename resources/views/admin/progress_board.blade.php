@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/components/dropify/dist/css/dropify.min.css')}}">
    <style>
        /* Style for the popup */
        .modal-body {
            font-size: 16px;
        }
        .color-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
            position: relative;
        }
        .color-circle.selected::after {
            content: '✓';
            color: #000;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .date_field, .textarea_field {
            display: none;
        }

    </style>
@endpush
@section('content')
    <section class="progress_board">
        <div class="container-fluid">
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'PROGRESS BOARD (MJT ROOFING)') }}</h3>
{{--                        <a class="btn btn-success pull-right" href="javascript:void(0)"><i class="fa fa-print m-0"></i></a>--}}
{{--                        <a class="btn btn-success pull-right" href="javascript:void(0)"><i class="fa fa-download m-0"></i></a>--}}
{{--                        <a class="btn btn-success pull-right" href="javascript:void(0)">Switch Board</a>--}}
                        <div class="clearfix"></div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="details_box">CUSTOMER JOBS</th>
                                    <th class="custom_th">COLOR</th>
                                    <th class="custom_th">PROJECTS</th>
                                    <th class="custom_th">SQS</th>
                                    <th class="custom_th">NOTES</th>
                                    <th class="custom_th">DATE</th>
                                    <th class="custom_th">CREW</th>
                                    <th class="custom_th">DUMPSTER</th>
                                    <th class="custom_th">MATERIAL ORDERED</th>
                                    <th class="custom_th">NEED TO PICK UP</th>
                                    <th class="custom_th">ASAP JOBS</th>
                                    <th class="custom_th">ON HOLD JOB</th>
                                    <th class="custom_th">INSURANCE JOB</th>
                                    <th class="custom_th">SQ USED</th>
                                </tr>
                                </thead>
                                <tbody id="sortable">
                                @php $index=1;@endphp
                                @forelse($leads->sortBy('position') as $lead)
                                    <tr class="sortable-item" class="sortable-item" data-start-index="{{$index++}}" id="{{$lead->id}}">
                                        <td class="lead-number">{{ $loop->iteration??$item->id }}</td>
                                        <td>
                                            <h6>{{ $lead->title??"" }} / <a class="text-primary" href="{{url('view_lead')}}/{{$lead->id}}">{{ $lead->lead_number??"" }}</a></h6>
                                            <span>example name</span>
                                            <span>example test</span>
                                            <p>{{ $lead->category->name??"N/A" }}</p>
                                            <p>{{ $lead->address??"N/A" }}</p>
                                            <p>S/CR:  {{ $lead->representative->name??"N/A" }}</p>
                                            <h6 class="text-primary font-weight-bold">{{ $lead->getStage->name??"N/A" }}</h6>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#"><i class="fa fa-trash"></i></a>
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="javascript:void(0)" ><i class="fa fa-download"></i></a>
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#" aria-controls="offcanvasRight"><i class="fa fa-print"></i></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="color" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'color')->first()->color) ? $lead->getProgressBoard->where('name', 'color')->first()->color : '' }}">
                                        @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'color')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'color')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'color')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'color') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {!! \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') !!}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="color" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                    <a href="#" class="task_lead" data-progress-name="color" data-task="{{ $lead->getTasks->where('progress_name', 'color')->first()->id??"" }}" data-task-lead="{{ $lead->id }}"
                                                       {{--                                                         --}}
                                                       aria-controls="offcanvasRight">
                                                        <img  src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20">
                                                    </a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="project" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'project')->first()->color) ? $lead->getProgressBoard->where('name', 'project')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'project')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'project')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'project')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'project') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {!! \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') !!}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="project" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                    <a href="#" class="task_lead" data-progress-name="project" data-task="{{ $lead->getTasks->where('progress_name', 'project')->first()->id??"" }}" data-task-lead="{{ $lead->id }}"
{{--                                                         --}}
                                                       aria-controls="offcanvasRight">
                                                        <img  src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20">
                                                    </a>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="sq" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'sq')->first()->color) ? $lead->getProgressBoard->where('name', 'sq')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'sq')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'sq')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'sq')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'sq') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="sq" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="sq" class="task_lead" data-task="{{ $lead->getTasks->where('progress_name', 'sq')->first()->id??"" }}" data-task-lead="{{ $lead->id }}"   aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>

                                        <td class="clickable" data-name="note" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'note')->first()->color) ? $lead->getProgressBoard->where('name', 'note')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'note')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'note')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'note')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'note') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="note" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="note" class="task_lead" data-task="{{ $lead->getTasks->where('progress_name', 'note')->first()->id??"" }}" data-task-lead="{{ $lead->id }}"   aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="date" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'date')->first()->color) ? $lead->getProgressBoard->where('name', 'date')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'date')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'date')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'date')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'date') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="date" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="date" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'date')->first()->id??"" }}"  aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="crew" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'crew')->first()->color) ? $lead->getProgressBoard->where('name', 'crew')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'crew')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'crew')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'crew')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'crew') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="crew" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="crew" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'crew')->first()->id??"" }}"  aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="dumpster" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'dumpster')->first()->color) ? $lead->getProgressBoard->where('name', 'dumpster')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'dumpster')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'dumpster')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'dumpster')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'dumpster') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="dumpster" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="dumpster" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'dumpster')->first()->id??"" }}"  aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="material_ordered" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'material_ordered')->first()->color) ? $lead->getProgressBoard->where('name', 'material_ordered')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'material_ordered')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'material_ordered')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'material_ordered')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'material_ordered') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="material_ordered" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="material_ordered" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'material_ordered')->first()->id??"" }}" aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="pickup" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'pickup')->first()->color) ? $lead->getProgressBoard->where('name', 'pickup')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'pickup')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'pickup')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'pickup')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'pickup') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="pickup" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="pickup" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'pickup')->first()->id??"" }}"  aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="asap_jobs" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'asap_jobs')->first()->color) ? $lead->getProgressBoard->where('name', 'asap_jobs')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'asap_jobs')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'asap_jobs')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'asap_jobs')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'asap_jobs') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="asap_jobs" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="asap_jobs" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'asap_jobs')->first()->id??"" }}" aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="on_hold_jobs" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'on_hold_jobs')->first()->color) ? $lead->getProgressBoard->where('name', 'on_hold_jobs')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'on_hold_jobs')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'on_hold_jobs')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'on_hold_jobs')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'on_hold_jobs') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="on_hold_jobs" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="on_hold_jobs" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'on_hold_jobs')->first()->id??"" }}"  aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="insurance_job" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'insurance_job')->first()->color) ? $lead->getProgressBoard->where('name', 'insurance_job')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'insurance_job')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'insurance_job')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'insurance_job')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'insurance_job') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="insurance_job" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="insurance_job" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'insurance_job')->first()->id??"" }}" aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                        <td class="clickable" data-name="sq_used" data-lead-id="{{ $lead->id }}" style="background-color: {{ isset($lead->getProgressBoard->where('name', 'sq_used')->first()->color) ? $lead->getProgressBoard->where('name', 'sq_used')->first()->color : '' }}">
                                            @foreach($lead->getProgressBoard as $progressBoard)
                                                @if($progressBoard->name == 'sq_used')
                                                    @if($progressBoard->date != null)
                                                        <span>{{ $progressBoard->date }}</span>
                                                    @elseif($progressBoard->description != null)
                                                        <span>{{ $progressBoard->description }}</span>
                                                    @elseif($progressBoard->mark_as_done == "1")
                                                        <span><i class="fa fa-check" style="font-size: 50px; color: #74C911"></i></span>
                                                    @else
                                                        <span>--</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if(!isset($lead->getProgressBoard->where('name', 'sq_used')->first()->name))
                                                <span>--</span>
                                            @endif
                                                @if($lead->getTasks->where('progress_name', 'sq_used')->isNotEmpty())
                                                    <br>
                                                    <span style="font-weight: bold; font-size: 15px;">Task Quick Info</span>
                                                    @foreach($lead->getTasks->where('progress_name', 'sq_used') as $task)
                                                        <p>Title: {{ $task->title ?? "" }}</p>
                                                        <p>Note: {{ \Illuminate\Support\Str::limit($task->description ?? "", 20,'...') }}</p>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            <div class="text-content"></div>
                                            <div class="td_inner_icons">
                                            <span class="color_modal_icon">
                                                <img class="icon_1" id="color_id" data-color-name="sq_used" data-color-lead="{{ $lead->id }}" src="{{asset('website/images/color_icon.png')}}" alt="icon png" width="20">
                                            </span>
                                                <span class="create_modal_icon">
                                                <a href="#" data-progress-name="sq_used" class="task_lead" data-task-lead="{{ $lead->id }}" data-task="{{ $lead->getTasks->where('progress_name', 'sq_used')->first()->id??"" }}" aria-controls="offcanvasRight"><img src="{{asset('website/images/create_icon.png')}}" alt="icon png" width="20"></a>
                                            </span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="color_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Color</h5>
                    <button type="button" class="btn secondary_btn" id="resetColorBtn" data-dismiss="modal">Reset</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('update_progress_board_color') }}" method="post">
                    @csrf
                    <input type="hidden" name="lead_id" id="color_lead_id">
                    <input type="hidden" name="name" id="color_progress_name">
                    <div class="modal-body">
                        <div class="color-circle" style="background-color: rgb(240, 248, 255);" data-color="rgb(240, 248, 255)"></div>
                        <div class="color-circle" style="background-color: rgb(255, 230, 230);" data-color="rgb(255, 230, 230)"></div>
                        <div class="color-circle" style="background-color: rgb(255, 240, 245);" data-color="rgb(255, 240, 245)"></div>
                        <div class="color-circle" style="background-color: rgb(230, 230, 255);" data-color="rgb(230, 230, 255)"></div>
                        <div class="color-circle" style="background-color: rgb(230, 255, 230);" data-color="rgb(230, 255, 230)"></div>
                        <div class="color-circle" style="background-color: rgb(255, 255, 204);" data-color="rgb(255, 255, 204)"></div>
                        <div class="color-circle" style="background-color: rgb(235, 235, 224);" data-color="rgb(235, 235, 224)"></div>
                        <div class="color-circle" style="background-color: rgb(242, 242, 242);" data-color="rgb(242, 242, 242)"></div>
                        <div class="color-circle" style="background-color: rgb(255, 236, 179);" data-color="rgb(255, 236, 179)"></div>
                        <div class="color-circle" style="background-color: rgb(204, 242, 255);" data-color="rgb(204, 242, 255)"></div>
                        <div class="color-circle" style="background-color: rgb(179, 255, 179);" data-color="rgb(179, 255, 179)"></div>
                        <input type="hidden" name="color" id="selectedColorInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn secondary_btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green_btn" id="saveColor">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="offcanvas create_task offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        @if(isset($leads->getTasks))
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Edit</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        @else
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Create Task</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        @endif
        <div class="offcanvas-body">
            <form action="{{ route('store_progress_task') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lead_id" id="task_lead_id">
                <input type="hidden" name="progress_name" id="progress_name">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="form-label input_labels">Title</label>
                            <input class="form-control clr_input_fields borderRadius" type="text" id="title" name="title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-5">
                            <label for="high_priority" class="form-label input_labels ">Priority</label>
                            <div class="form-check form-check-inline mt-3">
                                @foreach($priorities as $key => $priority)
                                    <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif required>
                                    <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-5">
                            <label for="assign_to_user_id" class="form-label input_labels">Assign To User</label>
                            <select class="form-control clr_input_fields borderRadius select2" multiple name="assign_to_user_id[]" id="assign_to_user_id" required>
                                @foreach($taskUsers as $user)
                                    <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="assign_to_lead_id" class="form-label input_labels">Assign To Team</label>
                            <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_team_id" id="assign_to_team_id">
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('assign_to_team_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="due_date" class="form-label input_labels ">Due Date</label>
{{--                            <input class="form-control clr_input_fields borderRadius" id="due_date" type="date" name="due_date">--}}
                            <input class="form-control clr_input_fields borderRadius" id="due_date" value="{{ $yearEstimation->year . '-01-01' ?? "" }}" type="date" name="due_date">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="checkbox" name="link_to_job" id="link_to_job">
                            <label for="link_to_job" class="form-label input_labels ">Link To Job</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note" class="form-label input_labels ">Note</label>
                            <textarea id="description" class="form-control clr_input_fields borderRadius" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="images" class="form-label input_labels">Attachments</label>
                            <div action="#" id="taskDropzone" class="dropzone">
                                <div class="fallback">
                                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="task_attachment" id="task_attachment">
                    </div>
                    <div class="canvas_footer">
                        <div class="footer_left">
                            <a href="javascript:void(0)" class="text-primary">Select Template</a>
                        </div>
                        <div class="footer_right">
                            <button type="submit" class="btn green_btn" onclick="this.disabled = true; this.form.submit();">Create</button>
                            <button type="button" class="btn secondary_btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="canvas_two" aria-labelledby="offcanvasRightLabel" style="width: 80%;">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cell Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--                <div class="modal-body" id="popup-content">--}}
                <form action="{{ route('store_progress_board') }}" method="post">
                    @csrf
                    <input type="hidden" name="lead_id" id="lead_id">
                    <input type="hidden" name="name" id="td_name">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1" value="1">
                                    <label class="form-check-label" for="radio1">None</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2" value="2">
                                    <label class="form-check-label" for="radio2">Mark As Done</label>
{{--                                    <input type="hidden" name="mark_as_done" value="1">--}}
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3" value="3">
                                    <label class="form-check-label" for="radio3">Date</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio4" value="4">
                                    <label class="form-check-label" for="radio4">Add Text</label>
                                </div>

                            </div>
                            <div class="col-md-12 date_field mt-4">
                                <div class="form-group">
                                    <input class="form-control clr_input_fields borderRadius" id="progress_date" type="date" name="date">
                                </div>
                            </div>
                            <div class="col-md-12 textarea_field mt-4">
                                <div class="form-group">
                                    <label for="name" class="form-label input_labels">Enter Text</label>
                                    <textarea class="form-control clr_input_fields borderRadius" id="progress_description" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="mark_as_done" id="mark_as_done_hidden" value="0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn secondary_btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green_btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    ---------------------------------------------------}}
    <div class="offcanvas create_task offcanvas-end" tabindex="-1" id="editOffcanvasRight" aria-labelledby="editOffcanvasRightLabel">
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="canvas_two" aria-labelledby="editOffcanvasRightLabel" style="width: 80%;">
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
    <script src="{{asset('plugins/components/dropify/dist/js/dropify.min.js')}}"></script>
{{--    <script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}
    {{--    -------------------------For DragnDrop---------------------------}}
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        // $(document).ready(function () {
        //     $('.clr_input_fields').select2();
        // });
        $(document).ready(function() {
            $('#resetColorBtn').click(function() {
                $('#selectedColorInput').val(null);
            });
        });

        $(document).on('click', '.task_lead', function (event) {
            event.stopPropagation();
            var lead = $(this).closest('a').attr('data-task-lead');
            var progressName = $(this).attr('data-progress-name');
            var task = $(this).closest('a').attr('data-task');
            $('#progress_name').val(progressName);
            $('#task_lead_id').val(lead);
            if (task) {
                $.ajax({
                    url: "{{ route('edit_progress_task_modal') }}",
                    type: 'GET',
                    data: { task_id: task },
                    success: function (data) {
                        $('#editOffcanvasRight').html(data);
                        $('#editOffcanvasRight').offcanvas('show');
                        $('#editOffcanvasRight').find('.select2').select2();
                        $('#offcanvasRight').offcanvas('hide');
                    }
                    });
                $('#editOffcanvasRight').offcanvas('show');
            } else {
                console.log('No task value found.');
            }
            $('#offcanvasRight').offcanvas('show');
            $('#offcanvasRight').find('.select2').select2();
        });


        {{--$(document).on('click', '.task_lead', function (event) {--}}
        {{--    event.stopPropagation();--}}
        {{--        var lead = $(this).closest('a').attr('data-task-lead');--}}
        {{--        var proressName = $(this).attr('data-progress-name');--}}
        {{--        $('#progress_name').val(proressName);--}}
        {{--        $('#task_lead_id').val(lead);--}}
        {{--    var taskId = $(this).attr('data-task');--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('task_detail') }}",--}}
        {{--        type: 'GET',--}}
        {{--        data: { task: taskId },--}}
        {{--        success: function (data) {--}}

        {{--            var task = data.task;--}}
        {{--            var userIds = task.get_task_assign_user ? task.get_task_assign_user.map(function(user) {--}}
        {{--                return user.user_id;--}}
        {{--            }) : [];--}}
        {{--            $('#title').val(task.title);--}}
        {{--            $('input[name="priority_id"][value="' + task.priority_id + '"]').prop('checked', true);--}}
        {{--            $('#assign_to_user_id').val(userIds).trigger('change');--}}
        {{--            $('#assign_to_team_id').val(task.assign_to_team_id).trigger('change');--}}
        {{--            $('#due_date').val(task.due_date);--}}
        {{--            $('#description').val(task.description);--}}

        {{--            var dropzone = Dropzone.forElement("#taskDropzone");--}}

        {{--            // Clear existing images in the Dropzone area--}}
        {{--            dropzone.removeAllFiles(true);--}}

        {{--            // Process images array--}}
        {{--            task.images.forEach(function(image) {--}}
        {{--                // Create a new file object--}}
        {{--                var file = {--}}
        {{--                    name: image.name.split('/').pop(),--}}
        {{--                    size: 0, // Default size; update if actual size is available--}}
        {{--                    status: Dropzone.ADDED,--}}
        {{--                    accepted: true--}}
        {{--                };--}}

        {{--                // Emit 'addedfile' event--}}
        {{--                dropzone.emit("addedfile", file);--}}

        {{--                // Determine the correct thumbnail URL based on file type--}}
        {{--                var fileType = image.name.split('.').pop().toLowerCase();--}}
        {{--                var thumbnailUrl;--}}

        {{--                if (['jpg', 'jpeg', 'pjpeg', 'png', 'gif'].includes(fileType)) {--}}
        {{--                    thumbnailUrl = "{{ asset('/website') }}/" + image.name;--}}
        {{--                } else if (fileType === 'pdf') {--}}
        {{--                    thumbnailUrl = "{{ asset('/website/images') }}/pdf.png";--}}
        {{--                } else if (['doc', 'docx'].includes(fileType)) {--}}
        {{--                    thumbnailUrl = "{{ asset('/website/images') }}/Word-Logo.png";--}}
        {{--                } else {--}}
        {{--                    thumbnailUrl = "{{ asset('/website/images') }}/Word-Logo.png";--}}
        {{--                }--}}

        {{--                // Log the file and thumbnail URL for debugging--}}
        {{--                console.log('File:', file);--}}
        {{--                console.log('Thumbnail URL:', thumbnailUrl);--}}

        {{--                // Emit 'thumbnail' event--}}
        {{--                dropzone.emit("thumbnail", file, thumbnailUrl);--}}

        {{--                // Emit 'complete' event--}}
        {{--                dropzone.emit("complete", file);--}}

        {{--                // Handle file removal if applicable--}}
        {{--                if (file._removeLink) {--}}
        {{--                    $(file._removeLink).attr('id', image.id);--}}
        {{--                    $(file._removeLink).attr('image_name', image.name);--}}
        {{--                }--}}

        {{--                // Add file to Dropzone files array--}}
        {{--                dropzone.files.push(file);--}}
        {{--            });--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $('#offcanvasRight').offcanvas('show');--}}
        {{--    $('#offcanvasRight').find('.select2').select2();--}}
        {{--});--}}
        $('#offcanvasRight').on('hidden.bs.offcanvas', function () {
            // Clear form fields
            $('#title').val('');
            $('input[name="priority_id"]').prop('checked', false);
            $('#assign_to_user_id').val(null).trigger('change'); // Update select2
            $('#assign_to_lead_id').val(null).trigger('change'); // Update select2
            $('#due_date').val('');
            $('#description').val('');
        });

        $(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
        // $(document).ready(function() {
        // // Function to show modal
        // function showColorModal() {
        // $('#color_modal').modal('show');
        // }
        //
        // // Prevent event propagation and show modal on icon click
        // $('.icon_1').on('click', function(event) {
        // event.preventDefault();
        // event.stopPropagation();
        // showColorModal();
        // });
        //
        // // Function to show offcanvas
        // function showOffcanvas() {
        // $('#offcanvasRight').offcanvas('show');
        // }
        //
        // // Prevent event propagation and show offcanvas on icon click
        // $('a[data-bs-toggle="offcanvas"]').on('click', function(event) {
        // event.preventDefault();
        // event.stopPropagation();
        // showOffcanvas();
        // });
        //
        // // Add click event listener to each clickable cell
        // $('#myTable .clickable').on('click', function() {
        // var cellContent = $(this).text();
        // $('#popup-content').text(cellContent);
        // $('#exampleModal').modal('show');
        // });
        // });
        $(document).ready(function() {
            var selectedColor = null;
            var selectedTd = null;

            function showColorModal() {
                $('#color_modal').modal('show');
            }

            $('.icon_1').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                selectedTd = $(this).closest('td');
                var color = $(this).attr('data-color-lead');
                var progressName = $(this).attr('data-color-name');
                $('#color_lead_id').val(color);
                $('#color_progress_name').val(progressName);
                showColorModal();
            });


            function showOffcanvas() {
                $('#offcanvasRight').offcanvas('show');
            }

            $('a[data-bs-toggle="offcanvas"]').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                showOffcanvas();
            });

            // Handle color selection
            $('.color-circle').on('click', function() {
                $('.color-circle').removeClass('selected');
                $(this).addClass('selected');
                // var leadcolor = ('#lead_id')
                selectedColor = $(this).data('color');
                $('#selectedColorInput').val(selectedColor);
            });

            // Handle save button click in color modal
            $('#saveColor').on('click', function() {
                if (selectedColor && selectedTd) {
                    selectedTd.css('background-color', selectedColor);
                    // alert('Selected Color: ' + selectedColor);
                    $('#color_modal').modal('hide');
                }
            });

            $('#myTable .clickable').on('click', function() {
                // selectedTd = $(this);
                // $('#exampleModal').modal('show');
                if (!$(event.target).closest('.td_inner_icons').length) {
                    var leadId = $(this).attr('data-lead-id');
                    $('#exampleModal').modal('show');
                }
            });

            $('#saveChanges').on('click', function() {
                var selectedRadio = $('input[name=inlineRadioOptions]:checked').val();
                if (selectedRadio == '1') {
                    selectedTd.contents().filter(function() {
                        return this.nodeType == 3; // Text node
                    }).remove();
                    selectedTd.prepend('-- ');
                } else if (selectedRadio == '2') {
                    selectedTd.contents().filter(function() {
                        return this.nodeType == 3; // Text node
                    }).remove();
                    selectedTd.prepend('✔ ');
                } else if (selectedRadio == '3') {
                    var selectedDate = $('input[name="progress[date][]"]').val();
                    if (selectedDate) {
                        selectedTd.contents().filter(function() {
                            return this.nodeType == 3; // Text node
                        }).remove();
                        selectedTd.prepend(selectedDate + ' ');
                    } else {
                        alert('Please select a date');
                    }
                } else if (selectedRadio == '4') {
                    var enteredText = $('textarea[name=progress[description][]]').val();
                    selectedTd.contents().filter(function() {
                        return this.nodeType == 3; // Text node
                    }).remove();
                    selectedTd.prepend(enteredText + ' ');
                }
                $('#exampleModal').modal('hide');
            });
            //faizan code for clear fields radiobutton
            $(document).ready(function(){
                $('input[type=radio][name=inlineRadioOptions]').change(function() {

                    $('#progress_date').val('');

                    $('#progress_description').val('');

                    if ($('#radio2').is(':checked')) {
                        $('#mark_as_done_hidden').val('1');
                    } else {
                        $('#mark_as_done_hidden').val('0');
                    }
                });
            });
            // Initially hide date and text fields
            $('.date_field').hide();
            $('.textarea_field').hide();
            $('.canvas_footer .btn-primary').on('click', function(event) {
                event.preventDefault(); // Prevent default form submission
                var title = $('input[name="title"]').val();
                var assignTo = $('input[name="assign_to"]').val();
                var note = $('textarea[name="note"]').val();

                if (title || assignTo || note) {
                    var content = '';
                    if (title) {
                        content += 'Title: ' + title + '<br>';
                    }
                    if (assignTo) {
                        content += 'Assign To: ' + assignTo + '<br>';
                    }
                    if (note) {
                        content += 'Note: ' + note;
                    }

                    selectedTd.find('.text-content').html(content); // Update the text-content span within the selected td
                    $('#offcanvasRight').offcanvas('hide'); // Close the offcanvas
                } else {
                    alert('Please fill in at least one field');
                }
            });
        });
        $(document).ready(function() {
            $('input[type=radio][name=inlineRadioOptions]').change(function() {
                if (this.value == '3') {
                    $('.date_field').show();
                    $('.textarea_field').hide();
                }
                else if (this.value == '4') {
                    $('.date_field').hide();
                    $('.textarea_field').show();
                }
                else {
                    $('.date_field').hide();
                    $('.textarea_field').hide();
                }
            });
        });
        $(document).ready(function (){
            $('.show_fields_btn').click(function (){
                $('.add_fields_box').toggle();
            })
        })
        $(document).ready(function() {
            $('.office_review_toggle').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.show_div').show();
                } else {
                    $('.show_div').hide();
                }
            });
        });
        $(document).ready(function() {
            $('.reminder_toggle').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.show_div2').show();
                } else {
                    $('.show_div2').hide();
                }
            });
        });
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var sortedData = $(this).sortable('toArray');
                    updatePositions(sortedData);
                },
                placeholder: "sortable-item",
                forcePlaceholderSize: true
            }).disableSelection();
            function updatePositions(sortedData) {
                $.ajax({
                    url: "{{ route('update_lead_positions') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        positions: sortedData
                    },
                    success: function(response) {
                        $(".lead-number").each(function(index) {
                            $(this).html(index + 1);
                        });
                        console.log("Success!", "Lead updated successfully.", "success");
                    },
                    error: function(xhr, status, error) {
                        console.log("Error updating positions: " + error);
                    }
                });
            }
        });
        $(document).on('click', '.clickable', function (){
            var color = $(this).attr('data-name');
            var lead = $(this).attr('data-lead-id');
            $('#td_name').val(color);
            $('#lead_id').val(lead);
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
            @if (isset($task -> images) && $task -> images != null)
            @foreach($task -> images as $attachment)
            var file = {
                name: "{{ explode('.',$attachment->name)[1]}}",
                size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",
                status: Dropzone.ADDED,
                accepted: true
            };
            dropzone.emit("addedfile", file);
            @if (isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))
            dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");
            @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['pdf']))
            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");
            @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['doc', 'docx']))
            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
            @else
            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
            @endif
            dropzone.emit("complete", file);
            $(file._removeLink).attr('id', '{{ $attachment->id }}')
            $(file._removeLink).attr('image_name', '{{ $attachment->name}}')
            dropzone.files.push(file);
            @endforeach
            @endif
        });
    </script>
@endpush
