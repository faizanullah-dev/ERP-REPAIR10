@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SchedulingTask') }} {{ $schedulingtask->id }}</h3>
                    @can('view-'.str_slug('SchedulingTask'))
                        <a class="btn btn-success pull-right" href="{{ url('/schedulingTask/scheduling-task') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $schedulingtask->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $schedulingtask->name }} </td></tr><tr><th> Color Id </th><td> {{ $schedulingtask->color_id }} </td></tr><tr><th> Start Date </th><td> {{ $schedulingtask->start_date }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

