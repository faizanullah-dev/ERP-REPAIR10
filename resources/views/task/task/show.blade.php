@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Task') }} {{ $task->id }}</h3>
                    @can('view-'.str_slug('Task'))
                        <a class="btn btn-success pull-right" href="{{ url('/task/task') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">

                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $task->id }}</td>
                            </tr>
                            <tr>
                                <th> Title </th>
                                <td> {{ $task->title??"Not Available" }} </td>
                            </tr>
                            <tr>
                                <th> Priority </th>
                                <td>{{ $task->getPriority->name??""}}</td>
                            </tr>
                            <tr>
                                <th> Due Date </th>
                                <td> {{$task->due_date? date('d M Y', strtotime($task->due_date)) : 'Not Avalible' }} </td>
                            </tr>
                            <tr>
                                <th> Description </th>
                                <td> {!!  $task->description !!} </td>
                            </tr>
                            <tr>
                                <th> Assign To User </th>
                                  @forelse($task->getTaskAssignUser as $item)
                                        <td>{{$item->getUserDetails->name??""}}  </td>
                                  @empty
                                        <td>Not Available</td>
                                  @endforelse
                            </tr>
                            <tr>
                                <th> Attachments </th>
                                <td>
                                    <div class="files_wrapper">
                                        <div class="row">
                                            @if(isset($task->images) && $task->images)
                                                @forelse($task->images as $key => $value)
                                                    <div class="col-md-4">
                                                        <a href="{{asset('website')}}/{{$value->name}}" target="_blank" >
                                                            <div class="file">
                                                                @if(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                                    <img src="{{asset('website')}}/{{$value->name}}" style="width:100px;height: 100px">
                                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['pdf']) )
                                                                    <img src="{{ asset('/website/images').'/pdf.png' }}" style="width:100px;height: 100px">
                                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['doc','docx']))
                                                                    <img src="{{ asset('/website/images').'/Word-Logo.png' }}" style="width:100px;height: 100px">
                                                                @else
                                                                    <img src="{{ asset('/website/images').'/image.png' }}" style="width:100px;height: 100px">
                                                                @endif
                                                                <span> View/Download </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @empty
                                                    <div class="heading_btn_wrapper">
                                                        <div class="main_heading">
                                                            <h5>Not Available</h5>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            @else
                                                <div class="heading_btn_wrapper">
                                                    <div class="main_heading">
                                                        <h5>Not Available</h5>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

