@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'AppointmentAttachment') }} {{ $appointmentattachment->id }}</h3>
                    @can('view-'.str_slug('AppointmentAttachment'))
                        <a class="btn btn-success pull-right" href="{{ url('/appointmentAttachment/appointment-attachment') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $appointmentattachment->id }}</td>
                            </tr>
                            <tr><th> Appointment Id </th><td> {{ $appointmentattachment->appointment_id }} </td></tr><tr><th> Name </th><td> {{ $appointmentattachment->name }} </td></tr><tr><th> Type </th><td> {{ $appointmentattachment->type }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

