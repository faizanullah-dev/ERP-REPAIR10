@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SalesMan') }} {{ $salesman->id }}</h3>
                    @can('view-'.str_slug('SalesMan'))
                        <a class="btn btn-success pull-right" href="{{ url('/salesMan/sales-man') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">\
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $salesman->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $salesman->name??"Not Available" }} </td></tr>
                            <tr><th> Email </th><td> {{ $salesman->email??"Not Available" }} </td></tr>
                            <tr><th> Phone </th><td> {{ $salesman->profile->phone??"Not Available" }} </td></tr>
                            <tr><th> Address </th><td> {{ $salesman->profile->address??"Not Available" }} </td></tr>
                            <tr><th> Status </th><td>{!! ($salesman->status==1)?"<badge class='badge badge-success'>Active</badge>":"<badge class='badge badge-warning'>Inactive</badge>" !!}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

