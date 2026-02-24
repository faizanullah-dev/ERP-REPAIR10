@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Notification') }} {{ $notification->id }}</h3>
                    @can('view-'.str_slug('Notification'))
                        <a class="btn btn-success pull-right" href="{{ url('/notification/notification') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $notification->id }}</td>
                            </tr>
                            <tr><th> Notification Name </th><td> {{ $notification->notification_name }} </td></tr><tr><th> Title </th><td> {{ $notification->title }} </td></tr><tr><th> Time </th><td> {{ $notification->time }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

