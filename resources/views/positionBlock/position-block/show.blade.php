@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'PositionBlock') }} {{ $positionblock->id }}</h3>
                    @can('view-'.str_slug('PositionBlock'))
                        <a class="btn btn-success pull-right" href="{{ url('/positionBlock/position-block') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $positionblock->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $positionblock->name }} </td></tr><tr><th> Insurance Rate </th><td> {{ $positionblock->insurance_rate }} </td></tr><tr><th> Pay Rate Weekly </th><td> {{ $positionblock->pay_rate_weekly }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

