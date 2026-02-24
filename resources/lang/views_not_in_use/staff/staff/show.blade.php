@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff') }} {{ $staff->id }}</h3>
                    @can('view-'.str_slug('Staff'))
                        <a class="btn btn-success pull-right" href="{{ url('/staff/staff') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $staff->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $staff->name }} </td></tr><tr><th> Email </th><td> {{ $staff->email }} </td></tr><tr><th> Phone </th><td> {{ $staff->profile->phone }} </td></tr><tr><th> Address </th><td> {{ $staff->profile->address }} </td></tr><tr><th>Status</th><td>{!! ($staff->status==1)?"<badge class='badge badge-success'>Active</badge>":"<badge class='badge badge-warning'>Inactive</badge>" !!}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

