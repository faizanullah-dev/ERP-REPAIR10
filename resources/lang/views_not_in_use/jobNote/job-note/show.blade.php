@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'JobNote') }} {{ $jobnote->id }}</h3>
                    @can('view-'.str_slug('JobNote'))
                        <a class="btn btn-success pull-right" href="{{ url('/jobNote/job-note') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $jobnote->id }}</td>
                            </tr>
                            <tr>
                                <th> Lead </th>
                                <td> {{ $jobnote->getlead->title??'' }} </td>
                            </tr>
                            <tr>
                                <th> Description </th>
                                <td> {{ strip_tags($jobnote->description) }} </td>
                            </tr>
                            <tr>
                                <th> Status </th>
                                <td>
                                    @if($jobnote->status == 1)
                                        <p class="badge badge-success">Active</p>
                                        @else
                                        <p class="badge badge-warning">Inactive</p>
                                    @endif
                                </td>
                            </tr>


                                    <tr>
                                        <th>Attachments</th>
                                        <td>
                                            <div class="files_wrapper">
                                                <div class="row">
                                                    @if(isset($jobnote->images) && $jobnote->images)
                                                        @forelse($jobnote->images as $key => $value)
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

