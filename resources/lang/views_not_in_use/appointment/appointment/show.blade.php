@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }} {{ $appointment->id }}</h3>
                    @can('view-'.str_slug('Appointment'))
                        <a class="btn btn-success pull-right" href="{{ url('/appointment/appointment') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $appointment->id }}</td>
                            </tr>
                            <tr><th> Customer  </th><td> {{ $appointment->getCustomer->name??"" }} </td></tr>
                            <tr><th> Title </th><td> {{ $appointment->title }} </td></tr>
                            <tr><th> Appointment For  </th><td> {{ $appointment->getLead->title??"" }} </td></tr>
                            <tr>
                                <th colspan="2" style="text-align:left"> Attendees </th>
                            </tr>
                            @foreach($appointment->getAppointmentAttendee as $user)
                                <tr>
                                    <td colspan="2">{{$user->AttendeesDetail->name??""}}</td>
                                </tr>
                            @endforeach
                            <tr><th> Description  </th><td> {!! $appointment->description??"" !!} </td></tr>
                            <tr><th> Location  </th><td> {!! $appointment->location??"" !!} </td></tr>
                            <tr><th> Additional Recipients </th><td> {!! $appointment->additional_recipients??"" !!} </td></tr>
                            @if(isset($appointment->images) && $appointment->images)
                                @foreach($appointment->images as $key => $value)
                                    <tr>
                                        <th>Attachments</th>
                                        <td>
                                            @if(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                <img src="{{asset('website')}}/{{$value->name}}" style="width:100px;height: 100px">
                                            @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['pdf']) )
                                                <img src="{{ asset('/website/images').'/pdf.png' }}" style="width:100px;height: 100px">
                                            @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['doc','docx']))
                                                <img src="{{ asset('/website/images').'/Word-Logo.png' }}" style="width:100px;height: 100px">
                                            @else
                                                <img src="{{ asset('/website/images').'/image.png' }}" style="width:100px;height: 100px">
                                            @endif
                                            <a href="{{asset('/website')}}/{{$value->name}}" target="_blank">
                                                View/Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr><th> To </th><td> Time :{{ $appointment->date_time_to ? date('h:i A', strtotime($appointment->date_time_to)) : 'Not Avalible' }}<br> Date: {{ $appointment->date_time_to ? date('d M Y', strtotime($appointment->date_time_to)) : 'Not Avalible' }}   </td></tr>
                            <tr><th> From </th><td> Time :{{ $appointment->date_time_from ? date('h:i A', strtotime($appointment->date_time_from)) : 'Not Avalible' }}<br> Date: {{ $appointment->date_time_from ? date('d M Y', strtotime($appointment->date_time_from)) : 'Not Avalible' }}   </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

